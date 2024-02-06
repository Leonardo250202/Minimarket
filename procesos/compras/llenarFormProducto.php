<?php 
	
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Compras.php";

	$obj= new compras();

	echo json_encode($obj->obtenDatosProducto($_POST['idproducto']))

 ?>