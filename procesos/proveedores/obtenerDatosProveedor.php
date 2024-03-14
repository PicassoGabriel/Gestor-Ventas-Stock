<?php    
    require_once "../../clases/conexion.php";
    require_once "../../clases/proveedores.php";

    $obj=new proveedores();

    $idproveedor=$_POST['idproveedor'];

    echo json_encode( $obj->obtenerDatosProveedor($idproveedor));

?>