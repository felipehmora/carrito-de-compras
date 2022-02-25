<?php 
/*
                   <---- usuario 1   (login)
                
+----------+       <---- usuario 2   (logout)
    APP
    WEB            <---- usuario 3   (pedido)
+----------+        ....
                                     (compra)

                                     (pagando)

									 transacción x

                   <---- usuario n

Manejo de sesión: Corresponde a un área de memoria
asociada con una identificación única, mediante la
cual, se definen las variables del entorno de la
aplicación.


¿Qué se necesita para establecer la sesión?

La sesión, se encuentra asociada al navegador.

Para cada navegador que se abre en el computador
corresponde un identificado único de sesión. El
cual es una combínación de letras y números de
26 carácteres.


session_start(); // Se define la sesión

$_SESSION['usuario'] = 'HDUQUE';
$_SESSION['nombre'] = 'HENRY DUQUE';

Van a exitir estas variables de sesión, mientras el navegador
se encuentre activo o no se destruya la sesión.

session_destroy(); // Se cierra y destruye una sesión

Cuando una sesión, se destruye las variables, asociadas a dicha
sesión se borran.

Para conocer, el identificado de sesión, se recurre a la función
session_id();

*/

session_start();

echo "ID. DE SESIÓN DEFINIDA:".session_id()."<br>";

$_SESSION['usuario'] = 'HDUQUE';
$_SESSION['nombre'] = 'HENRY DUQUE';

echo "Variables de sesión fueron definidas<br>";

?>