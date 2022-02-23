$(document).ready(function() {
  //Select Combo
  $("#TypeCombo").on( "change", function() {
      var userTp=$( "#TypeCombo" ).val();
      $("#divTable").load('../User/ManageUser/tbUsers.php?userTp='+userTp);
  });
  //Botones
  $("#btnEditUser").click(function(event) {
    var identification=$("#identification").val();
    var NamePerson=$("#NamePerson").val();
    var LastnamePerson=$("#LastnamePerson").val();
    var SexCombo=$( "#SexCombo" ).val();
    var Email=$("#Email").val();
    var Address=$("#Address").val();
    var Telephone=$("#Telephone").val();

    var TypeCombo=$("#TypeCombo").val();
    var NameUser=$("#NameUser").val();
    var PassUser=$("#PassUser").val();
    var RepassUser=$("#RepassUser").val();

    if (identification=='' || NamePerson=='' || LastnamePerson==''
        && Email||'' || Address=='' || Telephone=='' || NameUser==''
        && PassUser=='' || RepassUser=='') {
      alert('Debe llenar todos los datos.');
    }else {
      if (PassUser==RepassUser) {
        $("#cambio").load('../User/ManageUser/resultView.php?1='+TypeCombo+'&2='
        +NameUser+'&3='+PassUser+'&4='+identification+'&5='+SexCombo+'&6='
        +NamePerson+'&7='+LastnamePerson+'&8='+Email+'&9='+Address+'&10='
        +Telephone);
      }else {
        alert("Las contraseñas no coinciden.");
      }
    }
  });
  $("#btnCancel").click(function(event) {
    alert("Edición de usuario cancelada,")
    $("#cambio").load('../User/ManageUser/optManageUser.php');
  });
  $("#btnReturn").click(function(event) {
    $("#cambio").load('../User/ManageUser/optManageUser.php');
  });
  //Enlaces
  $('a').click(function(){
    var USU_ID=$(this).attr('id');
    var option=$(this).attr('type-opt');

    if (option=='edit') {
      $("#divOption").load('../User/ManageUser/editView.php?USU_ID='+USU_ID);
    }else{
      if (option=='delete') {
        $("#divOption").load('../User/ManageUser/deletView.php?USU_ID='+USU_ID);
      }else {
        $("#divOption").load('../User/ManageUser/showView.php?USU_ID='+USU_ID);
      }

    }
  });
});
