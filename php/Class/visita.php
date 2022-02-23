<?php
include_once("conexion.php");
/**
 *
 */
class visita
{
  public $VIS_ID;
  public $RUT_ID;
  public $PER_CEDULA;
  public $VIS_FECHA;

  var $Tabla;
  var $conn;

  public $tiposVisita=array();
  function __construct()
  {
    $this->Tabla="visita";
    $this->conn=new conexion($this->Tabla);
  }

  function recolectarDatos($VIS_ID,$RUT_ID,$PER_CEDULA,$VIS_FECHA){
    $this->VIS_ID=$VIS_ID;
    $this->RUT_ID=$RUT_ID;
    $this->PER_CEDULA=$PER_CEDULA;
    $this->VIS_FECHA=$VIS_FECHA;
  }
  function crear(){
    $this->conn->conectar();
    $parametros="VIS_ID,RUT_ID,PER_CEDULA,VIS_FECHA";
    $valores="null,$this->RUT_ID,'$this->PER_CEDULA','$this->VIS_FECHA'";
    $result=$this->conn->insertar($parametros,$valores);
    $this->conn->desconectar();
    return $result;
  }
  function obtenerVisitaX($parametro,$valor){
    $this->conn->conectar();
    $result=$this->conn->obtenerResultados($parametro,$valor);
    $auxVisita=new visita();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {

          $auxVisita->VIS_ID=$row['VIS_ID'];
          $auxVisita->RUT_ID=$row['RUT_ID'];
          $auxVisita->PER_CEDULA=$row['PER_CEDULA'];
          $auxVisita->VIS_FECHA=$row['VIS_FECHA'];
        }
    }
    $this->conn->desconectar();
    return $auxVisita;
  }
  function obtenerVisitasX($parametro,$valor){
    $this->conn->conectar();
    $result=$this->conn->obtenerResultados($parametro,$valor);
    $auxVisitas=array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $auxVisita=new Visita();
          $auxVisita->VIS_ID=$row['VIS_ID'];
          $auxVisita->RUT_ID=$row['RUT_ID'];
          $auxVisita->PER_CEDULA=$row['PER_CEDULA'];
          $auxVisita->VIS_FECHA=$row['VIS_FECHA'];
          array_push($auxVisitas , $auxVisita);
        }
    }
    $this->conn->desconectar();
    return $auxVisitas;
  }
  function consultaCompleja($parametros,$tablas,$filtro){
    $this->conn->conectar();
    $result=$this->conn->obtenerResultadosCombinacion($parametros,$tablas,$filtro);
    $this->visitas=array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $auxVisit=new visita;
          $auxVisit->VIS_ID=$row['VIS_ID'];
          $auxVisit->RUT_ID=$row['RUT_ID'];
          $auxVisit->PER_CEDULA=$row['PER_CEDULA'];
          $auxVisit->VIS_FECHA=$row['VIS_FECHA'];

          array_push($this->visitas , $auxVisit);
        }
    }
    $this->conn->desconectar();
    return $this->visitas;
  }

  function obtenerTiposVisitaAll(){
    $this->conn->conectar();
    $result=$this->conn->obtenerTodosResultados("*");
    $this->locales=array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $auxLoc=new tipoVisita;
          $auxLoc->TPV_ID=$row['TPV_ID'];
          $auxLoc->TPV_NOMBRE=$row['TPV_NOMBRE'];
          $auxLoc->TPV_DESCRIPCION=$row['TPV_DESCRIPCION'];
          array_push($this->tiposVisita , $auxLoc);
        }
    }
    $this->conn->desconectar();
    return $this->tiposVisita;
  }


}

 ?>
