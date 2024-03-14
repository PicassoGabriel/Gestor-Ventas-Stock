<?php
    require_once "../../clases/conexion.php";

    $c=new conectar();
    $conexion=$c->conexion();

    $sql="SELECT id_cliente, nombre FROM clientes";
    $result=mysqli_query($conexion,$sql);

    $sqlProd="SELECT id_articulo, nombre
              FROM articulos";
    $resultProd=mysqli_query($conexion,$sqlProd);
?>

<h4>Vender Productos</h4>
<div class="row">
    <div class="col-sm-4">
        <form id="frmVentas" method="POST">
            <label>Cliente</label>
            <select class="form-control input-sm" id="clienteVenta" name="clienteVenta">
                <option value="A">Selecciona Cliente</option>
                <?php while($cliente=mysqli_fetch_row($result)): ?>
                    <option value="<?php echo $cliente[0]?>"><?php echo $cliente[1]?></option>
                <?php endwhile; ?>
            </select>
            <label>Producto</label>
            <select class="form-control input-sm" id="productoVenta" name="productoVenta">
                <option value="A">Selecciona Producto</option>
                <?php while($producto=mysqli_fetch_row($resultProd)): ?>
                    <option value="<?php echo $producto[0]?>"><?php echo $producto[1]?></option>
                <?php endwhile; ?>
            </select>
            <label>Descripción</label>
            <textarea readonly="" class="form-control input-sm" id="descripcion" name="descripcion"></textarea>
            <label>Cantidad</label>
            <input  readonly="" type="text" class="form-control input-sm" id="stock" name="stock">
            <label>Precio</label>
            <input readonly="" type="text" class="form-control input-sm" id="precio_venta" name="precio_venta">
            <label>Ingrese Medio de Pago:</label>
            <input type="text" class="form-control input-sm" id="formaPago" name="formaPago" autocomplete="off">
            <br>
            <br>
            <span class="btn btn-primary" id="btnAgregarVenta">Agregar</span>
            <span class="btn btn-danger" id="btnVaciarTabla">Vaciar Tabla</span>
        </form>
    </div>
    <div class="col-sm-6">
        <div id=tablaVentasTempLoad></div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function(){

        $('#tablaVentasTempLoad').load("ventas/tablaVentasTemp.php");

        $('#productoVenta').change(function(){
            console.log("Cambio de producto detectado");
            $.ajax({
            type:"POST",
            data:"idproducto=" + $('#productoVenta').val(),
            url:"http://localhost/proyectoFinal/procesos/ventas/llenarFrmProducto.php",
            success:function(r){
                console.log("Datos recibidos del servidor:", r);
                dato=$.parseJSON(r);
                $('#descripcion').val(dato['descripcion']);
                $('#stock').val(dato['stock']);
                $('#precio_venta').val(dato['precio_venta']);
                $('#formaPago').val(dato['formaPago']);
                $('#imgProducto').prepend('<img class="img-thumbnail" id="imgp" src="'+dato['ruta']+'"/>');
            },
            error: function(xhr, status, error) {
                console.error("Error en la solicitud AJAX:", error);
            }
        });
        });


        $('#btnAgregarVenta').click(function () {
      
        datos = $('#frmVentas').serialize();
        $.ajax({
            type: "POST",
            data: datos,
            url: "http://localhost/proyectoFinal/procesos/ventas/agregaProductoTemp.php",
            success: function (r) {
                $('#tablaVentasTempLoad').load("ventas/tablaVentasTemp.php");
            }
        });
    });

    $('#btnVaciarTabla').click(function(){

        $.ajax({
            url:"http://localhost/proyectoFinal/procesos/ventas/vaciarTemp.php",
            success:function(r){
                $('#tablaVentasTempLoad').load("ventas/tablaVentasTemp.php");
            }
        });
    });
    });

</script>

<script type="text/javascript">
    function quitarProducto(index){
        $.ajax({
            type:"POST",
            data:"index=" + index,
            url:"http://localhost/proyectoFinal/procesos/ventas/quitarProducto.php",
            success:function(r){
                $('#tablaVentasTempLoad').load("ventas/tablaVentasTemp.php");
                alertify.alert("Producto quitado con exito");
            }
        });
    }

    function crearVenta(){
        $.ajax({
            url:"http://localhost/proyectoFinal/procesos/ventas/crearVenta.php",
            success:function(r){
                if(r > 0){
                    $('#tablaVentasTempLoad').load("ventas/tablaVentasTemp.php");
                    $('#frmVentas')[0].reset();
                    alertify.alert("Venta creada con exito, consulte la información  en la pestaña Ver Ventas");
                }else if(r == 0){
                    alertify.alert("No hay lista de venta");
                }else{
                    alertify.alert("No se pudo crear la venta");
                }
            }
        });
    }


</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#clienteVenta').select2();
        $('#productoVenta').select2();
    });
</script>