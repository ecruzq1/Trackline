<?php
include_once("conexion.php");
/**
 *
 */
class incidente
{
  public $TIN_ID;
  public $LVI_ID;
  public $INC_DESCRIPCION;
  public $INC_FECHA;
  public $INC_HORA;


  var $Tabla;
  var $conn;

  public $locales=array();
  function __construct()
  {
    $this->Tabla="incidente";
    $this->conn=new conexion($this->Tabla);
  }

  function recolectarDatos($TIN_ID,$LVI_ID, $INC_DESCRIPCION,$INC_FECHA,$INC_HORA){
    $this->TIN_ID=$INC_ID;
    $this->LVI_ID=$LVI_ID;
    $this->INC_DESCRIPCION=$INC_DESCRIPCION;
    $this->INC_FECHA=$INC_FECHA;
    $this->INC_HORA=$INC_HORA;
  }

  function crear(){
    $this->conn->conectar();
    $parametros="TIN_ID,LVI_ID,INC_DESCRIPCION,INC_FECHA,INC_HORA";
    $valores="$this->TIN_ID,$this->LVI_ID,'$this->INC_DESCRIPCION','$this->INC_FECHA',$this->INC_HORA";
    $result=$this->conn->insertar($parametros,$valores);
    $this->conn->desconectar();
    return $result;
  }

  function obtenerIncidentesX($parametro,$valor){
    $this->conn->conectar();
    $result=$this->conn->obtenerResultados($parametro,$valor);
    $this->incidentes=array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $auxIncidente=new incidente;
          $auxIncidente->TIN_ID=$row['TIN_ID'];
          $auxIncidente->LVI_ID=$row['LVI_ID'];
          $auxIncidente->INC_DESCRIPCION=$row['INC_DESCRIPCION'];
          $auxIncidente->INC_FECHA=$row['INC_FECHA'];
          $auxIncidente->INC_HORA=$row['INC_HORA'];

          array_push($this->incidentes , $auxIncidente);
        }
    }
    $this->conn->desconectar();
    return $this->incidentes;
  }

}

 ?>
