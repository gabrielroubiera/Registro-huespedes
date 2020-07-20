<?php

class conexion{

    static $instacia = null;
    public $myCon = null;

    function __construct(){
        $this->myCon = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if($this->myCon == false){
            echo "<script>
                window.location = '../install.php';
            </script>";
        }
    }

    function __destruct(){
        mysqli_close($this->myCon);
    }

    static function con(){
        if(self::$instacia == null){
            self::$instacia = new conexion();
        }
    }

    public static function select($table){
        self::con();
        
        $query = "SELECT * FROM $table";
        $rs = mysqli_query(self::$instacia->myCon, $query);

        $results = [];
        while($result = mysqli_fetch_assoc($rs)){
            $results[] = $result;
        }

        return $results;
    }

    public static function delete($id, $tabla){
        self::con();
        
        $query = "DELETE FROM {$tabla} WHERE id = '{$id}'";
        $rs = mysqli_query(self::$instacia->myCon, $query);
        return $rs;
    }

    public static function insert($datos){
        self::con();
        
        $query = "INSERT INTO personas(nombre, apellido, pasaporte, correo, telefono, pais, fecha, numero) VALUES ('{$datos[0]}','{$datos[1]}','{$datos[2]}','{$datos[3]}','{$datos[4]}','{$datos[5]}','{$datos[6]}','{$datos[7]}');";
        $rs = mysqli_query(self::$instacia->myCon, $query);
    }

    public static function update($datos){
        self::con();
        
        $query = "UPDATE personas SET nombre = '{$datos[0]}', apellido = '{$datos[1]}', pasaporte = '{$datos[2]}', correo = '{$datos[3]}', telefono = '{$datos[4]}', pais = '{$datos[5]}', fecha = '{$datos[6]}', numero = '{$datos[7]}' WHERE id = '{$datos[8]}';";
        $rs = mysqli_query(self::$instacia->myCon, $query);
    }

    public static function selectWhereId($id){
        self::con();
        
        $query = "SELECT * FROM personas WHERE id = '{$id}'";
        $rs = mysqli_query(self::$instacia->myCon, $query);

        $results = [];
        while($result = mysqli_fetch_assoc($rs)){
            $results[] = $result;
        }

        return $results;
    }

    public static function checkUserType($user, $pass){
        self::con();
        
        $query = "SELECT tipo FROM usuarios WHERE user = '{$user}' && pass = '{$pass}'";
        $rs = mysqli_query(self::$instacia->myCon, $query);

        $result = mysqli_fetch_assoc($rs);

        return $result;
    }

    public static function tablas(){
        self::con();
        
        $query = "SHOW TABLES;";
        $rs = mysqli_query(self::$instacia->myCon, $query);
       
        $results = [];
        while($result = mysqli_fetch_assoc($rs)){
            $results[] = $result;
        }

        return $results;
    }

    public static function insertHistorial($time, $tipo, $afectado, $usuario, $ip){
        self::con();
        
        $query = "INSERT INTO historial(time, tipo, afectado, usuario, ip) VALUES ('{$time}', '{$tipo}','{$afectado}','{$usuario}','{$ip}');";
        $rs = mysqli_query(self::$instacia->myCon, $query);
    }

    public static function id($tabla){
        self::con();
        
        $query = "SELECT MAX(id) FROM {$tabla}";
        $rs = mysqli_query(self::$instacia->myCon, $query);

        $result = mysqli_fetch_assoc($rs);

        return $result;
    }

    public static function insertUser($user, $pass, $tipo){
        self::con();
        
        $query = "INSERT INTO usuarios(user, pass, tipo) VALUES ('{$user}', '{$pass}','{$tipo}');";
        $rs = mysqli_query(self::$instacia->myCon, $query);
    }
}

?>