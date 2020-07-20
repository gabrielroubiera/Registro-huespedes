<?php
    session_start();
    if($_SESSION["user"] == null){
        header("location: ../../index.php");
    }
    include("../shared/header.php");
    include("../../libs/utils.php");

    if($_POST){
        $user = $_POST['usuario'];
        $pass = $_POST['clave'];
        $tipo = $_POST['tipo'];
        conexion::insertUser($user, $pass, $tipo);
        $id = conexion::id("usuarios");
        conexion::insertHistorial($_SESSION["time"],"Creo un usuario", $id['MAX(id)'], $_SESSION["user"], $_SESSION["ip"]);
        header("location: home.php");
    }
?>

<div class="container">
    <a href="home.php">
        <button class="button is-info my-5">Volver al inicio</button>
    </a>

    <form action="" method="post" style="width: 300px">
        <div class="field">
            <label class="label">Usuario</label>
            <div class="control">
                <input class="input" type="text" name="usuario">
            </div>
        </div>

        <div class="field">
            <label class="label">Clave</label>
            <div class="control">
                <input class="input" type="password" name="clave">
            </div>
        </div>

        <div class="field">
            <label class="label">Tipo de usuario</label>
            <div class="control">
                <div class="select">
                    <select name="tipo">
                        <option>normal</option>
                        <option>admin</option>
                    </select>
                </div>
            </div>
        </div>

        <button class="button is-success">Registrar</button>
    </form>
</div>