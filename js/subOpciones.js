$(document).ready(function() {
  $("#btnJefe1Sub1").click(function(event) {
    $("#cambio").load('../Perfil/optEditProfile.html');
  });

  $("#btnJefe2Sub1").click(function(event) {
    $("#cambio").load('../User/AddUser/optAddUser.php');
  });
  $("#btnJefe2Sub2").click(function(event) {
    $("#cambio").load('../User/ManageUser/optManageUser.php');
  });

  $("#btnJefe3Sub1").click(function(event) {
    $("#cambio").load('../Route/addSite/optAddSite.html');
  });
  $("#btnJefe3Sub3").click(function(event) {
    $("#cambio").load('../Route/addRoute/optAddRoute.php');
  });
  $("#btnJefe3Sub4").click(function(event) {
    $("#cambio").load('../Route/assignRoute/optAssignRoute.php');
  });
  //Opciones de Monitoreo
  $("#btnJefe4Sub1").click(function(event) {
    $("#cambio").load('../Monitoring/viewIncident/optViewIncident.php');
  });
  $("#btnJefe4Sub2").click(function(event) {
    $("#cambio").load('../Monitoring/followRoute/optFollowRoute.php');
  });
});
