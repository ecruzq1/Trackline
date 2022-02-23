<?php
include_once("cntrViewIncident.php");
$objViewIncident=new ViewIncident();

date_default_timezone_set('America/Guayaquil');
$fechaActual = date('Y-m-d');
?>

<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>View Incident</title>
    <link rel="stylesheet" href="../css/tablas.css">
    <link rel="stylesheet" href="../css/posicionamiento.css">
  </head>
  <body>
    <h1>Ver Incidentes</h1>
    <div class="Div-Horizontal">
      <div class="SubDiv-Horizontal">
        <legend>Filtro de fecha. </legend>
        <p>Seleccione una fecha.</p>
        <input type="date" class="form-control" id="dateTime"  name="dateTime" value="<?php echo $fechaActual;?>" >
        <br><br>


      </div>
      <div class="SubDiv-Horizontal" id="divD">
        <legend>Tabla de Incidentes. </legend>
        <p>Se muestran los incidenes para el dia: <?php echo $fechaActual; ?></p>
        <table class="tb-Datos">
            <?php $objViewIncident->obtenerTablaIncidentes($fechaActual); ?>
        </table>

      </div>
    </div>

    <h1 style="font-size: 18pt">Detalles</h1>
    <div id='detalles' class="Div-Horizontal">
      <p>No ha seleccionado ningun incidente.</p>
    </div>

    <script type="text/javascript" src="../Monitoring/viewIncident/ajax.js"></script>

  </body>
</html>
