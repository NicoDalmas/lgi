<?php require_once("basics/session.php");?>
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

	<?php include("basics/header.php") ?>	


<body>
	
										
					<?php include("basics/menu_admin.php"); ?>				
				
		
		<div id="site_content">	
			<?php 	
				echo "<form name='registro' action='basics/admin_crear_procesar.php' method='post'>";
				echo "<br><table  class='tblExamenesAlumno' id='tblExamenesAlumno'>";
				echo "<tr>
						<td>Username*</td>
						<td>Password*</td>
						<td>Email*</td>
						<td>Nombre</td>
						</tr>";
				echo 	"<tr><td><input name='username'></input></td>
						<td><input name='password'></input></td>
						<td><input name='email'></input></td>
						<td><input name='nombre'></input></td>	
						</tr></table><br><br>";
				
				echo 	"<br><table  class='tblExamenesAlumno' id='tblExamenesAlumno'>";
				echo 	"<tr>
						<td>Apellido</td>
						<td>DNI</td>
						<td>Usuario</td>
						<td>Sexo</td>
					    </tr>";
						
				echo "	<tr>
						<td><input name='apellido'></input></td>
						<td><input name='dni'></input></td>
						<td>
							<select name='idacceso'>
								<option value='4'>Admin</option>
								<option value='3'>Administrador</option>
								<option value='2'>Cliente</option>
								<option value='1'>Alumno</option>
							</select>
						</td>
						<td><input name='sexo'></input></td>
						<tr></table>
						<br>
						<input type='hidden' name='id' value='id'></input>
						<center><input type='submit' value='Enviar'></center><br><br>
						</form>";
			?>									
		</div>
	<?php include("basics/footer.php"); ?>