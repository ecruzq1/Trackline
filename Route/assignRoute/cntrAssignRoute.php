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
class AssignRoute
{
  private $rutas= array();
  private $usuarios=array();
  private $localesRutas=array();
  private $tiposVisita=array();
  private $personas=array();

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
  function userOptions(){
    $html="";
    $cont=1;
    $html=$html."<option value=''selected='true' disabled='disabled'>Escoja un usuario.</option>>";
    foreach ($this->usuarios as $user) {
      if ($user->TPU_ID!=1 and $user->USU_ESTADO==1) {
        foreach ($this->personas as $person) {
          if ($user->USU_ID==$person->USU_ID) {
            $html=$html."<option value='".$person->PER_CEDULA."'>".$person->PER_NOMBRE." ".$person->PER_APELLIDO."</option>";
            $cont++;
          }
        }
      }
    }
    if ($cont==1) {
      $html=$html."<option value='' disabled>Usuarios no disponibles para su empresa.</option>>";
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
  function crearRuta($route,$user,$date,$types,$time,$times){
    //Convertir de string a array
    $arrayTypes = explode(",", $types);
    $arrayTimes = explode(",", $times);
    $longitud = count($arrayTypes);
    //Crear Visita
    $this->objVisita->recolectarDatos(0,$route,$user,$date);
    $resultado=$this->objVisita->crear();
    //Obtener id de visita para las visitas por local
    $parametros="MAX(VIS_ID)AS VIS_ID,RUT_ID,PER_CEDULA,VIS_FECHA";
    $tablas='visita';
    $filtro="RUT_ID=".$route;
    $arrayVisitaPrinc=$this->objVisita->consultaCompleja($parametros,$tablas,$filtro);    //Recorro todos los elementos
    $VIS_ID=0;
    for($i=0; $i<count($arrayVisitaPrinc); $i++)
    {
    	  $VIS_ID=$arrayVisitaPrinc[$i]->VIS_ID;
    }
    //Guardar las visitas por local.
    $this->localesRutas=$this->objLocalRuta->obtenerRutasX('RUT_ID',$route);

    $horaInicial="14:00";



//$segundos_minutoAnadir=$minutoAnadir*60;




    $segVije=0;
    $segCita=0;
    foreach ($this->localesRutas as $localRuta) {
      $segCita=$arrayTimes[$localRuta->LOR_ORDEN-1]*60;
      $segHoraCita=strtotime($time);
      //Nueva horas
      $horaCita=date("H:i",$segHoraCita+$segVije);
      $horaSalida=date("H:i",$segHoraCita+$segVije+$segCita);

      $this->objLocalVisita->recolectarDatos(0,$localRuta->LOC_ID,$VIS_ID,$arrayTypes[$localRuta->LOR_ORDEN-1],$horaCita,$horaCita,$horaSalida,null,true);
      $time=$horaSalida;
      $this->objLocalVisita->crear();
      $segVije=$localRuta->LOR_TIEMPO*60;
    }
    return $resultado;
  }

  function obtenerTablaSitios($idRoute,$EMP_ID){
    $this->obtenerTiposVisita();
    $opciones="<select class='' name='idTipoVisita[]'>";
    foreach ($this->tiposVisita as $tipoVisita) {
      $opciones=$opciones."<option value='".$tipoVisita->TPV_ID."'>".$tipoVisita->TPV_NOMBRE."</option>";
    }
    $opciones=$opciones."</select>";

    $this->localesRutas=$this->objLocalRuta->obtenerRutasX('RUT_ID',$idRoute);
    $this->obtenerLocales($EMP_ID);
    $html="";
    $cont=1;
    $html=$html."<tr>
                  <th>Orden&nbsp&nbsp</th>
                  <th>Local&nbsp&nbsp</th>
                  <th>Tipo de Visita&nbsp&nbsp</th>
                  <th>Tiempo Estimado&nbsp&nbsp</th>
                 </tr>
              <tr>";
    foreach ($this->localesRutas as $localRuta) {
      foreach ($this->locales as $local) {
        if ($localRuta->LOC_ID==$local->LOC_ID) {
          $html=$html."<tr>
                        <td>&nbsp&nbsp".$localRuta->LOR_ORDEN."&nbsp&nbsp</td>
                        <td>&nbsp&nbsp".$local->LOC_NOMBRE."&nbsp&nbsp</td>
                        <td>
                        ".$opciones."
                        </td>
                        <td align='center'><input type='number' name='tiempoVisita[]' value='1' style='width: 4em;' min='1' max='300'> min</td>
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
