<style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 50%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
</style>

<head>
	<?php include("basics/header.php") ?>	
</head>

<body>
	<!--div id="main"-->
		<div id="header">
			<div id="banner">
				<?php include("basics/sesion.php") ?>
				<?php include("basics/menu.php") ?>		
			</div>	
		</div>
		<div class="container-fluid text-center">    
		  <div class="row content">
			<div class="col-sm-2 sidenav">
			</div>
			<div class="col-sm-8 text-center">
				<div class="well">
					<h3>Gobierno de Santa Fe (Transito)</h3>
					<img src="images/gobiernosantafe.jpg" />
				</div>
				<div class="well">
					<h3>Universidad de Palermo</h3>
					<img src="images/UniversidaddePalermo.jpg" />
				</div>
				<div class="well">
					<h3>Open English</h3>
					<img src="images/openenglish.jpg" />
				</div>
				<div class="well">
					<h3>Universidad de Chile</h3>
						<img src="images/universidaddechile.jpg" />
				</div>
			</div>
			<div class="col-sm-2 sidenav">
			  
			</div>
		  </div>
		</div>
	
	<?php include("basics/footer.php"); ?>
