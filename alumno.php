<?php require_once("basics/session.php"); ?>
<?php
	if(isset($_SESSION["username"]))
	{
		if($_SESSION["usuario_permiso"] == 2)
		{
			header("Location: clientes_pagos.php");
			exit();
		}
		elseif($_SESSION["usuario_permiso"] == 3)
		{
			header("Location: admin.php");
			exit();
		}
		elseif($_SESSION["usuario_permiso"] == 4)
		{
			header("Location: admin.php");
			exit();
		}
	}
	else
	{
		header("Location: home.php");
		exit();
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>
	<?php include("basics/header.php") ?>	
</head>

<body>
	<?php include("basics/menu_admin.php") ?>
	<?php include("basics/sesion.php") ?>



		<div id="site_content">	
			<br><center><H1> ¡Bienvenido alumno, desde este lugar podras acceder a tus evaluaciones, consultar tus notas y mas!   </H1> </center><br>
		</div>
<?php include("basics/footer.php"); ?>