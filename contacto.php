<head>
  <?php include("basics/header.php") ?>	
  <?php
    $digit1 = mt_rand(1,20);
    $digit2 = mt_rand(1,20);
    if( mt_rand(0,1) === 1 )
	{
        $math = "$digit1 + $digit2";
        $_SESSION['answer'] = $digit1 + $digit2;
    } 
	else 
	{
        $math = "$digit1 - $digit2";
        $_SESSION['answer'] = $digit1 - $digit2;
    }
    ?>
  <script>
  function arroba()
	{
		cuenta=0
		cuenta2=0
		mail=document.frmContacto.contacto_email.value
		nombre=document.frmContacto.contacto_nombre.value
		textoarea=document.frmContacto.contacto_mensaje.value
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
			document.frmContacto.contacto_email.focus()
			return false
		}
		if (nombre.length<=3)
		{
			alert("Nombre demasiado corto.")
			document.frmContacto.contacto_nombre.focus()
			return false
		}
		if (textoarea.length<=10)
		{
			alert("Texto demasiado corto.")
			document.frmContacto.contacto_mensaje.focus()
			return false
		}

	}
  </script>
</head>

<body>
	
	<?php include("basics/sesion.php") ?>
	<?php include("basics/menu.php") ?>		
		<div id="content">
		<div class="content_item">
		<div class="container" align="center">
		<div class="jumbotron">	
			<form name="frmContacto" onsubmit="return arroba()" action="mailto:examinar@outlook.com" method="post" enctype="text/plain">	
			<div class="form_settings">
			<?php include("basics/comunicar.php"); ?>
				<h2>Contactosss</h2>
							<p>Mediante este formulario podés comunicarte con nosotros. Se te responderá a la brevedad.</p>
							<table class="table table-striped">
								<tr>
									<td>
										<p><span>Nombre</span><br/>
										<input type="text" name="contacto_nombre" value="" /></p>
									</td>
								</tr>
								<tr>
									<td>
										<p><span>Email</span><br/>
										<input type="text" name="contacto_email" value="" /></p>
									</td>
								</tr>
								<tr>
									<td>
										<p><span>Tipo de Consulta</span><br/>
										<select name="contacto_tipodeconsulta">
											<option selected="selected" value="General">General</option>
											<option value="Promociones">Promociones</option>
											<option value="Administracion">Administracion</option>
											<option value="Otros">Otros</option>
										</select></p>
									</td>
								</tr>
								<tr>
									<td>
										<p><span>Mensaje</span><br/>
										<textarea class="contact textarea" rows="8" cols="50" name="contacto_mensaje"></textarea></p>
									</td>
								</tr>
								<tr>
									<td>
										<div class="botones">
											<center>
												<input class="submit" type="reset" value="Limpiar" />
												<input class="submit" type="submit" name="contact_submitted" value="Enviar" />
											</center>
										</div>
									</td>
								</tr>
							</table>
						</div>
					</form>
				</div>
			</div> 
		</div>
	</div></body>
	<?php include("basics/footer.php"); ?>
