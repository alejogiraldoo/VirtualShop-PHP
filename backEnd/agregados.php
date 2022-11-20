<?php
    include "../frontEnd/inventario/inventario.html";
    include "Usuario.php";
    include "Carrito.php";
    include 'datos_conexion/conexion.php';
    include "check-session.php";

    $carrito = new Carrito();

    $consulta = "SELECT * FROM detallesVenta WHERE estado = 'carrito'";
    $resultado = $con->query($consulta);
    $fila = $resultado->fetch_all();

    echo '<li class="nav-item"><a class="nav-link active" aria-current="page" href="inventario.php">Go back to Inventory</a></li>';

    echo '</ul></div></div></nav></header><br>';

    if (!empty($fila)) {
        echo "<h1>Shopping Cart</h1>";
        echo "
            <table border='1'>
                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Payment Method</th>
                    <th>Actions</th>
                </tr>
        ";
        $i = 0;

        while ($i < count($fila)) {
            $consulta2 = 'SELECT nombre, precio FROM producto WHERE numPro = "'.$fila[$i][1].'"';
            $resultado2 = $con->query($consulta2);
            $fila2 = $resultado2->fetch_array();

            $consulta3 = 'SELECT nombre, numMetP FROM metodopago WHERE numMetP = "'.$fila[$i][3].'"';
            $resultado3 = $con->query($consulta3);
            $fila3 = $resultado3->fetch_array();

            echo"
            <tr>
            <td>".$fila2[0]."</td>
            <td>".$fila2[1]."</td>
            <td>".$fila[$i][4]."</td>
            <td>".$fila3[0]."</td>
            <td>
            ";
            
            echo "
                <b><a href='actualizarVent.php?numV=".$fila[$i][2]."&cantidad=".$fila[$i][4]."&nombre=".$fila2[0]."&precio=".$fila2[1]."&nomMetP=".$fila3[0]."&numMetP=".$fila3[1]."'>Update |</a></b>
                <b><a href='eliminarVent.php?numV=".$fila[$i][2]."'>Delete  </a></b>
            ";
            
            
            echo "   
                </td>
            </tr>
            ";
            $i++;
        }
        echo "</table><br>";
        echo "<form action='agregados.php' method='post'><input id='comprar' class='btn btn-primary' name='comprar' type='submit' value='Purchase'></form>";
    } else {
        echo "<h2>There are no products in the shopping cart</h2>";
    }

    if(isset($_POST["comprar"])) {
        for ($i=0; $i < count($fila); $i++) { 
            $carrito->updateAgregado($fila[$i][4], $fila[$i][2], $fila[$i][3], 'comprado', $con);
        }
        header("location: agregados.php");
    }
?>