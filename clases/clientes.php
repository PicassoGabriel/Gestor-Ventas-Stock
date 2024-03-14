<?php
    require_once "conexion.php";

    class clientes{

        public function agregaCliente($datos){

            $c= new conectar();
            $conexion=$c->conexion();

            $sql="INSERT INTO `clientes` (`nombre`,`contacto`) 
                  VALUES ('$datos[0]','$datos[1]')";

            return mysqli_query($conexion,$sql);
        }

        public function obtenerDatosCliente($idcliente){

            $c= new conectar();
            $conexion=$c->conexion();

            $sql = "SELECT id_cliente, nombre, contacto FROM `clientes` WHERE id_cliente = '$idcliente'";
            $result=mysqli_query($conexion,$sql);

            $read=mysqli_fetch_row($result);

            $datos=array(
                'id_cliente'=>$read[0],
                'nombre'=>$read[1],
                'contacto'=>$read[2]
            );

            return $datos;

        }

        public function actualizaCliente($datos){
            $c= new conectar();
            $conexion=$c->conexion();

            $sql="UPDATE clientes SET nombre='$datos[1]', contacto='$datos[2]'
                  WHERE id_cliente='$datos[0]' ";
            
            return mysqli_query($conexion,$sql);

        }

        public function eliminaCliente($idcliente){

            $c= new conectar();
            $conexion=$c->conexion();

            $sql="DELETE FROM clientes WHERE id_cliente='$idcliente' ";

            return mysqli_query($conexion,$sql);
        }

    }

?>