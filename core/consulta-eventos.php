<?php
require_once "../core/modelo-usuarios.php";
require_once "../core/modelo-programas.php";
require_once "modelo-eventos.php";

session_start();
$obj = new Usuarios();
$obj->id_usuario = $_SESSION["id_usuario"];
$obj->codigo = $_SESSION["codigo"];
$obj->contrasena = $_SESSION["contrasena"];
$obj->validarSession();

$obj2 = new Eventos();
$obj2->id_evento = $_GET["id_evento"];
$obj2->obtenerEvento();

$obj3 = new Programas();
$obj3->id_programa = $obj2->id_programa;
$obj3->obtenerPrograma();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistema Integral de Informaci&oacute;n de Posgrados</title>
  <link href="../css/general.css" rel="stylesheet" type="text/css">
  <link href="../css/menu.css" rel="stylesheet" type="text/css">
</head>

<body>
  <table class="tablaExterior" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr>
      <td>
        <?php require_once "../core/header.php"; ?>
      </td>
    </tr>
    <tr>
      <td>
        <?php require_once "../core/menu.php"; ?>
      </td>
    </tr>
    <tr height="100%" valign="top">
      <td>
        <table class="tablaInterior" border="0" cellspacing="4" cellpadding="0" align="center">
          <tr>
            <td width="25%">&nbsp;</td>
            <td width="25%">&nbsp;</td>
            <td width="25%">&nbsp;</td>
            <td width="25%">&nbsp;</td>
          </tr>
          <tr class="textoTitulos1">
            <td colspan="4">M&oacute;dulo Configuraci&oacute;n</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr class="textoTitulos2">
            <td colspan="4">Consulta de eventos acad&eacute;micos organizados o en donde participa el programa</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr class="textoTablas1">
            <td colspan="4">DATOS GENERALES</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr class="textoTitulos3">
            <td colspan="4">Programa:</td>
          </tr>
          <tr class="textoTitulos4">
            <td colspan="4"><?php echo $obj3->nombre; ?>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr class="textoTitulos3">
            <td colspan="2">Nombre del evento &bull;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr class="textoTitulos4">
            <td colspan="2"><?php echo $obj2->nombre; ?>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr class="textoTitulos3">
            <td>Tipo de evento &bull;</td>
            <td>Lugar &bull;</td>
            <td>Fecha de inicio &bull;</td>
            <td>Fecha de t&eacute;rmino &bull;</td>
          </tr>
          <tr class="textoTitulos4">
            <td><?php echo $obj2->tipo_evento; ?></td>
            <td><?php echo $obj2->lugar; ?></td>
            <td><?php echo $obj2->fecha_inicio; ?></td>
            <td><?php echo $obj2->fecha_termino; ?></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr class="textoTitulos3">
            <td colspan="2">Tipo de participaci&oacute;n del profesor </td>
            <td colspan="2">Tipo de participaci&oacute;n de las dependencias </td>
          </tr>
          <tr class="textoTitulos4">
            <td colspan="2" valign="top"><?php echo $obj2->tipo_profesores; ?></td>
            <td colspan="2" valign="top"><?php echo $obj2->tipo_dependencias; ?></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr class="textoTitulos3">
            <td colspan="2">Profesores invitados </td>
            <td colspan="2">Dependencias involucradas </td>
          </tr>
          <tr class="textoTitulos4">
            <td colspan="2" valign="top"><?php echo nl2br($obj2->profesores); ?></td>
            <td colspan="2" valign="top"><?php echo nl2br($obj2->dependencias); ?></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td>
        <?php require_once "../core/footer.php"; ?>
      </td>
    </tr>
</body>

</html>