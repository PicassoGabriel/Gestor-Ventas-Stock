<?php

    require_once "../../clases/conexion.php";
    require_once "../../clases/clientes.php";

    $obj= new clientes();

    $datos=array(
        $_POST['idUpdCliente'],
        $_POST['updNombre'],
        $_POST['updContacto']
    );

    echo $obj->actualizaCliente($datos);

?>