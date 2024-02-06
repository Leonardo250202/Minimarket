<?php 
	session_start();
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Compras.php";
	$obj= new compras();

	

	if(count($_SESSION['tablaCompras2Temp'])==0){
		echo 0;
	}else{
		$result=$obj->crearCompra();
		unset($_SESSION['tablaCompras2Temp']);
		echo $result;
	}
 ?>