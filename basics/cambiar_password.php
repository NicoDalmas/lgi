<?php include("connection_db.php"); ?>
<?php require_once("session.php"); ?>
<?php 
	global $conexion;
	$usuario = trim($_SESSION["username"]);
	$passwordNueva = trim($_POST["passwordNuevo1"]);
	$update= "UPDATE usuarios 
			  SET password='{$passwordNueva}'
			  WHERE username='{$usuario}'"; 
	mysql_query($update,$conexion);
	header("Location: ../home.php");
?>