<?php
include_once('cntrAssignRoute.php');
$objAssignRoute=new AssignRoute();
$var1=$_GET['idRoute'];
date_default_timezone_set('America/Guayaquil');
$fechaActual = date('Y-m-d');
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">

  </head>
  <body>
    <legend>Configuración de Ruta</legend>

    <p>Seleccione una fecha.</p>
    <input type="date" class="form-control" id="dateTime"  name="dateTime" value="<?php echo $fechaActual;?>" min="<?php echo $fechaActual;?>">
    <p>Escoja la hora de inicio (Ejemplo 06:36 AM).</p>
    <input type="time" class="form-control" id="hourTime"  name="hourTime" value="" min="07:00" max="18:00">
    <br>
    <p>Coloque los tiempos de cada local.</p>
    <table class="tb-Datos">
      <?php $objAssignRoute->obtenerTablaSitios($var1,1); ?>
    </table>
    <br>
    <input id="btnSaveConf" type="button" class="btn btn-info" name="btnSaveConf" value="Asignar Ruta">
    <script type="text/javascript" src="../Route/assignRoute/ajax.js"></script>
  </body>
</html>
