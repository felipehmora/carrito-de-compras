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

--Definicion del usuario administrador en mysql

INSERT INTO tbl_usuario(cedula, 
						nombre_apellido, 
						correo, clave, 
						tipo_usuario) VALUES ('V1234', 
						'Felipe Hernandez','
						felipehmorahds@gmail.com', md5('1234'),
						'ADMINISTRADOR');
