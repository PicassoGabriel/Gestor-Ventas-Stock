<?php
    require_once "../../clases/conexion.php";
    
    $c=new conectar();
    $conexion=$c->conexion();

    $sql="SELECT art.nombre, art.descripcion, art.stock, art.costo_total, art.precio_venta, img.ruta, cat.nombre_categoria, art.id_articulo
          FROM articulos AS art
          INNER JOIN imagenes AS img ON art.id_imagen = img.id_imagen
          INNER JOIN categorias AS cat
          ON art.id_categoria=cat.id_categoria";

    $result=mysqli_query($conexion,$sql);


?>



<div class="table-responsive">
    <table class="table table-hover table-condensed table-bordered" style="text-align: center">
        <tr>
            <td>Nombre</td>
            <td>Descripción</td>
            <td>Stock</td>
            <td>Costo Producción</td>
            <td>Precio Venta</td>
            <td>Imagen</td>
            <td>Categoria</td>
            <td>Editar</td>
            <td>Eliminar</td>
        </tr>
        <?php while($read=mysqli_fetch_row($result)): ?>
        <tr>
            <td><?php echo $read[0]; ?></td>
            <td><?php echo $read[1]; ?></td>
            <td><?php echo $read[2]; ?></td>
            <td><?php echo $read[3]; ?></td>
            <td><?php echo $read[4]; ?></td>
            <td>
                <?php 
                $imgRead=explode("/",$read[5]);
                $imgRuta=$imgRead[1]."/".$imgRead[2]."/".$imgRead[3];
                ?>
                <img src="<?php echo $imgRuta ?>" width="100" height="100">
            </td>
            <td><?php echo $read[6]?></td>
            <td>
                <span data-toggle="modal" data-target="#abreModalUpdArt" class="btn btn-warning btn-sm" onclick="agregaDatosArticulo('<?php echo $read[7]?>')">
                    <i class="fas fa-pencil-alt"></i>
                </span>
            </td>
            <td>
                <span class="btn btn-danger btn-sm" onclick="eliminaArticulo(<?php echo $read[7]?>)">
                    <i class="fas fa-trash-alt"></i>
                </span>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>