 <?php
 include_once("../php/Class/conexion.php");
 class sesion{
   //Atributos Basicos de la clase
   var $Tabla;
   var $conn;

   function __construct(){
     $this->Tabla = "sesion";
     $this->conn=new conexion($this->Tabla);
   }

   function crearSesion($username,$num){
     $CODIGO=sha1($username.$num);
     $this->conn->conectar();
     $parametros="ID_SESION, CODIGO_SESION";
     $valores="NULL, '$CODIGO'";
     $result=$this->conn->insertar($parametros,$valores);
     $this->conn->desconectar();
     return $result;
   }
   function verificarSesion($ID){
     $this->conn->conectar();
     $result=$this->conn->obtenerResultados("CODIGO_SESION",$ID);
     $row = $result->fetch_array(MYSQLI_ASSOC);
     $this->conn->desconectar();
     if ($result->num_rows > 0) {
       return true;
     }else {
       return false;
     }

   }
   function cerrarSesion($CODIGO){
     $this->conn->conectar();
     $result=$this->conn->eliminarRegistro("CODIGO_SESION",$CODIGO);
     $this->conn->desconectar();
   }

 }//Fin de la Clase AdaCnxBd
 ?>
