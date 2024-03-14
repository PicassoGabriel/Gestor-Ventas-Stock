<?php
    session_start();

    if(isset($_SESSION['usuario'])){
      require_once "..\clases\conexion.php"; 

      $c = new conectar(); 
      $conexion = $c->conexion(); 

      // Consulta para obtener los proveedores
      $sql_proveedor = "SELECT id_proveedor, nombre FROM proveedor"; 
      $result_proveedor = mysqli_query($conexion, $sql_proveedor);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materiales</title>
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
<br>
<br>
<div class="container">
  <h1>Materiales</h1>
  <div class="row">
     <div class="col-sm-4">
      <form id="frmMateriales" method="POST">
        <label>Nombre del Proveedor</label>
          <select class="form-control input-sm" id="proveedorSelect" name="proveedorSelect">
            <option value="A">Selecciona Proveedor</option>
            <?php while($row = mysqli_fetch_assoc($result_proveedor)): ?>
             <option value="<?php echo $row['id_proveedor']; ?>"><?php echo $row['nombre']; ?></option>
            <?php endwhile; ?>
          </select>

        <label>Materia Prima</label>
          <select class="form-control input-sm" id="materiaPrimaSelect" name="materiaPrimaSelect">
            <option value="A">Selecciona Materia Prima</option>
          </select>
        <br>
        <label>Producto</label>
        <input type="text" class="form-control input-sm" id="producto" name="producto" autocomplete="off">
        <label>Descripción</label>
        <input type="text" class="form-control input-sm" id="descripcion" name="descripcion" autocomplete="off">
        <label>Precio de Compra</label>
        <input type="number" class="form-control input-sm" id="precioCompra" name="precioCompra" autocomplete="off">
        <label>Stock</label>
        <input type="number" class="form-control input-sm" id="cantidad" name="cantidad" autocomplete="off">
        <br>
        <br>
        <span class="btn btn-primary" id="btnAgregarMateriales">Agregar</span>
        <a href="../vistas/materiales/stockMateriales.php" class="btn btn-danger" id="btnFichaStockMat">
          Descargar Inventario de Materiales
        </a>
        
      </form>
     </div>
      <div class="col-sm-8">
        <div id="tablaMaterialesLoad"></div>
      </div>
  </div>

  <!-- Modal -->
<div class="modal fade" id="abreModalUpdMateriales" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">  
        <h4 class="modal-title" id="myModalLabel">Actualizar Materiales</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      
      </div>
      <div class="modal-body">
      <form id="frmUpdMateriales" method="POST">
        <input type="text" hidden="" id="idUpdMateriales" name="idUpdMateriales">
        <label>Producto</label>
        <input type="text" class="form-control input-sm" id="updProducto" name="updProducto" autocomplete="off">
        <label>Descripción</label>
        <input type="text" class="form-control input-sm" id="updDescripcion" name="updDescripcion" autocomplete="off">
        <label>Precio de Compra</label>
        <input type="number" class="form-control input-sm" id="updPrecioCompra" name="updPrecioCompra" autocomplete="off">
        <label>Stock</label>
        <input type="number" class="form-control input-sm" id="updCantidad" name="updCantidad" autocomplete="off">
        <br>
        <br>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" id=btnUpdMateriales class="btn btn-warning" data-dismiss="modal">Actualizar</button>
      </div>
    </div>
  </div>
</div>
 
</div>
</body>
</html>


<script>
  $(document).ready(function(){
      $('#proveedorSelect').change(function(){
          var id_proveedor = $(this).val();
          $.ajax({
              type: "POST",
              data: {id_proveedor: id_proveedor},
              url: "../vistas/materiales/obtenerMateriaPrima.php",
              success: function(response){
                  $('#materiaPrimaSelect').html(response);
              },
              error: function(xhr, status, error) {
                  console.error(xhr.responseText);
              }
          });
      });
  });
</script>

<script type="text/javascript">
  function obtenerDatosMateriales(idmateriales){
    $.ajax({
            type:"POST",
            data:"idmateriales=" + idmateriales,
            url:"../procesos/materiales/obtenerDatosMateriales.php",
            success:function(r){

              dato=$.parseJSON(r);

              $('#idUpdMateriales').val(dato['id_compra']);
              $('#updProducto').val(dato['producto']);
              $('#updDescripcion').val(dato['descripcion']);
              $('#updPrecioCompra').val(dato['precio_compra']);
              $('#updCantidad').val(dato['cantidad']);
            }
        });
  }

  function eliminaMateriales(idmateriales){
    alertify.confirm('¿Desea eliminar este material?', 
    function(){
        $.ajax({
            type:"POST",
            data:"idmateriales= " + idmateriales,
            url:"../procesos/materiales/eliminaMateriales.php",
            success:function(r){
              console.log("Respuesta del servidor:", r);

              if(r==1){
                $('#tablaMaterialesLoad').load("../vistas/materiales/tablaMateriales.php");
                alertify.alert("Material eliminado correctamente");
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
      $('#btnUpdMateriales').click(function(){
        datos=$('#frmUpdMateriales').serialize();
        $.ajax({
            type:"POST",
            data:datos,
            url:"../procesos/materiales/actualizaMateriales.php",
            success:function(r){
              console.log(r);
              if(r==1){
                $('#tablaMaterialesLoad').load("../vistas/materiales/tablaMateriales.php");
                alertify.alert("Material actualizado con exito");
              }else{
                alertify.alert("Error al actualizar");
              }

            }
        });
    });

    });

</script>



<script type="text/javascript">
    $(document).ready(function(){
        $('#proveedorSelect').select2();
        $('#materiaPrimaSelect').select2();

        $('#tablaMaterialesLoad').load("../vistas/materiales/tablaMateriales.php");

        $('#btnAgregarMateriales').click(function(){
            
            vacios=validarFormVacio('frmMateriales');

            if(vacios>0){
                alertify.alert("Debes llenar todos los campos!!");
                return false;
            }


        datos=$('#frmMateriales').serialize();
        $.ajax({
            type:"POST",
            data:datos,
            url:"../procesos/materiales/agregaMateriales.php",
            success:function(r){
                console.log(r);
                if(r==1){
                    $('#tablaMaterialesLoad').load("../vistas/materiales/tablaMateriales.php");
                    $('#frmMateriales')[0].reset();
                    alertify.alert("Materiales agregados exitosamente");
                }else{
                    alertify.alert("Error al agregar los materiales");
                }
            }
        });
    });
    });

</script>

<?php
    }else{
       session_destroy();
       header("location:../index.php");
       exit;
    }

?>