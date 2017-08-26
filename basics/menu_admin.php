<nav class="navbar navbar-inverse">
  <div class="container-fluid">
	<div class="collapse navbar-collapse" id="menubar">
		<ul class="nav navbar-nav">
		<?php
			if($_SESSION["usuario_permiso"]==1)
			{
				echo '<li><a href="alumno_evaluacion.php"> Mis Evaluaciones </a></li>';	
			}
			if($_SESSION["usuario_permiso"]==2)
			{
				echo '<li><a href="clientes_adquirir.php"> Adquirir Producto </a></li>';
				echo '<li><a href="clientes_solicitudes.php"> Pedidos Pendientes </a></li>';
				echo '<li><a href="clientes_productos.php"> Mis productos </a></li>';	
				echo '<li><a href="clientes_alumnos.php"> Mis alumnos </a></li>';
			}
			if($_SESSION["usuario_permiso"]==3)
			{
				echo '<li><a href="admin_materias.php"> Materias </a></li>';	
				echo '<li><a href="admin_evaluaciones.php"> Evaluaciones </a></li>';	
			}
			if($_SESSION["usuario_permiso"]==4)
			{
				echo '<li><a href="admin_materias.php"> Materias </a></li>';	
				echo '<li><a href="admin_evaluaciones.php"> Crear Exámenes </a></li>';
				echo '<li><a href="admin_editarEvaluaciones.php"> Editar Exámenes </a></li>';
				echo '<li><a href="admin_promos.php"> Promociones </a></li>';
				echo '<li><a href="admin_usuarios.php"> Usuarios </a></li>';	
			}
			?>	
			</ul>
			<ul class="nav navbar-nav navbar-right">				
		<li><a href="usuarios_cambiarPassword.php"> Cambiar Contraseña </a></li>

		<li><a href="basics/logout.php"><span class="glyphicon glyphicon-log-out"></span> Cerrar Sesion</a></li>
	    </ul>
	</div>
  </div>
</nav>