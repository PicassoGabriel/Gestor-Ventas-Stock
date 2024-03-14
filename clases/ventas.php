<?php
    require_once "conexion.php";

    class ventas{
        public function obtenDatosProducto($idproducto){

            $c=new conectar();
            $conexion=$c->conexion();

            $sql="SELECT art.id_articulo, art.nombre, art.descripcion, art.stock, art.precio_venta, img.ruta
                  FROM articulos AS art
                  INNER JOIN imagenes AS img
                  ON art.id_imagen=img.id_imagen
                  AND art.id_articulo='$idproducto'";
            
            $result=mysqli_query($conexion,$sql);

            $read=mysqli_fetch_row($result);

            $d=explode('/', $read[5]);

            $img=$d[1].'/'.$d[2].'/'.$d[3];

            $datos=array(
                'nombre'=>$read[1], 
                'descripcion'=>$read[2], 
                'stock'=>$read[3], 
                'precio_venta'=>$read[4],
                'ruta'=>$img
            );

            return $datos;
        }

        public function creaFolio(){
            $c= new conectar();
            $conexion=$c->conexion();
    
            $sql="SELECT id_venta from ventas group by id_venta desc";
    
            $resul=mysqli_query($conexion,$sql);
            $id=mysqli_fetch_row($resul)[0];
    
            if($id=="" or $id==null or $id==0){
                return 1;
            }else{
                return $id + 1;
            }
        }


        public function crearVenta()
        {
            $c = new conectar();
            $conexion = $c->conexion();
        
            $fecha = date('Y-m-d');
        
            $idVenta = self::creaFolio();
        
            $datos = $_SESSION['tablaVentasTemp'];
        
            $idUsuario = $_SESSION['iduser'];
            



            $respuesta = 0;
        
            for ($i = 0; $i < count($datos); $i++) {
                $d = explode("||", $datos[$i]);
        
                // Verificar si hay suficiente stock antes de realizar la venta
                if ($this->verificarStockDisponible($d[0], 1)) {
                    $sql = "INSERT INTO ventas (id_venta, id_cliente,id_articulo,id_usuario, total, forma_pago,fechaVenta)
                              VALUES ('$idVenta','$d[5]','$d[0]','$idUsuario','$d[3]','$d[6]','$fecha')";
                    $result = mysqli_query($conexion, $sql);
        
                    if ($result) {
                        $respuesta += 1;
                        // Descontar la cantidad vendida del stock
                        $this->descuentaCantidad($d[0], 1);
                    }
                } else {
                    echo "No hay suficiente stock para el producto con ID: " . $d[0];
                    // Puedes agregar aquí cualquier manejo adicional, como registrar un log de eventos, lanzar una excepción, etc.
                }
            }
        
            return $respuesta;
        }


        public function descuentaCantidad($idproducto, $cantidad)
        {
            $c = new conectar();
            $conexion = $c->conexion();
        
            // Obtener el stock actual del producto
            $sql = "SELECT stock FROM articulos WHERE id_articulo='$idproducto'";
            $result = mysqli_query($conexion, $sql);
        
            // Verificar si se encontró el producto
            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $stockActual = $row['stock'];
        
                // Calcular el nuevo stock restando la cantidad vendida
                $nuevoStock = $stockActual - $cantidad;
        
                // Actualizar el stock en la base de datos
                $sql = "UPDATE articulos SET stock='$nuevoStock' WHERE id_articulo='$idproducto'";
                mysqli_query($conexion, $sql);
            } else {
                // Manejar el caso donde no se pudo obtener el stock del producto
                // Puedes registrar un error, lanzar una excepción, o manejarlo de otra manera según tu lógica de aplicación
                echo "Error al obtener el stock del producto.";
            }
        }

        public function verificarStockDisponible($idProducto, $cantidadSolicitada){
            $c = new conectar();
            $conexion = $c->conexion();
        
            $sql = "SELECT stock FROM articulos WHERE id_articulo='$idProducto'";
            $result = mysqli_query($conexion, $sql);
        
            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $stockActual = $row['stock'];
            
                // Verificar si hay suficiente stock disponible
                return $stockActual >= $cantidadSolicitada;
            } else {
                echo "Error al obtener el stock del producto.";
                return false;
            }
        }

        public function nombreCliente($idCliente){
            $c= new conectar();
            $conexion=$c->conexion();
    
            $sql="SELECT nombre 
                from clientes 
                where id_cliente='$idCliente'";
            $result=mysqli_query($conexion,$sql);
    
            $read=mysqli_fetch_row($result);
    
            return $read[0]. " ";
        }
    
        public function obtenerTotal($idventa){
            $c= new conectar();
            $conexion=$c->conexion();
    
            $sql="SELECT total
                    from ventas 
                    where id_venta='$idventa'";
            $result=mysqli_query($conexion,$sql);
    
            $total=0;
    
            while($read=mysqli_fetch_row($result)){
                $total=$total + $read[0];
            }
    
            return $total;
        }

        public function eliminaVenta($idVenta){
            $c= new conectar();
            $conexion=$c->conexion();

            $sql="DELETE FROM ventas WHERE id_venta='$idVenta' ";

            return mysqli_query($conexion,$sql);
        }
    
    }

?>