<?php  

	include "../conexion.php";
	session_start();

	if(!empty($_POST)){

		//Extraer datos del producto
		if($_POST['action'] == 'infoProducto')
		{
			$producto_id = $_POST['producto'];

			$query = mysqli_query($conection,"SELECT id_prod, nomb_prod,cantidad,precio FROM productos WHERE id_prod = $producto_id and estatus = 1");

			$result = mysqli_num_rows($query);
			if($result > 0){
				$data = mysqli_fetch_assoc($query);
				echo json_encode($data,JSON_UNESCAPED_UNICODE);
				exit;
			}
			echo 'error';
			exit;
		}

		//Buscar cliente
		if($_POST['action'] == 'searchCliente')
		{
			if(!empty($_POST['cliente'])){
				$num_docu = $_POST['cliente'];

				$query = mysqli_query($conection,"SELECT * FROM cliente WHERE numero_documento LIKE '$num_docu' and estatus = 1");
				$result = mysqli_num_rows($query);

				$data = '';
				if($result > 0){
					$data = mysqli_fetch_assoc($query);
				}else{
					$data = 0;
				}
				echo json_encode($data,JSON_UNESCAPED_UNICODE);
			}
			exit;
		}

		//Registrar cliente - Ventas
		if($_POST['action'] == 'addCLiente')
		{
			$num_documento = $_POST['numero_cliente'];
			$tipo_document = $_POST['tipo_documento'];
			$nombre	= $_POST['nom_cliente'];
			$correo	= $_POST['correo_cliente'];
			$telefono =	$_POST['tel_cliente'];
			$direccion = $_POST['dir_cliente'];
			$usuario_id = $_SESSION['idUser'];

			$query_insert = mysqli_query($conection,"INSERT INTO cliente(numero_documento,cedula,nombre,correo,telefono,direccion,usuario_id) VALUES('$num_documento','$tipo_document','$nombre','$correo','$telefono','$direccion','$usuario_id')");
			if($query_insert){
				$codCliente = mysqli_insert_id($conection);
				$msg = $codCliente;
			}else{
				$msg = 'error';
			}
			echo $msg;
			exit;
		}

		//Buscar producto
		if($_POST['action'] == 'searchProducto')
		{
			if(!empty($_POST['producto'])){
				$nomb_prod = $_POST['producto'];

				$query = mysqli_query($conection,"SELECT * FROM productos WHERE nomb_prod LIKE '$nomb_prod' and estatus = 1");
				$result = mysqli_num_rows($query);

				$data = '';
				if($result > 0){
					$data = mysqli_fetch_assoc($query);
				}else{
					$data = 0;
				}
				echo json_encode($data,JSON_UNESCAPED_UNICODE);
			}
			exit;
		}

		//Registrar producto - Ventas
		if($_POST['action'] == 'addProducto')
		{
			$categoria = $_POST['categoria'];
			$empresa = $_POST['nombre'];
			$nomb_prod	= $_POST['nom_producto'];
			$desc_prod	= $_POST['desc_producto'];
			$precio =	$_POST['precio_producto'];
			$cantidad = $_POST['cant_producto'];
			$usuario_id = $_SESSION['idUser'];

			$query_insert = mysqli_query($conection,"INSERT INTO productos (id_categoria, id_proveedor, nomb_prod, desc_prod, precio, cantidad, usuario_id) VALUES('$categoria','$empresa','$nomb_prod','$desc_prod','$precio','$cantidad','$usuario_id')");
			if($query_insert){
				$codProducto = mysqli_insert_id($conection);
				$msg = $codProducto;
			}else{
				$msg = 'error';
			}
			echo $msg;
			exit;
		}

		

		
}
	exit;

?>
