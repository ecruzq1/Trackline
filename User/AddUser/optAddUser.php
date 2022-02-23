<!DOCTYPE html>
 <html lang="es" dir="ltr">
   <head>
     <meta charset="utf-8">
     <link rel="stylesheet" href="../css/posicionamiento.css">
     <script type="text/javascript" src="../User/AddUser/acciones.js"></script>

   </head>
   <body>
     <h1>Crear Nuevo usuario.</h1>
     <p></p>
     <br>
     <div class="Div-Horizontal">
       <div class="SubDiv-Horizontal">
         <fieldset class="form-group">
           <legend>Datos Personales:</legend><fieldset>
           <table>
             <tr>
               <td><label for="identification">Cedula: </label></td>
               <td style="width: 300px"><input type="text" class="form-control" id="identification" name="identification" value=""></td>
             </tr>
             <tr>
               <td><label for="NamePerson">Nombre: </label></td>
               <td><input type="text" class="form-control" id="NamePerson"  name="NamePerson" value=""></td>
             </tr>
             <tr>
               <td><label for="LastnamePerson">Apellido: </label></td>
               <td><input type="text" class="form-control" id="LastnamePerson" name="LastnamePerson" value=""></td>
             </tr>
             <tr>
               <td><label for="SexCombo">Sexo: </label></td>
               <td>  <SELECT id="SexCombo" name="SexCombo" class="form-control" SIZE=1 onChange="javascript:alert('prueba');">
                       <OPTION VALUE="1">Masculino</OPTION>
                       <OPTION VALUE="2">Femenino</OPTION>
                     </SELECT>
              </td>
             </tr>
             <tr>
               <td><label for="Email">Correo: </label></td>
               <td><input type="text" class="form-control" id="Email" name="Email" value=""></td>
             </tr>
             <tr>
               <td><label for="Adress">Direccion: &nbsp</label></td>
               <td><input type="text" class="form-control" id="Address" name="Address" value=""></td>
             </tr>
             <tr>
               <td><label for="Telephone">Telefono: </label></td>
               <td><input type="text" class="form-control" id="Telephone" name="Telephone" value=""></td>
             </tr>
           </table>
         </fieldset>
       </div>

       <div class="SubDiv-Horizontal">
         <fieldset class="form-group">
           <legend>Datos de Usuario:</legend><fieldset>
           <table>
             <tr>
               <td><label for="TypeCombo">Tipo de Usuario: </label></td>
               <td>
                 <SELECT id="TypeCombo" name="TypeCombo" class="form-control" size=1 onChange="javascript:alert('prueba');">
                 <OPTION VALUE="2">Vendedor</OPTION>
                 <OPTION VALUE="3">Promotor</OPTION>
                 <OPTION VALUE="4">Reparador</OPTION>
                 </SELECT>
               </td>
             </tr>
             <tr>
               <td><label for="NameUser">Nombre de Usuario: </label></td>
               <td style="width: 300px"><input type="text" class="form-control" id="NameUser" name="NameUser" value="" readonly></td>
             </tr>
             <tr>
               <td><label for="PassUser">Contraseña: </label></td>
               <td><input type="password" class="form-control" id="PassUser" name="PassUser" value="" readonly></td>
             </tr>

           </table>
         </fieldset>
       </div>
     </div>
  <input id="btnSaveUser" type="button" class="btn btn-info" name="btnSaveUser" value="Crear Usuario">


   </body>
 </html>
