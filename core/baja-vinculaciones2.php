<?php
  require_once "../core/modelo-usuarios.php";
  require_once "modelo-vinculaciones.php";
  
  session_start( );
  $obj = new Usuarios( );
  $obj->id_usuario = $_SESSION["id_usuario"];
  $obj->codigo = $_SESSION["codigo"];
  $obj->contrasena = $_SESSION["contrasena"];
  $obj->validarSession( );
  
  $obj2 = new Vinculaciones( );
  $obj2->id_vinculacion = $_POST["id_vinculacion"];
  $obj2->eliminarVinculacion( );
  
  header( "Location: baja-vinculaciones3.php?id_vinculacion=$obj2->id_vinculacion" );
  exit( );
?>