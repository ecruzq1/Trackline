<?php
include("manejoPerfiles.php");

$obj=new manejoPerfiles(1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="../js/subOpciones.js"></script>
  <link rel="stylesheet" href="../css/botones.css">
  <link rel="stylesheet" href="../css/estilos.css">
  <link rel="stylesheet" href="../css/fuentes.css">
</head>
<body>

<div class="container-fluid">
  <div class="row">
    <div id="panel-lateral" class="col-sm-1">
      <?php $obj->mostrarSubopciones($_GET['opcion']); ?>
    </div>
    <div id="cambio" class="col-sm-11 panel-contenido">
      <div class="panel-izquierdo">
        <?php $obj->mostrarDescripcion($_GET['opcion']); ?>
      </div>


    </div>
  </div>
</div>
