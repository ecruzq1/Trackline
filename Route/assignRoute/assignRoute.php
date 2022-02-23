 <?php
 include_once('cntrAssignRoute.php');
 $objAssignRoute=new AssignRoute();

 // Recupero variables del formulario
  $types=$_POST['types'];
  $times=$_POST['times'];
  $date=$_POST['date'];
  $time=$_POST['time'];
  $user=$_POST['user'];
  $route=$_POST['route'];

  //ejecucion sentencia SQL
  $result=$objAssignRoute->crearRuta($route,$user,$date,$types,$time,$times);
  echo "<h3>Estado del sistema</h3>";
	if(!$result==0){
		echo "<p>El local ha sido guardado correctamente</p>";
	}
	else{
		echo "<p>No se pudieron guardar los datos del local, vuelva a intentar mas tarde.</p>";
	}
  ?>
