<?php
  require 'dbconnection.php';

  $consultar ="SELECT *FROM infectados";
  $query = mysqli_query($conectar, $consultar);	
  $Array = mysqli_fetch_array($query);
?>