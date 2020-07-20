<?php
    session_start();
    if($_SESSION["user"] == null){
        header("location: ../../index.php");
    }
    include("../shared/header.php");
    include("../../libs/utils.php");

    $datos_historial = conexion::select("historial");
    $datos_usuarios = conexion::select("usuarios");

?>
<div class="container" style="text-align: center;">
    <h1 class="title mt-6">Usuarios</h1>
    <a href="newUser.php">
        <button class="button is-info mb-3">Crear usuario</button>
    </a>
    <table class="table is-bordered is-striped" style="position: relative; left: 50%; transform: translate(-50%);">
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Tipo</th>
                <th>Clave</th>
                <th>Accion</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach($datos_usuarios as $datos_usuario){
                   echo"
                    <tr>
                        <td> {$datos_usuario['user']} </td>
                        <td> {$datos_usuario['tipo']} </td>
                        <td> {$datos_usuario['pass']} </td>
                        <td>
                            <a href='../../libs/borrar.php?id={$datos_usuario['id']}&tabla=usuarios'>
                                <button class='button is-danger mx-2 my-2'>Borrar</button>
                            </a>
                        </td>
                    </tr>
                    ";
                }
            ?>
        </tbody>
    </table>
    <h1 class="title mt-6">Historial</h1>
    <table class="table is-bordered is-striped mb-6" style="position: relative; left: 50%; transform: translate(-50%);">
        <thead>
            <tr>
                <th>Fecha y hora</th>
                <th>Info</th>
                <th>Id del afectado</th>
                <th>Usuario</th>
                <th>IP</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($datos_historial  as $dato_historial){
                    ?>
                        <tr>
                        <td><?php echo $dato_historial["time"] ?></td>
                        <td><?php echo $dato_historial["tipo"] ?></td>
                        <td><?php echo $dato_historial["afectado"] ?></td>
                        <td><?php echo $dato_historial["usuario"] ?></td>
                        <td><?php echo $dato_historial["ip"] ?></td>
                        </tr>
                    <?php
                }
            ?>
        </tbody>
    </table>
</div>
<?php
    include("../shared/footer.php");
?>