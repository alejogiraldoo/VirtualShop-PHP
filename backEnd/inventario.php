<?php
    include "Producto.php";
    include 'datos_conexion/conexion.php';

    session_start();
    $_SESSION["productos"] = array();

    $consulta = "SELECT * FROM producto";
    $resultado = $con->query($consulta);

    echo "
        <table border='1'>
            <tr>
                <th>Codigo</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Acciones</th>
            </tr>
    ";
    $i = 0;
    while ($fila = $resultado->fetch_array()) {
        $_SESSION["productos"][$i] = new Producto($fila[0],$fila[1],$fila[2],$fila[3]);
        $i++;

        echo"
        <tr>
            <td>$fila[0]</td>
            <td>$fila[1]</td>
            <td>$fila[2]</td>
            <td>$fila[3]</td>
            <td>
                <b><a href='actualizar.php?numPro=" . $fila[0] . "&nombre=" . $fila[1] . "&precio=" . $fila[2] . "&cantidad=" . $fila[3] . "'>Actualizar |</a></b>
                <b><a href='eliminar.php?numPro=" . $fila[0] . "'>Eliminar |</a></b>
                <b><a href='vender.php?numPro=" . $fila[0] . "&nombre=" . $fila[1] . "&precio=" . $fila[2] . "&cantidad=" . $fila[3] ."'>Vender</a></b>
            </td>
        </tr>
        ";
    }

    echo "</table>"
?>