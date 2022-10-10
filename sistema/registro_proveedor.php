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
		if(empty($_POST['nombre']) || empty($_POST['contacto']) || empty($_POST['telefono']) || empty($_POST['direccion']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

			$nombre = $_POST['nombre'];
			$contacto = $_POST['contacto'];
			$telefono = $_POST['telefono'];
			$direccion = $_POST['direccion'];
			$usuario_id = $_SESSION['idUser'];

			$query_insert = mysqli_query($conection,"insert into proveedores (nombre,contacto,telefono,direccion, id_usuario) values('$nombre','$contacto','$telefono','$direccion','$usuario_id')");

				if($query_insert){
					$alert = '<p class="msg_save">Proveedor guardado correctamente.</p>';
				}else{
					$alert = '<p class="msg_error">Error al guardar el proveedor.</p>';
				}
			}
		}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/script.php"; ?>
	<title>Registro Proveedor</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		<div class="form_register">
			<h1>Registro proveedores</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
			<form action="" method="post">
				<label for="nombre">Empresa</label>
				<input type="text" name="nombre" id="nombre" placeholder="Nombre del proveedor">
				<label for="contacto">Nombre del proveedor</label>
				<input type="text" name="contacto" id="contacto" placeholder="Nombre completo del contacto">
				<label for="telefono">Telefono</label>
				<input type="number" name="telefono" id="telefono" placeholder="Telefono">
				<label for="direccion">Direccion</label>
				<input type="text" name="direccion" id="direccion" placeholder="Direccion completa">
				<button type="submit" class="btn_save"><i class="far fa-save fa-lg"></i>Guardar Proveedor</button>
			</form>

		</div>
	</section>

	<?php include "includes/footer.php"; ?>
</body>
</html>