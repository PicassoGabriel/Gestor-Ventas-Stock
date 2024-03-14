<?php
    session_start();

    if(isset($_SESSION['usuario'])){
       

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DECO PRINCE</title>
        <?php
            require_once "dependencias.php";
        ?>
         <!-- Incluye Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/graficos.css">
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
<div class="grafico-container">
  <div class="grafico" style="width: 40%; height: 300px;">
      <h4>Productos en Stock</h4>
    <canvas id="graficoStock"></canvas>
  </div>


  <div class="grafico" style="width: 40%; height: 300px;">
      <h4>Gráfico de Costo y Precio de Venta de Productos</h4>
    <canvas id="graficoCostoPrecio"></canvas>
  </div>
</div>
<br>
<br>
<div class="grafico-container">
    <div class="grafico" style="width: 40%; height: 300px;">
      <h4>Ventas Por Mes</h4>
    <canvas id="graficoVentaXMes"></canvas>
  </div> 
  <div class="grafico" style="width: 40%; height: 300px;">
      <h4>Productos Mas Vendidos</h4>
      <canvas id="graficoProductosMasVendidos"></canvas>
  </div>
</div>
<br>


  <script>
        
        $.ajax({
            url: '../vistas/graficos/graficoArticulos.php', 
            method: 'GET',
            success: function(response) {
              
                var data = JSON.parse(response);

               
                var labels = [];
              
                var values = [];

            
                data.forEach(function(item) {
                    labels.push(item.nombre);
                    values.push(item.stock);
                });

               
                var ctx = document.getElementById('graficoStock').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Cantidad en Stock',
                            data: values,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error('Error al obtener los datos:', error);
            }
        });
  </script>
    


  <script>
  $.ajax({
    url: '../vistas/graficos/graficoArtCostoPrecio.php', 
    method: 'GET',
    success: function(response) {
     
        var data = JSON.parse(response);

        
        var labels = [];
        var costos = [];
        var preciosVenta = [];

        data.forEach(function(item) {
            labels.push(item.nombre);
            costos.push(item.costo_total);
            preciosVenta.push(item.precio_venta);
        });

      
        var ctx = document.getElementById('graficoCostoPrecio').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Costo Total',
                    data: costos,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)', // Color rojo para el costo total
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }, {
                    label: 'Precio de Venta',
                    data: preciosVenta,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)', // Color verde para el precio de venta
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    },
    error: function(xhr, status, error) {
        console.error('Error al obtener los datos:', error);
    }
  });
  </script>


  <script>
      
        $.ajax({
            url: '../vistas/graficos/graficoVentasXmes.php',
            method: 'GET',
            success: function(response) {
             
                var data = JSON.parse(response);

  
                var nombresMeses = [];
                var totalVentas = [];

                data.forEach(function(item) {
                    nombresMeses.push(item.nombre_mes);
                    totalVentas.push(item.total_ventas);
                });

       
                var ctx = document.getElementById('graficoVentaXMes').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: nombresMeses,
                        datasets: [{
                            label: 'Ventas por Mes',
                            data: totalVentas,
                            backgroundColor: 'rgba(21, 235, 53, 0.2)',
                            borderColor: 'rgba(21, 235, 53, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error('Error al obtener los datos:', error);
            }
        });
  </script>

  <script>
    $.ajax({
        url: '../vistas/graficos/graficoArtMasVendido.php',
        method: 'GET',
        success: function(response) {
            var data = JSON.parse(response);
        
           
            var productos = [];
            var ventas = [];
        
            for (var i = 0; i < data.length; i++) {
                productos.push(data[i].nombre_producto);
                ventas.push(data[i].total_ventas);
            }
          
            var ctx = document.getElementById('graficoProductosMasVendidos').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'pie', 
                data: {
                    labels: productos, 
                    datasets: [{
                        label: 'Cantidad de Ventas',
                        data: ventas, 
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        },
        error: function(xhr, status, error) {
            console.error('Error al obtener los datos:', error);
        }
    });

  </script>

<?php
    }else{
       session_destroy();
       header("location:../index.php");
       exit;
    }

?>