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

<body>
					<?php include("basics/menu_admin.php") ?>		
					<?php include("basics/functions.php") ?>	

				<h2>Pedidos Pendientes</h2>
				<center>
					<div class="table-responsive">
						<table class="table table-bordered" id="tblPromos" style="visibility:visible;">
						<tr>
							<th>Id Pedido</th>
							<th>Materia</th>
							<th>Tipo</th>
							<th>Tiempo</th>
							<th>Comentarios</th>
							<th>Cantidad de Encuestados</th>
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
										  "<td>" . $pedido['cantidadEncuestados'] . "</td>";
								echo "</tr>";
							}
						?>
					</table>
					</br>
				</center>
			</div>
		</div>
<?php include("basics/footer.php"); ?>