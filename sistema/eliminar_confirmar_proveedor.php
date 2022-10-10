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
	
	$idproveedor = $_POST['idproveedor'];

	$query_delete = mysqli_query($conection,"delete from proveedores where id_proveedor = $idproveedor");
	//$query_delete = mysqli_query($conection,"update registro_sesion set estatus = 0 where Id_usuario = $idusuario");

	if($query_delete){
		header("location: lista_clientes.php");
	}else{
		echo "Error al eliminar";
	}
}

if(empty($_REQUEST['id']))
{
	header("location: lista_proveedores.php");
}else{

	$idproveedor = $_REQUEST['id'];

	$query = mysqli_query($conection,"SELECT * FROM proveedores WHERE id_proveedor = $idproveedor");

	$result = mysqli_num_rows($query);

	if($result > 0){
		while ($data = mysqli_fetch_array($query)){
		
			$nombre = $data['nombre'];
			$contacto = $data['contacto'];
			$telefono = $data['telefono'];
		}
	}else{
		header("location: lista_proveedores.php");
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/script.php"; ?>
	<title>Eliminar Proveedor</title>
	<link rel="stylesheet" type="css/estilos.css" href="">
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		<div class="data_delete">
			<i class="far fa-building fa-7x" style="color: #e66262;"></i>
			<h2>¿Esta seguro de eliminar el siguiente registro?</h2>
			<p>Empresa: <span><?php echo $nombre; ?></span></p>
			<p>Nombre proveedor: <span><?php echo $contacto; ?></span></p>
			<p>Telefono: <span><?php echo $telefono; ?></span></p>	

			<form method="post" action="">
				<input type="hidden" name="idproveedor" value="<?php echo $idproveedor; ?>">
				<a href="lista_proveedores.php" class="btn_cancel">Cancelar</a>
				<input type="submit" value="Aceptar" class="btn_ok">
			</form>
		</div>
	</section>

	<?php include "includes/footer.php"; ?>
</body>
</html>