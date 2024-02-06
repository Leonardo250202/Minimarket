<?php 

	class proveedores{

		public function agregaProveedor($datos){
			$c= new conectar();
			$conexion=$c->conexion();

			$idusuario=$_SESSION['iduser'];

			$sql="INSERT into proveedores (id_usuario,
										nombre_empresa,
										direccion_empresa,
										email_empresa,
										telefono_empresa)
							values ('$idusuario',
									'$datos[0]',
									'$datos[1]',
									'$datos[2]',
									'$datos[3]')";
			return mysqli_query($conexion,$sql);	
		}

		public function obtenDatosProveedor($idproveedor){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="SELECT id_proveedor,
							nombre_empresa,
							direccion_empresa,
							email_empresa,
							telefono_empresa
				from proveedores
				where id_proveedor='$idproveedor'";




			$result=mysqli_query($conexion,$sql);
			$ver=mysqli_fetch_row($result);

			$datos=array(
					'id_proveedor' => $ver[0], 
					'nombre_empresa' => $ver[1],
					'direccion_empresa' => $ver[2],
					'email_empresa' => $ver[3],
					'telefono_empresa' => $ver[4]
						);
			return $datos;
		}

		public function actualizaProveedor($datos){
			$c= new conectar();
			$conexion=$c->conexion();
			$sql="UPDATE proveedores set nombre_empresa='$datos[1]',
										direccion_empresa='$datos[2]',
										email_empresa='$datos[3]',
										telefono_empresa='$datos[4]'
										
								where id_proveedor='$datos[0]'";
			return mysqli_query($conexion,$sql);
		}

		public function eliminaProveedor($idproveedor){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="DELETE from proveedores where id_proveedor='$idproveedor'";

			return mysqli_query($conexion,$sql);
		}
	}

 ?>