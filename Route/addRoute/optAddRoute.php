<?php
include_once("cntrAddRoute.php");
$objAddRoute=new AddRoute();
$objAddRoute->obtenerLocales(1);




?>

<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Waypoints in directions</title>
    <link rel="stylesheet" href="../css/tablas.css">
    <link rel="stylesheet" href="../css/posicionamiento.css">
    <style>
      #map {
        width: 90%;
        height: 350px;
        float: left;
      }
    </style>
  </head>
  <body>
    <h1>Creación de Nuevas Rutas</h1>
    <div class="Div-Horizontal">
      <div class="SubDiv-Horizontal">
        <legend>Ruta generada</legend>
        <p>En el siguiente mapa podra ver la ruta generada.</p>
        <div id="map"></div>
      </div>
      <div class="SubDiv-Horizontal">
        <legend>Puntos</legend>
        <b>Nombre de la Ruta.</b>
        <input id="nameRoute" type="text" name="" value="" class="form-control">
        <br>
        <b>Inicio:</b>
        <select id="start" class="form-control">
          <?php $objAddRoute->localeOptions();?>
        </select>
        <br>
        <b>Intermedios:</b> <br>
        <i>(Ctrl+Click or Cmd+Click para selección multiple.)</i> <br>
        <select multiple id="waypoints" class="form-control">
          <?php $objAddRoute->localeOptions();?>
        </select>
        <br>
        <b>Final:</b>
        <select id="end" class="form-control">
          <?php $objAddRoute->localeOptions();?>
        </select>
        <br>
          <input class="btn btn-info" type="submit" id="submit" value="Generar Ruta">
      </div>
    </div>

    <div id="directions-panel">
      <legend>Escalas</legend>
      <table class="tb-Datos">
        <tr>
          <th>Segmento</th>
          <th>Desde</th>
          <th>Hacia</th>
          <th>Distancia</th>
          <th>Tiempo Aprox.</th>
        </tr>
        <tr>
          <td colspan="5">Todavia no a generado la ruta.</td>
        </tr>
      </table>
    </div>
    <script type="text/javascript" src="../Route/addRoute/map.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?callback=initMap"></script>

  </body>
</html>
