<?php
    include "../frontEnd/factura/factura.html";
    include "Producto.php";
    session_start();

    include "check-session.php";

    $codigo = $_GET["codigo"];
    $cantidad = $_GET["cantidad"];
    $ced_cliente = $_GET["ced_cliente"];
    $nom_cliente = $_GET["nom_cliente"];
    $tel_cliente = $_GET["tel_cliente"];
    $dir_cliente = $_GET["dir_cliente"];
    $nombre = $_GET["nombre"];
    $precio = $_GET["precio"];

    echo "<h2>Datos del Cliente</h2>";
    echo "<p>Identificación del Cliente: ".$ced_cliente."</p>";
    echo "<p>Nombre del Cliente: ".$nom_cliente."<p>";
    echo "<p>N° de Telefono del Cliente: ".$tel_cliente."</p>";
    echo "<p>Dirección del Cliente: ".$dir_cliente."</p>";
            
    for ($i=0; $i < count($_SESSION["productos"]); $i++) { 
        if($_SESSION["productos"][$i]->getNombre() == $nombre) {
            
            echo "<h2>Datos de la Compra</h2>";
            echo "
                <table border='1'>
                    <tr>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                    </tr>
                ";
            echo"
                <tr>
                    <td>".$codigo."</td>
                    <td>".$nombre."</td>
                    <td>".$precio."</td>
                    <td>".$cantidad."</td>
                    <td>".$precio * $cantidad."</td>
                </tr>
            ";
            echo"</table>";
            break;
        }
    }
?>