<?php 

class ventas{
	public function obtenDatosProducto($idproducto){
		$c=new conectar();
		$conexion=$c->conexion();

		$sql = "SELECT 
				    art.nombre,
				    art.descripcion,
				    art.cantidad,
				    img.ruta,
				    art.precio
				FROM
				    articulos AS art
				        INNER JOIN
				    imagenes AS img ON art.id_imagen = img.id_imagen
				        AND art.id_producto = '$idproducto'";
		$result=mysqli_query($conexion,$sql);

		$ver=mysqli_fetch_row($result);

		$d=explode('/', $ver[3]);

		$img=$d[1].'/'.$d[2].'/'.$d[3];

		$data=array(
			'nombre' => $ver[0],
			'descripcion' => $ver[1],
			'cantidad' => $ver[2],
			'ruta' => $img,
			'precio' => $ver[4]
		);		
		return $data;
	}
	public function creaFolio(){
		$c = new conectar();
		$conexion = $c->conexion();
	
		$sql = "SELECT id_venta FROM ventas ORDER BY id_venta DESC LIMIT 1";
	
		$result = mysqli_query($conexion, $sql);
	
		if (!$result) {
			// Manejar el error, por ejemplo:
			echo "Error en la consulta SQL: " . mysqli_error($conexion);
			return 0;
		}
	
		$id = mysqli_fetch_row($result)[0];
	
		if ($id === "" || $id === null || $id === 0) {
			return 1;
		} else {
			return $id + 1;
		}
	}

	public function crearVenta(){
		$c = new conectar();
		$conexion = $c->conexion();
	
		$fecha = date('Y-m-d');
		$idventa = self::creaFolio();
		$datos = $_SESSION['tablaComprasTemp'];
		$idusuario = $_SESSION['iduser'];
		$r = 0;
	
		for ($i = 0; $i < count($datos); $i++) { 
			$d = explode("||", $datos[$i]);
	
			$sql = "INSERT into ventas (id_venta,
										id_cliente,
										id_producto,
										id_usuario,
										precio,
										fechaCompra)
							values ('$idventa',
									'$d[5]',
									'$d[0]',
									'$idusuario',
									'$d[3]',
									'$fecha')";
			$result = mysqli_query($conexion, $sql);
	
			// Agregar mensajes de depuración
			 if ($result) {
				$r = $r + 1;
			 } else {
			 	error_log("Error al ejecutar la consulta: " . mysqli_error($conexion));
			 }
		}
	
		return $r;
	}


	public function nombreCliente($idCliente){
		$c= new conectar();
		$conexion=$c->conexion();

		 $sql="SELECT apellido,nombre 
			from clientes 
			where id_cliente='$idCliente'";
		$result=mysqli_query($conexion,$sql);

		$ver=mysqli_fetch_row($result);

		return $ver[0]." ".$ver[1];
	}

	public function obtenerTotal($idventa){
		$c= new conectar();
		$conexion=$c->conexion();

		$sql="SELECT precio 
				from ventas 
				where id_venta='$idventa'";
		$result=mysqli_query($conexion,$sql);

		$total=0;

		while($ver=mysqli_fetch_row($result)){
			// $total=$total+($total*0.10) + $ver[0];
			$total=$total + $ver[0];
		}

		return $total;
	}
}

?>