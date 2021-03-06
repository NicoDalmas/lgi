﻿<?php require_once("basics/session.php"); ?>
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
	<script languaje="javascript">
		function validar()
		{
			titulo=document.frmPromos.nuevoTitulo.value
			descripcion=document.frmPromos.nuevoDescripcion.value
			precio=document.frmPromos.nuevoPrecio.value
			if (titulo.length<=9)
			{
				alert("El título debe tener al menos 10 caracteres.")
				document.frmPromos.nuevoTitulo.focus()
				return false
			}
			if (descripcion.length<=49)
			{
				alert("La descripción debe ser de al menos 50 caracteres.")
				document.frmPromos.nuevoDescripcion.focus()
				return false
			}
			if (precio<0)
			{
				alert("El precio debe ser mayor que 0.")
				document.frmPromos.nuevoPrecio.focus()
				return false
			}
		}
		function validarEditar()
		{
			titulo=document.frmModificarPromo.tituloModificado.value
			descripcion=document.frmModificarPromo.descripcionModificado.value
			precio=document.frmModificarPromo.precioModificado.value
			if (titulo.length<=9)
			{
				alert("El título debe tener al menos 10 caracteres.")
				document.frmModificarPromo.tituloModificado.focus()
				return false
			}
			if (descripcion.length<=49)
			{
				alert("La descripción debe ser de al menos 50 caracteres.")
				document.frmModificarPromo.descripcionModificado.focus()
				return false
			}
			if (precio<0)
			{
				alert("El precio debe ser mayor que 0.")
				document.frmModificarPromo.precioModificado.focus()
				return false
			}
		}
		function ocultarTabla()
		{
			var tabla = document.getElementById("tblPromos");
			tabla.style.visibility = "hidden";
		}
	</script>


<body>
	
		<?php include("basics/menu_admin.php") ?>
		<?php include("basics/functions.php") ?>					
				
		
		<div id="site_content">	
			<div>
				</br>
				<b><h2><center>Promociones Vigentes</b></h2></center>
				<?php
					if(isset($_REQUEST['editarPromo'])) 
					{
						$promo = buscarPromo($_REQUEST['editarPromo']);
						echo '<p><b>Editar Promoción</b></p>';
						?>
						<form name="frmModificarPromo" method="post" onsubmit="return validarEditar()" action="admin_promos.php">
							<p>ID: <input type="text" style="width:35px;" name="idModificado" value="<?php echo $promo['id'] ?>" readonly></p>
							<p>Título: <input type="text" style="width:400px;" name="tituloModificado" maxlength="80" value="<?php echo $promo['titulo'] ?>"></p>
							<p>Descripción:</p> <p><textarea type="text" style="height:150px; width:440px; font-family:Verdana; font-size:12px; resize:none;" maxlength="500" name="descripcionModificado"><?php echo $promo['descripcion']; ?></textarea></p>
							<p>Precio: <input type="text" style="width:35px;" name="precioModificado" maxlength="4" value="<?php echo $promo['precio'] ?>"></p>
							<input type="submit" name="modificar" value="Editar">
						</form>
						<?php	  
					}
					else
					{
				?>
				<center>
					<table class="table table-striped" id="tblPromos" style="visibility:visible;">
						<tr>
							<th>Id</th>
							<th>Título</th>
							<th>Descripción</th>
							<th>Precio</th>
							<th>Editar</th>
							<th>Eliminar</th>
						</tr>
						<?php
							$promociones=l_promociones();
							while($promo = mysql_fetch_array($promociones))
							{	
								echo "<tr>";
								echo      "<td>" . $promo['id'] . "</td>" .
										  "<td>" . $promo['titulo'] . "</td>" .
										  "<td>" . $promo['descripcion'] . "</td>" .
										  "<td>" . $promo['precio'] . "</td>" .
										  "<td><a href='?editarPromo=" . $promo['id'] . "'> <button type='button' class='btn btn-warning'>
	    <span class='glyphicon glyphicon-edit'></span>  Editar  </button></a></td>" . 
										  "<td><a href='?eliminarPromo=" . $promo['id'] . "'> <button type='button' class='btn btn-danger'>
	    <span class='glyphicon glyphicon-trash'></span>  Eliminar  </button> </a></td>";
								echo "</tr>";
							}
							if (isset($_REQUEST['eliminarPromo'])) 
							{
								eliminarPromo($_REQUEST['eliminarPromo']);
							}
						?>
						<tr>
							<form name="frmPromos" method="post" onsubmit="return validar()" action="admin_promos.php">
								<td></td>
								<td><textarea class="form-control" type="text"  maxlength="80" name="nuevoTitulo"></textarea></td>
								<td><textarea class="form-control" type="text"  maxlength="500" name="nuevoDescripcion"></textarea></td>
								<td><input class="form-control"  type="text" maxlength="4" style="height:50px;" name="nuevoPrecio"></td>
								<td><button type="submit" name="agregar" class="btn btn-success btn-lg">
	    <span class="glyphicon glyphicon-plus"></span>  Agregar Promoción  </button></td>
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
				 	if(isset($_POST["nuevoTitulo"]) && isset($_POST["nuevoDescripcion"]) && isset($_POST["nuevoPrecio"]))
					{
						$titulo=$_POST["nuevoTitulo"];
						$descripcion=$_POST["nuevoDescripcion"];
						$precio=$_POST["nuevoPrecio"];
						agregarPromo($titulo, $descripcion, $precio);
					}
					if(isset($_POST["idModificado"]) && isset($_POST["tituloModificado"]) && isset($_POST["descripcionModificado"]) && isset($_POST["precioModificado"]))
					{
						$id=$_POST["idModificado"];
						$titulo=$_POST["tituloModificado"];
						$descripcion=$_POST["descripcionModificado"];
						$precio=$_POST["precioModificado"];
						editarPromo($id, $titulo, $descripcion, $precio);
					}
				?> 
			</div>
		</div>
<?php include("basics/footer.php"); ?>