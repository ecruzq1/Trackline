$(document).ready(function() {
  $("#dateTime").on( "input", function() {
      //Obtener la fecha seleccionada
      var fecha=$( "#dateTime" ).val();
      $("#divD").load('../Monitoring/viewIncident/subViewIncidents.php?fecha='+fecha);
  });
  $('a').click(function(){
      var id_incidente=$(this).attr('id');
      $("#detalles").load('../Monitoring/viewIncident/subViewDetails.php?id_incidente='+id_incidente);
  });
});
