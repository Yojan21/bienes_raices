<?php

namespace Model;
require_once 'ActiveRecord.php';

class Vendedor extends ActiveRecord{
    protected static $tabla = 'vendedores';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono'];

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    public function __construct($argc = []){
        $this->id = $argc['id'] ?? null;
        $this->nombre = $argc['nombre'] ?? '';
        $this->apellido = $argc['apellido'] ?? '';
        $this->telefono = $argc['telefono'] ?? '';
    }

    public function validar(){
        if(!$this->nombre){
            self::$errores[] = "Debes añadir un nombre";
        }
        if(!$this->apellido){
            self::$errores[] = "Debes añadir un apellido";
        }
        if(!$this->telefono){
            self::$errores[] = "Debes añadir un teléfono";
        }
        if(!preg_match('/[0-9]{10}/', $this->telefono)){
            self::$errores[] = "Formato de telefono no válido";
        }
        return self::$errores;
    }
}