<?php   
    session_start();

    require_once "../../clases/conexion.php";
    require_once "../../clases/ventas.php";

    $c= new conectar();
    $conexion= $c->conexion();

    $obj= new ventas();
    
    $sql="SELECT id_venta, fechaVenta, id_cliente , forma_pago  FROM ventas GROUP BY id_venta";

    $result=mysqli_query($conexion,$sql);

?>



<h4>Ventas Hechas</h4>
<br>
<div class="row">
    <div class="col-sm-1"></div>
    <div class="col-sm-10">
        <div class="table-responsive">
            <table class="table table-hover table-condensed table-bordered" style="text-align: center">
                <tr>
                    <td>Venta Nº</td>
                    <td>Fecha de Compra</td>
                    <td>Cliente</td>
                    <td>Total de compra</td>
                    <td>Factura</td>
                    <td>Medio de Pago</td>
                    <td>Recibo</td>
                    <td>Eliminar Venta</td>
                </tr>

                <?php while($read=mysqli_fetch_row($result)):?>

                <tr>
                    <td><?php echo $read[0]?></td>
                    <td><?php echo $read[1]?></td>
                    <td>
                        <?php
                            if($obj->nombreCliente($read[2]) == " "){
                                echo "Sin CLiente";
                            }else{
                                echo $obj->nombreCliente($read[2]);
                            }
                        ?>
                    </td>
                    <td>
                        <?php
                            echo "$".$obj->obtenerTotal($read[0]);
                        ?>
                    </td>
                    <td>Consumidor Final</td>
                    <td><?php echo $read[3]?></td>
                    <td>
                        <a href="../procesos/ventas/crearRecibo.php?id_venta=<?php echo $read[0]?>" class="btn btn-danger btn-sm">
                        <i class="bi bi-receipt"></i>
                        </a>
                    </td>
                    <td>
                        <span class="btn btn-danger btn-sm" onclick="eliminaVenta('<?php echo $read[0]?>')">
                            <i class="fas fa-trash-alt"></i>
                        </span>
                    </td>
                </tr>

                <?php endwhile; ?>

            </table>
        </div>
    </div>
    <div class="col-sm-1"></div>
</div>


<script>
function eliminaVenta(idVenta) {
    alertify.confirm('¿Desea eliminar esta venta?', function() {
        console.log(idVenta);
        $.ajax({
            type: "POST",
            data: "idVenta=" + idVenta,
            url: "http://localhost/proyectoFinal/procesos/ventas/eliminaVenta.php",
            success: function(r) {
                console.log("Respuesta del servidor:", r);

                if (r == 1) {
                    $('#ventasHechas').load("../vistas/ventas/ventasHechas.php");
                    alertify.alert("Venta eliminada correctamente");
                } else {
                    alertify.alert("Error al eliminar");
                }
            }
        });
    }, function() {
        alertify.alert('Eliminar Cancelado');
    });
}
</script> 