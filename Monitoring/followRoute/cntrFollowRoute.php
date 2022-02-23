<?php
include_once('../../php/Class/local.php');
include_once('../../php/Class/ruta.php');
include_once('../../php/Class/localRuta.php');
include_once('../../php/Class/usuario.php');
include_once('../../php/Class/tipoVisita.php');
include_once('../../php/Class/persona.php');
include_once('../../php/Class/localVisita.php');
include_once('../../php/Class/visita.php');


/**
 *
 */
class FollowRoute
{
  private $rutas= array();
  private $usuarios=array();
  private $localesRutas=array();
  private $tiposVisita=array();
  private $personas=array();
  private $visitas=array();
  private $localesVisita=array();

  private $objLocal;
  private $objRuta;
  private $objLocalRuta;
  private $objUsuario;
  private $objTipoVisita;
  private $objPersona;
  private $objLocalVisita;
  private $objVisita;

  function __construct(){
    $this->objLocal=new local();
    $this->objRuta=new ruta();
    $this->objLocalRuta=new localRuta();
    $this->objUsuario=new usuario(null);
    $this->objTipoVisita=new tipoVisita();
    $this->objPersona=new persona();
    $this->objLocalVisita=new localVisita();
    $this->objVisita=new visita();
  }

  function obtenerUsuarios($EMP_ID){
    $this->usuarios=$this->objUsuario->obtenerUsuariosX('EMP_ID',$EMP_ID);
  }
  function obtenerPersonas($EMP_ID){
    $this->personas=$this->objPersona->consultarMixPerUsuX('EMP_ID',$EMP_ID);
  }
  function obtenerLocales($EMP_ID){
    $this->locales=$this->objLocal->obtenerLocalesX('EMP_ID',$EMP_ID);
  }
  function obtenerRutas($EMP_ID){
    $this->rutas=$this->objRuta->obtenerRutasX('EMP_ID',$EMP_ID);
  }
  function obtenerTiposVisita(){
    $this->tiposVisita=$this->objTipoVisita->obtenerTiposVisitaAll();
  }

  function obtenerVisitaFechas($fecha){
    $this->visitas=$this->objVisita->obtenerVisitasX('VIS_FECHA',$fecha);
  }
  function obtenerLocalVisitaXVisID($VIS_ID){
    $this->localesVisita=$this->objLocalVisita->obtenerLocalesVisitaX('VIS_ID',$VIS_ID);
  }

  function userOptions($fecha){
    $this->obtenerVisitaFechas($fecha);
    $this->obtenerPersonas(1);
    $this->obtenerUsuarios(1);
    $html="";
    $cont=1;
    $auxUsuarios= array();
    $html=$html."<option value=''selected='true' disabled='disabled'>Escoja un usuario.</option>";
    foreach ($this->visitas as $visit) {
      foreach ($this->usuarios as $user) {
        if ($user->TPU_ID!=1 and $user->USU_ESTADO==1) {
          foreach ($this->personas as $person) {
            if ($user->USU_ID==$person->USU_ID and $person->PER_CEDULA==$visit->PER_CEDULA) {
              $band=0;
              foreach ($auxUsuarios as $key) {
                if ($person->PER_CEDULA==$key) {
                  $band=1;
                }
              }

              if ($band==0 or sizeof($auxUsuarios)==0  ) {
                array_push($auxUsuarios , $person->PER_CEDULA);
                $html=$html."<option value='".$person->PER_CEDULA."'>".$person->PER_NOMBRE." ".$person->PER_APELLIDO."</option>";
                $cont++;
              }
            }
          }
        }
      }
    }

    if ($cont==1) {
      $html="<option value='' selected='true' disabled>No ha sido asignada ninguna ruta para la fecha ingresada.</option>";
      echo $html;
    }else{
      echo $html;
    }
  }
  function routeOptions(){
    $html="";
    $cont=1;
    $html=$html."<option value=''selected='true' disabled='disabled'>Escoja una ruta.</option>>";
    foreach ($this->rutas as $route) {
      if ($route->RUT_ESTADO==1) {
        $html=$html."<option value='".$route->RUT_ID."'>".$route->RUT_NOMBRE."</option>";
        $cont++;
      }

    }
    if ($cont==1) {
      $html=$html."<option value='' disabled>Usuarios no disponibles para su empresa.</option>>";
      echo $html;
    }else{
      echo $html;
    }
  }
  function obtenerTablaRutas($idUsuario,$fecha,$EMP_ID){
    $this->obtenerVisitaFechas($fecha);
    $this->obtenerRutas($EMP_ID);

    $html="";
    $cont=1;
    $html=$html."<tr>
                  <th>Orden&nbsp&nbsp</th>
                  <th>Nombre&nbsp&nbsp</th>
                  <th>Opciones&nbsp&nbsp</th>
                 </tr>
              <tr>";
    foreach ($this->visitas as $auxVisit) {
      foreach ($this->rutas as $auxRutas) {
        if ($auxVisit->RUT_ID==$auxRutas->RUT_ID) {
          $html=$html."<tr>
                        <td>&nbsp&nbsp".$cont."&nbsp&nbsp</td>
                        <td>&nbsp&nbsp".$auxRutas->RUT_NOMBRE."&nbsp&nbsp</td>
                        <td>&nbsp <a href='#' id='".$auxVisit->VIS_ID."'>Ver Detalles</a> &nbsp</td>
                      </tr>";
          $cont++;
        }
      }
    }
    if ($cont>1) {
      echo $html;
    }else{
      $html=$html."<tr>
                    <td colspan='3'>No hay rutas asignadas</td>
                  </tr>";
      echo $html;
    }

  }

  function obtenerTablaSitios($idVisita,$EMP_ID){
    $this->obtenerTiposVisita();
    $this->obtenerLocalVisitaXVisID($idVisita);
    $this->obtenerLocales($EMP_ID);

    $html="";
    $cont=1;
    $html=$html."<tr>
                  <th>Orden&nbsp&nbsp</th>
                  <th>Local&nbsp&nbsp</th>
                  <th>Tipo de Visita&nbsp&nbsp</th>
                  <th>Estado&nbsp&nbsp</th>
                 </tr>
              <tr>";
    foreach ($this->localesVisita as $localVisita) {
      $pendiente="Ya visitado.";
      $tipo="";
      if ($localVisita->LVI_ESTA_PENDIENTE) {
        $pendiente="Pendiente";
      }
      foreach ($this->tiposVisita as $key) {
        if ($localVisita->TPV_ID==$key->TPV_ID) {
          $tipo=$key->TPV_NOMBRE;
        }
      }
      foreach ($this->locales as $local) {
        if ($localVisita->LOC_ID==$local->LOC_ID) {
          $html=$html."<tr>
                        <td>&nbsp&nbsp".$cont."&nbsp&nbsp</td>
                        <td>&nbsp&nbsp".$local->LOC_NOMBRE."&nbsp&nbsp</td>
                        <td>&nbsp&nbsp".$tipo."&nbsp&nbsp</td>
                        <td align='center'>&nbsp&nbsp $pendiente &nbsp&nbsp</td>
                      </tr>";
          $cont++;
        }
      }
    }
    if ($cont>1) {
      echo $html;
    }else{
      $html=$html."<tr>
                    <td colspan='4'>No hay locales</td>
                  </tr>";
      echo $html;
    }

  }

}

 ?>
