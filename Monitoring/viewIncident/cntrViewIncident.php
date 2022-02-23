<?php
include_once('../../php/Class/local.php');
include_once('../../php/Class/ruta.php');
include_once('../../php/Class/localRuta.php');
include_once('../../php/Class/usuario.php');
include_once('../../php/Class/tipoVisita.php');
include_once('../../php/Class/persona.php');
include_once('../../php/Class/localVisita.php');
include_once('../../php/Class/visita.php');
include_once('../../php/Class/tipoIncidente.php');
include_once('../../php/Class/incidente.php');


/**
 *
 */
class ViewIncident
{
  private $rutas= array();
  private $usuarios=array();
  private $localesRutas=array();
  private $tiposVisita=array();
  private $personas=array();
  private $tiposIncidentes=array();
  private $incidentes=array();
  private $localesVisitas=array();
  private $visitas=array();


  private $objLocal;
  private $objRuta;
  private $objLocalRuta;
  private $objUsuario;
  private $objTipoVisita;
  private $objPersona;
  private $objLocalVisita;
  private $objVisita;
  private $objTipoIncidente;
  private $objIncidente;

  function __construct(){
    $this->objLocal=new local();
    $this->objRuta=new ruta();
    $this->objLocalRuta=new localRuta();
    $this->objUsuario=new usuario(null);
    $this->objTipoVisita=new tipoVisita();
    $this->objPersona=new persona();
    $this->objLocalVisita=new localVisita();
    $this->objVisita=new visita();
    $this->objTipoIncidente=new tipoIncidente();
    $this->objIncidente=new incidente();
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
  function obtenerLocalInformacion($LOC_ID){
    $this->locales=$this->objLocal->obtenerLocalesX('LOC_ID',$LOC_ID);
  }
  function obtenerRutas($EMP_ID){
    $this->rutas=$this->objRuta->obtenerRutasX('EMP_ID',$EMP_ID);
  }
  function obtenerTiposVisita(){
    $this->tiposVisita=$this->objTipoVisita->obtenerTiposVisitaAll();
  }
  function obtenerTiposIncidente(){
    $this->tiposIncidentes=$this->objTipoIncidente->obtenerTiposIncidenteAll();
  }
  function obtenerIncidentes($INC_FECHA){
    $this->incidentes=$this->objIncidente->obtenerIncidentesX('INC_FECHA',$INC_FECHA);
  }
  function obtenerLocalesVisita($LVI_ID){
    $this->localesVisita=$this->objLocalVisita->obtenerLocalesVisitaX('LVI_ID',$LVI_ID);
  }

  function obtenerTablaInfoRuta($LVI_ID){
    //Bucar en Local-visita
    $this->obtenerLocalesVisita($LVI_ID);
    $nombreLocal="";
    $nombreDuenio="";
    $telefonoLocal="";
    $nombreRuta="";
    $nombrePersona="";
    $cedula="";
    $telefono="";
    $horaCita=0;
    $horaLlegada=0;
    $horaSalida=0;

    foreach ($this->localesVisita as $auxLocalesVisita) {
      $auxVisita=$this->objVisita->obtenerVisitaX("VIS_ID",$auxLocalesVisita->VIS_ID);

      $horaCita=$auxLocalesVisita->LOV_HORA_CITA;
      $horaLlegada=$auxLocalesVisita->LOV_HORA_LLEGADA;
      $horaSalida=$auxLocalesVisita->LOV_HORA_SALIDA;
      $cedula=$auxVisita->PER_CEDULA;
      $this->obtenerRutas(1);

      //Buscar la ruta
      foreach ($this->rutas as $auxRuta) {
        if ($auxRuta->RUT_ID==$auxVisita->RUT_ID) {
          // code...
          $nombreRuta= $auxRuta->RUT_NOMBRE;
        }
      }

      //Buscar persona
      $this->objPersona->obtenerDatos($cedula);
      $nombrePersona=$this->objPersona->PER_NOMBRE." ".$this->objPersona->PER_APELLIDO;
      $telefono=$this->objPersona->PER_TELEFONO;
      //Informacion del collator_get_local
      $this->obtenerLocalInformacion($auxLocalesVisita->LOC_ID);
      //$auxLocalesVisita->LOV_HORA_CITA
      $auxLocal=$this->locales[0];
      $nombreLocal=$auxLocal->LOC_NOMBRE;
      $nombreDuenio=$auxLocal->LOC_NOMBRE_DUENO;
      $telefonoLocal=$auxLocal->LOC_TELEFONO;
    }
    $html="
    <div class='SubDiv-Horizontal'>
      <legend>Ruta</legend>
      <table class='tablaReporte'>
        <tr>
          <td class='reporteT' colspan='2'><p>INFORMACIÓN DE RUTA </p></td>
        </tr>
        <tr>
          <td class='reporteT'><p>Nombre de la Ruta: </p></td>
          <td class='reporteE'><p id='ID_INC'>&nbsp &nbsp $nombreRuta </p> </td>
        </tr>
        <tr>
          <td class='reporteT'><p>Responsable: </p></td>
          <td class='reporteE'><p>&nbsp &nbsp $nombrePersona </p> </td>
        </tr>
        <tr>
          <td class='reporteT'><p>Teléfono: </p></td>
          <td class='reporteE'><p>&nbsp &nbsp $telefono </p> </td>
        </tr>
        <tr>
          <td class='reporteT' colspan='2'><br></td>
        </tr>
        <tr>
          <td class='reporteT' colspan='2'><p>INFORMACIÓN DEL LOCAL </p></td>
        </tr>
        <tr>
          <td class='reporteT'><p>Local: </p></td>
          <td class='reporteE'><p>&nbsp &nbsp $nombreLocal </p> </td>
        </tr>
        <tr>
          <td class='reporteT'><p>Dueño: </p></td>
          <td class='reporteE'>&nbsp &nbsp $nombreDuenio </td>
        </tr>
        <tr>
          <td class='reporteT'><p>Teléfono: </p></td>
          <td class='reporteE'>&nbsp &nbsp $telefonoLocal </td>
        </tr>
      </table>
    </div>

    <div class=SubDiv-Horizontal>
      <legend>Visita</legend>
      <table class='tablaReporte'>
        <tr>
          <td class='reporteT' colspan='2'><p>INFORMACIÓN DE LA VISITA </p></td>
        </tr>
        <tr>
          <td class='reporteT'><p>Hora planificada de llegada: </p></td>
          <td class='reporteE'>&nbsp &nbsp $horaCita </td>
        </tr>
        <tr>
          <td class='reporteT'><p>Hora real de Llegada: </p></td>
          <td class='reporteE'>&nbsp &nbsp $horaLlegada</td>
        </tr>
        <tr>
          <td class='reporteT'><p>Hora planificada de Salida: </p></td>
          <td class='reporteE'>&nbsp &nbsp $horaSalida</td>
        </tr>
      </table>
    </div>
    ";
    echo $html;

  }
  //MEJORA: Hacerlo por empresa
  function obtenerTablaIncidentes($fecha){
    $this->obtenerTiposIncidente();
    //obtener inidentes de la fecha indicada
    $this->obtenerIncidentes($fecha);
    //Crear la tabla
    $html="";
    $cont=1;
    $html=$html."<tr>
                  <th>Num. &nbsp&nbsp</th>
                  <th>Tipo de Incidente&nbsp&nbsp</th>
                  <th>Hora&nbsp&nbsp</th>
                  <th>Opciones&nbsp&nbsp</th>
                 </tr>";
    foreach ($this->incidentes as $auxIncidente) {
      $html=$html."<tr>
                    <td>&nbsp&nbsp".$cont."&nbsp&nbsp</td>
                    <td>&nbsp&nbsp".$this->tiposIncidentes[$auxIncidente->TIN_ID-1]->TIN_NOMBRE."&nbsp&nbsp</td>
                    <td>&nbsp&nbsp".$auxIncidente->INC_HORA."&nbsp&nbsp</td>
                    <td>&nbsp <a href='#' id='".$auxIncidente->LVI_ID."'>Ver Detalles</a> &nbsp</td>
                  </tr>";
      $cont++;
    }


    if ($cont>1) {
      echo $html;
    }else{
      $html=$html."<tr>
                    <td colspan='4'>No hay incidentes</td>
                  </tr>";
      echo $html;
    }
  }
}

 ?>
