<?php 

	session_start();
 ?>

 <h4>Hacer compra</h4>
 <h4><strong><div id="nombreproveedorCompra"></div></strong></h4>
 <table class="table table-bordered table-hover table-condensed" style="text-align: center;">
 	<caption>
 		<span class="btn btn-success" onclick="crearCompra()"> Generar compra
 			<span class="glyphicon glyphicon-usd"></span>
 		</span>
 	</caption>
 	<tr>
 		<td>Nombre</td>
 		<td>Descripcion</td>
 		<td>Precio</td>
 		<td>Cantidad</td>
 		<td>Quitar</td>
 	</tr>
 	<?php 
 	$total=0;//esta variable tendra el total de la compra en dinero
 	$proveedor=""; //en esta se guarda el nombre del proveedor
 		if(isset($_SESSION['tablaCompras2Temp'])):
 			$i=0;
 			foreach (@$_SESSION['tablaCompras2Temp'] as $key) {

 				$d=explode("||", @$key);
 	 ?>

 	<tr>
 		<td><?php echo $d[1] ?></td>
 		<td><?php echo $d[2] ?></td>
 		<td><?php echo $d[3] ?></td>
 		<td><?php echo 1; ?></td>
 		<td>
 			<span class="btn btn-danger btn-xs" onclick="quitarP('<?php echo $i; ?>')">
 				<span class="glyphicon glyphicon-remove"></span>
 			</span>
 		</td>
 	</tr>

 <?php 
 		$total=$total + $d[3];
 		$i++;
 		$proveedor=$d[4];
 	}
 	endif; 
 ?>

 	<tr>
 		<td>Total de compra: <?php echo "$".$total; ?></td>
 	</tr>

 </table>


 <script type="text/javascript">
 	$(document).ready(function(){
 		nombre="<?php echo @$proveedor ?>";
 		$('#nombreproveedorCompra').text("Nombre de proveedor: " + nombre);
 	});
 </script>