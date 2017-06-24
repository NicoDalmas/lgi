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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>
	<?php include("basics/header.php") ?>	
</head>

<body>
	<div id="main">
		<div id="header">
			<div id="header">
				<div id="banner">
					<?php include("basics/logo.php") ?>
					<?php include("basics/sesion.php") ?>					
					<?php include("basics/menu_admin.php") ?>		
					<?php include("basics/functions.php") ?>	
				</div>	
			</div>	
		</div>	
		<div id="site_content">	
			<header class="major">
				<p>Productos disponibles  </p>
			</header>
				<table>	
				<tr><td>nombre</td><td>descripcion</td><td>tiempo</td><td>offline</td></tr>
					<?php
					$asignadas=l_ex_clientes($_SESSION["cliente_id"]);
					while($asignada = mysql_fetch_array($asignadas))
						{	
							echo"<tr>";
							$examen=l_examenes_id($asignada['id_examen']);							
							echo"<td>".$examen['nombre']."</td><td>".$examen['descripcion']."</td><td>".$examen['tiempo']."</td><td><li><a href='clientes_productos_offline.php?id=".$examen['id']."' class='button special'> exportar</a></li></td></tr>";
						}
					?>
				</table>
					</div>
<?php include("basics/footer.php"); ?>