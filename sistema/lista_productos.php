<?php 
	session_start();
	if($_SESSION['rol'] != 1 and $_SESSION['rol'] !=2 and $_SESSION['rol'] !=3)
	{
		header("location: ./");
	}
	include "../conexion.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/script.php"; ?>
	<title>Lista de Producto</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<h1><i class="fas fa-cube"></i> Lista de productos</h1>
		<a href="registro_producto.php" class="btn_new">Crear producto</a>
		<hr>

		<form action="../reportespdf/reporte_productos.php" method="post" class="formu_report" enctype="multipart/form-data">
		<input type="submit" name="btn_report" class="btn_r_new" value="Generar reporte" height="150">	
		<p class="h3a">DESDE</p>
		<input type="date" name="fech1" size="5" class="fechs" required="">
		<p class="h3a">HASTA</p>
		<input type="date" name="fech2" size="5" class="fechs" required="">
		</form>

		<form action="buscar_productos.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="buqueda" placeholder="Buscar">
			<button type="submit" class="btn_search"><i class="fas fa-search"></i></button>
		</form>

		<table>
			<tr>
				<th>ID</th>
				<th>
					<?php  

					$query_categoria = mysqli_query($conection,"select * from categorias");
					$result_categoria = mysqli_num_rows($query_categoria);
				?>
				<select name="categoria" id="search_categoria">
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
				</th>
				<th>Empresa</th>
				<th>Nombre Producto</th>
				<th>Descripcion</th>
				<th>Precio</th>
				<th>Cantidad</th>
				<th>Foto</th>
				<th>Acciones</th>
			</tr>
		<?php  

			//Paginador
			$sql_registe = mysqli_query($conection,"SELECT COUNT(*) AS total_registro FROM productos");
			
			$result_register = mysqli_fetch_array($sql_registe);

			$total_registro = $result_register['total_registro'];

			$por_pagina = 5;

			if(empty($_GET['pagina']))
			{
				$pagina = 1;
			}else{
				$pagina = $_GET['pagina'];
			}

			$desde = ($pagina-1) * $por_pagina;
			$total_paginas = ceil($total_registro / $por_pagina);
			
			$query = mysqli_query($conection,"SELECT productos.id_prod, categorias.Desc_categ, proveedores.nombre, productos.nomb_prod, productos.desc_prod, productos.precio, productos.cantidad, productos.foto FROM productos productos INNER JOIN categorias categorias ON productos.id_categoria = categorias.Id_categoria INNER JOIN proveedores proveedores ON productos.id_proveedor = proveedores.id_proveedor ORDER BY productos.id_prod ASC LIMIT $desde,$por_pagina");

			$result = mysqli_num_rows($query);
			if($result > 0){
				while ($data = mysqli_fetch_array($query)){
					if($data['foto'] != 'img_producto.png'){
						$foto = 'img/uploads/'.$data['foto'];
					}else{
						$foto = 'img/'.$data['foto'];
					}
					
		?>

			<tr>
				<td><?php echo $data["id_prod"]; ?></td>
				<td><?php echo $data["Desc_categ"]; ?></td>
				<td><?php echo $data["nombre"]; ?></td>
				<td><?php echo $data["nomb_prod"]; ?></td>
				<td><?php echo $data["desc_prod"]; ?></td>
				<td><?php echo $data["precio"]; ?></td>
				<td><?php echo $data["cantidad"]; ?></td>
				<td class="img_producto"><img src="<?php echo $foto; ?>" alt="<?php echo $data["nomb_prod"]; ?>"></td>

				<td>
					<?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2){ ?>
					<a class="link_edit" href="editar_producto.php?id=<?php echo $data["id_prod"] ?>"><i class="fas fa-edit"></i> Editar</a>
					|
					<a class="link_delete" href="eliminar_confirmar_producto.php?id=<?php echo $data["id_prod"] ?>"><i class="fas fa-trash-alt"></i> Eliminar</a>
				<?php } ?>
				</td>
			</tr>

		<?php
				}
			}
		?>
		</table>
		<div class="paginador">
			<ul>
				<?php  
					if($pagina !=1)
					{
				?>
				<li><a href="?pagina=<?php echo 1; ?>"><i class="fas fa-step-backward"></i></a></li>
				<li><a href="?pagina=<?php echo $pagina-1; ?>"><i class="fas fa-backward"></i></a></li>
				<?php  
					}
					for ($i=1; $i <= $total_paginas ; $i++) { 
						if($i == $pagina){
							echo '<li class="pageSelected">'.$i.'</li>';
						}else{
							echo '<li><a href="?pagina='.$i.'">'.$i.'</a></li>';
						}

						
					}
					if($pagina !=$total_paginas)
					{
				?>

				<li><a href="?pagina=<?php echo $pagina + 1; ?>"><i class="fas fa-forward"></i></a></li>
				<li><a href="?pagina=<?php echo$total_paginas; ?>"><i class="fas fa-step-forward"></i></a></li>
			<?php } ?>
			</ul>
		</div>

	</section>

	<?php include "includes/footer.php"; ?>
</body>
</html>