
<?php

    require_once "../../clases/conexion.php";
    require_once "../../clases/ventas.php";

    $idproducto= $_POST['idproducto'];
    
    $obj= new ventas();

    echo json_encode($obj->obtenDatosProducto($idproducto));

?>
