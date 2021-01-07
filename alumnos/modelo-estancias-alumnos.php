<?php
  /**
  * Clase que gestiona lo relacionado a la tabla estancias_alumnos
  */
  
  require_once "../core/conexion.php";
  require_once "../core/modelo-paises.php";
  
  class Estancias_Alumnos extends Conexion 
  {
    public $id_estancia_alumno;
    public $id_alumno;
    public $id_pais;
    public $ciudad;
    public $institucion;
    public $departamento;
    public $tutor;
    public $proyecto;
    public $fecha_inicio;
    public $fecha_termino;
    public $apoyo_financiero;
    public $monto_financiero;
    public $fuente_financiamiento;
    public $resultados;
    public $status;
    
    
    public function __construct( ) 
    { 
      parent::__construct( );
    }
    
    
    public function agregarEstancia( )
    {
      $sql = "select id_estancia_alumno from estancias_alumnos order by id_estancia_alumno";
      $res = $this->mysqli->query( $sql );
      $max = $res->num_rows;
      
      if( $max==0 )
      {
        $this->id_estancia_alumno = 1;
      }
      else
      {
        $res->data_seek( $max-1 );
        $obj = $res->fetch_object( );
	
	$this->id_estancia_alumno = $obj->id_estancia_alumno;
        $this->id_estancia_alumno++;
      }
      
      $sql = "insert into estancias_alumnos values (
      '$this->id_estancia_alumno',
      '$this->id_alumno',
      '$this->id_pais',
      '$this->ciudad',
      '$this->institucion',
      '$this->departamento',
      '$this->tutor',
      '$this->proyecto',
      '$this->fecha_inicio',
      '$this->fecha_termino',
      '$this->apoyo_financiero',
      '$this->monto_financiero',
      '$this->fuente_financiamiento',
      '$this->resultados',
      '$this->status' )";
      $res = $this->mysqli->query( $sql );
      
      $this->mysqli->close( );
    }
    
    
    public function eliminarEstancia( )
    {
      $sql = "update estancias_alumnos set status='0' where id_estancia_alumno='$this->id_estancia_alumno'";
      $res = $this->mysqli->query( $sql );
      
      $this->mysqli->close( );
    }
    
    
    public function modificarEstancia( )
    { 
      $sql = "update estancias_alumnos set 
      id_pais='$this->id_pais',
      ciudad='$this->ciudad',
      institucion='$this->institucion',
      departamento='$this->departamento',
      tutor='$this->tutor',
      proyecto='$this->proyecto',
      fecha_inicio='$this->fecha_inicio',
      fecha_termino='$this->fecha_termino',
      apoyo_financiero='$this->apoyo_financiero',
      monto_financiero='$this->monto_financiero',
      fuente_financiamiento='$this->fuente_financiamiento',
      resultados='$this->resultados'
      where id_estancia_alumno='$this->id_estancia_alumno'";
      $res = $this->mysqli->query( $sql );
      
      $this->mysqli->close( );
    }
    
    
    public function obtenerEstancia( )
    {
      $sql = "select * from estancias_alumnos where id_estancia_alumno='$this->id_estancia_alumno' and status='1'";
      $res = $this->mysqli->query( $sql );
      $max = $res->num_rows;
      
      if( $max!=0 )
      {
	$res->data_seek( 0 );
        $obj = $res->fetch_object( );
	
        $this->id_alumno = $obj->id_alumno;
        $this->id_pais = $obj->id_pais;
        $this->ciudad = $obj->ciudad;
        $this->institucion = $obj->institucion;
        $this->departamento = $obj->departamento;
	$this->tutor = $obj->tutor;
        $this->proyecto = $obj->proyecto;
        $this->fecha_inicio = $obj->fecha_inicio;
        $this->fecha_termino = $obj->fecha_termino;
        $this->apoyo_financiero = $obj->apoyo_financiero;
        $this->monto_financiero = $obj->monto_financiero;
        $this->fuente_financiamiento = $obj->fuente_financiamiento;
	$this->resultados = $obj->resultados;
      }
      
      $res->close( );
      $this->mysqli->close( );
    }
    
    
    public function listaEstanciasAlumno( )
    {
      $sql = "select * from estancias_alumnos where id_alumno='$this->id_alumno' and status='1' order by id_estancia_alumno";
      $res = $this->mysqli->query( $sql );
      $max = $res->num_rows;
      
      for( $i=0; $i<$max; $i++ )
      {
	$res->data_seek( $i );
        $obj = $res->fetch_object( );
        
        $obj2 = new Paises( );
        $obj2->id_pais = $obj->id_pais;
        $obj2->obtenerPais( );
	
        $this->id_estancia_alumno[$i] = $obj->id_estancia_alumno;
        $this->id_pais[$i] = $obj->id_pais;
        $this->ciudad[$i] = $obj->ciudad;
        $this->institucion[$i] = $obj->institucion;
        $this->departamento[$i] = $obj->departamento;
	$this->tutor[$i] = $obj->tutor;
        $this->proyecto[$i] = $obj->proyecto;
        $this->fecha_inicio[$i] = $obj->fecha_inicio;
        $this->fecha_termino[$i] = $obj->fecha_termino;
        $this->apoyo_financiero[$i] = $obj->apoyo_financiero;
        $this->monto_financiero[$i] = $obj->monto_financiero;
        $this->fuente_financiamiento[$i] = $obj->fuente_financiamiento;
	$this->resultados[$i] = $obj->resultados;
        $this->pais[$i] = $obj2->nombre;
        
	switch( $this->apoyo_financiero[$i] )
        {
          case 1: $this->apoyo_financiero_txt[$i] = "SI"; break;
          case 2: $this->apoyo_financiero_txt[$i] = "NO"; break;
        }
      }
      
      $res->close( );
      $this->mysqli->close( );
    }
  }
?>