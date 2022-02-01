<?php
  require_once "../core/modelo-usuarios.php";
  require_once "modelo-eventos.php";
  
  session_start( );
  $obj = new Usuarios( );
  $obj->id_usuario = $_SESSION["id_usuario"];
  $obj->codigo = $_SESSION["codigo"];
  $obj->contrasena = $_SESSION["contrasena"];
  $obj->validarSession( );
  
  $obj2 = new Eventos( );
  $obj2->id_evento = $_POST["id_evento"];
  $obj2->eliminarEvento( );
  
  header( "Location: baja-eventos3.php?id_evento=$obj2->id_evento" );
  exit( );
