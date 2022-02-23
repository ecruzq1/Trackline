<?php
include_once("cntrFollowRoute.php");
$objFollowRoute=new FollowRoute();
$objFollowRoute->obtenerUsuarios(1);
$objFollowRoute->obtenerPersonas(1);
$objFollowRoute->obtenerRutas(1);
date_default_timezone_set('America/Guayaquil');
$fechaActual = date('Y-m-d');
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
    <h1>Monitoreo de Rutas</h1>
    <div class="Div-Horizontal">
      <div class="SubDiv-Horizontal">
        <legend>Filtro de Fecha y Usuarios. </legend>
        <p>Seleccione una fecha.</p>
        <input type="date" class="form-control" id="dateTime"  name="dateTime" value="<?php echo $fechaActual;?>" >
        <br><br>
        <div id="divI-U">
          <p>Seleccione al usuario que desea monitorear.</p>
          <select id="selUser" class="form-control">
            <?php $objFollowRoute->userOptions($fechaActual);?>
          </select>
        </div>
      </div>
      <div class="SubDiv-Horizontal" id="divD">
      </div>
    </div>
    <legend>Detalle</legend>
    <div id='detalles'></div>
    <script type="text/javascript" src="../Monitoring/followRoute/ajax.js"></script>

  </body>
</html>
