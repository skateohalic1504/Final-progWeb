<?php 
include('../functions.php');

if (!isAdmin()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ../login.php');
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: ../login.php");
}

function isAdmin()
{
	if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin' ) {
		return true;
	}else{
		return false;
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="../css/styles.css">
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
	<link rel="stylesheet" type="text/css" href="../styleIndex.css">
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
	        <a class="nav-link" href="../index.html">Home</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="home.php?logout='1'" style="color: red;">Logout</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="create_user.php">Agregar usuario</a>
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
			<script src="../index.js">
			
			</script>
        </div>
                </br>
	</div>

</body>
</html>