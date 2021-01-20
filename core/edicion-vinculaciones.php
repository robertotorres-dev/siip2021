<?php
  require_once "../core/modelo-usuarios.php";
  require_once "../core/modelo-programas.php";
  require_once "../core/modelo-estados.php";
  require_once "../core/modelo-paises.php";
  require_once "modelo-vinculaciones.php";

  session_start( );
  $obj = new Usuarios( );
  $obj->id_usuario = $_SESSION["id_usuario"];
  $obj->codigo = $_SESSION["codigo"];
  $obj->contrasena = $_SESSION["contrasena"];
  $obj->validarSession( );

  $obj2 = new Vinculaciones( );
  $obj2->id_vinculacion = $_GET["id_vinculacion"];
  $obj2->obtenerVinculacion( );
  
  $obj3 = new Programas( );
  $obj3->id_programa = $obj2->id_programa;
  $obj3->obtenerPrograma( );

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
      <form id="form1" name="form1" method="post" action="edicion-vinculaciones2.php" enctype="multipart/form-data">
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
          <td colspan="4">Edici&oacute;n de proyectos de vinculaci&oacute;n</td>
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
          <td colspan="2">Nombre del proyecto de vinculaci&oacute;n &bull;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr class="textoTitulos4">
          <td colspan="2"><input type="text" name="nombre" size="50" maxlength="50" value="<?php echo $obj2->nombre; ?>" required="required" /></td>
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
          <td colspan="2">Responsable del proyecto de vinculaci&oacute;n &bull;</td>
          <td>Fecha &bull;</td>
          <td>&nbsp;</td>
        </tr>
        <tr class="textoTitulos4">
          <td colspan="2"><input type="text" name="responsable" size="50" maxlength="50" value="<?php echo $obj2->responsable; ?>" required="required" /></td>
          <td><input type="date" name="fecha" placeholder="aaaa-mm-dd" required="required" value="<?php echo $obj2->fecha; ?>" style="width: 180px"></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr class="textoTitulos3">
          <td colspan="2">Instancias &bull;</td>
          <td colspan="2">Beneficios &bull;</td>
        </tr>
        <tr class="textoTitulos4">
          <td colspan="2" valign="top"><textarea name="instancias" cols="50" rows="10" required="required"><?php echo $obj2->instancias; ?></textarea></td>
          <td colspan="2" valign="top"><textarea name="beneficios" cols="50" rows="10" required="required"><?php echo $obj2->beneficios; ?></textarea></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>       
        <tr>
          <td colspan="4"><input type="submit" name="submit" value="   Enviar   " />
            <input type="hidden" name="id_vinculacion" value="<?php echo $obj2->id_vinculacion; ?>" />
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
</body>
</html>