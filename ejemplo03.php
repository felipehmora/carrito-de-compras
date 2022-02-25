<?php 
	session_start();  // Inicio de sesión
	session_destroy(); // Cierre de sesión.
	echo "<h3>La sesión de navegación ha sido cerrada.</h3>";
?>