<?php
    include "../frontEnd/actualizar-producto/actualizar.html";
    include "Producto.php";
    include 'datos_conexion/conexion.php';
    include "check-session.php";

    if (isset($_GET["actualizar"])){
        $numPro = $_GET["numPro"];
        $nombre = $_GET["nombre"];
        $cantidad = $_GET["cantidad"];
        $precio = $_GET["precio"];

        $producto = new Producto();
        $producto->updateProducto($numPro, $nombre, $precio, $cantidad, $con);

        echo "<script>
        window.alert('Data has been updated succesfully. ');
        </script>";

    }

    $numPro = $_GET["numPro"];
    $nombre = $_GET["nombre"];
    $cantidad = $_GET["cantidad"];
    $precio = $_GET["precio"];
    
    echo '
        <main>
            <form action="actualizarProd.php" method="get">
                <div class="mb-3">
                    <label for="exampleInputText1" class="form-label">Code</label>
                    <input name="numPro" type="number" class="form-control" id="exampleInputText" aria-describedby="textHelp" value="'.$numPro.'" readonly/>
                </div>
                <div class="mb-3">
                    <label for="exampleInputText1" class="form-label">Product Name</label>
                    <input name="nombre" type="text" class="form-control" id="exampleText1" required value="'.$nombre.'"/>
                </div>
                <div class="mb-3">
                    <label for="exampleInputText1" class="form-label">Price</label>
                    <input name="precio" type="number" class="form-control" id="exampleText1" required value="'.$precio.'"/>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Quantity</label>
                    <input name="cantidad" type="number" class="form-control" id="exampleInputPassword1" required value="'.$cantidad.'" min="1"/>
                </div>
                <button name="actualizar" type="submit" class="btn btn-primary">Update</button>
            </form>
        </main>
    ';
?>