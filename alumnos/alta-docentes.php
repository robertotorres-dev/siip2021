<?php
  require_once "../core/modelo-usuarios.php";
  require_once "../core/modelo-paises.php";
  require_once "modelo-docentes.php";
  
  session_start( );
  $obj = new Usuarios( );
  $obj->id_usuario = $_SESSION["id_usuario"];
  $obj->codigo = $_SESSION["codigo"];
  $obj->contrasena = $_SESSION["contrasena"];
  $obj->validarSession( );
  
  $obj2 = new Paises( );
  $obj2->listaPaises( );
  
  if( isset( $_GET["error"] ) ) 
  {
    $error = $_GET["error"];
    
    switch( $error )
    {
      case 1: $msg_error = "Tipo de archivo adjuntado no v&aacute;lido."; break;
      case 2: $msg_error = "El c&oacute;digo ya se encuentra registrado."; break;
    }
  }
  else
  {
    $error = 0;
  }
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Sistema Integral de Informaci&oacute;n de Posgrados</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/general.css" rel="stylesheet" type="text/css">
<link href="../css/menu.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
function verificarContrasena( )
{
  if( document.forms.form1.contrasena.value==document.forms.form1.contrasena2.value )
  {
    return true;
  }
  else
  {
    confirm( "La confirmación de contraseña es incorrecta." )
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
      <form id="form1" name="form1" method="post" action="alta-docentes2.php" enctype="multipart/form-data" onsubmit="return verificarContrasena( )">
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
          <td colspan="4">Alta de docentes</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <?php if( $error!=0 ) { ?>
        <tr>
          <td colspan="4" class="textoRojo"><?php echo $msg_error; ?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <?php } ?>
        <!-- DATOS GENERALES DE DOCENTE -->
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
          <td colspan="2">Fotograf&iacute;a (formato jpg - m&aacute;ximo 5 mb)</td>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr class="textoTitulos4">
          <td colspan="2"><input type="file" name="archivo" size="25" /></td>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr class="textoTitulos3">
          <td>Apellido paterno &bull;</td>
          <td>Apellido materno &bull;</td>
          <td>Nombre(s) &bull;</td>
          <td>Sexo &bull;</td>
        </tr>
        <tr class="textoTitulos4">
          <td><input type="text" name="apellido_paterno" size="25" maxlength="50" required="required" /></td>
          <td><input type="text" name="apellido_materno" size="25" maxlength="50" required="required" /></td>
          <td><input type="text" name="nombre" size="25" maxlength="50" required="required" /></td>
          <td>
	  <input type="radio" name="sexo" value="1" required="required" /> Masculino
          <input type="radio" name="sexo" value="2" required="required" /> Femenino
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr class="textoTitulos3">
          <td>Fecha de nacimiento &bull;</td>
          <td>Lugar de nacimiento &bull;</td>
          <td>Pa&iacute;s de nacimiento &bull;</td>
          <td>&nbsp;</td>
        </tr>
        <tr class="textoTitulos4">
          <td><input type="date" name="fecha_nacimiento" placeholder="aaaa-mm-dd" required="required" /></td>
          <td><input type="text" name="lugar_nacimiento" size="25" maxlength="50" required="required" /></td>
          <td>
          <select name="id_pais" required="required">
          <option value=''></option>
          <?php
            $max = count( $obj2->id_pais );
            
            for( $i=0; $i<$max; $i++ )
            {
              printf( "<option value='%d'>%s</option>\n", $obj2->id_pais[$i], $obj2->nombre[$i] );
            }
	  ?>
          </select>
          </td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <!-- DATOS ACADÉMICOS DE DOCENTE -->
        <tr class="textoTablas1">
          <td colspan="4">DATOS ACAD&Eacute;MICOS</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr class="textoTitulos3">
          <td>Modalidad &bull;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr class="textoTitulos4">
          <td><input type="radio" name="modalidad" value="1" required="required" /> Tiempo Completo</td>
          <td><input type="radio" name="modalidad" value="2" required="required" /> Tiempo Parcial</td>
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
          <td colspan="2">Instituci&oacute;n en donde obtuvo el &uacute;ltimo grado de estudios &bull;</td>
          <td>&Uacute;ltimo grado de estudios &bull;</td>
          <td>Fecha de obtenci&oacute;n del &uacute;ltimo grado </td>
        </tr>
        <tr class="textoTitulos4">
          <td colspan="2"><input type="text" name="institucion" size="50" maxlength="50" required="required" /></td>
          <td>
          <select name="escolaridad" required="required">
            <option value=''></option>
            <option value='1'>Licenciatura</option>
            <option value='2'>Especialidad</option>
            <option value='3'>Maestr&iacute;a</option>
            <option value='4'>Doctorado</option>
            <option value='5'>Postdoctorado</option>
          </select>
          </td>
          <td><input type="date" name="fecha_titulacion" placeholder="aaaa-mm-dd" /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>

        <tr class="textoTitulos3">
          <td>N&uacute;mero de CVU </td>
          <td>Miembre del S.N.I. </td>
          <td>Nivel del S.N.I.</td>
          <td>Perfil PRODEP </td>
        </tr>
        <tr class="textoTitulos4">
          <td><input type="text" name="numero_cvu" size="25" maxlength="50" /></td>
          <td>
            <input type="radio" name="miembro_sni" value="1" required="required" /> Si &nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name="miembro_sni" value="2" required="required" /> No
          </td>
          <td>
          <select name="nivel_sni" >
            <option value=''></option>
            <option value='1'>Candidato</option>
            <option value='2'>Nivel I</option>
            <option value='3'>Nivel II</option>
            <option value='4'>Nivel III</option>
            <option value='5'>Em&eacute;rito</option>
          </select>
          </td>
          <td>
            <input type="radio" name="perfil_prodep" value="1" required="required" /> Si &nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name="perfil_prodep" value="2" required="required" /> No
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>

        <tr class="textoTitulos3">
          <td colspan="2">Cuerpo acad&eacute;mico al que pertenece </td>
          <td colspan="2">L&iacute;nea de Generaci&oacute;n y Aplicaci&oacute;n del Conocimiento (LGAC) </td>
        </tr>
        <tr class="textoTitulos4">
          <td colspan="2">
          <select name="cuerpo_academico" style="width: 400px">
            <option value=''></option>
            <option value='1'>UDG-CA-435 Desarrollo tecnológico e internacionalización de la pequeña y mediana empresa</option>
            <option value='2'>UDG-CA-484 Estrategias, Competitividad, Gestión del Conocimiento y Sustentabilidad</option>
            <option value='3'>UDG-CA-485 Estudios Urbanos y Territoriales</option>
            <option value='4'>UDG-CA-486 Análisis político y gestión de las organizaciones</option>
            <option value='5'>UDG-CA-502 Relaciones Económicas Internacionales de México</option>
            <option value='6'>UDG-CA-508 Investigación educativa y estudios sobre la universidad</option>
            <option value='7'>UDG-CA-667 Organizaciones, estrategias, servicios y gestión del conocimiento para el desarrollo, innovación y competitividad</option>
            <option value='8'>UDG-CA-826 Temas de economía internacional, finanzas y desarrollo</option>
            <option value='9'>UDG-CA-487 Procesos de internalización, Desarrollo  y Medio Ambiente</option>
            <option value='10'>UDG-CA-142 Desarrollo sustentable y estudios sectoriales</option>
            <option value='11'>UDG-CA-125 Tecnologías de la información y de la comunicación</option>
            <option value='12'>UDG-CA-124 Calidad e Innovación de la Educación Superior</option>
            <option value='13'>UDG-CA-394 Sociedad del Conocimiento e Internacionalización</option>
            <option value='14'>UDG-CA-459 Población, sustentabilidad y desarrollo regional</option>
            <option value='15'>UDG-CA-503 Estudios sobre las PYME's</option>
            <option value='16'>UDG-CA-525 Sujetos y Procesos en las Organizaciones</option>
            <option value='17'>UDG-CA-668 Sistema Alimentario y Gestión del Conocimiento</option>
            <option value='18'>UDG-CA-825 Tratados económicos nacionales y desarrollo regional</option>
            <option value='19'>UDG-CA-865 Estudios globales: enfoques y nuevas aproximaciones</option>
            <option value='20'>UDG-CA-932 Estudios fiscales, tic´s y educación</option>
            <option value='21'>UDG-CA-429 Estudios de género , población y desarrollo humano</option>
            <option value='22'>UDG-CA-127 Sector Público: Gestión, Financiamiento y evaluación</option>
            <option value='23'>UDG-118- Mercados de trabajo y desarrollo territorial</option>
            <option value='24'>UDG-CA-123 Negocios</option>
            <option value='25'>UDG-CA-430 Dinámica económica regional y mercados en el entorno global</option>
            <option value='26'>UDG-CA-483 Contaduría, finanzas y empresas competitivas y sustentables</option>
            <option value='27'>UDG-CA-535 Estudios Tributarios y Auditoría</option>
            <option value='28'>UDG-CA-614 Modelado y simulación de sistemas</option>
            <option value='29'>UDG-CA-648 Economía y gestión de la educación superior</option>
            <option value='30'>UDG-CA-669 Liderazgo y habilidades directivas en la gestión de empresas</option>
            <option value='31'>UDG-CA-670 Métodos de optimización para la toma de decisiones</option>
            <option value='32'>UDG-CA-722 Sistemas y gestión de la información</option>
            <option value='33'>UDG-CA-745 Paradigmas de la educación, regulación de mercados laborales y su simbiosis con turismo y sustentabilidad</option>
            <option value='34'>UDG-CA-747 Tributación, Sustentabilidad Ambiental y Empresa Socialmente Responsable</option>
            <option value='35'>UDG-CA-753 Métodos  Estadísticos y de Simulación Aplicados para Empresas y Mercados</option>
            <option value='36'>UDG-CA-757 Universidad, industria y empresa en el occidente de México</option>
            <option value='37'>UDG-CA-791 Gestión financiera de organizaciones de la economía social y solidaria</option>
            <option value='38'>UDG-CA-824 Movilidad y procesos interculturales</option>
            <option value='39'>UDG-CA-828 Administración financiera e innovación educativa</option>
            <option value='40'>UDG-CA-830 Turismo, recreación, cultura y gastronomía</option>
            <option value='41'>UDG-CA-831 FORMAS DE GOBERNANZA Y POLITICAS PUBLICAS ( Políticas Públicas para la Seguridad Humana)</option>
            <option value='42'>UDG-CA-860 Riesgos financieros contables y auditoria</option>
            <option value='43'>UDG-CA-866 Determinantes y restricciones al desarrollo y crecimiento económicos</option>
            <option value='44'>UDG-CA-867 Integración y Competencia Económica, Crecimiento Urbano-Regional y Ordenamiento del Territorio</option>
            <option value='45'>UDG-868-CA Articulación productiva y estrategia organizacional</option>
            <option value='46'>UDG-CA-143 Mercadotecnia, Internacionalización  y  competitividad</option>
            <option value='47'>UDG-CA-617 Psicología organizacional y salud</option>
            <option value='48'>UDG-CA-746 Estudios regionales, sustentabilidad y calidad de vida</option>
            <option value='49'>UDG-CA-829 Políticas Públicas para le calidad Educativa</option>
            <option value='50'>UDG-CA-930 Contabilidad financiera fiscal</option>
            <option value='51'>UDG-CA-116 Teoría Económica y Desarrollo Sustentable</option>
            <option value='52'>UDG-CA-823 Comunicación y procesos de gestión organizacional</option>
            <option value='53'>UDG-CA-934 Políticas públicas y Bienestar</option>
            <option value='54'>UDG-CA-827  Estudios culturales sobre los pueblos originarios</option>
            <option value='55'>UDG-CA-556 Economía Global y Regional</option>
            <option value='56'>UDG-CA-649 E-World y Gestión del Conocimiento</option>
            <option value='57'>UDG-CA-666 Gestión, innovación e investigación educativa</option>
            <option value='58'>UDG-CA-931 Educación, tecnologías e innovación</option>
            <option value='59'>UDG-CA-933 Políticas Educativas e Inclusión en la era digital</option>
          </select>
          </td>
          <td colspan="2"><input type="text" name="lgac" size="50" maxlength="50" /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>

        <tr class="textoTitulos3">
          <td colspan="4">Nombre de los proyectos de investigaci&oacute;n que desarrolla </td>
        </tr>
        <tr class="textoTitulos4">
          <td colspan="4" valign="top"><textarea name="proyectos" cols="102" rows="10" required="required"></textarea></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>

        <!-- DATOS DE INGRESO DE SESIÓN DE DOCENTE -->
        <tr class="textoTablas1">
          <td colspan="4">DATOS DE INGRESO</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr class="textoTitulos3">
          <td>C&oacute;digo &bull;</td>
          <td>Contraseña &bull;</td>
          <td>Confirmaci&oacute;n de contraseña &bull;</td>
          <td>&nbsp;</td>
        </tr>
        <tr class="textoTitulos4">
          <td><input type="text" name="codigo" size="25" maxlength="50" required="required" /></td>
          <td><input type="password" name="contrasena" size="25" maxlength="50" required="required" /></td>
          <td><input type="password" name="contrasena2" size="25" maxlength="50" required="required" /></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="4"><input type="submit" name="submit" value="   Enviar   " /></td>
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