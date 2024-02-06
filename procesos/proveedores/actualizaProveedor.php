<?php 

session_start();
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Proveedores.php";

	$obj= new proveedores();


	$datos=array(
		$_POST['idproveedorU'],
		$_POST['nombre_empresaU'],
		$_POST['direccion_empresaU'],
		$_POST['email_empresaU'],
		$_POST['telefono_empresaU']
			);

	echo $obj->actualizaProveedor($datos);

	
	
 ?>