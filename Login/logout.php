<?php
session_start();
unset ($_SESSION['username']);
session_destroy();

echo "Gracias por utilizar el sistema.<br>";
echo "<br><a href='../index.html'>Volver a Ingresar</a>";
?>
