<?php

//Importar la conexion
require 'includes/config/database.php';
$db = conectarDB();

//Crear E-mail y PASSWORD
$email = "INSERTE EL CORREO";
$password = "INSERTE LA CONTRASEÑA";

$passwordHash = password_hash($password, PASSWORD_BCRYPT);

//Queri para crear la cuenta
$query = "INSERT INTO usuarios (email, password) VALUES ('${email}', '${passwordHash}')";

echo $query;
exit;
//Obtener los resultados
mysqli_query($db, $query);