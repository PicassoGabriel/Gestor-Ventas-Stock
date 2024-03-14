<?php
    class conectar{
        private $servidor="localhost";
        private $usuario="root";
        private $password="";
        private $bd="proyectofinal";

        public function conexion(){
            $conexion= mysqli_connect($this->servidor,
                                      $this->usuario,
                                      $this->password,
                                      $this->bd);

            
            if (!$conexion) {
                die("Error de conexión: " . mysqli_connect_error());
            }

            return $conexion;
        }
    }
//CODIGO PARA PROBAR LA CONEXION
//$obj =new conectar();
//if($obj->conexion()){
//    echo "conectado";
//}

?>