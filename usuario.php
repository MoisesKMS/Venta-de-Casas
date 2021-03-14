<?php

/** ELIMINAR ESTE ARCHIVO DESPUES DE EJECUTARLO !!!!!!!!!!!!!**/

//Importar la conexion
require 'includes/app.php';
$db = conectarDB();

//Crear E-mail y PASSWORD
$email = "correo@correo.com"; //CORREO
$password = "Mikuyami18"; //CONTRASEÑA

$passwordHash = password_hash($password, PASSWORD_BCRYPT);

//Queri para crear la cuenta
$query = "INSERT INTO usuarios (email, password) VALUES ('${email}', '${passwordHash}')";

echo $query;
exit; /** BORRAR ESTA LINEA **/
//Obtener los resultados
mysqli_query($db, $query);