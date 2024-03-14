<?php
    require_once "../../clases/conexion.php";
    $c= new conectar();
    $conexion=$c->conexion();

    $sql="SELECT id_categoria, nombre_categoria FROM `categorias` ";

    $result=mysqli_query($conexion,$sql);

?>

<div class="table-responsive">
    <table class="table table-hover table-condensed table-bordered" style="text-align: center">
        <tr>
            <td>Categorias</td>
            <td>Editar</td>
            <td>Eliminar</td>
        </tr>

        <?php
            while($read=mysqli_fetch_row($result)):
        ?>

        <tr>
            <td><?php echo $read[1]?></td>
            <td>
                <span class="btn btn-warning btn-sm"  data-toggle="modal" data-target="#updateCategoria" onclick="agregaDato('<?php echo $read[0]?>','<?php echo $read[1]?>')">
                    <i class="fas fa-pencil-alt"></i>
                </span>
            </td>
            <td>
                <span class="btn btn-danger btn-sm" onclick="eliminaCategoria('<?php echo $read[0]?>')">
                    <i class="fas fa-trash-alt"></i>
                </span>
            </td>
        </tr>
        <?php endwhile;?>
    </table>
</div>