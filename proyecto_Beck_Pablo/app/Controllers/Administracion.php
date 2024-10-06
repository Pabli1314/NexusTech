<?php

namespace App\Controllers;
use App\Models\Consultas;
use App\Models\Categorias;
use App\Models\Productos;
use App\Models\DetalleVenta;
use App\Models\Usuarios;
use App\Models\Ventas;
use CodeIgniter\Controller;


class Administracion extends BaseController{
    public function admin(){
        $data['titulo'] = 'Administrador';
        $productos = new Productos();
        $data['productos'] = $productos->findAll();
        return view('plantilla/cabeza', $data).view('plantilla/navAdmin').view('back-end/mainAdmin').view('plantilla/piePaginaAdmin');
    }

    public function visualizarConsultas(){
        $data['titulo'] = 'Consultas';
        $consultas = new Consultas();
        $data['consultas'] = $consultas->findAll();
        return view('plantilla/cabeza', $data).view('plantilla/navAdmin').view('back-end/verConsultas').view('plantilla/piePaginaAdmin');
    }

    public function estadoLeido($id) {
    $consultas = new Consultas();
    
    // Datos para actualizar
    $data = [
        'estado_leido' => true 
    ]; 
    
    
    $consultas->update($id, $data);

    $data['consultas'] = $consultas->findAll();
    
    // Redirigir a la vista de consultas
    return redirect()->to('verConsultas');
}

public function estadoNoLeido($id) {
    
    $consultas = new Consultas();
    
    // Datos para actualizar
    $data = [
        'estado_leido' => false 
    ]; 
    
    // Actualizar el estado en la base de datos
    $consultas->update($id, $data);


    $data['consultas'] = $consultas->findAll();
    
    // Redirigir a la vista de consultas
    return redirect()->to('verConsultas');
}

    //Este metodo se encarga de visualizar el formulario al administrador
    public function insertarProductoView(){
        $categorias = new Categorias();
        $data['titulo'] = 'Agregar Producto';
        $data['categorias'] = $categorias->findAll();
        $data['salirModal'] = 'agregarProducto';
        return view('plantilla/cabeza', $data).view('plantilla/navAdmin').view('plantilla/alertas').view('back-end/guardarProducto_view').view('plantilla/piePaginaAdmin');
    }

    //En este metodo estan las reglas de validación del formulario de guardarProducto.php y la insercion de datos
    public function insertarProducto() {
    $request = \Config\Services::request();
    $validation = \Config\Services::validation();
    $validation->setRules([
        'categoria' => 'required|is_not_unique[categorias.id_categoria]',
        'marca' => 'required|max_length[30]',
        'nom_producto' => 'required|max_length[255]',
        'precio' => 'required',
        'stock' => 'required',
        'descripcion' => 'required|max_length[300]',
        'imagen' => 'uploaded[imagen]|max_size[imagen,4094]|is_image[imagen]'
    ], [
        'categoria' => [
            'required' => 'Debe seleccionar una categoría de producto.',
            'is_not_unique' => 'La categoría seleccionada no es válida.'
        ],
        'marca' => [
            'required' => 'Debe escribir la marca del producto.',
            'max_length' => 'El nombre de la marca puede tener como máximo 30 caracteres.'
        ],
        'nom_producto' => [
            'required' => 'Debe ingresar el nombre del producto.',
            'max_length' => 'El nombre no debe exceder los 255 caracteres.'
        ],
        'precio' => [
            'required' => 'Debe ingresar el precio del producto.',
        ],
        'stock' => [
            'required' => 'Debe ingresar el stock del producto.',
        ],
        'descripcion' => [
            'required' => 'Debe ingresar una descripción del producto.',
            'max_length' => 'La descripción no debe exceder los 300 caracteres.'
        ],
        'imagen' => [
            'uploaded' => 'Debe seleccionar una imagen.',
            'max_size' => 'La imagen no debe exceder los 4094 KB.',
            'is_image' => 'El archivo seleccionado no es una imagen válida.'
        ]
    ]);

    if ($validation->withRequest($request)->run()) {
        $categoria_id = $request->getPost('categoria');
        
        // Verificar si la categoría existe
        $categoriasModel = new Categorias(); // Asegúrate de que el modelo tenga el namespace correcto
        $categoria = $categoriasModel->find($categoria_id);
        
        if ($categoria) {
            $img = $request->getFile('imagen');
            $nomAleatorio = $img->getRandomName();
            $img->move(ROOTPATH . 'public/assets/uploads', $nomAleatorio);
            
            $data = [
                'cat_producto' => $categoria_id,
                'marca' => $request->getPost('marca'),
                'nom_producto' => $request->getPost('nom_producto'),
                'precio' => $request->getPost('precio'),
                'stock' => $request->getPost('stock'),
                'descripcion' => $request->getPost('descripcion'),
                'img_producto' => $nomAleatorio,
                'estado_producto' => true
            ];
            
            $productosModel = new Productos(); // Asegúrate de que el modelo tenga el namespace correcto
            $productosModel->insert($data);
            
            return redirect()->route('agregarProducto')->with('mensaje', 'El producto se agregó correctamente');
        } else {
            return redirect()->route('agregarProducto')->with('mensaje', 'La categoría seleccionada no es válida');
        }
    } else {
        $categorias = new Categorias(); // Asegúrate de que el modelo tenga el namespace correcto
        $data = [
            'titulo' => 'Agregar Producto',
            'categorias' => $categorias->findAll(),
            'validation' => $validation->getErrors(),
            'salirModal' => 'agregarProducto'
        ];
        
        return view('plantilla/cabeza', $data)
            . view('plantilla/navAdmin')
            . view('plantilla/alertas')
            . view('back-end/guardarProducto_view')
            . view('plantilla/piePaginaAdmin');
    }
}

    
    public function eliminar_producto($id){
        $productos = new Productos();
        
        $data = [
            'estado_producto' => false 
        ]; 
        $productos->update($id, $data);
        $data['productos'] = $productos->findAll();
        return redirect()->to('administrador');
    }

    public function activar_producto($id){
        $productos = new Productos();
        
        $data = [
            'estado_producto' => true 
        ]; 
        $productos->update($id, $data);
        $data['productos'] = $productos->findAll();
        return redirect()->to('administrador');
    }

    public function editar_producto($id=null){
        $productos = new Productos();
        $categorias = new Categorias();
        $data['categorias'] = $categorias->findAll();
        $data['producto'] = $productos->where('id_producto', $id)->first();
        $data['titulo'] = 'Editar Producto';
        return view('plantilla/cabeza', $data).view('plantilla/navAdmin').view('back-end/modificarProducto_view').view('plantilla/piePaginaAdmin');
    }

    
    public function actualizar_producto() {
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();
        $id = $request->getPost('id_producto');
        $productos = new Productos();
    
        // Validación
        $validation->setRules([
            'categoria' => 'required|is_not_unique[categorias.id_categoria]',
            'marca' => 'required|max_length[30]',
            'nom_producto' => 'required|max_length[255]',
            'precio' => 'required',
            'stock' => 'required',
            'descripcion' => 'required|max_length[300]',
            'imagen' => 'max_size[imagen,4094]|is_image[imagen]'
        ], [
            'categoria' => [
                'required' => 'Debe seleccionar una categoría de producto.',
                'is_not_unique' => 'La categoría seleccionada no es válida.'
            ],
            'marca' => [
                'required' => 'Debe escribir la marca del producto.',
                'max_length' => 'El nombre de la marca puede tener como máximo 30 caracteres.'
            ],
            'nom_producto' => [
                'required' => 'Debe ingresar el nombre del producto.',
                'max_length' => 'El nombre no debe exceder los 255 caracteres.'
            ],
            'precio' => [
                'required' => 'Debe ingresar el precio del producto.'
            ],
            'stock' => [
                'required' => 'Debe ingresar el stock del producto.'
            ],
            'descripcion' => [
                'required' => 'Debe ingresar una descripción del producto.',
                'max_length' => 'La descripción no debe exceder los 300 caracteres.'
            ],
            'imagen' => [
                'max_size' => 'La imagen no debe exceder los 4094 KB.',
                'is_image' => 'El archivo seleccionado no es una imagen válida.'
            ]
        ]);
    
        if ($validation->withRequest($request)->run()) {
            $data = [
                'cat_producto' => $request->getPost('categoria'),
                'marca' => $request->getPost('marca'),
                'nom_producto' => $request->getPost('nom_producto'),
                'precio' => $request->getPost('precio'),
                'stock' => $request->getPost('stock'),
                'descripcion' => $request->getPost('descripcion')
            ];
    
            $img = $request->getFile('imagen');
            if ($img && $img->isValid() && !$img->hasMoved()) {
                $nomAleatorio = $img->getRandomName();
                $img->move(ROOTPATH . 'public/assets/uploads', $nomAleatorio);
                $data['img_producto'] = $nomAleatorio;
            }
    
            // Verificar que el ID del producto existe antes de intentar actualizar
            if ($productos->find($id)) {
                // Actualizar el producto usando la cláusula WHERE con el ID del producto
                $productos->update($id, $data);
                return redirect()->to('editar/'. $id)->with('mensaje', 'Producto actualizado correctamente');
            } else {
                // Manejar el caso en que el producto no exista
                return redirect()->to('editar/'. $id)->with('mensaje', 'Producto no encontrado');
            }
        } else {
            $data = [
                'titulo' => 'Administrador',
                'validation' => $validation->getErrors(),
                'productos' => $productos->findAll(),
                'salirModal' => 'editar/' . $id
            ];
    
            return view('plantilla/cabeza', $data)
                . view('plantilla/alertas')
                . view('plantilla/navAdmin')
                . view('back-end/mainAdmin')
                . view('plantilla/piePaginaAdmin');
        }
    }
    
    public function listadoDeVentas() {
        $ventas = new Ventas();
        
        $consulta = $ventas
            ->select('ventas.id_venta, ventas.id_cliente, usuarios.nombre, usuarios.apellido, productos.nom_producto, detalle_venta.detalle_cantidad, detalle_venta.detalle_precio, productos.marca, ventas.fecha_venta, productos.img_producto')
            ->join('detalle_venta', 'detalle_venta.id_venta = ventas.id_venta')
            ->join('usuarios', 'usuarios.id = ventas.id_cliente')
            ->join('productos', 'productos.id_producto = detalle_venta.id_producto')
            ->findAll();

        // Agrupar ventas por usuario
        $usuariosVentas = [];
        foreach ($consulta as $venta) {
            $idCliente = $venta['id_cliente'];
            if (!isset($usuariosVentas[$idCliente])) {
                $usuariosVentas[$idCliente] = [
                    'nombre' => $venta['nombre'],
                    'apellido' => $venta['apellido'],
                    'ventas' => []
                ];
            }
            $usuariosVentas[$idCliente]['ventas'][] = $venta;
        }

        $data = [
            "titulo" => 'Listado de ventas',
            'usuariosVentas' => $usuariosVentas
        ];

        return view('plantilla/cabeza', $data)
            . view('plantilla/navAdmin')
            . view('back-end/listarVentas', $data)
            . view('plantilla/piePaginaAdmin');   
    }

    public function listadoDeUsuarios(){
        $usuarios = new Usuarios();
        $data = ['titulo' => 'Usuarios', 'usuarios' =>  $usuarios->findAll()];
        return view('plantilla/cabeza', $data).view('plantilla/navAdmin').view('back-end/listarUsuarios').view('plantilla/piePaginaAdmin');
    }
    
    public function eliminar_usuario($id){
        $usuarios = new Usuarios();
        
        $data = [
            'estado_activo' => false 
        ]; 
        $usuarios->update($id, $data);
        $data['productos'] = $usuarios->findAll();
        return redirect()->to('listadoUsuarios');
    }

    public function activar_usuario($id){
        $usuarios = new Usuarios();
        
        $data = [
            'estado_activo' => true 
        ]; 
        $usuarios->update($id, $data);
        $data['productos'] = $usuarios->findAll();
        return redirect()->to('listadoUsuarios');
    }
}

    
    