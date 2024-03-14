<?php

    require_once "conexion.php";

    class materiales{
        
        public function agregaMateriales($datos){
            $c= new conectar();
            $conexion=$c->conexion();
            $fecha=date('Y-m-d');

            $sql="INSERT INTO `materiales` (`id_proveedor`, `producto` ,`descripcion`, `precio_compra`, `cantidad`, `fecha_creacion`)
                  VALUES ('$datos[0]','$datos[1]','$datos[2]','$datos[3]','$datos[4]','$fecha') ";
            
            return mysqli_query($conexion,$sql);

        }

        public function obtenerDatosMateriales($idmateriales){

            $c= new conectar();
            $conexion=$c->conexion();

            $sql="SELECT id_compra, id_proveedor, producto, descripcion, precio_compra, cantidad 
                  FROM materiales WHERE id_compra=$idmateriales";
            
            $result=mysqli_query($conexion,$sql);

            $read=mysqli_fetch_row($result);

            $datos=array(
                "id_compra"=>$read[0] ,
                "id_proveedor"=>$read[1] ,
                "producto"=>$read[2] ,
                "descripcion"=>$read[3] ,
                "precio_compra"=>$read[4] ,
                "cantidad"=>$read[5]
            );
            

            return $datos;

        }

        public function actualizaMateriales($datos){

            $c= new conectar();
            $conexion=$c->conexion();

            $sql="UPDATE materiales SET 
                                       producto= '$datos[1]', 
                                       descripcion= '$datos[2]',
                                       precio_compra= '$datos[3]',
                                       cantidad= '$datos[4]'
                  WHERE id_compra= '$datos[0]'";

            return mysqli_query($conexion,$sql);

        }

        public function eliminaMateriales($idmateriales){

            $c= new conectar();
            $conexion=$c->conexion();

            $sql="DELETE FROM materiales WHERE id_compra='$idmateriales' ";

            return mysqli_query($conexion,$sql);

        }
    }


?>