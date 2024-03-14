<?php

    require_once "../../clases/conexion.php";
    require_once "../../clases/categorias.php";

    $id=$_POST['idCategoria'];

    $obj= new categorias();

    echo $obj->eliminaCategoria($id);
?>