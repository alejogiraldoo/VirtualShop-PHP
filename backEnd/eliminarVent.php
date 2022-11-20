<?php
    include "Carrito.php";
    include 'datos_conexion/conexion.php';
    include "check-session.php";
    
    $numV = $_GET["numV"];

    $carrito = new Carrito();
    $carrito->deleteAgregado($numV, $con);

    header("location: agregados.php");
?>