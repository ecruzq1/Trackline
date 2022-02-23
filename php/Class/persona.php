<?php
include_once("conexion.php");
class persona{
  //Atributos Basicos de la clase
  var $PER_CEDULA;
  var $USU_ID;
  var $SEX_ID;
  var $PER_NOMBRE;
  var $PER_APELLIDO;
  var $PER_CORREO;
  var $PER_DIRECCION;
  var $PER_TELEFONO;


  var $Tabla;
  //Atributos Modificados
  var $conn;


  function __construct(){
    $this->Tabla="persona";
    $this->conn=new conexion($this->Tabla);
  }

  function obtenerDatos($PER_CEDULA){
    $this->PER_CEDULA=$PER_CEDULA;
    $this->conn->conectar();
    $result=$this->conn->obtenerResultados("PER_CEDULA",$this->PER_CEDULA);
    $row = $result->fetch_array(MYSQLI_ASSOC);
    //Llenar los datos
    $this->USU_ID=$row['USU_ID'];
    $this->SEX_ID=$row['SEX_ID'];
    $this->PER_NOMBRE=$row['PER_NOMBRE'];
    $this->PER_APELLIDO=$row['PER_APELLIDO'];
    $this->PER_CORREO=$row['PER_CORREO'];
    $this->PER_DIRECCION=$row['PER_DIRECCION'];
    $this->PER_TELEFONO=$row['PER_TELEFONO'];
    $this->conn->desconectar();
  }
  function obtenerDatosX($parametro,$valor){
    $this->conn->conectar();
    $result=$this->conn->obtenerResultados($parametro,$valor);
    $row = $result->fetch_array(MYSQLI_ASSOC);
    //Llenar los datos
    $this->PER_CEDULA=$row['PER_CEDULA'];
    $this->USU_ID=$row['USU_ID'];
    $this->SEX_ID=$row['SEX_ID'];
    $this->PER_NOMBRE=$row['PER_NOMBRE'];
    $this->PER_APELLIDO=$row['PER_APELLIDO'];
    $this->PER_CORREO=$row['PER_CORREO'];
    $this->PER_DIRECCION=$row['PER_DIRECCION'];
    $this->PER_TELEFONO=$row['PER_TELEFONO'];
    $this->conn->desconectar();
  }
  function recolectarDatos($PER_CEDULA,$USU_ID,$SEX_ID,$PER_NOMBRE,$PER_APELLIDO,$PER_CORREO,$PER_DIRECCION,$PER_TELEFONO){
    $this->PER_CEDULA=$PER_CEDULA;
    $this->USU_ID=$USU_ID;
    $this->SEX_ID=$SEX_ID;
    $this->PER_NOMBRE=$PER_NOMBRE;
    $this->PER_APELLIDO=$PER_APELLIDO;
    $this->PER_CORREO=$PER_CORREO;
    $this->PER_DIRECCION=$PER_DIRECCION;
    $this->PER_TELEFONO=$PER_TELEFONO;
  }

  function crear(){
    $this->conn->conectar();
    $parametros="PER_CEDULA,USU_ID,SEX_ID,PER_NOMBRE,PER_APELLIDO,PER_CORREO,PER_DIRECCION,PER_TELEFONO";
    $valores="'$this->PER_CEDULA',$this->USU_ID,$this->SEX_ID,'$this->PER_NOMBRE','$this->PER_APELLIDO','$this->PER_CORREO','$this->PER_DIRECCION','$this->PER_TELEFONO'";
    $result=$this->conn->insertar($parametros,$valores);
    $this->conn->desconectar();
    return $result;
  }
  function consultarMixPerUsuX($parametro,$valor){
    $this->conn->conectar();
    $parametros="`PER_CEDULA`,per.`USU_ID`,`SEX_ID`,`PER_NOMBRE`,`PER_APELLIDO`,`PER_CORREO`,`PER_DIRECCION`,`PER_TELEFONO`";
    $tablas="persona as per INNER JOIN usuario as usu ON per.USU_ID=usu.USU_ID";
    $filtros="$parametro like BINARY '".$valor."'";
    $result=$this->conn->obtenerResultadosCombinacion($parametros,$tablas,$filtros);
    $personas= array() ;
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $auxPer=new persona();
          $auxPer->PER_CEDULA=$row['PER_CEDULA'];
          $auxPer->USU_ID=$row['USU_ID'];
          $auxPer->SEX_ID=$row['SEX_ID'];
          $auxPer->PER_NOMBRE=$row['PER_NOMBRE'];
          $auxPer->PER_APELLIDO=$row['PER_APELLIDO'];
          $auxPer->PER_CORREO=$row['PER_CORREO'];
          $auxPer->PER_DIRECCION=$row['PER_DIRECCION'];
          $auxPer->PER_TELEFONO=$row['PER_TELEFONO'];
          array_push($personas , $auxPer);
        }
    }
    $this->conn->desconectar();
    return $personas;
  }

}//Fin de la clase Usuario
?>
