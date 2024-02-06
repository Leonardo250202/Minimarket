<?php 
	session_start();
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Ventas.php";
	$obj = new ventas();

	if (isset($_SESSION['tablaComprasTemp']) && is_array($_SESSION['tablaComprasTemp']) && count($_SESSION['tablaComprasTemp']) > 0) {
		$result = $obj->crearVenta();
		unset($_SESSION['tablaComprasTemp']);
		echo $result;
	} else {
		echo 0;
	}
?>


