<?php
    session_start();
    if($_SESSION["user"] == null){
        header("location: ../../index.php");
    }

    include("../../libs/utils.php");
    include("../shared/header.php");

    $datos = conexion::select("personas");
    if($_POST){
        $datos = [$_POST["nombre"], $_POST["apellido"], $_POST["pasaporte"], $_POST["correo"], $_POST["telefono"], $_POST["pais"], $_POST["fecha"], $_POST["numero"], $_POST["id"]];
        if(isset($_GET["id"])){
            conexion::update($datos);
            conexion::insertHistorial($_SESSION["time"],"Actualizo una persona", $_POST['id'], $_SESSION["user"], $_SESSION["ip"]);
        } else {
            conexion::insert($datos);
            $id = conexion::id("personas");
            conexion::insertHistorial($_SESSION["time"],"Guardó una persona", $id['MAX(id)'], $_SESSION["user"], $_SESSION["ip"]);
        }
        header("location: home.php");
    }

    function Input($name, $label, $type, $valor="", $id="", $off=""){
        if(isset($_GET["id"])){
            $id = $_GET['id'];
            $data = conexion::selectWhereId($id);
            $valor = $data[0][$name];
        } else {
            $valor = "";
        }
        if($off === "off"){
            return 
            <<<INPUT
                <div class="field mx-5">
                    <div class="control">
                        <input value="{$valor}" name="${name}" type="{$type}" style='display: none;'>
                    </div>
                </div>
            INPUT;
        } else {
        return 
            <<<INPUT
                <div class="field mx-5">
                    <label class="label">{$label}</label>
                    <div class="control">
                        <input value="{$valor}" class="input" name="${name}" type="{$type}" required>
                    </div>
                </div>
            INPUT;
        }
    }

?>
<section class="my-6">
    <div>
        <div class="box" style="width: 520px;position: relative;left: 50%;top: 25px;transform: translate(-50%);">
            <p class="title is-3 ml-5 mb-5 has-text-primary">Registro de húesped</p>
            <form action="" method="post">
            <?= Input("id", "Nombre", "text", "", "","off"); ?>

                <div class="field is-horizontal">
                    <?= Input("nombre", "Nombre", "text"); ?>
                    <?= Input("apellido", "Apellido", "text"); ?>
                </div>

                <div class="field is-horizontal">
                    <?= Input("pasaporte", "Pasaporte", "text"); ?>
                    <?= Input("correo", "Correo", "email"); ?>
                </div>

                <div class="field is-horizontal">
                    <?= Input("telefono", "Telefono", "text"); ?>
                    <?= Input("pais", "Pais natal", "text"); ?>
                </div>

                <div class="field is-horizontal">
                    <?= Input("fecha", "Fecha de salida", "text"); ?>
                    <?= Input("numero", "Numero de habitacion", "number"); ?>
                </div>

                <div class="field is-grouped is-grouped-right mr-5">
                    <p class="control">
                        <a class="button is-light" onclick="limpiar();">
                            Limpiar
                        </a>
                    </p>
                    <p class="control">
                        <button class="button is-success" type="submit">
                            Guardar
                        </button>
                    </p>
                </div>

            </form>
        </div>
    </div>
</section>

<section class="mb-6">
    <table class="table is-stripped is-bordered" style="width: 520px;position: relative;left: 50%;top: 25px;transform: translate(-50%);">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Pasaporte</th>
                <th>Correo</th>
                <th>Telefono</th>
                <th>Pain Natal</th>
                <th>Fecha Salida</th>
                <th>Habitación</th>
                <th>Accion</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($datos as $dato){
                    echo "
                    <tr>
                        <td> {$dato['nombre']}</td>
                        <td> {$dato['apellido']}</td>
                        <td> {$dato['pasaporte']}</td>
                        <td> {$dato['correo']}</td>
                        <td> {$dato['telefono']}</td>
                        <td> {$dato['pais']}</td>
                        <td> {$dato['fecha']}</td>
                        <td> {$dato['numero']}</td>
                        <td>
                            <a href='home.php?id={$dato['id']}'>
                                <button class='button is-warning mx-2 my-2'>Editar</button>
                            </a>
                            <a href='../../libs/borrar.php?id={$dato['id']}&tabla=personas'>
                                <button class='button is-danger mx-2 my-2'>Borrar</button>
                            </a>
                        </td>
                    </tr>
                    ";
                }
            ?>
        </tbody>
    </table>
</section>
<script>
    function limpiar(){
        let inputs = document.querySelectorAll("input");
        if(inputs.length === 7){
            let i = 0;
            while(i < inputs.length){
                inputs[i].value = "";
                i++;
            }
        } else {
            let i = 1;
            while(i < inputs.length){
                inputs[i].value = "";
                i++;
            } 
        }
        inputs[0].focus();
    }
</script>
<?php
    include("../shared/footer.php");
?>