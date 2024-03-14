<?php
    require_once "../../clases/conexion.php";
    require_once "../../clases/usuarios.php";

    $obj= new usuarios();

    $datos=array($_POST['nombre'],
                 $_POST['apellido'],
                 $_POST['correo'],
                 $_POST['usuario'],
                 $_POST['password']);

    //echo $obj->registroUsuario($datos);

    $response = $obj->registroUsuario($datos);

    if ($response) {
        echo "Registro exitoso";
       
    } else {
        echo "Error al registrar: " . mysqli_error($obj->conexion());
    }
?>

