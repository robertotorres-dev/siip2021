<?php
require_once "modelo-usuarios.php";
require_once "modelo-programas.php";
require_once "modelo-eventos.php";

session_start();
$obj = new Usuarios();
$obj->id_usuario = $_SESSION["id_usuario"];
$obj->codigo = $_SESSION["codigo"];
$obj->contrasena = $_SESSION["contrasena"];
$obj->validarSession();

$obj2 = new Programas();
$obj2->id_programa = $_SESSION["id_programa"];
$obj2->obtenerPrograma();

$obj3 = new Eventos();
$obj3->id_programa = $obj2->id_programa;
$obj3->listaEventosPrograma();
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>Sistema Integral de Informaci&oacute;n de Posgrados</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href="../css/general.css" rel="stylesheet" type="text/css">
  <link href="../css/menu.css" rel="stylesheet" type="text/css">
  <script type="text/javascript">
    function MM_jumpMenu(targ, selObj, restore) { //v3.0
      eval(targ + ".location='" + selObj.options[selObj.selectedIndex].value + "'");
      if (restore) selObj.selectedIndex = 0;
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
        <table class="tablaInterior" border="0" cellspacing="4" cellpadding="0" align="center">
          <tr>
            <td width="10%">&nbsp;</td>
            <td width="40%">&nbsp;</td>
            <td width="40%">&nbsp;</td>
            <td width="10%">&nbsp;</td>
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
            <td colspan="4">Administraci&oacute;n de eventos acad&eacute;micos organizados o en donde participa el programa</td>
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
            <td colspan="3"><?php echo $obj2->nombre; ?>&nbsp;</td>
            <td align="center"><input type="button" onclick="location.href='alta-eventos.php'" value="   Nuevo   " /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr class="textoTablas1">
            <td>ID</td>
            <td>EVENTO</td>
            <td>LUGAR</td>
            <td>ACCIONES</td>
          </tr>
          <?php

          if ($obj3->id_evento) {
            $max = count($obj3->id_evento);
            for ($i = 0; $i < $max; $i++) {
          ?>
              <tr class="textoTablas2">
                <td><?php echo $obj3->id_evento[$i]; ?>&nbsp;</td>
                <td><?php echo $obj3->nombre[$i]; ?>&nbsp;</td>
                <td><?php echo $obj3->lugar[$i]; ?>&nbsp;</td>
                <td align="center">
                  <a href="consulta-eventos.php?id_evento=<?php echo $obj3->id_evento[$i]; ?>">
                    <img src="../images/icon-search.png" width="16" height="16" /></a>
                  <a href="edicion-eventos.php?id_evento=<?php echo $obj3->id_evento[$i]; ?>">
                    <img src="../images/icon-edit.png" width="16" height="16" /></a>
                  <a href="baja-eventos.php?id_evento=<?php echo $obj3->id_evento[$i]; ?>">
                    <img src="../images/icon-delete.png" width="16" height="16" /></a>
                </td>
              </tr>
          <?php
            }
          }
          ?>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr class="textoTitulos4">
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td align="center"><input type="button" onclick="location.href='excel-eventos.php'" value=" Exportar Excel " /></td>
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
  </table>
</body>

</html>