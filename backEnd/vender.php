<?php
    include "../frontEnd/vender-producto/vender.html";
    include "Producto.php";
    include "Usuario.php";
    include "check-session.php";
    // Conectamos con la base de datos
    include 'datos_conexion/conexion.php';
    
    echo '
    <title>Purchase</title>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="inventario.php">Go back to Inventory</a>
            </div>
        </nav>
        <h1>Buy Products</h1>
        <main>
    </body>
    </html>
    ';
        echo '
        <h2>Product Information</h2>
        <form action="vender.php" method="get">
            <div class="mb-3">
                <label for="exampleInputText1" class="form-label">Product Code</label>
                <input name="numPro" type="number" class="form-control" id="exampleInputText" aria-describedby="textHelp" value="'.$_GET["numPro"].'" readonly/>
            </div>
            <div class="mb-3">
                <label for="exampleInputText1" class="form-label">Product Name</label>
                <input name="nombre" type="text" class="form-control" id="exampleText1" required value="'.$_GET["nombre"].'" readonly/>
            </div>
            <div class="mb-3">
                <label for="exampleInputText1" class="form-label">Price</label>
                <input name="precio" type="number" class="form-control" id="exampleText1" required value="'.$_GET["precio"].'" readonly/>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Quantity</label>
                <input name="cantidad" type="number" class="form-control" id="exampleInputPassword1" min="1" required />
            </div>
            <input name="vender" type="submit" class="btn btn-primary" value="Buy">
            <br><br>
        </form>
    </main>
    ';

    if (isset($_GET["vender"])) {
        $numPro = $_GET["numPro"];
        $cantidad = $_GET["cantidad"]; 
        $precio = $_GET["precio"];
        $nombre = $_GET["nombre"];

        $consulta = "SELECT numPro, cantidad FROM producto WHERE numPro = $numPro";
        $resultado = $con->query($consulta);
        $fila = $resultado->fetch_array();

        if($fila[0] == $numPro) {
            $sent = true;
            if($cantidad > $fila[1]) {
                echo "The amount of products to buy is higher than the inventory amount.";
                $sent = false;
            } else {
                $total = $fila[1] - $cantidad;
                $producto = new Producto();
                $producto->updateProducto($numPro, $nombre, $precio, $total, $con);

                echo "¿Do you wish to generate a receipt? <br>";
                echo "<a href='factura.php?numPro=".$_GET["numPro"]."&cantidad=".$_GET["cantidad"]."&ced_cliente=".$_SESSION["user"]->getId()."&nom_cliente=".$_SESSION["user"]->getNombre()."&tel_cliente=".$_SESSION["user"]->getTelefono()."&dir_cliente=".$_SESSION["user"]->getDireccion()."&nombre=".$nombre."&precio=".$precio."'>Generate a Receipt</a>";
            }
        } 

        if($sent) {
            echo "
            <script>
                window.alert('Purchase has been made succesfully.');
            </script>
            ";
        } else {
            echo "
            <script>
                window.alert('There was an error during the purchase.');
                window.history.back();
            </script>
            ";
        } 
    }
?>