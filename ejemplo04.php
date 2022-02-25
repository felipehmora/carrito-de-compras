<?php 
/*
Las variables, que se definen como cookies, se refieren a variables temporales,
dado que su existencia, está asociada a un temporizador.
También se encuentran vinculadas a la sesión del navegador, donde fue ejecutado
el programa, para su creación.

            +-- nombre de la variable
            |          +-- valor asignado a la variable
            |          |         +-- intervalo de expiración
            |          |         |   Por ejemplo 1 hora: 3600 seg.
			v          v         v               30 seg, 1 min = 60 seg      
*/
setcookie("USUARIO","HDUQUE",time()+60);

echo "<h3>SE DEFINIÓ LA VARIABLE USUARIO</h3>";

echo "INFORMACIÓN DE FECHA Y HORA DE DEFINICIÓN DE VARIABLES<br>";
date_default_timezone_set("AMERICA/CARACAS");
echo date('l jS \of F Y h:i:s A');
echo "<br>";

?>