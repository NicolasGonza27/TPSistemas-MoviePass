create database moviePass;
use moviePass;
#drop database moviePass;

create table cines(
id_cine int not null auto_increment,
nombre_cine varchar(20) not null,
calle varchar(20) not null,
numero int not null,
hora_apertura time not null,
hora_cierre time not null,
valor_entrada float(5) not null,
eliminado boolean not null,
constraint PK_cines primary key (id_cine)
);

create table generos (
id_genero int not null,				
nombre_genero varchar(20),
constraint PK_generos primary key (id_genero)
);

create table peliculas(
popularity float,
vote_count int,
poster_path varchar(50),
id int not null,
adult boolean,
original_language varchar(15),
title varchar(20),
vote_average float,
overview varchar(100),
release_date date,
runtime int,
constraint PK_peliculas primary key (id)
);

create table peliculasXGenero(
id_peliculasXGenero int auto_increment,
id_pelicula int not null,
id_genero int not null,
constraint PK_peliculasXGenero primary key (id_peliculasXGenero),
constraint FK_peliculasXGenero_peliculas foreign key (id_pelicula) references peliculas (id) on delete cascade on update cascade,
constraint FK_peliculasXGenero_generos foreign key (id_genero) references generos (id_genero) on delete cascade on update cascade,
constraint unique_peliculasXGenero unique (id_pelicula,id_genero)
);

create table tipos_sala(
id_tipo_sala int auto_increment,
nombre_tipo_sala varchar (30),
constraint PK_salas primary key (id_tipo_sala)
);

create table salas(
id_sala int not null auto_increment,
id_tipo_sala int not null,
id_cine int not null,
numero_sala int not null,
nombre_sala varchar (20),
cant_butacas int not null,
eliminado boolean not null,
constraint PK_salas primary key (id_sala),
constraint FK_salas_cines foreign key (id_cine) references cines (id_cine) on delete cascade on update cascade,
constraint FK_salas_tipos_sala foreign key (id_tipo_sala) references tipos_sala (id_tipo_sala) on delete cascade on update cascade,
constraint unique_salas unique (id_cine,numero_sala)
);

create table funciones(
id_funcion int not null auto_increment,
id_pelicula int not null,
id_sala int not null,
cant_asistentes int not null,
fecha_hora timestamp not null,
eliminado boolean not null,
constraint PK_funciones primary key (id_funcion),
constraint FK_funciones_peliculas foreign key (id_pelicula) references peliculas (id) on delete cascade on update cascade,
constraint FK_funciones_salas foreign key (id_sala) references salas (id_sala) on delete cascade on update cascade
);

create table tipos_usuario(
id_tipo_usuario int not null auto_increment,
nombre_tipo_usuario varchar (30),
constraint PK_tipos_usuario primary key (id_tipo_usuario)
);

create table usuarios(
id_usuario int not null auto_increment,
id_tipo_usuario int not null,
nombre_usuario varchar(30),
apellido_usuario varchar(30),
dni varchar(30),
email varchar(30),
contraseña varchar(30),
fecha_nac date,
constraint PK_usuarios primary key (id_usuario),
constraint FK_usuarios_tipos_usuario foreign key (id_tipo_usuario) references tipos_usuario (id_tipo_usuario) on delete cascade on update cascade
);

create table politicas_descuento(
id_politica_descuento int not null auto_increment,
porcentaje_descuento float not null,
dias_descuento varchar (20),
descripcion varchar (20),
constraint PK_politicas_descuento primary key (id_politica_descuento) 
);


create table compras(
id_compra int not null auto_increment,
id_usuario int not null,
id_politica_descuento int,
cant_entradas int,
monto float,
constraint PK_compras primary key (id_compra),
constraint PK_compras foreign key (id_usuario) references usuarios (id_usuario) on delete cascade on update cascade,
constraint FK_compras_politicas_descuento foreign key (id_politica_descuento) references politicas_descuento (id_politica_descuento) on delete cascade on update cascade
);

create table entradas(
id_entrada int not null auto_increment,
id_compra int not null,
id_funcion int not null,
nro_entrada int not null,
constraint PK_entradas primary key (id_entrada),
constraint FK_entradas_funciones foreign key (id_funcion) references funciones (id_funcion) on delete cascade on update cascade,
constraint FK_entradas_compras foreign key (id_compra) references compras (id_compra) on delete cascade on update cascade,
constraint unique_entradas unique (id_funcion,nro_entrada)
);


/*Query cartelera*/
select 
f.id_funcion,
p.id,
p.title
from peliculas p
inner join funciones f
on p.id = f.id_pelicula;

/*Query funciones de una pelicula*/
select 
f.id_funcion,
p.title
from peliculas p
inner join funciones f
on p.id = f.id_pelicula
where id = 425001;

select 
*
from peliculasXGenero;

select 
*
from salas;

select 
*
from funciones;






