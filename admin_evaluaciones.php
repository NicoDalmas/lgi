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




	<?php include("basics/header.php") ?>
	<script>
	function validar()
	{
		nombre=document.frmCrearExamen.nombre.value
		if (nombre.length<=5)
		{
			alert("El nombre del examen debe contener un mínimo de 5 caracteres.")
			document.frmCrearExamen.nombre.focus()
			return false
		}
	}
	</script>


<body>

					<?php include("basics/menu_admin.php") ?>
					<?php include("basics/functions.php") ?>					
				
				<center> <h2><b>Crear Exámenes</b></h2></center>
				<?php
				if(!isset($_REQUEST['crearExamen'])) 
				{ ?>
					<center>
						<div class="table-responsive">
						<table class="table table-bordered" id="tblCrearEvaluaciones">
							<tr>
								<th>Id Pedido</th>
								<th>Materia</th>
								<th>Tipo</th>
								<th>Tiempo</th>
								<th>Comentarios</th>
								<th>Cant Encuestados</th>
								<th>Crear</th>
							</tr>
							<?php
								$pedidos=l_solicitudesPendientes();
								while($pedido = mysql_fetch_array($pedidos))
								{	
									echo "<tr>";
									echo      "<td>" . $pedido['id'] . "</td>" .
											  "<td>" . $pedido['materia'] . "</td>" .
											  "<td>" . $pedido['tipoDeExamen'] . "</td>" .
											  "<td>" . $pedido['tiempo'] . "</td>" .
											  "<td>" . $pedido['comentarios'] . "</td>" .
											  "<td>" . $pedido['cantidadEncuestados'] . "</td>" .
											  "<td><a href='?crearExamen=" . $pedido['id'] . "'> <button type='button' class='btn btn-success'>
	    <span class='glyphicon glyphicon-ok'></span></button></a></td>";
									echo "</tr>";
								}
							?>
						</table>
					</div>
						</br>
					</center>
				<?php
				}
				else
				{
					$datosExamen = l_solicitudesPendientes_id($_REQUEST['crearExamen']);
					$_SESSION["ex_id"] = $datosExamen['id'];
					$_SESSION["ex_materia"] = $datosExamen['materia'];
					$_SESSION["ex_tipoDeExamen"] = $datosExamen['tipoDeExamen'];
					$_SESSION["ex_tiempo"] = $datosExamen['tiempo'];
					$_SESSION["ex_comentarios"] = $datosExamen['comentarios'];
					$_SESSION["ex_cantidadEncuestados"] = $datosExamen['cantidadEncuestados'];
					$_SESSION["ex_idCliente"] = $datosExamen['idCliente'];
					$_SESSION["ex_idMateria"] = $datosExamen['idMateria'];

					echo '<p><b>Id Pedido: </b>' . $datosExamen['id'] . '</p>';						
					echo '<p><b>Materia: </b>' . $datosExamen['materia'] . '</p>';
					echo '<p><b>Tipo: </b>' . $datosExamen['tipoDeExamen'] . '</p>';	
					echo '<p><b>Tiempo: </b>' . $datosExamen['tiempo'] . ' min</p>';	
					echo '<p><b>Comentarios: </b>' . $datosExamen['comentarios'] . '</p>';	
					echo '<p><b>Cantidad Encuestados: </b>' . $datosExamen['cantidadEncuestados'] . '</p>';	
					if(!isset($datosExamen['idExamen']))
					{ ?>
						<form name="frmCrearExamen" method="post" onsubmit="return validar()" action="admin_evaluaciones.php">
							<div class="form-group">
							<p>
								<b>Nombre Examen: </b>
								<input type="text" name="nombre" maxlength="25">
							</p>
							<p>
								<b>Descripción Examen: </b></br>
								<textarea type="text" name="descripcion" style="width:255px; height:140px; resize:none; font-family:Verdana; font-size:12px;"></textarea>
							</p>
							<p>
								<b>Activo: </b>
								<select name="activo" style="width:45px;">
									<option value="0">No</option>
									<option value="1">Si</option>
								</select>
							</p>
							<input type="submit" name="crear" value="Crear">
						</form>
					</div>
						</br>
					 <?php 
					}
					else
					{
						header("Location: admin_editarEvaluaciones.php");
					}
				}
				if(isset($_POST["nombre"]) && isset($_POST["activo"]))
				{
					agregarExamen($_POST["nombre"], $_POST["descripcion"], $_SESSION["ex_idMateria"], 
								  $_SESSION["ex_tiempo"], $_POST["activo"], $_SESSION["ex_cantidadEncuestados"], 
								  $_SESSION["ex_idCliente"], $_SESSION["ex_id"]);
					header("Location: admin_evaluaciones.php");
				}
			?>
			
			</div>
		</div>
<?php include("basics/footer.php"); ?>