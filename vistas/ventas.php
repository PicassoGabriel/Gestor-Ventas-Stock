<?php
    session_start();

    if(isset($_SESSION['usuario'])){
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CARGAR VENTAS</title>
    <?php require_once "dependencias.php"?>
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
    <h1>Ventas</h1>
    <br>
    <div class="row">
      <div class="col-sm-12">
      <span class="btn btn-primary" id="btnCargarVentas">Cargar Ventas</span>
      <span class="btn btn-primary" id="btnVerVentas">Ver Ventas</span>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <br>
        <div id="ventasProductos"></div>
        <div id="ventasHechas"></div>
      </div>
    </div>
  </div>

</body>
</html>

<script type="text/javascript">
  $(document).ready(function(){
    $('#btnCargarVentas').click(function(){
      esconderSeccion();
      $('#ventasProductos').load("../vistas/ventas/ventasProductos.php");
      $('#ventasProductos').show();

    });
    $('#btnVerVentas').click(function(){
      esconderSeccion();
      $('#ventasHechas').load("../vistas/ventas/ventasHechas.php");
      $('#ventasHechas').show();

    });

    function esconderSeccion(){
      $('#ventasProductos').hide();
      $('#ventasHechas').hide();
    }


  });
</script>

<?php
    }else{
        session_unset();
        header("location:../index.php");
        exit;
    }
?>