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
<?php 
	$_SESSION['id_alumno']=$_REQUEST['id'];

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
				<tr><td>Examen</td><td>Estado</td><td>Nota</td><td>Inicio</td><td>Terminada</td><td>Ver evaluacion</td></tr>
				<?php
				$nom=l_usuarios_id($_SESSION['id_alumno']);
				$ape=mysql_fetch_array($nom);
				echo 	'<br><p>Estas viendo los examenes del alumno: '.$ape["apellido"].' '.$ape["nombre"].' </p>';
				
				
				$alumnoselect=l_pruebas_id_alumno($_REQUEST['id']);
				while ( $ver=mysql_fetch_array($alumnoselect) )
				{
						
						if($ver['estado']==1){$estado="Pendiente";}else{$estado="Terminada";}
						echo'<tr><td>'.$ver['nombre'].'</td><td>'.$ver['estado'].'</td><td>'.$ver['nota'].'</td><td>'.$ver['inicio'].'</td><td>'.$ver['terminada'].'</td>
						<td><a href="clientes_ver_evaluacion_alumno.php?id='.$ver['id'].'" class="button special"> Ver</a></td></tr>';
				}
				?>
		</table>
		<br>
			
		</div>
<?php include("basics/footer.php"); ?>