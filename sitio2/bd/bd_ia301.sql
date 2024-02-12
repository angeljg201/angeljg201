-- Script de la Base de datos bd_ia301
-- Guardar CTRL + S

-- DDL: Data Definition Language

create database bd_ia301;

use bd_ia301;

-- drop database bd_ia301;

-- Crear las tablas
create table tb_marca (
	codigo_marca char(5) not null primary key,
    marca varchar(40)
);

create table tb_categoria (
	codigo_categoria char(5) not null primary key,
    categoria varchar(40)
);

describe tb_marca;
describe tb_categoria;

create table tb_producto (
	codigo_producto char(5) not null,
    producto varchar(40) not null,
    stock_disponible int,
    costo numeric(8, 2),
    ganancia numeric(6, 2),
    producto_codigo_marca char(5) not null,
    producto_codigo_categoria char(5) not null,
    foreign key (producto_codigo_marca) references tb_marca (codigo_marca),
    foreign key (producto_codigo_categoria) references tb_categoria (codigo_categoria)
);

-- drop table tb_marca;
-- drop table tb_categoria;
-- drop table tb_producto;

describe tb_producto;

alter table tb_producto
add constraint pk_producto
primary key (codigo_producto);

-- DML: Data Manipulation Language
-- CRUD: Create, Read, Update, Delete
-- Create    ---> Insert into
-- Read      ---> Select
-- Update    ---> Update
-- Delete    ---> Delete

-- Agregar tres registro en cada tabla
insert into tb_marca values
('M0001', 'Samsung'),
('M0002', 'HP'),
('M0003', 'Lenovo');

insert into tb_categoria values
('C0001', 'Smartphone'),
('C0002', 'Tecnología'),
('C0003', 'Electrodométicos');

insert into tb_categoria values
('C0004', 'Zapatos');

insert into tb_producto values
('P0001', 'Laptop Core i3 8GB', 10, 1785.25, 0.23, 'M0003', 'C0002'),
('P0002', 'Smart TV OLED', 42, 2389.41, 0.15, 'M0001', 'C0003');

insert into tb_producto values
('P0003', 'Equipo de sonido', 23, 914.78, 0.212, 'M0001', 'C0003'),
('P0004', 'Audífonos BT', 68, 129.42, 0.24, 'M0002', 'C0002');

select * from tb_marca;

select * from tb_categoria;

select * from tb_producto ;


select tb1.codigo_producto, tb1.producto,
	   tb1.stock_disponible, tb1.costo,
       concat(tb1.ganancia * 100, '%') as ganancia,
       (tb1.costo + tb1.costo * tb1.ganancia) as precio,
       tb2.marca, tb3.categoria
from tb_producto tb1 inner join tb_marca tb2
on (tb1.producto_codigo_marca = tb2.codigo_marca) inner join tb_categoria tb3
on (tb1.producto_codigo_categoria = tb3.codigo_categoria);




select tb1.codigo_producto, tb1.producto,
	   tb1.stock_disponible, tb1.costo, tb1.ganancia,
       tb2.marca, tb3.categoria
from tb_producto tb1 inner join tb_marca tb2
on (tb1.producto_codigo_marca = tb2.codigo_marca) inner join tb_categoria tb3
on (tb1.producto_codigo_categoria = tb3.codigo_categoria);

select tbc.categoria
from tb_categoria tbc left join tb_producto tbp
on (tbc.codigo_categoria = tbp.producto_codigo_categoria)
where tbp.codigo_producto is null;

select tbc.categoria
from tb_producto tbp right join tb_categoria tbc
on (tbc.codigo_categoria = tbp.producto_codigo_categoria)
where tbp.codigo_producto is null;

select * from tb_producto
where costo < 1000;


