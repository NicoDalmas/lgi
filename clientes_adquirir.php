<?php require_once("basics/session.php"); ?>
<?php
	if(isset($_SESSION["username"]))
	{
		if($_SESSION["usuario_permiso"] == 1)
		{
			header("Location: alumno.php");
			exit();
		}
		elseif(($_SESSION["usuario_permiso"] == 3) || ($_SESSION["usuario_permiso"] == 4))
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
	<script>
	//Validar formulario
	function validar()
	{
		tiempo=document.frmSolicitud.tiempo.value
		cantidad=document.frmSolicitud.cantidad.value
		if (tiempo<0)
		{
			alert("El tiempo debe ser mayor a 0 min.")
			document.frmSolicitud.tiempo.focus()
			return false
		}
		if (cantidad<0)
		{
			alert("La cantidad de encuestados debe ser mayor a 0.")
			document.frmSolicitud.tiempo.focus()
			return false
		}
	}
	</script>

<body>
	
					<?php include("basics/logo.php") ?>
					<?php include("basics/sesion.php") ?>					
					<?php include("basics/menu_admin.php") ?>		
					<?php include("basics/functions.php") ?>	
				

				<div class="form-group">
					<form name="frmSolicitud" method="post" onsubmit="return validar()" action="clientes_adquirir.php">	
						<h1>Solicitar Producto</h1>
							<table class="table table-hover">
								<tr>
									<td>
										
										<div class="form-group">
  <label for="sel1">Tipo de Examen: </label>
  <select class="form-control" id="sel1">
    <option>Online</option>
    <option>Offline</option>
  </select>
</div>
									</td>
									<td rowspan="4">
										<p><span><b>Comentarios sobre el contenido</b>></span><br/>
										<textarea class="form-group" type="text" maxlength="500" style="height:220px; width:400px; resize:none; font-family:Verdana; font-size:12px;" maxlength="500" name="comentarios"></textarea>
									</td>
								</tr>
								<tr>
									<td>
										<div class="form-group">
										  <label for="sel1">Tema: </label>
										  <select class="form-control" id="sel1">
										   <?php
												$temas=l_temas();
												while($tema = mysql_fetch_array($temas))
												{	
													$materia = $tema['materia'];
													$materiaid = $tema['idMateria'];
													echo "<option value='$materiaid'>" . $materia . "</option>";
												}
											?>
										</select>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<p><b><span>Tiempo límite (en minutos)</span></b><br/>
										<input class="form-group" type="text" name="tiempo" maxlength="3"/></p>
									</td>
								</tr>
								<tr>
									<td>
										<p><b><span>Cantidad de Encuestados</span></b><br/>
										<input class="form-group" type="text" name="cantidad" maxlength="5"/></p>
									</td>
								</tr>
							</table>
							<center>
								<input class="btn btn-primary" type="submit" name="contact_submitted" value="Solicitar" />
							</center>
							<?php
								if(isset($_POST["tipo"]) && isset($_POST["comentarios"]) && isset($_POST["tema"]) && isset($_POST["tiempo"]) && isset($_POST["cantidad"]))
								{
									$tipo=$_POST["tipo"];
									$comentarios=$_POST["comentarios"];
									$tema=$_POST["tema"];
									$tiempo=$_POST["tiempo"];
									$cantidad=$_POST["cantidad"];
									agregarSolicitudProducto($tipo, $comentarios, $tema, $tiempo, $cantidad);
								}
							?>
						</div>
					</form>
				</div>
			</div>
		</div>
<?php include("basics/footer.php"); ?>