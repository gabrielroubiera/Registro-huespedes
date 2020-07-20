<?php
session_start();
include("utils.php");

$id = $_GET['id'];
$tabla = $_GET['tabla'];

$status = conexion::delete($id, $tabla);


if($status){
    conexion::insertHistorial($_SESSION["time"],"Eliminó una persona", $id, $_SESSION["user"], $_SESSION["ip"]);
    header("location: verify.php");
} else {
    ?>
    <h1>Ha ocurrido un error, intente de nuevo mas tarde.</h1>
    <?php
}

?>