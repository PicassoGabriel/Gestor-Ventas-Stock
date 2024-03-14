<?php

    require_once "../../clases/conexion.php";
    require_once "../../clases/articulos.php";

    $obj= new articulos();

    $idart=$_POST['idart'];



   echo json_encode( $obj->obtenerDatosArticulos($idart));


?>