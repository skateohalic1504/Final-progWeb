<?php require 'mapquery.php' ?>

<!DOCTYPE html>
<html>
<head>
	<title>COVID-19 Counttry Tracker Rep. Dom.</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="styleIndex.css">
	<!-- Mapbox -->
	<script src='https://api.mapbox.com/mapbox-gl-js/v1.8.1/mapbox-gl.js'></script>
	<link href='https://api.mapbox.com/mapbox-gl-js/v1.8.1/mapbox-gl.css' rel='stylesheet' />
</head>
<body>

<!-- Pagina Principal -->
<!-- Nav Bar -->

<header>
		<nav class="navbar navbar-expand-md navbar-dark bg-dark">
	  <a class="navbar-brand" href="index.html">COVID-19</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
	    <ul class="navbar-nav ml-auto">
	      <li class="nav-item active">
	        <a class="nav-link" href="index.html">Home</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="home.php">Area Admin</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="Carpeta About Us - Proyecto Final/index.html">Sobre Nosotros</a>
	      </li>
	    </ul>
	  </div>
	</nav>
	</header>

<!-- Header text -->

	<div id="bannerimage">
		<h1>COVID-19 Tracker</h1>
		<!--<button class="btn btn-dark">Learn More</button>-->
	</div>

	<div class="container">
		<div class="tittle">
				<h2 id="tittle1">Que es?</h2>
		</div>
		<hr id="line">

		<div class="row">
			<div class="col">
				<img id="imgC" src="img/coronovirus.jpg">
			</div>
			<div id="definicion" class="col">
				<p>Los coronavirus son una familia de virus que pueden causar enfermedades como el resfriado com&uacute;n, el s&iacute;ndrome respiratorio agudo grave (SARS, por sus siglas en ingl&eacute;s), y el s&iacute;ndrome respiratorio de Oriente Medio (MERS, por sus siglas en ingl&eacute;s). En 2019 se identific&oacute; un nuevo coronavirus como la causa de un brote de enfermedades que se origin&oacute; en China.
				<small><a target="_blank" href="https://www.mayoclinic.org/es-es/diseases-conditions/coronavirus/symptoms-causes/syc-20479963">Mas Informacion</a></small>
				</p>
			</div>
			<hr id="line">
		</div>

		<div class="section">
			<h3 style="font-size: 50px;">Mapa de Casos</h3>
		</div>
		<div class="section">
			<div id='map' style='width: 100%; height: 600px;'></div>
			<script src="index.js">
			
			</script>
		</div>
	</div>


	<script>

mapboxgl.accessToken = 'pk.eyJ1Ijoic2thdGVvaGFsaWMxNTA0IiwiYSI6ImNrOG5jbWZjMTBzbXkzbXBzNXc2ajNyaXcifQ.9cboPzPcoNeS-CllveacJg';
			var map = new mapboxgl.Map({
			container: 'map',
			style: 'mapbox://styles/mapbox/streets-v11',
			center: [-70.1654584, 18.7009047],
			zoom: 8
			});


			

			map.on('load',function(){
				
					map.addSource('places',{
						'type': 'geojson',
						'data':
							<?php echo json_encode($feature); ?>
						}); 


				 

	
	map.addLayer({
		'id':'places',
		'type': 'symbol',
		'source': 'places',
		'layout':{
			'icon-image':'{icon}-15',
			'icon-allow-overlap': true
		}
	});
	map.on('click', 'places', function(e) {
		var coordinates = e.features[0].geometry.coordinates.slice();
		var description = e.features[0].properties.description;
		 
		// Ensure that if the map is zoomed out such that multiple
		// copies of the feature are visible, the popup appears
		// over the copy being pointed to.
		while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
		coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
		}
		 
		new mapboxgl.Popup()
		.setLngLat(coordinates)
		.setHTML(description)
		.addTo(map);
		});
		// Change the cursor to a pointer when the mouse is over the places layer.
map.on('mouseenter', 'places', function() {
	map.getCanvas().style.cursor = 'pointer';
	});
	 
	// Change it back to a pointer when it leaves.
	map.on('mouseleave', 'places', function() {
	map.getCanvas().style.cursor = '';
	});

});
			
    		</script>
			<div class="section">
			<h3 style="font-size: 50px;">Noticias</h3>
		</div>
		<script type="text/javascript" src="https://www.24-7pressrelease.com/js/newsfeed.js"></script>
	<script type="text/javascript" src="https://www.24-7pressrelease.com/js/js_press_releases.php?category_id=205&limit=20"></script>
	<script type="text/javascript">
	js_style = 1;
	target = "_blank";
	if (newsfeed){
		showNews(newsfeed, js_style);
	} else {
		document.write("News feeds did not import correctly. Please contact the 24-7 pressrelease administrators");
	}
	</script>
	</div>
	<section>
	
		<div class="tittle">
			<h3 id="tittle1">Unete a nuestro grupo de Telegram!</h3>
		</div>
		<div class="text-center">
		<button class="btn-primary" onclick="window.location.href = 'https://t.me/joinchat/PVYfDBumWYYSi7qTMWe4ww';">Telegram</button>
		</div>

	</section>

	<section>
		<div class="tittle">
			<h3 id="tittle1">Agradecimientos</h3>
		</div>
		<div class="text-center">
		<p>
			Agradecemos a todas las personas trabajando para detener el COVID 19 y a todas las personas realizando actividades medicas y/o sanitarias para atender a los pacientes.
		</p>
	</div>
	</section>

</body>
</html>
