<?php 
$con=mysqli_connect("localhost","root","","perdidas");
$utf= $con -> query("SET NAMES 'utf8'");
// Check connection
if (mysqli_connect_errno())
  {
  echo "<script>alert('falla al conectar con la base de datos: ".mysqli_connect_error()."')</script>" ;
  }

//Variables Universales
	date_default_timezone_set('America/Costa_Rica');
	$fecha=date('Y-m-d');
	$hora=date('H:i:s');


	//header("location: ../");
 ?>

