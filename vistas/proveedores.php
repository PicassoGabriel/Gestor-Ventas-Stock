<?php
    session_start();

    if(isset($_SESSION['usuario'])){
 
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROVEEDORES</title>
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
  <h1>Proveedores</h1>
  <div class="row">
    <div class="col-sm-4">
      <form id="frmProveedor" method="POST">
        <label>Nombre</label>
        <input type="text" class="form-control input-sm" id="nombre" name="nombre" autocomplete="off">
        <label>Materia Prima</label>
        <input type="text" class="form-control input-sm" id="materiaPrima" name="materiaPrima" autocomplete="off">
        <label>Contacto</label>
        <input type="text" class="form-control input-sm" id="contacto" name="contacto" autocomplete="off">
        <label>Dirección</label>
        <input type="text" class="form-control input-sm" id="direccion" name="direccion" autocomplete="off">
        <br>
        <br>
        <span class="btn btn-primary" id="btnAgregarProveedor">Agregar</span>
      </form>
    </div>
    <div class="col-sm-8">
      <div id="tablaProveedorLoad"></div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="abreModalUpdProveedor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">  
        <h4 class="modal-title" id="myModalLabel">Actualizar Proveedor</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      
      </div>
      <div class="modal-body">
      <form id="frmUpdProveedor" method="POST">
      <input type="text" hidden="" id="idUpdProveedor" name="idUpdProveedor" autocomplete="off">
        <label>Nombre</label>
        <input type="text" class="form-control input-sm" id="updNombre" name="updNombre" autocomplete="off">
        <label>Materia Prima</label>
        <input type="text" class="form-control input-sm" id="updMateriaPrima" name="updMateriaPrima" autocomplete="off">
        <label>Contacto</label>
        <input type="text" class="form-control input-sm" id="updContacto" name="updContacto" autocomplete="off">
        <label>Dirección</label>
        <input type="text" class="form-control input-sm" id="updDireccion" name="updDireccion" autocomplete="off">
        <br>
        <br>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" id=btnUpdProveedor class="btn btn-warning" data-dismiss="modal">Actualizar</button>
      </div>
    </div>
  </div>
</div>

</body>
</html>

<script type="text/javascript">

    function agregaDatosProveedor(idproveedor){
        $.ajax({
                type:"POST",
                data:"idproveedor=" + idproveedor,
                url:"../procesos/proveedores/obtenerDatosProveedor.php",
                success:function(r){
                
                  dato=$.parseJSON(r);
                
                  $('#idUpdProveedor').val(dato['id_proveedor']);
                  $('#updNombre').val(dato['nombre']);
                  $('#updMateriaPrima').val(dato['materia_prima']);
                  $('#updContacto').val(dato['contacto']);
                  $('#updDireccion').val(dato['direccion']);

                }
            });
      }

      function eliminaProveedor(idproveedor){
        alertify.confirm('¿Desea eliminar este proveedor?', 
    function(){
        $.ajax({
            type:"POST",
            data:"idproveedor= " + idproveedor,
            url:"../procesos/proveedores/eliminaProveedor.php",
            success:function(r){
              console.log("Respuesta del servidor:", r);

              if(r==1){
                $('#tablaProveedorLoad').load("../vistas/proveedores/tablaProveedores.php");
                alertify.alert("Proveedor eliminado correctamente");
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

        $('#tablaProveedorLoad').load("../vistas/proveedores/tablaProveedores.php");

        $('#btnAgregarProveedor').click(function(){
            
            vacios=validarFormVacio('frmProveedor');

            if(vacios>0){
                alertify.alert("Debes llenar todos los campos!!");
                return false;
            }


        datos=$('#frmProveedor').serialize();
        $.ajax({
            type:"POST",
            data:datos,
            url:"../procesos/proveedores/agregaProveedor.php",
            success:function(r){
                if(r==1){
                  $('#tablaProveedorLoad').load("../vistas/proveedores/tablaProveedores.php");
                    $('#frmProveedor')[0].reset();
                    alertify.alert("Proveedor agregado exitosamente");
                }else{
                    alertify.alert("Error al agregar al proveedor");
                }
            }
        });
    });
    });

</script>

<script type="text/javascript">
    $(document).ready(function(){
      $('#btnUpdProveedor').click(function(){
        datos=$('#frmUpdProveedor').serialize();
        $.ajax({
            type:"POST",
            data:datos,
            url:"../procesos/proveedores/actualizaProveedor.php",
            success:function(r){
                if(r==1){
                    $('#tablaProveedorLoad').load("../vistas/proveedores/tablaProveedores.php");
                    $('#frmProveedor')[0].reset();
                    alertify.alert("Proveedor actualizado exitosamente");
                }else{
                    alertify.alert("Error al actualizar el proveedor");
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