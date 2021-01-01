<?php
  require_once "../core/modelo-usuarios.php";
  require_once "modelo-eventos-docentes.php";
  
  session_start( );
  $obj = new Usuarios( );
  $obj->id_usuario = $_SESSION["id_usuario"];
  $obj->codigo = $_SESSION["codigo"];
  $obj->contrasena = $_SESSION["contrasena"];
  $obj->validarSession( );
  
  $obj2 = new Eventos_Docentes( );
  $obj2->id_docente = $_POST["id_docente"];
  $obj2->id_evento_docente = $_POST["id_evento_docente"];
  $obj2->eliminarEvento( );
  
  header( "Location: eventos-docentes.php?id_docente=$obj2->id_docente" );
  exit( );
?>