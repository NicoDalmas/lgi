<?php require_once("basics/session.php"); ?>
<?php
	if(isset($_SESSION["username"]))
	{
		if($_SESSION["usuario_permiso"] == 1)
		{
			header("Location: alumno.php");
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

<head>
	<?php include("basics/header.php") ?>	
</head>

<body>

					<?php include("basics/menu_admin.php") ?>		

		<div id="site_content">	
			<br><center><H1> ¡Bienvenido CLIENTE, desde este lugar podras acceder a tus evaluaciones, asignar alumnos a sus examenes y mas!   </H1> </center><br>
		</div>
<?php include("basics/footer.php"); ?>