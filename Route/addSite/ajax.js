
function Registrar()
{
    var name = $("#name_local").val();
    var propetario = $("#owner").val();
    var phon = $("#phono").val();
    var direccion = $("#address").val();
    var latitud = $("#coordsLat").val();
    var longitud = $("#coordsLng").val();

    $.ajax({
        type: "POST",
        dataType: 'html',
        url: "../Route/addSite/addSite.php",
        data: "name_local="+name+"&owner="+propetario+"&phono="+phon+"&address="+direccion+"&coordsLat="+latitud+"&coordsLng="+longitud,
        success: function(resp){
            $('#respuesta').html(resp);
            Limpiar();

        }
    });
}

function Limpiar()
{
    $("#name_local").val("");
    $("#owner").val("");
    $("#phono").val("");
    $("#address").val("");
}
