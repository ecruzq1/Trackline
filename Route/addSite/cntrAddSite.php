<?php
include_once("../../php/Class/local.php");
/**
 *
 */
class AddSite
{
  private $objLocal;

  function __construct()
  {
    $this->objLocal=new local();
  }

  function crearLocal($LOC_ID,$EMP_ID,$LOC_NOMBRE,$LOC_NOMBRE_DUENO,$LOC_TELEFONO,$LOC_DIRECCION,$LOC_LATITUD,$LOC_LONGITUD){
    $this->objLocal->recolectarDatos($LOC_ID,$EMP_ID,$LOC_NOMBRE,$LOC_NOMBRE_DUENO,$LOC_TELEFONO,$LOC_DIRECCION,$LOC_LATITUD,$LOC_LONGITUD);
    return $this->objLocal->crear();
  }
}

 ?>
