<?php

    session_start();
    $index=$_POST['index'];
    unset($_SESSION['tablaVentasTemp'][$index]);
    $datos=array_values($_SESSION['tablaVentasTemp']);
    unset($_SESSION['tablaVentasTemp']);
    $_SESSION['tablaVentasTemp']=$datos;
?>