<?php
  /**
  * Clase que gestiona lo relacionado a la tabla cvu_alumnos
  */
  
  require_once "../core/conexion.php";
  
  class CVU_Alumnos extends Conexion 
  {
    public $id_cvu_alumno;
    public $id_alumno;
    public $categoria;
    public $fecha;
    public $texto1;
    public $texto2;
    public $texto3;
    public $archivo;
    public $status;
    
    
    public function __construct( ) 
    { 
      parent::__construct( );
    }
    
    
    public function agregarCVU( )
    {
      $sql = "select id_cvu_alumno from cvu_alumnos order by id_cvu_alumno";
      $res = $this->mysqli->query( $sql );
      $max = $res->num_rows;
      
      if( $max==0 )
      {
        $this->id_cvu_alumno = 1;
      }
      else
      {
        $res->data_seek( $max-1 );
        $obj = $res->fetch_object( );
	
	$this->id_cvu_alumno = $obj->id_cvu_alumno;
        $this->id_cvu_alumno++;
      }
      
      if( $this->archivo!=null )
      {
        $ext = pathinfo( $this->archivo, PATHINFO_EXTENSION );
        rename( "../uploads/".$this->archivo, "../uploads/A-CVU-".$this->id_alumno."-".$this->id_cvu_alumno.".".$ext );
	$this->archivo = "A-CVU-".$this->id_alumno."-".$this->id_cvu_alumno.".".$ext;
      }
      
      $sql = "insert into cvu_alumnos values ( '$this->id_cvu_alumno', '$this->id_alumno', '$this->categoria', '$this->fecha', 
      '$this->texto1', '$this->texto2', '$this->texto3', '$this->archivo', '$this->status' )";
      $res = $this->mysqli->query( $sql );
      
      $this->mysqli->close( );
    }
    
    
    public function eliminarCVU( )
    {
      $sql = "update cvu_alumnos set status='0' where id_cvu_alumno='$this->id_cvu_alumno'";
      $res = $this->mysqli->query( $sql );
      
      $this->mysqli->close( );
    }
    
    
    public function modificarCVU( )
    {
      if( $this->archivo!=null )
      {
        $ext = pathinfo( $this->archivo, PATHINFO_EXTENSION );
        rename( "../uploads/".$this->archivo, "../uploads/A-CVU-".$this->id_alumno."-".$this->id_cvu_alumno.".".$ext );
	$this->archivo = "A-CVU-".$this->id_alumno."-".$this->id_cvu_alumno.".".$ext;
	
	$sql = "update cvu_alumnos set archivo='$this->archivo' where id_cvu_alumno='$this->id_cvu_alumno'";
        $res = $this->mysqli->query( $sql );
      }
      
      $sql = "update cvu_alumnos set fecha='$this->fecha', texto1='$this->texto1', texto2='$this->texto2', texto3='$this->texto3' 
      where id_cvu_alumno='$this->id_cvu_alumno'";
      $res = $this->mysqli->query( $sql );
      
      $this->mysqli->close( );
    }
    
    
    public function obtenerCVU( )
    {  
      $sql = "select * from cvu_alumnos where id_cvu_alumno='$this->id_cvu_alumno' and status='1'";
      $res = $this->mysqli->query( $sql );
      $max = $res->num_rows;
      
      if( $max!=0 )
      {
	$res->data_seek( 0 );
        $obj = $res->fetch_object( );
	
	$this->id_alumno = $obj->id_alumno;
	$this->categoria = $obj->categoria;
	$this->fecha = $obj->fecha;
	$this->texto1 = $obj->texto1;
	$this->texto2 = $obj->texto2;
	$this->texto3 = $obj->texto3;
	$this->archivo = $obj->archivo;
      }
      
      $res->close( );
      $this->mysqli->close( );
    }
    
    
    public function listaCVUAlumno1( )
    {
      $sql = "select * from cvu_alumnos where id_alumno='$this->id_alumno' and categoria='1' and status='1' order by id_cvu_alumno";
      $res = $this->mysqli->query( $sql );
      $max = $res->num_rows;
      
      for( $i=0; $i<$max; $i++ )
      {
	$res->data_seek( $i );
        $obj = $res->fetch_object( );
	
	$this->id_cvu_alumno[$i] = $obj->id_cvu_alumno;
	$this->fecha[$i] = $obj->fecha;
	$this->texto1[$i] = $obj->texto1;
	$this->texto2[$i] = $obj->texto2;
	$this->texto3[$i] = $obj->texto3;
	$this->archivo[$i] = $obj->archivo;
      }
      
      $res->close( );
      $this->mysqli->close( );
    }
    
    
    public function listaCVUAlumno2( )
    {
      $sql = "select * from cvu_alumnos where id_alumno='$this->id_alumno' and categoria='2' and status='1' order by id_cvu_alumno";
      $res = $this->mysqli->query( $sql );
      $max = $res->num_rows;
      
      for( $i=0; $i<$max; $i++ )
      {
	$res->data_seek( $i );
        $obj = $res->fetch_object( );
	
	$this->id_cvu_alumno[$i] = $obj->id_cvu_alumno;
	$this->fecha[$i] = $obj->fecha;
	$this->texto1[$i] = $obj->texto1;
	$this->texto2[$i] = $obj->texto2;
	$this->texto3[$i] = $obj->texto3;
	$this->archivo[$i] = $obj->archivo;
      }
      
      $res->close( );
      $this->mysqli->close( );
    }
    
    
    public function listaCVUAlumno3( )
    {
      $sql = "select * from cvu_alumnos where id_alumno='$this->id_alumno' and categoria='3' and status='1' order by id_cvu_alumno";
      $res = $this->mysqli->query( $sql );
      $max = $res->num_rows;
      
      for( $i=0; $i<$max; $i++ )
      {
	$res->data_seek( $i );
        $obj = $res->fetch_object( );
	
	$this->id_cvu_alumno[$i] = $obj->id_cvu_alumno;
	$this->fecha[$i] = $obj->fecha;
	$this->texto1[$i] = $obj->texto1;
	$this->texto2[$i] = $obj->texto2;
	$this->texto3[$i] = $obj->texto3;
	$this->archivo[$i] = $obj->archivo;
      }
      
      $res->close( );
      $this->mysqli->close( );
    }
  }
?>