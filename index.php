<?php 

$alert = '';
session_start();
if(!empty($_SESSION['active']))
{
	header('location: sistema/');
}else{


	if(!empty($_POST))
	{
		if(empty($_POST['usuario']) || empty($_POST['clave']))
		{
			$alert = 'Ingrese su usuario y su clave';
		}else{
			require_once"conexion.php";

			$user= mysqli_real_escape_string($conection,$_POST['usuario']);
			$pass=  md5(mysqli_real_escape_string($conection,$_POST['clave']));

			$query=mysqli_query($conection,"select * from registro_sesion where usuario ='$user' and clave = '$pass'");
			$result=mysqli_num_rows($query);

			if($result > 0)
			{
				$data=mysqli_fetch_array($query);
				$_SESSION['active'] = true;
				$_SESSION['idUser'] = $data['Id_usuario'];
				$_SESSION['nombre'] = $data['nombre'];
				$_SESSION['email'] = $data['correo'];
				$_SESSION['user'] = $data['usuario'];
				$_SESSION['rol'] = $data['rol'];

				header('location: sistema/');
			}else{
				$alert = 'El usuario o la clave son incorrectos';
				session_destroy();
			}
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
</head>
<body>
	<section id="container">
		<form action="" method="post">
			<h3>Iniciar Sesion</h3>
			<img src="img/login.png" alt="Login">

			<input type="text" name="usuario" placeholder="Usuario">
			<input type="password" name="clave" placeholder="Contraseña">
			<div class="alert"><?php echo isset($alert) ? $alert : '';  ?></div>
			<input type="submit" value="INGRESAR">
			<a href="registro_usuario1.php">¡Crear mi usuario!</a>

		</form>
	</section>
</body>
</html>