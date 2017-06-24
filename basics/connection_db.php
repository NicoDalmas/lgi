<?php
require_once("constants.php");
$conexion = mysql_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD);
if(!$conexion)
{
	die("No se puede conectar a la base de datos:". mysql_error());
}

$bd_seleccionada = mysql_select_db(DB_NAME , $conexion);
if (!$bd_seleccionada)
{
	die("No se pudo seleccionar la BD: " . mysql_error());
}
?>