<?php 

session_start();
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Clientes.php";

	$obj= new clientes();


	$datos=array(
			$_POST['nombre'],
			$_POST['apellidos'],
			$_POST['cedula'],
			$_POST['direccion'],
			$_POST['email'],
			$_POST['telefono']
			
				);

	echo $obj->agregaCliente($datos);

	
	
 ?>