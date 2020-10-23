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
video boolean,
poster_path varchar(50),
id int not null,
adult boolean,
backdrop_path varchar(50),
original_language varchar(15),
original_title varchar(20),
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
constraint FK_peliculasXGenero_peliculas foreign key (id_pelicula) references peliculas (id) on delete restrict on update cascade,
constraint FK_peliculasXGenero_generos foreign key (id_genero) references generos (id_genero) on delete restrict on update cascade,
constraint unique_peliculasXGenero unique (id_pelicula,id_genero)
);

create table salas(
id_sala int not null auto_increment,
id_cine int not null,
numero_sala int not null,
nombre_sala varchar (20),
cant_butacas int not null,
constraint PK_salas primary key (id_sala),
constraint FK_salas_cines foreign key (id_cine) references cines (id_cine) on delete cascade on update cascade,
constraint unique_salas unique (id_cine,numero_sala)
);

create table funciones(
id_funcion int not null auto_increment,
id_pelicula int not null,
id_sala int not null,
cant_asistentes int not null,
fecha_hora timestamp not null,
constraint PK_funciones primary key (id_funcion),
constraint FK_funciones_peliculas foreign key (id_pelicula) references peliculas (id) on delete cascade on update cascade,
constraint FK_funciones_salas foreign key (id_sala) references salas (id_sala) on delete cascade on update cascade
);

select
*
from peliculasXGenero pxq
inner join peliculas p
on p.id = pxq.id_pelicula
where pxq.id_genero = 53;


describe cines;



select 
*
from cines;


select 
count(*)
from peliculas;

select 
*
from funciones;

select 
*
from generos;

select 
*
from peliculasXGenero;


select 
*
from salas;

