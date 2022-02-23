<?php
include_once('../../php/Class/local.php');
include_once('../../php/Class/ruta.php');
include_once('../../php/Class/localRuta.php');
/**
 *
 */
class AddRoute
{
  private $locales= array();
  private $objLocal;
  private $objRuta;
  private $objLocalRuta;
  function __construct()
  {
    $this->objLocal=new local();
    $this->objRuta=new ruta();
    $this->objLocalRuta=new localRuta();
  }

  function obtenerLocales($EMP_ID){
    $this->locales=$this->objLocal->obtenerLocalesX('EMP_ID',$EMP_ID);
  }

  function localeOptions(){
    $html="";
    $cont=1;
    foreach ($this->locales as $loc) {
      $html=$html."<option LOC_ID='".$loc->LOC_ID."' value='".$loc->LOC_LATITUD.",".$loc->LOC_LONGITUD."'>".$loc->LOC_NOMBRE."</option>";
      $cont++;
    }
    if ($cont==1) {
      echo "No hay locales para su empresa";
    }else{
      echo $html;
    }
  }
  function crearRuta($Nombre,$Ruta,$Orden,$Tiempos,$Distancias){
    //Convertir de string a array
    $nombreRemplazado=str_replace("%"," ",$Nombre);
    $arrayRuta = explode(",", $Ruta);
    $arrayOrden = explode(",", $Orden);
    $arraytiempos = explode(",", $Tiempos);
    $arrayDistancia = explode("-", $Distancias);
    $longitud = count($arrayRuta);

    $this->objRuta->recolectarDatos(0,1,$nombreRemplazado,'2018/09/08',1);
    $resultado=$this->objRuta->crear();
    //Obtener id de ruta para los $locales
    $parametros="MAX(RUT_ID)AS RUT_ID,EMP_ID,RUT_NOMBRE,RUT_FECHA_CREACION,RUT_ESTADO";
    $tablas='ruta';
    $filtro="EMP_ID=1";
    $arrayRutaPrinc=$this->objRuta->consultaCompleja($parametros,$tablas,$filtro);    //Recorro todos los elementos
    for($i=0; $i<count($arrayRutaPrinc); $i++)
    {
    	  $RUT_ID=$arrayRutaPrinc[$i]->RUT_ID;
    }
    //Guardar los locales por rutas
    for ($i=0; $i <$longitud ; $i++) {
      // code...
      $tiempo=explode(" ", $arraytiempos[$i]);
      $distancia=explode(" ", $arrayDistancia[$i]);
      $this->objLocalRuta->recolectarDatos($arrayRuta[$i],$RUT_ID,$arrayOrden[$i],$distancia[0],$tiempo[0]);
      $this->objLocalRuta->crear();
    }

    return $resultado;
  }
}

 ?>
