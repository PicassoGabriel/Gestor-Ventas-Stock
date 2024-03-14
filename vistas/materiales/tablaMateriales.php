<?php

    require_once "../../clases/conexion.php";

    $c=new conectar();
    $conexion=$c->conexion();

    $sql="SELECT m.id_compra,m.producto, m.descripcion, m.precio_compra, m.cantidad, m.fecha_creacion, p.nombre AS nombre_proveedor, p.materia_prima
    FROM materiales AS m
    INNER JOIN proveedor AS p ON m.id_proveedor = p.id_proveedor";



    $result=mysqli_query($conexion,$sql);


?>



<div class="table-responsive">
    <table class="table table-hover table-condensed table-bordered" style="text-align: center">
        <tr>
            <td>Proveedor</td>
            <td>Mat. Prima</td>
            <td>Producto</td>
            <td>Descripción</td>
            <td>Precio de Compra</td>
            <td>Stock</td>
            <td>Fecha de Compra</td>
            <td>Editar</td>
            <td>Eliminar</td>
        </tr>
        <?php while($read=mysqli_fetch_row($result)): ?>
        <tr>
            <td><?php echo $read[6]; ?></td>
            <td><?php echo $read[7]; ?></td>
            <td><?php echo $read[1]; ?></td>
            <td><?php echo $read[2]; ?></td>
            <td><?php echo $read[3]; ?></td>
            <td><?php echo $read[4]; ?></td>
            <td><?php echo $read[5]; ?></td>
            <td>
                <span data-toggle="modal" data-target="#abreModalUpdMateriales" class="btn btn-warning btn-sm" onclick="obtenerDatosMateriales('<?php echo $read[0]?>')">
                    <i class="fas fa-pencil-alt"></i>
                </span>
            </td>
            <td>
                <span class="btn btn-danger btn-sm" onclick="eliminaMateriales('<?php echo $read[0]?>')">
                    <i class="fas fa-trash-alt"></i>
                </span>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

</div>