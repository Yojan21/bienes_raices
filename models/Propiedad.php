<?php


namespace Model;
require_once 'ActiveRecord.php';

class Propiedad extends ActiveRecord{
    protected static $tabla = 'propiedades';
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion','habitaciones','wc', 'estacionamiento', 'creado', 'vendedor_id'];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $wc;
    public $habitaciones;
    public $estacionamiento;
    public $creado;
    public $vendedor_id;
    
    public function __construct($argc = []){
        $this->id = $argc['id'] ?? null;
        $this->titulo = $argc['titulo'] ?? '';
        $this->precio = $argc['precio'] ?? '';
        $this->imagen = $argc['imagen'] ?? '';
        $this->descripcion = $argc['descripcion'] ?? '';
        $this->habitaciones = $argc['habitaciones'] ?? '';
        $this->wc = $argc['wc'] ?? '';
        $this->estacionamiento = $argc['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedor_id = $argc['vendedor_id'] ?? '';
    }

    public function validar(){
        if(!$this->titulo){
            self::$errores[] = "Debes añadir un titulo";
        }
        if(!$this->precio){
            self::$errores[] = "Debes añadir un precio";
        }
        if(strlen($this->descripcion) < 50){
            self::$errores[] = "La descripcion es obligatoria y debe tener al menos 50 caracteres";
        }
        if(!$this->habitaciones){
            self::$errores[] = "Debes añadir el numero de habitaciones";
        }
        if(!$this->wc){
            self::$errores[] = "Debes añadir el numero de baños";
        }
        
        if(!$this->estacionamiento){
            self::$errores[] = "Debes añadir el numero de estacionamientos";
        }
        
        if(!$this->vendedor_id){
            self::$errores[] = "Elije un vendedor";
        }

        if(!$this->imagen){
            self::$errores[] = "Debes agregar una imagen";
        }
        return self::$errores;
    }

    
}