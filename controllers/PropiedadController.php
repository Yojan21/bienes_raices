<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class PropiedadController{

    public static function index(Router $router){

        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();

        $resultado = $_GET['resultado'] ?? null;

        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'resultado' =>$resultado,
            'vendedores' => $vendedores
        ]);
    }

    public static function crear(Router $router){

        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $propiedad = new Propiedad($_POST['propiedad']);
    
            //Generar un nombre unico para la imagen
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
    
            //Usando el InterventionImage para agregar las fotos 
            if($_FILES['propiedad']['tmp_name']['imagen']){
                $manager = new ImageManager(new Driver());
                $imagen = $manager->read($_FILES['propiedad']['tmp_name']['imagen'])->cover(800,600);
                $propiedad->setImagen($nombreImagen);
            }
    
            //Validando errores
            $errores = $propiedad->validar();
            //Revisar que el arreglo de errores este vacio
            if(empty($errores)){
                //Subida de archivos
                //'CARPETA_IMAGENES' esta creado en funciones.php
                if(!is_dir(CARPETA_IMAGENES)){ 
                    mkdir(CARPETA_IMAGENES);
                }
    
                //Guarda la imagen en el servidor, en la carpeta guardada en la url y el nombre unico de la imagen
                $imagen->save(CARPETA_IMAGENES . $nombreImagen);
    
                //Ejecutando codigo para guardar la propiedad en la base de datos
                $resultado = $propiedad->guardar();
                
                //En caso de que haya un resultado=true entonces redirecciono al admin y genera la alerta de agregado exitosamente
    
            }
            
        }

        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router){
        $id = validarORedireccionar('/admin');
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();
        $propiedad = Propiedad::find($id);

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //Asignar los atributos
            $args = $_POST['propiedad'];
            $propiedad->sincronizar($args);
            
            //Subida de archivos
            //Generar un nombre unico para la imagen
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
    
            //Validacion
            $errores = $propiedad->validar();
            
    
            if($_FILES['propiedad']['tmp_name']['imagen']){
                $manager = new ImageManager(new Driver());
                $imagen = $manager->read($_FILES['propiedad']['tmp_name']['imagen'])->cover(800,600);
                $propiedad->setImagen($nombreImagen);
            }
            
            //Revisar que el arreglo de errores este vacio
            if(empty($errores)){
                if($_FILES['propiedad']['tmp_name']['imagen']){
    
                //Guarda la imagen en el servidor, en la carpeta guardada en la url y el nombre unico de la imagen
    
                    $imagen->save(CARPETA_IMAGENES . $nombreImagen);
                }
    
                //Ejecutando codigo para guardar la propiedad en la base de datos
                $propiedad->guardar();
            }
        }

        $router->render('/propiedades/actualizar', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function eliminar(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT); //Este codigo es para evitar que alguien coloque sql mal intencionado
            if($id){
                $tipo = $_POST['tipo'];
                if(validarContenido($tipo)){
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }   
            }
        }
    }
}

