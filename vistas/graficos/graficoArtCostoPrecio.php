<?php
    // Conexión a la base de datos
    require_once "../../clases/conexion.php";

    $c = new conectar();
    $conexion = $c->conexion();

    // Consulta SQL para obtener los datos
    $sql = "SELECT nombre, costo_total, precio_venta FROM articulos";

    // Ejecutar la consulta
    $result = mysqli_query($conexion, $sql);

    // Array para almacenar los datos
    $data = array();

    // Recorrer los resultados y guardarlos en el array
    while ($row = mysqli_fetch_assoc($result)) {
        // Almacenar los datos en un nuevo array con las claves correspondientes
        $producto = array(
            'nombre' => $row['nombre'],
            'costo_total' => $row['costo_total'],
            'precio_venta' => $row['precio_venta']
        );
        // Agregar el array del producto al array principal de datos
        $data[] = $producto;
    }

    // Convertir el array a formato JSON y enviarlo como respuesta
    echo json_encode($data);
?>