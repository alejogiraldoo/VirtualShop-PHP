<?php
    include "Producto.php";
    include 'datos_conexion/conexion.php';
    include "check-session.php";
    
    $numPro = $_GET["numPro"];

    $producto = new Producto();
    $producto->deleteProducto($numPro, $con);

    header("location: inventario.php");
?>