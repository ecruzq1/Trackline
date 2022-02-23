<?php
include_once("conexion.php");
class usuario{
  //Atributos Basicos de la clase
  var $ID; //Nombre de la maquina donde se encuentra la BD generalmente es localhost
  var $Tipo; //Nombre de la Base de Datos
  var $Nombre; //Nombre del usuario autorizado para entrar a la Base de Datos
  var $Usuario; //Contraseña del Usuario
  var $Tabla;
  private $usuarios=array();

  var $USU_ID;
  var $TPU_ID;
  var $EMP_ID;
  var $USU_NOMBRE;
  var $USU_CONTRASEÑA;
  var $USU_ESTADO;
  //Atributos Modificados
  var $conn;




  //Constructor de la Clase
  //Inicializa algunos atributos Básicos
  //Ejemplo: $objBD=new //AdaCnxBD("localhost","MiBaseDeDatos","MiNombreDeUsuario","MiContraseña");
  function __construct($Usuario){
    $this->Usuario=$Usuario;
    $this->Tabla="usuario";
    $this->conn=new conexion($this->Tabla);
  }

  function obtenerDatos(){
    $this->conn->conectar();
    $result=$this->conn->obtenerResultados("USU_NOMBRE",$this->Usuario);
    $row = $result->fetch_array(MYSQLI_ASSOC);
    //Llenar los datos
    $this->ID=$row['USU_ID'];
    $this->Tipo=$row['TPU_ID'];
    $this->Nombre=$row['USU_NOMBRE'];
    $this->Usuario=$row['USU_NOMBRE'];
    $this->conn->desconectar();

  }
  function obtenerDatosX($parametro,$valor){
    $this->conn->conectar();
    $result=$this->conn->obtenerResultados($parametro,$valor);
    $row = $result->fetch_array(MYSQLI_ASSOC);
    //Llenar los datos
    $this->USU_ID=$row['USU_ID'];
    $this->TPU_ID=$row['TPU_ID'];
    $this->EMP_ID=$row['EMP_ID'];
    $this->USU_NOMBRE=$row['USU_NOMBRE'];
    $this->USU_CONTRASEÑA=$row['USU_CONTRASENA'];
    $this->USU_ESTADO=$row['USU_ESTADO'];
    $this->conn->desconectar();
  }
  function obtenerUsuariosX($parametro,$valor){
    $this->conn->conectar();
    $result=$this->conn->obtenerResultados($parametro,$valor);
    $this->usuarios=array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $auxUsu=new usuario(null);
          $auxUsu->USU_ID=$row['USU_ID'];
          $auxUsu->TPU_ID=$row['TPU_ID'];
          $auxUsu->EMP_ID=$row['EMP_ID'];
          $auxUsu->USU_NOMBRE=$row['USU_NOMBRE'];
          $auxUsu->USU_CONTRASEÑA=$row['USU_CONTRASENA'];
          $auxUsu->USU_ESTADO=$row['USU_ESTADO'];
          array_push($this->usuarios , $auxUsu);
        }
    }
    $this->conn->desconectar();
    return $this->usuarios;
  }
  function autenticarUsuario($user,$pwd){
    $this->conn->conectar();
    $result=$this->conn->obtenerResultados("USU_NOMBRE",$user);
    $this->conn->desconectar();
    if ($result->num_rows > 0) {
      $row = $result->fetch_array(MYSQLI_ASSOC);
      if (sha1($pwd) ===$row['USU_CONTRASENA']) {
        echo "Usuario Autentificado correctamente";
        return 2;
      }else{
        echo "Contrasenia Incorrecta";
        return 1;
      }
    }else {
      echo "Usuario Inexistente";
      return 0;
    }
  }

  function recolectarDatos($TPU_ID,$EMP_ID,$USU_NOMBRE,$USU_CONTRASEÑA,$USU_ESTADO){
    $this->TPU_ID=$TPU_ID;
    $this->EMP_ID=$EMP_ID;
    $this->USU_NOMBRE=$USU_NOMBRE;
    $this->USU_CONTRASEÑA=$USU_CONTRASEÑA;
    $this->USU_ESTADO=$USU_ESTADO;
  }

  function crear(){
    $this->conn->conectar();
    $parametros="USU_ID,TPU_ID,EMP_ID,USU_NOMBRE,USU_CONTRASENA,USU_ESTADO";
    $valores="null,$this->TPU_ID,$this->EMP_ID,'$this->USU_NOMBRE','$this->USU_CONTRASEÑA',$this->USU_ESTADO";
    $result=$this->conn->insertar($parametros,$valores);
    $this->conn->desconectar();
    if ($result) {
      $this->obtenerID();
    }
    return $this->USU_ID;
  }
  function obtenerID(){
    $this->conn->conectar();
    $result=$this->conn->obtenerResultados("USU_NOMBRE",$this->USU_NOMBRE);
    $row = $result->fetch_array(MYSQLI_ASSOC);
    //Llenar los datos
    $this->USU_ID=$row['USU_ID'];
    $this->conn->desconectar();
  }

  function consultarXID($TPU_ID){
    $this->conn->conectar();
    $result=$this->conn->obtenerResultados("TPU_ID",$TPU_ID);
    $row = $result->fetch_array(MYSQLI_ASSOC);
    //Llenar los datos
    $this->ID=$row['USU_ID'];
    $this->Tipo=$row['TPU_ID'];
    $this->Nombre=$row['USU_NOMBRE'];
    $this->Usuario=$row['USU_NOMBRE'];
    $this->conn->desconectar();
  }
  function consultarXTPU($TPU_ID){
    $this->conn->conectar();
    $result=$this->conn->obtenerResultados('TPU_ID',$TPU_ID);
    $this->conn->desconectar();
    return $result;
  }

}//Fin de la clase Usuario
?>
