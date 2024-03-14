<?php
    require_once "conexion.php";
    class articulos{

        public function agregaImagen($datos){
            $c= new conectar();
            $conexion=$c->conexion();
            $fecha=date('Y-m-d');

            $sql="INSERT INTO `imagenes` (`id_categoria`,`nombre`,`ruta`,`fechaSubida`)
                  VALUES ('$datos[0]','$datos[1]','$datos[2]','$fecha') ";

            $result=mysqli_query($conexion,$sql);

            return mysqli_insert_id($conexion);

        }

        public function insertaArticulo($datos){
            $c= new conectar();
            $conexion=$c->conexion();
            $fecha=date('Y-m-d');

            $sql="INSERT INTO `articulos` (`nombre`,`descripcion`,`stock`,`costo_total`,`precio_venta`,`id_imagen`,`id_usuario`,`id_categoria`,`fecha_creacion`)
                  VALUES ('$datos[0]','$datos[1]','$datos[2]','$datos[3]','$datos[4]','$datos[5]','$datos[6]','$datos[7]','$fecha')";

            return mysqli_query($conexion,$sql);
        }

        public function obtenerDatosArticulos($idarticulo){
            $c= new conectar();
            $conexion=$c->conexion();

            $sql="SELECT id_articulo, nombre, descripcion, stock, costo_total, precio_venta, id_categoria
                  FROM articulos WHERE id_articulo=$idarticulo";
            
            $result=mysqli_query($conexion,$sql);

            $read=mysqli_fetch_row($result);

            $datos=array(
                "id_articulo"=>$read[0] ,
                "nombre"=>$read[1] ,
                "descripcion"=>$read[2] ,
                "stock"=>$read[3] ,
                "costo_total"=>$read[4] ,
                "precio_venta"=>$read[5] ,
                "id_categoria"=>$read[6] 
            );

            return $datos;
        }

        public function actualizaArticulo($datos){
            $c= new conectar();
            $conexion=$c->conexion();

            $sql="UPDATE articulos SET nombre= '$datos[1]',
                                       descripcion= '$datos[2]', 
                                       stock= '$datos[3]',
                                       costo_total= '$datos[4]',
                                       precio_venta= '$datos[5]', 
                                       id_categoria= '$datos[6]'
                                       
                    WHERE id_articulo= '$datos[0]'";

            return mysqli_query($conexion,$sql);
        }

        public function eliminaArticulo($idarticulo){
            $c= new conectar();
            $conexion=$c->conexion();
        
            $idImg=self::obtenIdImg($idarticulo);
        
            $sql="DELETE FROM articulos WHERE id_articulo='$idarticulo'";
        
            $result=mysqli_query($conexion,$sql);
        
            if(!$result){
                echo "Error al eliminar el artículo: " . mysqli_error($conexion);
                return 0;
            }
        
            $ruta=self::obtenRutaImagen($idImg);
        
            $sql="DELETE FROM imagenes WHERE id_imagen='$idImg'";
        
            $result=mysqli_query($conexion,$sql);
        
            if(!$result){
                echo "Error al eliminar la imagen asociada al artículo: " . mysqli_error($conexion);
                return 0;
            }
        
            if(!unlink($ruta)){
                echo "Error al eliminar el archivo de imagen: No se pudo eliminar " . $ruta;
                return 0;
            }
        
            return 1;
        }


        public function obtenIdImg($idarticulo){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="SELECT id_imagen 
					from articulos 
					where id_articulo='$idarticulo'";
			$result=mysqli_query($conexion,$sql);

			return mysqli_fetch_row($result)[0];
		}

		public function obtenRutaImagen($idImg){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="SELECT ruta 
					from imagenes 
					where id_imagen='$idImg'";

			$result=mysqli_query($conexion,$sql);

			return mysqli_fetch_row($result)[0];
		}
    }




?>