<?php 
	session_start();
	if(isset($_SESSION['usuario'])){
		
 ?>
 

<!DOCTYPE html>
<html>
<head>
	<title>compras</title>
	<?php require_once "menu.php"; ?>
</head>
<body>

	<div class="container">
		 <h1>Compra de productos</h1>
		 <div class="row">
		 	<div class="col-sm-12">
			 	<!-- <span class="btn btn-default" id="categoriasBtn">Categorias</span> -->
				 <span class="btn btn-default" id="ordenCompraBtn">Orden de Compra</span>
		 		<span class="btn btn-default" id="compraProductosBtn">Comprar producto</span>
		 		<span class="btn btn-default" id="comprasHechasBtn">Compras hechas</span>
				 <span class="btn btn-default" id="devolucionesBtn">Devoluciones</span>
		 	</div>
		 </div>
		 <div class="row">
		 	<div class="col-sm-12">			 
			 	<!-- <div id="categorias"></div> -->
				<div id="ordenCompra"></div>
		 		<div id="compraProductos"></div>
		 		<div id="comprasHechas"></div>
				 <div id="devoluciones"></div>
		 	</div>
		 </div>
	</div>
</body>
</html>
	
	<script type="text/javascript">
		$(document).ready(function(){	
			
			// $('#categoriasBtn').click(function(){
			// 	esconderSeccionCompra();
			// 	$('#categorias').load('categorias.php');
			// 	$('#categorias').show();
			// });

			$('#ordenCompraBtn').click(function(){
				esconderSeccionCompra();
				$('#ordenCompra').load('ordenCompra.php');
				$('#ordenCompra').show();
			});

			$('#compraProductosBtn').click(function(){
				esconderSeccionCompra();
				$('#compraProductos').load('compras/comprasDeProductos.php');
				$('#compraProductos').show();
			});
			$('#comprasHechasBtn').click(function(){
				esconderSeccionCompra();
				$('#comprasHechas').load('compras/comprasyReportes.php');
				$('#comprasHechas').show();
			});

			$('#devolucionesBtn').click(function(){
				esconderSeccionCompra();
				$('#devoluciones').load('devoluciones.php');
				$('#devoluciones').show();
			});
		});

		function esconderSeccionCompra(){			
			// $('#categorias').hide();
			$('#ordenCompra').hide();
			$('#compraProductos').hide();
			$('#comprasHechas').hide();
			$('#devoluciones').hide();
		}

	</script>

<?php 
	}else{
		header("location:../index.php");
	}
 ?>