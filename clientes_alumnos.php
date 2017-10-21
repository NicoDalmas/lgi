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

	<?php include("basics/header.php") ?>	
				
					<?php include("basics/menu_admin.php") ?>		
					<?php include("basics/functions.php") ?>	
				
		<b><h2><center>Listado de Alumnos</b></h2></center>	
				<table class='table table-bordered' id='tblExamenesAlumno'>		
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