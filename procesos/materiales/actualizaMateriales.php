<?php

    require_once "../../clases/conexion.php";
    require_once "../../clases/materiales.php";

    $obj= new materiales();

    $datos=array(
        $_POST['idUpdMateriales'],
        $_POST['updProducto'],
        $_POST['updDescripcion'],
        $_POST['updPrecioCompra'],
        $_POST['updCantidad']
    );

    echo $obj->actualizaMateriales($datos);

?>