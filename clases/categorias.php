<?php
    require_once "conexion.php";
    class categorias{
        public function agregaCategoria($datos){
            $c=new conectar();
            $conexion=$c->conexion();

            if (!$conexion) {
                die("Error de conexión: " . mysqli_connect_error());
            }
            

            $sql="INSERT INTO `categorias`(`nombre_categoria`,`fecha_creacion`,`id_usuario`)
                  VALUES ('$datos[0]','$datos[1]','$datos[2]')";

            $resultado=mysqli_query($conexion,$sql);

            if ($resultado) {
                return 1;  // Éxito
            } else {
                return "Error al agregar: " . mysqli_error($conexion);  // Mensaje de error
            }
        }

        public function actualizaCategoria($datos){
            $c=new conectar();
            $conexion=$c->conexion();

            $sql="UPDATE `categorias` SET nombre_categoria='$datos[1]'
                  WHERE id_categoria='$datos[0]' ";
            
            $resultado=mysqli_query($conexion,$sql);

            if ($resultado) {
                return 1;  // Éxito
            } else {
                return "Error al agregar: " . mysqli_error($conexion);  // Mensaje de error
            }
           
        }

        public function eliminaCategoria($idCategoria){
            $c=new conectar();
            $conexion=$c->conexion();

            $sql="DELETE FROM `categorias` WHERE id_categoria='$idCategoria'";

            $resultado=mysqli_query($conexion,$sql);

            if ($resultado) {
                return 1;  // Éxito
            } else {
                return "Error al agregar: " . mysqli_error($conexion);  // Mensaje de error
            }
        }
    }
?>