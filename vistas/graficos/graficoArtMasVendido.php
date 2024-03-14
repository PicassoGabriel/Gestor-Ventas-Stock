<?php
    // Conexión a la base de datos
    require_once "../../clases/conexion.php";

    $c = new conectar();
    $conexion = $c->conexion();

    // Consulta SQL para obtener el producto más vendido
    $sql = "SELECT 
                ve.id_articulo,
                art.nombre AS nombre_producto,
                COUNT(*) AS total_ventas
            FROM ventas AS ve
            INNER JOIN articulos AS art ON ve.id_articulo = art.id_articulo
            GROUP BY ve.id_articulo
            ORDER BY total_ventas DESC ";

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