<?php
  /**
  * Clase que gestiona lo relacionado a la tabla eventos_alumnos
  */
  
  require_once "../core/conexion.php";
  require_once "../core/modelo-paises.php";
  
  class Eventos_Alumnos extends Conexion 
  {
    public $id_evento_alumno;
    public $id_alumno;
    public $id_pais;
    public $evento;
    public $ponencia;
    public $ciudad;
    public $institucion;
    public $fecha_inicio;
    public $fecha_termino;
    public $apoyo_financiero;
    public $monto_financiero;
    public $fuente_financiamiento;
    public $aprobacion;
    public $status;
    
    
    public function __construct( ) 
    { 
      parent::__construct( );
    }
    
    
    public function agregarEvento( )
    {
      $sql = "select id_evento_alumno from eventos_alumnos order by id_evento_alumno";
      $res = $this->mysqli->query( $sql );
      $max = $res->num_rows;
      
      if( $max==0 )
      {
        $this->id_evento_alumno = 1;
      }
      else
      {
        $res->data_seek( $max-1 );
        $obj = $res->fetch_object( );
	
	$this->id_evento_alumno = $obj->id_evento_alumno;
        $this->id_evento_alumno++;
      }
      
      $sql = "insert into eventos_alumnos values (
      '$this->id_evento_alumno',
      '$this->id_alumno',
      '$this->id_pais',
      '$this->evento',
      '$this->ponencia',
      '$this->ciudad',
      '$this->institucion',
      '$this->fecha_inicio',
      '$this->fecha_termino',
      '$this->apoyo_financiero',
      '$this->monto_financiero',
      '$this->fuente_financiamiento',
      '$this->aprobacion',
      '$this->status' )";
      $res = $this->mysqli->query( $sql );
      
      $this->mysqli->close( );
    }
    
    
    public function eliminarEvento( )
    {
      $sql = "update eventos_alumnos set status='0' where id_evento_alumno='$this->id_evento_alumno'";
      $res = $this->mysqli->query( $sql );
      
      $this->mysqli->close( );
    }
    
    
    public function modificarEvento( )
    { 
      $sql = "update eventos_alumnos set 
      id_pais='$this->id_pais',
      evento='$this->evento',
      ponencia='$this->ponencia',
      ciudad='$this->ciudad',
      institucion='$this->institucion',
      fecha_inicio='$this->fecha_inicio',
      fecha_termino='$this->fecha_termino',
      apoyo_financiero='$this->apoyo_financiero',
      monto_financiero='$this->monto_financiero',
      fuente_financiamiento='$this->fuente_financiamiento',
      aprobacion='$this->aprobacion'
      where id_evento_alumno='$this->id_evento_alumno'";
      $res = $this->mysqli->query( $sql );
      
      $this->mysqli->close( );
    }
    
    
    public function obtenerEvento( )
    {
      $sql = "select * from eventos_alumnos where id_evento_alumno='$this->id_evento_alumno' and status='1'";
      $res = $this->mysqli->query( $sql );
      $max = $res->num_rows;
      
      if( $max!=0 )
      {
	$res->data_seek( 0 );
        $obj = $res->fetch_object( );
	
        $this->id_alumno = $obj->id_alumno;
        $this->id_pais = $obj->id_pais;
	$this->evento = $obj->evento;
	$this->ponencia = $obj->ponencia;
        $this->ciudad = $obj->ciudad;
        $this->institucion = $obj->institucion;
        $this->fecha_inicio = $obj->fecha_inicio;
        $this->fecha_termino = $obj->fecha_termino;
        $this->apoyo_financiero = $obj->apoyo_financiero;
        $this->monto_financiero = $obj->monto_financiero;
        $this->fuente_financiamiento = $obj->fuente_financiamiento;
	$this->aprobacion = $obj->aprobacion;
      }
      
      $res->close( );
      $this->mysqli->close( );
    }
    
    
    public function listaEventosAlumno( )
    {
      $sql = "select * from eventos_alumnos where id_alumno='$this->id_alumno' and status='1' order by id_evento_alumno";
      $res = $this->mysqli->query( $sql );
      $max = $res->num_rows;
      
      for( $i=0; $i<$max; $i++ )
      {
	$res->data_seek( $i );
        $obj = $res->fetch_object( );
        
        $obj2 = new Paises( );
        $obj2->id_pais = $obj->id_pais;
        $obj2->obtenerPais( );
	
        $this->id_evento_alumno[$i] = $obj->id_evento_alumno;
        $this->id_pais[$i] = $obj->id_pais;
	$this->evento[$i] = $obj->evento;
	$this->ponencia[$i] = $obj->ponencia;
        $this->ciudad[$i] = $obj->ciudad;
        $this->institucion[$i] = $obj->institucion;
        $this->fecha_inicio[$i] = $obj->fecha_inicio;
        $this->fecha_termino[$i] = $obj->fecha_termino;
        $this->apoyo_financiero[$i] = $obj->apoyo_financiero;
        $this->monto_financiero[$i] = $obj->monto_financiero;
        $this->fuente_financiamiento[$i] = $obj->fuente_financiamiento;
	$this->aprobacion[$i] = $obj->aprobacion;
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