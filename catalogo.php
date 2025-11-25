<html>
    <head>
        <meta charset="UTF-8">
        <title>Tercer examen departamental</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <link rel="stylesheet" href="style_catalog.css">
        <script src="script_catalog.js"></script>
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
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10" style="margin-top: 1cm;">
                    <h2>Catálogo de justificantes de asistencias</h2>
                </div>
            </div>
            <div class="row" style="margin-top: 2cm;">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <form action="" method="POST">
                        <div class="row g-3">
                            <div class="col-md-1">
                                <label for="id" class="form-label"><h4>Id</h4></label>
                                <input type="number" class="form-control" id="id" name="id" max="99" min="1">
                            </div>
                            <div class="col-md-7">
                                <label for="description" class="form-label"><h4>Descripción del justificante</h4></label>
                                <input type="text" class="form-control" id="description" name="description">
                            </div>
                            <div class="col-md-4">
                                <label for="status" class="form-label"><h4>Estatus</h4></label>
                                <select class="form-select" id="status" name="status">
                                    <option>--Seleccionar</option>
                                    <option>Activo</option>
                                    <option>Inactivo</option>
                                </select>
                            </div>
                        </div>
                        <div class="row g-3" style="margin-top: 1cm;">
                            <div class="col-md-4"></div>
                            <div class="col-md-1">
                                <button class="btn btn-secondary btn-lg" type="button" onclick="redirectHome();">Regresar</button>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-1">
                                <button class="btn btn-primary btn-lg" name="save">Guardar</button>
                            </div>
                        </div>
                    </form>
                    <?php
                        if(isset($_POST["save"])){
                            if(!empty($_POST["id"])){
                                if(!empty($_POST["description"])){
                                    $estatus =  $_POST["status"];
                                    if($estatus != "--Seleccionar"){
                                        if($estatus == "Activo")
                                            $estatus = "A";
                                        else if($estatus == "Inactivo")
                                            $estatus = "I";
                                        $id = $_POST["id"];
                                        if(getId($id) != 0)
                                            echo("
                                                <script>
                                                    window.alert('Ya existe un regitro con ese número de id');
                                                </script>
                                            ");
                                        else{
                                            $description = $_POST["description"];
                                            insertar("('$id', '$description', '$estatus', SUBSTR(CURRENT_USER(), 1, 10), CURRENT_DATE(), NULL, NULL)");
                                        }
                                    }
                                    else
                                        echo("
                                            <script>
                                                window.alert(\"Por favor selecciona un estatus\");
                                            </script>
                                        ");
                                }
                                else
                                    echo("
                                        <script>
                                            window.alert(\"Por favor ingresa una descripción\");
                                        </script>
                                    ");
                            }
                            else
                            echo("
                                <script>
                                    window.alert(\"Por favor ingresa un id\");
                                </script>
                            ");
                        }
                        function getId($id){
                            $conexion = conectar();
                            $comando = "SELECT COUNT(*) FROM cjusasi WHERE NIDTPJU = $id";
                            $result = mysqli_query($conexion, $comando);
                            $row = mysqli_fetch_array($result);
                            return $row[0];
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
                            else
                            mysqli_set_charset($conexion, "UTF-8");
                            return $conexion;
                        }
                        function insertar($values){
                            $conexion = conectar();
                            $comando = "INSERT INTO cjusasi VALUES$values";
                            if($conexion->query($comando) === true){
                                echo("
                                    <script>
                                        window.alert('Se insertó la información correctamente');
                                    </Script>
                                ");
                            }else{
                                die("Se produjo un error al insertar la información" . $conexion->error);
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>