create table estados_civiles(
	id int not null auto_increment,
	nombre varchar(100),
	primary key(id)
);

create table empleados(
	id int not null auto_increment,
	dni int(8) unique,
	apellidos_nombres varchar(100),
	fecha_nacimiento date,
	id_estado_civil int,
	sexo char(1),
	calle_numero_domicilio varchar(150),
	localidad varchar(100),
	primary key(id),
	foreign key (id_estado_civil) references estados_civiles(id)
);

insert into estados_civiles(nombre) values('Soltero');
insert into estados_civiles(nombre) values('Casado');
insert into estados_civiles(nombre) values('Separado');
insert into estados_civiles(nombre) values('Divorciado');
insert into estados_civiles(nombre) values('Viudo');

insert into empleados(dni,apellidos_nombres,fecha_nacimiento,id_estado_civil,sexo,calle_numero_domicilio,localidad) 
			values(12345678,'Perez Juan Alberto','1974-03-14',1,'M','Gral. Paz 152','Villa Carlos Paz');

insert into empleados(dni,apellidos_nombres,fecha_nacimiento,id_estado_civil,sexo,calle_numero_domicilio,localidad) 
			values(12345677,'Francisco Salva','1974-05-21',2,'M','Gral. Paz 130','Villa Carlos Paz');

insert into empleados(dni,apellidos_nombres,fecha_nacimiento,id_estado_civil,sexo,calle_numero_domicilio,localidad) 
			values(12345676,'Osvaldo Minca','1974-07-11',1,'M','Gral. Paz 111','Villa Carlos Paz');