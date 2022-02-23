<?php
include_once('cntrManageUser.php');
$userTp=$_GET['userTp'];
$objManageUser=new ManageUser();
 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <script type="text/javascript" src="../User/ManageUser/acciones.js"></script>
   </head>
   <body>
     <br><br>
     <table class="tb-Datos">
       <tr>
         <th>&nbsp&nbsp Nº &nbsp&nbsp</th>
          <th>&nbsp Nombre Completo &nbsp</th>
          <th>&nbsp Cédula &nbsp</th>
          <th colspan="3">&nbsp Opciones &nbsp</th>
        </tr>
        <?php $objManageUser->showRowUser($userTp); ?>
     </table>

   </body>
 </html>
