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

      $apiToken = "1116214164:AAGXVR3EmiiQ-3Vz8ScAN4ApJ2wZrma9CNw";

      $data = [
          'chat_id' => '-477785739',
          'text' => "Un nuevo caso ha sido descubierto en la ciudad de: ".$Ciudad
      ];

      $response = file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($data) );
    
  } else{
    echo "<script> alert('Incorrecto'); 
    location.href ='home.php';</script>";
  }

?>