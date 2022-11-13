<?php
    // Conectamos con la base de datos
    include 'datos_conexion/conexion.php';

    // Clase producto
    class Producto{
        // ATRIBUTOS
        private $numPro;
        private $nombre;
        private $precio;
        private $cantidad;

        // CONSTRUCTOR
        public function __construct($_numPro,$_nombre,$_precio,$_cantidad){
            $this->codigo = $_numPro;
            $this->nombre = $_nombre;
            $this->precio = $_precio;
            $this->cantidad = $_cantidad;
        }

        //____________________METODO GET____________________

        public function getNumPro(){
            return $this->numPro;
        }

        public function getNombre(){
            return $this->nombre;
        }

        public function getPrecio(){
            return $this->precio;
        }

        public function getCantidad(){
            return $this->cantidad;
        }

        //____________________METODO SET____________________
        
        public function setNombre($_nombre,$_numPro){
            $this->nombre = "UPDATE producto SET nombre = '$_nombre' WHERE numPro = '$_numPro'";
        }

        public function setPrecio($_precio,$_numPro){
            $this->precio = "UPDATE producto SET precio = '$_precio' WHERE numPro = '$_numPro'";
        }

        public function setCantidad($_cantidad,$_numPro){
            $this->cantidad = "UPDATE producto SET cantidad = '$_cantidad' WHERE numPro = '$_numPro'";
        }
    }
?>