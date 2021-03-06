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
	<?php include("basics/menu.php") ?>	
	<?php include("basics/sesion.php") ?>
		<div class="container-fluid text-center">    
			<div class="row content">
				<div class="col-sm-2 sidenav">
           <p><a href="/lgi/contacto.php"><button type='button' class='btn btn-info'>Dejanos tu consulta<br><span class='glyphicon glyphicon-question-sign'></span></button></a></p>
			 </div>
				<div class="col-sm-8 text-left">
				<!--?php include("basics/slider.php") ?-->
					<center><h1><b>Innovamos en Educación</b></h1></center>
					<p>Nuestra empresa esta dedicada a la venta de servicios de evaluaciones en línea o fuera de línea. Desde nuestras oficinas ubicadas en la ciudad de Rosario, Santa Fe, Argentina, somos una de las empresas líderes de la región. Contamos con una amplia experiencia de desarrollo web que nos permite exponer nuestros exámenes de todo tipo de rubros de manera transparente y precisa, ajustadas a los requerimientos que el interesado desee. </p>
					<p>Ofrecemos asistencia personalizada a la necesidad de los solicitantes. Entregamos calidad en cada uno de nuestros servicios. Brindamos asesoría sobre los objetivos particulares de nuestros usuarios y, los acompañamos a alcanzar el producto ideal para su organización.</p>
					<p>Valoramos la confianza que depositan en nosotros. Es por eso que nuestras políticas nos permiten generar una relación totalmente confidencial con nuestros usuarios y su información. Proveemos a nuestro sitio de la más alta seguridad para proteger los datos contra cualquier amenaza.</p>
					<p>Nuestra visión es ampliar nuestros servicios a una mayor cantidad de clientes, tanto dentro como fuera del país. Queremos ser la empresa más elegida por calidad, servicio y asesoría de todas. A tal punto, deseamos incorporar nuevos e innovadores productos en el mercado para alcanzar nuestro objetivo.</p>
					<p>¡Te esperamos en tu próximo proyecto!</p>
           <center><img src="images/comrpomiso.jpg" class="img-responsive"/></center>
				</div>

				<div class="col-sm-2 sidenav">
          <div class="well">
          <img src="images/exam.jpg" class="img-responsive"/>
        </div>
				  <div class="well">
					<p>Inscribite a nuestra convención de fin de año!</p>
				  </div>
				  <div class="well">
					<p>Consultá por nuestra Agenda de Eventos</p>
          </div>
           <div class="well">
          <img src="images/edutec.png" class="img-responsive"/>
        </div>
        
				</div>
			</div>
		</div>
		<!--/div-->
		 <div id="map"></div>
    <script>
      // Note: This example requires that you consent to location sharing when
      // prompted by your browser. If you see the error "The Geolocation service
      // failed.", it means you probably did not give permission for the browser to
      // locate you.

      function initMap() {
      
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -32.942186, lng: -60.653147},
          zoom: 14
        });
        var infoWindow = new google.maps.InfoWindow({map: map});

        // Try HTML5 geolocation.
        /*
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            infoWindow.setPosition(pos);
            infoWindow.setContent('Tu ubicación');
            map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
        */
          var urquiza = {lat: -32.942186, lng: -60.653147};
          var marker = new google.maps.Marker({
          position: urquiza,
          map: map
        }); 

        
      }

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCK-bhMXVFu03tdwWf-rzizL-EDtYuY-h0&callback=initMap">
    </script>
	<?php include("basics/footer.php"); ?>
