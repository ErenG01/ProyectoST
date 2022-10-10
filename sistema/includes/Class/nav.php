<?php
require_once("Class/class.php");

$val = new Trabajo();
$valor=$val->get_Categorias();



?>		
<div class="logo_img">
			<img src="../logo/logo2.png" alt="">
			</div>	
		<nav>

			<ul>

				
			
				<li><a href="http://localhost/ProyectoST/sistema/index.php"><i class="fas fa-home"></i>Inicio</a></li>
					
				<li class="principal">

					<a href="#"><i class="fas fa-users"></i>Usuarios</a>
					<ul>
						<?php  
						if($_SESSION['rol'] == 1 || $_SESSION['rol' == 2]){	
					?>
						<li><a href="registro_usuario.php"><i class="fas fa-user-plus"></i>Nuevo Usuario</a></li>
						<li><a href="lista_usuarios.php"><i class="far fa-users"></i>Lista de Usuarios</a></li>
					</ul>
				</li>
			<?php } ?>
					<?php  
						if($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2 || $_SESSION['rol'] == 3){	
					?>
				<li class="principal">
					<a href="#"><i class="fas fa-user"></i>Clientes</a>
					<ul>
						<li><a href="registro_cliente.php"><i class="fas fa-user-plus"></i>Nuevo Cliente</a></li>
						<li><a href="lista_clientes.php"><i class="far fa-list-alt"></i>Lista de Clientes</a></li>
					</ul>
				</li>
			<?php } ?>
					<?php  
						if($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2){	
					?>
				<li class="principal">
					<a href="#"><i class="far fa-building"></i>Proveedores</a>
					<ul>
						<li><a href="registro_proveedor.php"><i class="fas fa-plus"></i>Nuevo Proveedor</a></li>
						<li><a href="lista_proveedores.php"><i class="far fa-list-alt"></i>Lista de Proveedores</a></li>
					</ul>
				</li>
			<?php } ?>					
				<li class="principal">
					<a href=""><i class="fas fa-cubes"></i>Productos</a>
					<ul>
					<?php  
						if($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2 || $_SESSION['rol'] == 3){	
					?>
						<li><a href="registro_producto.php"><i class="fas fa-plus"></i>Nuevo Producto</a></li>
			<?php } ?>
						<li><a href="lista_productos.php"><i class="fas fa-cube"></i>Lista de Productos</a></li>
					</ul>
				</li>
			
				<li class="principal">
					<a href="#"><i class="fas fa-file-alt"></i>Facturas</a>
					<ul>
						<li><a href="nueva_venta.php"><i class="fas fa-plus"></i>Nuevo Factura</a></li>
						<li><a href="#"><i class="far fa-newspaper"></i>Facturas</a></li>
					</ul>
				</li>
				<?php
				$valor = $val->get_Categorias();
				$id_c=$valor[0]["Id_categoria"];
				?>
				<li class="principal">
					<a href="componentes.php?id_c=<?php echo $id_c?>"><i class="categories"></i>categorias</a>
					
						
				</li>

			</ul>
			
		</nav>
		





					