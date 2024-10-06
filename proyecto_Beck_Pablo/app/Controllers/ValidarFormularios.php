<?php

namespace App\Controllers;
use App\Models\Consultas;
use App\Models\Usuarios;
use App\Models\Productos;

//Esta clase forma parte del controlador para los formularios de consulta, iniciar sesion y para crear una cuenta nueva (registrarse).
class ValidarFormularios extends BaseController {
    // Este método se encarga de validar los campos del formulario del apartado de contactos    
    public function validarFormularioConsulta() {
        $validation = \Config\Services::validation();
        $request = \Config\Services::request();
        $validation->setRules([
            'nombre' => 'required|max_length[100]',
            'correo' => 'required|valid_email',
            'consulta' => 'required|max_length[300]'
        ], [
            'nombre' => [
                'required' => 'El campo nombre es requerido.'
            ],
            'correo' => [
                'required' => 'El campo correo es requerido.',
                'valid_email' => 'La dirección de correo es inválida.'
            ],
            'consulta' => [
                'required' => 'El campo consulta es requerido.',
                'max_length' => 'El mensaje debe tener como máximo 300 caracteres.'
            ]
        ]);
    
        if ($validation->withRequest($request)->run()) {
            $data = [
                "nombre" => $request->getPost('nombre'),
                "correo" => $request->getPost('correo'),
                "consulta" => $request->getPost('consulta')
            ];
            $consulta = new Consultas();
            $consulta->insert($data);
            return redirect()->route('contactos')->with('mensaje', 'Su mensaje ha sido enviado correctamente');
        } else {
            $data['titulo'] = 'Contactos';
            $data['validation'] = $validation->getErrors();
            return view('plantilla/cabeza', $data). view('plantilla/alertas') . view('plantilla/nav') . view('contenido/contactos', $data) . view('plantilla/piePagina');
        }
    }
    

    // El siguiente método es para el formulario de iniciar sesión
    public function validarIniciarSesion() {
        $validation = \Config\Services::validation();
        $request = \Config\Services::request();
        $validation->setRules([
            'correo' => 'required|valid_email|is_unique[users.correo,id,{id}]',
            'password' => 'required|min_length[8]|max_length[16]'
        ], [
            'correo' => [
                'required' => 'El campo de correo es obligatorio.',
                'valid_email' => 'El correo ingresado es inválido.',
                'is_unique' => 'Ya hay un usuario con este mismo correo.'
            ],
            'password' => [
                'required' => 'El campo de contraseña es obligatorio.',
                'min_length' => 'La contraseña debe tener al menos 8 caracteres.',
                'max_length' => 'La contraseña debe tener como máximo 16 caracteres.'
            ]
        ]);
    
        $mail = $request->getPost('correo');
        $pass = $request->getPost('password');
    
        // Buscar el usuario en la base de datos
        $usuarios = new Usuarios();
        $user = $usuarios->where('correo', $mail)->first();
    
        // Verificar las credenciales del usuario
        if ($user && password_verify($pass, $user['password'])) {
            // Establecer datos de la sesión
            $data = [
                'id' => $user['id'],
                'nombre' => $user['nombre'],
                'apellido' => $user['apellido'],
                'dni' => $user['dni'],
                'telefono' => $user['telefono'],
                'correo' => $user['correo'],
                'perfil' => $user['perfil'],
                'login' => true,
            ];
            session()->set($data);
            $redirecciones = ['administrador', 'cliente'];
            //El valor del perfil se resta 1 para poder ubicarse en el vector, del cual el primer elemento de un array es 0.
            return redirect()->route($redirecciones[$user['perfil']-1]);
        } else {
            // Credenciales incorrectas, redirigir al formulario de inicio de sesión con mensaje de error
            return redirect()->route('iniciarSesion')->with('mensaje', 'La contraseña y/o el correo es incorrecto.');
        }
    }    

}