<?php
session_start();
	if($_SESSION['rol'] != 1)
	{
		header("location: ./");
	} 

include("../procesos/conexion.php");

$conex=conectar();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/script.php"; ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="css/estilos.css">
	
</head>
<body>
	<?php include "includes/header.php";?>
	<section id="container">
		<div class="form_register">
	
		<form action="" name="form" method="post" enctype="multipart/form-data">
			<h1>Registro Producto</h1>

		<label for="documento">Nombre Producto</label>
		<input type="text" name="nombre_pro" id="nombre_pro" placeholder="nombre del producto">
		<label for="nombre">Descripcion produto</label>
		<input type="text" name="desc_pro" id="desc_pro" placeholder="Descripcion del producto">

		<label for="correo">Categoria</label>
		<?php
		$conex=conectar();

				$query_cedula = mysqli_query($conex,"select * from categorias");
				$result_cedula =  mysqli_num_rows($query_cedula);
	?>
	<select name="categoria" id="categoria">
					<?php  
						if($result_cedula > 0)
						{
							while ($categor = mysqli_fetch_array($query_cedula)){
					?>
							<option value="<?php echo $categor["Id_categoria"]; ?>"><?php echo $categor["Desc_categ"] ?></option>
					<?php
							}
						}
					?>			
	</select>
	<label for="telefono">Imagen</label>
	<input type="file" id="imagen_lo" name="imagen_lo" placeholder="Imagen" required="">
	<label for="direccion">Proovedor</label>
	<?php
	$conex=conectar();

				$query_cedula = mysqli_query($conex,"select * from proveedores");
				$result_cedula =  mysqli_num_rows($query_cedula);
	?>
	<select name="proveed" id="proveed">
					<?php  
						if($result_cedula > 0)
						{
							while ($proovedor = mysqli_fetch_array($query_cedula)){
					?>
							<option value="<?php echo $proovedor["id_proveedor"]; ?>"><?php echo $proovedor["nombre"] ?></option>
					<?php
							}
						}
					?>			
	</select>
					
	<input type="submit" name="enviar" value="Agregar producto" class="btn_save">
				
</form>
</section>	
</div>
<?php

	if (isset($_POST['enviar'])) 
	{
		$nom=$_POST['nombre_pro'];
		$desc=$_POST['desc_pro'];
		$categ=$_POST['categoria'];
		$ima=$_FILES['imagen_lo']['name'];
		$archivo=$_FILES['imagen_lo']['tmp_name'];
		$prov=$_POST['proveed'];
		
		


		if ($nom==""||$desc=="") 
		{
			echo "<script type='text/javascript'>
 		alert('debe diligenciar todos los campos');
 		window.location='adicion_prod.php'
 		</script>";
		}else
		{
		
	
		$ruta="imagenes"; 	
		$ruta=$ruta."/".$ima;
		move_uploaded_file($archivo, "../$ruta");	

		 $conex=conectar();

		$sql="insert into productos(nomb_prod, desc_prod, id_categoria, imagen, id_proveedor) values('$nom', '$desc', '$categ', '$ruta', '$prov')"; 

		$resul=$conex->query($sql);

		echo "<script type='text/javascript'>
 		alert('el registro fue adicionado correctamente...');
 		window.location='adicion_prod.php'
 		</script>";
 		}

	}





?>
	
</body>
</html>