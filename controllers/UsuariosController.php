<?php

namespace Controllers;
use MVC\Router;
use Model\Admin;
use Model\ActiveRecord;

class UsuariosController{
    public static function usuarios(Router $router){

        $errores = [];
        $email = '';
        $password = '';
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth = new Admin($_POST);
            $errores = $auth->validar();
            $email = $_POST['email'];
            $password = $_POST['password'];
            if(empty($errores)){
                
                $resultado = $auth->crearUsuario();
                if(!$resultado){
                    $errores = Admin::getErrores();
                }
            }
        }

        $router->render('auth/usuarios', [
            'errores' => $errores,
            'email' => $email,
            'password' => $password
        ]);
    }
}