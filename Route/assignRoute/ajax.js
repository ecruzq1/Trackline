$(document).ready(function() {
  $("#selRoute").on( "change", function() {
      //Obtener El curso seleccionado
      var idRoute=$( "#selRoute" ).val();
      //var codMateria=$('#selCombo option:selected').attr('data-idMateria');
      $("#divD").load('../Route/assignRoute/confRoute.php?idRoute='+idRoute);
  });
  $("#btnSaveConf").click(function(event) {
    var idTipo=document.getElementsByName("idTipoVisita[]");
    var tiempoVisita=document.getElementsByName("tiempoVisita[]");
    var fechaSel=document.getElementById('dateTime').value;
    var horaSel=document.getElementById('hourTime').value;

    var usuario=document.getElementById('selUser').value;
    var ruta=document.getElementById('selRoute').value;

    var tiposArray;
    var tiemposArray;
    var band2=1;

    for (var i = 0; i < idTipo.length; i++) {
      if (i==0) {
        tiposArray=idTipo.item(i).value;
        tiemposArray=tiempoVisita.item(i).value;

      }else{
        tiposArray=tiposArray+','+idTipo.item(i).value;
        tiemposArray=tiemposArray+','+tiempoVisita.item(i).value;
      }
      if (tiempoVisita.item(i).value=="") {
        band2=0;
      }
    }
    //Vaidacion de vacios
    if (usuario!=""&&ruta!=""&&fechaSel!=""&&horaSel!=""&&band2!=0) {
      $.ajax({
          type: "POST",
          dataType: 'html',
          url: "../Route/assignRoute/assignRoute.php",
          data: "types="+tiposArray+"&times="+tiemposArray+"&date="+fechaSel+"&time="+horaSel+"&user="+usuario+"&route="+ruta,
          success: function(resp){
              $('#respuesta').html(resp);
          }
      });
    }else{
      alert("Es necesario que ingrese todos los datos solicitados.");
    }
  });
});
