<?php
    // Conexión a la base de datos
    require_once "../../clases/conexion.php";

    $c = new conectar();
    $conexion = $c->conexion();

    // Consulta SQL para obtener los datos de ventas por mes
    $sql = "SELECT 
                MONTH(fechaVenta) AS mes_numero,
                MONTHNAME(fechaVenta) AS nombre_mes,
                COUNT(*) AS total_ventas
            FROM ventas
            GROUP BY mes_numero";

    // Ejecutar la consulta
    $result = mysqli_query($conexion, $sql);

    // Array para almacenar los datos
    $data = array();

    // Recorrer los resultados y guardarlos en el array
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    // Convertir el array a formato JSON y enviarlo como respuesta
    echo json_encode($data);
?>