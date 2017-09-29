
<?php include("basics/header.php") ?>
<?php include("basics/session.php") ?>
<body>
<?php include("basics/menu_admin.php") ?>	



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


<br><center><H1> Bienvenido al módulo de control del sitio.</H1></center><br>
		
</body>		

<?php include("basics/footer.php"); ?>