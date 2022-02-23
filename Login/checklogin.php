<?php
session_start();
include_once("../php/Class/usuario.php");
$obj=new usuario(null);
//Variables rescatadas
$username=$_POST['user'];
$contrasenia=$_POST['pwd'];
$resultado=$obj->autenticarUsuario($username,$contrasenia);
switch ($resultado) {
  case '2':
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $username;
    $_SESSION['start'] = time();
    $_SESSION['expire'] = $_SESSION['start'] + (50 * 60);
    //http://velozityweb.com/blog/php/login-de-usuarios-y-creacion-de-sesiones-con-php-y-mysql/#sthash.Ok2Uz2mW.dpbs
    if ($_SESSION['loggedin'] ) {
      echo "<script language='javascript'> location.href ='panel-control.php'; </script>";
      echo "Correcto la creacion de la sesion";
    }
    else {
      echo "No se a podido crear la sesion.";
      echo "<br><a href='../index.html'>Volver a Intentarlo</a>";
    }
    break;
  case '1':
    echo "Contrasenia esta incorrecta.";
    echo "<br><a href='../index.html'>Volver a Intentarlo</a>";
    break;
  default:
    echo "Usuario inexistente, verifiquelo e intente de nuevo.";
    echo "<br><a href='../index.html'>Volver a Intentarlo</a>";
    break;
}
?>
