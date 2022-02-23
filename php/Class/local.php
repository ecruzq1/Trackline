<?php
include_once("conexion.php");
/**
 *
 */
class local
{
  public $LOC_ID;
  public $EMP_ID;
  public $LOC_NOMBRE;
  public $LOC_NOMBRE_DUENO;
  public $LOC_TELEFONO;
  public $LOC_DIRECCION;
  public $LOC_LATITUD;
  public $LOC_LONGITUD;

  var $Tabla;
  var $conn;

  public $locales=array();
  function __construct()
  {
    $this->Tabla="local";
    $this->conn=new conexion($this->Tabla);
  }

  function recolectarDatos($LOC_ID,$EMP_ID,$LOC_NOMBRE,$LOC_NOMBRE_DUENO,$LOC_TELEFONO,$LOC_DIRECCION,$LOC_LATITUD,$LOC_LONGITUD){
    $this->LOC_ID=$LOC_ID;
    $this->EMP_ID=$EMP_ID;
    $this->LOC_NOMBRE=$LOC_NOMBRE;
    $this->LOC_NOMBRE_DUENO=$LOC_NOMBRE_DUENO;
    $this->LOC_TELEFONO=$LOC_TELEFONO;
    $this->LOC_DIRECCION=$LOC_DIRECCION;
    $this->LOC_LATITUD=$LOC_LATITUD;
    $this->LOC_LONGITUD=$LOC_LONGITUD;
  }

  function crear(){
    $this->conn->conectar();
    $parametros="LOC_ID,EMP_ID,LOC_NOMBRE,LOC_NOMBRE_DUENO,LOC_TELEFONO,LOC_DIRECCION,LOC_LATITUD,LOC_LONGITUD";
    $valores="null,$this->EMP_ID,'$this->LOC_NOMBRE','$this->LOC_NOMBRE_DUENO','$this->LOC_TELEFONO','$this->LOC_DIRECCION',$this->LOC_LATITUD,$this->LOC_LONGITUD";
    $result=$this->conn->insertar($parametros,$valores);
    $this->conn->desconectar();
    return $result;
  }

  function obtenerLocalesX($parametro,$valor){
    $this->conn->conectar();
    $result=$this->conn->obtenerResultados($parametro,$valor);
    $this->locales=array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $auxLoc=new local();
          $auxLoc->LOC_ID=$row['LOC_ID'];
          $auxLoc->EMP_ID=$row['EMP_ID'];
          $auxLoc->LOC_NOMBRE=$row['LOC_NOMBRE'];
          $auxLoc->LOC_NOMBRE_DUENO=$row['LOC_NOMBRE_DUENO'];
          $auxLoc->LOC_TELEFONO=$row['LOC_TELEFONO'];
          $auxLoc->LOC_DIRECCION=$row['LOC_DIRECCION'];
          $auxLoc->LOC_LATITUD=$row['LOC_LATITUD'];
          $auxLoc->LOC_LONGITUD=$row['LOC_LONGITUD'];
          array_push($this->locales , $auxLoc);
        }
    }
    $this->conn->desconectar();
    return $this->locales;
  }


}

 ?>
