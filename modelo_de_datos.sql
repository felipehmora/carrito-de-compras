CREATE DATABASE bdphp3_20210614;

use bdphp3_20210614;

create table tbl_agregar_carrito(
	session_id varchar(26),
	id_producto integer
);

create table tbl_compra(
	id_usuario integer,
	id_producto integer,
	cantidad integer(8) unsigned,
	fecha datetime
);

create table tbl_producto(
	id_producto integer auto_increment,
	nombre_producto varchar(40),
	descripcion text,
	nombre_archivo varchar(80),
	precio decimal(13,2),
	existencia integer(8) unsigned,
	primary key(id_producto)
);

create table tbl_usuario(
	id_usuario integer auto_increment,
	cedula varchar(10),
	nombre_apellido varchar(60),
	correo varchar(40),
	clave varchar(32),
	tipo_usuario varchar(20),
	unique(correo),
	primary key(id_usuario)
);


-- Definición del usuario administrador en mysql

INSERT INTO tbl_usuario(
cedula,
nombre_apellido,
correo,
clave,
tipo_usuario) VALUES 
('V1234',
'JOSE PEREZ',
'JPEREZ@GMAIL.COM',
md5('V1234'),
'ADMINISTRADOR');

--

SELECT TBL_PRODUCTO.NOMBRE_PRODUCTO,
    TBL_PRODUCTO.NOMBRE_ARCHIVO,
    TBL_PRODUCTO.ID_PRODUCTO,
    TBL_PRODUCTO.DESCRIPCION,
    TBL_PRODUCTO.PRECIO
    FROM TBL_PRODUCTO, TBL_AGREGAR_CARRITO
    WHERE TBL_PRODUCTO.ID_PRODUCTO = TBL_AGREGAR_CARRITO.ID_PRODUCTO;
+--------------------+-----------------+-------------+-------------------------------------+--------+
| NOMBRE_PRODUCTO    | NOMBRE_ARCHIVO  | ID_PRODUCTO | DESCRIPCION                         | PRECIO |
+--------------------+-----------------+-------------+-------------------------------------+--------+
| BALON DE FUTBOL #5 | articulos/4.jpg |           4 | BALON DE FUTBOL #5, MARCA SPALDING  | 100.00 |
| CASCO CICLISTA     | articulos/1.jpg |           1 | CASCO PARA CICLISTAS MARCA TAMANACO | 100.00 |
+--------------------+-----------------+-------------+-------------------------------------+--------+
2 rows in set (0.005 sec)

MariaDB [bdphp3_20210614]>

SELECT A.NOMBRE_PRODUCTO AS producto,
    A.NOMBRE_ARCHIVO AS imagen,
    A.ID_PRODUCTO AS id_producto,
    A.DESCRIPCION AS descripcion,
    A.PRECIO AS precio
    FROM TBL_PRODUCTO AS A, TBL_AGREGAR_CARRITO AS B
    WHERE A.ID_PRODUCTO = B.ID_PRODUCTO;

MariaDB [bdphp3_20210614]> SELECT A.NOMBRE_PRODUCTO AS producto,
    ->     A.NOMBRE_ARCHIVO AS imagen,
    ->     A.ID_PRODUCTO AS id_producto,
    ->     A.DESCRIPCION AS descripcion,
    ->     A.PRECIO AS precio
    ->     FROM TBL_PRODUCTO AS A, TBL_AGREGAR_CARRITO AS B
    ->     WHERE A.ID_PRODUCTO = B.ID_PRODUCTO;
+--------------------+-----------------+-------------+-------------------------------------+--------+
| producto           | imagen          | id_producto | descripcion                         | precio |
+--------------------+-----------------+-------------+-------------------------------------+--------+
| BALON DE FUTBOL #5 | articulos/4.jpg |           4 | BALON DE FUTBOL #5, MARCA SPALDING  | 100.00 |
| CASCO CICLISTA     | articulos/1.jpg |           1 | CASCO PARA CICLISTAS MARCA TAMANACO | 100.00 |
+--------------------+-----------------+-------------+-------------------------------------+--------+
2 rows in set (0.001 sec)

MariaDB [bdphp3_20210614]>









