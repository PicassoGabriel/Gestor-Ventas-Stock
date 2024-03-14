<?php

    require_once "../../clases/conexion.php";
    require_once "../../clases/clientes.php";

    $obj= new clientes();

    $datos=array(
        $_POST['nombre'],
        $_POST['contacto']
    );

    echo $obj->agregaCliente($datos);

?>