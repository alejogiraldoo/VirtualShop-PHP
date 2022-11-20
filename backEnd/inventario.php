<?php
    include "../frontEnd/inventario/inventario.html";
    include "Producto.php";
    include "Usuario.php";
    include 'datos_conexion/conexion.php';
    include "check-session.php";

    $consulta = "SELECT * FROM producto";
    $resultado = $con->query($consulta);
    $fila = $resultado->fetch_all();
    
    if ($_SESSION["user"]->getRol() == "administrador") {
        echo '<li class="nav-item"><a class="nav-link active" aria-current="page" href="agregar.php">Add Product</a></li>';
    }
    
    echo '</ul></div></div></nav></header><br>';
    
    if (!empty($fila)) {
        if ($_SESSION["user"]->getRol() == "administrador") {
            echo "<h1>Inventory</h1><br>";
        } else {
            echo "<h1>Available Products</h1><br>";
        }
        echo "
            <table border='1'>
                <tr>
                    <th>Product Code</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Actions</th>
                </tr>
        ";
        $i = 0;
        
        while ($i < count($fila)) {
            echo"
            <tr>
            <td>".$fila[$i][0]."</td>
            <td>".$fila[$i][1]."</td>
            <td>".$fila[$i][2]."</td>
            <td>".$fila[$i][3]."</td>
            <td>
            ";
            
            if ($_SESSION["user"]->getRol() == "administrador") {
                echo "
                <b><a href='actualizarProd.php?numPro=" . $fila[$i][0] . "&nombre=" . $fila[$i][1] . "&precio=" . $fila[$i][2] . "&cantidad=" . $fila[$i][3] . "'>Update |</a></b>
                <b><a href='eliminarProd.php?numPro=" . $fila[$i][0] . "'>Delete  </a></b>
                ";
            }
            
            if ($_SESSION["user"]->getRol() == "usuario") {
                echo "<b><a href='vender.php?numPro=" . $fila[$i][0] . "&nombre=" . $fila[$i][1] . "&precio=" . $fila[$i][2] . "&cantidad=" . $fila[$i][3] ."'>Buy</a></b>";
            } 
            
            echo "   
                </td>
            </tr>
            ";
            $i++;
        }
        echo "</table>";
    } else {
        echo "<h2>There are no products available</h2>";
    }
    ?>