<?php 
	echo "<h1>Contenido de variable cookie USUARIO</h1>";
	echo $_COOKIE['USUARIO']."<br>";
	echo "<h3>Esta variable en 30 segundos, dejará de existir.</h3>";
	date_default_timezone_set("AMERICA/CARACAS");
	echo date('l jS \of F Y h:i:s A');
	echo "<br>";
?>