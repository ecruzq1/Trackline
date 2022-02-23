<?php
include_once('../../php/Class/usuario.php');
include_once('../../php/Class/persona.php');
/**
 *
 */
class ManageUser
{
  var $objUsuario;
  var $objPersona;

  var $band;
  function __construct()
  {
    $this->objUsuario=new usuario(null);
    $this->objPersona=new persona();
  }
  function showRowUser($TPU_ID){
    $result=$this->objPersona->consultarMixPerUsuX('TPU_ID',$TPU_ID);
    $html="";
    $cont=1;
    foreach ($result as $per) {
      $html=$html."<tr>
                    <td>&nbsp $cont</td>
                    <td>&nbsp&nbsp ".$per->PER_NOMBRE." ".$per->PER_APELLIDO." </td>
                    <td>&nbsp&nbsp ".$per->PER_CEDULA." &nbsp</td>
                    <td>&nbsp <a href='#' type-opt='show' id='".$per->USU_ID."'>Mostrar</a> &nbsp</td>
                    <td>&nbsp <a href='#' type-opt='edit' id='".$per->USU_ID."'>Editar</a> &nbsp</td>
                    <td>&nbsp <a href='#' type-opt='delete' id='".$per->USU_ID."'>Eliminar</a> &nbsp</td>
                  </tr>";
      $cont++;
    }
    if ($cont==1) {
      $html="<tr>
              <td colspan='5'>&nbsp No hay datos que mostrar.</td>
            </tr>";
    }


    echo $html;
  }

  function crearUsuario($TPU_ID,$EMP_ID,$USU_NOMBRE,$USU_ONTRASEÑA,$USU_ESTADO,$PER_CEDULA,$SEX_ID,$PER_NOMBRE,$PER_APELLIDO,$PER_CORREO,$PER_DIRECCION,$PER_TELEFONO){
    $this->objUsuario->recolectarDatos($TPU_ID,$EMP_ID,$USU_NOMBRE,sha1($USU_ONTRASEÑA),$USU_ESTADO);
    //Creacion de usuario
    $USU_ID=$this->objUsuario->crear();
    $this->objPersona->recolectarDatos($PER_CEDULA,$USU_ID,$SEX_ID,$PER_NOMBRE,$PER_APELLIDO,$PER_CORREO,$PER_DIRECCION,$PER_TELEFONO);
    $band=$this->objPersona->crear();
  }

  function mensajeCreacion(){
    if ($band==1) {
      echo "<p>Se creo satisfactoriamente el usuario</p>";
    }else{
      echo "<p>Hubo un problema al crear el usuario/p>";
    }
  }

  function recuperarDatos($USU_ID){
    $this->objPersona->obtenerDatosX('USU_ID',$USU_ID);
    $this->objUsuario->obtenerDatosX('USU_ID',$USU_ID);
  }
}

 ?>
