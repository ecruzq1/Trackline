<?php
include_once("cntrFollowRoute.php");
$objFollowRoute=new FollowRoute();
$var1=$_GET['id_visita'];
?>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="../css/tablas.css">
    <link rel="stylesheet" href="../css/posicionamiento.css">
  </head>
  <body>
    <table class="tb-Datos">
      <?php $objFollowRoute->obtenerTablaSitios($var1,1); ?>
    </table>
  </body>
</html>
