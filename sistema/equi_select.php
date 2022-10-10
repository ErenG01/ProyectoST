<?php
session_start();
	if($_SESSION['rol'] != 1)
	{
		header("location: ./");
	} 
require ("includes/Class/class.php");

	if(!isset($_GET["id_not"]))


	{
	 echo "<script type='text/javascript'>
	 		alert('no existe un numero de noticia...Reintente');
	 		window.location'../Hoja_Princ.php';
	 		</script>";
	}

	$id_com=$_GET["id"];

	$reg=new Trabajo();
	$reg_1=$reg->get_datos_not($id_com);



	$tit1=$reg_1[0]["nomb_prod"];
	$ima=$reg_1[0]["foto"];
	$text_1=$reg_1[0]["desc_prod"];
	$canti=$reg_1[0]["cantidad"];
	$prec=$reg_1[0]['precio'];

	$id_ca=$reg_1[0]["id_categoria"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/script.php"; ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	
	
</head>
<body>
	<?php include "includes/header.php";?>

	<div class="producs">


		<div class="cuadro_inf">	

			<div class="img_not">
				<img src="<?php echo $ima;?>" alt="" width="500" height="500">
			</div>
				<article class="informat">

					<div class="inf">

						<center><h1><?php echo $tit1;?></h1></center>
					</div>

					<div class="precio">
						<h1>$<?php echo $prec;?></h1>	
					</div>

					<div class="dispo_c">
						<h2>Disponibles: <?php echo $canti?> piezas</h2>

					</div>
					
					<div class="btn_comprar">
						<input class="btn_comprar" type="submit" id="" name="" value="Comprar">
					</div>
				</article>
		</div>
	</div>
	<article class="espec" >
						<center><h1>Especificaciones</h1></center>
						<p><?php echo $text_1;?></p>
	</article>
	<div>
		<center><h1>Relacionados</h1></center>
	</div>
<article class="relacionados">
	
	<?php
	

	$cate = new trabajo();
	$categ = $cate->get_datos_comp($id_ca);

	for ($i=0; $i <sizeof($categ) ; $i++) 
	{ 
		$id=$categ[$i]['id_prod'];
		$nom=$categ[$i]['nomb_prod'];
		
		$prec=$categ[$i]['precio'];
	
		$ima=$categ[$i]['foto'];
	 ?>
		<section>
		 	<div class="equipos_in">
			 	<div class="nomb_equi">
			 		<center><h2><?php echo $nom;?></h2></center>
			 	</div>

			 	<div class="imagen_equi">
			 		<center><a href="equi_select.php?id=<?php echo $id;?>"><img height="130" width="60" src="<?php echo $ima;?>" alt="" ></a></center>
			 	</div>
			 	<div>
			 		<center><h2>$<?php echo $prec;?></h2></center>
			 	</div>

			</div>
		</section>	

	 
	
	 	<?php
	 
	}
	?>	
</article>	

<div class="comentarios">
	<center><h1>Comentarios</h1></center>
	<?php
	$get_co=new trabajo();
	$get_com=$get_co->get_comentarios();

	for ($i=0; $i <sizeof($get_com) ; $i++)

	{ 
		$id_co=$get_com[$i]['id_prod'];
		$nom_co=$get_com[$i]['nombre'];
		$fech=$get_com[$i]['add_fecha'];
		$comen_co=$get_com[$i]['comentario'];
		$id_usu=$get_com[$i]['usuario_id'];
		if ($id_co==$id_com) 
		{
			
		
		?>
		<article class="user_img">
				<img src="img/user.png" alt="">
		</article>

		<article class="correo"> 
			
			
		</article>

		<div class="coem">
			
				
			
			<div class="comentario_user">
				
				<div class="nombre">
					<h3><?php echo $nom_co;?>:</h3>
					
				</div>

				<div class="comen">
					
					<p><?php echo $comen_co;?></p>
				</div>
			</div>

			
		</div>
		
			<?php
		}
	}
	?>
</div>	

<div class="Comentarios_f">
	<center>
	<h1>Danos tu opinion!</h1>
	<form action="" method="post" name="comensts">

   
	
	

	<div class="comen_f">
		<label for="">comentario</label>
		<input type="text" name="coment" id="coment" required="">
	</div>
	<div>
		<input type="hidden" name="ids" id="ids" value="<?php echo $id_usu?>">
	</div>

	<div class="btn_c">
		<input type="submit" name="enviar" id="enviar"
		value="Comentar">
	</div>
	</center>	
		




	</form>

	<?php
	if (isset($_POST['enviar'])) 
	{
		$usu=new trabajo();
    	$get_us=$usu->get_usuarios();

    	$id_usu=$_SESSION['idUser']; 
		
		$comen=$_POST['coment'];
		

		$comentar=new trabajo;
		$coment =$comentar->add_comentario($comen,$id_usu,$id_com);
	}





	?>
</div>	
	
</body>
</html>