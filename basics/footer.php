	<?php include("basics/content_grey.php"); ?>
	<footer>
		<div id="footer_container">
			<div id="footer">
				<a href="home.php">Inicio</a> | 
				<a href="clientes.php">Nuestros Clientes</a> | 
				<a href="ofertas.php">Ofertas</a> | 
				<a href="contacto.php">Contacto</a> 
			<div id="copyright">
				Equipo 33GMR © Todos los derechos reservados
			</div>
			<br>
			<div>
				<a href="https://www.facebook.com/pages/Examinar/492311657558346" title="Encuéntranos en Facebook"><img src="images/facebook.png"></a>
				<a href="https://twitter.com/@ExaminAR"><img src="images/twitter.png" title="Síguenos en Twitter"></a>
			</div>
			</div>
		</div>
	</footer>
	
</body>
</html>
<?php
	if (isset ($conexion)) {
		mysql_close ($conexion);
	}	
?>