<?php 
session_start();
if(isset($_SESSION['usuario'])){

	?>


	<!DOCTYPE html>
	<html>
	<head>
		<title>proveedores</title>
		<?php require_once "menu.php"; ?>
	</head>
	<body>
		<div class="container">
			<h1>Proveedores</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="frmProveedores">
					<label>Nombre Empresa</label>
						<input type="text" class="form-control input-sm" id="nombre_empresa" name="nombre_empresa">
						<label>Direccion Empresa</label>
						<input type="text" class="form-control input-sm" id="direccion_empresa" name="direccion_empresa">
						<label>Email Empresa</label>
						<input type="text" class="form-control input-sm" id="email_empresa" name="email_empresa">
						<label>Telefono Empresa</label>
						<input type="text" class="form-control input-sm" id="telefono_empresa" name="telefono_empresa">
						<p></p>
						<span class="btn btn-primary" id="btnAgregarProveedor">Agregar</span>
					</form>
				</div>
				<div class="col-sm-8">
					<div id="tablaProveedoresLoad"></div>
				</div>
			</div>
		</div>

		<!-- Button trigger modal -->


		<!-- Modal -->
		<div class="modal fade" id="abremodalProveedoresUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Actualizar proveedor</h4>
					</div>
					<div class="modal-body">
						<form id="frmProveedoresU">
							<input type="text" hidden="" id="idproveedorU" name="idproveedorU">	
							<label>Nombre Empresa</label>
							<input type="text" class="form-control input-sm" id="nombre_empresaU" name="nombre_empresaU">
							<label>Direccion Empresa</label>
							<input type="text" class="form-control input-sm" id="direccion_empresaU" name="direccion_empresaU">
							<label>Email Empresa</label>
							<input type="text" class="form-control input-sm" id="email_empresaU" name="email_empresaU">
							<label>Telefono Empresa</label>
							<input type="text" class="form-control input-sm" id="telefono_empresaU" name="telefono_empresaU">							
						</form>											
					</div>
					<div class="modal-footer">
						<button id="btnAgregarProveedorU" type="button" class="btn btn-primary" data-dismiss="modal">Actualizar</button>

					</div>
				</div>
			</div>
		</div>

	</body>
	</html>

	<script type="text/javascript">
		function agregaDatosProveedor(idproveedor){

			$.ajax({
				type:"POST",
				data:"idproveedor=" + idproveedor,
				url:"../procesos/proveedores/obtenDatosProveedor.php",
				success:function(r){
					dato=jQuery.parseJSON(r);
					$('#idproveedorU').val(dato['id_proveedor']);
					$('#nombre_empresaU').val(dato['nombre_empresa']);
					$('#direccion_empresaU').val(dato['direccion_empresa']);
					$('#email_empresaU').val(dato['email_empresa']);
					$('#telefono_empresaU').val(dato['telefono_empresa']);										
				}
			});
		}

		function eliminarProveedor(idproveedor){
			alertify.confirm('¿Desea eliminar este proveedor?', function(){ 
				$.ajax({
					type:"POST",
					data:"idproveedor=" + idproveedor,
					url:"../procesos/proveedores/eliminarProveedor.php",
					success:function(r){
						if(r==1){
							$('#tablaProveedoresLoad').load("proveedores/tablaProveedores.php");
							alertify.success("Eliminado con exito!");
						}else{
							alertify.error("No se pudo eliminar!")
						}
					}
				});
			}, function(){ 
				alertify.error('Cancelado')
			});
		}
	</script>

	<script type="text/javascript">
		$(document).ready(function(){

			$('#tablaProveedoresLoad').load("proveedores/tablaProveedores.php");

			$('#btnAgregarProveedor').click(function(){

				vacios=validarFormVacio('frmProveedores');

				if(vacios > 0){
					alertify.alert("Debes llenar todos los campos!");
					return false;
				}

				datos=$('#frmProveedores').serialize();

				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/proveedores/agregaProveedor.php",
					success:function(r){						

						if(r==1){
							$('#frmProveedores')[0].reset();
							$('#tablaProveedoresLoad').load("proveedores/tablaProveedores.php");
							alertify.success("Proveedor agregado con exito!");
						}else{
							alertify.error("No se pudo agregar proveedor!");
						}
					}
				});
			});
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#btnAgregarProveedorU').click(function(){
				datos=$('#frmProveedoresU').serialize();

				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/proveedores/actualizaProveedor.php",
					success:function(r){
						

						if(r==1){
							$('#frmProveedores')[0].reset();
							$('#tablaProveedoresLoad').load("proveedores/tablaProveedores.php");
							alertify.success("Proveedor actualizado con exito!");
						}else{
							alertify.error("No se pudo actualizar proveedor!");
						}
					}
				});
			})
		})
	</script>


	<?php 
}else{
	header("location:../index.php");
}
?>