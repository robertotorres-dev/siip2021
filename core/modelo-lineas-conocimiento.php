<?php

/**
 * Clase que gestiona lo relacionado a la tabla lineas_conocimiento
 */

require_once "conexion.php";

class LineasConocimiento extends Conexion
{
  public $id_linea_conocimiento;
  public $id_programa;
  public $nombre;
  public $status;


  public function __construct()
  {
    parent::__construct();
  }


  public function agregarLineaConocimiento()
  {
    $sql = "select id_linea_conocimiento from lineas_conocimiento order by id_linea_conocimiento";
    $res = $this->mysqli->query($sql);
    $max = $res->num_rows;

    if ($max == 0) {
      $this->id_linea_conocimiento = 1;
    } else {
      $res->data_seek($max - 1);
      $obj = $res->fetch_object();

      $this->id_linea_conocimiento = $obj->id_linea_conocimiento;
      $this->id_linea_conocimiento++;
    }

    $sql = "insert into lineas_conocimiento values ( '$this->id_linea_conocimiento', '$this->id_programa', '$this->nombre', 
    '$this->status' )";
    $res = $this->mysqli->query($sql);

    $this->mysqli->close();
  }


  public function eliminarLineaConocimiento()
  {
    $sql = "update lineas_conocimiento set status='0' where id_linea_conocimiento='$this->id_linea_conocimiento'";
    $res = $this->mysqli->query($sql);

    $this->mysqli->close();
  }


  public function modificarLineaConocimiento()
  {

    $sql = "update lineas_conocimiento set nombre='$this->nombre' where id_linea_conocimiento='$this->id_linea_conocimiento'";
    $res = $this->mysqli->query($sql);

    $this->mysqli->close();
  }


  public function obtenerLineaConocimiento()
  {
    $sql = "select * from lineas_conocimiento where id_linea_conocimiento='$this->id_linea_conocimiento' and status='1'";
    $res = $this->mysqli->query($sql);
    $max = $res->num_rows;

    if ($max != 0) {
      $res->data_seek(0);
      $obj = $res->fetch_object();

      $this->id_programa = $obj->id_programa;
      $this->nombre = $obj->nombre;
    }

    $res->close();
    $this->mysqli->close();
  }


  public function listaLineasConocimientoPrograma()
  {
    $sql = "select * from lineas_conocimiento where id_programa='$this->id_programa' and status='1' order by id_linea_conocimiento";
    $res = $this->mysqli->query($sql);
    $max = $res->num_rows;

    for ($i = 0; $i < $max; $i++) {
      $res->data_seek($i);
      $obj = $res->fetch_object();

      $this->id_linea_conocimiento[$i] = $obj->id_linea_conocimiento;
      $this->nombre[$i] = $obj->nombre;
    }

    $res->close();
    $this->mysqli->close();
  }
}
