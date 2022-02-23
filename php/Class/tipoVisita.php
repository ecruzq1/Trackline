<?php
include_once("conexion.php");
/**
 *
 */
class tipoVisita
{
  public $TPV_ID;
  public $TPV_NOMBRE;
  public $TPV_DESCRIPCION;

  var $Tabla;
  var $conn;

  public $tiposVisita=array();
  function __construct()
  {
    $this->Tabla="tipo_visita";
    $this->conn=new conexion($this->Tabla);
  }

  function recolectarDatos($TPV_ID,$TPV_NOMBRE,$TPV_DESCRIPCION){
    $this->TPV_ID=$TPV_ID;
    $this->TPV_NOMBRE=$TPV_NOMBRE;
    $this->TPV_DESCRIPCION=$TPV_DESCRIPCION;
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
