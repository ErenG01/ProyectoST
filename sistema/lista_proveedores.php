<?php 
	session_start();
	if($_SESSION['rol'] != 1 and $_SESSION['rol'] !=2)
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
	<title>Lista de Proveedor</title>
</head>
<body>
<div class="container_01">	
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<h1>Lista de proveedores</h1>
		<a href="registro_proveedor.php" class="btn_new">Crear proveedor</a>
		<hr>
		
		<form action="../reportespdf/reporte_proveedor.php" method="post" class="formu_report" enctype="multipart/form-data">
		<input type="submit" name="btn_report" class="btn_r_new" value="Generar reporte" height="150">	
		<p class="h3a">DESDE</p>
		<input type="date" name="fech1" size="5" class="fechs" required="">
		<p class="h3a">HASTA</p>
		<input type="date" name="fech2" size="5" class="fechs" required="">
		</form>

		<form action="buscar_proveedor.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="buqueda" placeholder="Buscar">
			<input type="submit" value="Buscar" class="btn_search">
		</form>

		<table>
			<tr>
				<th>ID</th>
				<th>Empresa</th>
				<th>Nombre Proveedor</th>
				<th>telefono</th>
				<th>Direccion</th>
				<th>Fecha</th>
				<th>Acciones</th>
			</tr>
		<?php  

			//Paginador
			$sql_registe = mysqli_query($conection,"SELECT COUNT(*) AS total_registro FROM proveedores WHERE estatus = 1");
			
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
			
			$query = mysqli_query($conection,"SELECT * FROM proveedores where estatus = 1 ORDER BY Id_usuario ASC LIMIT $desde,$por_pagina");

			$result = mysqli_num_rows($query);
			if($result > 0){
				while ($data = mysqli_fetch_array($query)){

					$formato = 'Y-m-d H:i:s';
					$fecha = DateTime::createFromFormat($formato,$data['fecha_add'])
		?>

			<tr>
				<td><?php echo $data["id_proveedor"]; ?></td>
				<td><?php echo $data["nombre"]; ?></td>
				<td><?php echo $data["contacto"]; ?></td>
				<td><?php echo $data["telefono"]; ?></td>
				<td><?php echo $data["direccion"]; ?></td>
				<td><?php echo $fecha->format('d-m-Y'); ?></td>
				<td>
					<a class="link_edit" href="editar_proveedor.php?id=<?php echo $data["id_proveedor"] ?>">Editar</a>
					|
					<a class="link_delete" href="eliminar_confirmar_proveedor.php?id=<?php echo $data["id_proveedor"] ?>">Eliminar</a>
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
				<li><a href="?pagina=<?php echo 1; ?>">|<</a></li>
				<li><a href="?pagina=<?php echo $pagina-1; ?>">|<<</a></li>
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

				<li><a href="?pagina=<?php echo $pagina + 1; ?>">>>|</a></li>
				<li><a href="?pagina=<?php echo$total_paginas; ?>">>|</a></li>
			<?php } ?>
			</ul>
		</div>

	</section>

	<?php include "includes/footer.php"; ?>
</div>	
</body>
</html>