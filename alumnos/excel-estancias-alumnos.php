<?php
  header( "Content-Type: application/vnd.ms-excel" );
  header( "Content-Disposition: attachment; filename=reporte-estancias-alumnos.xls" );
  
  require_once "../core/modelo-usuarios.php";
  require_once "modelo-alumnos.php";
  require_once "modelo-estancias-alumnos.php";
  
  session_start( );
  $obj = new Usuarios( );
  $obj->id_usuario = $_SESSION["id_usuario"];
  $obj->codigo = $_SESSION["codigo"];
  $obj->contrasena = $_SESSION["contrasena"];
  $obj->validarSession( );
  
  $obj2 = new Alumnos( );
  $obj2->id_alumno = $_GET["id_alumno"];
  $obj2->obtenerAlumno( );
  
  $obj3 = new Estancias_Alumnos( );
  $obj3->id_alumno = $obj2->id_alumno;
  $obj3->listaEstanciasAlumno( );
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
      <td colspan="4">Estancias de investigaci&oacute;n de alumnos</td>
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
      <td>NOMBRE DEL PROYECTO DE INVESTIGACI&Oacute;N</td>
      <td>INSTITUCI&Oacute;N EDUCATIVA</td>
      <td>DEPARTAMENTO O FACULTAD</td>
      <td>TUTOR ACAD&Eacute;MICO EXTERNO</td>
      <td>PA&Iacute;S</td>
      <td>CIUDAD</td>
      <td>FECHA DE INICIO</td>
      <td>FECHA DE T&Eacute;RMINO</td>
      <td>APOYO FINANCIERO</td>
      <td>MONTO FINANCIERO</td>
      <td>FUENTE DE FINANCIAMIENTO</td>
      <td>RESULTADOS</td>
    </tr>
    <?php
      $max = count( $obj3->id_estancia_alumno );
      
      for( $i=0; $i<$max; $i++ )
      {
    ?>
    <tr>
      <td><?php echo $obj3->id_estancia_alumno[$i]; ?></td>
      <td><?php echo $obj3->proyecto[$i]; ?></td>
      <td><?php echo $obj3->institucion[$i]; ?></td>
      <td><?php echo $obj3->departamento[$i]; ?></td>
      <td><?php echo $obj3->tutor[$i]; ?></td>
      <td><?php echo $obj3->pais[$i]; ?></td>
      <td><?php echo $obj3->ciudad[$i]; ?></td>
      <td><?php echo $obj3->fecha_inicio[$i]; ?></td>
      <td><?php echo $obj3->fecha_termino[$i]; ?></td>
      <td><?php echo $obj3->apoyo_financiero_txt[$i]; ?></td>
      <td><?php echo $obj3->monto_financiero[$i]; ?></td>
      <td><?php echo $obj3->fuente_financiamiento[$i]; ?></td>
      <td><?php echo $obj3->resultados[$i]; ?></td>
    </tr>
    <?php
      }
    ?>
  </table>
</body>
</html>