<?php
class conexion{
  //Atributos Basicos de la clase
  var $servidor; //Nombre de la maquina donde se encuentra la BD generalmente es localhost
  var $nombreBD; //Nombre de la Base de Datos
  var $nombreDeUsuario; //Nombre del usuario autorizado para entrar a la Base de Datos
  var $contrasena; //Contraseña del Usuario
  var $nombreTabla;
  //Atributos Modificados
  var $enlace;//Almacena el enlace con la Base de Datos una vez establecido
  var $resultado;//Almacena el resultado obtenido por la consulta a la BD
  var $consulta;//Almacena la consulta realizada con el metodo consultaBD();
  var $conn;



  //Constructor de la Clase
  //Inicializa algunos atributos Básicos
  //Ejemplo: $objBD=new //AdaCnxBD("localhost","MiBaseDeDatos","MiNombreDeUsuario","MiContraseña");
  function __construct($nombreTabla){
    $this->nombreTabla = $nombreTabla;
    $this->servidor="localhost";
    $this->nombreBD="trackline";
    $this->nombreDeUsuario="track1";
    $this->contrasena="track1";
  }



  //Metodos y Procedimientos
  //conectar(); Te permite conectar y enlazar la BD, el enlace a la BD es almacenado modificando
  //el atributo $enlace
  //Ejemplo: $objBD->conectarBD();
  function conectar(){

    $this->conn = new mysqli($this->servidor, $this->nombreDeUsuario, $this->contrasena,$this->nombreBD);
    // Check connection
   if ($this->conn->connect_error) {
       die("Error 0xC300, Coneccion Fallida: " . $conn->connect_error);
   }

  }
  function insertar($parametros,$valores){
    $this->sentenciaSQL="INSERT INTO $this->nombreTabla ($parametros) VALUES ($valores)";
    //$this->sentenciaSQL=$sql;
    //echo "Sentencia: ".$this->sentenciaSQL."<br>";
    $this->resultado=$this->conn->query($this->sentenciaSQL);
    if ($this->resultado==0) {
      echo "Error 0xB300, no se han registrado nuevos datos.";
    }
    return $this->resultado;
  }
  function obtenerResultados($Parametro,$Comparar){
    $this->sentenciaSQL="SELECT * FROM $this->nombreTabla WHERE $Parametro like BINARY '$Comparar'";
    $this->resultado=$this->conn->query($this->sentenciaSQL);
    return $this->resultado;
  }
  function obtenerResultadosCombinacion($parametros,$tablas,$filtro){
    $this->sentenciaSQL="SELECT $parametros FROM $tablas WHERE $filtro";
    $this->resultado=$this->conn->query($this->sentenciaSQL);
    return $this->resultado;
  }
  function obtenerTodosResultados($Filtrado){
    $this->sentenciaSQL="SELECT $Filtrado FROM $this->nombreTabla";
    $this->resultado=$this->conn->query($this->sentenciaSQL);
    return $this->resultado;
  }
  function eliminarRegistro($Parametro,$Valor){
    $this->sentenciaSQL="DELETE FROM $this->nombreTabla WHERE $Parametro like '$Valor'";
    $this->resultado=$this->conn->query($this->sentenciaSQL);
    return $this->resultado;
  }
  function desconectar(){
    $this->conn->close();
  }
}//Fin de la Clase AdaCnxBd
?>
