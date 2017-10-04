<?php include("basics/header.php") ?>	

<body>
	
				<?php include("basics/menu.php") ?>
				<?php include("basics/functions.php") ?>				
			
		<center><img src="images/exam.jpg" class="img-circle" max-width: 100% height="300px" /></center>
					<h2><b>Promociones</b></h2>

					<div class="table-responsive">
					<table class="table table-hover">
					<?php
						$promociones=l_promociones();
						while($promo = mysql_fetch_array($promociones))
						{	
							echo "<tr><td> <div class='content_container'>";
							echo      "<h3>" . $promo['titulo'] . "</h3>" .
									"<p>" . $promo['descripcion'] . "</p>" .
									"<center><h2 style='font-size:30px;'>$" . $promo['precio'] . "</h2></center>";
							echo "</br></div></td></tr>";
						}
					?>
					</table>
				</div>
				</div>
			</div> 
		</div>
	<?php include("basics/footer.php"); ?>
