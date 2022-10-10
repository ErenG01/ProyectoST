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
		if(empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['rol']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

			$idUsuario = $_POST['id'];
			$nombre = $_POST['nombre'];
			$email = $_POST['correo'];
			$user = $_POST['usuario'];
			$clave = md5($_POST['clave']);
			$rol = $_POST['rol'];

			$query = mysqli_query($conection,"select * from registro_sesion where (usuario = '$user' and Id_usuario != $idUsuario) or (correo= '$email' and Id_usuario != $idUsuario)");

			$result = mysqli_fetch_array($query);

			if($result > 0){
				$alert = '<p class="msg_error">El correo o el usuario ya existen.</p>';
			}else{
				if(empty($_POST['clave']))
				{
					$sql_update = mysqli_query($conection,"update registro_sesion set nombre = '$nombre', correo='$email',usuario = '$user', clave = '$clave', rol = '$rol' where Id_usuario = $idUsuario");
				}else{
					$sql_update = mysqli_query($conection,"update registro_sesion set nombre = '$nombre', correo='$email',usuario = '$user', clave = '$clave', rol = '$rol' where Id_usuario = $idUsuario");
				}
				if($sql_update){
					$alert = '<p class="msg_save">Usuario actualizado correctamente.</p>';
				}else{
					$alert = '<p class="msg_error">Error al actualizar el usuario.</p>';
				}
			}
		}
	}

	//Mostrar datos

	if(empty($_REQUEST['id']))
	{
		header('Location: lista_usuarios.php');
	}
	$iduser = $_REQUEST['id'];

	$sql = mysqli_query($conection,"SELECT r_s.Id_usuario, r_s.nombre, r_s.correo, r_s.usuario, r_s.rol AS idrol, (r.rol) AS rol FROM registro_sesion r_s INNER JOIN rol r ON r_s.rol = r.idrol WHERE Id_usuario = $iduser");

	$result_sql = mysqli_num_rows($sql);

	if($result_sql == 0){
		header('Location: lista_usuarios.php');
	}else{
		$option = ''; 
		while ($data = mysqli_fetch_array($sql)){
			$iduser = $data['Id_usuario'];
			$nombre = $data['nombre'];
			$correo = $data['correo'];
			$usuario = $data['usuario'];
			$idrol = $data['idrol'];
			$rol = $data['rol'];

			if($idrol == 1){
				$option = '<option value="'.$idrol.'" select>'.$rol.'</option>';
			}else if($idrol == 2){
				$option = '<option value="'.$idrol.'" select>'.$rol.'</option>';
			}else if($idrol == 3){
				$option = '<option value="'.$idrol.'" select>'.$rol.'</option>';
			}
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/script.php"; ?>
	<title>Actualizar Usuario</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		<div class="form_register">
			<h1>Actualizar usuarios</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post">
				<input type="hidden" name="id" value="<?php echo $iduser; ?>">
				<label for="Nombre">Nombre</label>
				<input type="text" name="nombre" id="nombre" placeholder="Nombre completo" value="<?php echo $nombre; ?>">
				<label for="Correo">Correo electronico</label>
				<input type="email" name="correo" id="correo" placeholder="Correo electronico" value="<?php echo $correo; ?>">
				<label for="Usuario">Usuario</label>
				<input type="text" name="usuario" id="usuario" placeholder="Usuario" value="<?php echo $usuario; ?>">
				<label for="clave">Clave</label>
				<input type="password" name="clave" id="clave" placeholder="Clave de acceso">
				<label for="Rol">Tipo de usuario</label>

				<?php
				$query_rol = mysqli_query($conection,"select * from rol");
				$result_rol =  mysqli_num_rows($query_rol);


				?>
				<select name="rol" id="rol" class="notItemOne">
					<?php  
					echo $option;
						if($result_rol > 0)
						{
							while ($rol = mysqli_fetch_array($query_rol)){
					?>
							<option value="<?php echo $rol["idrol"]; ?>"><?php echo $rol["rol"] ?></option>
					<?php
							}
						}
					?>
				</select>	
				<input type="submit" value="Actualizar usuario" class="btn_save">
			</form>

		</div>
	</section>

	<?php include "includes/footer.php"; ?>
</body>
</html>