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
eliminado boolean not null default false,
constraint PK_cines primary key (id_cine)
);
select*from cines;
alter table cines add column capacidad int not null;

create table generos (
id_genero int not null,				
nombre_genero varchar(20),
eliminado boolean not null default false,
constraint PK_generos primary key (id_genero)
);

create table peliculas_cartelera(
popularity float,
vote_count int,
poster_path varchar(50),
id int not null,
adult boolean,
title varchar(20),
vote_average float,
overview varchar(100),
release_date date,
runtime int,
eliminado boolean not null default false,
constraint PK_peliculas primary key (id)
);

create table peliculasXGenero(
id_peliculasXGenero int auto_increment,
id_pelicula int not null,
id_genero int not null,
constraint PK_peliculasXGenero primary key (id_peliculasXGenero),
constraint FK_peliculasXGenero_peliculas foreign key (id_pelicula) references peliculas_cartelera (id) on delete cascade on update cascade,
constraint FK_peliculasXGenero_generos foreign key (id_genero) references generos (id_genero) on delete cascade on update cascade,
constraint unique_peliculasXGenero unique (id_pelicula,id_genero)
);

create table tipos_sala(
id_tipo_sala int auto_increment,
nombre_tipo_sala varchar (30) not null,
eliminado boolean not null default false,
constraint PK_salas primary key (id_tipo_sala)
);

create table salas(
id_sala int not null auto_increment,
id_tipo_sala int not null,
id_cine int not null,
numero_sala int not null,
nombre_sala varchar (20),
cant_butacas int not null,
eliminado boolean not null default false,
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
eliminado boolean not null default false,
constraint PK_funciones primary key (id_funcion),
constraint FK_funciones_peliculas foreign key (id_pelicula) references peliculas_cartelera (id) on delete cascade on update cascade,
constraint FK_funciones_salas foreign key (id_sala) references salas (id_sala) on delete cascade on update cascade
);

create table tipos_usuario(
id_tipo_usuario int not null auto_increment,
nombre_tipo_usuario varchar (30),
eliminado boolean not null default false,
constraint PK_tipos_usuario primary key (id_tipo_usuario)
);

create table usuarios(
id_usuario int not null auto_increment,
id_tipo_usuario int not null,
nombre_usuario varchar(30),
apellido_usuario varchar(30),
dni varchar(30),
email varchar(30),
pass_usuario varchar(30),
fecha_nac date,
eliminado boolean not null default false,
constraint PK_usuarios primary key (id_usuario),
constraint FK_usuarios_tipos_usuario foreign key (id_tipo_usuario) references tipos_usuario (id_tipo_usuario) on delete cascade on update cascade
);

alter table usuarios change column contraseña pass_usuario varchar(30);

create table politicas_descuento(
id_politica_descuento int not null auto_increment,
porcentaje_descuento float not null,
descripcion varchar (20),
eliminado boolean not null default false,
constraint PK_politicas_descuento primary key (id_politica_descuento)
);

select*from funciones;

/*EJECUTAR LAS TRES LINEAS*/
alter table politicas_descuento drop column dias_descuento;
alter table politicas_descuento add constraint ckq_porcentaje_politicas_descuento check ((porcentaje_descuento >= 0) and (porcentaje_descuento <= 100));
alter table politicas_descuento change column descripcion descripcion varchar(100);

describe politicas_descuento;

create table politica_de_descuento_x_dia(
id_politica_de_descuento_x_dia int auto_increment,
id_politica_descuento int not null,
dia_de_la_semana int not null,
eliminado boolean not null default false,
constraint PK_dias_politica_descuento primary key (id_politica_de_descuento_x_dia),
constraint FK_id_politica_descuento foreign key (id_politica_descuento) references politicas_descuento (id_politica_descuento) on delete cascade on update cascade,
constraint ckq_dia_de_la_semana check ((dia_de_la_semana >= 0) and (dia_de_la_semana <= 6))
);

select*
from politica_de_descuento_x_dia;

create table compras(
id_compra int not null auto_increment,
id_usuario int not null,
id_politica_descuento int,
cant_entradas int,
monto float,
eliminado boolean not null default false,
constraint PK_compras primary key (id_compra),
constraint PK_compras foreign key (id_usuario) references usuarios (id_usuario) on delete cascade on update cascade,
constraint FK_compras_politicas_descuento foreign key (id_politica_descuento) references politicas_descuento (id_politica_descuento) on delete cascade on update cascade
);


/*Agregado*/
alter table compras add fecha_compra timestamp not null after monto;
alter table compras change column fecha_compra fecha_compra date not null default("2020-01-01") after monto;

/*EJECUTAR ESTA LINEA*/

alter table compras add column fecha_compra date not null default('2020-01-01') after monto;

alter table compras change column id_politica_descuento id_politica_descuento int default null;


create table entradas(
id_entrada int not null auto_increment,
id_compra int not null,
id_funcion int not null,
nro_entrada int not null,
eliminado boolean not null default false,
constraint PK_entradas primary key (id_entrada),
constraint FK_entradas_funciones foreign key (id_funcion) references funciones (id_funcion) on delete cascade on update cascade,
constraint FK_entradas_compras foreign key (id_compra) references compras (id_compra) on delete cascade on update cascade,
constraint unique_entradas unique (id_funcion,nro_entrada)
);

/*Select * from of all tables*/
select 
*
from cines;

select 
*
from generos;

select 
*
from peliculas_cartelera;

select 
*
from peliculasXGenero;

select 
*
from tipos_sala;

select 
*
from salas;

select 
*
from funciones;

select 
*
from tipos_usuario;

select
*
from usuarios;

select 
*
from
politicas_descuento;

select 
*
from
politica_de_descuento_x_dia;

select 
*
from
compras;

select
*
from
entradas;


/*query funcion x compra*/
select f.id_funcion, e.id_compra
from entradas e
inner join funciones f
on f.id_funcion = e.id_funcion;

/*Query cartelera*/
select 
f.id_funcion,
p.id,
p.title
from peliculas_cartelera p
inner join funciones f
on p.id = f.id_pelicula;

/* Filtrar usuarios faceboook */
select *
from usuarios
inner join fbook
on usuarios.id_usuario = fbook.id_usuario;

/*Query funciones de una pelicula*/
select 
f.id_funcion,
p.title
from peliculas_cartelera p
inner join funciones f
on p.id = f.id_pelicula
where id = 425001;

select
p.title,c.nombre_cine, c.calle, c.numero, s.numero_sala, s.cant_butacas - f.cant_asistentes as "butacas_disp", f.fecha_hora
from funciones f 
inner join peliculas_cartelera p
on f.id_pelicula = p.id
inner join salas s
on f.id_sala = s.id_sala
inner join cines c
on s.id_cine = c.id_cine
;

select
c.nombre_cine, c.calle, c.numero, p.title, s.numero_sala, s.cant_butacas , f.cant_asistentes, f.fecha_hora
from funciones f 
inner join peliculas_cartelera p
on f.id_pelicula = p.id
inner join salas s
on f.id_sala = s.id_sala
inner join cines c
on s.id_cine = c.id_cine;

SELECT
c.id_compra as  id_compra,
c.id_usuario as id_usuario,
ifnull(p.porcentaje_descuento,0) as porcentaje_descuento,
c.cant_entradas as cant_entradas,
c.monto as monto
FROM compras c
LEFT JOIN politicas_descuento p
ON c.id_politica_descuento = p.id_politica_descuento
WHERE ((c.eliminado = 0) AND (c.id_usuario = 4));

select 
p.title as titulo_pelicula,
ci.nombre_cine as nombre_cine,
s.numero_sala as numero_sala,
e.nro_entrada as numero_entrada
from 
compras c 
inner join entradas e
on c.id_compra = e.id_compra
inner join funciones f
on f.id_funcion = e.id_funcion
inner join peliculas_cartelera p
on p.id = f.id_pelicula
inner join salas s
on s.id_sala = f.id_sala
inner join cines ci
on s.id_cine = ci.id_cine
where c.id_compra = 4;

/*query cantidad vendida por funcion */

select e.id_funcion, sum(c.monto) as monto
from compras c
inner join entradas e
on c.id_compra = e.id_compra
inner join funciones f
on e.id_funcion = f.id_funcion
group by e.id_funcion;


/*query con subconsulta que devuelve la cantidad de entradas por funcion*/
select f.id_funcion, ifnull(entradas,0) as entradas
from funciones f
left join (select e.id_funcion, sum(c.cant_entradas) as entradas
from compras c
inner join entradas e
on c.id_compra = e.id_compra
inner join funciones f
on e.id_funcion = f.id_funcion
where (c.eliminado = false) and (f.eliminado= false) and(e.eliminado = false)
group by e.id_funcion) as cantidad
on f.id_funcion = cantidad.id_funcion
where f.eliminado = false;

/*query cantidad vendida por pelicula  1*
select cine.id_cine, s.id_sala, e.id_funcion, f.id_pelicula, sum(c.cant_entradas) as monto
from compras c
inner join entradas e
on c.id_compra = e.id_compra
inner join funciones f
on e.id_funcion = f.id_funcion
inner join peliculas_cartelera p
on p.id = f.id_pelicula
inner join salas s
on s.id_sala = f.id_sala
inner join cines cine
on cine.id_cine = s.id_cine
group by f.id_pelicula;*/
select*from salas;
select*from entradas;

/*query definitiva para cantidad de entradas por peliculas*/
select cine.id_cine, s.id_sala, e.id_funcion, f.id_pelicula, ifnull(sum(c.cant_entradas),0) as entradas, s.cant_butacas
from cines cine
left join salas s
on cine.id_cine = s.id_cine
left join funciones f
on s.id_sala = f.id_sala
left join entradas e
on f.id_funcion = e.id_funcion
left join compras c
on c.id_compra = e.id_compra
left join peliculas_cartelera p
on p.id = f.id_pelicula
where (p.eliminado = false)
group by cine.id_cine, s.id_sala, e.id_funcion, f.id_pelicula, p.eliminado;

/*query cantidad vendida por cine */
select cines.id_cine, sum(c.cant_entradas) as monto
from compras c
inner join entradas e
on c.id_compra = e.id_compra
inner join funciones f
on e.id_funcion = f.id_funcion
inner join salas s
on s.id_sala = f.id_sala
inner join cines cines
on s.id_cine = cines.id_cine
group by cines.id_cine;

/*query que devuelve la cantidad de entradas vendidas x cine*/

select cines.id_cine, sum(c.cant_entradas) as cantidad
from compras c
inner join entradas e
on c.id_compra = e.id_compra
inner join funciones f
on e.id_funcion = f.id_funcion
inner join salas s
on s.id_sala = f.id_sala
inner join cines cines
on s.id_cine = cines.id_cine
where c.eliminado = false
group by cines.id_cine;


/*query con subconsulta definitiva para cantidad de entradas cines*/
select cines.id_cine, ifnull(cantidad,0) as cantidad
from cines as cines
left join (select cines.id_cine, sum(c.cant_entradas) as cantidad
from compras c
inner join entradas e
on c.id_compra = e.id_compra
inner join funciones f
on e.id_funcion = f.id_funcion
inner join salas s
on s.id_sala = f.id_sala
inner join cines cines
on s.id_cine = cines.id_cine
where (c.eliminado = false) and (e.eliminado = false) and (f.eliminado = false) and (s.eliminado = false) and (cines.eliminado = false)
group by cines.id_cine
) as cantidad2
on cines.id_cine = cantidad2.id_cine
where cines.eliminado= false;

select*from entradas;

/*query con subconsulta para cantidad de entradas por pelicula*/
select cantidad.id_cine as cines,pelis.id, ifnull(entradas,0) as entradas
from peliculas_cartelera pelis
left join(select cines.id_cine,f.id_sala,f.id_pelicula,sum(c.cant_entradas) as entradas
from compras c
inner join entradas e
on c.id_compra = e.id_compra
inner join funciones f
on e.id_funcion = f.id_funcion
inner join salas s
on s.id_sala = f.id_sala
inner join cines cines
on s.id_cine = cines.id_cine
group by cines.id_cine,f.id_sala,f.id_pelicula) as cantidad
on pelis.id = cantidad.id_pelicula;


/*query con subconsulta que devuelve la cantidad de entradas por funcion*/
select f.id_funcion, ifnull(entradas,0) as entradas
from funciones f
left join (select e.id_funcion, sum(c.cant_entradas) as entradas
from compras c
inner join entradas e
on c.id_compra = e.id_compra
inner join funciones f
on e.id_funcion = f.id_funcion
where (c.eliminado = false) and (f.eliminado= false) and(e.eliminado = false)
group by e.id_funcion) as cantidad
on f.id_funcion = cantidad.id_funcion
where f.eliminado = false;

/*query cantidad vendida por pelicula  1*
select cine.id_cine, s.id_sala, e.id_funcion, f.id_pelicula, sum(c.cant_entradas) as monto
from compras c
inner join entradas e
on c.id_compra = e.id_compra
inner join funciones f
on e.id_funcion = f.id_funcion
inner join peliculas_cartelera p
on p.id = f.id_pelicula
inner join salas s
on s.id_sala = f.id_sala
inner join cines cine
on cine.id_cine = s.id_cine
group by f.id_pelicula;*/
select*from salas;
select*from entradas;

/*query definitiva para cantidad de entradas por peliculas*/
select cine.id_cine, s.id_sala, e.id_funcion, f.id_pelicula, ifnull(sum(c.cant_entradas),0) as entradas, s.cant_butacas
from cines cine
left join salas s
on cine.id_cine = s.id_cine
left join funciones f
on s.id_sala = f.id_sala
left join entradas e
on f.id_funcion = e.id_funcion
left join compras c
on c.id_compra = e.id_compra
left join peliculas_cartelera p
on p.id = f.id_pelicula
where (p.eliminado = false)
group by cine.id_cine, s.id_sala, e.id_funcion, f.id_pelicula, p.eliminado;

/*query cantidad vendida por cine */
select cines.id_cine, sum(c.cant_entradas) as monto
from compras c
inner join entradas e
on c.id_compra = e.id_compra
inner join funciones f
on e.id_funcion = f.id_funcion
inner join salas s
on s.id_sala = f.id_sala
inner join cines cines
on s.id_cine = cines.id_cine
group by cines.id_cine;

/*query que devuelve la cantidad de entradas vendidas x cine*/
select cines.id_cine, sum(c.cant_entradas) as cantidad
from compras c
inner join entradas e
on c.id_compra = e.id_compra
inner join funciones f
on e.id_funcion = f.id_funcion
inner join salas s
on s.id_sala = f.id_sala
inner join cines cines
on s.id_cine = cines.id_cine
where c.eliminado = false
group by cines.id_cine;

/*query con subconsulta definitiva para cantidad de entradas cines*/
select cines.id_cine, ifnull(cantidad,0) as cantidad
from cines as cines
left join (select cines.id_cine, sum(c.cant_entradas) as cantidad
from compras c
inner join entradas e
on c.id_compra = e.id_compra
inner join funciones f
on e.id_funcion = f.id_funcion
inner join salas s
on s.id_sala = f.id_sala
inner join cines cines
on s.id_cine = cines.id_cine
where (c.eliminado = false) and (e.eliminado = false) and (f.eliminado = false) and (s.eliminado = false) and (cines.eliminado = false)
group by cines.id_cine
) as cantidad2
on cines.id_cine = cantidad2.id_cine
where cines.eliminado= false;

/*query con subconsulta para cantidad de entradas por pelicula*/
select cantidad.id_cine as cines,pelis.id, ifnull(entradas,0) as entradas
from peliculas_cartelera pelis
left join(select cines.id_cine,f.id_sala,f.id_pelicula,sum(c.cant_entradas) as entradas
from compras c
inner join entradas e
on c.id_compra = e.id_compra
inner join funciones f
on e.id_funcion = f.id_funcion
inner join salas s
on s.id_sala = f.id_sala
inner join cines cines
on s.id_cine = cines.id_cine
group by cines.id_cine,f.id_sala,f.id_pelicula) as cantidad
on pelis.id = cantidad.id_pelicula;

/*EJECUTAR ESTE CODIGO*/
create table fbook(
  id int not null,
  id_usuario int not null,
  constraint PK_fbook primary key (id),
  constraint fk_idUsuario foreign key (id_usuario) references usuarios(id_usuario) on delete cascade on update cascade,
  constraint unique_id unique (id)
 );

/* Querys para peliculas 
SELECT cine.id_cine, f.id_pelicula, ifnull(count(e.id_compra),0) as entradas, s.cant_butacas
                from cines cine
                left join salas s
                on cine.id_cine = s.id_cine
                left join funciones f
                on s.id_sala = f.id_sala
                left join entradas e
                on f.id_funcion = e.id_funcion
                left join compras c
                on c.id_compra = e.id_compra
                left join peliculas_cartelera p
                on p.id = f.id_pelicula
                where (p.eliminado = false)
                group by f.id_pelicula;
  
select f.id_pelicula, sum(s.cant_butacas) as butacas from funciones f inner join salas s on f.id_sala = s.id_sala group by id_pelicula;
*/

select peliculas.id_pelicula, peliculas.entradas, funciones.butacas as cant_butacas
from(select f.id_pelicula, sum(s.cant_butacas) as butacas from funciones f inner join salas s on f.id_sala = s.id_sala where(f.eliminado = false) and (s.eliminado= false) group by id_pelicula) as funciones
inner join (SELECT cine.id_cine, f.id_pelicula, ifnull(count(e.id_compra),0) as entradas, s.cant_butacas
from cines cine
left join salas s
on cine.id_cine = s.id_cine
left join funciones f
on s.id_sala = f.id_sala
left join entradas e
on f.id_funcion = e.id_funcion
left join compras c
on c.id_compra = e.id_compra
left join peliculas_cartelera p
on p.id = f.id_pelicula
where (p.eliminado = false) and (f.eliminado = false) and (s.eliminado = false)
group by f.id_pelicula) as peliculas
on peliculas.id_pelicula = funciones.id_pelicula
group by funciones.id_pelicula;
			
 
                
/*Filtro para saber la cantidad en pesos recaudado por cine entre fechas*/
select c.id_cine, ifnull(sum(cineMonto.monto),0) as monto
from cines c
left join (select e.id_compra, c.monto , s.id_cine, c.fecha_compra
from entradas e 
inner join compras c 
on c.id_compra = e.id_compra 
inner join funciones f
on e.id_funcion = f.id_funcion
inner join salas s
on s.id_sala = f.id_sala
inner join cines cines
on s.id_cine = cines.id_cine
where (c.fecha_compra >= '2020-11-11') and (c.fecha_compra <= '2020-11-13')
 group by e.id_compra, s.id_cine) as cineMonto
on cineMonto.id_cine = c.id_cine
group by c.id_cine;

