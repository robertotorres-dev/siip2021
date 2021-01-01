<?php
  /**
  * Clase que gestiona lo relacionado a la tabla egresados
  */
  
  require_once "../core/conexion.php";
  require_once "../alumnos/modelo-alumnos.php";
  require_once "../titulados/modelo-titulados.php";
  
  class Egresados extends Conexion 
  {
    public $id_egresado;
    public $id_ciclo;
    public $fecha;
    public $status;
    
    
    public function __construct( ) 
    { 
      parent::__construct( );
    }
    
    
    public function agregarEgresado( )
    {
      $sql = "select id_egresado from egresados order by id_egresado";
      $res = $this->mysqli->query( $sql );
      $max = $res->num_rows;
      
      if( $max==0 )
      {
        $this->id_egresado = 1;
      }
      else
      {
        $res->data_seek( $max-1 );
        $obj = $res->fetch_object( );
	
	$this->id_egresado = $obj->id_egresado;
        $this->id_egresado++;
      }
      
      $sql = "insert into egresados values ( '$this->id_egresado', '$this->id_ciclo', '$this->fecha', '$this->status' )";
      $res = $this->mysqli->query( $sql );
      
      $this->mysqli->close( );
    }
    
    
    public function eliminarEgresado( )
    {
      $sql = "update alumnos set id_egresado='0' where id_alumno='$this->id_alumno'";
      $res = $this->mysqli->query( $sql );
      
      $sql = "update egresados set status='0' where id_egresado='$this->id_egresado'";
      $res = $this->mysqli->query( $sql );
      
      $this->mysqli->close( );
    }
    
    
    public function modificarEgresado( )
    {
      $sql = "update egresados set id_ciclo='$this->id_ciclo', fecha='$this->fecha' where id_egresado='$this->id_egresado'";
      $res = $this->mysqli->query( $sql );
      
      $this->mysqli->close( );
    }
    
    public function obtenerEgresado( )
    {  
      $sql = "select * from egresados where id_egresado='$this->id_egresado' and status='1'";
      $res = $this->mysqli->query( $sql );
      $max = $res->num_rows;
      
      if( $max!=0 )
      {
	$res->data_seek( 0 );
        $obj = $res->fetch_object( );
	
	$this->id_ciclo = $obj->id_ciclo;
	$this->fecha = $obj->fecha;
      }
      
      $res->close( );
      $this->mysqli->close( );
    }
    
    
    public function listaEgresadosCiclo( )
    {
      $sql = "select * from alumnos where id_programa='$this->id_programa' and id_ciclo='$this->id_ciclo' and id_egresado!='0' and status='1' 
      order by apellido_paterno, apellido_materno, nombre";
      $res = $this->mysqli->query( $sql );
      $max = $res->num_rows;
      
      for( $i=0; $i<$max; $i++ )
      {
	$res->data_seek( $i );
        $obj = $res->fetch_object( );
	
	$this->id_alumno[$i] = $obj->id_alumno;
	$this->id_orientacion[$i] = $obj->id_orientacion;
	$this->id_titulado[$i] = $obj->id_titulado;
	$this->codigo[$i] = $obj->codigo;
	$this->apellido_paterno[$i] = $obj->apellido_paterno;
	$this->apellido_materno[$i] = $obj->apellido_materno;
	$this->nombre[$i] = $obj->nombre;
      }
      
      $res->close( );
      $this->mysqli->close( );
    }
    
    
    public function listaEgresadosCiclo2( )
    {
      $sql = "select * from alumnos, egresados where alumnos.id_programa='$this->id_programa' and alumnos.id_egresado!='0' and alumnos.status='1' 
      and alumnos.id_egresado=egresados.id_egresado and egresados.id_ciclo='$this->id_ciclo' order by alumnos.apellido_paterno, alumnos.apellido_materno, 
      alumnos.nombre";
      $res = $this->mysqli->query( $sql );
      $max = $res->num_rows;
      
      for( $i=0; $i<$max; $i++ )
      {
	$res->data_seek( $i );
        $obj = $res->fetch_object( );
	
	$this->id_alumno[$i] = $obj->id_alumno;
	$this->id_orientacion[$i] = $obj->id_orientacion;
	$this->codigo[$i] = $obj->codigo;
	$this->apellido_paterno[$i] = $obj->apellido_paterno;
	$this->apellido_materno[$i] = $obj->apellido_materno;
	$this->nombre[$i] = $obj->nombre;
      }
      
      $res->close( );
      $this->mysqli->close( );
    }
    
    
    public function listaEgresadosCicloPromocion( )
    {
      $sql = "select * from alumnos where id_programa='$this->id_programa' and id_ciclo='$this->id_ciclo' and id_egresado!='0' and id_titulado='0' 
      and status='1' order by apellido_paterno, apellido_materno, nombre";
      $res = $this->mysqli->query( $sql );
      $max = $res->num_rows;
      
      for( $i=0; $i<$max; $i++ )
      {
	$res->data_seek( $i );
        $obj = $res->fetch_object( );
	
	$this->id_alumno[$i] = $obj->id_alumno;
	$this->id_orientacion[$i] = $obj->id_orientacion;
	$this->codigo[$i] = $obj->codigo;
	$this->apellido_paterno[$i] = $obj->apellido_paterno;
	$this->apellido_materno[$i] = $obj->apellido_materno;
	$this->nombre[$i] = $obj->nombre;
      }
      
      $res->close( );
      $this->mysqli->close( );
    }
    
    
    public function promocionarEgresado( )
    {
      $obj = new Alumnos( );
      $obj->id_alumno = $this->id_alumno;
      $obj->obtenerAlumno( );
      
      if( $obj->id_titulado!=0 )
      {
	header( "Location: promocion-egresados2.php?id_alumno=$this->id_alumno&error=1" );
        exit( );
      }
      
      $obj2 = new Titulados( );
      $obj2->id_ciclo = $this->id_ciclo;
      $obj2->fecha = $this->fecha;
      $obj2->numero_acta = $this->numero_acta;
      $obj2->documento1 = 0;
      $obj2->documento2 = 0;
      $obj2->documento3 = 0;
      $obj2->documento4 = 0;
      $obj2->documento5 = 0;
      $obj2->documento6 = 0;
      $obj2->documento7 = 0;
      $obj2->documento8 = 0;
      $obj2->archivo1 = null;
      $obj2->archivo2 = null;
      $obj2->archivo3 = null;
      $obj2->archivo4 = null;
      $obj2->archivo5 = null;
      $obj2->archivo6 = null;
      $obj2->archivo7 = null;
      $obj2->archivo8 = null;
      $obj2->oficio_prorroga = null;
      $obj2->fecha_prorroga = null;
      $obj2->status = 1;
      $obj2->agregarTitulado( );
      
      $sql = "update alumnos set id_titulado='$obj2->id_titulado' where id_alumno='$this->id_alumno'";
      $res = $this->mysqli->query( $sql );
      
      $this->mysqli->close( );
    }
  }
?>