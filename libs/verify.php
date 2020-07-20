<?php
    session_start();
    include("utils.php");

    date_default_timezone_set("America/Santo_Domingo");
    
    $user = $_SESSION["user"];
    $pass = $_SESSION["pass"];
    $_SESSION["time"] =  date("d-m-Y (H:i:s)",time());
    
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    $_SESSION["ip"] = $ip;
    
    $tablas = conexion::tablas();
    $rows = count($tablas);
    if($rows == "3"){
        // Validacion login 
        $type = conexion::checkUserType($user, $pass);
    
        if($type == null){
            $_SESSION["user"] = null;
            $_SESSION["pass"] = null;
            header("location: ../index.php?error=login");
        } else {
            if($type['tipo'] == "normal"){
                header("location: ../views/user/home.php");
            } else if($type['tipo'] == "admin"){
                header("location: ../views/admin/home.php");
            }
        }
    }
    
?>