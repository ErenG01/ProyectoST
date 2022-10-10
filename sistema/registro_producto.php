<?php 
	session_start();
	if($_SESSION['rol'] != 1 and $_SESSION['rol'] !=2)
	{
		header("location: ./");
	}
	include "../conexion.php";

	if(!empty($_POST))
	{

		$alert='';
		if(empty($_POST['proveedor']) || empty($_POST['categoria']) || empty($_POST['producto']) || empty($_POST['descripcion']) || empty($_POST['precio']) || empty($_POST['cantidad']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

			$proveedor = $_POST['proveedor'];
			$categoria = $_POST['categoria'];
			$producto = $_POST['producto'];
			$descripcion = $_POST['descripcion'];
			$precio = $_POST['precio'];
			$cantidad = $_POST['cantidad'];
			$usuario_id = $_SESSION['idUser'];

			
			$nombre_foto =$_FILES['foto']['name'];
			$url_temp =$_FILES['foto']['tmp_name'];

			

			if($url_temp =="")
			{
				$query_insert = mysqli_query($conection,"insert into productos (foto) values('null','$categoria','$proveedor', '$producto', '$descripcion', '$precio', '$cantidad', '$destino')");

				
			}else
			{
				$destino="img/uploads";
				$destino=$destino."/".$nombre_foto;
				move_uploaded_file($url_temp, "$destino");

				$query_insert = mysqli_query($conection,"insert into productos (id_prod, id_categoria, id_proveedor, nomb_prod, desc_prod, precio, cantidad, foto) values('null','$categoria','$proveedor', '$producto', '$descripcion', '$precio', '$cantidad', '$destino')");

				if($query_insert){
					$alert = '<p class="msg_save">Producto guardado correctamente.</p>';
				}else{
					$alert = '<p class="msg_error">Error al registrar el producto.</p>';
				}
				
			}
		}
	}	
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/script.php";?>
	<script src="js/jquery.min.js"></script>
	<title>Registro Producto</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<script src="js/functions.js"></script>
	
	<section id="container">
		<div class="form_register">
			<h1>Registro productos</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
			<form action="" method="post" enctype="multipart/form-data">

				<label for="categoria">Categoria</label>
				<?php  

					$query_categoria = mysqli_query($conection,"select * from categorias");
					$result_categoria = mysqli_num_rows($query_categoria);
				?>
				<select name="categoria" id="categoria">
					<?php 

						if($result_categoria > 0){
							while($categoria = mysqli_fetch_array($query_categoria)){
					?>
					<option value="<?php echo $categoria['Id_categoria']; ?>"><?php echo $categoria['Desc_categ']; ?></option>
					<?php
							}
						}

					?>
					
				</select>

				<label for="proveedor">Empresa</label>
				<?php  

					$query_proveedor = mysqli_query($conection,"select id_proveedor, nombre from proveedores ");
					$result_proveedor = mysqli_num_rows($query_proveedor);

				?>
				<select name="proveedor" id="proveedor">
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
				<label for="producto">Nombre del producto</label>
				<input type="text" name="producto" id="producto" placeholder="Nombre del producto">
				<label for="descripcion">Descripcion del producto</label>
				<input type="text" name="descripcion" id="descripcion" placeholder="Descripcion acerca del producto">
				<label for="precio">Precio</label>
				<input type="number" name="precio" id="precio" placeholder="Precio del producto">
				<label for="cantidad">Cantidad</label>
				<input type="number" name="cantidad" id="cantidad" placeholder="Cantidad del producto">
				<div class="photo">
					<label for="foto">Foto del producto</label>
				        <div class="prevPhoto">
				        <span class="delPhoto notBlock">X</span>
				        <label for="foto"></label>
				        </div>
				        <div class="upimg">
				        <input type="file" name="foto" id="foto">
				        </div>
				        <div id="form_alert"></div>
				</div>
				<button type="submit" class="btn_save"><i class="far fa-save fa-lg"></i> Guardar Producto</button>
			</form>

		</div>
	</section>

	<?php include "includes/footer.php"; ?>
</body>
</html>