<?php
require_once "../../clases/conexion.php";
require_once "../../clases/ventas.php";

// Verificar si se recibió una solicitud POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se recibió el parámetro 'idVenta'
    if(isset($_POST['idVenta'])) {
        // Acceder al valor del parámetro 'idVenta'
        $idVenta = $_POST['idVenta'];
        
        // Crear una instancia de la clase ventas
        $obj= new ventas();

        // Intentar eliminar la venta
        $resultado = $obj->eliminaVenta($idVenta);

        // Verificar si la eliminación fue exitosa
        if($resultado) {
            echo "1"; // Se eliminó correctamente
        } else {
            echo "0"; // Error al eliminar
        }
    } else {
        echo "No se recibió el ID de la venta."; // Mostrar mensaje si no se recibió 'idVenta'
    }
} else {
    echo "No se recibió una solicitud POST."; // Mostrar mensaje si no se recibió una solicitud POST
}
?>