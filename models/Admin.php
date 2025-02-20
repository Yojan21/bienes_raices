<?php

namespace Model;

class Admin extends ActiveRecord{
    //Base de datos
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'email', 'password'];

    public $id;
    public $email;
    public $password;

    public function __construct($args=[])
    {
        $this->id = $args['id'] ?? null;
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
    }

    public function validar(){
        if(!$this->email){
            self::$errores[] = 'El email es obligatorio';
        }

        if(!$this->password){
            self::$errores[] = 'El password es obligatorio';
        }

        return self::$errores;
    }

    public function crearUsuario(){
        $password = password_hash($this->password, PASSWORD_DEFAULT);
        $query = "INSERT INTO " . self::$tabla . " (email, password) VALUES ('$this->email', '$password');";

        $resultado = self::$db->query($query);
        if($resultado){
            //Redireccionar al Usuario, solo se puede hacer antes de colocar cualquier cosa de HTML esto se hace con el fin de que al enviar el formulario se cambie la pestaña y no se envie muchas veces la misma información
            header('location: /admin?resultado=1');
        }
    }

    public function existeusuario(){
        //revisar si un usuario existe o no
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";

        $resultado = self::$db->query($query);

        if(!$resultado->num_rows){
            self::$errores[] = 'El Usuario no existe';
            return;
        }
        return $resultado;
    }

    public function comprobarPassword($resultado){
        $usuario = $resultado->fetch_object();
        $autenticado = password_verify($this->password, $usuario->password);

        if(!$autenticado){
            self::$errores[] = 'El password es incorrecto';
        }
        return $autenticado;
    }

    public function autenticarUsuario(){
        session_start();
        //llenar el arreglo
        $_SESSION['usuario'] = $this->email;
        $_SESSION['login'] = true;
        header('Location: /admin');
    }
}