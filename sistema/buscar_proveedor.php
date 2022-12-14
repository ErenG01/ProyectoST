<?php  
	session_start();
	if($_SESSION['rol'] != 1 and $_SESSION['rol'] != 2)
	{
		header("location: ./");
	}
	include"../conexion.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/script.php"; ?>
	<title>Lista de usuarios</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		<?php  

			$busqueda = strtolower($_REQUEST['busqueda']);
			if(empty($busqueda))
			{
				header("location: lista_proveedores.php");
			}

		?>
		
		<h1>Lista de clientes</h1>
		<a href="registro_proveedor.php" class="btn_new">Crear cliente</a>

		<form action="buscar_proveedor.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="buqueda" placeholder="Buscar" value="<?php echo $busqueda; ?>">
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
			$sql_registe = mysqli_query($conection,"SELECT COUNT(*) AS total_registro FROM proveedores WHERE (id_proveedor LIKE '%$busqueda%' OR nombre LIKE '%$busqueda%' OR contacto LIKE '%$busqueda%' OR telefono LIKE '%$busqueda%' OR direccion LIKE '%$busqueda%') AND estatus = 1");
			
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
			
			$query = mysqli_query($conection,"SELECT * FROM proveedores where (id_proveedor LIKE '%$busqueda%' OR nombre LIKE '%$busqueda%' OR contacto LIKE '%$busqueda%' OR telefono LIKE '%$busqueda%' OR direccion LIKE '%$busqueda%') AND  estatus = 1 ORDER BY proveedores.id_proveedor ASC limit $desde,$por_pagina");

			mysqli_close($conection);

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
					<a class="link_delete" href="eliminar_confirmar_cliente.php?id=<?php echo $data["id_cliente"] ?>">Eliminar</a>
				</td>
			</tr>

		<?php
				}
			}
		?>
		</table>
		<?php 

			if($total_registro !=0)
			{

		 ?>
		<div class="paginador">
			<ul>
				<?php  
					if($pagina !=1)
					{
				?>
				<li><a href="?pagina=<?php echo 1; ?>&busqueda=<?php echo $busqueda; ?>">|<</a></li>
				<li><a href="?pagina=<?php echo $pagina-1; ?>&busqueda=<?php echo $busqueda; ?>">|<<</a></li>
				<?php  
					}
					for ($i=1; $i <= $total_paginas ; $i++) { 
						if($i == $pagina){
							echo '<li class="pageSelected">'.$i.'</li>';
						}else{
							echo '<li><a href="?pagina='.$i.'&busqueda='.$busqueda.'">'.$i.'</a></li>';
						}

						
					}
					if($pagina !=$total_paginas)
					{
				?>

				<li><a href="?pagina=<?php echo $pagina + 1; ?>&busqueda=<?php echo $busqueda; ?>">>>|</a></li>
				<li><a href="?pagina=<?php echo$total_paginas; ?>&busqueda=<?php echo $busqueda; ?>">>|</a></li>
			<?php } ?>
			</ul>
		</div>
	<?php   } ?>

	</section>

	<?php include "includes/footer.php"; ?>
</body>
</html>