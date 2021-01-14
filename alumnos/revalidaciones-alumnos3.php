<?php
  require_once "../core/modelo-usuarios.php";
  require_once "modelo-revalidaciones-alumnos.php";
  
  session_start( );
  $obj = new Usuarios( );
  $obj->id_usuario = $_SESSION["id_usuario"];
  $obj->codigo = $_SESSION["codigo"];
  $obj->contrasena = $_SESSION["contrasena"];
  $obj->validarSession( );
  
  $obj2 = new Revalidaciones_Alumnos( );
  $obj2->id_revalidacion_alumno = $_POST["id_revalidacion_alumno"];
  $obj2->id_alumno = $_POST["id_alumno"];
  $obj2->eliminarRevalidacion( );
  
  header( "Location: revalidaciones-alumnos.php?id_alumno=$obj2->id_alumno" );
  exit( );
?>