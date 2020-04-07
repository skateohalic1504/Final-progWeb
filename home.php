<?php 
include('functions.php');

if (!isAdmin()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: login.php");
}

function isAdmin()
{
	if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin' ) {
		return true;
	}else{
		return false;
	}
}

require 'query.php'
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<style>
	.header {
		background: #003366;
	}
	button[name=register_btn] {
		background: #003366;
	}
    </style>
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
	        <a class="nav-link" href="index.php">Home</a>
		  </li>
		  <li class="nav-item">
	        <a class="nav-link" href="Carpeta About Us - Proyecto Final/index.html">Sobre Nosotros</a>
	      </li>
	      
          <li class="nav-item">
            <a class="nav-link" href="create_user.php">Agregar usuario</a>
		  </li>
		  <li class="nav-item">
			  <a class="nav-link" href="Formulario.php">Agregar Caso</a>
		  </li>
	      <li class="nav-item">
	        <a class="nav-link" href="home.php?logout='1'" style="color: red;">Logout</a>
          </li>
	    </ul>
	  </div>
	</nav>
	</header>

<!-- Header text -->
    <div class="header">
		<h2>Admin - Home Page</h2>
	</div>
	<div class="content">
		<!-- notification message -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h3>
					<?php 
						echo $_SESSION['success']; 
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>

		<!-- logged in user information -->
		<div class="profile_info">
			<img src="images/admin_profile.png"  >

			<div>
				<?php  if (isset($_SESSION['user'])) : ?>
					<strong><?php echo $_SESSION['user']['username']; ?></strong>

					<small>
						<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
						<br>
                       
					</small>

				<?php endif ?>
			</div>
		</div>
    </div>

	<div class="container">
		<div class="section">
			<h3 style="font-size: 50px;">Mapa de Casos</h3>
		</div>
		<div class="section">
			<div id='map' style='width: 100%; height: 600px;'></div>
			<script src="index.js">
			
			</script>
		</div>
		
		<table class="table">
			<thead>
				<tr>
					<h4>Casos Registrados</h4>
					<th>Cedula</th>
					<th>Nombre</th>
					<th>Apellido</th>
					<th>Pais</th>
					<th>Ciudad</th>
					<th>Fecha</th>
					<th>Latitud</th>
					<th>Longitud</th>
					<th>Acciones</th>
				</tr>
			</thead>

			<tbody id="datos">
			<?php
			foreach ($query as $row) { ?>
				<tr>
					<td><?php echo $row['cedula']; ?></td>
					<td><?php echo $row['nombre']; ?></td>
					<td><?php echo $row['apellido']; ?></td>
					<td><?php echo $row['pais']; ?></td>
					<td><?php echo $row['ciudad']; ?></td>
					<td><?php echo $row['fecha']; ?></td>
					<td><?php echo $row['latitud']; ?></td>
					<td><?php echo $row['longitud']; ?></td>
					<td><a class="btn btn-danger" href="delete.php?Cedula=<?php echo $row['cedula']; ?>">Borrar</a></td>
					
				</tr>
			</tbody>

			<?php
			 }
			 ?>
		</table>
                </br>
	</div>
			<script>
			map.on('load',function(){
					
						
							map.addSource('places',{
								'type': 'geojson',
								'data':{
									'type': 'FeatureCollection',
									'features': [
									<?php foreach($query as $row){?>
										{
											'type':'Feature',
											'properties': {
												'description':
												'Cedula: <?php echo $row['cedula'] ?> </br> Nombre: <?php echo $row['nombre'] ?> </br> Fecha: <?php echo $row['fecha'] ?> ',
												'icon': 'rocket'
											},
											'geometry':{
												'type': 'Point',
												'coordinates': [<?php echo $row['latitud'] ?>, <?php echo $row['longitud'] ?> ]
											}
										
										<?php 
										}

										?>,
										
										
									]
								
							}
							}); 
				}
				 

	
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

</body>
</html>