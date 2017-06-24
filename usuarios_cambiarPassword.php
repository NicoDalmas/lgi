<?php require_once("basics/session.php"); ?>
<?php
	if(!isset($_SESSION["username"]))
	{
		header("Location: home.php");
		exit();
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>
	<?php include("basics/header.php") ?>	
	<script>
		function validar()
		{
			passwordActual=document.frmCambioPassword.passwordActual.value
			passwordNueva1=document.frmCambioPassword.passwordNuevo1.value
			passwordNueva2=document.frmCambioPassword.passwordNuevo2.value
			if (passwordActual.length<=5)
			{
				alert("La contraseña debe contener más de 8 caraceteres.")
				document.frmCambioPassword.passwordActual.focus()
				return false
			}
			if (passwordNueva1.length<=5)
			{
				alert("La nueva contraseña debe contener más de 8 caraceteres.")
				document.frmCambioPassword.passwordNuevo1.focus()
				return false
			}
			if (passwordNueva2.length<=5)
			{
				alert("La nueva contraseña debe contener más de 8 caraceteres.")
				document.frmCambioPassword.passwordNuevo2.focus()
				return false
			}
			if (passwordNueva1!=passwordNueva2)
			{
				alert("Las contraseñas no coincide.")
				document.frmCambioPassword.passwordNueva2.focus()
				return false
			}
			else if (passwordActual==passwordNueva1)
			{
				alert("Su contraseña nueva no puede ser igual a la actual.")
				document.frmCambioPassword.passwordNueva1.focus()
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
			<div id="content">
				<div class="content_item">
					<form name="frmCambioPassword" method="post" onsubmit="return validar()" action="basics/cambiar_password.php">	
						<div class="form_settings">
							<h1>Cambiar Contraseña</h1>
							<table class="tbliniciosesion">
								<tr>
									<td>
										<p><span>Contraseña</span><br/>
										<input class="contact" type="password" name="passwordActual" /></p>
									</td>
								</tr>
								<tr>
									<td>
										<p><span>Nueva Contraseña</span><br/>
										<input class="contact" type="password" name="passwordNuevo1" /></p>
									</td>
								</tr>
								<tr>
									<td>
										<p><span>Repita Nueva Contraseña</span><br/>
										<input class="contact" type="password" name="passwordNuevo2" /></p>
									</td>
								</tr>
								<tr>
									<td>
										</br>
										<?php if(isset($mensaje)) { echo "<p>" . $mensaje . "</p>"; } ?>
										</br>
									</td>
								</tr>			
								<tr>
									<td>
										<input class="submit" type="submit" value="Ingresar" />
									</td>
								</tr>
							</table>
						</div>
					</form>
				</div>
			</div>
		</div>
<?php include("basics/footer.php"); ?>