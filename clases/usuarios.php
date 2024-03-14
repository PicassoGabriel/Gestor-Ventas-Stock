<?php
    require_once "conexion.php";
    class usuarios{
        public function registroUsuario($datos){
            $c= new conectar();

            $conexion= $c->conexion();

            if (!$conexion) {
                die("Error de conexión: " . mysqli_connect_error());
            }

            $fecha=date('Y-m-d');
            //$password = password_hash($datos[4], PASSWORD_DEFAULT);

            $sql="INSERT INTO `usuarios`( `nombre`, `apellido`, `correo`, `usuario`, `contraseña`, `fechaRegistro`) 
                  VALUES ('$datos[0]','$datos[1]','$datos[2]','$datos[3]','$datos[4]','$fecha')";

            //return mysqli_query($conexion,$sql);

            $resultado = mysqli_query($conexion, $sql);

            if ($resultado) {
                return 1;  // Éxito
            } else {
                return "Error al agregar: " . mysqli_error($conexion);  // Mensaje de error
            }

        
        }

        public function traeID($datos){
            $c = new conectar();
            $conexion = $c->conexion();
            $usuario = mysqli_real_escape_string($conexion, $datos[0]);  // Escapar variables para prevenir SQL injection
            $contraseña = mysqli_real_escape_string($conexion, $datos[1]);

            $sql="SELECT id_usuario FROM `usuarios` WHERE usuario='$usuario' AND contraseña='$contraseña'";

            $result=mysqli_query($conexion,$sql);
            
            return mysqli_fetch_row($result)[0];
        }

        public function loginUser($datos){
            $c = new conectar();
            $conexion = $c->conexion();
        
            $usuario = mysqli_real_escape_string($conexion, $datos[0]);  // Escapar variables para prevenir SQL injection
            $contraseña = mysqli_real_escape_string($conexion, $datos[1]);

            $_SESSION['usuario']=$datos[0];
            $_SESSION['iduser']=self::traeID($datos);
        
            $sql = "SELECT * FROM `usuarios` WHERE usuario='$usuario' AND contraseña='$contraseña'";
            
            $result = mysqli_query($conexion, $sql);
        
            if ($result && mysqli_num_rows($result) > 0) {
                return 1;
            } else {
                return 0;
            }
        }


     
    }
?>