<?php
    require_once "..\proyectoFinal\clases\conexion.php";

    $obj= new conectar();
    $conexion=$obj->conexion();

    


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de usuario</title>
    <link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">
    <script src="librerias/jquery-3.7.1.min.js"></script>
    <script src="../proyectoFinal/js/funciones.js"></script>
    <style>body {
    background-color: #000000; /* Puedes cambiar el código de color según tus preferencias */
    }   </style>
</head>
<body>
    <br><br><br>
    <div class="container">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <div class=" p-4 bg-white">
                    <div class="panel-heading h2 bg-white">Control de Ventas y Stock</div>
                    <br><br>
                    <div class="panel-body bg-white">
                        <p>
                            <img src="img/logo_nombre.jpg" height="220px" class="mx-auto d-block">
                        </p>
                        <form id="frmLogin" method="POST">
                            <label for="usuario">Usuario</label>
                            <input type="text" class="form-control input-sm" name="usuario" id="usuario" autocomplete="off">
                            <label for="password">Contraseña</label>
                            <!--<input type="password" class="form-control input-sm" name="password" id="password"-->
                            <div class="input-group">
                            <input type="password" class="form-control input-sm" name="password" id="password">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="showPasswordBtn">Mostrar</button>
                            </div>
                        </div>
                            <p></p>
                            <button class="btn btn-primary btn-sm" id="entrarSistema" name="entrarSistema">Ingresar</button>
                            <a href="registro.php" class="btn btn-danger btn-sm">Registrar</a>
                            <br><br>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>
</body>
</html>

<script type="text/javascript">
    $(document).ready(function(){
        $('#entrarSistema').click(function(){

        vacios=validarFormVacio('frmLogin');

        if(vacios>0){
            alert("Debes llenar todos los campos!!");
            return false;
        }

        datos=$('#frmLogin').serialize();
        $.ajax({
            type:"POST",
            data:datos,
            url:"../proyectoFinal/procesos/regLogin/login.php",

           success: function(r) {
                console.log(r);  // Muestra la respuesta en la consola para depuración
                if (r == 1) {
                    window.location.href = "../proyectoFinal/vistas/inicio.php";
                } else {
                    alert("Error al iniciar sesión: Usuario o contraseña incorrectos.");
                }
            }
        });
    });
    });
</script>

<script>
    $(document).ready(function() {
        $('#showPasswordBtn').on('click', function() {
            var passwordField = $('#password');
            var passwordFieldType = passwordField.attr('type');
            
            // Cambiar el tipo de entrada de la contraseña
            if (passwordFieldType === 'password') {
                passwordField.attr('type', 'text');
                $(this).text('Ocultar');
            } else {
                passwordField.attr('type', 'password');
                $(this).text('Mostrar');
            }
        });
    });
</script>