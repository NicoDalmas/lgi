<head>
  <?php include("basics/header.php") ?>	
  <link rel="stylesheet" href="css/3d.css">
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






				<div class="container">
<div class="row">

<div class="col-md-3 col-sm-6 col-xs-12 nb-service-block">
<div class="nb-service-block-inner">
<div class="nb-service-front">
<div class="front-content">
	<i class="fa fa-phone-square" aria-hidden="true"></i>
    <h3>Teléfono</h3>
</div>
</div>

<div class="nb-service-back">
<div class="back-content">
    <h3>Teléfono</h3>
    <p>153796796</p>
    <p>4614259</p>
</div>
</div>
</div>
</div>


<div class="col-md-3 col-sm-6 col-xs-12 nb-service-block">
<div class="nb-service-block-inner">
<div class="nb-service-front">
<div class="front-content">
    <i class="fa fa-home" aria-hidden="true"></i>
    <h3>Dirección</h3>
</div>
</div>

<div class="nb-service-back">
<div class="back-content">
    <h3>Dirección</h3>
    <p>Bv. Oroño 2400</p>
</div>
</div>
</div>
</div>


<div class="col-md-3 col-sm-6 col-xs-12 nb-service-block">
<div class="nb-service-block-inner">
<div class="nb-service-front">
<div class="front-content">
   <i class="fa fa-envelope-o" aria-hidden="true"></i>
    <h3>Correo Electrónico</h3>
</div>
</div>

<div class="nb-service-back">
<div class="back-content">
    <h3>Email</h3>
    <p>info@examinar.com</p>
</div>
</div>
</div>
</div>



<div class="col-md-3 col-sm-6 col-xs-12 nb-service-block">
<div class="nb-service-block-inner">
<div class="nb-service-front">
<div class="front-content">
    <i class="fa fa-home" aria-hidden="true"></i>
    <h3>Formulario</h3>
</div>
</div>

<div class="nb-service-back">
<div class="back-content">
    <h3>Formulario</h3>
    <p>Podes completar el formulario a continuación para escribirnos directamente!</p>
</div>
</div>
</div>
</div>


</div>
</div>



		<div id="content">
		<div class="content_item">
		<div class="container" align="center">
		<div class="jumbotron">	
			<form name="frmContacto" onsubmit="return arroba()" action="mailto:ndalmas9@gmail.com" method="post" enctype="text/plain">	
			<div class="form_settings">
			
				<h2>Formulario</h2>
							<p>Mediante este formulario podés comunicarte con nosotros. Se te responderá a la brevedad.</p>
							<table class="table table-striped">
								<tr>
									<td>
										<p><span>Nombre</span><br/>
										<input type="text" name="contacto_nombre" value="" class="form-control" /></p>
									</td>
								</tr>
								<tr>
									<td>
										<p><span>Email</span><br/>
										<input type="text" name="contacto_email" value="" class="form-control" /></p>
									</td>
								</tr>
								<tr>
									<td>
										<p><span>Tipo de Consulta</span><br/>
										<select name="contacto_tipodeconsulta" class="form-control">
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
										<textarea class="form-control" rows="8" cols="50" name="contacto_mensaje"></textarea></p>
									</td>
								</tr>
								<tr>
									<td>
										<div class="botones">
											<center>
												<input class="btn btn-alert" type="reset" value="Limpiar" />
												<input class="btn btn-primary" type="submit" name="contact_submitted" value="Enviar" />
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
