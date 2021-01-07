<?php
  require_once "../core/modelo-usuarios.php";
  require_once "modelo-estancias-alumnos.php";
  
  session_start( );
  $obj = new Usuarios( );
  $obj->id_usuario = $_SESSION["id_usuario"];
  $obj->codigo = $_SESSION["codigo"];
  $obj->contrasena = $_SESSION["contrasena"];
  $obj->validarSession( );
  
  $obj2 = new Estancias_Alumnos( );
  $obj2->id_estancia_alumno = $_POST["id_estancia_alumno"];
  $obj2->id_alumno = $_POST["id_alumno"];
  $obj2->eliminarEstancia( );
  
  header( "Location: estancias-alumnos.php?id_alumno=$obj2->id_alumno" );
  exit( );
?>