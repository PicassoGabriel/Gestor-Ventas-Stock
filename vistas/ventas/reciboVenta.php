<?php

    require_once "../../clases/conexion.php";
    require_once "../../clases/ventas.php";


    $objV= new ventas();
    $c= new conectar();
    $conexion=$c->conexion();

    
    $id_venta= $_GET['id_venta'];

    $sql="SELECT ve.id_venta, ve.fechaVenta, ve.id_cliente, art.nombre, art.precio_venta, art.descripcion, ve.forma_pago, usr.nombre AS nombre_usuario
          FROM ventas AS ve
          INNER JOIN articulos AS art ON ve.id_articulo = art.id_articulo
          INNER JOIN usuarios AS usr ON ve.id_usuario = usr.id_usuario
          AND ve.id_venta='$id_venta'";

    $result=mysqli_query($conexion,$sql);

    // Verificar si la consulta devolvió resultados
    if ($result && mysqli_num_rows($result) > 0) {
        $fila = mysqli_fetch_row($result);
        $folio = $fila[0];
        $fecha = $fila[1];
        $cliente=$fila[2];
        $formaPago=$fila[6];
        $usuario=$fila[7];
        // Aquí puedes continuar extrayendo los demás datos que necesites
    } else {
        // Manejar el caso en que no se encuentren resultados
        echo "No se encontraron resultados para la venta con ID: $id_venta";
        exit; // Detener la ejecución del script
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibo Deco Prince</title>
    <link rel="stylesheet" type="text/css" href="../librerias/bootstrap/css/bootstrap.css">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin: auto;
        }

        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        
        .fecha {
        margin-right: 350px;
        }
        .formaPago{
            margin-right: 400px;
        }

    </style>
</head>
<body>
    
    <br>

    <table>
        <tr>
            <th colspan="2">Deco Prince</th>
        </tr>
        <tr>
            <td>CUIL:</td>
            <td>000111222</td>
        </tr>
        <tr>
            <td>Domicilio:</td>
            <td>Calle Falsa 123</td>
        </tr>
    </table>
    <div class="container">
        <table>
            <tr>
                <td><span class="fecha">Fecha: <?php echo $fecha; ?></span> Factura Tipo B Consumidor Final</td>
            </tr>
            <tr>
                <td><span class="formaPago">Venta Nº: <?php echo $folio; ?></span> Metodo de Pago: <?php echo $formaPago;?></td>
            </tr>
            <tr>
                <td>Usuario: <?php echo $usuario;?></td>
            </tr>
            <tr>
                
            <td><span class="formaPago">Cliente: <?php echo $objV->nombreCliente($cliente);?> </span></td>
            </tr>
        </table>
        <br>
        <br>
        <table>
            <tr>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Descripcion</th>
            </tr>

            <?php

                $sql="SELECT ve.id_venta, ve.fechaVenta, ve.id_cliente, art.nombre, art.precio_venta, art.descripcion
                FROM ventas AS ve
                INNER JOIN articulos AS art
                ON ve.id_articulo=art.id_articulo
                AND ve.id_venta='$id_venta'";

                $result=mysqli_query($conexion,$sql);

                $total=0;

                while($read=mysqli_fetch_row($result)):

            ?>

            <tr>
            <td><?php echo $read[3]?></td>
            <td><?php echo $read[4]?></td>
            <td>1</td>
            <td><?php echo $read[5]?></td>
            </tr>
            <?php
                    $total= $total +  $read[4];
                endwhile;
            ?>
             <tr>
                <td>Total: $<?php echo $total;?></td>
             </tr>
        </table>
    </div>
    <br>
    <h5>Gracias por su compra</h5>
</body>
</html>