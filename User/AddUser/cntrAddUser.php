<?php
include_once('../../php/Class/usuario.php');
include_once('../../php/Class/persona.php');
/**
 *
 */
class AddUser
{
  var $objUsuario;
  var $objPersona;

  var $band;
  function __construct()
  {
    $this->objUsuario=new usuario(null);
    $this->objPersona=new persona();
  }
  function crearUsuario($TPU_ID,$EMP_ID,$USU_NOMBRE,$USU_ONTRASEÑA,$USU_ESTADO,$PER_CEDULA,$SEX_ID,$PER_NOMBRE,$PER_APELLIDO,$PER_CORREO,$PER_DIRECCION,$PER_TELEFONO){
    $this->objUsuario->recolectarDatos($TPU_ID,$EMP_ID,$USU_NOMBRE,sha1($USU_ONTRASEÑA),$USU_ESTADO);
    //Creacion de usuario
    $USU_ID=$this->objUsuario->crear();
    $this->objPersona->recolectarDatos($PER_CEDULA,$USU_ID,$SEX_ID,$PER_NOMBRE,$PER_APELLIDO,$PER_CORREO,$PER_DIRECCION,$PER_TELEFONO);
    $band=$this->objPersona->crear();
  }

  function mensajeCreacion(){
    if ($this->band==0) {
      echo "<p>Se creo satisfactoriamente el usuario</p>";
    }else{
      echo "<p>Hubo un problema al crear el usuario</p>";
    }
  }

}

 ?>
