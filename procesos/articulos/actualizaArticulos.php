<?php

    require_once "../../clases/conexion.php";
    require_once "../../clases/articulos.php";

    $obj= new articulos();


    $datos=array(
    $_POST['idArticulo'],
    $_POST['updNombre'],
    $_POST['updDesc'],
    $_POST['updStock'],
    $_POST['updCosto'],
    $_POST['updPrecio'],
    $_POST['updCatSelect']
    );

    echo $obj->actualizaArticulo($datos);




?>