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
  $obj2->id_pais = $_POST["id_pais"];
  $obj2->ciudad = $_POST["ciudad"];
  $obj2->institucion = $_POST["institucion"];
  $obj2->departamento = $_POST["departamento"];
  $obj2->tutor = $_POST["tutor"];
  $obj2->asignaturas = $_POST["asignaturas"];
  $obj2->fecha_inicio = $_POST["fecha_inicio"];
  $obj2->fecha_termino = $_POST["fecha_termino"];
  $obj2->apoyo_financiero = $_POST["apoyo_financiero"];
  $obj2->monto_financiero = $_POST["monto_financiero"];
  $obj2->fuente_financiamiento = $_POST["fuente_financiamiento"];
  $obj2->revalidacion = $_POST["revalidacion"];
  $obj2->status = 1;
  
  if( $obj2->id_revalidacion_alumno==null )
  {
    $obj2->agregarRevalidacion( );
  }
  else
  {
    $obj2->modificarRevalidacion( );
  }
  
  header( "Location: revalidaciones-alumnos.php?id_alumno=$obj2->id_alumno" );
  exit( );
?>