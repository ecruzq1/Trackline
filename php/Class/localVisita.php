<?php
include_once("conexion.php");
/**
 *
 */
class localVisita
{
  public $LVI_ID;
  public $LOC_ID;
  public $VIS_ID;
  public $TPV_ID;
  public $LOV_HORA_CITA;
  public $LOV_HORA_LLEGADA;
  public $LOV_HORA_SALIDA;
  public $LOV_NOTA;
  public $LVI_ESTA_PENDIENTE;


  var $Tabla;
  var $conn;

  public $locales=array();
  function __construct()
  {
    $this->Tabla="local_visita";
    $this->conn=new conexion($this->Tabla);
  }

  function recolectarDatos($LVI_ID,$LOC_ID,$VIS_ID,$TPV_ID,$LOV_HORA_CITA,$LOV_HORA_LLEGADA,$LOV_HORA_SALIDA,$LOV_NOTA,$LVI_ESTA_PENDIENTE){
    $this->LVI_ID=$LVI_ID;
    $this->LOC_ID=$LOC_ID;
    $this->VIS_ID=$VIS_ID;
    $this->TPV_ID=$TPV_ID;
    $this->LOV_HORA_CITA=$LOV_HORA_CITA;
    $this->LOV_HORA_LLEGADA=$LOV_HORA_LLEGADA;
    $this->LOV_HORA_SALIDA=$LOV_HORA_SALIDA;
    $this->LOV_NOTA=$LOV_NOTA;
    $this->LVI_ESTA_PENDIENTE=$LVI_ESTA_PENDIENTE;
  }

  function crear(){
    $this->conn->conectar();
    $parametros="LVI_ID,LOC_ID,VIS_ID,TPV_ID,LOV_HORA_CITA,LOV_HORA_LLEGADA,LOV_HORA_SALIDA,LOV_NOTA,LVI_ESTA_PENDIENTE";
    $valores="null,$this->LOC_ID,$this->VIS_ID,$this->TPV_ID,'$this->LOV_HORA_CITA','$this->LOV_HORA_LLEGADA','$this->LOV_HORA_SALIDA','$this->LOV_NOTA',$this->LVI_ESTA_PENDIENTE";
    $result=$this->conn->insertar($parametros,$valores);
    $this->conn->desconectar();
    return $result;
  }

  function obtenerLocalesVisitaX($parametro,$valor){
    $this->conn->conectar();
    $result=$this->conn->obtenerResultados($parametro,$valor);
    $this->localesVisita=array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $auxLocVisita=new localVisita;
          $auxLocVisita->LVI_ID=$row['LVI_ID'];
          $auxLocVisita->LOC_ID=$row['LOC_ID'];
          $auxLocVisita->VIS_ID=$row['VIS_ID'];
          $auxLocVisita->TPV_ID=$row['TPV_ID'];
          $auxLocVisita->LOV_HORA_CITA=$row['LOV_HORA_CITA'];
          $auxLocVisita->LOV_HORA_LLEGADA=$row['LOV_HORA_LLEGADA'];
          $auxLocVisita->LOV_HORA_SALIDA=$row['LOV_HORA_SALIDA'];
          $auxLocVisita->LOV_NOTA=$row['LOV_NOTA'];
          $auxLocVisita->LVI_ESTA_PENDIENTE=$row['LVI_ESTA_PENDIENTE'];

          array_push($this->localesVisita , $auxLocVisita);
        }
    }
    $this->conn->desconectar();
    return $this->localesVisita;
  }
  function consultaCompleja($parametro,$tablas,$filtro){
    $this->conn->conectar();
    $result=$this->conn->obtenerResultadosCombinacion($parametros,$tablas,$filtro);
    $this->locRutas=array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $auxRuta=new localRuta();
          $auxRuta->LOC_ID=$row['LOC_ID'];
          $auxRuta->RUT_ID=$row['RUT_ID'];
          $auxRuta->LOR_ORDEN=$row['LOR_ORDEN'];
          $auxRuta->LOR_DISTANCIA=$row['LOR_DISTANCIA'];
          $auxRuta->LOR_TIEMPO=$row['LOR_TIEMPO'];

          array_push($this->localRutas , $auxRuta);
        }
    }
    $this->conn->desconectar();
    return $this->localRutas;
  }


}

 ?>
