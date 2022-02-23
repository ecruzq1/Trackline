<?php
include_once("cntrViewIncident.php");
$objViewIncident=new ViewIncident();
$var1=$_GET['fecha'];
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">

  </head>
  <body>
    <legend>Tabla de Incidentes. </legend>
    <p>Se muestran los incidenes para el dia: <?php echo $var1; ?></p>
    <table class="tb-Datos">
        <?php $objViewIncident->obtenerTablaIncidentes($var1); ?>
    </table>
    <script type="text/javascript" src="../Monitoring/viewIncident/ajax.js"></script>
  </body>
</html>
