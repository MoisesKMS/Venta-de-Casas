<?php

/** ELIMINAR ESTE ARCHIVO DESPUES DE EJECUTARLO !!!!!!!!!!!!!**/

//Importar la conexion
require 'includes/config/database.php';
$db = conectarDB();

//Crear E-mail y PASSWORD
$email = "INSERTA EL CORREO"; //CORREO
$password = "INSERTA LA CONTRASEÑA"; //CONTRASEÑA

$passwordHash = password_hash($password, PASSWORD_BCRYPT);

//Queri para crear la cuenta
$query = "INSERT INTO usuarios (email, password) VALUES ('${email}', '${passwordHash}')";

echo $query;
exit; /** BORRAR ESTA LINEA **/
//Obtener los resultados
mysqli_query($db, $query);