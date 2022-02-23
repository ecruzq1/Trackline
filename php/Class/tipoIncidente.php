<?php
include_once("conexion.php");
/**
 *
 */
class tipoIncidente
{
  public $TIN_ID;
  public $TIN_NOMBRE;

  var $Tabla;
  var $conn;

  public $tiposVisita=array();
  function __construct()
  {
    $this->Tabla="tipo_incidente";
    $this->conn=new conexion($this->Tabla);
  }

  function recolectarDatos($TIN_ID,$TIN_NOMBRE){
    $this->TIN_ID=$TIN_ID;
    $this->TIN_NOMBRE=$TIN_NOMBRE;
  }

  function obtenerTiposIncidenteAll(){
    $this->conn->conectar();
    $result=$this->conn->obtenerTodosResultados("*");
    $tiposIncidentes=array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $auxTipoInc=new tipoIncidente;
          $auxTipoInc->TIN_ID=$row['TIN_ID'];
          $auxTipoInc->TIN_NOMBRE=$row['TIN_NOMBRE'];
          array_push($tiposIncidentes , $auxTipoInc);
        }
    }
    $this->conn->desconectar();
    return $tiposIncidentes;
  }


}

 ?>
