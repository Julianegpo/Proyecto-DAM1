drop database Proyecto_Multiplataforma_Inicial;

create database Proyecto_Multiplataforma_Inicial;
use Proyecto_Multiplataforma_Inicial;

create table Genero(
codigo_genero int primary key auto_increment,
nombre_genero varchar(255));
create table Ciudad(
codigo_ciudad int primary key auto_increment,
nombre_ciudad varchar(255));
create table Usuario(
codigo_usuario int primary key auto_increment,
nombre_usuario varchar(255),
contrasenya varchar(255),
correo_usuario varchar(255),
imagen_perfil varchar(255),
telefono_usuario int,
direccion_usuario varchar(255),
tipo int,
fecha_nacimiento date,
codigo_genero int,
codigo_ciudad int,
foreign key(codigo_genero) references Genero(codigo_genero),
foreign key(codigo_ciudad) references Ciudad(codigo_ciudad));
create table Concierto(
codigo_concierto int primary key auto_increment,
nombre_concierto varchar(250),
fecha_concierto date,
estado_concierto int,
codigo_genero int,
codigo_usuario int,
foreign key (codigo_usuario) references Usuario(codigo_usuario),
foreign key(codigo_genero) references Genero(codigo_genero));
create table Subasta(
codigo_usuario int,
codigo_concierto int,
estado_subasta int,
primary key(codigo_usuario, codigo_concierto),
foreign key(codigo_usuario) references Usuario(codigo_usuario),
foreign key(codigo_concierto) references Concierto(codigo_concierto));
create table votacion_usuario(
codigo_fan int,
codigo_votado int,
primary key(codigo_fan, codigo_votado),
foreign key(codigo_fan) references Usuario(codigo_usuario),
foreign key(codigo_votado) references Usuario(codigo_usuario));
create table votacion_concierto(
codigo_fan int,
codigo_concierto int,
primary key(codigo_fan, codigo_concierto),
foreign key(codigo_fan) references Usuario(codigo_usuario),
foreign key(codigo_concierto) references Concierto(codigo_concierto));

insert into Genero(nombre_genero) values('Pop');
insert into Genero(nombre_genero) values('Rock');
insert into Genero(nombre_genero) values('Heavy Metal');
insert into Genero(nombre_genero) values('House');
insert into Genero(nombre_genero) values('Techno');
insert into Genero(nombre_genero) values('Musica clasica');
insert into Genero(nombre_genero) values('Reggae');
insert into Genero(nombre_genero) values('Reggaeton');
insert into Genero(nombre_genero) values('Flamenco');
insert into Genero(nombre_genero) values('Rap');
insert into Genero(nombre_genero) values ('Otro');

insert into Ciudad(nombre_ciudad) values('Barcelona');
insert into Ciudad(nombre_ciudad) values('Madrid');
insert into Ciudad(nombre_ciudad) values('Malaga');
insert into Ciudad(nombre_ciudad) values('Castellon');
insert into Ciudad(nombre_ciudad) values('Ourense');
insert into Ciudad(nombre_ciudad) values('Santander');
insert into Ciudad(nombre_ciudad) values('Gijon');
insert into Ciudad(nombre_ciudad) values('Jerez de la Frontera');
insert into Ciudad(nombre_ciudad) values('Tarragona');
insert into Ciudad(nombre_ciudad) values('Valencia');
insert into Ciudad(nombre_ciudad) values('Jaen');
insert into Ciudad(nombre_ciudad) values('Extremadura');
insert into Ciudad(nombre_ciudad) values('Aragon');
insert into Ciudad(nombre_ciudad) values('Pais Vasco');

select * from usuario;
select * from concierto;
select * from genero;
select * from ciudad;
select * from Subasta;