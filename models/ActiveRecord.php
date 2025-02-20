<?php 

namespace Model;

class ActiveRecord{
    //Base de datos
    protected static $db;
    protected static $columnasDB = [''];
    protected static $tabla = '';

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
    public $nombre;
    public $apellido;
    public $telefono;

    //Errores 
    protected static $errores = [];

    //Definir la conexion a la BD
    public static function setDB($database){
        self::$db = $database;
    }

    public function guardar(){
        
        if(!is_null($this->id)){
            //Actualizar
            $this->actualizar();
        }else{
            //Creando un nuevo registro
            $this->crear();
        }
        
    }

    public function crear(){
        
        //Sanitizar los datos
        $atributos = $this->sanitizarDatos();

        foreach ($atributos as $key => $value) {
            if (in_array($key, ['precio', 'habitaciones', 'wc', 'estacionamiento', 'vendedor_id'])) {
                $atributos[$key] = (int) $value; // Convertir a entero
            }
        }
        
        //Insertar en la base de datos
        $query = "INSERT INTO " . static::$tabla . " (";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES ( '";
        $query .= join("', '", array_values($atributos)) . "'" . ")";
        

        //debuguear($query);
        //Se envia el query
        $resultado = self::$db-> query($query);
        if($resultado){
            //Redireccionar al Usuario, solo se puede hacer antes de colocar cualquier cosa de HTML esto se hace con el fin de que al enviar el formulario se cambie la pestaña y no se envie muchas veces la misma información
            header('location: /admin?resultado=1');
        }
        return $resultado;
    }

    public function actualizar(){
        //Sanitizar los datos
        $atributos = $this->sanitizarDatos();
        foreach ($atributos as $key => $value) {
            if (in_array($key, ['precio', 'habitaciones', 'wc', 'estacionamiento', 'vendedor_id'])) {
                $atributos[$key] = (int) $value; // Convertir a entero
            }
        }

        $valores = [];
        foreach($atributos as $key=>$value){
            $valores[] = "$key='$value'";
        }
        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "'";
        $query .= " LIMIT 1";
        $resultado = self::$db->query($query);
        if($resultado){
                
            //Redireccionar al Usuario, solo se puede hacer antes de colocar cualquier cosa de HTML esto se hace con el fin de que al enviar el formulario se cambie la pestaña y no se envie muchas veces la misma información
            header('location: /admin?resultado=2');
        }
        return $resultado;
    }

    public function eliminar(){
        //Elimina la propiedad
        $query = "DELETE FROM " . static::$tabla . " WHERE id = '" . self::$db->escape_string($this->id) . "' LIMIT 1";
        $resultado = self::$db->query($query);
        if($resultado){
            $this->borrarImagen();
            header('location: /admin?resultado=3');
        }
    }

    public function atributos(){
        $atributos = [];
        foreach(static::$columnasDB as $columna){
            if($columna === 'id') continue; //Ignora el id y pasa al siguiente
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarDatos(){
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach($atributos as $key => $value){
            $sanitizado[$key] = self::$db->escape_string($value); //Evita agregar codigo mal intencionado en el input
        }
        return $sanitizado;
    }

    public static function getErrores(){
        return static::$errores;
    }

    public function validar(){
        static::$errores = [];
        return static::$errores;
    }

    public function setImagen($imagen){
        //Elimina la imagen previa
        if(!is_null($this->id)){
            $this->borrarImagen();
        }
        if($imagen){
            $this->imagen = $imagen;
        }
    }

    public function borrarImagen(){
        //comprobar que existe el archivo
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if($existeArchivo){
            unlink( CARPETA_IMAGENES . $this->imagen);
        }
    }

    //Listar todas las propiedades
    public static function all(){
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);
        //debuguear($resultado);
        return $resultado;
    }

    //Obtiene determinado numero de registros
    public static function get($cantidad){
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    //Busca una propiedad por su id
    public static function find($id){
        //Consulta para obtener datos de propiedades
        $query = "SELECT * FROM " . static::$tabla . " WHERE id= $id";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }

    public static function consultarSQL($query){
        //Consultar la base de datos
        $resultado = self::$db->query($query);

        //Iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()){
            $array[] = static::crearObjeto($registro);
        }
        
        //Liberar la memoria
        $resultado->free();

        //Retornar los resultados
        return $array;
    }

    protected static function crearObjeto($registro){
        $objeto = new static;

        foreach($registro as $key => $value){
            if(property_exists($objeto, $key)){
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }

    //Sincronizar el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar($args = []){
        foreach($args as $key=>$value){
            if(property_exists($this, $key) && !is_null($value)){
                $this->$key = $value; 
            }
        }
    }

}