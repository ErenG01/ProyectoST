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
				header("location: lista_usuarios.php");
			}

		?>
		
		<h1>Lista de usuarios</h1>
		<a href="registro_usuario.php" class="btn_new">Crear usuario</a>

		<form action="buscar_usuario.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="buqueda" placeholder="Buscar" value="<?php echo $busqueda; ?>">
			<input type="submit" value="Buscar" class="btn_search">
		</form>

		<table>
			<tr>
				<th>ID</th>
				<th>Nombre</th>
				<th>Correo</th>
				<th>Usuario</th>
				<th>Rol</th>
				<th>Acciones</th>
			</tr>
		<?php  

			//Paginador
		$rol = '';
		if($busqueda == 'administrador'){
			$rol = "or rol like '%1%'";
		}else if($busqueda == 'supervisor'){
			$rol = "or rol like '%2%'";
		}else if($busqueda == 'proveedor'){
			$rol = "or rol like '%3%'";
		}else if($busqueda == 'cliente'){
			$rol = "or rol like '%4%'";
		}
			$sql_registe = mysqli_query($conection,"SELECT COUNT(*) AS total_registro FROM registro_sesion WHERE (Id_usuario LIKE '%$busqueda%' OR nombre LIKE '%$busqueda%' OR correo LIKE '%$busqueda%' OR usuario LIKE '%$busqueda%' $rol) AND estatus = 1");
			
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
			
			$query = mysqli_query($conection,"SELECT r_s.Id_usuario, r_s.nombre, r_s.correo, r_s.usuario, r.rol FROM registro_sesion r_s INNER JOIN rol r ON r_s.rol = r.idrol where (r_s.Id_usuario LIKE '%$busqueda%' OR r_s.nombre LIKE '%$busqueda%' OR r_s.correo LIKE '%$busqueda%' OR r_s.usuario LIKE '%$busqueda%' OR r.rol LIKE '%$busqueda%') AND  estatus = 1 ORDER BY r_s.Id_usuario ASC limit $desde,$por_pagina");

			$result = mysqli_num_rows($query);
			if($result > 0){
				while ($data = mysqli_fetch_array($query)){

		?>

			<tr>
				<td><?php echo $data["Id_usuario"] ?></td>
				<td><?php echo $data["nombre"] ?></td>
				<td><?php echo $data["correo"] ?></td>
				<td><?php echo $data["usuario"] ?></td>
				<td><?php echo $data["rol"] ?></td>
				<td>
					<a class="link_edit" href="editar_usuario.php?id=<?php echo $data["Id_usuario"] ?>">Editar</a>

					<?php if($data["rol"]!="Administrador"){

					?>
					|
					<a class="link_delete" href="eliminar_confirmar_usuario.php?id=<?php echo $data["Id_usuario"] ?>">Eliminar</a>
					<?php } ?>
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