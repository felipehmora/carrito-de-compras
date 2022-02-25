<?php 
	session_start(); // Función requerida, para definir y acceder a las variables de sesión
	echo "<h1>Variables de sesión que fueron definidas</h1>";
	echo "USUARIO:".$_SESSION['usuario']."<br>";
	echo "NOMBRE DEL USUARIO:".$_SESSION['nombre']."<br>";
?>