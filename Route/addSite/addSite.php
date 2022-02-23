 <?php
 include_once('cntrAddSite.php');
 $objAddSite=new AddSite();

 // Recupero variables del formulario
  $namelocal=$_POST['name_local'];
  $owner=$_POST['owner'];
  $phono=$_POST['phono'];
  $adress=$_POST['address'];
  $latitud=$_POST['coordsLat'];
  $longitud=$_POST['coordsLng'];

  //ejecucion sentencia SQL
  $result=$objAddSite->crearLocal(0,1,$namelocal,$owner,$phono,$adress,$latitud,$longitud);
  echo "<h3>Estado del sistema</h3>";
	if(!$result==0){
		echo "<p>El local ha sido guardado correctamente</p>";
	}
	else{
		echo "<p>No se pudieron guardar los datos del local, vuelva a intentar mas tarde.</p>";
	}
  ?>
