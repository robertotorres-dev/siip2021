<?php
  /**
  * Clase que gestiona lo relacionado a la tabla docentes
  */
  
  require_once "../core/conexion.php";
  require_once "../core/modelo-paises.php";
  
  class Docentes extends Conexion 
  {
    public $id_docente;
    public $id_pais;
    public $codigo;
    public $contrasena;
    public $apellido_paterno;
    public $apellido_materno;
    public $nombre;
    public $sexo;
    public $fecha_nacimiento;
    public $lugar_nacimiento;
    public $modalidad;
    public $escolaridad;
    public $institucion;
    public $fecha_titulacion;
    public $numero_cvu;
    public $miembro_sni;
    public $nivel_sni;
    public $perfil_prodep;
    public $cuerpo_academico;
    public $lgac;
    public $proyectos;
    public $accesos_fallidos;
    public $status;
    public $sexo_txt;
    public $modalidad_txt;
    public $filtro;
    
    
    public function __construct( ) 
    { 
      parent::__construct( );
    }
    
    
    public function agregarDocente( )
    {
      $sql = "select id_docente from docentes order by id_docente";
      $res = $this->mysqli->query( $sql );
      $max = $res->num_rows;
      
      if( $max==0 )
      {
        $this->id_docente = 1;
      }
      else
      {
        $res->data_seek( $max-1 );
        $obj = $res->fetch_object( );
	
	      $this->id_docente = $obj->id_docente;
        $this->id_docente++;
      }
      
      if( $this->fotografia!=null )
      {
        $ext = pathinfo( $this->fotografia, PATHINFO_EXTENSION );
        rename( "../uploads/".$this->fotografia, "../uploads/D-".$this->id_docente.".".$ext );
	      $this->fotografia = "D-".$this->id_docente.".".$ext;
      }
      
      $sql = "insert into docentes values ( '$this->id_docente', '$this->id_pais', '$this->fotografia', '$this->codigo', '$this->contrasena', 
      '$this->apellido_paterno', '$this->apellido_materno', '$this->nombre', '$this->sexo', '$this->fecha_nacimiento', '$this->lugar_nacimiento',
      '$this->modalidad', '$this->escolaridad', '$this->institucion', '$this->fecha_titulacion', '$this->numero_cvu', '$this->miembro_sni',
      '$this->nivel_sni', '$this->perfil_prodep', '$this->cuerpo_academico', '$this->lgac', '$this->proyectos', '$this->accesos_fallidos', 
      '$this->status' )";
      $res = $this->mysqli->query( $sql );
      
      $this->mysqli->close( );
    }
    
    
    public function eliminarDocente( )
    {
      $sql = "update docentes set status='0' where id_docente='$this->id_docente'";
      $res = $this->mysqli->query( $sql );
      
      $this->mysqli->close( );
    }
    
    
    public function modificarDocente( )
    {
      if( $this->fotografia!=null )
      {
        $ext = pathinfo( $this->fotografia, PATHINFO_EXTENSION );
        rename( "../uploads/".$this->fotografia, "../uploads/D-".$this->id_docente.".".$ext );
	      $this->fotografia = "D-".$this->id_docente.".".$ext;
	
	      $sql = "update docentes set fotografia='$this->fotografia' where id_docente='$this->id_docente'";
        $res = $this->mysqli->query( $sql );
      }
      
      if( $this->contrasena!=null )
      {
	      $this->contrasena = md5( $this->contrasena );
	
	      $sql = "update docentes set contrasena='$this->contrasena' where id_docente='$this->id_docente'";
        $res = $this->mysqli->query( $sql );
      }
      
      $sql = "update docentes set id_pais='$this->id_pais', codigo='$this->codigo', apellido_paterno='$this->apellido_paterno', 
      apellido_materno='$this->apellido_materno', nombre='$this->nombre', sexo='$this->sexo', fecha_nacimiento='$this->fecha_nacimiento',
      lugar_nacimiento='$this->lugar_nacimiento',
      modalidad='$this->modalidad', escolaridad='$this->escolaridad', institucion='$this->institucion', fecha_titulacion='$this->fecha_titulacion',
      numero_cvu='$this->numero_cvu', miembro_sni='$this->miembro_sni', nivel_sni='$this->nivel_sni', perfil_prodep='$this->perfil_prodep',
      cuerpo_academico='$this->cuerpo_academico', lgac='$this->lgac', proyectos='$this->proyectos' where id_docente='$this->id_docente'";
      $res = $this->mysqli->query( $sql );
      
      $this->mysqli->close( );
    }
    
    
    public function obtenerDocente( )
    {  
      $sql = "select * from docentes where id_docente='$this->id_docente' and status='1'";
      $res = $this->mysqli->query( $sql );
      $max = $res->num_rows;
      
      if( $max!=0 )
      {
	      $res->data_seek( 0 );
        $obj = $res->fetch_object( );
	
        $this->id_docente = $obj->id_docente;
        $this->id_pais = $obj->id_pais;
        $this->fotografia = $obj->fotografia;
        $this->codigo = $obj->codigo;
        $this->contrasena = $obj->contrasena;
        $this->apellido_paterno = $obj->apellido_paterno;
        $this->apellido_materno = $obj->apellido_materno;
        $this->nombre = $obj->nombre;
        $this->sexo = $obj->sexo;
        $this->fecha_nacimiento = $obj->fecha_nacimiento;
        $this->lugar_nacimiento = $obj->lugar_nacimiento;
        $this->modalidad = $obj->modalidad;
        $this->escolaridad = $obj->escolaridad;
        $this->institucion = $obj->institucion;
        $this->fecha_titulacion = $obj->fecha_titulacion;
        $this->numero_cvu = $obj->numero_cvu;
        $this->miembro_sni = $obj->miembro_sni;
        $this->nivel_sni = $obj->nivel_sni;
        $this->perfil_prodep = $obj->perfil_prodep;
        $this->cuerpo_academico = $obj->cuerpo_academico;
        $this->lgac = $obj->lgac;
        $this->proyectos = $obj->proyectos;
        $this->accesos_fallidos = $obj->accesos_fallidos;
	
        switch( $this->sexo )
        {
          case 1: $this->sexo_txt = "Masculino"; break;
          case 2: $this->sexo_txt = "Femenino"; break;
        }
        switch( $this->modalidad )
        {
          case 0: $this->modalidad_txt = ""; break;
          case 1: $this->modalidad_txt = "Tiempo completo"; break;
          case 2: $this->modalidad_txt = "Tiempo parcial"; break;
        }
        switch ($this->escolaridad) {
          case 1: $this->escolaridad_txt = "Licenciatura"; break;
          case 2: $this->escolaridad_txt = "Especialidad"; break;
          case 3: $this->escolaridad_txt = "Maestr&iacute;a"; break;
          case 4: $this->escolaridad_txt = "Doctorado"; break;
          case 5: $this->escolaridad_txt = "Postdoctorado"; break;
        }
        switch( $this->miembro_sni )
        {
          case 1: $this->miembro_sni_txt = "Si"; break;
          case 2: $this->miembro_sni_txt = "No"; break;
        }
        switch ($this->nivel_sni) {
          case 1: $this->nivel_sni_txt = "Candidato"; break;
          case 2: $this->nivel_sni_txt = "Nivel I"; break;
          case 3: $this->nivel_sni_txt = "Nivel II"; break;
          case 4: $this->nivel_sni_txt = "Nivel III"; break;
          case 5: $this->nivel_sni_txt = "Em&eacute;rito"; break;
        }
        switch( $this->perfil_prodep )
        {
          case 1: $this->perfil_prodep_txt = "Si"; break;
          case 2: $this->perfil_prodep_txt = "No"; break;
        }
        switch ($this->cuerpo_academico) {
          case 1: $this->cuerpo_academico_txt = "UDG-CA-435 Desarrollo tecnológico e internacionalización de la pequeña y mediana empresa"; break;
          case 2: $this->cuerpo_academico_txt = "UDG-CA-484 Estrategias, Competitividad, Gestión del Conocimiento y Sustentabilidad"; break;
          case 3: $this->cuerpo_academico_txt = "UDG-CA-485 Estudios Urbanos y Territoriales"; break;
          case 4: $this->cuerpo_academico_txt = "UDG-CA-486 Análisis político y gestión de las organizaciones"; break;
          case 5: $this->cuerpo_academico_txt = "UDG-CA-502 Relaciones Económicas Internacionales de México"; break;
          case 6: $this->cuerpo_academico_txt = "UDG-CA-508 Investigación educativa y estudios sobre la universidad"; break;
          case 7: $this->cuerpo_academico_txt = "UDG-CA-667 Organizaciones, estrategias, servicios y gestión del conocimiento para el desarrollo, innovación y competitividad"; break;
          case 8: $this->cuerpo_academico_txt = "UDG-CA-826 Temas de economía internacional, finanzas y desarrollo"; break;
          case 9: $this->cuerpo_academico_txt = "UDG-CA-487 Procesos de internalización, Desarrollo  y Medio Ambiente"; break;
          case 10: $this->cuerpo_academico_txt = "UDG-CA-142 Desarrollo sustentable y estudios sectoriales"; break;
          case 11: $this->cuerpo_academico_txt = "UDG-CA-125 Tecnologías de la información y de la comunicación"; break;
          case 12: $this->cuerpo_academico_txt = "UDG-CA-124 Calidad e Innovación de la Educación Superior"; break;
          case 13: $this->cuerpo_academico_txt = "UDG-CA-394 Sociedad del Conocimiento e Internacionalización"; break;
          case 14: $this->cuerpo_academico_txt = "UDG-CA-459 Población, sustentabilidad y desarrollo regional"; break;
          case 15: $this->cuerpo_academico_txt = "UDG-CA-503 Estudios sobre las PYME's"; break;
          case 16: $this->cuerpo_academico_txt = "UDG-CA-525 Sujetos y Procesos en las Organizaciones"; break;
          case 17: $this->cuerpo_academico_txt = "UDG-CA-668 Sistema Alimentario y Gestión del Conocimiento"; break;
          case 18: $this->cuerpo_academico_txt = "UDG-CA-825 Tratados económicos nacionales y desarrollo regional"; break;
          case 19: $this->cuerpo_academico_txt = "UDG-CA-865 Estudios globales: enfoques y nuevas aproximaciones"; break;
          case 20: $this->cuerpo_academico_txt = "UDG-CA-932 Estudios fiscales, tic´s y educación"; break;
          case 21: $this->cuerpo_academico_txt = "UDG-CA-429 Estudios de género , población y desarrollo humano"; break;
          case 22: $this->cuerpo_academico_txt = "UDG-CA-127 Sector Público: Gestión, Financiamiento y evaluación"; break;
          case 23: $this->cuerpo_academico_txt = "UDG-118- Mercados de trabajo y desarrollo territorial"; break;
          case 24: $this->cuerpo_academico_txt = "UDG-CA-123 Negocios"; break;
          case 25: $this->cuerpo_academico_txt = "UDG-CA-430 Dinámica económica regional y mercados en el entorno global"; break;
          case 26: $this->cuerpo_academico_txt = "UDG-CA-483 Contaduría, finanzas y empresas competitivas y sustentables"; break;
          case 27: $this->cuerpo_academico_txt = "UDG-CA-535 Estudios Tributarios y Auditoría"; break;
          case 28: $this->cuerpo_academico_txt = "UDG-CA-614 Modelado y simulación de sistemas"; break;
          case 29: $this->cuerpo_academico_txt = "UDG-CA-648 Economía y gestión de la educación superior"; break;
          case 30: $this->cuerpo_academico_txt = "UDG-CA-669 Liderazgo y habilidades directivas en la gestión de empresas"; break;
          case 31: $this->cuerpo_academico_txt = "UDG-CA-670 Métodos de optimización para la toma de decisiones"; break;
          case 32: $this->cuerpo_academico_txt = "UDG-CA-722 Sistemas y gestión de la información"; break;
          case 33: $this->cuerpo_academico_txt = "UDG-CA-745 Paradigmas de la educación, regulación de mercados laborales y su simbiosis con turismo y sustentabilidad"; break;
          case 34: $this->cuerpo_academico_txt = "UDG-CA-747 Tributación, Sustentabilidad Ambiental y Empresa Socialmente Responsable"; break;
          case 35: $this->cuerpo_academico_txt = "UDG-CA-753 Métodos  Estadísticos y de Simulación Aplicados para Empresas y Mercados"; break;
          case 36: $this->cuerpo_academico_txt = "UDG-CA-757 Universidad, industria y empresa en el occidente de México"; break;
          case 37: $this->cuerpo_academico_txt = "UDG-CA-791 Gestión financiera de organizaciones de la economía social y solidaria"; break;
          case 38: $this->cuerpo_academico_txt = "UDG-CA-824 Movilidad y procesos interculturales"; break;
          case 39: $this->cuerpo_academico_txt = "UDG-CA-828 Administración financiera e innovación educativa"; break;
          case 40: $this->cuerpo_academico_txt = "UDG-CA-830 Turismo, recreación, cultura y gastronomía"; break;
          case 41: $this->cuerpo_academico_txt = "UDG-CA-831 FORMAS DE GOBERNANZA Y POLITICAS PUBLICAS ( Políticas Públicas para la Seguridad Humana)"; break;
          case 42: $this->cuerpo_academico_txt = "UDG-CA-860 Riesgos financieros contables y auditoria"; break;
          case 43: $this->cuerpo_academico_txt = "UDG-CA-866 Determinantes y restricciones al desarrollo y crecimiento económicos"; break;
          case 44: $this->cuerpo_academico_txt = "UDG-CA-867 Integración y Competencia Económica, Crecimiento Urbano-Regional y Ordenamiento del Territorio"; break;
          case 45: $this->cuerpo_academico_txt = "UDG-868-CA Articulación productiva y estrategia organizacional"; break;
          case 46: $this->cuerpo_academico_txt = "UDG-CA-143 Mercadotecnia, Internacionalización  y  competitividad"; break;
          case 47: $this->cuerpo_academico_txt = "UDG-CA-617 Psicología organizacional y salud"; break;
          case 48: $this->cuerpo_academico_txt = "UDG-CA-746 Estudios regionales, sustentabilidad y calidad de vida"; break;
          case 49: $this->cuerpo_academico_txt = "UDG-CA-829 Políticas Públicas para le calidad Educativa"; break;
          case 50: $this->cuerpo_academico_txt = "UDG-CA-930 Contabilidad financiera fiscal"; break;
          case 51: $this->cuerpo_academico_txt = "UDG-CA-116 Teoría Económica y Desarrollo Sustentable"; break;
          case 52: $this->cuerpo_academico_txt = "UDG-CA-823 Comunicación y procesos de gestión organizacional"; break;
          case 53: $this->cuerpo_academico_txt = "UDG-CA-934 Políticas públicas y Bienestar"; break;
          case 54: $this->cuerpo_academico_txt = "UDG-CA-827  Estudios culturales sobre los pueblos originarios"; break;
          case 55: $this->cuerpo_academico_txt = "UDG-CA-556 Economía Global y Regional"; break;
          case 56: $this->cuerpo_academico_txt = "UDG-CA-649 E-World y Gestión del Conocimiento"; break;
          case 57: $this->cuerpo_academico_txt = "UDG-CA-666 Gestión, innovación e investigación educativa"; break;
          case 58: $this->cuerpo_academico_txt = "UDG-CA-931 Educación, tecnologías e innovación"; break;
          case 59: $this->cuerpo_academico_txt = "UDG-CA-933 Políticas Educativas e Inclusión en la era digital"; break;
        }
      }
      
      $res->close( );
      $this->mysqli->close( );
    }
    
    
    public function listaDocentes( )
    {
      $sql = "select * from docentes where status='1' order by apellido_paterno, apellido_materno, nombre";
      $res = $this->mysqli->query( $sql );
      $max = $res->num_rows;
      
      for( $i=0; $i<$max; $i++ )
      {

        
        $res->data_seek( $i );
        $obj = $res->fetch_object( );
        
        $obj4 = new Paises( );
        $obj4->id_pais = $obj->id_pais;
        $obj4->obtenerPais( );
        
        $this->id_docente[$i] = $obj->id_docente;
        $this->id_pais[$i] = $obj->id_pais;
        $this->pais[$i] = $obj4->nombre;
        $this->codigo[$i] = $obj->codigo;
        $this->apellido_paterno[$i] = $obj->apellido_paterno;
        $this->apellido_materno[$i] = $obj->apellido_materno;
        $this->nombre[$i] = $obj->nombre;
        $this->sexo[$i] = $obj->sexo;
        $this->fecha_nacimiento[$i] = $obj->fecha_nacimiento;
        $this->lugar_nacimiento[$i] = $obj->lugar_nacimiento;
        $this->modalidad[$i] = $obj->modalidad;
        $this->escolaridad[$i] = $obj->escolaridad;
        $this->institucion[$i] = $obj->institucion;
        $this->fecha_titulacion[$i] = $obj->fecha_titulacion;
        $this->numero_cvu[$i] = $obj->numero_cvu;
        $this->miembro_sni[$i] = $obj->miembro_sni;
        $this->nivel_sni[$i] = $obj->nivel_sni;
        $this->perfil_prodep[$i] = $obj->perfil_prodep;
        $this->cuerpo_academico[$i] = $obj->cuerpo_academico;
        $this->lgac[$i] = $obj->lgac;
        $this->proyectos[$i] = $obj->proyectos;
        switch( $this->sexo[$i] )
        {
          case 1: $this->sexo_txt[$i] = "Masculino"; break;
          case 2: $this->sexo_txt[$i] = "Femenino"; break;
        }
        switch( $this->modalidad[$i] )
        {
          case 0: $this->modalidad_txt[$i] = ""; break;
          case 1: $this->modalidad_txt[$i] = "Tiempo completo"; break;
          case 2: $this->modalidad_txt[$i] = "Tiempo parcial"; break;
        }
        switch ($this->escolaridad[$i]) {
          case 1: $this->escolaridad_txt[$i] = "Licenciatura"; break;
          case 2: $this->escolaridad_txt[$i] = "Especialidad"; break;
          case 3: $this->escolaridad_txt[$i] = "Maestr&iacute;a"; break;
          case 4: $this->escolaridad_txt[$i] = "Doctorado"; break;
          case 5: $this->escolaridad_txt[$i] = "Postdoctorado"; break;
        }
        switch( $this->miembro_sni[$i] )
        {
          case 1: $this->miembro_sni_txt[$i] = "Si"; break;
          case 2: $this->miembro_sni_txt[$i] = "No"; break;
        }
        switch ($this->nivel_sni[$i]) {
          case 1: $this->nivel_sni_txt[$i] = "Candidato"; break;
          case 2: $this->nivel_sni_txt[$i] = "Nivel I"; break;
          case 3: $this->nivel_sni_txt[$i] = "Nivel II"; break;
          case 4: $this->nivel_sni_txt[$i] = "Nivel III"; break;
          case 5: $this->nivel_sni_txt[$i] = "Em&eacute;rito"; break;
        }
        switch( $this->perfil_prodep[$i] )
        {
          case 1: $this->perfil_prodep_txt[$i] = "Si"; break;
          case 2: $this->perfil_prodep_txt[$i] = "No"; break;
        }
        switch ($this->cuerpo_academico[$i]) {
          case 1: $this->cuerpo_academico_txt[$i] = "UDG-CA-435 Desarrollo tecnológico e internacionalización de la pequeña y mediana empresa"; break;
          case 2: $this->cuerpo_academico_txt[$i] = "UDG-CA-484 Estrategias, Competitividad, Gestión del Conocimiento y Sustentabilidad"; break;
          case 3: $this->cuerpo_academico_txt[$i] = "UDG-CA-485 Estudios Urbanos y Territoriales"; break;
          case 4: $this->cuerpo_academico_txt[$i] = "UDG-CA-486 Análisis político y gestión de las organizaciones"; break;
          case 5: $this->cuerpo_academico_txt[$i] = "UDG-CA-502 Relaciones Económicas Internacionales de México"; break;
          case 6: $this->cuerpo_academico_txt[$i] = "UDG-CA-508 Investigación educativa y estudios sobre la universidad"; break;
          case 7: $this->cuerpo_academico_txt[$i] = "UDG-CA-667 Organizaciones, estrategias, servicios y gestión del conocimiento para el desarrollo, innovación y competitividad"; break;
          case 8: $this->cuerpo_academico_txt[$i] = "UDG-CA-826 Temas de economía internacional, finanzas y desarrollo"; break;
          case 9: $this->cuerpo_academico_txt[$i] = "UDG-CA-487 Procesos de internalización, Desarrollo  y Medio Ambiente"; break;
          case 10: $this->cuerpo_academico_txt[$i] = "UDG-CA-142 Desarrollo sustentable y estudios sectoriales"; break;
          case 11: $this->cuerpo_academico_txt[$i] = "UDG-CA-125 Tecnologías de la información y de la comunicación"; break;
          case 12: $this->cuerpo_academico_txt[$i] = "UDG-CA-124 Calidad e Innovación de la Educación Superior"; break;
          case 13: $this->cuerpo_academico_txt[$i] = "UDG-CA-394 Sociedad del Conocimiento e Internacionalización"; break;
          case 14: $this->cuerpo_academico_txt[$i] = "UDG-CA-459 Población, sustentabilidad y desarrollo regional"; break;
          case 15: $this->cuerpo_academico_txt[$i] = "UDG-CA-503 Estudios sobre las PYME's"; break;
          case 16: $this->cuerpo_academico_txt[$i] = "UDG-CA-525 Sujetos y Procesos en las Organizaciones"; break;
          case 17: $this->cuerpo_academico_txt[$i] = "UDG-CA-668 Sistema Alimentario y Gestión del Conocimiento"; break;
          case 18: $this->cuerpo_academico_txt[$i] = "UDG-CA-825 Tratados económicos nacionales y desarrollo regional"; break;
          case 19: $this->cuerpo_academico_txt[$i] = "UDG-CA-865 Estudios globales: enfoques y nuevas aproximaciones"; break;
          case 20: $this->cuerpo_academico_txt[$i] = "UDG-CA-932 Estudios fiscales, tic´s y educación"; break;
          case 21: $this->cuerpo_academico_txt[$i] = "UDG-CA-429 Estudios de género , población y desarrollo humano"; break;
          case 22: $this->cuerpo_academico_txt[$i] = "UDG-CA-127 Sector Público: Gestión, Financiamiento y evaluación"; break;
          case 23: $this->cuerpo_academico_txt[$i] = "UDG-118- Mercados de trabajo y desarrollo territorial"; break;
          case 24: $this->cuerpo_academico_txt[$i] = "UDG-CA-123 Negocios"; break;
          case 25: $this->cuerpo_academico_txt[$i] = "UDG-CA-430 Dinámica económica regional y mercados en el entorno global"; break;
          case 26: $this->cuerpo_academico_txt[$i] = "UDG-CA-483 Contaduría, finanzas y empresas competitivas y sustentables"; break;
          case 27: $this->cuerpo_academico_txt[$i] = "UDG-CA-535 Estudios Tributarios y Auditoría"; break;
          case 28: $this->cuerpo_academico_txt[$i] = "UDG-CA-614 Modelado y simulación de sistemas"; break;
          case 29: $this->cuerpo_academico_txt[$i] = "UDG-CA-648 Economía y gestión de la educación superior"; break;
          case 30: $this->cuerpo_academico_txt[$i] = "UDG-CA-669 Liderazgo y habilidades directivas en la gestión de empresas"; break;
          case 31: $this->cuerpo_academico_txt[$i] = "UDG-CA-670 Métodos de optimización para la toma de decisiones"; break;
          case 32: $this->cuerpo_academico_txt[$i] = "UDG-CA-722 Sistemas y gestión de la información"; break;
          case 33: $this->cuerpo_academico_txt[$i] = "UDG-CA-745 Paradigmas de la educación, regulación de mercados laborales y su simbiosis con turismo y sustentabilidad"; break;
          case 34: $this->cuerpo_academico_txt[$i] = "UDG-CA-747 Tributación, Sustentabilidad Ambiental y Empresa Socialmente Responsable"; break;
          case 35: $this->cuerpo_academico_txt[$i] = "UDG-CA-753 Métodos  Estadísticos y de Simulación Aplicados para Empresas y Mercados"; break;
          case 36: $this->cuerpo_academico_txt[$i] = "UDG-CA-757 Universidad, industria y empresa en el occidente de México"; break;
          case 37: $this->cuerpo_academico_txt[$i] = "UDG-CA-791 Gestión financiera de organizaciones de la economía social y solidaria"; break;
          case 38: $this->cuerpo_academico_txt[$i] = "UDG-CA-824 Movilidad y procesos interculturales"; break;
          case 39: $this->cuerpo_academico_txt[$i] = "UDG-CA-828 Administración financiera e innovación educativa"; break;
          case 40: $this->cuerpo_academico_txt[$i] = "UDG-CA-830 Turismo, recreación, cultura y gastronomía"; break;
          case 41: $this->cuerpo_academico_txt[$i] = "UDG-CA-831 FORMAS DE GOBERNANZA Y POLITICAS PUBLICAS ( Políticas Públicas para la Seguridad Humana)"; break;
          case 42: $this->cuerpo_academico_txt[$i] = "UDG-CA-860 Riesgos financieros contables y auditoria"; break;
          case 43: $this->cuerpo_academico_txt[$i] = "UDG-CA-866 Determinantes y restricciones al desarrollo y crecimiento económicos"; break;
          case 44: $this->cuerpo_academico_txt[$i] = "UDG-CA-867 Integración y Competencia Económica, Crecimiento Urbano-Regional y Ordenamiento del Territorio"; break;
          case 45: $this->cuerpo_academico_txt[$i] = "UDG-868-CA Articulación productiva y estrategia organizacional"; break;
          case 46: $this->cuerpo_academico_txt[$i] = "UDG-CA-143 Mercadotecnia, Internacionalización  y  competitividad"; break;
          case 47: $this->cuerpo_academico_txt[$i] = "UDG-CA-617 Psicología organizacional y salud"; break;
          case 48: $this->cuerpo_academico_txt[$i] = "UDG-CA-746 Estudios regionales, sustentabilidad y calidad de vida"; break;
          case 49: $this->cuerpo_academico_txt[$i] = "UDG-CA-829 Políticas Públicas para le calidad Educativa"; break;
          case 50: $this->cuerpo_academico_txt[$i] = "UDG-CA-930 Contabilidad financiera fiscal"; break;
          case 51: $this->cuerpo_academico_txt[$i] = "UDG-CA-116 Teoría Económica y Desarrollo Sustentable"; break;
          case 52: $this->cuerpo_academico_txt[$i] = "UDG-CA-823 Comunicación y procesos de gestión organizacional"; break;
          case 53: $this->cuerpo_academico_txt[$i] = "UDG-CA-934 Políticas públicas y Bienestar"; break;
          case 54: $this->cuerpo_academico_txt[$i] = "UDG-CA-827  Estudios culturales sobre los pueblos originarios"; break;
          case 55: $this->cuerpo_academico_txt[$i] = "UDG-CA-556 Economía Global y Regional"; break;
          case 56: $this->cuerpo_academico_txt[$i] = "UDG-CA-649 E-World y Gestión del Conocimiento"; break;
          case 57: $this->cuerpo_academico_txt[$i] = "UDG-CA-666 Gestión, innovación e investigación educativa"; break;
          case 58: $this->cuerpo_academico_txt[$i] = "UDG-CA-931 Educación, tecnologías e innovación"; break;
          case 59: $this->cuerpo_academico_txt[$i] = "UDG-CA-933 Políticas Educativas e Inclusión en la era digital"; break;
        }

      }
      
      $res->close( );
      $this->mysqli->close( );
    }
    
    
    public function listaDocentesFiltro( )
    {
      $sql = "select * from docentes where apellido_paterno like '$this->filtro%' and status='1' order by apellido_paterno, apellido_materno, nombre";
      $res = $this->mysqli->query( $sql );
      $max = $res->num_rows;
      
      for( $i=0; $i<$max; $i++ )
      {
	      $res->data_seek( $i );
        $obj = $res->fetch_object( );
	
        $this->id_docente[$i] = $obj->id_docente;
        $this->id_pais[$i] = $obj->id_pais;
        $this->codigo[$i] = $obj->codigo;
        $this->apellido_paterno[$i] = $obj->apellido_paterno;
        $this->apellido_materno[$i] = $obj->apellido_materno;
        $this->nombre[$i] = $obj->nombre;
      }
      
      $res->close( );
      $this->mysqli->close( );
    }
    
    
    public function verificarCodigo( )
    {
      $sql = "select * from docentes where codigo='$this->codigo' and status='1'";
      $res = $this->mysqli->query( $sql );
      $max = $res->num_rows;
      
      if( $max!=0 )
      {
	      return true;
      }
      else
      {
	      return false;
      }
      
      $res->close( );
      $this->mysqli->close( );
    }
    
    
    public function verificarCodigo2( )
    {
      $sql = "select * from docentes where codigo='$this->codigo' and id_docente!='$this->id_docente' and status='1'";
      $res = $this->mysqli->query( $sql );
      $max = $res->num_rows;
      
      if( $max!=0 )
      {
	      return true;
      }
      else
      {
	      return false;
      }
      
      $res->close( );
      $this->mysqli->close( );
    }
  }
?>