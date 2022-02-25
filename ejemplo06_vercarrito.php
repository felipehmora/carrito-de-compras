<?php 
	session_start();
	include 'conexion.php';
	include 'encabezado.php';
?>
	<a href="ejemplo06_index.php">Ir al inicio</a>
<?php
	$session_id = session_id();
	$sql = "SELECT A.NOMBRE_PRODUCTO AS producto,
    		       A.NOMBRE_ARCHIVO AS imagen,
                   A.ID_PRODUCTO AS id_producto,
                   A.DESCRIPCION AS descripcion,
                   A.PRECIO AS precio
                   FROM TBL_PRODUCTO AS A, TBL_AGREGAR_CARRITO AS B
                   WHERE A.ID_PRODUCTO = B.ID_PRODUCTO 
                   AND B.session_id = '$session_id'";
    $resultado = mysqli_query($enlace, $sql);
    if ($resultado){
    	$cantidad = mysqli_num_rows($resultado);
    	if ($cantidad > 0){
?>
		<form method="POST" action="ejemplo06_validar.php">
			<table align="center" id="ver_carrito" border="1">
				<tr>
					<th>Producto</th>
					<th>Imagen</th>
					<th>Cantidad</th>
					<th>Precio</th>
					<th>Borrar</th>
				</tr>
				<?php while ($data = mysqli_fetch_array($resultado)) { ?>
				<tr>
					<td class="detalle_ver_carrito" align="center"><?php echo $data['producto'] ?></td>
					<td class="detalle_ver_carrito" align="center">
						<img class="img_ver" src="<?php echo $data['imagen'] ?>">
					</td>
					<td class="detalle_ver_carrito" align="center">
						<input type="number" 
						       name="v_cantidad[]"
						       multiple="" 
						       min="1"
						       required="">
						<input type="text" 
							   hidden=""
						       name="v_nombre[]"
						       multiple=""
						       value="<?php echo $data['producto'] ?>">
						<input type="text" 
							   hidden=""
						       name="v_precio[]"
						       multiple=""
						       value="<?php echo $data['precio'] ?>">
						<input type="text" 
							   hidden=""
						       name="v_id_producto[]"
						       multiple=""
						       value="<?php echo $data['id_producto'] ?>">
					</td>
					<td class="detalle_ver_carrito"
					    align="right"><?php echo $data['precio'] ?></td>
					<td class="detalle_ver_carrito" align="center"><a href="ejemplo06_validar.php?id=5&id_producto=<?php echo $data['id_producto'] ?>">Borrar</a></td>
				</tr>
				<?php } ?>
				<tr>
					<td colspan="5" align="center">
						<input type="submit" name="" value="Verificar compra">
						<input type="hidden" name="id" value="6">
					</td>
				</tr>
			</table>
		</form>
<?php
    	}else{
    		$texto = "<div class='mensaje alerta'>No hay artículos en el carrito de compras.</div>";
    		$_GET['mensaje'] = $texto;
    	}
    }else{
    	$texto = "<div class='mensaje error'>ERROR:".mysqli_error($enlace)."</div>";
    	header("location:ejemplo06_index.php?mesaje=".$texto);
    }
?>
<?php 
	include 'pie.php';
?>