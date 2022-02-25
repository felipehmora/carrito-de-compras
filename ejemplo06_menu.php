<?php 
	session_start();
	include 'encabezado.php';
?>
<div align="center">
	<a href="ejemplo06_index.php">Ir al inicio</a><br>
	<b>Agregar Usuarios</b>
</div>
<form method="POST" action="ejemplo06_validar.php">
	<table align="center">
		<tr>
			<td>Nombre y Apellido:</td>
			<td>
				<input type="text" 
				       name="v_nombre_apellido"
				       required="">
			</td>
		</tr>
		<tr>
			<td>Identificación:</td>
			<td>
				<select name="v_doc">
					<option value="E">E</option>
					<option value="P">P</option>
					<option value="V" selected="">V</option>
				</select>
				<input type="text" 
				       name="v_nro"
				       required="">
			</td>
		</tr>
		<tr>
			<td>Clave:</td>
			<td>
				<input type="password"
				       name="v_clave"
				       required="">
			</td>
		</tr>
		<tr>
			<td>Correo Electrónico:</td>
			<td>
				<input type="email"
				       name="v_correo"
				       required="">
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="submit" name="" value="GUARDAR">
				<input type="reset" name="" value="LIMPIAR">
				<input type="hidden" name="id" value="2">
			</td>
		</tr>
	</table>
</form>
<?php if ($_SESSION['tipo_usuario'] == 'ADMINISTRADOR') { ?>
	<hr>
	<div align="center">
		<b>Agregar Productos</b>
	</div>
	<form method="POST"
	      action="ejemplo06_validar.php"
	      enctype="multipart/form-data">
	      <table align="center">
			<tr>
				<td>Imagen:</td>
				<td>
					<input type="file"
					       name="v_imagen"
					       required="">
				</td>
			</tr>
			<tr>
				<td>Nombre:</td>
				<td>
					<input type="text"
					       name="v_nombre"
					       required="">
				</td>
			</tr>
			<tr>
				<td>Precio:</td>
				<td>
					<input type="text"
					       name="v_precio"
					       required="">
				</td>
			</tr>
			<tr>
				<td>Cantidad:</td>
				<td>
					<input type="number"
					       name="v_cantidad"
					       min="0">
				</td>
			</tr>
			<tr>
				<td>Descripción:</td>
				<td>
					<textarea cols="24" 
					          rows="5"
					          name="v_descripcion"></textarea>
				</td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<input type="submit" name="" value="GUARDAR">
					<input type="reset" name="" value="LIMPIAR">
					<input type="hidden" name="id" value="3">
				</td>
			</tr>      	
	      </table>
	</form>
	<hr>
	<div align="center">
		<b>Reporte de Ventas</b>
	</div>
<?php 
	include 'conexion.php';
	$sql="SELECT B.nombre_apellido as cliente,
	       sum(A.cantidad*C.precio) as total
	       from tbl_compra as A, tbl_usuario as B, tbl_producto as C
	       WHERE
		   B.id_usuario = A.id_usuario AND
		   C.id_producto = A.id_producto
		   GROUP BY B.id_usuario";
 	$resultado = mysqli_query($enlace,$sql);
 ?>
  <table align="center" width="50%">
 	<tr>
 		<th width="55%" align="center">Cliente</th>		
 		<th width="45%" align="right">Total</th>
 	</tr>
 	<?php while ($data = mysqli_fetch_array($resultado)) { ?>
 		<tr>
 			<td align="center"><?php echo $data['cliente'] ?></td>
 			<td align="right"><?php echo $data['total'] ?></td>
 		</tr>
 	<?php } ?>
 </table>
<?php } ?>

<?php 
	include 'pie.php';
/*
	A = tbl_compra
	B = tbl_usuario
	C = tbl_producto

	SELECT B.nombre_apellido as cliente,
	       sum(A.cantidad*C.precio) as total
	       from tbl_compra as A, tbl_usuario as B, tbl_producto as C
	       WHERE
		   B.id_usuario = A.id_usuario AND
		   C.id_producto = A.id_producto
		   GROUP BY B.id_usuario;


*/
?>




