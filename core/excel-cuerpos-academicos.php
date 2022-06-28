<?php
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=reporte-cuerpos-academicos.xls");

require_once "../core/modelo-usuarios.php";
require_once "modelo-cuerpos-academicos.php";

session_start();
$obj = new Usuarios();
$obj->id_usuario = $_SESSION["id_usuario"];
$obj->codigo = $_SESSION["codigo"];
$obj->contrasena = $_SESSION["contrasena"];
$obj->validarSession();

$obj2 = new CuerposAcademicos();
$obj2->listaCuerposAcademicos();
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
      <td colspan="4">Administraci&oacute;n de cuerpos acad&eacute;micos</td>
    </tr>
    <tr>
      <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
      <td>ID</td>
      <td>NOMBRE</td>
    </tr>
    <?php
    $max = count($obj2->id_cuerpo_academico);

    for ($i = 0; $i < $max; $i++) {
    ?>
      <tr>
        <td><?php echo $obj2->id_cuerpo_academico[$i]; ?></td>
        <td><?php echo $obj2->nombre[$i]; ?></td>
      </tr>
    <?php
    }
    ?>
  </table>
</body>

</html>