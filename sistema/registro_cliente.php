<?php 
	session_start();
	if($_SESSION['rol'] != 1 and $_SESSION['rol'] !=2 and $_SESSION['rol'] !=3)
	{
		header("location: ./");
	}
	include "../conexion.php";

	if(!empty($_POST))
	{
		$alert='';

		if(empty($_POST['cedula']) || empty($_POST['documento']) || empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['telefono']) || empty($_POST['direccion']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

			$cedula = $_POST['cedula'];
			$num_document = $_POST['documento'];
			$nombre = $_POST['nombre'];
			$email = $_POST['correo'];
			$telefono = $_POST['telefono'];
			$direccion = $_POST['direccion'];
			$usuario_id = $_SESSION['idUser'];

			$result = 0;
			if(is_numeric($num_document))
			{
				$query = mysqli_query($conection,"select * from cliente where numero_documento = '$num_document'");
				$result = mysqli_fetch_array($query);
			}

			if($result > 0){
				$alert = '<p class="msg_error">El correo o el usuario ya existen.</p>';
			}else{
				$query_insert = mysqli_query($conection,"insert into cliente (cedula,numero_documento,nombre,correo,telefono,direccion,usuario_id) values('$cedula','$num_document','$nombre','$email','$telefono','$direccion','$usuario_id')");

				if($query_insert){
					$alert = '<p class="msg_save">Cliente agregado correctamente.</p>';
				}else{
					$alert = '<p class="msg_error">Error al agregar el cliente.</p>';
				}
			}

		}
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/script.php"; ?>
	<title>Registro Cliente</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		<div class="form_register">
			<h1>Registro cliente</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
			<form action="" method="post">
				<label for="tipo_document">Tipo de documento</label>
				<?php
				$query_cedula = mysqli_query($conection,"select * from cedula");
				$result_cedula =  mysqli_num_rows($query_cedula);


				?>
				<select name="cedula" id="cedula">
					<?php  
						if($result_cedula > 0)
						{
							while ($cedula = mysqli_fetch_array($query_cedula)){
					?>
							<option value="<?php echo $cedula["Id_cedula"]; ?>"><?php echo $cedula["tipo_documento"] ?></option>
					<?php
							}
						}
					?>
				</select>
				<label for="documento">Numero de documento</label>
				<input type="number" name="documento" id="documento" placeholder="Numero de documento">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" id="nombre" placeholder="Nombre completo">
				<label for="correo">Correo</label>
				<input type="email" name="correo" id="correo" placeholder="Correo electronico">
				<label for="telefono">Telefono</label>
				<input type="number" name="telefono" id="telefono" placeholder="Telefono">
				<label for="direccion">Direccion</label>
				<input type="text" name="direccion" id="direccion" placeholder="Direccion">
					
				<input type="submit" value="Guardar cliente" class="btn_save">
			</form>

		</div>
	</section>

	<?php include "includes/footer.php"; ?>
</body>
</html>