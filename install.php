<?php

if($_POST){
    $host = $_POST['host'];
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $name = $_POST['name'];

    $con = mysqli_connect($host, $user, $pass);

    if($con == false){
        header("location: install.php?error=wrong");
    } else {
        $sql = "CREATE DATABASE {$name}";
        mysqli_query($con, $sql);

        mysqli_query($con, "use {$name}");
        $sql = "DROP TABLE IF EXISTS 'personas';";
        mysqli_query($con, $sql);

        // Personas

        $sql = "CREATE TABLE `personas` (
            `id` int(11) NOT NULL,
            `nombre` varchar(50) NOT NULL,
            `apellido` varchar(50) NOT NULL,
            `pasaporte` varchar(50) NOT NULL,
            `correo` varchar(50) NOT NULL,
            `telefono` varchar(50) NOT NULL,
            `pais` varchar(50) NOT NULL,
            `fecha` varchar(50) NOT NULL,
            `numero` varchar(50) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        ";
        mysqli_query($con, $sql);

        $sql = "ALTER TABLE `personas`
        ADD PRIMARY KEY (`id`);
        ";
        mysqli_query($con, $sql);

        $sql = "ALTER TABLE `personas`
            MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
        ";
        mysqli_query($con, $sql);

        // Usuarios 

        $sql = "CREATE TABLE `usuarios` (
            `id` int(11) NOT NULL,
            `user` varchar(50) NOT NULL,
            `pass` varchar(50) NOT NULL,
            `tipo` varchar(50) NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        ";
        mysqli_query($con, $sql);

        $sql = "ALTER TABLE `usuarios`
        ADD PRIMARY KEY (`id`);
        ";
        mysqli_query($con, $sql);

        $sql = "ALTER TABLE `usuarios`
            MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
        ";
        mysqli_query($con, $sql);

        // Historial

        $sql = "CREATE TABLE `historial` (
            `id` int(11) NOT NULL,
            `time` varchar(50) NOT NULL,
            `tipo` varchar(50) NOT NULL,
            `afectado` varchar(50) NOT NULL,
            `usuario` varchar(50) NOT NULL,
            `ip` varchar(50) NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        ";
        mysqli_query($con, $sql);

        $sql = "INSERT INTO `usuarios` (`id`, `user`, `pass`, `tipo`) VALUES
        (1, 'admin', '123', 'admin'),
        (2, 'normal', '123', 'normal');
        ";
        mysqli_query($con, $sql);

        $sql = "ALTER TABLE `historial`
        ADD PRIMARY KEY (`id`);
        ";
        mysqli_query($con, $sql);

        $sql = "ALTER TABLE `historial`
            MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
        ";
        mysqli_query($con, $sql);

        $info = "<?php
            define('DB_HOST', '{$host}');
            define('DB_USER', '{$user}');
            define('DB_PASS', '{$pass}');
            define('DB_NAME', '{$name}');
        ?>";

        file_put_contents("libs/configx.php", $info);
        header("location: index.php");            
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instalador</title>
    <link rel="stylesheet" href="views/css/bulma.css">
</head>
<body>
<section class="my-6">
    <div>
        <div class="box" style="width: 520px;position: relative;left: 50%;top: 25px;transform: translate(-50%);">
            <p class="title is-3 ml-5 mb-5 has-text-primary">Instalador</p>
            <p class="subtitle is-5 ml-5 mb-5">Como este proryecto utiliza una base de datos local "MySQL" este necesita instalar la base de datos. llene esto con su datos de XAMPP, WAMP o cualquier otro medio para usar php que utilize.</p>
            <?php
                if(isset($_GET['error'])){
                    if($_GET['error'] == 'wrong'){
                        ?>
                            <P class="has-text-white has-background-danger mb-5" style="text-align: center; border-radius: 5px">Algo está mal, revisa e intenta de nuevo</P>
                        <?php
                    }
                }
            ?>
            <form action="" method="post">
                
                <div class="field is-horizontal">
                    <div class="field mx-5">
                        <label class="label">Host</label>
                        <div class="control">
                            <input class="input" type="text" name="host" required placeholder="localhost">
                        </div>
                    </div>

                    <div class="field mx-5">
                        <label class="label">User</label>
                        <div class="control">
                            <input class="input" type="text" name="user" required placeholder="root">
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field mx-5">
                        <label class="label">Pass</label>
                        <div class="control">
                            <input class="input" type="password" name="pass" placeholder="password">
                        </div>
                    </div>

                    <div class="field mx-5">
                        <label class="label">Database name</label>
                        <div class="control">
                            <input class="input" type="text" name="name" required placeholder="database">
                        </div>
                    </div>
                </div>

                <div class="field is-grouped is-grouped-right mr-5">
                    <p class="control">
                        <button class="button is-success" type="submit">
                            Instalar
                        </button>
                    </p>
                </div>

            </form>
        </div>
    </div>
</section>
</body>
</html>