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
					<?php include("basics/menu_admin.php") ?>
					<?php include("basics/functions.php") ?>					
				
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
					<div class="table-responsive">
					<table class="table table-striped" id="tblmaterias" style="visibility:visible;">
						<tr>
							<th>Id</th>
							<th>Nombre</th>
							<th>Descripción</th>
							<th>Editar</th>
							<th>Eliminar</th>
						</tr>
						<?php
							$materias=l_materias();
							while($materia = mysql_fetch_array($materias))
							{	
								echo "<tr>";
								echo      "<td>" . $materia['idMateria'] . "</td>" .
										  "<td>" . $materia['materia'] . "</td>" .
										  "<td>" . $materia['descripcion'] . "</td>" .
										  "<td><a href='?editarMateria=" . $materia['idMateria'] . "'> <span class=\"glyphicon glyphicon-edit\" aria-hidden=\"true\"></span></a></td>" . 
										  "<td><a href='?eliminarMateria=" . $materia['idMateria'] . "'> <span class=\"glyphicon glyphicon-trash\" aria-hidden=\"true\"></span></a></td>";
								echo "</tr>";
							}
							if (isset($_REQUEST['eliminarMateria'])) 
							{
								eliminarMateria($_REQUEST['eliminarMateria']);
							}
						?>
						<tr>
							<form name="frmMateria" method="post" onsubmit="return validar()" action="admin_materias.php">
								<td><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></td>
								<td><input type="text" name="materia" class="form-control"></td>
								<td><input type="textarea" name="descripcion" class="form-control"></td>
								<td><input type="submit" class="btn btn-success" name="agregar" value="Agregar Nueva Materia"></td>
								<td></td>
							</form>
						</tr>
					</table>
				</div>
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