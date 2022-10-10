<?php  

	session_start();
	if($_SESSION['rol'] != 1 and $_SESSION['rol'] != 2)
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

			$idProveedor = $_POST['id'];
			$nombre = $_POST['nombre'];
			$contacto = $_POST['contacto'];
			$telefono = $_POST['telefono'];
			$direccion = $_POST['direccion'];

				$sql_update = mysqli_query($conection,"update proveedores set nombre = '$nombre', contacto='$contacto',telefono = '$telefono', direccion = '$direccion' where id_proveedor = $idProveedor");
				if($sql_update){
					$alert = '<p class="msg_save">Proveedor actualizado correctamente.</p>';
				}else{
					$alert = '<p class="msg_error">Error al actualizar el proveedor.</p>';
				}
			}
	}

	//Mostrar datos

	if(empty($_REQUEST['id']))
	{
		header('Location: lista_proveedores.php');
	}
	$idproveedor = $_REQUEST['id'];

	$sql = mysqli_query($conection,"SELECT * FROM proveedores WHERE id_proveedor = $idproveedor");

	$result_sql = mysqli_num_rows($sql);

	if($result_sql == 0){
		header('Location: lista_proveedores.php');
	}else{
		$option = ''; 
		while ($data = mysqli_fetch_array($sql)){
			$idprov = $data['id_proveedor'];
			$nombre = $data['nombre'];
			$contacto = $data['contacto'];
			$telefono = $data['telefono'];
			$direccion = $data['direccion'];
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/script.php"; ?>
	<title>Actualizar Proveedor</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		<div class="form_register">
			<h1>Actualizar proveedores</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post">
				<input type="hidden" name="id" value="<?php echo $idprov ?>">
				<label for="nombre">Empresa</label>
				<input type="text" name="nombre" id="nombre" placeholder="Nombre del proveedor" value="<?php echo $nombre ?>">
				<label for="contacto">Nombre del proveedor</label>
				<input type="text" name="contacto" id="contacto" placeholder="Nombre completo del contacto" value="<?php echo $contacto ?>">
				<label for="telefono">Telefono</label>
				<input type="number" name="telefono" id="telefono" placeholder="Telefono" value="<?php echo $telefono ?>">
				<label for="direccion">Direccion</label>
				<input type="text" name="direccion" id="direccion" placeholder="Direccion completa" value="<?php echo $direccion ?>">
				<button type="submit" class="btn_save"><i class="far fa-save fa-lg"></i>Actualizar Proveedor</button>
			</form>

		</div>
	</section>

	<?php include "includes/footer.php"; ?>
</body>
</html>