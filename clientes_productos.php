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
			
			
			
			
			<?php
				if(!isset($_REQUEST['verCodigos'])) 
			{ 
			?>
				<br>
				<b><h2><center>Productos disponibles</b></h2></center>
				<table class='tblExamenesAlumno' id='tblExamenesAlumno'>
					<tr><td>Nombre Examen</td><td>Descripcion</td><td>Tiempo</td><td>Online</td><td>Offline</td></tr>
						<?php
						$cliente_id=$_SESSION["cliente_id"];
						$asignadas=l_ex_clientes($cliente_id);
						$offline=l_examenes_online($_SESSION["cliente_id"]);
						while ($online= mysql_fetch_array($offline))
						{
							
								echo "<tr>";						
								echo	 "<td>".$online['nombre']."</td>
										 <td>".$online['descripcion']."</td>											
										<td>".$online['tiempo']."</td>";
										if ($online['tipoDeExamen'] == "Online" )
										{
											echo "<td><li><a href='?verCodigos=".$online['id']."'>Ver codigos</a></li></td><td></td>";
										}
										else
										{
											echo "<td></td>";
											echo "<td><li><a href='?exportar=".$online['id']."'>Exportar</a></li></td>";
										}
										echo "</tr>";
							
						}
					?>
				</table><br><br>
			<?php
			}
			else
			{
				?>
					<br><br>
					<table  class='tblExamenesAlumno' id='tblExamenesAlumno'>
					<tr>
						<td>Nombre de la materia</td>  
						<td>Titulo del examen</td>
						<td>Codigo del examen</td>
						<td>Password del examen</td>
					</tr>
					<?php
						$codigos = ex_codigos_idCliente($_REQUEST['verCodigos']);
						while($codigo = mysql_fetch_array($codigos))
						{
							echo "<tr>";
							echo    "<td>" . $codigo['materia'] . "</td>". 
									"<td>" . $codigo['nombre'] . "</td>". 
									"<td>" . $codigo['codigoExamen'] . "</td>" .
									"<td>" . $codigo['passwordExamen'] . "</td>";
							echo "</tr>";
						}
					?>
					</table><br><br>
				
				<?php
			}
			if(isset($_REQUEST['exportar']))
			{
				$_SESSION['idExamen'] = $_REQUEST['exportar'];
				header("Location: alumno_evaluacion_offline.php");
			}
				?>
		</div>
<?php include("basics/footer.php"); ?>