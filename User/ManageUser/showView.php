<?php
include_once("cntrManageUser.php");
$objManageUser=new ManageUser();
$USU_ID=$_GET['USU_ID'];
$objManageUser->recuperarDatos($USU_ID);
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <script type="text/javascript" src="../User/ManageUser/acciones.js"></script>
  </head>
  <body>
    <h1>Mostrar datos de usuarios</h1>
    <div class="Div-Horizontal">
      <div class="SubDiv-Horizontal">
        <fieldset class="form-group">
          <legend>Datos Personales:</legend><fieldset>
          <table>
            <tr>
              <td><label for="identification">Cedula: </label></td>
              <td style="width: 300px"><input type="text" class="form-control" id="identification" name="identification" value="<?php echo $objManageUser->objPersona->PER_CEDULA; ?>"></td>
            </tr>
            <tr>
              <td><label for="NamePerson">Nombre: </label></td>
              <td><input type="text" class="form-control" id="NamePerson"  name="NamePerson" value="<?php echo $objManageUser->objPersona->PER_NOMBRE; ?>"></td>
            </tr>
            <tr>
              <td><label for="LastnamePerson">Apellido: </label></td>
              <td><input type="text" class="form-control" id="LastnamePerson" name="LastnamePerson" value="<?php echo $objManageUser->objPersona->PER_APELLIDO; ?>"></td>
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
              <td><input type="text" class="form-control" id="Email" name="Email" value="<?php echo $objManageUser->objPersona->PER_CORREO; ?>"></td>
            </tr>
            <tr>
              <td><label for="Adress">Direccion: &nbsp</label></td>
              <td><input type="text" class="form-control" id="Address" name="Address" value="<?php echo $objManageUser->objPersona->PER_DIRECCION; ?>"></td>
            </tr>
            <tr>
              <td><label for="Telephone">Telefono: </label></td>
              <td><input type="text" class="form-control" id="Telephone" name="Telephone" value="<?php echo $objManageUser->objPersona->PER_TELEFONO; ?>"></td>
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
              <td style="width: 300px"><input type="text" class="form-control" id="NameUser" name="NameUser" value="<?php echo $objManageUser->objUsuario->USU_NOMBRE; ?>"></td>
            </tr>
          </table>
        </fieldset>
      </div>
    </div>
    <input id="btnReturn" type="button" class="btn btn-info" name="btnReturn" value="Regresar">
  </body>
</html>
