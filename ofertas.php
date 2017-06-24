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
				<?php include("basics/functions.php") ?>				
			</div>	
		</div>
		
		<div id="site_content">		
			<?php include("basics/slider.php") ?>	       
			<div id="content">
				<div class="content_item">
					<h2>Promociones</h2>
					<?php
						$promociones=l_promociones();
						while($promo = mysql_fetch_array($promociones))
						{	
							echo "<div class='content_container'>";
							echo      "<h3>" . $promo['titulo'] . "</h3>" .
									"<p>" . $promo['descripcion'] . "</p>" .
									"<center><h2 style='font-size:30px;'>$" . $promo['precio'] . "</h2></center>";
							echo "</br></div>";
						}
					?>
				

				</div>
			</div> 
		</div>
	<?php include("basics/footer.php"); ?>
