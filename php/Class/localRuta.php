<?php
include_once("conexion.php");
/**
 *
 */
class localRuta
{
  public $LOC_ID;
  public $RUT_ID;
  public $LOR_ORDEN;
  public $LOR_DISTANCIA;
  public $LOR_TIEMPO;


  var $Tabla;
  var $conn;

  public $locales=array();
  function __construct()
  {
    $this->Tabla="local_ruta";
    $this->conn=new conexion($this->Tabla);
  }

  function recolectarDatos($LOC_ID,$RUT_ID,$LOR_ORDEN,$LOR_DISTANCIA,$LOR_TIEMPO){
    $this->LOC_ID=$LOC_ID;
    $this->RUT_ID=$RUT_ID;
    $this->LOR_ORDEN=$LOR_ORDEN;
    $this->LOR_DISTANCIA=$LOR_DISTANCIA;
    $this->LOR_TIEMPO=$LOR_TIEMPO;
  }

  function crear(){
    $this->conn->conectar();
    $parametros="LOC_ID,RUT_ID,LOR_ORDEN,LOR_DISTANCIA,LOR_TIEMPO";
    $valores="$this->LOC_ID,$this->RUT_ID,$this->LOR_ORDEN,$this->LOR_DISTANCIA,$this->LOR_TIEMPO";
    $result=$this->conn->insertar($parametros,$valores);
    $this->conn->desconectar();
    return $result;
  }

  function obtenerRutasX($parametro,$valor){
    $this->conn->conectar();
    $result=$this->conn->obtenerResultados($parametro,$valor);
    $this->locRutas=array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $auxRuta=new localRuta();
          $auxRuta->LOC_ID=$row['LOC_ID'];
          $auxRuta->RUT_ID=$row['RUT_ID'];
          $auxRuta->LOR_ORDEN=$row['LOR_ORDEN'];
          $auxRuta->LOR_DISTANCIA=$row['LOR_DISTANCIA'];
          $auxRuta->LOR_TIEMPO=$row['LOR_TIEMPO'];

          array_push($this->locRutas , $auxRuta);
        }
    }
    $this->conn->desconectar();
    return $this->locRutas;
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
