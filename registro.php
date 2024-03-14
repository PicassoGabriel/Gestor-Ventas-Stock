<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">
    <script src="../proyectoFinal/librerias/jquery-3.7.1.min.js"></script>
    <script src="../proyectoFinal/js/funciones.js"></script>
</head>
<body style="background-color:black">
    <br><br><br>
    <div class="container">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <div class="p-4 bg-white">
                    <div class="panel-heading h2 bg-white">Registrar Usuario</div>
                    <div class="panel panel-danger bg-white">
                        <form id="frmRegistro" method="POST">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control input-sm" name="nombre" id="nombre" autocomplete="off">
                        <label for="apellido">Apellido</label>
                        <input type="text" class="form-control input-sm" name="apellido" id="apellido" autocomplete="off">
                        <label for="correo">Correo</label>
                        <input type="text" class="form-control input-sm" name="correo" id="correo" autocomplete="off">
                        <label for="usuario">Usuario</label>
                        <input type="text" class="form-control input-sm" name="usuario" id="usuario" autocomplete="off">
                        <label for="password">Contraseña</label>
                        <!--<input type="password" class="form-control input-sm" name="password" id="password">-->
                        <div class="input-group">
                            <input type="password" class="form-control input-sm" name="password" id="password">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="showPasswordBtn">Mostrar</button>
                            </div>
                        </div>
                        <p></p>
                        <button class="btn btn-primary" id="registro">Registrar</button>
                        <a href="index.php" class="btn btn-danger">Regresar</a>
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
        $('#registro').click(function(){

            vacios=validarFormVacio('frmRegistro');

            if(vacios>0){
                alert("Debes llenar todos los campos!!");
                return false;
            }

            datos=$('#frmRegistro').serialize();
            $.ajax({
                type: "POST",
                data: datos,
                url: "../proyectoFinal/procesos/regLogin/registrarUsuario.php",
                success: function(r){
                    //alert(r);  // Muestra la respuesta en la consola para depuración
                    if (r == 1) {
                        alert("Agregado con éxito");
                        window.location.replace = "../proyectoFinal/index.php";
                    } else {
                        //alert("Error al agregar: " + r);
                        alert(r);  // Muestra el mensaje de error
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