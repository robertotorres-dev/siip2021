<?php
require_once "modelo-usuarios.php";
require_once "modelo-lineas-conocimiento.php";

session_start();
$obj = new Usuarios();
$obj->id_usuario = $_SESSION["id_usuario"];
$obj->codigo = $_SESSION["codigo"];
$obj->contrasena = $_SESSION["contrasena"];
$obj->validarSession();

$obj2 = new LineasConocimiento();
$obj2->id_programa = $_SESSION["id_programa"];
$obj2->nombre = $_POST["nombre"];
$obj2->status = 1;
$obj2->agregarLineaConocimiento();

header("Location: alta-lineas-conocimiento3.php?id_linea_conocimiento=$obj2->id_linea_conocimiento");
exit();
