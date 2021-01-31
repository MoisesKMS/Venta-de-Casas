<?php

function conectarDB() : mysqli{
    
    $db = mysqli_connect('localhost', 'root', 'root', 'bienes_raices');

    if(!$db){
        echo 'No fue posible conectarse a la Base de Datos';
        exit;
    }

    return $db;
}