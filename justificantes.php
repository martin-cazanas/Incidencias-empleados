<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tercer examen departamental</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <link rel="stylesheet" href="style_justificantes.css">
    </head>
    <body>
        <header>
            <nav class="navbar navbar-light bg-light" style="background-color: #e3f2fd;">
                <div class="container-fluid">
                    <a class="navbar-brand" href="./">
                        <img src="poo_icon.jpg" alt="icono" width="50px" class="d-inline-block align-text-center">
                        <b>Programación Orientada a Objetos</b>
                    </a>
                    <button class="btn btn-outline-secondary" onclick="logout();">Cerrar Sesión</button>
                </div>
            </nav>
        </header>
        <div class="container-fluid">
            <div class="row" style="margin-top: 1cm;">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <h2>Registro de justificantes por empleado</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10" style="margin-top: 1.5cm;">
                    <form action="" method="POST">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="clave" class="form-label">Clave</label>
                                <select class="form-select" id="clave" name="clave" onchange="loadDates();">
                                    <option value="nada">--Seleccionar</option>
                                    <?php
                                        loadClave();
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
                                        function loadClave(){
                                            $conexion = conectar();
                                            $comando = "SELECT CCVEEMP, CONCAT(' - ', CNOMBRE, ' ', CAPEUNO, ' ', CAPEDOS) FROM ddatemp";
                                            $result = mysqli_query($conexion, $comando);
                                            while($row = mysqli_fetch_array($result)){
                                                echo("
                                                    <option value='".$row[0]."'>".$row[0].$row[1]."</option>
                                                ");
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="fecha" class="form-label">Fecha de incidencia</label>  
                                <select name="fecha" id="fecha" class="form-select">
                                    <option value="nada">--Seleccionar</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="justi" class="form-label">Justificante</label>
                                <select name="justi" id="justi" class="form-select">
                                    <option value="nada">--Seleccionar</option>
                                    <?php
                                        loadJustis();
                                        function loadJustis(){
                                            $conexion = conectar();
                                            $comando = "SELECT CDESJUS FROM cjusasi";
                                            $result = mysqli_query($conexion, $comando);
                                            $contador = 0;
                                            while($row = mysqli_fetch_array($result)){
                                                $contador++;
                                                echo("
                                                    <option value='$contador'>".$row[0]."</option>
                                                ");
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="estastus" class="form-label">Estatus</label>
                                <select name="estatus" id="estatus" class="form-select">
                                    <option value="nada">--Seleccionar</option>
                                    <option value="A">Activo</option>
                                    <option value="I">Inactivo</option>
                                </select>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 1cm;">
                            <div class="col-md-12">
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button class="btn btn-secondary btn-lg" type="button" onclick="redirectHome();">Regresar</button>
                                    <button class="btn btn-success btn-lg" name="consult">Consultar</button>
                                    <button class="btn btn-warning btn-lg" name="update" id="update" disabled>Actualizar</button>
                                    <button class="btn btn-danger btn-lg" name="delete" id="delete" disabled>Eliminar</button>
                                    <button class="btn btn-primary btn-lg" name="save">Guardar</button>
                                    <input type="hidden" id="confirm" name="confirm">
                                </div>
                                <?php
                                    if(isset($_POST["save"])){
                                        $clave = $_POST["clave"];
                                        $fecha = $_POST["fecha"];
                                        $tipo = $_POST["justi"];
                                        $estat = $_POST["estatus"];
                                        if($clave != "nada"){
                                            if($fecha != "nada"){
                                                if($tipo != "nada"){
                                                    if($estat != "nada"){
                                                        guardar($clave, $fecha, $tipo, $estat);
                                                    }
                                                    else{
                                                        echo("
                                                            <script>
                                                                window.alert('Por favor selecciona un estatus valido');
                                                            </script>
                                                        ");
                                                    }
                                                }else{
                                                    echo("
                                                        <script>
                                                            window.alert('Por favor selecciona un justificante valido');
                                                        </script>
                                                    ");
                                                }
                                            }else{
                                                echo("
                                                    <script>
                                                        window.alert('Por favor selecciona una fecha valida');
                                                    </script>
                                                ");
                                            }
                                        }else{
                                            echo("
                                                <script>
                                                    window.alert('Por favor selecciona una clave valida');
                                                </script>
                                            ");
                                        }
                                    }
                                    if(isset($_POST["delete"])){
                                        echo("
                                            <script>
                                                if(window.confirm('¿Estás seguro de eliminar el justificante seleccionado?'))
                                                    confirmado();
                                                else
                                                    denegado();
                                            </script>
                                        ");
                                        if($_POST["confirm"] == "si"){
                                            echo $_POST["confirm"];
                                        }else
                                            echo $_POST["confirm"];
                                    }
                                    function guardar($gclave, $gfecha, $gtipo, $gestatus){
                                        $conexion = conectar();
                                        $comando = "SELECT CTIPINC FROM tincemp WHERE CCVEEMP = $gclave AND DFECINC = '$gfecha'";
                                        $result = mysqli_query($conexion, $comando);
                                        $row = mysqli_fetch_array($result);
                                        $comando = "UPDATE tincemp SET CSTATUS = 'B' WHERE CCVEEMP = '$gclave' AND DFECINC = '$gfecha' AND CTIPINC = '".$row[0]."'";
                                        if($conexion->query($comando) === true){
                                            $comando = "INSERT INTO pjusasi VALUES('$gclave', '$gfecha', '$gtipo', '$gestatus', SUBSTR(CURRENT_USER(), 1, 10), CURRENT_DATE(), NULL, NULL)";
                                            if($conexion->query($comando) === true){
                                                echo("
                                                    <script>
                                                        window.alert('Se agrego el justificante correctamente');
                                                    </script>
                                                ");
                                            }else
                                                die("No se pudo agregar el justificante debido a: ".$conexion->error);
                                        }else
                                            die("No se pudo agregar el justificante por un error de actualización: ".$conexion->error);
                                    }
                                ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row" style="margin-top: 2cm;">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <table class='table table-secondary table-striped'>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Clave y nombre del empleado</th>
                                <th>Fecha de incidencia</th>
                                <th>Tipo de justificante</th>
                                <th>Estatus</th>
                                <th colspan="2">Seleccionar</th>
                            </tr>
                        </thead>
                        <tbody id="table">
                        <?php
                            if(isset($_POST["consult"])){
                                if($_POST["clave"] == "nada"){
                                    consulta("");
                                }else{
                                    consulta(" WHERE CCVEEMP = ".$_POST["clave"]);
                                }
                            }
                        ?>
                        </tbody>
                    </table>
                    <?php
                        function consulta($condicion){
                            $conexion = conectar();
                            $comando = "SELECT * FROM pjusasi".$condicion;
                            $result = mysqli_query($conexion, $comando);
                            $contador = 0;
                            while($row = mysqli_fetch_array($result)){
                                $contador++;
                                $comando = "SELECT CDESJUS FROM cjusasi WHERE NIDTPJU = ".$row[2];
                                $result1 = mysqli_query($conexion, $comando);
                                $jus = mysqli_fetch_array($result1);
                                $comando = "SELECT CONCAT(CNOMBRE, ' ', CAPEUNO, ' ', CAPEDOS) FROM ddatemp WHERE CCVEEMP = ".$row[0];
                                $result2 = mysqli_query($conexion, $comando);
                                $name = mysqli_fetch_array($result2);
                                if($row[3] == "A")
                                    $stat = "Activo";
                                else if($row[3] == "I")
                                    $stat = "Inactivo";
                                ?>
                                <tr>
                                    <td><?php echo $contador?></td>
                                    <td id="<?php echo "c$contador"?>"><?php echo $name[0]?></td>
                                    <td id="<?php echo "f$contador"?>"><?php echo $row[1]?></td>
                                    <td id="<?php echo "j$contador"?>"><?php echo $jus[0]?></td>
                                    <td id="<?php echo "s$contador"?>"><?php echo $stat?></td>
                                    <td></td>
                                    <td><input type="radio" name="select" id="<?php echo $contador?>" class="form-check-input" onchange="manageActions(this);"></td>
                                </tr>
                                <?php
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
        <script src="script_justificantes.js"></script>
    </body>
</html>