<?php
session_start();
include_once('../php/Class/alumno.php');
include_once('../php/Class/registroAsistenciaC.php');
$codCurso=$_GET['curso'];
$codMateria=$_GET['materia'];
$_SESSION['codCurso']=$codCurso;
if (isset($codMateria)) {
  // code...
  $_SESSION['codMateria']=$codMateria;
}
$objAlumnos=new alumnos($codCurso);
$objAlumnos->obtenerAlumnosCurso();
$objRegAsistencia=new regAsistencia();
if ($_SESSION['Tipo']==4) {
  $TUS_ID=1;
}else{
  $TUS_ID=2;
}
$objRegAsistencia->recolectarDatos(0,0,$TUS_ID,0,$codCurso,$codMateria);
if ($objRegAsistencia->verificarAsistenciaTomada()!=0) {
  $fecha=strftime( "%Y-%m-%d", time() );
  echo "&nbsp<h1>Estado del sistema</h1>";
  echo "<p>&nbsp&nbsp La asistencia del curso seleccionado ya ha sido tomada el dia de hoy  ($fecha).</p>";
    echo "<p>&nbsp&nbspSi cree que es un error contactese con el administrador.</p>";
  exit;
}
 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <script type="text/javascript">
       $(document).ready(function() {
         $("#GuardarDisciplina").click(function(event) {
           var idAlumnos=document.getElementsByName("idAlumnos[]");
           var Arreglo=[];
           for (var i = 0; i < idAlumnos.length; i++) {
             if (!idAlumnos.item(i).checked) {
               Arreglo.push(idAlumnos.item(i).value);
             }
           }

           if (Arreglo.length==0) {
             $("#Listas").load('../Profesor/guardarAsistencia.php');
           }else {
             $("#Listas").load('../Profesor/guardarAsistencia.php?idAlumnos[]='+Arreglo);
           }


         });
       });
     </script>
   </head>
   <body>
     <form class="" action="index.html" method="post">
       <h3><?php $fecha=strftime( "%Y-%m-%d", time() ); echo "Fecha: $fecha"; ?></h3>
       <?php $objAlumnos->mostrarAlumnosTabla(); ?>
       <br>
      <input id="GuardarDisciplina" type="button" class="btn btn-info" name="GuardarDisciplina" value="Guardar">
     </form>

   </body>
 </html>
