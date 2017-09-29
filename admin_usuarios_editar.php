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
<?php  include("basics/functions.php");?>	
<?php 
	if(!isset($_POST['submit']))
	{
		$id=$_GET["id"];	
	}
?>

<?php 
	if(isset($_POST['username']))
	{
		$id=$_POST["id"];
		$username=$_POST["username"];
		$password=$_POST["password"];
		$email=$_POST["email"];
		$nombre=$_POST["nombre"];
		$apellido=$_POST["apellido"];
		$dni=$_POST["dni"];
		$razon=$_POST["razon"];
		$sexo=$_POST["sexo"];	
		m_usuarios($username,$password,$email,$nombre,$apellido,$dni,$razon,$sexo,$id);
		print '<script language="JavaScript">'; 
		print 'alert("Se ha modificado la base de datos con exito.");'; 
		print '</script>'; 
	}
?>	


	<?php include("basics/header.php") ?>	


<body>
	<div id="main">
		<div id="header">
			<div id="header">
				<div id="banner">
					<?php include("basics/logo.php"); ?>
					<?php include("basics/sesion.php"); ?>						
					<?php include("basics/menu_admin.php"); ?>				
				</div>	
			</div>	
		</div>	
		
		<div id="site_content">	
			<?php 	
				$usuarios=l_usuarios_id($id);
				$usuario = mysql_fetch_array($usuarios);
				echo "<form name='registro' action='admin_usuarios_editar.php?id=".$id."' method='post'>";
				echo "<br><table  class='tblExamenesAlumno' id='tblExamenesAlumno'>";
				echo "<tr>
						<td>Username</td>
						<td>Password</td>
						<td>Email</td>
						<td>Nombre</td>
						</tr>";
				echo 	"<tr><td><input name='username' value=".$usuario['username']."></input></td>
						<td><input name='password' value=".$usuario['password']."></input></td>
						<td><input name='email' value=".$usuario['email']."></input></td>
						<td><input name='nombre' value=".$usuario['nombre']."></input></td>	
						</tr></table><br><br>";
				
				echo 	"<br><table  class='tblExamenesAlumno' id='tblExamenesAlumno'>";
				echo 	"<tr>
						<td>Apellido</td>
						<td>DNI</td>
						<td>Razon</td>
						<td>Sexo</td>
					    </tr>";
						
				echo "	<tr>
						<td><input name='apellido' value=".$usuario['apellido']."></input></td>
						<td><input name='dni' value=".$usuario['dni']."></input></td>
						<td><input name='razon' value=".$usuario['razon']."></input></td>
						<td><input name='sexo' value=".$usuario['sexo']."></input></td>
						<tr></table>
						<br>
						<input type='hidden' name='id' value=".$usuario['id']."></input>
						<center><input type='submit' value='Enviar'></center><br><br>
						</form>";
			?>									
		</div>
	<?php include("basics/footer.php"); ?>