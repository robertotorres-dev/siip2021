<?php
  require_once "../core/modelo-usuarios.php";
  require_once "modelo-alumnos.php";
  require_once "modelo-docentes.php";
  
  session_start( );
  $obj = new Usuarios( );
  $obj->id_usuario = $_SESSION["id_usuario"];
  $obj->codigo = $_SESSION["codigo"];
  $obj->contrasena = $_SESSION["contrasena"];
  $obj->validarSession( );
  
  $obj2 = new Alumnos( );
  $obj2->id_alumno = $_GET["id_alumno"];
  $obj2->obtenerAlumno( );
  
  $obj3 = new Docentes( );
  $obj3->listaDocentes( );
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
      <form id="form1" name="form1" method="post" action="edicion-trayectorias2.php">
      <table class="tablaInterior" border="0" cellspacing="4" cellpadding="0" align="center">
        <tr>
          <td width="25%">&nbsp;</td>
          <td width="25%">&nbsp;</td>
          <td width="25%">&nbsp;</td>
          <td width="25%">&nbsp;</td>
        </tr>
        <tr class="textoTitulos1">
          <td colspan="4">M&oacute;dulo Alumnos</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr class="textoTitulos2">
          <td colspan="4">Trayectorias acad&eacute;micas</td>
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
          <td colspan="4">Nombre:</td>
        </tr>
        <tr class="textoTitulos4">
          <td colspan="4">
          <a href="consulta-alumnos.php?id_alumno=<?php echo $obj2->id_alumno; ?>" class="textoTitulos4" target="_blank">
	  <?php echo $obj2->apellido_paterno." ".$obj2->apellido_materno." ".$obj2->nombre; ?>
          </a>
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr class="textoTablas1">
          <td colspan="4">TRAYECTORIA ACAD&Eacute;MICA</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr class="textoTitulos3">
          <td colspan="4">Tema de tesis &bull;</td>
        </tr>
        <tr class="textoTitulos4">
          <td colspan="4"><input type="text" name="texto_tesis1" size="100" maxlength="300" value="<?php echo $obj2->texto_tesis1; ?>" required="required" /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr class="textoTitulos3">
          <td colspan="4">Impacto social de la tesis, soluci&oacute;n de problemas</td>
        </tr>
        <tr class="textoTitulos4">
          <td colspan="4"><textarea name="texto_tesis2" cols="100" rows="5" maxlength="300"><?php echo $obj2->texto_tesis2; ?></textarea></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr class="textoTitulos3">
          <td colspan="4">Contribuci&oacute;n para la mejora de la sociedad</td>
        </tr>
        <tr class="textoTitulos4">
          <td colspan="4"><textarea name="texto_tesis3" cols="100" rows="5" maxlength="300"><?php echo $obj2->texto_tesis3; ?></textarea></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr class="textoTitulos3">
          <td colspan="4">LGAC</td>
        </tr>
        <tr class="textoTitulos4">
          <td colspan="4"><input type="text" name="texto_tesis4" size="100" maxlength="300" value="<?php echo $obj2->texto_tesis4; ?>" /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr class="textoTitulos3">
          <td colspan="4">T&oacute;pico de seminario de tesis en el que participa</td>
        </tr>
        <tr class="textoTitulos4">
          <td colspan="4"><input type="text" name="texto_tesis5" size="100" maxlength="300" value="<?php echo $obj2->texto_tesis5; ?>" /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr class="textoTitulos3">
          <td colspan="4">Director de tesis &bull;</td>
        </tr>
        <tr class="textoTitulos4">
          <td colspan="4">
          <select name="id_tesis1" required="required">
          <option value=''></option>
          <?php
            $max = count( $obj3->id_docente );
            
            for( $i=0; $i<$max; $i++ )
            {
              if( $obj3->id_docente[$i]==$obj2->id_tesis1 )
	      {
                printf( "<option value='%d' selected='selected'>%s %s %s</option>\n", $obj3->id_docente[$i], $obj3->apellido_paterno[$i], $obj3->apellido_materno[$i], $obj3->nombre[$i] );
	      }
	      else
	      {
                printf( "<option value='%d'>%s %s %s</option>\n", $obj3->id_docente[$i], $obj3->apellido_paterno[$i], $obj3->apellido_materno[$i], $obj3->nombre[$i] );
	      }
            }
	  ?>
          </select>
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr class="textoTitulos3">
          <td colspan="4">Co-director de tesis &bull;</td>
        </tr>
        <tr class="textoTitulos4">
          <td colspan="4">
          <select name="id_tesis2" required="required">
          <option value=''></option>
          <?php
            $max = count( $obj3->id_docente );
            
            for( $i=0; $i<$max; $i++ )
            {
              if( $obj3->id_docente[$i]==$obj2->id_tesis2 )
	      {
                printf( "<option value='%d' selected='selected'>%s %s %s</option>\n", $obj3->id_docente[$i], $obj3->apellido_paterno[$i], $obj3->apellido_materno[$i], $obj3->nombre[$i] );
	      }
	      else
	      {
                printf( "<option value='%d'>%s %s %s</option>\n", $obj3->id_docente[$i], $obj3->apellido_paterno[$i], $obj3->apellido_materno[$i], $obj3->nombre[$i] );
	      }
            }
	  ?>
          </select>
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr class="textoTitulos3">
          <td colspan="4">Evaluación del trabajo de asesoría de tesis por parte del estudiante</td>
        </tr>
        <tr class="textoTitulos4">
          <td colspan="4"><textarea name="texto_tesis6" cols="100" rows="5" maxlength="300"><?php echo $obj2->texto_tesis6; ?></textarea></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr class="textoTitulos3">
          <td colspan="4">Lector de tesis interno</td>
        </tr>
        <tr class="textoTitulos4">
          <td colspan="4">
          <select name="id_tesis3">
          <option value=''></option>
          <?php
            $max = count( $obj3->id_docente );
            
            for( $i=0; $i<$max; $i++ )
            {
              if( $obj3->id_docente[$i]==$obj2->id_tesis3 )
	      {
                printf( "<option value='%d' selected='selected'>%s %s %s</option>\n", $obj3->id_docente[$i], $obj3->apellido_paterno[$i], $obj3->apellido_materno[$i], $obj3->nombre[$i] );
	      }
	      else
	      {
                printf( "<option value='%d'>%s %s %s</option>\n", $obj3->id_docente[$i], $obj3->apellido_paterno[$i], $obj3->apellido_materno[$i], $obj3->nombre[$i] );
	      }
            }
	  ?>
          </select>
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr class="textoTitulos3">
          <td colspan="4">Lector de tesis externo</td>
        </tr>
        <tr class="textoTitulos4">
          <td colspan="4"><input type="text" name="texto_tesis7" size="50" maxlength="300" value="<?php echo $obj2->texto_tesis7; ?>" /></td>
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
          <input type="hidden" name="id_alumno" value="<?php echo $obj2->id_alumno; ?>" />
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