<?php 

require_once "../../clases/Conexion.php";
$c= new conectar();
$conexion=$c->conexion();
?>


<h4>Comprar un producto</h4>
<div class="row">
	<div class="col-sm-4">
		<form id="frmComprasProductos">
			<label>Seleciona Proveedor</label>
			<select class="form-control input-sm" id="proveedorCompra" name="proveedorCompra">
				<option value="A">Selecciona</option>
				<option value="0">Sin proveedores</option>
				
				<?php
				$sql="SELECT id_proveedor,nombre_empresa
				from proveedores";
				$result=mysqli_query($conexion,$sql);
				while ($proveedores=mysqli_fetch_row($result)):
                ?>
				
                <option value="<?php echo $proveedores[0] ?>"><?php echo $proveedores[1]?></option>
				<?php endwhile; ?>
			</select>
			<label>Producto</label>
			<select class="form-control input-sm" id="productoCompra" name="productoCompra">
				<option value="A">Selecciona</option>
				<?php
                $sql="SELECT id_producto,
				                nombre
					from articulos";
				$result=mysqli_query($conexion,$sql);
                
                while ($producto=mysqli_fetch_row($result)):
                ?>
					<option value="<?php echo $producto[0] ?>"><?php echo $producto[1] ?></option>
				<?php endwhile; ?>
			</select>
			<label>Descripcion</label>
			<textarea readonly="" id="descripcionV" name="descripcionV" class="form-control input-sm"></textarea>
			<label>Cantidad</label>
			<input readonly="" type="text" class="form-control input-sm" id="cantidadV" name="cantidadV">
			<label>Precio</label>
			<input readonly="" type="text" class="form-control input-sm" id="precioV" name="precioV">
			<p></p>
			<span class="btn btn-primary" id="btnAgregaCompra">Agregar</span>
			<span class="btn btn-danger" id="btnVaciarCompras">Vaciar compras</span>
		</form>
	</div>
	<div class="col-sm-3">
		<div id="imgProducto"></div>
	</div>
	<div class="col-sm-4">
		<div id="tablaComprasTempLoad"></div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){

		$('#tablaComprasTempLoad').load("compras/tablaComprasTemp.php");

		$('#productoCompra').change(function(){
			$.ajax({
				type:"POST",
				data:"idproducto=" + $('#productoCompra').val(),
				url:"../procesos/compras/llenarFormProducto.php",
				success:function(r){
					//alert(r);
				
					dato=jQuery.parseJSON(r);

					$('#descripcionV').val(dato['descripcion']);
					$('#cantidadV').val(dato['cantidad']);
					$('#precioV').val(dato['precio']);

					$('#imgProducto').prepend('<img class="img-thumbnail" id="imgp" src="' + dato['ruta'] + '" />');
				}
			});
		});

		$('#btnAgregaCompra').click(function(){
			vacios=validarFormVacio('frmComprasProductos');

			if(vacios > 0){
				alertify.alert("Debes llenar todos los campos!!");
				return false;
			}

			datos=$('#frmComprasProductos').serialize();
			$.ajax({
				type:"POST",
				data:datos,
				url:"../procesos/compras/agregaProductoTemp.php",
				success:function(r){
					$('#tablaComprasTempLoad').load("compras/tablaComprasTemp.php");
				}
			});
		});

		$('#btnVaciarCompras').click(function(){

		$.ajax({
			url:"../procesos/compras/vaciarTemp.php",
			success:function(r){
				$('#tablaComprasTempLoad').load("compras/tablaComprasTemp.php");
			}
		});
	});

	});
</script>

<script type="text/javascript">
	function quitarP(index) {
    $.ajax({
        type: "POST",
        data: "ind=" + index,
        url: "../procesos/compras/quitarproducto.php",
        success: function(r) {
            $('#tablaComprasTempLoad').load("compras/tablaComprasTemp.php");
            alertify.success("Se quitó el producto");
        },
        error: function(xhr, status, error) {
            console.error("Error en la solicitud Ajax (quitarP):", status, error);
        }
    });
}
 
function crearCompra() {
    $.ajax({
        url: "../procesos/compras/crearCompra.php",
        success: function(r) {
            console.log("Respuesta de crearCompra:", r); // Agregamos un mensaje a la consola
            if (r != 0) {
                $('#tablaComprasTempLoad').load("compras/tablaComprasTemp.php", function() {
                    console.log("Tabla actualizada después de crear la compra");
                });
                $('#frmComprasProductos')[0].reset();
                alertify.alert("Compra creada con éxito, consulte la información de esta en compras hechas");
            } else if (r == 0) {
                alertify.alert("No hay lista de compra!");
            } else {
                alertify.error("No se pudo crear la compra!");
            }
        },
        error: function(xhr, status, error) {
            console.error("Error en la solicitud Ajax (crearCompra):", status, error);
        }
    });
}
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#proveedorCompra').select2();
		$('#productoCompra').select2();

	});
</script>