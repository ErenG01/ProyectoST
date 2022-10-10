<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<form action="" method="post" name="form">
				<label for="tipo_document">Tipo de 

				
				
				<label for="documento">Numero de documento</label>
				<input type="text" name="documento" id="documento" placeholder="Numero de documento" value="">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" id="nombre" placeholder="Nombre completo" value="">
				<label for="correo">Correo</label>
				<input type="email" name="correo" id="correo" placeholder="Correo electronico" value="">
				<label for="telefono">Telefono</label>
				<input type="text" name="telefono" id="telefono" placeholder="Telefono" value="">
				<label for="direccion">Direccion</label>
				<input type="text" name="direccion" id="direccion" placeholder="Direccion" value="">
				<input id="prohid" name="prohid" type="hidden" value="">
					
				<input type="submit" value="Actualizar" class="btn_save" name="enviar" id="enviar">
			</form>
			<?php
			if(isset($_POST['enviar']))
			{ 		
			$algo=$_POST['nombre'];
			echo $algo;
			}	


	?>
	
</body>
</html>