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
	
	<?php include("basics/logo.php"); ?>
	<?php include("basics/sesion.php"); ?>					
	<?php include("basics/functions.php"); ?>	
	<?php include("basics/menu_admin.php"); ?>		
			
	<div align="center">	
		<a href="admin_crear_usuario.php"><button type="button" class="btn btn-success btn-lg">
	    <span class="glyphicon glyphicon-plus"></span>  Crear un usuario  </button></a>
    </div>
			
			<?php 
				
				for ($idacceso=4; $idacceso>=1; $idacceso--)
				{
					$usuarios=l_usuarios_idacceso($idacceso);
					separar ($usuarios, $idacceso);
				}	
			?>
						
		
	<?php include("basics/footer.php"); ?>