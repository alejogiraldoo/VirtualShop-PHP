<?php
    include "../frontEnd/vender-producto/vender.html";
    include "Producto.php";
    include "Usuario.php";
    include "check-session.php";
    include "Carrito.php";
    // Conectamos con la base de datos
    include 'datos_conexion/conexion.php';
    
    $carrito = new Carrito();

    $consultaMetP = "SELECT * FROM metodopago";
    $resultadoMetP = $con->query($consultaMetP);
    $filaMetP = $resultadoMetP->fetch_all();
   
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
            <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Payment Method</label>
            <select name="numMetP" class="form-select" aria-label="Default select example" required>';
            $i = 0;
            echo "<option value='' disabled selected>Select a Payment Method</option>";
            while ($i < count($filaMetP)) {
                echo '<option value="'.$filaMetP[$i][0].'">'.$filaMetP[$i][1].'</option>';
                $i++;
            }

            echo '</select>
            </div>
            <input name="vender" type="submit" class="btn btn-primary" value="Add to Shopping Cart">
            <br><br>
        </form>
    </main>';
    
    if (isset($_GET["vender"])) {
        $numMetP = $_GET["numMetP"];
        $numPro = $_GET["numPro"];
        $cantidad = $_GET["cantidad"]; 
        $precio = $_GET["precio"];
        $nombre = $_GET["nombre"];

        $consultaRep = "SELECT numPro FROM detallesVenta WHERE numPro = $numPro AND estado = 'carrito'";
        $resultadoRep = $con->query($consultaRep);
        $filaRep = $resultadoRep->fetch_array();
        
        $consulta = "SELECT numPro, cantidad FROM producto WHERE numPro = $numPro";
        $resultado = $con->query($consulta);
        $fila = $resultado->fetch_array();
        
        if($fila[0] == $numPro) {
            $sent = true;
            if($cantidad > $fila[1]) {
                echo "The amount of products to buy is higher than the inventory amount.";
                $sent = false;
            } else {
                if (!empty($filaRep)) {
                    if(count($filaRep) > 1) {
                        echo "
                            <script>
                                window.alert('This product is already in the shopping cart, update the existing product. ');
                                window.history.back();
                            </script>;
                        ";
                    }
                } else {
                    $total = $fila[1] - $cantidad;
                    $producto = new Producto();
                    $producto->updateProducto($numPro, $nombre, $precio, $total, $con);
                    $carrito->insertAgregado($numPro,$_SESSION["user"]->getNumUsu(), $numMetP,$cantidad, $con);
                }
            }
        } 
        
        if($sent) {
            echo "
            <script>
            window.alert('Product added to the shopping cart succesfully.');
            </script>
            ";
        } else {
            echo "
            <script>
            window.alert('There was an error adding the product to the shopping cart.');
            window.history.back();
            </script>
            ";
        } 
    }
    ?>