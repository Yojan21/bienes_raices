<?php 

require 'funciones.php';
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';

use Model\ActiveRecord;

//Conectarnos a la BD
$db = conectarDB();
$db->set_charset('utf8');

ActiveRecord::setDB($db);