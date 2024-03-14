<?php
    require_once "../../clases/conexion.php";

    $c= new conectar();
    $conexion= $c->conexion();

    $sql="SELECT * FROM `proveedor`";

    $result=mysqli_query($conexion,$sql);
?>


<div class="table-responsive">
    <table class="table table-hover table-condensed table-bordered" style="text-align: center">
        <tr>
            <td>Nombre</td>
            <td>Materia Prima</td>
            <td>Contacto</td>
            <td>Dirección</td>
            <td>Editar</td>
            <td>Eliminar</td>
        </tr>

        <?php while($read=mysqli_fetch_row($result)):?>

        <tr>
            <td><?php echo $read[1]?></td>
            <td><?php echo $read[2]?></td>
            <td><?php echo $read[3]?></td>
            <td><?php echo $read[4]?></td>
            <td>
                <span class="btn btn-warning btn-sm" data-toggle="modal" data-target="#abreModalUpdProveedor"
                  onclick="agregaDatosProveedor('<?php echo $read[0]?>')">
                    <i class="fas fa-pencil-alt"></i>
                </span>
            </td>
            <td>
                <span class="btn btn-danger btn-sm" onclick="eliminaProveedor('<?php echo $read[0]?>')">
                    <i class="fas fa-trash-alt"></i>
                </span>
            </td>
        </tr>

        <?php endwhile;?>
    </table>

</div>