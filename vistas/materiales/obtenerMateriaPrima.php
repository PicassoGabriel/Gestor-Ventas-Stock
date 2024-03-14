<?php
// obtener_materia_prima.php

require_once "../../clases/conexion.php";

if(isset($_POST['id_proveedor'])) {
    $id_proveedor = $_POST['id_proveedor'];
    
    $c = new conectar(); 
    $conexion = $c->conexion(); 
    
    // Consulta para obtener la materia prima del proveedor seleccionado
    $sql_materia_prima = "SELECT materia_prima FROM proveedor WHERE id_proveedor = $id_proveedor";
    $result_materia_prima = mysqli_query($conexion, $sql_materia_prima);
    
    //$options = '<option value="A">Selecciona Materia Prima</option>';
    
    while($row = mysqli_fetch_assoc($result_materia_prima)) {
        $options .= '<option value="'.$row['materia_prima'].'">'.$row['materia_prima'].'</option>';
    }
    
    if (mysqli_num_rows($result_materia_prima) == 0) {
        $options .= '<option value="">No se encontraron materias primas</option>';
    }
    
    echo $options;
}

?>