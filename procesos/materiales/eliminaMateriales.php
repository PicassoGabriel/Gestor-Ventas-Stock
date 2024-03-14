<?php
        require_once "../../clases/conexion.php";
        require_once "../../clases/materiales.php";
    
        $obj= new materiales();

        $idmateriales=$_POST['idmateriales'];

        echo $obj->eliminaMateriales($idmateriales);

?>