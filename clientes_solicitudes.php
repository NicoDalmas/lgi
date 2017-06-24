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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>
	<?php include("basics/header.php") ?>
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
				<h2>Pedidos Pendientes</h2>
				<center>
					<table class="tblPromos" id="tblPromos" style="visibility:visible;">
						<tr>
							<td>Id Pedido</td>
							<td>Materia</td>
							<td>Tipo</td>
							<td>Tiempo</td>
							<td>Comentarios</td>
							<td>Cantidad de Encuestados</td>
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