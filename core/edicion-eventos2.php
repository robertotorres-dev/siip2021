<?php
require_once "../core/modelo-usuarios.php";
require_once "modelo-eventos.php";

session_start();
$obj = new Usuarios();
$obj->id_usuario = $_SESSION["id_usuario"];
$obj->codigo = $_SESSION["codigo"];
$obj->contrasena = $_SESSION["contrasena"];
$obj->validarSession();

$obj2 = new Eventos();
$obj2->id_evento = $_POST["id_evento"];
$obj2->id_programa = $_SESSION["id_programa"];
$obj2->nombre = $_POST["nombre"];
$obj2->lugar = $_POST["lugar"];
$obj2->profesores = $_POST["profesores"];
$obj2->tipo_profesores = $_POST["tipo_profesores"];
$obj2->dependencias = $_POST["dependencias"];
$obj2->tipo_dependencias = $_POST["tipo_dependencias"];
$obj2->tipo_evento = $_POST["tipo_evento"];
$obj2->fecha_inicio = $_POST["fecha_inicio"];
$obj2->fecha_termino = $_POST["fecha_termino"];
$obj2->status = 1;
print_r($obj2);
$obj2->modificarEvento();

header("Location: edicion-eventos3.php?id_evento=$obj2->id_evento");
exit();
