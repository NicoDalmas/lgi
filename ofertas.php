<?php include("basics/header.php") ?>	

<body>
	
				<?php include("basics/menu.php") ?>
				<?php include("basics/functions.php") ?>				
			
		<div id="site_content">		
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
