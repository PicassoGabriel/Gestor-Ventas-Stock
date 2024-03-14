<?php
    session_start();
    $idUser=$_SESSION['iduser'];
    require_once "../../clases/conexion.php";
    require_once "../../clases/articulos.php";

    $obj=new articulos();
    
    $datos=array();

    
   $nombreImg=$_FILES['imagen']['name'];
   $ruta=$_FILES['imagen']['tmp_name'];
   $carpeta='../../archivos/';
   $rutaFinal=$carpeta.$nombreImg;

    $datosImg=array(
        $_POST['categoriaSelect'],
        $nombreImg,
        $rutaFinal
    );

    if(move_uploaded_file($ruta,$rutaFinal)){
        $idImagen=$obj->agregaImagen($datosImg);
        if($idImagen>0){

            $datos[0]=$_POST['nombre'];
            $datos[1]=$_POST['descripcion'];
            $datos[2]=$_POST['stock'];
            $datos[3]=$_POST['costo'];
            $datos[4]=$_POST['precio'];
            $datos[5]=$idImagen;
            $datos[6]= $idUser;
            $datos[7]=$_POST['categoriaSelect'];
            echo $obj->insertaArticulo($datos);

        }else{
            echo 0;
        }

    }

?>