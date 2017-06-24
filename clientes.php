<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>
	<?php include("basics/header.php") ?>	
</head>

<body>
	<div id="main">
		<div id="header">
			<div id="banner">
				<?php include("basics/logo.php") ?>	
				<?php include("basics/sesion.php") ?>
				<?php include("basics/menu.php") ?>		
			</div>	
		</div>
		
		<div id="site_content">		
			<?php include("basics/slider.php") ?>	       
			<div id="content">
				<div class="content_item">
					<h2>Nuestros Clientes</h2>
					<div class="content_container">
						<h3>Gobierno de Santa Fe (Transito)</h3>
						<img src="images/gobiernosantafe.jpg" />
					</div>
					<div class="content_container">
						<h3>Universidad de Palermo</h3>
						<img src="images/UniversidaddePalermo.jpg" />
					</div>
					<div class="content_container">
						<h3>Open English</h3>
						<img src="images/openenglish.jpg" />
					</div>
					<div class="content_container">
						<h3>Universidad de Chile</h3>
						<img src="images/universidaddechile.jpg" />
					</div>
				</div>
			</div> 
		</div>
	<?php include("basics/footer.php"); ?>
