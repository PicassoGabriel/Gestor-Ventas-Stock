<?php

    require_once "../../clases/conexion.php";
    require_once "../../clases/materiales.php";
    
    $obj= new materiales();
    
    $datos=array(
        $_POST['proveedorSelect'],
        $_POST['producto'],
        $_POST['descripcion'],
        $_POST['precioCompra'],
        $_POST['cantidad']
    );
    
    echo $obj->agregaMateriales($datos);

?>