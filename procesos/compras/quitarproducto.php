<?php 

	session_start();
	$index=$_POST['ind'];
	unset($_SESSION['tablaCompras2Temp'][$index]);
	$datos=array_values($_SESSION['tablaCompras2Temp']);
	unset($_SESSION['tablaCompras2Temp']);
	$_SESSION['tablaCompras2Temp']=$datos;

 ?>