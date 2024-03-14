<?php
        require_once "../../clases/conexion.php";
        require_once "../../clases/clientes.php";
    
        $obj= new clientes();

        $idCliente=$_POST['idcliente'];

        echo $obj->eliminaCliente($idCliente);

?>