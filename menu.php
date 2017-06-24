<?php require_once("basics/session.php"); ?>

<div id="menubar">
	<ul id="menu">
		<li class="current"><a href="home.php">Inicio</a></li>
		<li><a href="clientes.php">Nuestros Clientes</a></li>
		<li><a href="productos.php">Nuestros Productos</a></li>
		<li><a href="ofertas.php">Ofertas</a></li>
		<li><a href="contacto.php">Contacto</a></li>
		<?php
			if(isset($_SESSION["username"]))
			{
				if($_SESSION["usuario_permiso"] == 1)
				{
					echo '<li><a href="alumno.php">Menú Alumno</a></li>';			
				}
				elseif($_SESSION["usuario_permiso"] == 2)
				{
					echo '<li><a href="clientes_pagos.php">Menú Cliente</a></li>';
				}
				elseif($_SESSION["usuario_permiso"] == 3)
				{
					echo '<li><a href="admin.php">Menú Admin</a></li>';
				}
				elseif($_SESSION["usuario_permiso"] == 4)
				{
					echo '<li><a href="admin.php">Menú Admin</a></li>';
				}
			}
		?>
	</ul>
</div>
