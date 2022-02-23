<?php
include_once('cntrAddRoute.php');
$objAddRoute=new AddRoute();

// Recupero variables del formulario
 $Nombre=$_POST['Nombre'];
 $Orden=$_POST['Orden'];
 $Ruta=$_POST['Ruta'];
 $Tiempo=$_POST['Tiempo'];
 $Distancia=$_POST['Distancia'];
 $Distancia=str_replace(",",".",$Distancia);


 //ejecucion sentencia SQL
 $result=$objAddRoute->crearRuta($Nombre,$Ruta,$Orden,$Tiempo,$Distancia);
 if(!$result==0){
   echo "<legend>Resultado</legend>";
   echo "<p>La ruta ha sido creado correctamente</p>";
 }
 else{
   echo "<legend>Resultado</legend>";
   echo "<p>No se pudieron guardar los datos de la ruta, vuelva a intentar mas tarde.</p>";
 }
 ?>
