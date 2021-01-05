<?php
  header( "Content-Type: application/vnd.ms-excel" );
  header( "Content-Disposition: attachment; filename=reporte-informes.xls" );
  
  require_once "../core/modelo-usuarios.php";
  require_once "modelo-alumnos.php";
  require_once "modelo-cvu-alumnos.php";
  
  session_start( );
  $obj = new Usuarios( );
  $obj->id_usuario = $_SESSION["id_usuario"];
  $obj->codigo = $_SESSION["codigo"];
  $obj->contrasena = $_SESSION["contrasena"];
  $obj->validarSession( );
  
  $obj2 = new Alumnos( );
  $obj2->id_alumno = $_GET["id_alumno"];
  $obj2->obtenerAlumno( );
  
  $obj3 = new CVU_Alumnos( );
  $obj3->id_alumno = $obj2->id_alumno;
  $obj3->listaCVUAlumno3( );
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Sistema Integral de Informaci&oacute;n de Posgrados</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<table>
  <tr>
    <td colspan="4">M&oacute;dulo Alumnos</td>
  </tr>
  <tr>
    <td colspan="4">Informes</td>
  </tr>
  <tr>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4">Nombre:</td>
  </tr>
  <tr>
    <td colspan="4"><?php echo $obj2->apellido_paterno." ".$obj2->apellido_materno." ".$obj2->nombre; ?></td>
  </tr>
  <tr>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td>ID</td>
    <td>FECHA</td>
    <td>LUGAR</td>
    <td>ACTIVIDADES REALIZADAS</td>
    <td>RESULTADOS OBTENIDOS</td>
  </tr>
  <?php
    $max = count( $obj3->id_cvu_alumno );
    
    for( $i=0; $i<$max; $i++ )
    {
  ?>
  <tr>
    <td><?php echo $obj3->id_cvu_alumno[$i]; ?></td>
    <td><?php echo $obj3->fecha[$i]; ?></td>
    <td><?php echo $obj3->texto1[$i]; ?></td>
    <td><?php echo $obj3->texto2[$i]; ?></td>
    <td><?php echo $obj3->texto3[$i]; ?></td>
  </tr>
  <?php
    }
  ?>
</table>
</body>
</html>