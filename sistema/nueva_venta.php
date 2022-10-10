<?php  
	session_start();
	include "../conexion.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<?php include "includes/script.php"; ?>
	<title>Nueva Venta</title>
</head>
<body>
	<?php include "includes/header.php"; ?>

	<section id="container">
		<div class="title_page">
			<h1><i class="fas fa-cube"></i> Nueva Venta</h1>
		</div>
		<div class="datos_cliente">
			<div class="action_cliente">
				<h4>Datos del cliente</h4>
				<a href="#" class="btn_new btn_new_cliente"><i class="fas fa-plus"></i> Nuevo cliente</a>
			</div>
			<form name="form_new_cliente_venta" id="form_new_cliente_venta" class="datos">
				<input type="hidden" name="action" value="addCLiente">
				<input type="hidden" id="idcliente" name="idcliente" value="" required>
				<div class="wd30">
					<label>Numero de documento</label>
					<input type="text" name="numero_cliente" id="numero_cliente">
				</div>
				<div class="wd30">
					<label>Tipo de documento</label>
					<?php  

					$query_cliente = mysqli_query($conection,"select * from cedula");
					$result_cliente = mysqli_num_rows($query_cliente);

				?>
				<select name="tipo_documento" id="tipo_documento" disabled required>
					<?php 

						if($result_cliente > 0){
							while($cliente = mysqli_fetch_array($query_cliente)){
					?>
					<option value="<?php echo $cliente['Id_cedula']; ?>"><?php echo $cliente['tipo_documento']; ?></option>
					<?php
							}
						}

					?>
					
				</select>
				</div>
				<div class="wd30">
					<label>Nombre</label>
					<input type="text" name="nom_cliente" id="nom_cliente" disabled required>
				</div>
				<div class="wd30">
					<label>Correo</label>
					<input type="text" name="correo_cliente" id="correo_cliente" disabled required>
				</div>
				<div class="wd30">
					<label>Telefono</label>
					<input type="number" name="tel_cliente" id="tel_cliente" disabled required>
				</div>
				<div class="wd100">
					<label>Direccion</label>
					<input type="text" name="dir_cliente" id="dir_cliente" disabled required>
				</div>
				<div id="div_registro_cliente" class="wd100">
					<button type="submit" class="btn_save"><i class="far fa-save fa-lg"></i> Guardar</button>
				</div>
			</form>
		</div>
		<div class="datos_venta">
			<h4>Datos de venta</h4>
			<div class="datos">
				<div class="wd50">
					<label>Vendedor</label>
					<p><?php echo $_SESSION['nombre']; ?></p>
				</div>
				<div class="wd50">
					<label>Acciones</label>
					<div id="acciones_venta">
						<a href="#" class="btn_ok textcenter" id="btn_anular_venta"><i class="fas fa-ban"></i> Anular</a>
						<a href="../reportespdf/reporte_venta.php" class="btn_new textcenter" id="btn_facturar_venta" ><i class="far fa-edit"></i> Procesar</a>
					</div>
				</div>
			</div>
		</div>
		<div class="datos_cliente">
			<div class="action_cliente">
				<h4>Datos del producto</h4>
				<a href="#" class="btn_new btn_new_producto"><i class="fas fa-plus"></i> Nuevo producto</a>
			</div>
			<form name="form_new_producto_venta" id="form_new_producto_venta" class="datos">
				<input type="hidden" name="action" value="addProducto">
				<input type="hidden" id="idproducto" name="idproducto" value="" required>
				<div class="wd30">
					<label>Nombre del producto</label>
					<input type="text" name="nom_producto" id="nom_producto">
				</div>
				<div class="wd30">
					<label>Categoria</label>
					<?php  

					$query_producto = mysqli_query($conection,"select * from categorias");
					$result_producto = mysqli_num_rows($query_producto);

				?>
				<select name="categoria" id="categoria" disabled required>
					<?php 

						if($result_producto > 0){
							while($producto = mysqli_fetch_array($query_producto)){
					?>
					<option value="<?php echo $producto['Id_categoria']; ?>"><?php echo $producto['Desc_categ']; ?></option>
					<?php
							}
						}

					?>
					
				</select>
				</div>
				<div class="wd30">
					<label>Empresa</label>
					<?php  

					$query_proveedor = mysqli_query($conection,"select id_proveedor, nombre from proveedores");
					$result_proveedor = mysqli_num_rows($query_proveedor);

				?>
				<select name="nombre" id="nombre" disabled required>
					<?php 

						if($result_proveedor > 0){
							while($proveedor = mysqli_fetch_array($query_proveedor)){
					?>
					<option value="<?php echo $proveedor['id_proveedor']; ?>"><?php echo $proveedor['nombre']; ?></option>
					<?php
							}
						}

					?>
					
				</select>
				</div>
				<div class="wd100">
					<label>Descripcion del producto</label>
					<input type="text" name="desc_producto" id="desc_producto" disabled required>
				</div>
				<div class="wd30">
					<label>Precio</label>
					<input type="number" name="precio_producto" id="precio_producto" disabled required>
				</div>
				<div class="wd30">
					<label>Cantidad</label>
					<input type="number" name="cant_producto" id="cant_producto" disabled required>
				</div>
				<div id="div_registro_producto" class="wd100">
					<button type="submit" class="btn_save"><i class="far fa-save fa-lg"></i> Guardar</button>
				</div>
				<div id="btn_agregar" class="wd100">
					<button type="submit" class="btn_save"><i class="fas fa-plus"></i> Agregar</button>
				</div>
			</form>
		</div>
		<table class="tbl_venta">
			<?php
			$final=0;
			$venta=new trabajo;
			$get_venta=$venta->get_ventas();

			for ($i=0; $i <sizeof($get_venta) ; $i++)
			{ 
				$id_v=$get_venta[$i]['id_prod'];
				$nombreP_v=$get_venta[$i]['nomb_prod'];
				$canti_v=$get_venta[$i]['cantidad'];
				$prec_v=$get_venta[$i]['precio_venta'];
				$u_id_v=$get_venta[$i]['usuario_id'];

				$preci_T=$prec_v * $canti_v;
				$final=$final + $preci_T;


			
				
				?>
							<tbody id="detalle_venta">
				<tr>
                    <td><?php echo $id_v?></td>
                    <td colspan="2"><?php echo $nombreP_v?></td>
                    <td class="textcenter"><?php echo $canti_v?></td>
                    <td class="textright"><?php echo $prec_v?></td>
                    <td class="textright" id="columtotal"><?php echo $preci_T?></td>
                    <td class="">
                    <a class="link_delete" href="#" onclick="event.preventDefault(); del_product_detalle('.$data['id_prod'].');"><i class="far fa-trash-alt"></i></a>
                    </td>
                </tr>';
			</tbody>

				<?php
				
				
			}

			?>
			<thead>
				<tr>
					<th>Codigo</th>
					<th colspan="2">Nombre Producto</th>
					<th>Cantidad</th>
					<th class="textright">Precio Und</th>
					<th class="textright">Precio total</th>

					<th> Accion</th>
				</tr>

			</thead>

					<th class="textright">Precio Total</th>
					<td class="textright"><?php echo $final?></td>

			<tfoot id="detalle_totales">
				<!--------Contenido Ajax-------->
			</tfoot>
		</table>
	</section>

	<?php include "includes/footer.php"; ?>
</body>
</html>