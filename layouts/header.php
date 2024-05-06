<?php if(!isset($_SESSION)) { session_start(); } ?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Empleados</title> 
    <link rel="icon" href="images/icono.png">

    <link href="css/bootstrap/bootstrap.min.css" rel="stylesheet" />
    
    <link id="theme" href="css/page/style.css" rel="stylesheet" />

    <script src="js/jquery/jquery-3.5.1.js" charset="UTF-8"></script>
    <script src="js/popper.js" charset="UTF-8"></script>
    <script src="js/bootstrap/bootstrap.js" charset="UTF-8"></script>
    
    <script src="js/charts/highcharts.js" charset="UTF-8"></script>
    <script src="js/charts/exporting.js" charset="UTF-8"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    </head>
    <body>
        <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-primary">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand mx-2" href="index.php">Sistema</a>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active"><a class="nav-link" href="index.php" name="inicio"><i class="fa fa-home espacio-icono" aria-hidden="true"></i></span>Inicio<span class="sr-only"></span></a></li>
                     <li class="nav-item"><a class="nav-link" href="index.php?tipo=listar" name="inicio"><i class="fa fa-user espacio-icono" aria-hidden="true"></i></span>Empleados</a></li>   
                     <li class="nav-item"><a class="nav-link" href="index.php?tipo=estadisticas" name="inicio"><i class="fa fa-chart-simple espacio-icono" aria-hidden="true"></i></span>Estadísticas<span class="sr-only"></span></a></li>                                       
                </ul>
            </div>
        </nav>     
        <section>
          <div class="container-fluid" style="margin-top: 100px">
          <?php

            while (! file_exists("functions") ) {
                chdir("..");
            }

            include_once("config/vars.php");

            global $session_mensaje;

            if(isset($_SESSION[$session_mensaje])) {
                $mensaje = $_SESSION[$session_mensaje];
                unset($_SESSION[$session_mensaje]);
                echo "<div class=\"alert alert-secondary alert-dismissible fade show\" role=\"alert\" style=\"margin-bottom: 50px\">";
                echo "<strong>" . htmlentities($mensaje) . "</strong>";
                echo "<button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>";
                echo "</div>";
            }

          ?>