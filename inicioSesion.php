<?php require_once("basics/session.php"); ?>
<?php require_once("basics/connection_db.php"); ?>
<?php require_once("basics/functions.php"); ?>

<?php
	if(isset($_SESSION["username"]))
	{
		header("Location: home.php");
		exit();
	}
?>
<?php
	if(isset($_POST["username"]))
	{
		$errores = array();
		$errores = array_merge($errores, validarCamposObligatorios(array("username", "password")));
		$max_caracteres = array("username" => 20, "password" => 20);
		foreach($max_caracteres as $campo => $max)
		{
			if(strlen($_POST[$campo]) > $max)
			{
				$errores[] = $campo;
			}
		}
		$username = trim($_POST["username"]);
		$password = trim($_POST["password"]);
		if(empty($errores))
		{
			$consulta = "SELECT * 
						 FROM usuarios 
						 WHERE username = '{$username}' 
						 AND password = '{$password}' 
						 LIMIT 1";
			$resultado = mysql_query($consulta, $conexion);
			if(mysql_affected_rows() == 1)
			{
				$usuario = mysql_fetch_array($resultado);
				if ( $usuario["idAcceso"]==1 )
				{
					$_SESSION["usuario_permiso"] = $usuario["idAcceso"];
					$_SESSION["alumno_id"] = $usuario["id"];
					$_SESSION["username"] = $usuario["username"];
					$_SESSION["alumno_email"] = $usuario["email"];
					$_SESSION["alumno_dni"] = $usuario["dni"];					
					$_SESSION["alumno_nombre"] = $usuario["nombre"];
					$_SESSION["alumno_apellido"] = $usuario["apellido"];	
					$_SESSION["alumno_sexo"] = $usuario["sexo"];			
					header("Location: alumno.php");
					exit();
				}
				if ( $usuario["idAcceso"]==2 )										//ARREGLAR DE IGUAL FORMA QUE ALUMNOS TRAYENDO LOS DATOS NECESARIOS QE UTILIZAREMOS
				{
					$_SESSION["username"] = $_POST["username"];
					$_SESSION["usuario_permiso"] = $usuario["idAcceso"];
					$_SESSION["tipo"] = "Cliente";
					$_SESSION["cliente_id"] = $usuario["id"];
					$_SESSION["cliente_razon"] = $usuario["razon"];
					header("Location: clientes_pagos.php");
					exit();
				}
				if ( $usuario["idAcceso"]==3 )
				{
					$_SESSION["username"] = $_POST["username"];
					$_SESSION["usuario_id"] = $usuario["id"];
					$_SESSION["usuario_permiso"] = $usuario["idAcceso"];
					$_SESSION["tipo"] = "Administrador";
					header("Location: admin.php");
					exit();
				}
				if ( $usuario["idAcceso"]==4 )
				{
					$_SESSION["username"] = $_POST["username"];
					$_SESSION["usuario_id"] = $usuario["id"];
					$_SESSION["usuario_permiso"] = $usuario["idAcceso"];
					$_SESSION["tipo"] = "Admin";
					header("Location: admin.php");
					exit();
				}
			}
			else
			{
				$mensaje = "Usuario y/o contraseña incorrectos. Ingrese nuevamente.";
			}
		}
		else
		{
			$mensaje = "Uno o ambos campos están vacíos.";
		}
	}
?>
<head>
	<?php include("basics/header.php") ?>	
</head>

<body>
	<div id="main">
		<div id="header">
			<div id="header">
				<div id="banner">
					<?php include("basics/menu.php") ?>
					<?php include("basics/sesion.php") ?>						
				</div>	
			</div>	
		</div>	
		<div id="site_content">		
			<div id="content">
				<div class="content_item">
					<form name="frmContacto" method="post">	
						<div class="form_settings">
							<h1>Iniciar Sesión</h1>
							<table class="tbliniciosesion">
								<tr>
									<td>
										<p><span>Usuario</span><br/>
										<input class="contact" type="text" name="username" /></p>
									</td>
								</tr>
								<tr>
									<td>
										<p><span>Contraseña</span><br/>
										<input class="contact" type="password" name="password" /></p>
									</td>
								</tr>
								<tr>
									<td>
										<?php if(isset($mensaje)) { echo "<p>" . $mensaje . "</p>"; } ?>
									</td>
								</tr>			
								<tr>
									<td>
										<br/>
											<a>¿Has olvidado tu usuario y/o contraseña?</a><br/>
										<br/>
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
	</div>
	<?php include("basics/footer.php"); ?>