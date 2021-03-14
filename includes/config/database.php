<?php
function conectarDB() : mysqli{
    
    $db = new mysqli('localhost', 'root', 'root', 'bienes_raices');

    if(!$db){
        echo 'No fue posible conectarse a la Base de Datos';
        exit;
    }

    return $db;
}