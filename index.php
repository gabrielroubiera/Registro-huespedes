<?php
    session_start();

    if(isset($_SESSION["user"])){
        header("location: libs/verify.php");
    } 
    
    include("views/shared/header.php");
    include("libs/utils.php");
    if($_POST){
        $user = $_POST["user"];
        $pass = $_POST["contra"];
        $_SESSION["user"] = $user;
        $_SESSION["pass"] = $pass;
        header("location: libs/verify.php");
    }
?>
<section class="my-6">
    <div>
        <div class="box" style="width: 380px;position: relative;left: 50%;top: 100px;transform: translate(-50%);">
            <p class="title is-3 ml-5 mb-5 has-text-primary">Inicio de sesión</p>
            <form action="" method="post">
                <?php
                if(isset($_GET['error'])){
                    if($_GET['error'] == "login"){
                        ?>
                            <p class="title is-5 has-text-white has-background-danger px-2 py-2" style="text-align: center; border-radius: 5px;">El usuario no existe</p>
                        <?php
                    }
                }
                ?>
                <div class="field mx-5">
                    <label class="label">Usuario</label>
                    <div class="control">
                        <input class="input" type="text" name="user" required placeholder="admin">
                    </div>
                </div>

                <div class="field mx-5">
                    <label class="label">Contraseña</label>
                    <div class="control">
                        <input class="input" type="password" name="contra" required placeholder="123">
                    </div>
                </div>
                <div class="field is-grouped is-grouped-right mr-5">
                    <p class="control">
                        <button class="button is-success" type="submit">
                            Entrar
                        </button>
                    </p>
                </div>

            </form>
        </div>
    </div>
</section>