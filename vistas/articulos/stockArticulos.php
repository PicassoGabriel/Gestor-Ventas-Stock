
<?php
require_once "../../clases/conexion.php";
require_once "../../librerias/dompdf/autoload.inc.php"; // Ruta al archivo de autoloading de DOMPDF
use Dompdf\Dompdf;

// Obtener todos los productos y su información de stock desde la base de datos
 
$fecha_actual = date('Y-m-d');

$c = new conectar();
$conexion = $c->conexion();

$sql = "SELECT art.id_articulo, art.nombre, art.descripcion, art.stock, art.costo_total, art.fecha_creacion, cat.nombre_categoria
        FROM articulos AS art
        INNER JOIN categorias AS cat
        ON art.id_categoria= cat.id_categoria";
$result = mysqli_query($conexion, $sql);

if (!$result) {
    echo "Error al obtener los detalles de los productos.";
    exit();
}

// Generar el contenido HTML para el PDF
$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficha Articulos</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>
    <h1>Ficha de Stock: ' . $fecha_actual . '</h1>
    <h3>Articulos</h3>
    <table border="1">
        <tr>
            <th>Categoria</th>
            <th>Nombre</th>
            <th>Descipcion</th>
            <th>Stock Actual</th>
            <th>Costo de Producción</th>
            <th>Fecha de Creacion</th>
        </tr>';
while ($producto = mysqli_fetch_assoc($result)) {
    $html .= '
        <tr>
            <td>' . $producto['nombre_categoria'] .'</td>
            <td>' . $producto['nombre'] . '</td>
            <td>' . $producto['descripcion'] . '</td>
            <td>' . $producto['stock'] . '</td>
            <td>' . $producto['costo_total'] . '</td>
            <td>' . $producto['fecha_creacion'] . '</td>
        </tr>';
}
$html .= '
    </table>
</body>
</html>';

// Crear una instancia de DOMPDF
$dompdf = new Dompdf();

// Cargar el contenido HTML en DOMPDF
$dompdf->loadHtml($html);

// Renderizar el PDF
$dompdf->render();

// Generar el nombre del archivo PDF
$nombre_archivo = "stock_articulos.pdf";

// Enviar el PDF generado al navegador para su descarga
$dompdf->stream($nombre_archivo);