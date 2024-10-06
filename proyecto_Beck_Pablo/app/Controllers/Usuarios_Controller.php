<?php

namespace App\Controllers;
use App\Models\Usuarios;

class Usuarios_Controller extends BaseController {
    
    public function validarRegistro() {
        $validation = \Config\Services::validation();
        $request = \Config\Services::request();
        $validation->setRules([
            'nombre' => 'required|max_length[30]',
            'apellido' => 'required|max_length[30]',
            'telefono' => 'required|min_length[10]',
            'dni' => 'required|max_length[15]',
            'correo' => 'required|valid_email|is_unique[usuarios.correo]',
            'password' => 'required|min_length[8]|max_length[16]',
            'repetir-password' => 'required|min_length[8]|max_length[16]|matches[password]',
            'validar' => 'required'
        ], [
            'nombre' => [
                'required' => 'El campo nombre es requerido.',
                'max_length' => 'Este campo solo admite un maximo de 30 caracteres.',
            ],

            'apellido' => [
                'required' => 'El campo nombre es requerido.',
                'max_length' => 'Este campo solo admite un maximo de 30 caracteres.',
            ],
            'dni' => [
                'required' => 'El campo DNI es requerido.',
                'max_length' => 'Este campo solo admite un maximo de 15 caracteres.'
            ],
            "telefono" => [
                'required' => 'El campo telefono es requerido.',
                'min_length' => 'Solo se permiten numeros de 10 dígitos.'
            ],
            'correo' => [
                'required' => 'El campo de correo es obligatorio.',
                'valid_email' => 'El correo ingresado es inválido.',
                'is_unique' => 'Ya hay un usuario con este mismo correo.'
            ],
            'password' => [
                'required' => 'El campo de contraseña es obligatorio.',
                'min_length' => 'La contraseña debe tener al menos 8 caracteres.',
                'max_length' => 'La contraseña debe tener como máximo 16 caracteres.'
            ],
            'repetir-password' => [
                'required' => 'El campo de contraseña es obligatorio.',
                'min_length' => 'La contraseña debe tener al menos 8 caracteres.',
                'max_length' => 'La contraseña debe tener como máximo 16 caracteres.',
                'matches' => 'Las contraseñas deben ser iguales.'
            ],
            'validar' => [
                'required' => 'Es obligatorio aceptar los términos y condiciones.'
            ]
        ]);
        
        if ($validation->withRequest($request)->run()){
            $data = [
            "nombre" => $request->getPost('nombre'),
            "apellido" => $request->getPost('apellido'),
            "dni" => $request->getPost('dni'),
            "telefono" => $request->getPost('telefono'),
            "correo" => $request->getPost('correo'),
            "password" => password_hash($request->getPost('password'), PASSWORD_BCRYPT),
            "perfil" => 2, 
            "estado_activo" => true
        ];

        $usuario = new Usuarios();

        $usuario->insert($data);
            return redirect()->route('registrarse')->with('mensaje', 'Se ha creado su cuenta correctamente.');
        } else {
            $data['titulo'] = 'Registrarse';
            $data['validation'] = $validation->getErrors();
            return view('plantilla/cabeza', $data) . view('plantilla/nav'). view('plantilla/alertas') . view('contenido/registrarse') . view('plantilla/piePagina');
        }
    }
}