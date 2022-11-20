<?php
    include "../frontEnd/contrasena/contrasena.html";
    include "Usuario.php";
    // Conectamos con la base de datos
    include 'datos_conexion/conexion.php';
    
    if(isset($_GET["email"])) {
        $email = $_GET["email"];
        $consulta = "SELECT contrasena FROM usuarios WHERE correo = '$email'";
        $resultado = $con->query($consulta);
        $fila = $resultado->fetch_array();

        echo "<br><br><h2>Su contraseña es: <h2>".$fila[0];
    }
?>