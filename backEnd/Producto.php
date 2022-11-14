<?php
    // Clase producto
    class Producto{
        //____________________METODO INSERT____________________
        public function insertProducto($nombre, $precio, $cantidad, $con) {
            $consulta = "INSERT INTO producto(nombre, precio, cantidad) VALUES ($nombre, $precio, $cantidad)";
            $resultado = $con->query($consulta);
        }
        //____________________METODO UPDATE____________________
        
        public function updateProducto($numPro,$nombre, $precio, $cantidad, $con){
            $consulta = "UPDATE producto SET nombre = '$nombre' , precio = $precio , cantidad = $cantidad WHERE numPro = '$numPro'";
            $resultado = $con->query($consulta);
        }
    }
?>