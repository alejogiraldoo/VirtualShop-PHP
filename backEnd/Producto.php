<?php
    // Clase producto
    class Producto{
        //____________________METODO INSERT____________________
        public function insertProducto($nombre, $precio, $cantidad, $con) {
            $consulta = "INSERT INTO producto(nombre, precio, cantidad) VALUES ('$nombre', $precio, $cantidad)";
            $con->query($consulta);
        }
        //____________________METODO UPDATE____________________
        public function updateProducto($numPro,$nombre, $precio, $cantidad, $con){
            $consulta = "UPDATE producto SET nombre = '$nombre' , precio = $precio , cantidad = $cantidad WHERE numPro = '$numPro'";
            $con->query($consulta);
        }
        //_____________________METODO DELETE___________________
        public function deleteProducto($numPro, $con) {
            $consulta = "DELETE FROM producto WHERE numPro = $numPro";
            $con->query($consulta);
        }
    }
?>