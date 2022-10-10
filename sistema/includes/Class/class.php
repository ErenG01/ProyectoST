<?php 
	require("conexion.php");
	class Trabajo extends Conexion
	{
		private $visitas=array();
		private $varios=array();
		private $questions=array();
		private $comentar=array();
		private $inven=array();

		public function get_Categorias()
		{
			$sql="select * from categorias order by id_categoria asc";

			$res=$this->conex->query($sql);

			while($reg=mysqli_fetch_assoc($res))
			{
				$this->varios[]=$reg;
			}
			return $this->varios;
		}
		public function get_Categorias_nom($id_nom)
		{
			$sql="select * from categorias where id_categoria = '$id_nom' order by id_categoria asc";

			$res=$this->conex->query($sql);

			while($reg=mysqli_fetch_assoc($res))
			{
				$this->varios[]=$reg;
			}
			return $this->varios;
		}

		public function get_productos()
		{
			$sql="select * from productos";

			$res=$this->conex->query($sql);

			while($reg1=mysqli_fetch_assoc($res))
			{
				$this->visitas[]= $reg1;
			}
			return $this->visitas;	
		}

		public function get_preguntas()
		{
			$sql="select * from preguntas_asistente";

			$res=$this->conex->query($sql);

			while($reg2=mysqli_fetch_assoc($res))
			{	
				$this->questions[]= $reg2;

			}	
			return $this->questions;

		}
		public function sube_archivo()
		{
			$sql= "insert into subir_imagen(id_imagen, nombre, size, type, imagen)values('null', '$nombre', '$tamaño', '$type', 'null')";
			$res=$this->conex->query($sql);

			echo "<script type='text/javascript'>
 				alert('la imagen fue adicionado correctamente...');
 				window.location='subir_imagen.php.php'
 				</script>";

		}
		public function add_comentario($comen, $id_s, $id_p)
		{
			$sql="insert into comentarios_pro(comentario, usuario_id, id_prod)values('$comen','$id_s', '$id_p')";
			$res=$this->conex->query($sql);

				echo "<script type='text/javascript'>
 				alert('el comentario fue adicionado correctamente...');
 				window.location=''
 				</script>";

		}
		public function get_usuarios()
		{
			$sql="select * from registro_sesion";

			$res=$this->conex->query($sql);

			while($reg1=mysqli_fetch_assoc($res))
			{
				$this->visitas[]= $reg1;
			}
			return $this->visitas;	
		}
		public function get_comentarios()
		{
			$sql="select * from coment_registro, registro_sesion where coment_registro.usuario_id  =  registro_sesion.Id_usuario;";

			$res=$this->conex->query($sql);

			while($reg=mysqli_fetch_assoc($res))
			{	
				$this->inven[]=$reg;

			}	
			return $this->inven;	
		}

		public function get_inventario()
		{
			$sql="select * from inventario";

			$res=$this->conex->query($sql);

			while($reg= mysqli_fetch_assoc($res))
			{
				$this->inven[]=$reg;
			}
			return $this->inven;
		}
		public function get_equipos()
		{
			$sql="select * from equipos where Id_categoria=9";

			$res=$this->conex->query($sql);

			while ($reg = mysqli_fetch_assoc($res)) 
			{
				$this->inven[]=$reg;
			}
			return $this->inven;
		}
		public function get_equipos_pc()
		{
			$sql="select * from equipos where Id_categoria=9";

			$res=$this->conex->query($sql);

			while ($reg = mysqli_fetch_assoc($res)) 
			{
				$this->inven[]=$reg;
			}
			return $this->inven;
		}
		public function get_datos_not($id_not)
		{
			$sql="select * from productos where id_prod='$id_not'";

			$res=$this->conex->query($sql);
			while($reg1=mysqli_fetch_assoc($res))
			{
				$this->inven[]=$reg1;
			}
			return $this->inven;

		}
		public function get_mens_asis()
		{
			$sql="select * from mensajes_asis";

			$res=$this->conex->query($sql);
			while($reg1=mysqli_fetch_assoc($res))
			{
				$this->inven[]=$reg1;
			}
			return $this->inven;


		}
		public function delete_msgs()
		{
			$sql="DELETE FROM `usuarios_asis` & `mensajes_asis` ";
			$res=$this->conex->query($sql);

				echo "<script type='text/javascript'>
 				alert('Se termino la sesion');
 				window.location='../AsistenteVirtual/Asistentevirtual.php'
 				</script>";

		}
		public function get_pro($inicio,$c)
		{
			$sql="select * from productos where Id_categoria='$c' order by id_prod desc limit $inicio,3";
			$res=$this->conex->query($sql);
			while($reg1=mysqli_fetch_assoc($res))
			{
				$this->inven[]=$reg1;
			}
			return $this->inven;
		}
		public function get_datos_comp($id_com)
		{
			$sql="select * from productos where id_categoria='$id_com' order by id_prod ";

			$res=$this->conex->query($sql);
			while($reg1=mysqli_fetch_assoc($res))
			{
				$this->inven[]=$reg1;
			}
			return $this->inven;
		}
		public function get_datos_clien($id_com)
		{
			$sql="select * from cliente where id_cliente='$id_com'";

			$res=$this->conex->query($sql);
			while($reg1=mysqli_fetch_assoc($res))
			{
				$this->inven[]=$reg1;
			}
			return $this->inven;
		}
/*================ filtro====================*/		
		public function get_datos_filtro($id_com)
		{
			$sql="select * from productos where id_categoria='$id_com' order by precio desc";

			$res=$this->conex->query($sql);
			while($reg1=mysqli_fetch_assoc($res))
			{
				$this->varios[]=$reg1;
			}
			return $this->varios;
		}
		public function get_datos_filtro_me_ma($id_com)
		{
			$sql="select * from productos where id_categoria='$id_com' order by precio asc";

			$res=$this->conex->query($sql);
			while($reg1=mysqli_fetch_assoc($res))
			{
				$this->varios[]=$reg1;
			}
			return $this->varios;
		}
		public function get_datos_filtro_n_z_a($id_com)
		{
			$sql="select * from productos where id_categoria ='$id_com' order by nomb_prod desc";

			$res=$this->conex->query($sql);
			while($reg1=mysqli_fetch_assoc($res))
			{
				$this->varios[]=$reg1;
			}
			return $this->varios;
		}
		public function get_datos_filtro_n_a_z($id_com)
		{
			$sql="select * from productos where id_categoria ='$id_com' order by nomb_prod asc";

			$res=$this->conex->query($sql);
			while($reg1=mysqli_fetch_assoc($res))
			{
				$this->questions[]=$reg1;
			}
			return $this->questions;
		}

		public function get_datos_filtro_buscador($busca, $id_com)
		{
			$sql="select * from productos where (nomb_prod LIKE '%$busca%' or desc_prod LIKE '%$busca%') AND id_categoria = '$id_com'";

			$res=$this->conex->query($sql);
			while($reg1=mysqli_fetch_assoc($res))
			{
				$this->varios[]=$reg1;
			}
			return $this->varios;
		}
		public function get_ventas()
		{
			$sql="select * from detalle_temp";

			$res=$this->conex->query($sql);
			while($reg1=mysqli_fetch_assoc($res))
			{
				$this->varios[]=$reg1;
			}
			return $this->varios;
		}
		
		
	}	
?>