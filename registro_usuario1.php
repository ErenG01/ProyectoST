<?php 
	include "conexion.php";

	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['clave']) || empty($_POST['rol']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

			$nombre = $_POST['nombre'];
			$email = $_POST['correo'];
			$user = $_POST['usuario'];
			$clave = md5($_POST['clave']);
			$rol = $_POST['rol'];

			$clave=  md5(mysqli_real_escape_string($conection,$_POST['clave']));

			$query = mysqli_query($conection,"select * from registro_sesion where usuario = '$user' or correo= '$email'");
			$result = mysqli_fetch_array($query);

			if($result > 0){
				$alert = '<p class="msg_error">El correo o el usuario ya existen.</p>';
			}else{
				$query_insert = mysqli_query($conection,"insert into registro_sesion (nombre,correo,usuario,clave,rol) values('$nombre','$email','$user','$clave','$rol')");
				if($query_insert){
					$alert = '<p class="msg_save">Usuario registrado correctamente.</p>';
				}else{
					$alert = '<p class="msg_error">Error al registrar el usuario.</p>';
				}
			}
		}
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registro Usuario</title>
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
</head>
<body>
	<section id="container">
		<div class="form_register">
			
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
			<form action="" method="post">
				<h1>Registro usuarios</h1>
				<hr>
				<label for="Nombre">Nombre</label>
				<input type="text" name="nombre" id="nombre" placeholder="Nombre completo">
				<label for="Correo">Correo electronico</label>
				<input type="email" name="correo" id="correo" placeholder="Correo electronico">
				<label for="Usuario">Usuario</label>
				<input type="text" name="usuario" id="usuario" placeholder="Usuario">
				<label for="Contraseña">Clave</label>
				<input type="password" name="clave" id="clave" placeholder="Clave de acceso">
				<label for="Rol">Tipo de usuario</label>

				<?php
				$query_rol = mysqli_query($conection,"select * from rol");
				$result_rol =  mysqli_num_rows($query_rol);


				?>
				<select name="rol" id="rol">
					<?php  
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
				<input type="submit" value="Crear usuario">
				<a href="index.php">Iniciar sesion</a>
			</form>

		</div>
	</section>
</body>
</html>