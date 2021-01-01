<?php
  require_once "../core/modelo-usuarios.php";
  require_once "modelo-alumnos.php";
  
  session_start( );
  $obj = new Usuarios( );
  $obj->id_usuario = $_SESSION["id_usuario"];
  $obj->codigo = $_SESSION["codigo"];
  $obj->contrasena = $_SESSION["contrasena"];
  $obj->validarSession( );
  
  $obj2 = new Alumnos( );
  $obj2->id_alumno = $_POST["id_alumno"];
  $obj2->id_tesis1 = $_POST["id_tesis1"];
  $obj2->id_tesis2 = $_POST["id_tesis2"];
  $obj2->id_tesis3 = $_POST["id_tesis3"];
  $obj2->texto_tesis1 = $_POST["texto_tesis1"];
  $obj2->texto_tesis2 = $_POST["texto_tesis2"];
  $obj2->texto_tesis3 = $_POST["texto_tesis3"];
  $obj2->texto_tesis4 = $_POST["texto_tesis4"];
  $obj2->texto_tesis5 = $_POST["texto_tesis5"];
  $obj2->texto_tesis6 = $_POST["texto_tesis6"];
  $obj2->texto_tesis7 = $_POST["texto_tesis7"];
  $obj2->modificarAlumno2( );
  
  header( "Location: edicion-trayectorias3.php?id_alumno=$obj2->id_alumno" );
  exit( );
?>