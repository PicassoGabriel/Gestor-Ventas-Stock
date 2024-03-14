<?php
    session_start();

    if(isset($_SESSION['usuario'])){

    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CATEGORIAS</title>
    <?php  require_once "dependencias.php"; ?>
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
    <br>
    <div class="container">
        <h1>Categorias</h1>
        <div class="row">
            <div class="col-sm-4">
                <form id="frmCategorias" method="POST" action="../procesos/categorias/agregaCategoria.php">
                    <label>Categoria</label>
                    <input type="text" class="form-control input-sm" autocomplete="off" name="categoria" id="categoria">
                    <br>
                    <span class="btn btn-primary" id="btnAgregaCategoria">Agregar</span>
                    <!--<button class="btn btn-primary" id="btnAgregaCategoria" type="submit">Agregar</button>-->
                    
                </form>
            </div>
            <div class="col-sm-6">
                <div id="tablaCategoriaLoad"></div>
            </div>
        </div>
    </div>


<!-- Modal -->
<div class="modal fade" id="updateCategoria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Actualiza Categoria</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <form id="frmCatUpd">
          <input type="text" hidden="" id="idCategoria" name="idCategoria">
          <label>Categoria: </label>
          <input type="text" id="catUpdate"  autocomplete="off" name="catUpdate" class="form-control input-sm">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnCatUpd" class="btn btn-warning" data-dismiss="modal">Guardar</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>

<script type="text/javascript">

    alertify.set('notifier', 'position', 'top-right');
    alertify.set('notifier', 'delay', 5000);

    $(document).ready(function(){

        $('#tablaCategoriaLoad').load("../vistas/categorias/tablaCategorias.php");

        $('#btnAgregaCategoria').click(function(){
            
            vacios=validarFormVacio('frmCategorias');

            if(vacios>0){
                alertify.alert("Debes llenar todos los campos!!");
                return false;
            }


        datos=$('#frmCategorias').serialize();
        $.ajax({
            type:"POST",
            data:datos,
            url:"../procesos/categorias/agregaCategoria.php",
            success:function(r){
              console.log("Respuesta del servidor:", r);
                if(r==1){
                  //Esta linea limpia el formulario al insertar un registro
                   

                    $('#tablaCategoriaLoad').load("../vistas/categorias/tablaCategorias.php");
                    alertify.alert("Categoria agregada exitosamente");
                    $('#frmCategorias')[0].reset();
                }else{
                    alertify.alert("Error al agregar la categoria");
                }
            }
        });
    });
    });
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('#btnCatUpd').click(function(){
        datos=$('#frmCatUpd').serialize();
        $.ajax({
            type:"POST",
            data:datos,
            url:"../procesos/categorias/actualizaCategoria.php",
            success:function(r){
              if(r==1){
                $('#tablaCategoriaLoad').load("../vistas/categorias/tablaCategorias.php");
                alertify.alert("Categoria actualizada correctamente");
              }else{
                alertify.alert("Error al actualizar");
              }

            }
        });
    });

  });

</script>

<script type="text/javascript">
  function agregaDato(idCategoria,categoria){
    $('#idCategoria').val(idCategoria);
    $('#catUpdate').val(categoria);
  }

  function eliminaCategoria(idcategoria){
    alertify.confirm('¿Desea eliminar esta categoria?', 
    function(){
        $.ajax({
            type:"POST",
            data:"idCategoria= " + idcategoria,
            url:"../procesos/categorias/eliminaCategoria.php",
            success:function(r){
              if(r==1){
                $('#tablaCategoriaLoad').load("../vistas/categorias/tablaCategorias.php");
                alertify.alert("Categoria eliminada correctamente");
              }else{
                alertify.alert("Error al eliminar");
              }
            }
        }); 
      }, 
    function(){ alertify.alert('Eliminar Cancelado')});
  }
</script>


<?php
    }else{
        session_unset();
        header("location:../index.php");
        exit;
    }

?>