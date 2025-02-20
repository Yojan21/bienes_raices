<?php

namespace MVC;

class Router{
    public $rutasGet = [];
    public $rutasPost = [];

    public function getUrl($url, $fn){
        $this->rutasGet[$url] = $fn;
    }

    public function postUrl($url, $fn){
        $this->rutasPost[$url] = $fn;
    }

    public function comprobarRutas(){

        session_start();

        $auth = $_SESSION['login'] ?? null;

        //Arreglo de rutas protegidas
        $rutas_protegidas = ['/admin', '/propiedades/crear', '/propiedades/actualizar', '/propiedades/eliminar', '/vendedores/crear', '/vendedores/actualizar', '/vendedores/eliminar', '/auth/usuarios'];
        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];

        if($metodo === 'GET'){
            $fn = $this->rutasGet[$urlActual] ?? null;
        }else{
            $fn = $this->rutasPost[$urlActual] ?? null;
        }

        //Proteger las rutas
        if(in_array($urlActual, $rutas_protegidas) && !$auth){
            header('Location: /');
        }

        if($fn){
            call_user_func($fn, $this);
        }else{
            echo 'Pagina no encontrada';
        }
    }

    public function render($view, $datos=[]){
        
        foreach($datos as $key => $value){
            $$key = $value;
        }

        ob_start();
        include __DIR__ . "/views/$view.php";

        $contenido = ob_get_clean();

        include __DIR__ . "/views/layout.php";
    }
}