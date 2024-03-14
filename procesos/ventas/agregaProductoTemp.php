<?php
    session_start();
    require_once "../../clases/conexion.php";

    $c = new conectar();
    $conexion = $c->conexion();

    $idcliente = $_POST['clienteVenta'];
    $idproducto = $_POST['productoVenta'];
    $descripcion = $_POST['descripcion'];
    $cantidad = $_POST['stock'];
    $precio = $_POST['precio_venta'];
    $formaPago = $_POST['formaPago'];
    

    //Consulta SQL CLIENTE
    $sqlCliente = "SELECT id_cliente, nombre FROM clientes WHERE id_cliente= '$idcliente'";
    $resultCliente = mysqli_query($conexion, $sqlCliente);
    $cliente = mysqli_fetch_row($resultCliente)[1];

    //CONSULTA SQL ARTICULO/PRODUCTO
    $sqlProd = "SELECT nombre FROM articulos WHERE id_articulo='$idproducto'";
    $resultProd = mysqli_query($conexion, $sqlProd);
    $producto = mysqli_fetch_row($resultProd)[0];

    $articulo = $idproducto . "||" . $producto . "||" . $descripcion . "||" . $precio . "||" . $cliente . "||" . $idcliente . "||" . $formaPago;

    $_SESSION['tablaVentasTemp'][] = $articulo;



?>