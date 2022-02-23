<?php
session_start();
include("../Panel-Control/manejoPerfiles.php");
include_once("../php/Class/usuario.php");

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
  $usu=new usuario($_SESSION['username']);
  $usu->obtenerDatos();
  $obj=new manejoPerfiles($usu->Tipo);
  $_SESSION['ID']=$usu->ID;
  $_SESSION['Tipo']=$usu->Tipo;
} else {
  echo "<script language='javascript'> location.href ='sesion.html' </script>";
  exit;
}

$now = time();

if($now > $_SESSION['expire']) {
  session_destroy();
  echo "Su sesion a terminado,
  <a href='../index.html'>Necesita Hacer Login</a>";
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>Panel de Control</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--Bootstrap-->
<script type="text/javascript" src="../assets/bootstrap/3.3.7/jquery.min.js">
</script>
<!--Bootstrap-->
<link rel="stylesheet" href="../assets/bootstrap/3.3.7/css/bootstrap.min.css">
<script type="text/javascript" src="../assets/bootstrap/3.3.7/js/bootstrap.min.js">
</script>
<script type="text/javascript" src="../js/selector.js"></script>
<link rel="stylesheet" href="../css/estilos.css">
<link rel="stylesheet" href="../css/fuentes.css">
</head>

<body>
  <nav id="Cont-navbar"class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Bienvenido <?php echo $usu->Nombre;  ?> </a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">

          <?php $obj->mostrarOpciones(); ?>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href=logout.php><span class="glyphicon glyphicon-log-in"></span> Cerrar Sesion</a></li>
        </ul>
      </div>
    </div>
  </nav>

<div id="contenedor" >
  <div class="container">
    <h1>Panel de Control de <?php echo $usu->Nombre ?> </h1>
    <h4>Aqui irian los enlaces que le permitirian al usuario
    editar su perfil o cualquier otra cosa que desees.</h4>

    <ul>
      <li>Editar Perfil</li>
      <li>Crear Rutas</li>
      <li>Controlar incidencias</li>
      <li>etc.</li>
    </ul>
  </div>
</div>

<div class="container">
  <hr>
</div>


<footer class="container-fluid text-center">
  <p>&copy; 2018 saacdevelopers.com<p>
</footer>
</body>
</html>
