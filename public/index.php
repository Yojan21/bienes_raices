<?php

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\LoginController;
use Controllers\PaginasController;
use Controllers\UsuariosController;
use Controllers\VendedorController;
use Controllers\PropiedadController;


$router = new Router();

//Zona privada

$router->getUrl('/admin', [PropiedadController::class, 'index']);
$router->getUrl('/propiedades/crear', [PropiedadController::class, 'crear']);
$router->postUrl('/propiedades/crear', [PropiedadController::class, 'crear']);
$router->getUrl('/propiedades/actualizar', [PropiedadController::class, 'actualizar']);
$router->postUrl('/propiedades/actualizar', [PropiedadController::class, 'actualizar']);
$router->postUrl('/propiedades/eliminar', [PropiedadController::class, 'eliminar']);

$router->getUrl('/vendedores/crear', [VendedorController::class, 'crear']);
$router->postUrl('/vendedores/crear', [VendedorController::class, 'crear']);
$router->getUrl('/vendedores/actualizar', [VendedorController::class, 'actualizar']);
$router->postUrl('/vendedores/actualizar', [VendedorController::class, 'actualizar']);
$router->postUrl('/vendedores/eliminar', [VendedorController::class, 'eliminar']);


//Zona publica
$router->getUrl('/', [PaginasController::class, 'index']);
$router->getUrl('/nosotros', [PaginasController::class, 'nosotros']);
$router->getUrl('/propiedades', [PaginasController::class, 'propiedades']);
$router->getUrl('/propiedad', [PaginasController::class, 'propiedad']);
$router->getUrl('/blog', [PaginasController::class, 'blog']);
$router->getUrl('/entrada', [PaginasController::class, 'entrada']);
$router->getUrl('/contacto', [PaginasController::class, 'contacto']);
$router->postUrl('/contacto', [PaginasController::class, 'contacto']);

//Login y Autenticacion
$router->getUrl('/login', [LoginController::class, 'login']);
$router->postUrl('/login', [LoginController::class, 'login']);
$router->getUrl('/logout', [LoginController::class, 'logout']);
$router->getUrl('/auth/usuarios', [UsuariosController::class, 'usuarios']);
$router->postUrl('/auth/usuarios', [UsuariosController::class, 'usuarios']);

$router->comprobarRutas();