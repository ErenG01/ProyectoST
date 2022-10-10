<?php
session_start();
	if($_SESSION['rol'] != 1)
	{
		header("location: ./");
	} 
require ("includes/Class/class.php");

	if(!isset($_GET["id_com"]))


	{
	 echo "<script type='text/javascript'>
	 		alert('no existe un numero de noticia...Reintente');
	 		window.location'../Hoja_Princ.php';
	 		</script>";
	}

	$id_com=$_GET["id_c"];

	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/script.php"; ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="ccs/estilos.css">
</head>
<body>
<?php include "includes/header.php";?>

<div class="islo">
	
	<?php
	

	$cate = new trabajo();
	$categ = $cate->get_datos_filtro($id_com);

	for ($i=0; $i <sizeof($categ) ; $i++) 
	{ 
		$id=$categ[$i]['id_prod'];
		$nom=$categ[$i]['nomb_prod'];
		$des=$categ[$i]['desc_prod'];
		$prec=$categ[$i]['precio'];
	
		$ima=$categ[$i]['foto'];
	 ?>
	
		 <div class="equipos_i">
			 	<div class="nomb_eq">
			 		<h2><?php echo $nom;?></h2>
			 	</div>

			 	<div class="imagen_eq">
			 		<center><a href="equi_select.php?id=<?php echo $id;?>"><img src="<?php echo $ima;?>" alt=""></a></center>
			 	</div>
			 	<div>
			 		<h2><?php echo $prec;?></h2>
			 	</div>


			 	<div class="desc_eq">
			 		<p><?php echo $des;?></p>
			 	</div>

			 	
		 </div>

	 
	
	 	<?php
	}
	





	?>	
</div>
	
</div>
	<div class="categorias">
					<center><h3>Categorias</h3></center>
					
					<?php
					

					$val = new trabajo();
					$valor = $val->get_Categorias();

					 for ($i=0; $i <sizeof($valor); $i++)

					 	
					 	

					 { 
					 	$id_c=$valor[$i]["Id_categoria"];
					 	$desc=$valor[$i]['Desc_categ'];
					 	?>
					 	<br>
					 	<div class="lista_cat">
					 	<h2><a href="componentes.php?id_c=<?php echo $id_c;?>"><?php echo $desc?></a></h2>
					 	</div>
					 	<?php	
					 }

					?>
	</div>
<div class="filtro_form">
		<?php
		$ma_a_me="mayor a menor precio";
		$me_a_ma="menor a mayor precio";




		?>
		<form action="" method="post" name="form" class="formu_filtro">
			
			<label for="">ORDENAR POR</label>
			
			<ul>
				
					<li><a href="componenetes_2.php?id_c=id_c">Mayor a menor</a></li>
					<li><a href="#">Menor a mayor</a></li>
					<li><a href="#">Nombre: A - Z</a></li>
					<li><a href="#">Nombre: Z - A</a></li>
				
			</ul>

			<label for="">FILTROS</label>
			<input type="text" name="proo" id="nombb">

			<label for="">FILTRAR POR PRECIO</label>
			<div class="filt_por_numero">
				<div class="1_espace">
					<input type="number" id="range-1" class="form-control" placeholder="desde" min="0" max="99999" name="range-1" value="1">
				</div>

				<div class="2_espace">
					<input type="number" id="range-1" class="form-control" placeholder="desde" min="0" max="99999" name="range-1" value="1">
				</div>
			</div>

			<input type="submit" id="enviar" name="enviar" value="FILTRAR">
		</form>
	</div>
	<?php
	/*if (isset($_POST['enviar'])) 
	{
		$order=$_POST['ordenar_Por'];
		$filt=$_POST['nombb'];
		$fil_prec=$_POST['numero'];
	}
*/

	?>	
</body>
</html>