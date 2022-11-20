<?php
    // Clase producto
    class Carrito{
        //____________________METODO INSERT____________________
        public function insertAgregado($numPro,$numUsu, $numMetP, $cantidad, $con) {
            $consultaV = "INSERT INTO venta(numUsu,numAs) VALUES ($numUsu,null)";
            $con->query($consultaV);

            $consultaU = "SELECT numV FROM venta WHERE numUsu = $numUsu";
            $resultadoU = $con->query($consultaU);
            $filaU = $resultadoU->fetch_all();

            $var = $filaU[count($filaU) - 1][0];

            $consulta = "INSERT INTO detallesVenta(numPro, numV, numMetP, cantidad, estado) VALUES ($numPro, $var, $numMetP, $cantidad, 'carrito')";
            $con->query($consulta);
        }
        //____________________METODO UPDATE____________________
        public function updateAgregado($cantidad, $numV, $numMetP, $estado, $con){
            $consulta = "UPDATE detallesVenta SET estado = '$estado', cantidad = $cantidad, numMetP = $numMetP WHERE numV = $numV";
            $con->query($consulta);
        }
        //_____________________METODO DELETE___________________
        public function deleteAgregado($numV, $con) {
            $consulta = "DELETE FROM venta WHERE numV = $numV";
            $con->query($consulta);
        }
    }
?>