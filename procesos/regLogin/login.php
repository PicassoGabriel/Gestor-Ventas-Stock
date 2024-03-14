<?php


session_start();
require_once "../../clases/conexion.php";
require_once "../../clases/usuarios.php";

$objConexion = new conectar(); // Instancia de la clase conexión
$objUsuarios = new usuarios();

$datos = array($_POST['usuario'], $_POST['password']);

$response = $objUsuarios->loginUser($datos);

if ($response) {
    echo 1;
} else {
    echo "Error al iniciar sesión: Usuario o contraseña incorrectos.";
}

?>
