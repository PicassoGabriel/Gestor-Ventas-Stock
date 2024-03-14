<?php

    require_once "conexion.php";

    class proveedores{

        public function agregaProveedor($datos){

            $c= new conectar();
            $conexion=$c->conexion();

            $sql="INSERT INTO `proveedor` (`nombre`, `materia_prima`,`contacto`,`direccion`)
                  VALUES ('$datos[0]','$datos[1]','$datos[2]','$datos[3]')";

            return mysqli_query($conexion,$sql);
        }

        public function obtenerDatosProveedor($idproveedor){

            $c= new conectar();
            $conexion=$c->conexion();

            $sql="SELECT id_proveedor, nombre, materia_prima, contacto, direccion
                  FROM proveedor WHERE id_proveedor='$idproveedor'";

            $result=mysqli_query($conexion,$sql);

            $read=mysqli_fetch_row($result);

            $datos=array(
                "id_proveedor"=>$read[0],
                "nombre"=>$read[1], 
                "materia_prima"=>$read[2], 
                "contacto"=>$read[3], 
                "direccion"=>$read[4]
            );

            return $datos;
        }

        public function actualizaProveedor($datos){

            $c= new conectar();
            $conexion=$c->conexion();

            $sql="UPDATE proveedor SET nombre='$datos[1]',
                                       materia_prima='$datos[2]',
                                       contacto='$datos[3]',
                                       direccion='$datos[4]'
                  WHERE id_proveedor='$datos[0]'";

            return mysqli_query($conexion,$sql);
        }

        public function eliminaProveedor($idproveedor){

            $c= new conectar();
            $conexion=$c->conexion();
            
            $sql="DELETE FROM proveedor WHERE id_proveedor='$idproveedor'";

            return mysqli_query($conexion,$sql);
        }
    }

?>