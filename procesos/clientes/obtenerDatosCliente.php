<?php    
    require_once "../../clases/conexion.php";
    require_once "../../clases/clientes.php";

    $obj=new clientes();

    $idcliente=$_POST['idcliente'];

    echo json_encode( $obj->obtenerDatosCliente($idcliente));

?>