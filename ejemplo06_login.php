<?php 
	include 'encabezado.php';
?>
	<div align="center">
		<b>Validar Usuarios</b>
	</div>
	<form method="POST" action="ejemplo06_validar.php">
		<table align="center">
			<tr>
				<td>Correo Electrónico:</td>
				<td>
					<input type="email" 
					       name="v_correo"
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
				<td colspan="2" align="center">
					<input type="submit" name="" value="ENVIAR">
					<input type="reset" name="" value="LIMPIAR">
					<input type="hidden" name="id" value="1">
				</td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<a href="ejemplo06_menu.php">Usuarios no registrados</a>
				</td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<a href="ejemplo06_index.php">Ir al Inicio</a>
				</td>
			</tr>
		</table>		
	</form>
<?php 
	include 'pie.php';
?>