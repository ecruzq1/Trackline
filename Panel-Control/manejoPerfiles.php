<?php
class manejoPerfiles
{
  private $Tipo_Usuario;
  public function __construct($argument)
  {
    $this->Tipo_Usuario=$argument;
  }
  public function mostrarOpciones(){
    switch ($this->Tipo_Usuario) {
      case '1':
        $html="
        <li><a name='btnBossG1' id='btnBossG1' href='#'>Perfil</a></li>
        <li><a name='btnBossG2' id='btnBossG2' href='#'>Usuarios</a></li>
        <li><a name='btnBossG3' id='btnBossG3' href='#'>Rutas</a></li>
        <li><a name='btnBossG4' id='btnBossG4' href='#'>Monitoreo</a></li>

        ";
        //<li><a name='btnBossG5' id='btnBossG5' href='#'>Reportes</a></li>
        break;
     case '2':
       $html="
       <li><a name='btnAdm1' id='btnAdm1' href='#'>Actualizar Sistema</a></li>
       <li><a name='btnAdm2' id='btnAdm2' href='#'>Resportes</a></li>
       ";
        break;
     default:
        $html="<li><a href='#'>Ninguno</a></li>";
       break;
    }
    echo ($html);
  }
  public function mostrarSubopciones($seleccionado){
    switch ($seleccionado) {
      case '1':
        $html="
        <input id='btnJefe1Sub1' name='btnJefe1Sub1' type='button' class='btn btn-info botonimagen img-profile1' value='Ver Perfil'>
        ";
        break;
     case '2':
         $html="
         <input id='btnJefe2Sub1' name='btnJefe2Sub1' type='button' class='btn btn-info botonimagen img-user1' value='Nuevo Usuario'>
         <input id='btnJefe2Sub2' name='btnJefe2Sub2' type='button' class='btn btn-info botonimagen img-user2' value='Administrar Usuarios'>
         ";
        break;
     case '3':
     //<input id='btnJefe3Sub2' name='btnJefe3Sub2' type='button' class='btn btn-info botonimagen img-route2' value='Ver Rutas'>
         $html="
         <input id='btnJefe3Sub1' name='btnJefe3Sub1' type='button' class='btn btn-info botonimagen img-route1' value='Nuevo Sitio'>

         <input id='btnJefe3Sub3' name='btnJefe3Sub3' type='button' class='btn btn-info botonimagen img-route3' value='Crear Rutas'>
         <input id='btnJefe3Sub4' name='btnJefe3Sub4' type='button' class='btn btn-info botonimagen img-route3' value='Asignar Rutas'>
         ";
        break;
     case '4':
         $html="
         <input id='btnJefe4Sub1' name='btnJefe4Sub1' type='button' class='btn btn-info botonimagen img-monitoring1' value='Ver Incidentes'>
         <input id='btnJefe4Sub2' name='btnJefe4Sub2' type='button' class='btn btn-info botonimagen img-monitoring2' value='Monitorear Rutas'>
         ";
        break;
     case '5':
         $html="
         <input id='btnJefe5Sub1' name='btnJefe5Sub1' type='button' class='btn btn-info botonimagen img-report1' value='Incidentes'>
         <input id='btnJefe5Sub2' name='btnJefe5Sub2' type='button' class='btn btn-info botonimagen img-report2' value='Rutas'>
         <input id='btnJefe5Sub3' name='btnJefe5Sub3' type='button' class='btn btn-info botonimagen img-report3' value='Tiempos'>
         ";
        break;
     default:
        $html="<li><a href='#'>Ninguno</a></li>";
       break;
    }
    echo ($html);
  }
  public function mostrarDescripcion($seleccionado){
    switch ($seleccionado) {
      case '1':
        $html="
        <h1>Opciones de perfiles de usuario.</h1>
        <h4>Este módulo le permite ver los datos de su empresa.</h4>
        <ul>
          <li><b>Ver Perfil.</b></li>
          <p>Con esta opcion usted puede ver toda la información que tiene guardada para la identificación de su empresa.</p>
        </ul>
        ";
        break;
     case '2':
        $html="
        <h1>Opciones de usuarios.</h1>
        <h4>Este módulo le permite realizar la administración de los usuarios.</h4>
        <ul>
          <li><b>Nuevo Usuario.</b></li>
          <p>Realizar el registro de nuevos empleados para su empresa.</p>
          <li><b>Administrar Usuarios.</b></li>
          <p>Actualización de la información de sus empleados.</p>
        </ul>
        ";
        break;
     case '3':
        $html="
        <h1>Opciones de rutas.</h1>
        <h4>Este modulo le permite realizar la administracion de las rutas.</h4>
        <ul>
          <li><b>Nuevo Sitio.</b></li>
          <p>Agregar nuevos sitios que puedan estar disponibles para la creación de nuevas rutas.</p>
          <li><b>Ver Rutas.</b></li>
          <p>Puede visualizar las rutas creadas.</p>
          <li><b>Crear Rutas.</b></li>
          <p>Puede realizar la actualización de rutas o en su defecto la creación de nuevas rutas.</p>
        </ul>
        ";
        break;
     case '4':
        $html="
        <h1>Opciones de monitoreo.</h1>
        <h4>Este modulo le permite realizar el seguimiento de las rutas.</h4>
        <ul>
          <li><b>Ver Incidentes.</b></li>
          <p>Todos los incidentes reportados por sus empleados los puede ver en esta sección.</p>
          <li><b>Monitorear Rutas.</b></li>
          <p>Puede ver el estado de las rutas asignadas en tiempo real.</p>
        </ul>
        ";
       break;
    case '5':
        $html="
        <h1>Opciones de reportes.</h1>
        <h4>Este modulo le permite generar diferentes reportes.</h4>
        <ul>
          <li><b>Incidentes..</b></li>
          <p>Ver las estadísticas y reportes referente a los incidentes generados.</p>
          <li><b>Rutas.</b></li>
          <p>Ver las estadísticas de cumolimiento de las rutas.</p>
          <li><b>Tiempos.</b></li>
          <p>Ver las estadísticas de tiempos usados.</p>
        </ul>
        ";
       break;
     default:
        $html="<li><a href='#'>Ninguno</a></li>";
       break;
    }
    echo ($html);
  }

}

 ?>
