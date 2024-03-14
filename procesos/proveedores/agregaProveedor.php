<?php

    require_once "../../clases/conexion.php";
    require_once "../../clases/proveedores.php";
    
    $obj= new proveedores();
    
    $datos=array(
        $_POST['nombre'],
        $_POST['materiaPrima'],
        $_POST['contacto'],
        $_POST['direccion']
    );
    
    echo $obj->agregaProveedor($datos);

?>