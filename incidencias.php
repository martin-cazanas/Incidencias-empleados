<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Tercer examen departamental</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <link href="style_incidencias.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="script_incidencias.js"></script>
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
                    <h2>Incidencias por empleado</h2>
                </div>
            </div>
            <div class="row" style="margin-top: 1.5cm;">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <form action="" method="POST">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="form-label" for="action"></label>
                                <select class="form-select" id="action" name="action" onchange="actions();">
                                    <option value="nada">--Seleccionar</option>
                                    <option value="insert">Agregar incidencia</option>
                                    <option value="manage">Administrar incidencias</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row" style="margin-top: 1cm;" hidden=true id="insert">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <form class="row" action="incidencias.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label" for="clave">Clave de empleado</label>
                            <select class="form-select" id="clave" name="clave">
                                <option value="nada">--Seleccionar</option>
                                <?php
                                    employs();
                                    function conectar(){
                                        $server = "localhost";
                                        $user = "root";
                                        $password = "admin";
                                        $db = "dbregasi";
                                        $conexion = mysqli_connect($server, $user, $password, $db);
                                        if(mysqli_connect_errno()){
                                            echo("
                                                <script>
                                                    window.alert('No se pudo conectar a la base de datos');
                                                </script>
                                            ");
                                            exit();
                                        }
                                        return $conexion;
                                    }
                                    function employs(){
                                        $conexion = conectar();
                                        $comando = "SELECT CCVEEMP, CONCAT(' - ', CNOMBRE, ' ', CAPEUNO, ' ', CAPEDOS) AS clave FROM ddatemp";
                                        $consulta = mysqli_query($conexion, $comando);
                                        while($row = mysqli_fetch_array($consulta)){
                                            
                                            echo ("
                                                <option value=".$row[0].">".$row[0].$row[1]."</option>
                                            ");
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="date">Fecha de incidencia</label>
                            <input class="form-control" type="date" id="date" name="date">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="incidencia">Tipo de incidencia</label>
                            <select class="form-select" id="incidencia" name="incidencia">
                                <option value="nada">--Seleccionar</option>
                                <option value="N">Retardo Menor</option>
                                <option value="Y">Retardo Mayor</option>
                                <option value="L">Falta por llegar tarde</option>
                                <option value="A">Falta por salida anticipada</option>
                                <option value="O">Falta por omisión de salida</option>
                                <option value="D">Falta por todo el día</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button class="btn btn-primary" name="registro">Registrar incidencia</button>
                            </div>
                        </div>
                        <?php
                            if(isset($_POST["registro"])){
                                $empleado = $_POST["clave"];
                                if($empleado != "nada"){
                                    if(!empty($_POST["date"])){
                                        $tipo = $_POST["incidencia"];
                                        if($tipo != "nada"){
                                            $fecha = $_POST["date"];
                                            /*$fecha_date = strtotime($fecha);
                                            $hoy = strtotime(date("d-m-y", time()));
                                            if($fecha_date > $hoy)
                                                echo("
                                                    <script>
                                                        window.alert('No se puede agregar una incidencia de una fecha futura');
                                                    </script>
                                                ");
                                            else{*/
                                                addIncidencia($empleado, $fecha, $tipo);
                                            //}
                                        }else{
                                            echo("
                                                <script>
                                                    window.alert('Por favor selecciona un tipo de incidencia');
                                                </script>
                                            ");
                                        }
                                    }else{
                                        echo("
                                            <script>
                                                window.alert('Por favor selecciona una fecha de incidendia');
                                            </script>
                                        ");
                                    }
                                }else{
                                    echo("
                                        <script>
                                            window.alert('Por favor selecciona un empleado');
                                        </script>
                                    ");
                                }
                            }
                            function addIncidencia($clave, $date, $type){
                                $conexion = conectar();
                                $comando = "SELECT COUNT(*) FROM tincemp WHERE DFECINC = '$date'";
                                $result = mysqli_query($conexion, $comando);
                                $row = mysqli_fetch_array($result);
                                if($row[0] > 0){
                                    echo("
                                        <script>
                                            window.alert('El empleado que selecciono ya tiene una incidencia asociada a ese día');
                                        </script>
                                    ");
                                }
                                else{
                                    $comando = "INSERT INTO tincemp VALUES('$clave', '$date', '$type', 'A', SUBSTR(CURRENT_USER(), 0, 1), CURRENT_DATE(), NULL, NULL)";
                                    if($conexion->query($comando) === true){
                                        echo("
                                            <script>
                                                window.alert('Se ha agregado la incidencia correctamente');
                                            </script>
                                        ");
                                    }
                                    else{
                                        die("No se pudo agregar la incidencia ".$conexion->error);
                                    }
                                }
                            }
                        ?>
                    </form>
                </div>
            </div>
            <div  id="manage"  hidden>
                <div class="row" style="margin-top: 1cm;">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <table class="table table-secondary table-striped caption-top">
                            <caption><h4 style="color: black;">Tabla de incidencias</h4></caption>
                            <thead>
                                <tr class='table-secondary'>
                                    <th>Id</th>
                                    <th colspan="4">Clave y nombre de empleado</th>
                                    <th colspan="3">Tipo de incidencia</th>
                                    <th colspan="2">Fecha</th>
                                    <th>Estatus</th>
                                    <th colspan="2">Seleccionar</th>
                                </tr>
                            </thead> 
                            <tbody>
                                <?php
                                    loadTable();
                                    function loadTable(){
                                        $conexion = conectar();
                                        $comando = "SELECT CONCAT(E.CCVEEMP, CONCAT(' - ', E.CNOMBRE, ' ', E.CAPEUNO, ' ', E.CAPEDOS)) AS clave, I.CTIPINC AS tipo, I.DFECINC AS fecha, I.CSTATUS AS estatus FROM ddatemp E, tincemp I WHERE I.CCVEEMP = E.CCVEEMP";
                                        $result = mysqli_query($conexion, $comando);
                                        $contador = 0; 
                                        $inc = "";
                                        $est = "";
                                        while($row = mysqli_fetch_array($result)){
                                            if($row["tipo"] == "N")
                                                $inc = "Retardo Menor";
                                            else if($row["tipo"] == "Y")
                                                $inc = "Retardo Mayor";
                                            else if($row["tipo"] == "L")
                                                $inc = "Falta por llegar tarde";
                                            else if($row["tipo"] == "A")
                                                $inc = "Falta por salida anticipada";
                                            else if($row["tipo"] == "O")
                                                $inc = "Falta por omisión de salida";
                                            else if($row["tipo"] == "D")
                                                $inc = "Falta por todo el día";
                                            if($row["estatus"] == "A")
                                                $est = "Activo";
                                            else if($row["estatus"] == "B")
                                                $est = "Baja";
                                            $contador++;
                                            echo("
                                                <tr>
                                                    <td>$contador</td>
                                                    <td colspan='4' id='clave$contador'>".$row["clave"]."</td>
                                                    <td colspan='3' id='tipo$contador'>$inc</td>
                                                    <td colspan='2' id='fecha$contador'>".$row["fecha"]."</td>
                                                    <td id='estat$contador'>$est</td>
                                                    <td></td>
                                                    <td><input class'form-check-input' type='radio' name='selected' id='$contador' onchange='manageActions(this);'></td>
                                                </tr>
                                            ");
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row" style="margin-top: 1cm;">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <form class="row">
                            <div class="mb-3">
                                <select class="form-select" id="manageAction" name="manageAction" onchange='manageTasks(this);' disabled>
                                    <option value="nada">--Seleccionar</option>
                                    <option value="update">Editar</option>
                                    <option value="delete">Eliminar</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
                <div id="delete" hidden>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <form class="row" action="incidencias.php" method="POST">
                                <div class="mb-3">
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <label class="form-label"><h5>¿Estás seguro de querer eliminar la incidencia seleccionada?</h5></label>
                                        <button class="btn btn-danger" name="borrar">Eliminar Incidencia</button>
                                        <input type="hidden" id="clave_del" name="clave_del">
                                        <input type="hidden" id="tipo_del" name="tipo_del">
                                        <input type="hidden" id="fecha_del" name="fecha_del">
                                        <?php
                                            if(isset($_POST["borrar"])){
                                                if(!empty($_POST["clave_del"]) && !empty($_POST["tipo_del"]) && !empty($_POST["fecha_del"])){
                                                    deleteInc($_POST["clave_del"], $_POST["tipo_del"], $_POST["fecha_del"]);
                                                }
                                            }
                                            function deleteInc($clave_del, $tipo_del, $fecha_del){
                                                $conexion = conectar();
                                                $comando = "DELETE FROM tincemp WHERE CCVEEMP = '$clave_del' AND DFECINC = '$fecha_del' AND CTIPINC = '$tipo_del'";
                                                if($conexion->query($comando) === true){
                                                    echo("
                                                        <script>
                                                            window.alert('Se elimino la incidencia correctamente.');
                                                            location.href = './';
                                                        </script>
                                                    ");
                                                }else
                                                    die("Ocurrio un error y no se pudo eliminar la incidencia".$conexion->error);
                                            }
                                        ?>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id="edit" hidden>
                    <div class="row" style="margin-top: 1cm;">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <form class="row" action="" method="POST">
                                <div class="mb-3">
                                    <label class="form-label" for="clave_edit">Clave y nombre de empleado</label>
                                    <select class="form-select" id="clave_edit" name="clave_edit">
                                            <option value="nada">--Seleccionar</option>
                                            <?php
                                                employs();
                                            ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="fecha_edit">Fecha de incidencia</label>
                                    <input class="form-control" type="date" id="fecha_edit" name="fecha_edit">
                                </div>
                                <div class="mb-3">
                                    <label for="tipo_edit" class="form-label">Tipo de incidencia</label>
                                    <select name="tipo_edit" id="tipo_edit" class="form-select">
                                        <option value="nada">--Seleccionar</option>
                                        <option value="N">Retardo Menor</option>
                                        <option value="Y">Retardo Mayor</option>
                                        <option value="L">Falta por llegar tarde</option>
                                        <option value="A">Falta por salida anticipada</option>
                                        <option value="O">Falta por omisión de salida</option>
                                        <option value="D">Falta por todo el día</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="stat_edit" class="form-label">Estatus</label>
                                    <select name="stat_edit" id="stat_edit" class="form-select">
                                        <option value="nada">--Seleccionar</option>
                                        <option value="A">Activo</option>
                                        <option value="B">Baja</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <button class="btn btn-primary" name="editar">Guardar cambios</button>
                                        <input type="hidden" id="hcup" name="hcup">
                                        <input type="hidden" id="hfup" name="hfup">
                                        <input type="hidden" id="htup" name="htup">
                                        <input type="hidden" id="hsup" name="hsup">
                                        <?php
                                            if(isset($_POST["editar"])){
                                                if(!empty($_POST["clave_edit"]) && !empty($_POST["fecha_edit"]) && !empty($_POST["tipo_edit"]) && !empty($_POST["stat_edit"])){
                                                    $clave_up = $_POST["clave_edit"];
                                                    $fecha_up = $_POST["fecha_edit"];
                                                    $tipo_up = $_POST["tipo_edit"];
                                                    $stat_up = $_POST["stat_edit"];
                                                    $temps = array($_POST["hcup"], $_POST["hfup"], $_POST["htup"], $_POST["hsup"]);
                                                    if($clave_up != "nada" && $tipo_up != "nada" && $stat_up != "nada"){
                                                        updateInc($clave_up, $tipo_up, $stat_up, $fecha_up, $temps);
                                                    }
                                                }
                                            }
                                            function updateInc($cup, $tup, $sup, $fup, $before){
                                                $conexion = conectar();
                                                $comando = "UPDATE tincemp SET CCVEEMP = '$cup', DFECINC = '$fup', CTIPINC = '$tup', CSTATUS = '$sup', CUSUMOD = SUBSTR(CURRENT_USER(), 1, 10), DFECMOD = CURRENT_DATE() WHERE CCVEEMP ='".$before[0]."' AND DFECINC ='".$before[1]."' AND CTIPINC = '".$before[2]."';";
                                                if($conexion->query($comando) === true){
                                                    echo("
                                                        <script>
                                                            window.alert('Se realizo la actualización de los datos correctamente');
                                                            location.href = './';
                                                        </script>
                                                    ");
                                                }else
                                                    die("No se pudo realizar la actualización de los datos debido a: $conexion->error");
                                            }
                                        ?>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div id="nada"></div>
        </div>
    </body>
</html>