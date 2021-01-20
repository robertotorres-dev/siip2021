<?php
  header( "Content-Type: application/vnd.ms-excel" );
  header( "Content-Disposition: attachment; filename=reporte-vinculaciones.xls" );
  
  require_once "../core/modelo-usuarios.php";
  require_once "../core/modelo-programas.php";
  require_once "modelo-vinculaciones.php";
  
  session_start( );
  $obj = new Usuarios( );
  $obj->id_usuario = $_SESSION["id_usuario"];
  $obj->codigo = $_SESSION["codigo"];
  $obj->contrasena = $_SESSION["contrasena"];
  $obj->validarSession( );
  
  $obj2 = new Programas( );
  $obj2->id_programa = $_SESSION["id_programa"];
  $obj2->obtenerPrograma( );
  
  $obj3 = new Vinculaciones( );
  $obj3->id_programa = $obj2->id_programa;
  $obj3->listaVinculacionesPrograma( );
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
    <td colspan="4">M&oacute;dulo Configuraci&oacute;n</td>
  </tr>
  <tr>
    <td colspan="4">Administraci&oacute;n de proyectos de vinculaci&oacute;n</td>
  </tr>
  <tr>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4">Programa:</td>
  </tr>
  <tr>
    <td colspan="4"><?php echo $obj2->nombre; ?></td>
  </tr>
  <tr>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td>ID</td>
    <td>PROYECTO VINCULACI&Oacute;N</td>
    <td>RESPONSABLE</td>
    <td>INSTANCIAS</td>
    <td>BENEFICIOS</td>
    <td>FECHA</td>
  </tr>
  <?php
    $max = count( $obj3->id_vinculacion );
          
    for( $i=0; $i<$max; $i++ )
    {
  ?>
  <tr>
    <td><?php echo $obj3->id_vinculacion[$i]; ?></td>
    <td><?php echo $obj3->nombre[$i]; ?></td>
    <td><?php echo $obj3->responsable[$i]; ?></td>
    <td><?php echo $obj3->instancias[$i]; ?></td>
    <td><?php echo $obj3->beneficios[$i]; ?></td>
    <td><?php echo $obj3->fecha[$i]; ?></td>
  </tr>
  <?php
    }
  ?>
</table>
</body>
</html>