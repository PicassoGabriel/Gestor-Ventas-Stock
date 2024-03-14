<?php
    session_start();
    require_once "../../clases/conexion.php";
    require_once "../../clases/categorias.php";

    $obj= new categorias();

    $categoria=$_POST['categoria'];
    $fecha=date("Y-m-d");
    $idUsuario=$_SESSION['iduser'];

    $datos=array(
        $categoria,
        $fecha,
        $idUsuario
   
    );

    

    echo $obj->agregaCategoria($datos);
    //$response = $obj->agregaCategoria($datos);
//
    //if ($response) {
    //    echo "Registro exitoso";
    //   
    //} else {
    //    echo "Error al registrar: " . mysqli_error($obj->conexion());
    //}

?>