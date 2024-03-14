<?php
    session_start();

    if(isset($_SESSION['usuario'])) {
        require_once "../clases/conexion.php"; 
        $c = new conectar();
        $conexion = $c->conexion();
        $sql = "SELECT id_categoria, nombre_categoria FROM `categorias`";
        $result_categorias = mysqli_query($conexion, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARTICULOS</title>
    <?php require_once "dependencias.php"; ?>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="../vistas/inicio.php">
      <img src="..\img\logo_princesa-removebg-preview.png" alt="" width="30" height="30" class="d-inline-block align-top">
      DECOPRINCE
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 navbar-light">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../vistas/inicio.php">INICIO</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              PROVEEDORES
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="../vistas/proveedores.php">PROVEEDORES</a></li>
            <li><a class="dropdown-item" href="../vistas/materiales.php">MATERIALES</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              ARTICULOS
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="../vistas/categorias.php">CATEGORIAS</a></li>
            <li><a class="dropdown-item" href="../vistas/articulos.php">ARTICULOS</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../vistas/clientes.php">CLIENTES</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../vistas/ventas.php">VENTAS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../index.php">SALIR</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="container">
    <br>
    <br>
    <h1>Articulos</h1>
    <div class="row">
        <div class="col-sm-4">
            <form id="frmArticulos" method="POST" enctype="multipart/form-data">
                <label>Categoria</label>
                <select class="form-control input-sm" id="categoriaSelect" name="categoriaSelect">
                    <option value="A">Selecciona Categoria</option>
                    <?php while($read = mysqli_fetch_row($result_categorias)): ?>
                        <option value="<?php echo $read[0]; ?>"><?php echo $read[1]; ?></option>
                    <?php endwhile; ?>
                </select>
                <label>Nombre</label>
                <input type="text" class="form-control input-sm" id="nombre" name="nombre" autocomplete="off">
                <label>Descripción</label>
                <input type="text" class="form-control input-sm" id="descripcion" name="descripcion" autocomplete="off">
                <label>Stock</label>
                <input type="number" class="form-control input-sm" id="stock" name="stock" autocomplete="off">
                <label>Costo de Producción</label>
                <input type="number" class="form-control input-sm" id="costo" name="costo" autocomplete="off">
                <label>Precio de Venta</label>
                <input type="number" class="form-control input-sm" id="precio" name="precio" autocomplete="off">
                <br>
                <label>Imagen</label>
                <br>
                <input type="file" id="imagen" name="imagen">
                <br>
                <br>
                <span id="btnAgregarArticulo" class="btn btn-primary">Agregar</span>
                <a href="../vistas/articulos/stockArticulos.php" class="btn btn-danger" id="btnFichaStock">
                  Descargar  ficha de Inventario
                </a>
                
            </form>
        </div>
        <div class="col-sm-8">
            <div id="tablaArticulosLoad"></div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="abreModalUpdArt" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Actualiza Articulo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="frmUpdArt" method="POST">
                    <input type="text" id="idArticulo" hidden="" name="idArticulo">
                    <label>Categoria</label>
                    <select class="form-control input-sm" id="updCatSelect" name="updCatSelect">
                        <option value="A">Selecciona Categoria</option>
                        <?php mysqli_data_seek($result_categorias, 0); // Reinicia el puntero del resultado ?>
                        <?php while($read = mysqli_fetch_row($result_categorias)): ?>
                            <option value="<?php echo $read[0]; ?>"><?php echo $read[1]; ?></option>
                        <?php endwhile; ?>
                    </select>
                    <label>Nombre</label>
                    <input type="text" class="form-control input-sm"  autocomplete="off" id="updNombre" name="updNombre">
                    <label>Descripción</label>
                    <input type="text" class="form-control input-sm" autocomplete="off"  id="updDesc" name="updDesc">
                    <label>Stock</label>
                    <input type="number" class="form-control input-sm" autocomplete="off" id="updStock" name="updStock">
                    <label>Costo de Producción</label>
                    <input type="number" class="form-control input-sm" autocomplete="off"  id="updCosto" name="updCosto">
                    <label>Precio de Venta</label>
                    <input type="number" class="form-control input-sm" autocomplete="off" id="updPrecio" name="updPrecio">
                    <br>
                    <br>
                </form>
            </div>
            <div class="modal-footer">
                <button  id="btnUpdateArt" type="button" class="btn btn-warning" data-dismiss="modal">Actualizar</button>
            </div>
        </div>
    </div>
</div>

</body>

</html>

<script type="text/javascript">
  function agregaDatosArticulo(idarticulo){
    $.ajax({
            type:"POST",
            data:"idart=" + idarticulo,
            url:"../procesos/articulos/obtenerDatosArticulos.php",
            success:function(r){

              dato=$.parseJSON(r);

              $('#idArticulo').val(dato['id_articulo']);
              $('#updCatSelect').val(dato['id_categoria']);
              $('#updNombre').val(dato['nombre']);
              $('#updDesc').val(dato['descripcion']);
              $('#updStock').val(dato['stock']);
              $('#updCosto').val(dato['costo_total']);
              $('#updPrecio').val(dato['precio_venta']);
            }
        });
  }

  function eliminaArticulo(idarticulo){
    alertify.confirm('¿Desea eliminar este articulo?', 
    function(){
        $.ajax({
            type:"POST",
            data:"idarticulo= " + idarticulo,
            url:"../procesos/articulos/eliminaArticulo.php",
            success:function(r){
              console.log("Respuesta del servidor:", r);

              if(r==1){
                $('#tablaArticulosLoad').load("../vistas/articulos/tablaArticulos.php");
                alertify.alert("Articulo eliminado correctamente");
              }else{
                alertify.alert("Error al eliminar");
              }
            }
        }); 
      }, 
    function(){ alertify.alert('Eliminar Cancelado')});

  }

</script>

<script type="text/javascript">
    $(document).ready(function(){
      $('#btnUpdateArt').click(function(){
        datos=$('#frmUpdArt').serialize();
        $.ajax({
            type:"POST",
            data:datos,
            url:"../procesos/articulos/actualizaArticulos.php",
            success:function(r){
              if(r==1){
                $('#tablaArticulosLoad').load("../vistas/articulos/tablaArticulos.php");
                alertify.alert("Articulo actualizado con exito");
              }else{
                alertify.alert("Error al actualizar");
              }

            }
        });
    });

    })

</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#categoriaSelect').select2();
        $('#tablaArticulosLoad').load("../vistas/articulos/tablaArticulos.php");

        $('#btnAgregarArticulo').click(function(){

            vacios=validarFormVacio('frmArticulos');

            if(vacios>0){
                alertify.alert("Debes llenar todos los campos!!");
                return false;
            }
        
            var formData = new FormData(document.getElementById("frmArticulos"));

            $.ajax({
                url: "../procesos/articulos/insertaArticulos.php",
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
              
                success:function(r){
                    if(r == 1){
                        $('#tablaArticulosLoad').load('../vistas/articulos/tablaArticulos.php');
                        $('#frmArticulos')[0].reset();
                        alertify.alert("Articulo agregado con exito");
                    }else{
                        alertify.alert("Error al agregar el articulo");
                    }
                }
            });
        });
    });
</script>

<?php
    }else{
        session_unset();
        header("location:../index.php");
        exit;
    }

?>