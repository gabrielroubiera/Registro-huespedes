<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Be live</title>
    <link rel="stylesheet" href="../css/bulma.css">
    <link rel="stylesheet" href="views/css/bulma.css">

</head>
<body>
<nav class="navbar px-4" role="navigation" aria-label="main navigation" style="box-shadow: 0 5px 7px #bababa;">
    <div class="container">
        <div class="navbar-brand">
            <p class="navbar-item title is-3 has-text-primary">Hotel Be live</p>
        </div>
        <?php
            if(isset($_SESSION["user"])){
                ?>
                    <div class="navbar-end">
                        <div class="navbar-item">
                            <div class="buttons">
                                <a class="button is-danger" href="../../libs/logout.php">
                                    <strong>Cerrar sesión</strong>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php
            }
        ?>
    </div>
</nav>