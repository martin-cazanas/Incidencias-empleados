<html>
    <head>
        <meta charset="UTF-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
        <script src="script.js"></script>
        <title>Tercer examen departamental</title>
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
                <div class="col-md-10">
                    <div class="alert alert-primary d-flex align-items-center" role="alert" style="margin-top: 3cm;">
                        <a class="alert-link" href="catalogo.php" id="inicio">Catálogo de justificantes</a>
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="alert alert-primary d-flex align-items-center" role="alert" style="margin-top: 0.5cm;">
                        <a class="alert-link" href="justificantes.php" id="inicio">Justificantes por empleado</a>
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="alert alert-primary d-flex align-items-center" role="alert" style="margin-top: 0.5cm;">
                        <a class="alert-link" href="incidencias.php" id="inicio">Incidencias por empleado</a>
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
    </body>
</html>