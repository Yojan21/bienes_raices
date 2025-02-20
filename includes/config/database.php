<?php

function conectarDB(): mysqli{
    $db = new mysqli('localhost', 'yojan', 'passwordroot', 'bienesraices');
    $db->set_charset('utf8');

    if(!$db){
        echo 'Error no se pudo conectar';
        exit;
    }
    return $db;
}