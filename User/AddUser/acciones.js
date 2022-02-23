$(document).ready(function() {
  $("#btnSaveUser").click(function(event) {
    var identification=$("#identification").val();
    identification= identification.replace(/\s/g,"€");
    var NamePerson=$("#NamePerson").val();
    NamePerson= NamePerson.replace(/\s/g,"€");
    var LastnamePerson=$("#LastnamePerson").val();
    LastnamePerson= LastnamePerson.replace(/\s/g,"€");
    var SexCombo=$( "#SexCombo" ).val();
    var Email=$("#Email").val();
    Email= Email.replace(/\s/g,"€");
    var Address=$("#Address").val();
    Address= Address.replace(/\s/g,"€");
    var Telephone=$("#Telephone").val();
    var TypeCombo=$("#TypeCombo").val();
    var NameUser=$("#NameUser").val();
    var PassUser=$("#PassUser").val();

    if (identification=='' || NamePerson=='' || LastnamePerson==''
        && Email||'' || Address=='' || Telephone=='' || NameUser==''
        && PassUser=='') {
      alert('Debe llenar todos los datos.');
    }else {
        $("#cambio").load('../User/AddUser/saveUser.php?1='+TypeCombo+'&2='
        +NameUser+'&3='+PassUser+'&4='+identification+'&5='+SexCombo+'&6='
        +NamePerson+'&7='+LastnamePerson+'&8='+Email+'&9='+Address+'&10='
        +Telephone);
    }
  });

  $("#NamePerson").keyup(function () {
      var value = $(this).val();
      var valueApe=$("#LastnamePerson").val();
      var  separador = " ", arregloDeSubCadenas = valueApe.split(separador);
      if (value.length>0) {
        value=value.toLowerCase();
        if (arregloDeSubCadenas.length>0) {
          var valor2=arregloDeSubCadenas[0];
          valor2=valor2.toLowerCase();
          $("#NameUser").val(value.substring(0,1)+""+valor2);
        }else{
          $("#NameUser").val(value.substring(0,1));
        }
      }
    }).keyup();

    $("#LastnamePerson").keyup(function () {
        var value = $("#NamePerson").val();
        var valueApe=$(this).val();
        var  separador = " ", arregloDeSubCadenas = valueApe.split(separador);
        if (value.length>0) {
          value=value.toLowerCase();
          if (arregloDeSubCadenas.length>0) {
            var valor2=arregloDeSubCadenas[0];
            valor2=valor2.toLowerCase();
            $("#NameUser").val(value.substring(0,1)+""+valor2);
          }else{
            $("#NameUser").val(value.substring(0,1));
          }
        }
      }).keyup();

      $("#identification").keyup(function () {
        var value = $(this).val();
        $("#PassUser").val(value);
      }).keyup();
});
