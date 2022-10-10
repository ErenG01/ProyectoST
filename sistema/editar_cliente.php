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
		if(empty($_POST['cedula']) || empty($_POST['documento']) || empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['telefono']) || empty($_POST['direccion']))
		
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{
			$id_cl = $_GET['id'];
			
			$cedu = $_POST['cedula'];
			$nume_docu = $_POST['documento'];
			$nombr= $_POST['nombre'];
			$cor = $_POST['correo'];
			$telef = $_POST['telefono'];
			$direc = $_POST['direccion'];
			$hidd= $_POST['prohid'];

				$sql_update = mysqli_query($conection,"update cliente set cedula = '$cedu', numero_documento ='$nume_docu' ,nombre = '$nombr', correo = '$cor', telefono = '$telef', direccion = '$direc' where id_cliente = '$id_cl';");
				
			
				if($sql_update){
					$alert = '<p class="msg_save">Proveedor actualizado correctamente.</p>';
				}else{
					$alert = '<p class="msg_error">Error al actualizar el cliente.</p>';
				}
			}
	}

	//Mostrar datos

	if(empty($_REQUEST['id']))
	{
		header('Location: lista_proveedores.php');
	}
	$id_cl = $_GET['id'];
	require("includes/Class/class.php");
	$get_c=new trabajo;
	$get_clien=$get_c->get_datos_clien($id_cl);

	
		for ($i=0; $i <sizeof($get_clien) ; $i++) {
			
		
			$id_c=$get_clien[$i]['id_cliente'];
			$num_docu = $get_clien[$i]['numero_documento'];
			$nomb = $get_clien[$i]['nombre'];
			$cor= $get_clien[$i]['correo'];
			$tel= $get_clien[$i]['telefono'];
			$direc = $get_clien[$i]['direccion'];
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
			<h1>Editar Cliente</h1>
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
				<input type="number" name="documento" id="documento" placeholder="Numero de documento" value="<?php echo $num_docu;?>">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" id="nombre" placeholder="Nombre completo" value="<?php echo $nomb;?>">
				<label for="correo">Correo</label>
				<input type="email" name="correo" id="correo" placeholder="Correo electronico" value="<?php echo $cor;?>">
				<label for="telefono">Telefono</label>
				<input type="number" name="telefono" id="telefono" placeholder="Telefono" value="<?php echo $tel;?>">
				<label for="direccion">Direccion</label>
				<input type="text" name="direccion" id="direccion" placeholder="Direccion" value="<?php echo $direc;?>">
				<input id="idh" name="prohid" type="hidden" value="<?php echo $id_c;?>">
					
				<input type="submit" value="Actualizar" class="btn_save">
			</form>

		</div>
	</section>

	<?php include "includes/footer.php"; ?>
</body>
</html>