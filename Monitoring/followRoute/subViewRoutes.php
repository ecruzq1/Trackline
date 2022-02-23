<?php
include_once("cntrFollowRoute.php");
$objFollowRoute=new FollowRoute();
$var1=$_GET['idUser'];
$var2=$_GET['fecha'];
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <legend>Tabla de Rutas asignadas. </legend>
    <p>Se muestran todas las rutas asignadas para el día <?php echo $var2; ?> :</p>
    <table class="tb-Datos">
      <?php $objFollowRoute->obtenerTablaRutas($var1,$var2,1);?>
    </table>
    <script type="text/javascript" src="../Monitoring/followRoute/ajax.js"></script>
  </body>
</html>
