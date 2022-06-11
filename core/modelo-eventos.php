<?php

/**
 * Clase que gestiona lo relacionado a la tabla Eventos
 */

require_once "../core/conexion.php";

class Eventos extends Conexion
{
  public $id_evento;
  public $id_programa;
  public $nombre;
  public $lugar;
  public $profesores;
  public $tipo_profesores;
  public $dependencias;
  public $tipo_dependencias;
  public $tipo_evento;
  public $fecha_inicio;
  public $fecha_termino;
  public $status;
  public $tipo_dependencias_txt;


  public function __construct()
  {
    parent::__construct();
  }


  public function agregarEvento()
  {
    $sql = "select id_evento from eventos order by id_evento";
    $res = $this->mysqli->query($sql);
    $max = $res->num_rows;

    if ($max == 0) {
      $this->id_evento = 1;
    } else {
      $res->data_seek($max - 1);
      $obj = $res->fetch_object();

      $this->id_evento = $obj->id_evento;
      $this->id_evento++;
    }

    $sql = "insert into eventos values ( 
        '$this->id_evento',
        '$this->id_programa', 
        '$this->nombre',
        '$this->lugar',
        '$this->profesores',
        '$this->tipo_profesores',
        '$this->dependencias',
        '$this->tipo_dependencias',
        '$this->tipo_evento',
        '$this->fecha_inicio',
        '$this->fecha_termino',
        '$this->status' )";
    $res = $this->mysqli->query($sql);

    $this->mysqli->close();
  }


  public function eliminarEvento()
  {
    $sql = "update eventos set status='0' where id_evento='$this->id_evento'";
    $res = $this->mysqli->query($sql);

    $this->mysqli->close();
  }


  public function modificarEvento()
  {
    $sql = "update eventos set
      nombre='$this->nombre',
      lugar='$this->lugar',
      profesores='$this->profesores',
      tipo_profesores='$this->tipo_profesores',
      dependencias='$this->dependencias',
      tipo_dependencias='$this->tipo_dependencias',
      tipo_evento='$this->tipo_evento',
      fecha_inicio='$this->fecha_inicio',
      fecha_termino='$this->fecha_termino'
      where id_evento='$this->id_evento'";
    $res = $this->mysqli->query($sql);

    $this->mysqli->close();
  }


  public function obtenerEvento()
  {
    $sql = "select * from eventos where id_evento='$this->id_evento' and status='1'";
    $res = $this->mysqli->query($sql);
    $max = $res->num_rows;

    if ($max != 0) {
      $res->data_seek(0);
      $obj = $res->fetch_object();
      $this->id_programa = $obj->id_programa;
      $this->nombre = $obj->nombre;
      $this->lugar = $obj->lugar;
      $this->profesores = $obj->profesores;
      $this->tipo_profesores = $obj->tipo_profesores;
      $this->dependencias = $obj->dependencias;
      $this->tipo_dependencias = $obj->tipo_dependencias;
      $this->tipo_evento = $obj->tipo_evento;
      $this->fecha_inicio = $obj->fecha_inicio;
      $this->fecha_termino = $obj->fecha_termino;

      switch ($this->tipo_dependencias) {
        case 1:
          $this->tipo_dependencias_txt = "Organizadora";
          break;
        case 2:
          $this->tipo_dependencias_txt = "Anfitriona";
          break;
        case 3:
          $this->tipo_dependencias_txt = "Invitada";
          break;
        case 4:
          $this->tipo_dependencias_txt = "Otro";
          break;
      }
    }

    $res->close();
    $this->mysqli->close();
  }


  public function listaEventosPrograma()
  {
    $sql = "select * from eventos where id_programa='$this->id_programa' and status='1' order by id_evento";
    $res = $this->mysqli->query($sql);
    $max = $res->num_rows;

    for ($i = 0; $i < $max; $i++) {
      $res->data_seek($i);
      $obj = $res->fetch_object();
      $this->id_evento[$i] = $obj->id_evento;
      $this->nombre[$i] = $obj->nombre;
      $this->lugar[$i] = $obj->lugar;
      $this->profesores[$i] = $obj->profesores;
      $this->tipo_profesores[$i] = $obj->tipo_profesores;
      $this->dependencias[$i] = $obj->dependencias;
      $this->tipo_dependencias[$i] = $obj->tipo_dependencias;
      $this->tipo_evento[$i] = $obj->tipo_evento;
      $this->fecha_inicio[$i] = $obj->fecha_inicio;
      $this->fecha_termino[$i] = $obj->fecha_termino;

      switch ($this->tipo_dependencias[$i]) {
        case 1:
          $this->tipo_dependencias_txt[$i] = "Organizadora";
          break;
        case 2:
          $this->tipo_dependencias_txt[$i] = "Anfitriona";
          break;
        case 3:
          $this->tipo_dependencias_txt[$i] = "Invitada";
          break;
        case 4:
          $this->tipo_dependencias_txt[$i] = "Otro";
          break;
      }
    }

    $res->close();
    $this->mysqli->close();
  }
}
