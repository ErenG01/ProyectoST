<?php 
session_start();
	if($_SESSION['rol'] != 1)
	{
		header("location: ./");
	}
include "../conexion.php";

if(!empty($_POST))
{	
	if($_POST['idusuario'] == 1){
		header("location: lista_usuarios.php");
		exit;
	}
	$idusuario = $_POST['idusuario'];

	$query_delete = mysqli_query($conection,"delete from registro_sesion where Id_usuario = $idusuario");
	//$query_delete = mysqli_query($conection,"update registro_sesion set estatus = 0 where Id_usuario = $idusuario");

	if($query_delete){
		header("location: lista_usuarios.php");
	}else{
		echo "Error al eliminar";
	}
}

if(empty($_REQUEST['id']))
{
	header("location: lista_usuarios.php");
}else{

	$idusuario = $_REQUEST['id'];

	$query = mysqli_query($conection,"SELECT r_s.nombre,r_s.usuario,r.rol FROM registro_sesion r_s INNER JOIN rol r ON r_s.rol = r.idrol WHERE r_s.Id_usuario = $idusuario");

	$result = mysqli_num_rows($query);

	if($result > 0){
		while ($data = mysqli_fetch_array($query)){
			$nombre = $data['nombre'];
			$usuario = $data['usuario'];
			$rol = $data['rol'];
		}
	}else{
		header("location: lista_usuarios.php");
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/script.php"; ?>
	<title>Eliminar Usuario</title>
	<link rel="stylesheet" type="css/estilos.css" href="">
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		<div class="data_delete">
			<h2>¿Esta seguro de eliminar el siguiente registro?</h2>
			<p>Nombre: <span><?php echo $nombre; ?></span></p>
			<p>Usuario: <span><?php echo $usuario; ?></span></p>
			<p>Tipo usuario: <span><?php echo $rol; ?></span></p>

			<form method="post" action="">
				<input type="hidden" name="idusuario" value="<?php echo $idusuario; ?>">
				<a href="lista_usuarios.php" class="btn_cancel">Cancelar</a>
				<input type="submit" value="Aceptar" class="btn_ok">
			</form>
		</div>
	</section>

	<?php include "includes/footer.php"; ?>
</body>
</html>