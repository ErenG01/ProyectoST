<?php  
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/script.php"; ?>
	<title>ProyectoST</title>
	<link rel="stylesheet" type="css/estilos.css" href="">
</head>
<body>
	<div class="nav">
	<?php include "includes/header.php"; ?>
	</div>

	
<section>
	<div class="slider">
		<ul>
			<li>
				<img src="img/slider/marcas.png" alt="" height="450" width="110">
				<img src="img/slider/Componenetes.png" alt="" height="450" width="110">
				<img src="img/slider/pcs.png" alt="" height="450" width="110">
				<img src="img/slider/procesadores.png" alt="" height="450" width="110">
			</li>
		</ul>
	</div>
</section>		
	<article class="bienvenida">
		
		<img src="img/fondoMsg.png" alt="" class="negro">
		<img src="img/h3-5.png" alt="" class="otro">
		
	</article>
	<div class="nosotros_img">
		<center><img src="img/nosotros.png" alt=""></center>
	</div>

	<article class="armatupc">
		<img src="img/armatupc.jpg" alt="" class="personali_img">
		<img src="img/componentes.png" alt="" class="comp_img">
	</article>
	<article class="armatupc_img">
		
		<img src="img/personaliza.png" alt="" class="armatupc_imge">
		<img src="img/losmejoresc.png" alt="" class="personaliza_img">
	</article>

	
	<?php include "includes/footer.php"; ?>
</body>
</html>