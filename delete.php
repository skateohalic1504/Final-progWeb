<?php
  require 'dbconnection.php';

  $Cedula= $_REQUEST['Cedula'];

  $consultar ="DELETE FROM infectados WHERE cedula='$Cedula' ";
  $query = mysqli_query($conectar, $consultar);	

  if ($query) {
  	echo "<script> alert('Caso Eliminado');
  	location.href='home.php';</script>";
  }  
?>