<?php 

class compras{
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

	public function crearCompra(){
		$c = new conectar();
		$conexion = $c->conexion();
	 
		$fecha = date('Y-m-d');
		$idcompra = self::creaFolio();
		$datos = $_SESSION['tablaCompras2Temp'];
		$idusuario = $_SESSION['iduser'];
		$r = 0;
	 
		// Iniciar la transacción
		mysqli_autocommit($conexion, FALSE);
	 
		try {
			for ($i = 0; $i < count($datos); $i++) {
				$d = explode("||", $datos[$i]);
	 
				$sql = "INSERT INTO compras (id_compra, id_proveedor, id_producto, id_usuario, precio, fechaCompra)
						VALUES (?, ?, ?, ?, ?, ?)";
				$stmt = mysqli_prepare($conexion, $sql);
				mysqli_stmt_bind_param($stmt, 'ssssss', $idcompra, $d[5], $d[0], $idusuario, $d[3], $fecha);
				$result = mysqli_stmt_execute($stmt);
	 
				if ($result) {
					$r++;
				} else {
					throw new Exception("Error al insertar producto en la compra.");
				}
			}
	 
			// Confirmar la transacción
			mysqli_commit($conexion);
		} catch (Exception $e) {
			// Revertir la transacción en caso de error
			mysqli_rollback($conexion);
			echo "Error: " . $e->getMessage();
			return 0;
		}
	 
		return $r;
	}

	public function creaFolio(){
		$c= new conectar();
		$conexion=$c->conexion();

		$sql="SELECT id_compra from compras group by id_compra desc";

		$resul=mysqli_query($conexion,$sql);
		$id=mysqli_fetch_row($resul)[0];

		if($id=="" or $id==null or $id==0){
			return 1;
		}else{
			return $id + 1;
		}
	}
	public function nombreProveedor($idProveedor){
		$c= new conectar();
		$conexion=$c->conexion();

		 $sql="SELECT nombre_empresa
			from proveedores 
			where id_proveedor='$idProveedor'";
		$result=mysqli_query($conexion,$sql);

		$ver=mysqli_fetch_row($result);

		return $ver[1];
	}

	public function obtenerTotal($idcompra){
		$c= new conectar();
		$conexion=$c->conexion();

		$sql="SELECT precio 
				from compras 
				where id_compra='$idcompra'";
		$result=mysqli_query($conexion,$sql);

		$total=0;

		while($ver=mysqli_fetch_row($result)){
			$total=$total + $ver[0];
		}

		return $total;
	}
}

?>