<?php 
session_start(); 

function verificar_sesion()
{
if(!isset($_SESSION["idAcceso"]))
	{
	header("Location: inicioSesion.php");
	exit();
	}
}
?>