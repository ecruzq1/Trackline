<?php
include_once("cntrAssignRoute.php");
$objAssignRoute=new AssignRoute();
$objAssignRoute->obtenerUsuarios(1);
$objAssignRoute->obtenerPersonas(1);
$objAssignRoute->obtenerRutas(1);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Waypoints in directions</title>
    <link rel="stylesheet" href="../css/tablas.css">
    <link rel="stylesheet" href="../css/posicionamiento.css">
  </head>
  <body>
    <h1>Asignación de Rutas</h1>
    <div class="Div-Horizontal">
      <div class="SubDiv-Horizontal">
        <legend>Usuarios y rutas.</legend>
        <p>Seleccione al usuario para asignar una ruta.</p>
        <select id="selUser" class="form-control">
          <?php $objAssignRoute->userOptions();?>
        </select>
        <br><br>
        <p>Seleccione una ruta.</p>
        <select id="selRoute" name="selRoute" class="form-control">
          <?php $objAssignRoute->routeOptions();?>
        </select>
      </div>
      <div class="SubDiv-Horizontal" id="divD">
      </div>
    </div>
    <legend>Estado</legend>
<div id='respuesta'></div>

    <script type="text/javascript" src="../Route/assignRoute/ajax.js"></script>

  </body>
</html>
