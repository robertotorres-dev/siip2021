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
  
  $obj2 = new Docentes( );
  $obj2->id_docente = $_GET["id_docente"];
  $obj2->obtenerDocente( );
  
  $obj3 = new Paises( );
  $obj3->listaPaises( );
  
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
      <form id="form1" name="form1" method="post" action="edicion-docentes2.php" enctype="multipart/form-data" onsubmit="return verificarContrasena( )">
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
          <td colspan="4">Edici&oacute;n de docentes</td>
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
        <tr class="textoTitulos4">
          <td colspan="4">
          <?php
            if( $obj2->fotografia!=null )
            {
              printf( "<a href='../uploads/%s' target='_blank'><img src='../uploads/%s' height='100' /></a>", $obj2->fotografia, $obj2->fotografia );
            }
          ?>
          </td>
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
          <td>
          <input type="text" name="apellido_paterno" size="25" maxlength="50" required="required" value="<?php echo $obj2->apellido_paterno; ?>" />
          </td>
          <td>
          <input type="text" name="apellido_materno" size="25" maxlength="50" required="required" value="<?php echo $obj2->apellido_materno; ?>" />
          </td>
          <td>
          <input type="text" name="nombre" size="25" maxlength="50" required="required" value="<?php echo $obj2->nombre; ?>" /></td>
          <td>
	        <input type="radio" name="sexo" value="1" required="required" <?php if( $obj2->sexo==1 ) { echo "checked='checked'"; } ?> /> Masculino
          <input type="radio" name="sexo" value="2" required="required" <?php if( $obj2->sexo==2 ) { echo "checked='checked'"; } ?> /> Femenino
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
          <td>
          <input type="date" name="fecha_nacimiento" placeholder="aaaa-mm-dd" required="required" value="<?php echo $obj2->fecha_nacimiento; ?>" />
          </td>
          <td>
          <input type="text" name="lugar_nacimiento" size="25" maxlength="50" required="required" value="<?php echo $obj2->lugar_nacimiento; ?>" />
          </td>
          <td>
          <select name="id_pais" required="required">
          <option value=''></option>
          <?php
            $max = count( $obj3->id_pais );
            
            for( $i=0; $i<$max; $i++ )
            {
              if( $obj3->id_pais[$i]==$obj2->id_pais )
              {
                      printf( "<option value='%d' selected='selected'>%s</option>\n", $obj3->id_pais[$i], $obj3->nombre[$i] );
              }
              else
              {
                      printf( "<option value='%d'>%s</option>\n", $obj3->id_pais[$i], $obj3->nombre[$i] );
              }
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
          <td><input type="radio" name="modalidad" value="1" required="required" <?php if( $obj2->modalidad==1 ) { echo "checked='checked'"; } ?> /> Tiempo Completo</td>
          <td><input type="radio" name="modalidad" value="2" required="required" <?php if( $obj2->modalidad==2 ) { echo "checked='checked'"; } ?> /> Tiempo Parcial</td>
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
          <td colspan="2"><input type="text" name="institucion" size="50" maxlength="50" required="required" value="<?php echo $obj2->institucion; ?>" /></td>
          <td>
          <select name="escolaridad" required="required">
            <option value=''></option>
            <option value='1' <?php if( $obj2->escolaridad==1 ) { echo "selected='selected'"; } ?>>Licenciatura</option>
            <option value='2' <?php if( $obj2->escolaridad==2 ) { echo "selected='selected'"; } ?>>Especialidad</option>
            <option value='3' <?php if( $obj2->escolaridad==3 ) { echo "selected='selected'"; } ?>>Maestr&iacute;a</option>
            <option value='4' <?php if( $obj2->escolaridad==4 ) { echo "selected='selected'"; } ?>>Doctorado</option>
            <option value='5' <?php if( $obj2->escolaridad==5 ) { echo "selected='selected'"; } ?>>Postdoctorado</option>
          </select>
          </td>
          <td><input type="date" name="fecha_titulacion" placeholder="aaaa-mm-dd" value="<?php echo $obj2->fecha_titulacion; ?>" /></td>
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
          <td><input type="text" name="numero_cvu" size="25" maxlength="50" value="<?php echo $obj2->numero_cvu; ?>" /></td>
          <td>
            <input type="radio" name="miembro_sni" value="1" required="required" <?php if( $obj2->miembro_sni==1 ) { echo "checked='checked'"; } ?> /> Si &nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name="miembro_sni" value="2" required="required" <?php if( $obj2->miembro_sni==2 ) { echo "checked='checked'"; } ?> /> No
          </td>
          <td>
          <select name="nivel_sni" >
            <option value=''></option>
            <option value='1' <?php if( $obj2->nivel_sni==1 ) { echo "selected='selected'"; } ?>>Candidato</option>
            <option value='2' <?php if( $obj2->nivel_sni==2 ) { echo "selected='selected'"; } ?>>Nivel I</option>
            <option value='3' <?php if( $obj2->nivel_sni==3 ) { echo "selected='selected'"; } ?>>Nivel II</option>
            <option value='4' <?php if( $obj2->nivel_sni==4 ) { echo "selected='selected'"; } ?>>Nivel III</option>
            <option value='5' <?php if( $obj2->nivel_sni==5 ) { echo "selected='selected'"; } ?>>Em&eacute;rito</option>
          </select>
          </td>
          <td>
            <input type="radio" name="perfil_prodep" value="1" required="required" <?php if( $obj2->perfil_prodep==1 ) { echo "checked='checked'"; } ?> /> Si &nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name="perfil_prodep" value="2" required="required" <?php if( $obj2->perfil_prodep==2 ) { echo "checked='checked'"; } ?> /> No
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
            <option value='1' <?php if( $obj2->cuerpo_academico==1 ) { echo "selected='selected'"; } ?>>UDG-CA-435 Desarrollo tecnológico e internacionalización de la pequeña y mediana empresa</option>
            <option value='2' <?php if( $obj2->cuerpo_academico==2 ) { echo "selected='selected'"; } ?>>UDG-CA-484 Estrategias, Competitividad, Gestión del Conocimiento y Sustentabilidad</option>
            <option value='3' <?php if( $obj2->cuerpo_academico==3 ) { echo "selected='selected'"; } ?>>UDG-CA-485 Estudios Urbanos y Territoriales</option>
            <option value='4' <?php if( $obj2->cuerpo_academico==4 ) { echo "selected='selected'"; } ?>>UDG-CA-486 Análisis político y gestión de las organizaciones</option>
            <option value='5' <?php if( $obj2->cuerpo_academico==5 ) { echo "selected='selected'"; } ?>>UDG-CA-502 Relaciones Económicas Internacionales de México</option>
            <option value='6' <?php if( $obj2->cuerpo_academico==6 ) { echo "selected='selected'"; } ?>>UDG-CA-508 Investigación educativa y estudios sobre la universidad</option>
            <option value='7' <?php if( $obj2->cuerpo_academico==7 ) { echo "selected='selected'"; } ?>>UDG-CA-667 Organizaciones, estrategias, servicios y gestión del conocimiento para el desarrollo, innovación y competitividad</option>
            <option value='8' <?php if( $obj2->cuerpo_academico==8 ) { echo "selected='selected'"; } ?>>UDG-CA-826 Temas de economía internacional, finanzas y desarrollo</option>
            <option value='9' <?php if( $obj2->cuerpo_academico==9 ) { echo "selected='selected'"; } ?>>UDG-CA-487 Procesos de internalización, Desarrollo  y Medio Ambiente</option>
            <option value='10' <?php if( $obj2->cuerpo_academico==10 ) { echo "selected='selected'"; } ?>>UDG-CA-142 Desarrollo sustentable y estudios sectoriales</option>
            <option value='11' <?php if( $obj2->cuerpo_academico==11 ) { echo "selected='selected'"; } ?>>UDG-CA-125 Tecnologías de la información y de la comunicación</option>
            <option value='12' <?php if( $obj2->cuerpo_academico==12 ) { echo "selected='selected'"; } ?>>UDG-CA-124 Calidad e Innovación de la Educación Superior</option>
            <option value='13' <?php if( $obj2->cuerpo_academico==13 ) { echo "selected='selected'"; } ?>>UDG-CA-394 Sociedad del Conocimiento e Internacionalización</option>
            <option value='14' <?php if( $obj2->cuerpo_academico==14 ) { echo "selected='selected'"; } ?>>UDG-CA-459 Población, sustentabilidad y desarrollo regional</option>
            <option value='15' <?php if( $obj2->cuerpo_academico==15 ) { echo "selected='selected'"; } ?>>UDG-CA-503 Estudios sobre las PYME's</option>
            <option value='16' <?php if( $obj2->cuerpo_academico==16 ) { echo "selected='selected'"; } ?>>UDG-CA-525 Sujetos y Procesos en las Organizaciones</option>
            <option value='17' <?php if( $obj2->cuerpo_academico==17 ) { echo "selected='selected'"; } ?>>UDG-CA-668 Sistema Alimentario y Gestión del Conocimiento</option>
            <option value='18' <?php if( $obj2->cuerpo_academico==18 ) { echo "selected='selected'"; } ?>>UDG-CA-825 Tratados económicos nacionales y desarrollo regional</option>
            <option value='19' <?php if( $obj2->cuerpo_academico==19 ) { echo "selected='selected'"; } ?>>UDG-CA-865 Estudios globales: enfoques y nuevas aproximaciones</option>
            <option value='20' <?php if( $obj2->cuerpo_academico==20 ) { echo "selected='selected'"; } ?>>UDG-CA-932 Estudios fiscales, tic´s y educación</option>
            <option value='21' <?php if( $obj2->cuerpo_academico==21 ) { echo "selected='selected'"; } ?>>UDG-CA-429 Estudios de género , población y desarrollo humano</option>
            <option value='22' <?php if( $obj2->cuerpo_academico==22 ) { echo "selected='selected'"; } ?>>UDG-CA-127 Sector Público: Gestión, Financiamiento y evaluación</option>
            <option value='23' <?php if( $obj2->cuerpo_academico==23 ) { echo "selected='selected'"; } ?>>UDG-118- Mercados de trabajo y desarrollo territorial</option>
            <option value='24' <?php if( $obj2->cuerpo_academico==24 ) { echo "selected='selected'"; } ?>>UDG-CA-123 Negocios</option>
            <option value='25' <?php if( $obj2->cuerpo_academico==25 ) { echo "selected='selected'"; } ?>>UDG-CA-430 Dinámica económica regional y mercados en el entorno global</option>
            <option value='26' <?php if( $obj2->cuerpo_academico==26 ) { echo "selected='selected'"; } ?>>UDG-CA-483 Contaduría, finanzas y empresas competitivas y sustentables</option>
            <option value='27' <?php if( $obj2->cuerpo_academico==27 ) { echo "selected='selected'"; } ?>>UDG-CA-535 Estudios Tributarios y Auditoría</option>
            <option value='28' <?php if( $obj2->cuerpo_academico==28 ) { echo "selected='selected'"; } ?>>UDG-CA-614 Modelado y simulación de sistemas</option>
            <option value='29' <?php if( $obj2->cuerpo_academico==29 ) { echo "selected='selected'"; } ?>>UDG-CA-648 Economía y gestión de la educación superior</option>
            <option value='30' <?php if( $obj2->cuerpo_academico==30 ) { echo "selected='selected'"; } ?>>UDG-CA-669 Liderazgo y habilidades directivas en la gestión de empresas</option>
            <option value='31' <?php if( $obj2->cuerpo_academico==31 ) { echo "selected='selected'"; } ?>>UDG-CA-670 Métodos de optimización para la toma de decisiones</option>
            <option value='32' <?php if( $obj2->cuerpo_academico==32 ) { echo "selected='selected'"; } ?>>UDG-CA-722 Sistemas y gestión de la información</option>
            <option value='33' <?php if( $obj2->cuerpo_academico==33 ) { echo "selected='selected'"; } ?>>UDG-CA-745 Paradigmas de la educación, regulación de mercados laborales y su simbiosis con turismo y sustentabilidad</option>
            <option value='34' <?php if( $obj2->cuerpo_academico==34 ) { echo "selected='selected'"; } ?>>UDG-CA-747 Tributación, Sustentabilidad Ambiental y Empresa Socialmente Responsable</option>
            <option value='35' <?php if( $obj2->cuerpo_academico==35 ) { echo "selected='selected'"; } ?>>UDG-CA-753 Métodos  Estadísticos y de Simulación Aplicados para Empresas y Mercados</option>
            <option value='36' <?php if( $obj2->cuerpo_academico==36 ) { echo "selected='selected'"; } ?>>UDG-CA-757 Universidad, industria y empresa en el occidente de México</option>
            <option value='37' <?php if( $obj2->cuerpo_academico==37 ) { echo "selected='selected'"; } ?>>UDG-CA-791 Gestión financiera de organizaciones de la economía social y solidaria</option>
            <option value='38' <?php if( $obj2->cuerpo_academico==38 ) { echo "selected='selected'"; } ?>>UDG-CA-824 Movilidad y procesos interculturales</option>
            <option value='39' <?php if( $obj2->cuerpo_academico==39 ) { echo "selected='selected'"; } ?>>UDG-CA-828 Administración financiera e innovación educativa</option>
            <option value='40' <?php if( $obj2->cuerpo_academico==40 ) { echo "selected='selected'"; } ?>>UDG-CA-830 Turismo, recreación, cultura y gastronomía</option>
            <option value='41' <?php if( $obj2->cuerpo_academico==41 ) { echo "selected='selected'"; } ?>>UDG-CA-831 FORMAS DE GOBERNANZA Y POLITICAS PUBLICAS ( Políticas Públicas para la Seguridad Humana)</option>
            <option value='42' <?php if( $obj2->cuerpo_academico==42 ) { echo "selected='selected'"; } ?>>UDG-CA-860 Riesgos financieros contables y auditoria</option>
            <option value='43' <?php if( $obj2->cuerpo_academico==43 ) { echo "selected='selected'"; } ?>>UDG-CA-866 Determinantes y restricciones al desarrollo y crecimiento económicos</option>
            <option value='44' <?php if( $obj2->cuerpo_academico==44 ) { echo "selected='selected'"; } ?>>UDG-CA-867 Integración y Competencia Económica, Crecimiento Urbano-Regional y Ordenamiento del Territorio</option>
            <option value='45' <?php if( $obj2->cuerpo_academico==45 ) { echo "selected='selected'"; } ?>>UDG-868-CA Articulación productiva y estrategia organizacional</option>
            <option value='46' <?php if( $obj2->cuerpo_academico==46 ) { echo "selected='selected'"; } ?>>UDG-CA-143 Mercadotecnia, Internacionalización  y  competitividad</option>
            <option value='47' <?php if( $obj2->cuerpo_academico==47 ) { echo "selected='selected'"; } ?>>UDG-CA-617 Psicología organizacional y salud</option>
            <option value='48' <?php if( $obj2->cuerpo_academico==48 ) { echo "selected='selected'"; } ?>>UDG-CA-746 Estudios regionales, sustentabilidad y calidad de vida</option>
            <option value='49' <?php if( $obj2->cuerpo_academico==49 ) { echo "selected='selected'"; } ?>>UDG-CA-829 Políticas Públicas para le calidad Educativa</option>
            <option value='50' <?php if( $obj2->cuerpo_academico==50 ) { echo "selected='selected'"; } ?>>UDG-CA-930 Contabilidad financiera fiscal</option>
            <option value='51' <?php if( $obj2->cuerpo_academico==51 ) { echo "selected='selected'"; } ?>>UDG-CA-116 Teoría Económica y Desarrollo Sustentable</option>
            <option value='52' <?php if( $obj2->cuerpo_academico==52 ) { echo "selected='selected'"; } ?>>UDG-CA-823 Comunicación y procesos de gestión organizacional</option>
            <option value='53' <?php if( $obj2->cuerpo_academico==53 ) { echo "selected='selected'"; } ?>>UDG-CA-934 Políticas públicas y Bienestar</option>
            <option value='54' <?php if( $obj2->cuerpo_academico==54 ) { echo "selected='selected'"; } ?>>UDG-CA-827  Estudios culturales sobre los pueblos originarios</option>
            <option value='55' <?php if( $obj2->cuerpo_academico==55 ) { echo "selected='selected'"; } ?>>UDG-CA-556 Economía Global y Regional</option>
            <option value='56' <?php if( $obj2->cuerpo_academico==56 ) { echo "selected='selected'"; } ?>>UDG-CA-649 E-World y Gestión del Conocimiento</option>
            <option value='57' <?php if( $obj2->cuerpo_academico==57 ) { echo "selected='selected'"; } ?>>UDG-CA-666 Gestión, innovación e investigación educativa</option>
            <option value='58' <?php if( $obj2->cuerpo_academico==58 ) { echo "selected='selected'"; } ?>>UDG-CA-931 Educación, tecnologías e innovación</option>
            <option value='59' <?php if( $obj2->cuerpo_academico==59 ) { echo "selected='selected'"; } ?>>UDG-CA-933 Políticas Educativas e Inclusión en la era digital</option>
          </select>
          </td>
          <td colspan="2"><input type="text" name="lgac" size="50" maxlength="50" value="<?php echo $obj2->lgac; ?>" /></td>
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
          <td colspan="4" valign="top"><textarea name="proyectos" cols="102" rows="10" required="required"><?php echo $obj2->proyectos; ?></textarea></td>
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
          <td>Contraseña</td>
          <td>Confirmaci&oacute;n de contraseña</td>
          <td>&nbsp;</td>
        </tr>
        <tr class="textoTitulos4">
          <td><input type="text" name="codigo" size="25" maxlength="50" required="required" value="<?php echo $obj2->codigo; ?>" /></td>
          <td><input type="password" name="contrasena" size="25" maxlength="50" /></td>
          <td><input type="password" name="contrasena2" size="25" maxlength="50" /></td>
          <td>&nbsp;</td>
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
          <input type="hidden" name="id_docente" value="<?php echo $obj2->id_docente; ?>" />
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