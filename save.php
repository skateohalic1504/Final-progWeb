<?php
  require 'dbconnection.php';

  $Cedula = $_POST['Cedula'];
  $Nombre = $_POST['Nombre'];
  $Apellido = $_POST['Apellido'];
  $Pais = $_POST['Pais'];
  $Ciudad = $_POST['Ciudad'];
  $Fecha = $_POST['Fecha'];
  $Latitud = $_POST['Latitud'];
  $Longitud = $_POST['Longitud'];

  $insertar = "INSERT INTO infectados
  VALUES ('$Cedula','$Nombre','$Apellido','$Pais','$Ciudad','$Fecha','$Latitud','$Longitud') ";

  $query = mysqli_query($conectar, $insertar);

  if($query) {
    echo "<script> alert('Correcto');
      location.href ='home.php'; </script>";
    
  } else{
    echo "<script> alert('Incorrecto'); 
    location.href ='home.php';</script>";
  }

?>