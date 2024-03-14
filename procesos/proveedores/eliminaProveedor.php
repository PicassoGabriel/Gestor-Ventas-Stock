<?php
        require_once "../../clases/conexion.php";
        require_once "../../clases/proveedores.php";
    
        $obj= new proveedores();

        $idProveedor=$_POST['idproveedor'];

        echo $obj->eliminaProveedor($idProveedor);

?>