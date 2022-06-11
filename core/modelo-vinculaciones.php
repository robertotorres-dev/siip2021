<?php
  /**
  * Clase que gestiona lo relacionado a la tabla Vinculaciones
  */
  
  require_once "../core/conexion.php";
  
  class Vinculaciones extends Conexion 
  {
    public $id_vinculacion;
    public $id_programa;
    public $nombre;
    public $responsable;
    public $fecha;
    public $instancias;
    public $beneficios;
    public $status;
    
    
    public function __construct( ) 
    { 
      parent::__construct( );
    }
    
    
    public function agregarVinculacion( )
    {
      $sql = "select id_vinculacion from vinculaciones order by id_vinculacion";
      $res = $this->mysqli->query( $sql );
      $max = $res->num_rows;
      
      if( $max==0 )
      {
        $this->id_vinculacion = 1;
      }
      else
      {
        $res->data_seek( $max-1 );
        $obj = $res->fetch_object( );
	
	      $this->id_vinculacion = $obj->id_vinculacion;
        $this->id_vinculacion++;
      }
      
      $sql = "insert into vinculaciones values ( 
        '$this->id_vinculacion', 
        '$this->id_programa', 
        '$this->nombre',
        '$this->responsable',
        '$this->fecha',
        '$this->instancias',
        '$this->beneficios',
        '$this->status' )";
        $res = $this->mysqli->query( $sql );
      
        $this->mysqli->close( );
    }
    
    
    public function eliminarVinculacion( )
    {
      $sql = "update vinculaciones set status='0' where id_vinculacion='$this->id_vinculacion'";
      $res = $this->mysqli->query( $sql );
      
      $this->mysqli->close( );
    }
    
    
    public function modificarVinculacion( )
    { 
      
      $sql = "update vinculaciones set 
      nombre='$this->nombre',
      responsable='$this->responsable',
      fecha='$this->fecha',
      instancias='$this->instancias',
      beneficios='$this->beneficios'
      where id_vinculacion='$this->id_vinculacion'";
      $res = $this->mysqli->query( $sql );
      
      $this->mysqli->close( );
    }
    
    
    public function obtenerVinculacion( )
    {  
      $sql = "select * from vinculaciones where id_vinculacion='$this->id_vinculacion' and status='1'";
      $res = $this->mysqli->query( $sql );
      $max = $res->num_rows;
      
      if( $max!=0 )
      {
	      $res->data_seek( 0 );
        $obj = $res->fetch_object( );
  
        $this->id_programa = $obj->id_programa;
        $this->nombre = $obj->nombre;
        $this->responsable = $obj->responsable;
        $this->fecha = $obj->fecha;
        $this->instancias = $obj->instancias;
        $this->beneficios = $obj->beneficios;
      }
      
      $res->close( );
      $this->mysqli->close( );
    }
    
    
    public function listaVinculacionesPrograma( )
    {
      $sql = "select * from vinculaciones where id_programa='$this->id_programa' and status='1' order by id_vinculacion";
      $res = $this->mysqli->query( $sql );
      $max = $res->num_rows;
      
      for( $i=0; $i<$max; $i++ )
      {
	      $res->data_seek( $i );
        $obj = $res->fetch_object( );
	
        $this->id_vinculacion[$i] = $obj->id_vinculacion;
        $this->nombre[$i] = $obj->nombre;
        $this->responsable[$i] = $obj->responsable;
        $this->fecha[$i] = $obj->fecha;
        $this->instancias[$i] = $obj->instancias;
        $this->beneficios[$i] = $obj->beneficios;

      }
      
      $res->close( );
      $this->mysqli->close( );
    }
  }
?>