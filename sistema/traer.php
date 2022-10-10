<?php
require ("includes/Class/class.php");
	/*if (isset($_POST['enviar'])) 
	{
		$order=$_POST['ordenar_Por'];
		$filt=$_POST['nombb'];
		$fil_prec=$_POST['numero'];
	}
*/	if (isset($_POST['ma_a_me'])) 
					{
						$mame=new trabajo();
						$get_resul=$mame->get_datos_filtro();

						print_r($get_resul);
						die();
					}


					
	?>	