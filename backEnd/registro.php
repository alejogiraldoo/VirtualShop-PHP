<?php
    include "../frontEnd/registro/registro.html";
    include 'Usuario.php';
    // Conectamos con la base de datos
    include 'datos_conexion/conexion.php';

    session_start();
    
    if(isset($_POST["registrar"])) {
        $id = $_POST["cedula"];
        $nombre = $_POST["nombre"];
        $telefono = $_POST["telefono"];
        $direccion = $_POST["direccion"];
        $user = $_POST["user"];
        $correo = $_POST["correo"];
        $pass = $_POST["pass"];
    
        $consultaUser = "SELECT usuario FROM usuarios WHERE usuario = '$user' AND correo = '$correo'";
        $resultadoUser = $con->query($consultaUser);
        $filaUser = $resultadoUser->fetch_array();
        
        if(!empty($filaUser)){
            echo "
                <script>
                    window.alert('Este nombre de usuario o corre electronico ya fue registrado.');
                </script>
            ";
        } else {
            // Insertamos los datos de registro del usuario
            $consulta = "INSERT INTO usuarios(id,nombre,direccion,telefono,usuario,correo,contrasena) 
            VALUES ('$id', '$nombre', '$direccion', '$telefono', '$user', '$correo', '$pass')";
            $con->query($consulta);

            // Obtenemos el numero del usuario registrado
            $consulta2 = "SELECT u.numUsu FROM usuarios as u WHERE u.id = $id";
            $resultado2 = $con->query($consulta2);
            $fila2 = $resultado2->fetch_array();

            // Obtenemos el numero del rol correspondiente a 'usuario'
            $consulta3 = "SELECT numRol,nombre FROM rol WHERE nombre = 'usuario'";
            $resultado3 = $con->query($consulta3);
            $fila3 = $resultado3->fetch_array();

            // Insertamos el numero de usuario y el numero de rol a rolesusuario
            $consulta4 = "INSERT INTO rolesusuario(numUsu, numRol) VALUES ($fila2[0], $fila3[0])";
            $con->query($consulta4);

            $_SESSION["user"] = new Usuario($fila2[0], $id, $nombre, $direccion, $telefono, $user, $correo, $pass, $fila3[1]);

            header('location: inventario.php');
        }
    } 
?>