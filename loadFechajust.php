<?php
    if(isset($_POST)){
        $conexion = conectar();
        $clave = $_POST["clave"];
        $comando = "SELECT * FROM tincemp WHERE CCVEEMP = $clave AND CSTATUS = 'A'";
        $result = mysqli_query($conexion, $comando);
        while($row = mysqli_fetch_array($result)){
            echo("
                <option>".$row[1]."</option>
            ");
        }
    }
    function conectar(){
        $server = "localhost";
        $user = "root";
        $password = "admin";
        $db = "dbregasi";
        $conexion = mysqli_connect($server, $user, $password, $db);
        if(mysqli_connect_errno()){
            echo ("
                <script>
                    window.alert('Fallo al conectar a la base de datos');
                </script>
            ");
            exit();
        }
        return $conexion;
    }
?>