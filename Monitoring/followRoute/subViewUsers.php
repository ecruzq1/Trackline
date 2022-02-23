<?php
include_once("cntrFollowRoute.php");
$objFollowRoute=new FollowRoute();
$var1=$_GET['fecha'];
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <p>Seleccione al usuario que desea monitorear.</p>
    <select id="selUser" class="form-control">
      <?php $objFollowRoute->userOptions($var1);?>
    </select>
  

    <script type="text/javascript" src="../Monitoring/followRoute/ajax.js"></script>
  </body>
</html>
