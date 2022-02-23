<?php
include_once("conexion.php");
/**
 *
 */
class ruta
{
  public $RUT_ID;
  public $EMP_ID;
  public $RUT_NOMBRE;
  public $RUT_FECHA_CREACION;
  public $RUT_ESTADO;


  var $Tabla;
  var $conn;

  public $locales=array();
  function __construct()
  {
    $this->Tabla="ruta";
    $this->conn=new conexion($this->Tabla);
  }

  function recolectarDatos($RUT_ID,$EMP_ID, $RUT_NOMBRE,$RUT_FECHA_CREACION,$RUT_ESTADO){
    $this->RUT_ID=$RUT_ID;
    $this->EMP_ID=$EMP_ID;
    $this->RUT_NOMBRE=$RUT_NOMBRE;
    $this->RUT_FECHA_CREACION=$RUT_FECHA_CREACION;
    $this->RUT_ESTADO=$RUT_ESTADO;
  }

  function crear(){
    $this->conn->conectar();
    $parametros="RUT_ID,EMP_ID, RUT_NOMBRE,RUT_FECHA_CREACION,RUT_ESTADO";
    $valores="null,$this->EMP_ID,'$this->RUT_NOMBRE','$this->RUT_FECHA_CREACION',$this->RUT_ESTADO";
    $result=$this->conn->insertar($parametros,$valores);
    $this->conn->desconectar();
    return $result;
  }

  function obtenerRutasX($parametro,$valor){
    $this->conn->conectar();
    $result=$this->conn->obtenerResultados($parametro,$valor);
    $this->rutas=array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $auxRuta=new local();
          $auxRuta->RUT_ID=$row['RUT_ID'];
          $auxRuta->EMP_ID=$row['EMP_ID'];
          $auxRuta->RUT_NOMBRE=$row['RUT_NOMBRE'];
          $auxRuta->RUT_FECHA_CREACION=$row['RUT_FECHA_CREACION'];
          $auxRuta->RUT_ESTADO=$row['RUT_ESTADO'];

          array_push($this->rutas , $auxRuta);
        }
    }
    $this->conn->desconectar();
    return $this->rutas;
  }
  function consultaCompleja($parametros,$tablas,$filtro){
    $this->conn->conectar();
    $result=$this->conn->obtenerResultadosCombinacion($parametros,$tablas,$filtro);
    $this->rutas=array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $auxRuta=new local();
          $auxRuta->RUT_ID=$row['RUT_ID'];
          $auxRuta->EMP_ID=$row['EMP_ID'];
          $auxRuta->RUT_NOMBRE=$row['RUT_NOMBRE'];
          $auxRuta->RUT_FECHA_CREACION=$row['RUT_FECHA_CREACION'];
          $auxRuta->RUT_ESTADO=$row['RUT_ESTADO'];

          array_push($this->rutas , $auxRuta);
        }
    }
    $this->conn->desconectar();
    return $this->rutas;
  }


}

 ?>
