<?php 
session_start();
	if($_SESSION['rol'] != 1 and $_SESSION['rol'] !=2)
	{
		header("location: ./");
	}
include "../conexion.php";

if(!empty($_POST))
{	
	if(empty($_POST['idcliente'])){
		header("location: lista_clientes.php");
	}
	
	$idcliente = $_POST['idcliente'];

	$query_delete = mysqli_query($conection,"delete from cliente where id_cliente = $idcliente");
	//$query_delete = mysqli_query($conection,"update registro_sesion set estatus = 0 where Id_usuario = $idusuario");

	if($query_delete){
		header("location: lista_clientes.php");
	}else{
		echo "Error al eliminar";
	}
}

if(empty($_REQUEST['id']))
{
	header("location: lista_clientes.php");
}else{

	$idcliente = $_REQUEST['id'];

	$query = mysqli_query($conection,"SELECT * FROM cliente WHERE cliente.id_cliente = $idcliente");

	$result = mysqli_num_rows($query);

	if($result > 0){
		while ($data = mysqli_fetch_array($query)){
		
			$num_document = $data['numero_documento'];
			$nombre = $data['nombre'];
		}
	}else{
		header("location: lista_clientes.php");
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/script.php"; ?>
	<title>Eliminar Cliente</title>
	<link rel="stylesheet" type="css/estilos.css" href="">
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		<div class="data_delete">
			<h2>¿Esta seguro de eliminar el siguiente registro?</h2>
			<p>Numero de documento: <span><?php echo $num_document; ?></span></p>
			<p>Nombre: <span><?php echo $nombre; ?></span></p>	

			<form method="post" action="">
				<input type="hidden" name="idcliente" value="<?php echo $idcliente; ?>">
				<a href="lista_clientes.php" class="btn_cancel">Cancelar</a>
				<input type="submit" value="Aceptar" class="btn_ok">
			</form>
		</div>
	</section>

	<?php include "includes/footer.php"; ?>
</body>
</html>