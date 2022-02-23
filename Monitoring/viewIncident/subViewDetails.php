<?php
include_once("cntrViewIncident.php");
$objViewIncident=new ViewIncident();
$var1=$_GET['id_incidente'];
?>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="../css/tablas.css">
    <link rel="stylesheet" href="../css/posicionamiento.css">
  </head>
  <body>
    <?php $objViewIncident->obtenerTablaInfoRuta($var1); ?>
    <script type="text/javascript" src="../Monitoring/viewIncident/ajax.js"></script>
  </body>
</html>
