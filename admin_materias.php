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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>
	<?php include("basics/header.php") ?>
	<script languaje="javascript">
		function validar()
		{
			materia=document.frmMateria.materia.value
			descripcion=document.frmMateria.descripcion.value
			if (materia.length<=2)
			{
				alert("El nombre de la materia debe ser de al menos 3 caracteres.")
				document.frmMateria.materia.focus()
				return false
			}
			if (descripcion.length<=2)
			{
				alert("La descripción debe ser de al menos 3 caracteres.")
				document.frmMateria.descripcion.focus()
				return false
			}
		}
		function validarEditar()
		{
			materia=document.frmModificarMateria.materiaModificada.value
			descripcion=document.frmModificarMateria.descripcionModificada.value
			if (materia.length<=2)
			{
				alert("El nombre de la materia debe ser de al menos 3 caracteres.")
				document.frmModificarMateria.materiaModificada.focus()
				return false
			}
			if (descripcion.length<=2)
			{
				alert("La descripción debe ser de al menos 3 caracteres.")
				document.frmModificarMateria.descripcionModificada.focus()
				return false
			}
		}
	</script>	
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
			<div>
				</br>
				<h2>Materias</h2>
				<?php
					if(isset($_REQUEST['editarMateria'])) 
					{
						$materia = buscarMateria($_REQUEST['editarMateria']);
						echo '<p><b>Editar Materia</b></p>';
						?>
						<form name="frmModificarMateria" method="post" onsubmit="return validarEditar()" action="admin_materias.php">
							<p>ID: <input type="text" name="idMateriaModificada" value="<?php echo $materia['idMateria'] ?>" readonly></p>
							<p>Materia: <input type="text" name="materiaModificada" value="<?php echo $materia['materia'] ?>"></p>
							<p>Descripción: <input type="text" name="descripcionModificada" value="<?php echo $materia['descripcion'] ?>"></p>
							<input type="submit" name="modificar" value="Editar">
						</form>
						<?php	  
					}
					else
					{
				?>
				<center>
					<table class="tblmaterias" id="tblmaterias" style="visibility:visible;">
						<tr>
							<td>Id</td>
							<td>Nombre</td>
							<td>Descripción</td>
							<td></td>
							<td></td>
						</tr>
						<?php
							$materias=l_materias();
							while($materia = mysql_fetch_array($materias))
							{	
								echo "<tr>";
								echo      "<td>" . $materia['idMateria'] . "</td>" .
										  "<td>" . $materia['materia'] . "</td>" .
										  "<td>" . $materia['descripcion'] . "</td>" .
										  "<td><a href='?editarMateria=" . $materia['idMateria'] . "'>Editar</a></td>" . 
										  "<td><a href='?eliminarMateria=" . $materia['idMateria'] . "'>Eliminar</a></td>";
								echo "</tr>";
							}
							if (isset($_REQUEST['eliminarMateria'])) 
							{
								eliminarMateria($_REQUEST['eliminarMateria']);
							}
						?>
						<tr>
							<form name="frmMateria" method="post" onsubmit="return validar()" action="admin_materias.php">
								<td></td>
								<td><input type="text" name="materia"></td>
								<td><input type="textarea" name="descripcion"></td>
								<td><input type="submit" name="agregar" value="Agregar"></td>
								<td></td>
							</form>
						</tr>
					</table>
				</center>
				<?php
					}
				?>
				</br>
				<?php
				 	if(isset($_POST["materia"]) && isset($_POST["descripcion"]))
					{
						$materia=$_POST["materia"];
						$descripcion=$_POST["descripcion"];
						agregarMateria($materia, $descripcion);
					}
					if(isset($_POST["idMateriaModificada"]) && isset($_POST["materiaModificada"]) && isset($_POST["descripcionModificada"]))
					{
						$idMateria=$_POST["idMateriaModificada"];
						$materia=$_POST["materiaModificada"];
						$descripcion=$_POST["descripcionModificada"];
						editarMateria($idMateria, $materia, $descripcion);
					}
				?> 
			</div>
		</div>
<?php include("basics/footer.php"); ?>