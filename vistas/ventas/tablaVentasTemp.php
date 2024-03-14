<?php

session_start();

?>

<h4>Cargar Venta</h4>
<h5><strong><div id="nombreClienteVenta"></div></strong></h5>

<table class="table-bordered table-hover table-condensed" style="text-align:center">
    
    <caption>
        <span class="btn btn-success btn-sm" onclick="crearVenta()"> Generar Venta 
            <i class="bi bi-currency-dollar"></i> 
        </span>
    </caption>

    <tr>
        <td>Nombre</td>
        <td>Descripción</td>
        <td>Cantidad</td>
        <td>Precio</td>
        <td>Quitar</td>
    </tr>

    <?php

    $total = 0; // Variable para almacenar el total de la compra
    $cliente="";

    if(isset($_SESSION['tablaVentasTemp'])):
        $i=0;
        foreach(@$_SESSION['tablaVentasTemp'] as $key):

            $dato = isset($key) && is_string($key) ? explode("||", $key) : array();
    ?>

    <tr>
        <td><?php echo $dato[1]?></td>
        <td><?php echo $dato[2]?></td>
        <td><?php echo 1 ?></td>
        <td><?php echo $dato[3]?></td>
        <td>
            <span class="btn btn-danger btn-xs" onclick="quitarProducto('<?php echo $i;?>')">
                <i class="fas fa-trash-alt"></i>
            </span>
        </td>
    </tr>

    <?php
        $total= $total + $dato[3];
        $i++;
        $cliente=$dato[4];
        endforeach;
    endif;
    ?>

    <tr>
        <td>Total de Venta: <?php echo "$".$total;?></td>
    </tr>
</table>

<script type="text/javascript">

    $(document).ready(function(){
        nombre="<?php echo @$cliente ?>";
        $('#nombreClienteVenta').text("Cliente: " + nombre);
    });

</script>