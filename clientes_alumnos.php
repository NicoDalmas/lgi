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
				<table class='tblExamenesAlumno' id='tblExamenesAlumno'>		
				<br>
				<tr><td>Apellido y Nombre</td><td>DNI</td><td>Email</td><td>Ver examenes</td>
				</tr>
					<?php
					$id_cliente=$_SESSION["cliente_id"];
					$al=l_alumnos($id_cliente);
					$alum = mysql_fetch_array($al);
					$alumno_id=($alum['id_alumno']);
					$alumnos=l_alumnos_usuarios($alumno_id);
					while($alumno = mysql_fetch_array($alumnos))
					{	
						echo '<tr><td>'.$alumno['apellido'].', '.$alumno['nombre'].'</td>
						<td>'.$alumno['dni'].'</td>
						<td>'.$alumno['email'].'</td>';	
								
						echo '<td><a href="clientes_ver_evaluacion.php?id='.$alumno['id'].'"> Ver</a></li></td></tr>';
					}
					?>
				</table>	
				<br>
		</div>
<?php include("basics/footer.php"); ?>