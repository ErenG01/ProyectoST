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

$val = new trabajo();
$valor = $val->get_Categorias_nom($id_com);

$nom=$valor[0]['Desc_categ'];
	
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
		
	<div class="filtro_form">
		
		<form action="" method="post" name="form" class="formu_filtro">
			
			<label for="">ORDENAR POR</label>
			<input type="submit" id="ma_a_me" name="ma_a_me" value="Mayor a menor">
			<label for="">-</label>
			<input type="submit" id="me_a_ma" name="me_a_ma" value="Menor a Mayor">

			<label for="">O</label>

			<input type="submit" id="no_z_a" name="no_z_a" value="Nombre Z - A">

			<label>-</label>

			<input type="submit" name="nombreaz"
			value="nombre A - Z">

			

			<label for="">buscar</label>
			<input type="text" name="buscador" id="buscador" >
			<input type="submit" id="btn_buscar" name="btn_buscar" value="buscar" >
		
		</form>
	</div>
<div class="islo_y_cate">
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
					 	<center><p><a href="componentes.php?id_c=<?php echo $id_c;?>"><?php echo $desc?></a></p></center>
					 	</div>
					 	<hr>
					 	<?php	
					 }

					?>
	</div>	

	
	<div class="islo">
		<center><h1><?php echo $nom;?></h1></center>
		<?php
	

	if (!isset($_POST['ma_a_me']) && !isset($_POST['btn_buscar']) && !isset($_POST['no_z_a']) && !isset($_POST['nombreaz']) && !isset($_POST['me_a_ma']))

	{
			$cate = new trabajo();
			$categ = $cate->get_datos_comp($id_com);

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
				 		<center><h2><?php echo $nom;?></h2></center>
				 	</div>

				 	<div class="imagen_eq">
				 		<center><a href="equi_select.php?id=<?php echo $id;?>"><img src="<?php echo $ima;?>" alt=""></a></center>
				 	</div>
				 	<div>
				 		<center><h2>$<?php echo $prec;?></h2></center>
				 	</div>
			 	</div>
			<?php
		}	
	}else 
	{
		if (isset($_POST['nombreaz']))
		{
			$na_z=new trabajo();
				$nom_a_z=$na_z->get_datos_filtro_n_a_z($id_com);
				for ($i=0; $i <sizeof($nom_a_z) ; $i++)
				{ 
					
				
					$id=$nom_a_z[$i]['id_prod'];
					$nom=$nom_a_z[$i]['nomb_prod'];
					$des=$nom_a_z[$i]['desc_prod'];
					$prec=$nom_a_z[$i]['precio'];
					$ima=$nom_a_z[$i]['foto'];
				?>	
					<div class="equipos_i">
					 	<div class="nomb_eq">
					 		<h2><?php echo $nom;?></h2>
					 	</div>

					 	<div class="imagen_eq">
					 		<center><a href="equi_select.php?id=<?php echo $id;?>"><img src="<?php echo $ima;?>" alt=""></a></center>
					 	</div>
					 	<div>
					 		<center><h2>$<?php echo $prec;?></h2></center>
					 	</div>
				 	</div>
				 <?php
				} 	
		}	
		
		if (isset($_POST['btn_buscar']))
		{
		
		
			$busca=$_POST['buscador'];
			

			if ($busca=="") 
			{
			

			echo "no se econtraron datos";
			}else
			{
					$search=new trabajo();
					$buscado=$search->get_datos_filtro_buscador($busca, $id_com);
					for ($i=0; $i <sizeof($buscado) ; $i++)
					{ 
						$id=$buscado[$i]['id_prod'];
						$nom=$buscado[$i]['nomb_prod'];
						$des=$buscado[$i]['desc_prod'];
						$prec=$buscado[$i]['precio'];
						$ima=$buscado[$i]['foto'];
					?>
						<div class="equipos_i">
						 	<div class="nomb_eq">
						 		<h2><?php echo $nom;?></h2>
						 	</div>

						 	<div class="imagen_eq">
						 		<center><a href="equi_select.php?id=<?php echo $id;?>"><img src="<?php echo $ima;?>" alt=""></a></center>
						 	</div>
						 	<div>
						 		<center><h2>$<?php echo $prec;?></h2></center>
						 	</div>
			 			</div>
			 			<?php
					}	
			}
		}		
			
		if (isset($_POST['ma_a_me']))
		{
			$ma_a=new trabajo();
			$mayoraM=$ma_a->get_datos_filtro($id_com);
			for ($i=0; $i <sizeof($mayoraM) ; $i++)
			{ 
					$id=$mayoraM[$i]['id_prod'];
					$nom=$mayoraM[$i]['nomb_prod'];
					$des=$mayoraM[$i]['desc_prod'];
					$prec=$mayoraM[$i]['precio'];
					$ima=$mayoraM[$i]['foto'];
				?>
					<div class="equipos_i">
						 	<div class="nomb_eq">
						 		<h2><?php echo $nom;?></h2>
						 	</div>

						 	<div class="imagen_eq">
						 		<center><a href="equi_select.php?id=<?php echo $id;?>"><img src="<?php echo $ima;?>" alt=""></a></center>
						 	</div>
						 	<div>
						 		<center><h2>$<?php echo $prec;?></h2></center>
						 	</div>
			 			</div>
				<?php	
			}	
		}
		if (isset($_POST['no_z_a'])) 
			{
				$nz_a=new trabajo();
				$nom_z_a=$nz_a->get_datos_filtro_n_z_a($id_com);
				for ($i=0; $i <sizeof($nom_z_a) ; $i++)
				{ 
					
				
					$id=$nom_z_a[$i]['id_prod'];
					$nom=$nom_z_a[$i]['nomb_prod'];
					$des=$nom_z_a[$i]['desc_prod'];
					$prec=$nom_z_a[$i]['precio'];
					$ima=$nom_z_a[$i]['foto'];
				?>	
					<div class="equipos_i">
					 	<div class="nomb_eq">
					 		<h2><?php echo $nom;?></h2>
					 	</div>

					 	<div class="imagen_eq">
					 		<center><a href="equi_select.php?id=<?php echo $id;?>"><img src="<?php echo $ima;?>" alt=""></a></center>
					 	</div>
					 	<div>
					 		<center><h2>$<?php echo $prec;?></h2></center>
					 	</div>
				 	</div>
				 <?php
				} 
			
			}
		if (isset($_POST['me_a_ma'])) 
			{
				$pme_a_ma=new trabajo();
				$p_me_a_ma=$pme_a_ma->get_datos_filtro_me_ma($id_com);
				for ($i=0; $i <sizeof($p_me_a_ma) ; $i++)
				{ 
					
				
					$id=$p_me_a_ma[$i]['id_prod'];
					$nom=$p_me_a_ma[$i]['nomb_prod'];
					$des=$p_me_a_ma[$i]['desc_prod'];
					$prec=$p_me_a_ma[$i]['precio'];
					$ima=$p_me_a_ma[$i]['foto'];
				?>	
					<div class="equipos_i">
					 	<div class="nomb_eq">
					 		<h2><?php echo $nom;?></h2>
					 	</div>

					 	<div class="imagen_eq">
					 		<center><a href="equi_select.php?id=<?php echo $id;?>"><img src="<?php echo $ima;?>" alt=""></a></center>
					 	</div>
					 	<div>
					 		<center><h2>$<?php echo $prec;?></h2></center>
					 	</div>
				 	</div>
				 <?php
				} 
			
			}
		
	}


		
	 
?>


	
</div>
	
</div>

</body>
</html>