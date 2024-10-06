<?php

namespace App\Controllers;
use Config\Services;
use App\Models\Ventas;
use App\Models\DetalleVenta;
use App\Models\Productos;
use App\Models\Usuarios;

class CarritoController extends BaseController {
    
    public function agregar() {
        $cart = Services::cart();
        $request = Services::request();
        $data = [
            'id'    => $request->getPost('id'),
            'name'  => $request->getPost('name'),
            'price' => $request->getPost('price'),
            'qty'   => 1            
        ];
        $cart->insert($data);
        return redirect()->to(base_url('carrito'));
    }

    public function eliminar($rowid) {
        $cart = Services::cart();
        $cart->remove($rowid);
        return redirect()->to(base_url('carrito'));
    }

    public function vaciar() {
        $cart = Services::cart();
        $cart->destroy();
        return redirect()->to(base_url('carrito'));
    }

    public function index() {
        $data['titulo'] = 'Carrito';
        return view('plantilla/cabeza', $data)
             . view('plantilla/nav')
             . view('contenido/carritoView')
             . view('plantilla/piePagina');
    }
    
    public function guardarVenta() {
    $cart = Services::cart();
    $productos = new Productos();
    $ventas = new Ventas();
    $detalle = new DetalleVenta();

    $cart1 = $cart->contents();

    // Verificar stock
    foreach ($cart1 as $item) {
        $producto = $productos->where('id_producto', $item['id'])->first();
        if ($producto['stock'] < $item['qty']) {
            return redirect()->route('carrito')->with('mensaje', 'No hay stock para el producto ' . $producto['nom_producto']);
        }
    }

    // Iniciar transacción
    $db = \Config\Database::connect();
    $db->transStart();

    // Insertar la venta principal
    $data = array('id_cliente' => session('id'), 'fecha_venta' => date('Y-m-d'));
    $ventas->insert($data);
    $venta_id = $ventas->getInsertID(); // Obtener el ID de la venta recién insertada

    // Verificar si la inserción de la venta fue exitosa
    if (!$venta_id) {
        $db->transRollback();
        return redirect()->route('carrito')->with('mensaje', 'Error al registrar la venta');
    }

    // Insertar detalles de la venta y actualizar stock de productos
    foreach ($cart1 as $item) {
        $detalleVenta = array(
            'id_venta' => $venta_id,
            'id_producto' => $item['id'],
            'detalle_cantidad' => $item['qty'],
            'detalle_precio' => $item['price']
        );

        // Depuración: mostrar datos de detalleVenta
        log_message('debug', 'Detalle Venta Data: ' . print_r($detalleVenta, true));

        $producto = $productos->where('id_producto', $item['id'])->first();
        $data = ['stock' => intval($producto['stock']) - $item['qty']];

        // Actualizar stock del producto
        if (!$productos->update($item['id'], $data)) {
            $db->transRollback();
            return redirect()->route('carrito')->with('mensaje', 'Error al actualizar el stock del producto ' . $producto['nom_producto']);
        }

        // Insertar detalle de la venta
        if (!$detalle->insert($detalleVenta)) {
            $db->transRollback();
            return redirect()->route('carrito')->with('mensaje', 'Error al registrar el detalle de la venta: ' . implode(' - ', $detalle->errors()));
        }
    }

    // Completar transacción
    $db->transComplete();

    // Verificar si la transacción fue exitosa
    if ($db->transStatus() === FALSE) {
        return redirect()->route('carrito')->with('mensaje', 'Error al procesar la venta');
    }

    // Limpiar el carrito
    $cart->destroy();

    return $this->productosCompradosPorUsuario(session('id'));
}




    public function productosCompradosPorUsuario($userId) {
        $usuarios = new Usuarios();
        $detalle = new DetalleVenta();
        $productos = new Productos();
        $ventas = new Ventas();
    
        $consulta = $usuarios
            ->select('productos.nom_producto, productos.marca, productos.img_producto, detalle_venta.detalle_cantidad, detalle_venta.detalle_precio, ventas.fecha_venta')
            ->join('ventas', 'ventas.id_cliente = usuarios.id')
            ->join('detalle_venta', 'detalle_venta.id_venta = ventas.id_venta')
            ->join('productos', 'productos.id_producto = detalle_venta.id_producto')
            ->where('usuarios.id', $userId)->findAll();
    
        $data = [
            'titulo' => 'Productos Comprados',
            'consulta' => $consulta
        ];
    
        return view('plantilla/cabeza', $data)
             . view('plantilla/nav')
             . view('contenido/misCompras')
             . view('plantilla/piePagina');
    }
}
