﻿<?php
require_once "modelo-usuarios.php";
require_once "modelo-lineas-conocimiento.php";
require_once "modelo-programas.php";

session_start();
$obj = new Usuarios();
$obj->id_usuario = $_SESSION["id_usuario"];
$obj->codigo = $_SESSION["codigo"];
$obj->contrasena = $_SESSION["contrasena"];
$obj->validarSession();

$obj2 = new LineasConocimiento();
$obj2->id_linea_conocimiento = $_GET["id_linea_conocimiento"];
$obj2->obtenerLineaConocimiento();

$obj3 = new Programas();
$obj3->id_programa = $obj2->id_programa;
$obj3->obtenerPrograma();
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>Sistema Integral de Informaci&oacute;n de Posgrados</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href="../css/general.css" rel="stylesheet" type="text/css">
  <link href="../css/menu.css" rel="stylesheet" type="text/css">
  <script type="text/javascript">
    function confirmarBaja() {
      if (confirm("¿Desea eliminar el registro seleccionado?")) {
        return true;
      } else {
        return false;
      }
    }
  </script>
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
        <form id="form1" name="form1" method="post" action="baja-lineas-conocimiento2.php" onsubmit="return confirmarBaja( )">
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
              <td colspan="4">Baja de l&iacute;neas de generaci&oacute;n y aplicaci&oacute;n del conocimiento</td>
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
              <td colspan="2">Nombre:</td>
            </tr>
            <tr class="textoTitulos4">
              <td colspan="2"><?php echo $obj2->nombre; ?>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="4">
                <input type="submit" name="submit" value="   Eliminar   " />
                <input type="hidden" name="id_linea_conocimiento" value="<?php echo $obj2->id_linea_conocimiento; ?>" />
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