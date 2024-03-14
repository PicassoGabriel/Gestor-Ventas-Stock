<?php

// Cargamos la librería dompdf que hemos instalado en la carpeta dompdf
require_once "../../librerias/dompdf/autoload.inc.php";
use Dompdf\Dompdf;

$id_venta = $_GET['id_venta'];

// Obtener el contenido HTML del archivo reciboVenta.php
$html = file_get_contents("http://localhost/proyectoFinal/vistas/ventas/reciboVenta.php?id_venta=" . urlencode($id_venta));

// Convertir la codificación de caracteres a UTF-8
$html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');

// Instanciar un objeto de la clase DOMPDF.
$pdf = new Dompdf();

// Definir el tamaño y orientación del papel que queremos.
$pdf->set_paper("letter", "portrait");

// Cargar el contenido HTML.
$pdf->load_html($html);

// Renderizar el documento PDF.
$pdf->render();

// Limpiar el búfer de salida para evitar cualquier salida no deseada.
ob_clean();

// Enviamos el fichero PDF al navegador.
$pdf->stream('reciboVenta.pdf');
?>