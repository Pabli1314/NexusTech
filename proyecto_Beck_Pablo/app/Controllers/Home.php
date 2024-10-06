<?php

namespace App\Controllers;
use App\Models\Productos;

class Home extends BaseController{
    
    public function index(): string {
        $productos = new Productos();
        $data = [
            'titulo' => 'Inicio', 
            'productos' => $productos->findAll()
        ];
        return view('plantilla/cabeza', $data)
             . view('plantilla/nav')
             . view('contenido/principal') 
             . view('plantilla/piePagina');
    }
    
    
    public function misCompras(): string{
        $data['titulo']= 'Mis compras';
        return view("plantilla/cabeza", $data).view("plantilla/nav").view("contenido/misCompras").view("plantilla/piePagina");
    }

    public function carrito(): string{
        $data['titulo'] = 'Carrito';
        return view("plantilla/cabeza", $data).view("plantilla/nav").view("contenido/carritoView").view("plantilla/piePagina");
    }

    public function somos(): string{
        $data['titulo']= 'Quienes somos';
        return view('plantilla/cabeza', $data).view('plantilla/nav').view('contenido/somos').view('plantilla/piePagina');
        
    }

    public function terminos(): string{
        $data['titulo']= 'Términos y condiciones';
        return view('plantilla/cabeza', $data).view('plantilla/nav').view('contenido/terminos').view('plantilla/piePagina');
    }

    public function registrarse(): string{
        $data ['titulo'] = 'Registrarse';
        return view('plantilla/cabeza', $data).view('plantilla/nav').view('plantilla/alertas').view('contenido/registrarse').view('plantilla/piePagina');
    }

    public function contactos(): string{
        $data['titulo'] = 'Contactos';
        return view('plantilla/cabeza', $data).view('plantilla/nav').view('contenido/contactos').view('plantilla/piePagina');   
    }

    public function comercializacion(): string {
        $data['titulo'] = 'Comercialización';
        return view('plantilla/cabeza', $data).view('plantilla/nav').view('contenido/comercializacion').view('plantilla/piePagina');
    }

    //Rutas de sesiones
    public function iniciarSesion(): string{
        $data['titulo']= 'Iniciar sesion';
        return view('plantilla/cabeza', $data).view('plantilla/nav').view('contenido/login').view('plantilla/piePagina');
    }

    public function cerrarSesion(){
        $session = session();
        $session->destroy();
        return redirect()->route('/');
    }


    //Ruta para usario registrado
    public function clienteRegistrado(): string{
        $productos = new Productos();
        $data = [
            'titulo' => 'Inicio',
            'productos' => $productos->findAll()
        ];
        return view('plantilla/cabeza', $data)
             . view('plantilla/nav')
             . view('contenido/principal', $data)
             . view('plantilla/piePagina');

    }
    
    public function verProducto($id)
    {
        $productos = new Productos();
        $unProducto = $productos->find($id);
    
        if ($unProducto) {
            $data = [
                'titulo' => $unProducto['nom_producto'],
                'producto' => $unProducto
            ];
        } else {
            // Manejar el caso en que el producto no se encuentre
            $data = [
                'titulo' => 'Producto no encontrado',
                'producto' => null
            ];
        }
    
        return view('plantilla/cabeza', $data)
            . view('plantilla/nav')
            . view('contenido/visualizarProducto')
            . view('plantilla/piePagina');
    }
    

    public function buscar() {
        $productos = new Productos();
        $request = \Config\Services::request();
        $query = $request->getPost('query'); // Obtener el término de búsqueda

        // Verificar si se recibió el parámetro
        if (empty($query)) {
            // Manejo de error si no se recibe ningún término de búsqueda
            return redirect()->back()->with('error', 'Por favor, ingrese un término de búsqueda.');
        }

        // Realizar la búsqueda
        $resultados = $productos->search($query);

        $data = [
            'titulo' => 'Buscar',
            'productos' => $resultados
        ];

        return view('plantilla/cabeza', $data)
            . view('plantilla/nav')
            . view('contenido/buscadorView')
            . view('plantilla/piePagina');
    }
}
    

