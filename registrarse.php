<?php require_once("basics/session.php"); ?>
<?php
	if(isset($_SESSION["username"]))
	{
		header("Location: home.php");
		exit();
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>
	<?php include("basics/header.php") ?>
	<link rel="stylesheet" href="css/jquery-ui.css">
	<script src="js/jquery.js"></script>
	<script src="js/jquery-ui.js"></script>
	<script>
	//Funciones de jquery para mostrar calendario en el casillero de la fecha, se llama con el id=datepicker, esta configurado para el español y para especificamente seleccionar fecha de nacimiento.
	$(function () {
        $("#datepicker").datepicker({
			dateFormat : 'dd/mm/yy',
            changeMonth: true,
            changeYear: true,
            yearRange: '-100:+0'
			
        });
		$.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '<Ant',
        nextText: 'Sig>',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
        weekHeader: 'Sm',
        dateFormat: 'dd/mm/yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
		};
		$.datepicker.setDefaults($.datepicker.regional['es']);
    });
	//Validar formulario
	function validar()
	{
		cuenta=0
		cuenta2=0
		mail=document.frmRegistro.correo.value
		nombre=document.frmRegistro.nombre.value
		apellido=document.frmRegistro.apellido.value
		respuesta=document.frmRegistro.respuesta.value
		usuario=document.frmRegistro.usuario.value
		clave1=document.frmRegistro.clave1.value 
		clave2=document.frmRegistro.clave2.value 
		if (usuario.length<=5)
		{
			alert("El usuario debe contener al menos 6 caracteres.")
			document.frmRegistro.usuario.focus()
			return false
		}
		if (clave1.length<=7)
		{
			alert("La contraseña debe tener al menos 8 caracteres.")
			document.frmRegistro.clave1.focus()
			return false
		}
		else if (clave1!=clave2)
		{
			alert("La contraseña no coincide.")
			document.frmRegistro.clave1.focus()
			return false
		}
		if (nombre.length<=3)
		{
			alert("Nombre demaciado corto.")
			document.frmRegistro.nombre.focus()
			return false
		}
		if (apellido.length<=3)
		{
			alert("Apellido demaciado corto.")
			document.frmRegistro.apellido.focus()
			return false
		}
		for(i=0;i<mail.length;i++)
		{ 
			if (mail.charAt(i)==".")
			{
				cuenta=cuenta+1
			}
		}
		for(i=0;i<mail.length;i++)
		{ 
			if (mail.charAt(i)=="@")
			{
				cuenta2=cuenta2+1
			}
		}
		if(cuenta<1 || cuenta2!=1)
		{
			alert("Mail invalido")
			document.frmRegistro.correo.focus()
			return false
		}
		
		
		if (respuesta.length<=3)
		{
			alert("Respuesta demaciada corta.")
			document.frmRegistro.respuesta.focus()
			return false
		}
		
		
	}
	</script>
</head>

<body>
	<div id="main">
		<div id="header">
			<div id="header">
				<div id="banner">
					
					<?php include("basics/sesion.php") ?>
					<?php include("basics/menu.php") ?>						
				</div>	
			</div>	
		</div>	
		
		<div id="site_content">		
			<div id="content">
				<div class="content_item">
					<div class="container" align="center">
						<div class="jumbotron">	
					<form name="frmRegistro" method="post" onsubmit="return validar()" action="basics/registrar_usuario.php">	
						<div class="form_settings">
							
							<table class="table table-striped">
								<label for="exampleInputFile">Registrarse</label>
								<tr>
									<td>
										<p><span>Usuario *</span><br/>
										<input type="text" name="usuario" /></p>
									</td>
								</tr>
								<tr>
								<td>
																	
										<p><span>Razón Social ( Completar en el caso de un cliente )</span><br/>
										<input type="text" name="razon" /></p>
									</td>
								</tr>
								<tr>
									<td>
										<p><span>Contraseña *</span><br/>
										<input type="password" name="clave1" /></p>
									</td>
								</tr>
								<tr>
									<td>
										<p><span>Nombre *</span><br/>
										<input type="text" name="nombre" /></p>
									</td>
								</tr>
								<tr>
									<td>
										<p><span>Repita Contraseña *</span><br/>
										<input type="password" name="clave2" /></p>
									</td>
								<tr>	
									<td>
										<p><span>Apellido *</span><br/>
										<input type="text" name="apellido" /></p>
									</td>
								</tr>
								<tr>
									
									<td>
										<p><span>DNI *</span><br/>
										<input type="text" name="dni" /></p>
									</td>
								</tr>
								<tr>
									<td>
										<p><span>Alumno o Cliente*</span><br/>	</p>
										<div class="radio">
											  <label>
											    <input type="radio" name="tipo" id="radio" value="1" checked="checked">
											    Alumno
											  </label>
											  <label>
											    <input type="radio" name="tipo" id="radio" value="2">
											    Cliente
											  </label>
										</div>	
											
									
									</td>
								</tr>
								<tr>
									<td>
										<p><span>Fecha de Nacimiento *</span><br/>
										<input type="text" id="datepicker" /></p>
									</td>
								</tr>
								<tr>
									<td>
										<p><span>Correo Electrónico *</span><br/>
										<input type="text" name="correo" /></p>
									</td>
								</tr>
								<tr>
									<td>
										<p><span>Sexo *</span><br/>	</p>
										<div class="radio">
											  <label>
											    <input type="radio" name="sexo" id="radio" value="h" checked="checked">
											    Hombre
											  </label>
											  <label>
											    <input type="radio" name="sexo" id="radio" value="m">
											    Mujer
											  </label>
										</div>	  
											
									</td>
								</tr>
								<tr>
									<td>
										<p><span>Pregunta Secreta *</span><br/>
										<select>
											<option selected="selected" value="1">¿Cuál fue tu primera mascota?</option>
											<option value="2">¿Cuál es tu canción preferida?</option>
											<option value="3">¿Cuál es tu comida favorita?</option>
											<option value="4">¿Cuál es tu actor favorito?</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<p><span>Respuesta a Pregunta Secreta *</span><br/>
										<input type="text" name="respuesta" /></p><br/>
									</td>
								</tr>
							</table>
							<p style="margin-left: 20px;">Todos los campos con (*) son obligatorios.
							Ningún dato que usted brinde a este sitio será usado para otro fin
							que no sea uso interno de nuestro sitio.</p><br/>
							<center>
								<input class="btn btn-alert" type="reset" value="Limpiar" />
								<input class="btn btn-primary" type="submit" name="contact_submitted" value="Enviar" />
							</center>
						</div>
					</form>
				</div></p></td></tr></table></div></form></div>
			</div>
		</div>
	</div>
	<?php include("basics/footer.php"); ?>