<?php

    require_once "../../clases/conexion.php";
    require_once "../../clases/proveedores.php";

    $obj= new proveedores();

    $datos=array(
        $_POST['idUpdProveedor'],
        $_POST['updNombre'],
        $_POST['updMateriaPrima'],
        $_POST['updContacto'],
        $_POST['updDireccion']
    );

    echo $obj->actualizaProveedor($datos);

?>