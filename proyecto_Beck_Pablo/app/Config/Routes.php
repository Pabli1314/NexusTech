<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Home;  
use App\Controllers\ValidarFormularios;
use App\Controllers\Usuarios_Controller;
use App\Controllers\Administracion;
use App\Controllers\CarritoController;
use App\Controllers\ProductosController;
/**
 * @var RouteCollection $routes
 */
// *** Rutas principales ***
$routes->get('/', [Home::class, 'index']);
//$routes->get('mis-compras/(:num)', 'CarritoController::productosCompradosPorUsuario/$1');
$routes->get('iniciarSesion', [Home::class, 'iniciarSesion']);
$routes->get('quienes-somos', [Home::class, 'somos']);
$routes->get('terminos-y-condiciones', [Home::class, 'terminos']);
$routes->get('registrarse', [Home::class, 'registrarse']);
$routes->post('buscador/buscar', 'Home::buscar');
$routes->get('contactos', [Home::class, 'contactos']);
$routes->get('comercializacion', [Home::class, 'comercializacion']);
$routes->get('visitar/(:num)', [Home::class, 'verProducto/$1']);

// *** Rutas de Productos
$routes->get('auriculares', [ProductosController::class, 'auricularesVista']);
$routes->get('teclados', [ProductosController::class, 'tecladoVista']);
$routes->get('mouses', [ProductosController::class, 'mouseVista']);
$routes->get('televisores-monitores', [ProductosController::class, 'monitorVista']);//Se muestra un catalogo tanto de televisores y monitores
$routes->get('celulares', [ProductosController::class, 'celularesVista']);
$routes->get('netbooks', [ProductosController::class, 'netbooksVista']);

// *** Rutas de validacion de formularios ***

$routes->post('validarConsulta', [ValidarFormularios::class, 'validarFormularioConsulta']);  
$routes->post('form_iniciarSesion', [ValidarFormularios::class, 'validarIniciarSesion']);
$routes->post('formularioRegistrarse', [Usuarios_Controller::class, 'validarRegistro']);

$routes->get('cliente', [Home::class, 'clienteRegistrado']);

//Rutas del administrador
$routes->get('administrador', [Administracion::class, 'admin']);
$routes->get('cerrarSesion', [Home::class, 'cerrarsesion']);
$routes->get('verConsultas', [Administracion::class, 'visualizarConsultas']);
$routes->get('agregarProducto', [Administracion::class, 'insertarProductoView']);
$routes->post('insertar-producto', [Administracion::class, 'insertarProducto']);
$routes->get('producto/eliminar_producto/(:segment)', 'Administracion::eliminar_producto/$1');
$routes->get('producto/activar_producto/(:segment)', 'Administracion::activar_producto/$1');
$routes->get('editar/(:num)', [Administracion::class, 'editar_producto/$1']);
$routes->post('actualizar', [Administracion::class, 'actualizar_producto']);
$routes->get('listarVentas', [Administracion::class, 'listadoDeVentas']);
$routes->get('listadoUsuarios', [Administracion::class, 'listadoDeUsuarios']);
$routes->get('usuario/activar_usuario/(:segment)', 'Administracion::activar_usuario/$1');
$routes->get('usuario/eliminar_usuario/(:segment)', 'Administracion::eliminar_usuario/$1');
$routes->get('ver-detalles/(:num)', 'Administracion::detallarVentas/$1');
$routes->get('leerConsulta/(:num)', 'Administracion::estadoLeido/$1');
$routes->get('noLeerConsula/(:num)', 'Administracion::estadoNoLeido/$1');

//Route de clientes guardando productos en el carrito
$routes->get('carrito', 'CarritoController::index');
$routes->post('carrito/agregar', 'CarritoController::agregar');
$routes->get('eliminar-item/(:segment)', 'CarritoController::eliminar/$1');
$routes->get('vaciar-carrito', 'CarritoController::vaciar');
$routes->get('guardar-venta', 'CarritoController::guardarVenta');
$routes->get('mis-compras/(:num)', 'CarritoController::productosCompradosPorUsuario/$1');


