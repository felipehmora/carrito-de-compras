<?php 
	session_start();

	error_reporting(0); // Quitar mensaje de advertencia

	include 'conexion.php';
	include 'encabezado.php';

	$sql = "SELECT * FROM tbl_producto";
	
	$resultado = mysqli_query($enlace, $sql);

	$cantidad = mysqli_num_rows($resultado);

	if ($cantidad > 0){
		$a = 1;
		$b = 1;
		while ($data = mysqli_fetch_array($resultado)){
			$id_producto[$a][$b] = $data['id_producto'];
			$nombre_producto[$a][$b] = $data['nombre_producto'];
			$descripcion[$a][$b] = $data['descripcion'];
			$nombre_archivo[$a][$b] = $data['nombre_archivo'];
			$precio[$a][$b] = $data['precio'];
			$existencia[$a][$b] = $data['existencia'];
			$b++;
			if ($b == 4){
				$a++;
				$b = 1;
			}
		}
		if ($cantidad >= 3){
			$condicion = 3;
		}else{
			$condicion = $cantidad;
		}
?>
		<table align="center" id="catalogo">
			<?php for ($c=1; $c<=$a; $c++) { ?>
				<tr>
					<?php for ($d=1; $d<=$condicion; $d++) { ?>

						<?php if (!empty($id_producto[$c][$d])) { ?>

							<td id="articulo">
								<b>Nombre:</b><?php echo $nombre_producto[$c][$d];?><br>
								<b>Precio:</b><?php echo $precio[$c][$d];?><br>
								<b>Existencia:</b><?php echo $existencia[$c][$d];?><br>
								<b>Descripción:</b><?php echo $descripcion[$c][$d];?><br>
								<img src="<?php echo $nombre_archivo[$c][$d];?>"><br>
								<a href="ejemplo06_validar.php?id=4&id_producto=<?php echo $id_producto[$c][$d] ?>">Añadir al carrito de compras</a>	
							</td>

						<?php } ?>	

					<?php } ?>
				</tr>
			<?php } ?>
		</table>
<?php
	}else{
		$texto = "<div class='mensaje alerta'>No hay productos en el inventario</div>";
		$_GET['mensaje'] = $texto;
	}
?>

<?php if ($_SESSION['carrito']) { ?>
	<a href="ejemplo06_vercarrito.php">Ver carrito</a><br>
<?php }  ?>

<?php if ($_SESSION['tipo_usuario']=='ADMINISTRADOR') { ?>
	<a href="ejemplo06_menu.php">Menú sistema</a><br>
<?php } ?>

<a href="ejemplo06_login.php">Ingresar al sistema</a><br>

<?php 
	include 'pie.php';
?>