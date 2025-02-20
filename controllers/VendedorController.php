<?php

namespace Controllers;

use MVC\Router;
use Model\Vendedor;

class VendedorController{

    public static function crear(Router $router){
        //Se generan los errores en caso de que hayan
        $errores = Vendedor::getErrores();
        $vendedor = new Vendedor();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //crear una nueva instancia
            
            $vendedor = new Vendedor($_POST['vendedor']);
            
        
            //Validar que no haya campos vacios
            $errores = $vendedor->validar();
            
        
            if(empty($errores)){
                $vendedor->guardar();
            }
        }

        //Se llama a render que es quien nos conecta con views para la interfaz
        $router->render('vendedores/crear', [
            //Empieza el envio de datos a la vista
            'errores' => $errores,
            'vendedor' => $vendedor
        ]);
    }

    public static function actualizar(Router $router){
        $id = validarORedireccionar('/admin');
        $errores = Vendedor::getErrores();
        $vendedor = Vendedor::find($id);

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //Sincronizar la memoria con los nuevos
            $args = $_POST['vendedor'];
            
            $vendedor->sincronizar($args);
            
            $errores = $vendedor->validar();
            if(empty($errores)){
                $vendedor->guardar();
            }
        }

        $router->render('vendedores/actualizar', [
            //Empieza el envio de datos a la vista
            'errores' => $errores,
            'vendedor' => $vendedor
        ]);
    }

    public static function eliminar(Router $router){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if($id){
                //Valida el tipo a eliminar
                $tipo = $_POST['tipo'];
                if(validarContenido($tipo)){
                    $vendedor = Vendedor::find($id);
                    $vendedor->eliminar();
                }
            }
        }   
    }

}