<?php
    require_once "../../clases/conexion.php";
    require_once "../../clases/categorias.php";

   

    $datos=array(
         $_POST['idCategoria'],
         $_POST['catUpdate']
    );
    
    $obj= new categorias();

    echo $obj->actualizaCategoria($datos);
?>