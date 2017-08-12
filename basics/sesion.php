<?php require_once("basics/session.php"); ?>

<div id="sesion">
	<form name="frmInicioSesion" method="post" enctype="text/plain">
		<div class="form_sesion">
		<?php
		if(!isset($_SESSION["username"]))
		{
		?>
			<input class="btn btn-primary" type="button" value="Iniciar Sesión" onClick="alert('hola');location.href='inicioSesion.php'" />
			<input class="btn btn-info" type="button" value="Registrarse" onClick="location.href='registrarse.php'" />
		<?php
		}
		else
		{
		?>
			<table class="tblsesion">
				<tr>
					<td>
						<?php echo '<h2>Bienvenido ' . $_SESSION["username"] . '</h2>'; ?>
					</td>
				</tr>
				<tr>
					<td>
						<a href="basics/logout.php">Cerrar Sesión</a>
					</td>
				</tr>
			</table>
		<?php
		}
		?>
		</div>
	</form>	
</div> 