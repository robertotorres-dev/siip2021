<?php
  /**
  * Clase que gestiona lo relacionado a la tabla revalidaciones_alumnos
  */
  
  require_once "../core/conexion.php";
  require_once "../core/modelo-paises.php";
  
  class Revalidaciones_Alumnos extends Conexion
  {
    public $id_revalidacion_alumno;
    public $id_alumno;
    public $id_pais;
    public $ciudad;
    public $institucion;
    public $departamento;
    public $tutor;
    public $asignaturas;
    public $fecha_inicio;
    public $fecha_termino;
    public $apoyo_financiero;
    public $monto_financiero;
    public $fuente_financiamiento;
    public $revalidacion;
    public $status;
    
    
    public function __construct( ) 
    { 
      parent::__construct( );
    }
    
    
    public function agregarRevalidacion( )
    {
      $sql = "select id_revalidacion_alumno from revalidaciones_alumnos order by id_revalidacion_alumno";
      $res = $this->mysqli->query( $sql );
      $max = $res->num_rows;
      
      if( $max==0 )
      {
        $this->id_revalidacion_alumno = 1;
      }
      else
      {
        $res->data_seek( $max-1 );
        $obj = $res->fetch_object( );
	
	$this->id_revalidacion_alumno = $obj->id_revalidacion_alumno;
        $this->id_revalidacion_alumno++;
      }
      
      $sql = "insert into revalidaciones_alumnos values (
      '$this->id_revalidacion_alumno',
      '$this->id_alumno',
      '$this->id_pais',
      '$this->ciudad',
      '$this->institucion',
      '$this->departamento',
      '$this->tutor',
      '$this->asignaturas',
      '$this->fecha_inicio',
      '$this->fecha_termino',
      '$this->apoyo_financiero',
      '$this->monto_financiero',
      '$this->fuente_financiamiento',
      '$this->revalidacion',
      '$this->status' )";
      $res = $this->mysqli->query( $sql );
      
      $this->mysqli->close( );
    }
    
    
    public function eliminarRevalidacion( )
    {
      $sql = "update revalidaciones_alumnos set status='0' where id_revalidacion_alumno='$this->id_revalidacion_alumno'";
      $res = $this->mysqli->query( $sql );
      
      $this->mysqli->close( );
    }
    
    
    public function modificarRevalidacion( )
    { 
      $sql = "update revalidaciones_alumnos set 
      id_pais='$this->id_pais',
      ciudad='$this->ciudad',
      institucion='$this->institucion',
      departamento='$this->departamento',
      tutor='$this->tutor',
      asignaturas='$this->asignaturas',
      fecha_inicio='$this->fecha_inicio',
      fecha_termino='$this->fecha_termino',
      apoyo_financiero='$this->apoyo_financiero',
      monto_financiero='$this->monto_financiero',
      fuente_financiamiento='$this->fuente_financiamiento',
      revalidacion='$this->revalidacion'
      where id_revalidacion_alumno='$this->id_revalidacion_alumno'";
      $res = $this->mysqli->query( $sql );
      
      $this->mysqli->close( );
    }
    
    
    public function obtenerRevalidacion( )
    {
      $sql = "select * from revalidaciones_alumnos where id_revalidacion_alumno='$this->id_revalidacion_alumno' and status='1'";
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
        $this->asignaturas = $obj->asignaturas;
        $this->fecha_inicio = $obj->fecha_inicio;
        $this->fecha_termino = $obj->fecha_termino;
        $this->apoyo_financiero = $obj->apoyo_financiero;
        $this->monto_financiero = $obj->monto_financiero;
        $this->fuente_financiamiento = $obj->fuente_financiamiento;
	$this->revalidacion = $obj->revalidacion;
      }
      
      $res->close( );
      $this->mysqli->close( );
    }
    
    
    public function listaRevalidacionesAlumno( )
    {
      $sql = "select * from revalidaciones_alumnos where id_alumno='$this->id_alumno' and status='1' order by id_revalidacion_alumno";
      $res = $this->mysqli->query( $sql );
      $max = $res->num_rows;
      
      for( $i=0; $i<$max; $i++ )
      {
	$res->data_seek( $i );
        $obj = $res->fetch_object( );
        
        $obj2 = new Paises( );
        $obj2->id_pais = $obj->id_pais;
        $obj2->obtenerPais( );
	
        $this->id_revalidacion_alumno[$i] = $obj->id_revalidacion_alumno;
        $this->id_pais[$i] = $obj->id_pais;
        $this->ciudad[$i] = $obj->ciudad;
        $this->institucion[$i] = $obj->institucion;
        $this->departamento[$i] = $obj->departamento;
	$this->tutor[$i] = $obj->tutor;
        $this->asignaturas[$i] = $obj->asignaturas;
        $this->fecha_inicio[$i] = $obj->fecha_inicio;
        $this->fecha_termino[$i] = $obj->fecha_termino;
        $this->apoyo_financiero[$i] = $obj->apoyo_financiero;
        $this->monto_financiero[$i] = $obj->monto_financiero;
        $this->fuente_financiamiento[$i] = $obj->fuente_financiamiento;
	$this->revalidacion[$i] = $obj->revalidacion;
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