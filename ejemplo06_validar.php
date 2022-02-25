<?php 
	session_start();
	include 'conexion.php';

	switch ($_REQUEST['id']) {
		case '1':
			# VALIDACIÓN DE USUARIO
			$sql = "SELECT * FROM tbl_usuario WHERE correo = '$_REQUEST[v_correo]'";
			$resultado = mysqli_query($enlace, $sql);
			if ($resultado){
				$cantidad = mysqli_num_rows($resultado);
				if ($cantidad > 0){
					$data = mysqli_fetch_array($resultado);
					if ($data['clave'] == md5($_REQUEST['v_clave'])){
						$_SESSION['activo'] = 1;
						$_SESSION['id_usuario'] = $data['id_usuario'];
						$_SESSION['nombre_apellido'] = $data['nombre_apellido'];
						$_SESSION['correo'] = $data['correo'];
						$_SESSION['cedula'] = $data['cedula'];
						$_SESSION['tipo_usuario'] = $data['tipo_usuario'];
						if ($_SESSION['tipo_usuario'] == 'ADMINISTRADOR'){
							$texto = "<div class='mensaje completado'>Bienvenido administrador(a) del Sistema</div>";
						//	header("location:ejemplo06_login.php?mensaje=".$texto);
						    header("location:ejemplo06_menu.php?mensaje=".$texto);
						}else{
							$texto = "<div class='mensaje completado'>Bienvenido visitante del Sistema</div>";
						//	header("location:ejemplo06_login.php?mensaje=".$texto);
						    header("location:ejemplo06_index.php?mensaje=".$texto);
						}
					}else{
						$texto = "<div class='mensaje alerta'>Clave incorrecta</div>";
						header("location:ejemplo06_login.php?mensaje=".$texto);
					}
				}else{
					$texto = "<div class='mensaje alerta'>Correo electrónico no se encuentra registrado</div>";
					header("location:ejemplo06_login.php?mensaje=".$texto);
				}
			}else{
				$texto = "<div class='mensaje error'>ERROR:".mysqli_error($enlace)."</div>";
				header("location:ejemplo06_login.php?mensaje=".$texto);
			}
			break;
		case '2':
			# REGISTRAR NUEVOS USUARIOS
			$cedula = $_REQUEST['v_doc'].$_REQUEST['v_nro'];
			$sql = "INSERT INTO tbl_usuario(cedula,nombre_apellido,
			                                correo,clave,
			                                tipo_usuario) 
			                VALUES ('$cedula','$_REQUEST[v_nombre_apellido]',
			                        '$_REQUEST[v_correo]',md5('$_REQUEST[v_clave]'),
			                        'VISITANTE')";
			//echo $sql;
			$resultado = mysqli_query($enlace, $sql);
			if ($resultado){
				$texto = "<div class='mensaje completado'>El usuario:".$_REQUEST['v_correo'].", fue registradp con éxito </div>";
			}else{
				$texto = "<div class='mensaje error'>ERROR:".mysqli_error($enlace)."</div>";
			}
			header("location:ejemplo06_menu.php?mensaje=".$texto);
			break;
		case '3':
			# GUARDAR PRODUCTO O GUARDAR ARTÍCULO
			$img_nombre_temporal = $_FILES['v_imagen']['tmp_name'];
			$img_nombre          = $_FILES['v_imagen']['name'];

			//echo var_dump($_FILES['v_imagen']);

			$img_data = getimagesize($img_nombre_temporal);

			//echo var_dump($img_data);

			$img_valida = false;

			if ($img_data[2] == '1'){
				$extension = ".gif";
				$img_valida = true;
			}else if ($img_data[2] == '2'){
				$extension = '.jpg';
				$img_valida = true;
			}else if ($img_data[2] == '3'){
				$extension = '.png';
				$img_valida = true;
			}else{
				$img_valida = false;
			}

			if ($img_valida){
				$directorio = "articulos/";

				$sql_nomb_imagen = "SELECT AUTO_INCREMENT FROM information_schema.TABLES
									WHERE TABLE_SCHEMA = 'bdphp3_20210614' 
									AND TABLE_NAME = 'tbl_producto'";

				$r_nomb_imgen = mysqli_query($enlace, $sql_nomb_imagen);

				$data_nomb_imagen = mysqli_fetch_array($r_nomb_imgen);

				$nombre_imagen =  $data_nomb_imagen[0];

				$nombre_archivo = $directorio.$nombre_imagen.$extension;

				//echo $nombre_archivo;

				$sql_producto = "INSERT INTO tbl_producto(nombre_producto, 
				                                          descripcion,
				                                          nombre_archivo,
				                                          precio,
				                                          existencia)
				                 VALUES ('$_REQUEST[v_nombre]',
				                         '$_REQUEST[v_descripcion]',
				                         '$nombre_archivo',
				                         '$_REQUEST[v_precio]',
				                         '$_REQUEST[v_cantidad]')";

				$resultado = mysqli_query($enlace, $sql_producto);

				if ($resultado){
					move_uploaded_file($img_nombre_temporal, $nombre_archivo);
					$texto = "<div class='mensaje completado'>El producto fué almacenado con éxito.</div>";
				}else{
					$texto = "<div class='mensaje error'>ERROR:".mysqli_error($enlace)."</div>";
				}
			}else{
				$texto = "<div class='mensaje alerta'>ERROR: Sólo se permite el ingreso de imagenes de tipo GIF, JPG y PNG, en la carga de productos.</div>";
			}
			header("location:ejemplo06_menu.php?mensaje=".$texto);

			break;
		case '4':
			# AGREGAR AL CARRITO DE COMPRAS
			$_SESSION['carrito'] = 1;
			$session_id = session_id();
			$sql = "INSERT INTO tbl_agregar_carrito(session_id, id_producto)
			               VALUES ('$session_id', '$_REQUEST[id_producto]')";
			$resultado = mysqli_query($enlace, $sql);
			if ($resultado){
				$texto = "<div class='mensaje completado'>El artículo id=".$_REQUEST['id_producto'].", fue agregado al carrito de compras.</div>";
			}else{
				$texto = "<div class='mensaje error'>ERROR:".mysqli_error($enlace)."</div>";
			}
			header("location:ejemplo06_index.php?mensaje=".$texto);
			break;
		case '5':
			# BORRAR DEL CARRITO DE COMPRAS
			$session_id = session_id();
			$sql = "DELETE FROM tbl_agregar_carrito 
			        WHERE id_producto = '$_REQUEST[id_producto]'
			        AND session_id = '$session_id'";
			$resultado = mysqli_query($enlace, $sql);
			if ($resultado){
				$texto = "<div class='mensaje completado'>El artículo id=".$_REQUEST['id_producto'].", fue borrado del carrito de compras.</div>";
			}else{
				$texto = "<div class='mensaje error'>ERROR:".mysqli_error($enlace)."</div>";
			}
			header("location:ejemplo06_vercarrito.php?mensaje=".$texto);
			break;
		case '6':
			# VERIFICAR COMPRA
			$v_cantidad = $_REQUEST['v_cantidad'];
			$v_nombre   = $_REQUEST['v_nombre'];
			$v_precio   = $_REQUEST['v_precio'];
			$v_id_producto = $_REQUEST['v_id_producto'];
			include 'encabezado.php';
?>
			<h2>Por favor verificar los artículos seleccionados</h2>
			<h3>antes de oprimir el botón Comprar</h3>
			<form method="POST" action="">
				<table align="center" width="60%">
					<tr>
						<th width="15%">Cantidad</th>
						<th width="45%">Nombre</th>
						<th width="15%">Precio</th>
						<th width="25%">Total</th>
					</tr>	
					<?php 
						$suma = 0;
						for ($i=0; $i < count($v_nombre) ; $i++) { 
					?>
					<tr>
						<td align="right">
							<?php echo $v_cantidad[$i];?>
							<input type="hidden" 
							       name="v_cantidad[]"
							       multiple=""
							       value="<?php echo $v_cantidad[$i];?>">
							<input type="hidden"
							       name="v_id_producto[]"
							       multiple=""
							       value="<?php echo $v_id_producto[$i] ?>">
						</td>			
						<td><?php echo $v_nombre[$i];?></td>
						<td align="right"><?php echo $v_precio[$i];?></td>
						<td align="right">
							<?php 
								echo number_format(($v_cantidad[$i]*$v_precio[$i]),2,'.',',');
								$suma = $suma + ($v_cantidad[$i]*$v_precio[$i]);
							?>
						</td>
					</tr>	
					<?php } ?>		
					<tr>
						<td colspan="3" align="right" class="total">TOTAL:</td>
						<td align="right" class="total">
							<?php echo number_format($suma,2,'.',','); ?>
						</td>
					</tr>		
				</table>
				<div align="center">
					<input type="submit" name="" value="Comprar"><br><br>
					<input type="hidden" name="id" value="7">
					<a href="ejemplo06_index.php">Ir al Inicio</a><br>
					<a href="ejemplo06_vercarrito.php">Ir al Carrito de Compras</a>
				</div>
			</form>
<?php
			include 'pie.php';
			break;
		case '7':
			# COMPRAR
			$session_id = session_id();
			$v_cantidad = $_REQUEST['v_cantidad'];
			$v_id_producto = $_REQUEST['v_id_producto'];
			// BORRAR DE LA TABLA tbl_agregar_carrito
			for ($i=0; $i<count($v_id_producto);$i++){
				$v_id_producto1 = $v_id_producto[$i];
				$sql1 = "DELETE FROM tbl_agregar_carrito 
			         	 WHERE session_id = '$session_id' 
			         	 AND id_producto = '$v_id_producto1'";
			    $resultado1 = mysqli_query($enlace, $sql1);
			    //echo $sql1."<br>";
			}
			//echo "<hr>";
			// REGISTRAR EN LA TABLA tbl_compra
			$v_id_usuario = $_SESSION['id_usuario'];
			date_default_timezone_set("America/Caracas");
			$v_fecha = date("Y-m-d H:i:s");
			for ($i=0;$i<count($v_id_producto);$i++){
				$v_id_producto1 = $v_id_producto[$i];
				$v_cantidad1    = $v_cantidad[$i];
				$sql2 = "INSERT INTO tbl_compra (id_usuario,id_producto,cantidad,fecha)
				         VALUES ('$v_id_usuario', '$v_id_producto1', '$v_cantidad1', '$v_fecha')";
				$resultado2 = mysqli_query($enlace, $sql2);
				//echo $sql2."<br>";
			}
			if ($resultado1 && $resultado2){
				$texto = "<div class='mensaje completado'>Su compra fue procesada con éxito.</div>";
			}else{
				$texto = "<div class='mensaje error'>ERROR:".mysqli_error($enlace)."</div>";
			}
			header("location:ejemplo06_index.php?mensaje=".$texto);
			break;
		default:
			# code...
			break;
	}



?>