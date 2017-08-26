<?php require_once("basics/session.php"); ?>
<?php
	if(isset($_SESSION["username"]))
	{
		if($_SESSION["usuario_permiso"] == 1)
		{
			header("Location: alumno.php");
			exit();
		}
		elseif($_SESSION["usuario_permiso"] == 2)
		{
			header("Location: clientes_pagos.php");
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
	<div id="main">
		<div id="header">
			<div id="header">
				<div id="banner">
					<?php include("basics/menu_admin.php") ?>	
					<?php include("basics/sesion.php") ?>					
						
				</div>	
			</div>	
		</div>	
		
		<div id="site_content">	
			<br><center><H1> Bienvenido al modulo de control del sitio.</H1> </center><br>
		</div>
	<?php include("basics/footer.php"); ?>