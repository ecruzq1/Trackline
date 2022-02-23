<?php
include_once('cntrAddUser.php');
$objAddUser=new AddUser();
$var1=$_GET['1'];
$var2=$_GET['2'];
$var3=$_GET['3'];

$var4=$_GET['4'];
$var5=$_GET['5'];
$var6=$_GET['6'];
$var7=$_GET['7'];
$var8=$_GET['8'];
$var9=$_GET['9'];
$var10=$_GET['10'];
$var4= str_replace("€", " ", $var4);
$var6= str_replace("€", " ", $var6);
$var7= str_replace("€", " ", $var7);
$var8= str_replace("€", " ", $var8);
$var9= str_replace("€", " ", $var9);
$var10= str_replace("€", " ", $var10);
$objAddUser->crearUsuario($var1,1,$var2,$var3,1,$var4,$var5,$var6,$var7,$var8,$var9,$var10); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">

  </head>
  <body>
    <h1>Resultado de la operacion.</h1>
    <?php $objAddUser->mensajeCreacion(); ?>
  </body>
</html>
