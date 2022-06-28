﻿<?php
require_once "modelo-usuarios.php";
require_once "modelo-cuerpos-academicos.php";

session_start();
$obj = new Usuarios();
$obj->id_usuario = $_SESSION["id_usuario"];
$obj->codigo = $_SESSION["codigo"];
$obj->contrasena = $_SESSION["contrasena"];
$obj->validarSession();

$obj2 = new CuerposAcademicos();
$obj2->id_cuerpo_academico = $_GET["id_cuerpo_academico"];
$obj2->obtenerCuerpoAcademico();

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>Sistema Integral de Informaci&oacute;n de Posgrados</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
        <form id="form1" name="form1" method="post" action="edicion-cuerpos-academicos2.php" enctype="multipart/form-data">
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
              <td colspan="4">Edici&oacute;n de cuerpos acad&eacute;micos</td>
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
              <td colspan="2">Nombre &bull;</td>
            </tr>
            <tr class="textoTitulos4">
              <td colspan="2"><input type="text" name="nombre" size="50" maxlength="50" required="required" value="<?php echo $obj2->nombre; ?>" /></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="4">
                <input type="submit" name="submit" value="   Enviar   " />
                <input type="hidden" name="id_cuerpo_academico" value="<?php echo $obj2->id_cuerpo_academico; ?>" />
              </td>
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
        </form>
      </td>
    </tr>
    <tr>
      <td>
        <?php require_once "../core/footer.php"; ?>
      </td>
    </tr>
  </table>
</body>

</html>