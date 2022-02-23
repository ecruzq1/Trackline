<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/tablas.css">
    <link rel="stylesheet" href="../css/posicionamiento.css">
    <script type="text/javascript" src="../User/ManageUser/acciones.js"></script>
  </head>
  <body>
    <div id="divOption" class="">
      <h1>Administración de usuarios</h1>
        <table>
          <tr>
            <td><p>Seleccione el tipo de usuario: &nbsp</p> </td>
            <td style="width: 300px"><SELECT id="TypeCombo" name="TypeCombo" class="form-control" SIZE=1>
            <OPTION VALUE="null" disabled selected>Selecione un tipo de usuario</OPTION>
            <OPTION VALUE="2">Vendedor</OPTION>
            <OPTION VALUE="3">Promotor</OPTION>
            <OPTION VALUE="4">Reparador</OPTION>
            </SELECT></td>
          </tr>
        </table>
        <div id="divTable">
            <br><br>
            <p>Todavia no ha seleccionado un tipo de usuario</p>
        </div>
    </div>
  </body>
</html>
