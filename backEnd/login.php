<?php
    include "../frontEnd/login/login.html";
    include "Usuario.php";
    // Conectamos con la base de datos
    include 'datos_conexion/conexion.php';

    session_start();

    if(isset($_POST["iniciar-sesion"])) {
        $user = $_POST["user"];
        $pass = $_POST["pass"];
        // Verifica que el usuario y la contraseña sean correctos
        $gateway = false;
        // // Realizamos una consulta a la base de datos para buscar el usuario insertado
        $consulta = "SELECT u.numUsu,u.id,u.nombre,u.direccion,u.telefono,u.usuario,u.correo,u.contrasena,r.nombre FROM usuarios as u 
        INNER JOIN rolesusuario as ru ON u.numUsu = ru.numUsu
        INNER JOIN rol as r ON r.numRol = ru.numRol
        WHERE u.usuario = '$user' AND u.contrasena = '$pass'";
        $resultado = $con->query($consulta);
        $fila = $resultado->fetch_all();

        if (!empty($fila)){
            $gateway = true;
            $_SESSION["user"] = new Usuario(
                $fila[0][0],
                $fila[0][1],
                $fila[0][2],
                $fila[0][3],
                $fila[0][4],
                $fila[0][5],
                $fila[0][6],
                $fila[0][7],
                $fila[0][8]
            );
            if(count($fila) > 1){
                echo "  
                <script>            
                    let answer = window.confirm('¿Do you want to Log In as User?');
                    if (answer){
                        window.alert('You have logged in as User');
                    }else{
                        window.alert('You have logged in as Administrator');
                    }
                    window.open('login.php?answer=' + answer,'_self');
                </script>
                ";
            }
        }

        if($gateway){
            echo "
                <script>
                    window.open('inventario.php','_self');
                </script>
            ";
        }else{
            echo "
                <script>
                    window.alert('The username or password is WRONG...');
                </script>
            ";
        }
    }
    
    if(isset($_GET["answer"])){
        if ($_GET["answer"] == 'true'){
            $_SESSION["user"]->setRol("usuario");
        }else{
            $_SESSION["user"]->setRol("administrador");
        }
        echo "
            <script>
                window.open('inventario.php','_self');
            </script>
        ";
    }
?>