
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
<html lang="en">
<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title></title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>


<body>
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

        <form action="save.php" method="POST" style="margin-top: 20px;">
            <?php echo display_error(); ?>
            <legend>Registra tu caso</legend>
                <div class="input-group">
                    <label>Cedula</label>
                    <input type="text" name="Cedula" placeholder="Cedula"><br>
                </div>
                <div class="input-group">
                    <label>Nombre</label>
                <input type="text" name="Nombre" placeholder="Nombre"><br>
                </div>
                <div class="input-group">
                    <label>Apellido</label>
                <input type="text" name="Apellido" placeholder="Apellido"><br>
                </div>
                <div class="input-group">
                    <label>Pais</label>
                <input type="text" name="Pais" placeholder="Pais"><br>
                </div>
                <div class="input-group">
                    <label>Ciudad</label>
                <input type="text" name="Ciudad" placeholder="Ciudad"><br>
                </div>
                <div class="input-group">
                    <label>Fecha</label>
                <input type="date" name="Fecha" placeholder="Fecha"><br>
                </div>
                <div class="input-group">
                    <label>Longitud</label>
                <input type="text" name="Longitud" placeholder="Longitud"><br>
                </div>
                <div class="input-group">
                    <label>Latitud</label>
                <input type="text" name="Latitud" placeholder="Latitud"><br>
                </div>
                

                    <input class="btn btn-success" type="submit" value="Guardar">
        </form>
        </div>
        



    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.js" integrity="sha256-BTlTdQO9/fascB1drekrDVkaKd9PkwBymMlHOiG+qLI=" crossorigin="anonymous"></script> 

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

</body>
</html>