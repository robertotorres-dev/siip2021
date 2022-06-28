<?php
  require_once "modelo-usuarios.php";
  require_once "modelo-cuerpos-academicos.php";
  
  session_start( );
  $obj = new Usuarios( );
  $obj->id_usuario = $_SESSION["id_usuario"];
  $obj->codigo = $_SESSION["codigo"];
  $obj->contrasena = $_SESSION["contrasena"];
  $obj->validarSession( );
  
  $obj2 = new CuerposAcademicos( );
  $obj2->id_cuerpo_academico = $_POST["id_cuerpo_academico"];
  $obj2->eliminarCuerpoAcademico( );
  
  header( "Location: baja-cuerpos-academicos3.php?id_cuerpo_academico=$obj2->id_cuerpo_academico" );
  exit( );
?>