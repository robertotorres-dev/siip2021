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
  $obj2->id_programa = $_SESSION["id_programa"];
  $obj2->nombre = $_POST["nombre"];
  $obj2->responsable = $_POST["responsable"];
  $obj2->instancias = $_POST["instancias"];
  $obj2->beneficios = $_POST["beneficios"];
  $obj2->fecha = $_POST["fecha"];
  $obj2->status = 1;
  $obj2->agregarVinculacion( );
  
  header( "Location: alta-vinculaciones3.php?id_vinculacion=$obj2->id_vinculacion" );
  exit( );
?>