function initMap() {
  navigator.geolocation.getCurrentPosition(
    function (position){
      coords =  {
        lng: position.coords.longitude,
        lat: position.coords.latitude
      };
      var directionsService = new google.maps.DirectionsService;
      var directionsDisplay = new google.maps.DirectionsRenderer;
      var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 13,
    center: {lat: coords.lat, lng: coords.lng}
      });
      directionsDisplay.setMap(map);
      document.getElementById('submit').addEventListener('click', function() {
        calculateAndDisplayRoute(directionsService, directionsDisplay);
      });
    },function(error){console.log(error);});
}

function calculateAndDisplayRoute(directionsService, directionsDisplay) {
  var waypts = [];
  var checkboxArray = document.getElementById('waypoints');
  var seleccionados="";
  var cont=0;
  for (var i = 0; i < checkboxArray.length; i++) {
    if (checkboxArray.options[i].selected) {
      seleccionados+=checkboxArray.options[i].getAttribute("loc_id")+",";
      cont++;
      waypts.push({
        location: checkboxArray[i].value,
        stopover: true
      });
    }
  }

  directionsService.route({
    origin: document.getElementById('start').value,
    destination: document.getElementById('end').value,
    waypoints: waypts,
    optimizeWaypoints: true,
    travelMode: 'DRIVING'
  }, function(response, status) {
    if (status === 'OK') {
      directionsDisplay.setDirections(response);
      var route = response.routes[0];
      var summaryPanel = document.getElementById('directions-panel');
      summaryPanel.innerHTML = '';

      // For each route, display summary information.
      var distancia="";
      var tiempos="";
      var htmlTabla="";
      htmlTabla +="<table class='tb-Datos'> <tr><th style='text-align: center'>Segmento&nbsp&nbsp</th><th >Desde</th><th>Hacia</th><th>&nbsp&nbspDistancia&nbsp&nbsp</th><th>&nbsp&nbspTiempo Aprox.&nbsp&nbsp</th></tr>";


      summaryPanel.innerHTML = '<legend>Escalas</legend>';
      for (var i = 0; i < route.legs.length; i++) {
        var routeSegment = i + 1;
        htmlTabla += "<tr><td style='text-align: center'>" + routeSegment +"</td>";
        htmlTabla += "<td>&nbsp&nbsp"+route.legs[i].start_address + "&nbsp&nbsp</td>";
        htmlTabla += "<td>&nbsp&nbsp"+route.legs[i].end_address + "&nbsp&nbsp</td>";
        htmlTabla += "<td style='text-align: center'>&nbsp&nbsp"+route.legs[i].distance.text + "&nbsp&nbsp</td>";
        //summaryPanel.innerHTML += route.legs[i].distance.value + '<br>';
        htmlTabla += "<td style='text-align: center'>&nbsp&nbsp"+ route.legs[i].duration.text + "&nbsp&nbsp</td></tr>";
        //summaryPanel.innerHTML += 'duration value: ' + route.legs[i].duration.value + '<br><br>';

        tiempos+=route.legs[i].duration.text+",";
        distancia+=route.legs[i].distance.text +"-";

      }
      summaryPanel.innerHTML +=htmlTabla;
      summaryPanel.innerHTML +="<div id='respuesta'><legend>Estado</legend></div>";
      tiempos+="0 min";
      distancia+="0 km";

      var orden="1,";
      //summaryPanel.innerHTML += '<br><br><br>waypoint_order: [' + '<br>';
      for (var i=0; i < route.waypoint_order.length; i++) {
        var num = route.waypoint_order[i]+2;
        //summaryPanel.innerHTML += num + '<br>';
        orden+=num+",";
                 // AllMarkers[i].setIcon("http://chart.googleapis.com/chart?chst=d_map_pin_letter&chld=" + (num + 1) +"|FF776B|000000")
      }
      //summaryPanel.innerHTML += ']' + '<br>';
      orden+=cont+2;

      var nombre=document.getElementById('nameRoute').value;
      var comienzo=$("#start option:selected").attr('loc_id');
      var final=$("#end option:selected").attr('loc_id');
      var ruta=comienzo+","+seleccionados+final;
      var res = nombre.replace(" ", "%");
      //Enviar datos a guardar
      alert("Distancia de "+res+": "+distancia);
      $.ajax({
          type: "POST",
          dataType: 'html',
          url: "../Route/addRoute/addRoute.php",
          data: "Ruta="+ruta+"&Orden="+orden+"&Tiempo="+tiempos+"&Distancia="+distancia+"&Nombre="+res,
          success: function(resp){
              $('#respuesta').html(resp);
          }
      });
      //alert("Ruta: "+ruta);
      //alert("Orden: "+orden);
      //alert("Tiempo: "+tiempos);
    } else {
      window.alert('Directions request failed due to ' + status);
    }
  });
}
