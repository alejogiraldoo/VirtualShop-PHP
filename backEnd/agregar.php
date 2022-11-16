<?php
    include "../frontEnd/agregar-producto/agregar.html";
    include "Producto.php";
    include 'datos_conexion/conexion.php';
    include "check-session.php";
    
    if(isset($_POST["agregar"])) {
        $nombre = $_POST["nombre"];
        $precio = $_POST["precio"];
        $cantidad = $_POST["cantidad"];

        $consultaRep = "SELECT nombre FROM producto WHERE nombre = '$nombre'";
        $resultadoRep = $con->query($consultaRep);
        $filaRep = $resultadoRep->fetch_array();

        if (!empty($filaRep)) {
            if(count($filaRep) > 1) {
                echo "
                    <script>
                        window.alert('Este producto ya fue agregado, actualiza el registro existente. ');
                        window.history.back();
                    </script>;
                ";
            }
        } else {
            $producto = new Producto();
            $producto->insertProducto($nombre, $precio, $cantidad, $con);
        }

        echo "
        <script>
            window.alert('Producto agregado exitosamente. ');
            window.history.back();
        </script>;
        ";
    }
?>