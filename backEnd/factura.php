<?php
    include "../frontEnd/factura/factura.html";
    include "Producto.php";
    include "check-session.php";
    include 'datos_conexion/conexion.php';

    $numPro = $_GET["numPro"];
    $cantidad = $_GET["cantidad"];
    $ced_cliente = $_GET["ced_cliente"];
    $nom_cliente = $_GET["nom_cliente"];
    $tel_cliente = $_GET["tel_cliente"];
    $dir_cliente = $_GET["dir_cliente"];

    $consultaNombre = "SELECT nombre FROM producto WHERE numPro = $numPro";
    $resultadoNombre = $con->query($consultaNombre);
    $filaNombre = $resultadoNombre->fetch_array();

    $consultaPrecio = "SELECT precio FROM producto WHERE numPro = $numPro";
    $resultadoPrecio= $con->query($consultaPrecio);
    $filaPrecio = $resultadoPrecio->fetch_array();

    echo "<h2>Client Information</h2>";
    echo "<p>ID: ".$ced_cliente."</p>";
    echo "<p>Full Name: ".$nom_cliente."<p>";
    echo "<p>Contact Number: ".$tel_cliente."</p>";
    echo "<p>Address: ".$dir_cliente."</p>";
          
    $consulta = "SELECT numPro FROM producto WHERE numPro = $numPro";
    $resultado = $con->query($consulta);
    $fila = $resultado->fetch_array();

    if($fila[0] == $numPro) {
        echo "<h2>Purchase Details</h2>";
        echo "
            <table border='1'>
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            ";
        echo"
            <tr>
                <td>".$numPro."</td>
                <td>".$filaNombre[0]."</td>
                <td>".$filaPrecio[0]."</td>
                <td>".$cantidad."</td>
                <td>".$filaPrecio[0] * $cantidad."</td>
            </tr>
        ";
        echo"</table>";
    }
?>