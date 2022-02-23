$(document).ready(function() {
  $("#btnBossG1").click(function(event) {
    $("#contenedor").load('../Panel-Control/contenedor.php?opcion=1');
  });
  $("#btnBossG2").click(function(event) {
    $("#contenedor").load('../Panel-Control/contenedor.php?opcion=2');
  });
  $("#btnBossG3").click(function(event) {
    $("#contenedor").load('../Panel-Control/contenedor.php?opcion=3');
  });

  $("#btnBossG4").click(function(event) {
    $("#contenedor").load('../Panel-Control/contenedor.php?opcion=4');
  });

  $("#btnBossG5").click(function(event) {
    $("#contenedor").load('../Panel-Control/contenedor.php?opcion=5');
  });
});
