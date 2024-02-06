<?php 

	require_once "../../clases/Conexion.php";
	require_once "../../clases/Compras.php";

	$c= new conectar();
	$conexion=$c->conexion();

	$obj= new compras();

	$sql = "SELECT id_compra, fechaCompra, 
	id_proveedor FROM compras GROUP BY id_compra, fechaCompra, id_proveedor"; 
	$result = mysqli_query($conexion, $sql);
	?>

<h4>Reportes y compras</h4>
<div class="row">
	<div class="col-sm-1"></div>
	<div class="col-sm-10">
		<div class="table-responsive">
			<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
				<caption><label>Compras</label></caption>
				<tr>
					<td>Categoria</td>
					<td>Producto</td>
					<td>Descripcion</td>
                    <td>Cantidad</td>
		            <td>Precio</td>
					<td>Total de compra</td>
					<td>Ticket</td>
					<td>Reporte</td>
				</tr>
		<?php while($ver=mysqli_fetch_row($result)): ?>
				<tr>
					<td><?php echo $ver[0] ?></td>
					<td><?php echo $ver[1] ?></td>
					<td>
						<?php
							if($obj->nombreCliente($ver[2])==" "){
								echo "S/C";
							}else{
								echo $obj->nombreCliente($ver[2]);
							}
						 ?>
					</td>
					<td>
						<?php 
							echo "$".$obj->obtenerTotal($ver[0]);
						 ?>
					</td>
					<td>
						<a href="../procesos/compras/crearTicketPdf.php?idcompra=<?php echo $ver[0] ?>" class="btn btn-danger btn-sm">
							Ticket <span class="glyphicon glyphicon-list-alt"></span>
						</a>
					</td>
					<td>
						<a href="../procesos/compras/crearReportePdf.php?idcompra=<?php echo $ver[0] ?>" class="btn btn-danger btn-sm">
							Reporte <span class="glyphicon glyphicon-file"></span>
						</a>	
					</td>
				</tr>
		<?php endwhile; ?>
			</table>
		</div>
	</div>
	<div class="col-sm-1"></div>
</div>