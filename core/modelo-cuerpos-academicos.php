<?php

/**
 * Clase que gestiona lo relacionado a la tabla cuerpos_academicos
 */

require_once "conexion.php";

class CuerposAcademicos extends Conexion
{
  public $id_cuerpo_academico;
  public $nombre;
  public $status;


  public function __construct()
  {
    parent::__construct();
  }


  public function agregarCuerpoAcademico()
  {
    $sql = "select id_cuerpo_academico from cuerpos_academicos order by id_cuerpo_academico";
    $res = $this->mysqli->query($sql);
    $max = $res->num_rows;

    if ($max == 0) {
      $this->id_cuerpo_academico = 1;
    } else {
      $res->data_seek($max - 1);
      $obj = $res->fetch_object();

      $this->id_cuerpo_academico = $obj->id_cuerpo_academico;
      $this->id_cuerpo_academico++;
    }

    $sql = "insert into cuerpos_academicos values ( '$this->id_cuerpo_academico', '$this->nombre', 
      '$this->status' )";
    $res = $this->mysqli->query($sql);

    $this->mysqli->close();
  }


  public function eliminarCuerpoAcademico()
  {
    $sql = "update cuerpos_academicos set status='0' where id_cuerpo_academico='$this->id_cuerpo_academico'";
    $res = $this->mysqli->query($sql);

    $this->mysqli->close();
  }


  public function modificarCuerpoAcademico()
  {

    $sql = "update cuerpos_academicos set nombre='$this->nombre' where id_cuerpo_academico='$this->id_cuerpo_academico'";
    $res = $this->mysqli->query($sql);

    $this->mysqli->close();
  }


  public function obtenerCuerpoAcademico()
  {
    $sql = "select * from cuerpos_academicos where id_cuerpo_academico='$this->id_cuerpo_academico' and status='1'";
    $res = $this->mysqli->query($sql);
    $max = $res->num_rows;

    if ($max != 0) {
      $res->data_seek(0);
      $obj = $res->fetch_object();

      $this->nombre = $obj->nombre;
    }

    $res->close();
    $this->mysqli->close();
  }


  public function listaCuerposAcademicos()
  {
    $sql = "select * from cuerpos_academicos where status='1' order by id_cuerpo_academico";
    $res = $this->mysqli->query($sql);
    $max = $res->num_rows;

    for ($i = 0; $i < $max; $i++) {
      $res->data_seek($i);
      $obj = $res->fetch_object();

      $this->id_cuerpo_academico[$i] = $obj->id_cuerpo_academico;
      $this->nombre[$i] = $obj->nombre;
    }

    $res->close();
    $this->mysqli->close();
  }
}
