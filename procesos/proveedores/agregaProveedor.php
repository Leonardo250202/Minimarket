<?php 

session_start();
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Proveedores.php";

	$obj= new proveedores();


	$datos=array(
		$_POST['nombre_empresa'],
		$_POST['direccion_empresa'],
		$_POST['email_empresa'],
		$_POST['telefono_empresa']
			);

	echo $obj->agregaProveedor($datos);

	 
	
 ?>