$(document).ready(function() {
  $("#dateTime").on( "input", function() {
      //Obtener la fecha seleccionada
      var fecha=$( "#dateTime" ).val();
      $("#divI-U").load('../Monitoring/followRoute/subViewUsers.php?fecha='+fecha);
  });
  $("#selUser").on( "change", function() {
      //Obtener El curso seleccionado
      var fecha=$( "#dateTime" ).val();
      var idUser=$( "#selUser" ).val();
      //var codMateria=$('#selCombo option:selected').attr('data-idMateria');
      $("#divD").load('../Monitoring/followRoute/subViewRoutes.php?idUser='+idUser+'&fecha='+fecha);
  });
  $('a').click(function(){
      var id_visita=$(this).attr('id');
      $("#detalles").load('../Monitoring/followRoute/subViewDetails.php?id_visita='+id_visita);
  });
});
