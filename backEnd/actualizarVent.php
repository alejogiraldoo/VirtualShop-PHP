<?php
include "../frontEnd/actualizar-venta/actualizar-venta.html";
include "check-session.php";
include "Carrito.php";
include "Usuario.php";
include 'datos_conexion/conexion.php';

if (isset($_GET["actualizar"])){
    $consultaMetP = "SELECT * FROM metodopago";
    $resultadoMetP = $con->query($consultaMetP);
    $filaMetP = $resultadoMetP->fetch_all();

    $numV = $_GET["numV"];
    $cantidad = $_GET["cantidad"];
    $nombre = $_GET["nombre"];
    $numMetP = $_GET["numMetP"];

    $carrito = new Carrito();
    $carrito->updateAgregado($cantidad, $numV, $numMetP, 'carrito', $con);

    echo "<script>
        window.alert('Data has been updated succesfully. ');
        </script>";
}

$numV = $_GET["numV"];
$cantidad = $_GET["cantidad"];
$nombre = $_GET["nombre"];

$consultaMetP = "SELECT * FROM metodopago";
$resultadoMetP = $con->query($consultaMetP);
$filaMetP = $resultadoMetP->fetch_all();

echo '
    <main>
        <form action="actualizarVent.php" method="get">
            <div class="mb-3">
                <input name="numV" type="hidden" class="form-control" id="exampleInputText" aria-describedby="textHelp" value="'.$numV.'" readonly/>
            </div>
            <div class="mb-3">
                <input name="nombre" type="hidden" class="form-control" id="exampleInputText" aria-describedby="textHelp" value="'.$nombre.'" readonly/>
            </div>
            <h2>'. $nombre .'</h2>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Quantity</label>
                <input name="cantidad" type="number" class="form-control" id="exampleInputPassword1" required value="'.$cantidad.'" min="1"/>
            </div>';

    echo '<select name="numMetP" class="form-select" aria-label="Default select example" required>';
    $i = 0;
    echo "<option value='' disabled selected>".$_GET["nomMetP"]."</option>";
    while ($i < count($filaMetP)) {
        echo '<option value="'.$filaMetP[$i][0].'">'.$filaMetP[$i][1].'</option>';
        $i++;
    }
    echo '</select><br>';
    echo '
            <button name="actualizar" type="submit" class="btn btn-primary">Update</button>
        </form>
    </main>';
?>