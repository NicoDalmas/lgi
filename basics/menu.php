<?php require_once("basics/session.php"); ?>

<div id="menubar">
	
		
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
	
</div>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="home.php">Inicio</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="clientes.php">Nuestros Clientes</a></li>
        <li><a href="productos.php">Productos</a></li>
        <li><a href="ofertas.php">Promociones</a></li>
		<li><a href="contacto.php">Contacto</a></li>
      </ul>
	    <ul class="nav navbar-nav navbar-right">
	        <li><a href="inicioSesion.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
	        <li><a href="registrarse.php"><span class="glyphicon glyphicon-plus-sign"></span> Registrarse</a></li>
		</ul>
    </div>
  </div>
</nav>
