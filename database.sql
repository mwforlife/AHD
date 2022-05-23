create database ahd_database charset=utf8;

alter database ahd_database charset=utf8;

use ahd_database;

#tabla servicios
create table servicios(
id_ser int not null primary key auto_increment,
nom_ser varchar(50) not null,
precio int not null
);




/*Insercion Servicios*/
insert into servicios values(null,"Corte de pelo",5000);
Insert into servicios values(null,"Tintura de pelo",8000);
insert into servicios values(null, "Depilacion",15000);
insert into servicios values(null,"Corte y delineado de barba",3000);
insert into servicios values(null,"Delineado de barba",3000);
insert into servicios values(null,"Tinte de barba",5000);
insert into servicios values(null,"Tinte de cabello",10000);
insert into servicios values(null,"Alisado de cabello",12000);
insert into servicios values(null,"Exfoliacion",20000);
insert into servicios values(null,"Mascarilla",8000);
insert into servicios values(null,"Tratamiento Farcial",20000);
insert into servicios values(null,"Tratamientos capilares",15000);

#tabla regiones
create table regiones(
id_reg int not null primary key,
nom_reg varchar(50) not null
);

#tabla comunas
create table comunas(
id_com int not null primary key auto_increment,
nom_com varchar(50) not null,
id_reg int not null references regiones(id_reg) 
);

#tabla sexos
create table sexos(
id_sex int not null auto_increment primary key,
nom_sex varchar(20) not null
);

/*Insercion Sexos*/
insert into sexos values(null,'Masculino');
insert into sexos values(null,'Feminino');

#Tabla estado_reservas
create table estado_reservas(
id_est int not null auto_increment primary key,
nom_est varchar(20) not null
);

/*Insercion estado_reservas*/
insert into estado_reservas values(null,"Pendiente");
insert into estado_reservas values(null,"Cancelado");
insert into estado_reservas values(null,"Confirmado");
insert into estado_reservas values(null,"Mal hecho");
insert into estado_reservas values(null,"Atendido");


#Tabla Tipo_trabajador
create table tipo_trabajador(
id_tip int not null auto_increment primary key,
nom_tip varchar(40) not null
);

#Insercion Cargo
insert into tipo_trabajador values(null,"Recepcionista");
insert into tipo_trabajador values(null,"Auxiliar de aseo");
insert into tipo_trabajador values(null,"Peluquero");
insert into tipo_trabajador values(null, "Estilista");
insert into tipo_trabajador values(null, "Esteticista");
insert into tipo_trabajador values(null, "Manicurista");
insert into tipo_trabajador values(null, "Barbero/a");
insert into tipo_trabajador values(null, "Auxiliar de Depilacion");

#Tabla Estado Mensajes
create table estado_mensaje(
id_est int not null auto_increment primary key,
nom_est varchar(20) not null
);

#Tabla Usuarios
create table usuarios(
id_usu varchar(20) not null primary key,
nom_usu varchar(40) not null,
ape_usu varchar(40) not null,
log_usu varchar(40) not null,
pas_usu varchar(64) not null,
fec_nac date not null,
id_sex int not null references sexos(id_sex),
tel_usu varchar(20) not null,
id_reg int not null references regiones(id_reg),
id_com int not null references comunas(id_com),
direccion varchar(50) not null,
cor_usu varchar(60) not null,
token varchar(64) not null,
reporte int not null,
ult_vis datetime not null,
created timestamp not null
);

#Tabla peluquerias
create table peluquerias(
id_pel int not null auto_increment primary key,
nom_pel varchar(50) not null,
log_pel varchar(30) not null,
pas_pel varchar(64) not null,
rep_pel varchar(50) not null,
id_reg int not null references regiones(id_reg),
id_com int not null references comunas(id_com),
direccion varchar(50) not null,
cor_pel varchar(40) not null,
ult_vis datetime not null,
estado int not null,
created timestamp not null
);

#Tabla trabajadores
create table trabajadores(
id_tra varchar(30) not null primary key,
nom_tra varchar(40) not null,
ape_tra varchar(40) not null,
fec_nac date not null,
id_reg int not null references regiones(id_reg),
id_com int not null references comunas(id_com),
direccion varchar(50) not null,
id_tip int not null references tipo_trabajador(id_tip),
ult_vis  datetime  not null,
created timestamp not null,
foto varchar(40)
);

#Tablas Nub_trabajadores
create table nub_trabajadores(
id_nub int not null auto_increment primary key,
id_pel int not null references peluquerias(id_pel),
id_tra varchar(30) not null references trabajadores(id_tra),
nom_usu varchar(40) not null,
pas_usu varchar(64) not null,
sue_tra int not null,
cor_tra varchar(60) not null,
tel_usu varchar(60) not null,
ini_con date not null,
term_con date not null
);

#Tablas contactos
create table telefonos(
id_tel int not null auto_increment primary key,
id_pel int not null references peluquerias(id_pel),
num_tel varchar(20) not null
);

#Tabla Mensajes
create table mensajes(
id_men int not null auto_increment primary key,
id_usu varchar(20) not null references usuarios(id_usu),
id_pel int not null references peluquerias(id_pel),
text_men varchar(400) not null,
id_est int not null references estado_mensaje(id_est),
hora_men time not null,
fecha_men date not null
);

#Tabla Horario
create table tabla_horario(
id_ta int not null primary key auto_increment,
hora time not null
);

insert into tabla_horario values (null,"09:00");
insert into tabla_horario values (null,"09:30");
insert into tabla_horario values (null,"10:00");
insert into tabla_horario values (null,"10:30");
insert into tabla_horario values (null,"11:00");
insert into tabla_horario values (null,"11:30");
insert into tabla_horario values (null,"12:00");
insert into tabla_horario values (null,"12:30");
insert into tabla_horario values (null,"13:00");
insert into tabla_horario values (null,"13:30");
insert into tabla_horario values (null,"14:00");
insert into tabla_horario values (null,"14:30");
insert into tabla_horario values (null,"15:00");
insert into tabla_horario values (null,"15:30");
insert into tabla_horario values (null,"16:00");
insert into tabla_horario values (null,"16:30");
insert into tabla_horario values (null,"17:00");
insert into tabla_horario values (null,"17:30");
insert into tabla_horario values (null,"18:00");
insert into tabla_horario values (null,"18:30");


create table reservas(
id_res int not null auto_increment primary  key,
id_pel int not null references peluquerias(id_pel),
id_est int not null references estado_reservas(id_est),
id_ser int not null references servicios(id_ser),
id_usu varchar(20) not null references usuarios(id_usu),
id_ta int not null references tabla_horario(id_ta),
fec_res varchar(20) not null,
id_tra varchar(30) not null references trabajadores(id_tra)
);


create table estado_soporte(
id_est int not null auto_increment primary key,
nombre varchar(30) not null
);

insert into estado_soporte values(null,'Cliente');
insert into estado_soporte values(null,'Administrador');

create table soportes(
id_sop int not null auto_increment primary key,
nombre varchar(20) not null,
correo varchar(40) not null,
telefono int not null,
asunto varchar(40) not null,
mensaje varchar(100) not null,
hora timestamp not null,
fecha date not null,
id_est int not null references estado_soporte(id_est)
);


/*insercion regiones*/
insert into regiones values(1,"Región de Arica y Parinacota");
insert into regiones values(2,"Región de Tarapacá");
insert into regiones values(3,"Región de Antofagasta");
insert into regiones values(4,"Región de Atacama");
insert into regiones values(5,"Región de Coquimbo");
insert into regiones values(6,"Región de Valparaiso");
insert into regiones values(7,"Región del Libertador General Bernardo O'Higgins");
insert into regiones values(8,"Región del Maule");
insert into regiones values(9,"Región del BioBio");
insert into regiones values(10,"Región de La Araucania");
insert into regiones values(11,"Región de Los Ríos");
insert into regiones values(12,"Región de Los Lagos");
insert into regiones values(13,"Región de Aysén del General Carlos ibáñez del Campo");
insert into regiones values(14,"Región de Magallanes y la Antartica Chilena");
insert into regiones values(15,"Región Metropolitana de Santiago");

/*Insercion Comunas*/
/*Comunas de la region Arica Parinacota*/
insert into comunas values(null,"Arica",1);
insert into comunas values(null,"Camarones",1);
insert into comunas values(null,"Putre",1);
insert into comunas values(null,"General Lagos",1);

/*Comunas de la region Tarapaca*/
insert into comunas values(null,"Iquique",2);
insert into comunas values(null,"Alto Hospicio",2);
insert into comunas values(null,"Pozo Almonte",2);
insert into comunas values(null,"Camiña",2);
insert into comunas values(null,"Colchane",2);
insert into comunas values(null,"Huara",2);
insert into comunas values(null,"Pica",2);

/*Comunas de la region Antofagasta*/
insert into comunas values(null,"Antofagasta",3);
insert into comunas values(null,"Mejillones",3);
insert into comunas values(null,"Sierra Gorda",3);
insert into comunas values(null,"Taltal",3);
insert into comunas values(null,"Calama",3);
insert into comunas values(null,"Ollagüe",3);
insert into comunas values(null,"San Pedro de Atacama",3);
insert into comunas values(null,"Tocopilla",3);
insert into comunas values(null,"María Elena",3);

/*Comunas de la region Atacama*/
insert into comunas values(null,"Copiapó",4);
insert into comunas values(null,"Caldrea",4);
insert into comunas values(null,"Tierra Amarilla",4);
insert into comunas values(null,"Chañaral",4);
insert into comunas values(null,"Diego de Almagro",4);
insert into comunas values(null,"Vallenar",4);
insert into comunas values(null,"Alto del Carmen",4);
insert into comunas values(null,"Freirina",4);
insert into comunas values(null,"Huasco",4);

/*Comunas de la region Coquimbo*/
insert into comunas values(null,"La Serena",5);
insert into comunas values(null,"Coquimbo",5);
insert into comunas values(null,"Andacollo",5);
insert into comunas values(null,"La Higuera",5);
insert into comunas values(null,"Paiguano",5);
insert into comunas values(null,"Vicuña",5);
insert into comunas values(null,"Illapel",5);
insert into comunas values(null,"Canela",5);
insert into comunas values(null,"Los Vilos",5);
insert into comunas values(null,"Salamanca",5);
insert into comunas values(null,"Ovalle",5);
insert into comunas values(null,"Combarbalá",5);
insert into comunas values(null,"Monte Patria",5);
insert into comunas values(null,"Punitaqui",5);
insert into comunas values(null,"Rio Hurtado",5);

/*Comunas de la region Valparaiso*/
insert into comunas values(null,"Valparaiso",6);
insert into comunas values(null,"CasaBlanca",6);
insert into comunas values(null,"Concón",6);
insert into comunas values(null,"Juan Fernández",6);
insert into comunas values(null,"Puchuncavi",6);
insert into comunas values(null,"Quintero",6);
insert into comunas values(null,"Viña del Mar",6);
insert into comunas values(null,"Isla de Pascua",6);
insert into comunas values(null,"Los Andes",6);
insert into comunas values(null,"Calle Larga",6);
insert into comunas values(null,"Rinconada",6);
insert into comunas values(null,"San Esteban",6);
insert into comunas values(null,"La Ligua",6);
insert into comunas values(null,"Cabildo",6);
insert into comunas values(null,"Papudo",6);
insert into comunas values(null,"Petorca",6);
insert into comunas values(null,"Zapallar",6);
insert into comunas values(null,"Quillota",6);
insert into comunas values(null,"Calera",6);
insert into comunas values(null,"Hijuelas",6);
insert into comunas values(null,"La Cruz",6);
insert into comunas values(null,"Nogales",6);
insert into comunas values(null,"San Antonio",6);
insert into comunas values(null,"Algarrobo",6);
insert into comunas values(null,"Cartagena",6);
insert into comunas values(null,"El Quisco",6);
insert into comunas values(null,"El Tabo",6);
insert into comunas values(null,"Santo Domingo",6);
insert into comunas values(null,"San Felipe",6);
insert into comunas values(null,"Catemu",6);
insert into comunas values(null,"Llaillay",6);
insert into comunas values(null,"Panquehue",6);
insert into comunas values(null,"Putaendo",6);
insert into comunas values(null,"Santa Maria",6);
insert into comunas values(null,"Limache",6);
insert into comunas values(null,"Quilpué",6);
insert into comunas values(null,"Villa Alemana",6);
insert into comunas values(null,"Olmué",6);

/*Comunas de la region Libertador Gral. bernardo O'Higgins*/
insert into comunas values(null,"Rancagua",7);
insert into comunas values(null,"Codegua",7);
insert into comunas values(null,"Coinco",7);
insert into comunas values(null,"Coltauco",7);
insert into comunas values(null,"Doñihue",7);
insert into comunas values(null,"Graneros",7);
insert into comunas values(null,"Las Cabras",7);
insert into comunas values(null,"Machali",7);
insert into comunas values(null,"Malloa",7);
insert into comunas values(null,"Mostazal",7);
insert into comunas values(null,"Olivar",7);
insert into comunas values(null,"Peumo",7);
insert into comunas values(null,"piChedegua",7);
insert into comunas values(null,"Quinta de Tilcoco",7);
insert into comunas values(null,"Rengo",7);
insert into comunas values(null,"Requinoa",7);
insert into comunas values(null,"San Vicente",7);
insert into comunas values(null,"Pichilemu",7);
insert into comunas values(null,"Las Estrellas",7);
insert into comunas values(null,"Litueche",7);
insert into comunas values(null,"Marchihue",7);
insert into comunas values(null,"Navidad",7);
insert into comunas values(null,"Paredones",7);
insert into comunas values(null,"San Fernando",7);
insert into comunas values(null,"Chépica",7);
insert into comunas values(null,"Chimbarongo",7);
insert into comunas values(null,"Lolol",7);
insert into comunas values(null,"Nancagua",7);
insert into comunas values(null,"Palmilla",7);
insert into comunas values(null,"Peralillo",7);
insert into comunas values(null,"Placilla",7);
insert into comunas values(null,"Pumanque",7);
insert into comunas values(null,"Santa Cruz",7);

/*Comunas de la region del Maule*/
insert into comunas values(null,"Talca",8);
insert into comunas values(null,"Constitución",8);
insert into comunas values(null,"Curepto",8);
insert into comunas values(null,"Empedrado",8);
insert into comunas values(null,"Maule",8);
insert into comunas values(null,"Pelarco",8);
insert into comunas values(null,"Pencahue",8);
insert into comunas values(null,"Rio Claro",8);
insert into comunas values(null,"San Clemente",8);
insert into comunas values(null,"San Rafael",8);
insert into comunas values(null,"Cauquenes",8);
insert into comunas values(null,"Chanco",8);
insert into comunas values(null,"Curico",8);
insert into comunas values(null,"Hualañe",8);
insert into comunas values(null,"Licantén",8);
insert into comunas values(null,"Molina",8);
insert into comunas values(null,"Rauco",8);
insert into comunas values(null,"Romeral",8);
insert into comunas values(null,"Sagrada Familia",8);
insert into comunas values(null,"Teno",8);
insert into comunas values(null,"Vichuquén",8);
insert into comunas values(null,"linares",8);
insert into comunas values(null,"Colbún",8);
insert into comunas values(null,"Longaví",8);
insert into comunas values(null,"Parral",8);
insert into comunas values(null,"Retiro",8);
insert into comunas values(null,"San Javier",8);
insert into comunas values(null,"Villa Alegre",8);
insert into comunas values(null,"Yerbas Buenas",8);

/*Comunas de la region del BioBio*/
insert into comunas values(null,"Concepción",9);
insert into comunas values(null,"Coronel",9);
insert into comunas values(null,"Chiguayante",9);
insert into comunas values(null,"Florida",9);
insert into comunas values(null,"Hualqui",9);
insert into comunas values(null,"Lota",9);
insert into comunas values(null,"penco",9);
insert into comunas values(null,"San Pedro de la Paz",9);
insert into comunas values(null,"Santa Juana",9);
insert into comunas values(null,"Talcahuano",9);
insert into comunas values(null,"Tomé",9);
insert into comunas values(null,"Hualpén",9);
insert into comunas values(null,"Lebu",9);
insert into comunas values(null,"Arauco",9);
insert into comunas values(null,"Cañete",9);
insert into comunas values(null,"Contulmo",9);
insert into comunas values(null,"Curanilahue",9);
insert into comunas values(null,"Los Alomos",9);
insert into comunas values(null,"Turúa",9);
insert into comunas values(null,"Los angeles",9);
insert into comunas values(null,"Antuco",9);
insert into comunas values(null,"Cabrero",9);
insert into comunas values(null,"Laja",9);
insert into comunas values(null,"Mulchén",9);
insert into comunas values(null,"Nacimiento",9);
insert into comunas values(null,"Negrete",9);
insert into comunas values(null,"Quilaco",9);
insert into comunas values(null,"Quilleco",9);
insert into comunas values(null,"San Rosendo",9);
insert into comunas values(null,"Santa Bärbara",9);
insert into comunas values(null,"Tucapel",9);
insert into comunas values(null,"Yumbel",9);
insert into comunas values(null,"Alto Biiobío",9);
insert into comunas values(null,"Chillán",9);
insert into comunas values(null,"Bulnes",9);
insert into comunas values(null,"Cobquecura",9);
insert into comunas values(null,"Coelemu",9);
insert into comunas values(null,"Coihueco",9);
insert into comunas values(null,"Chillán Viejo",9);
insert into comunas values(null,"El Carmen",9);
insert into comunas values(null,"Ninhue",9);
insert into comunas values(null,"Ñiquen",9);
insert into comunas values(null,"Pemuco",9);
insert into comunas values(null,"Pinto",9);
insert into comunas values(null,"Portezuelo",9);
insert into comunas values(null,"Quillón",9);
insert into comunas values(null,"Quirihue",9);
insert into comunas values(null,"Ránquil",9);
insert into comunas values(null,"San Carlos",9);
insert into comunas values(null,"San Fabián",9);
insert into comunas values(null,"San Ignacio",9);
insert into comunas values(null,"San Nicolás",9);
insert into comunas values(null,"Treguaco",9);
insert into comunas values(null,"Yungay",9);

/*Las comunas de la region Araucania*/
insert into comunas values(null,"Temuco",10);
insert into comunas values(null,"Carahue",10);
insert into comunas values(null,"Cunco",10);
insert into comunas values(null,"Currahue",10);
insert into comunas values(null,"Freire",10);
insert into comunas values(null,"Galvarino",10);
insert into comunas values(null,"Gorbea",10);
insert into comunas values(null,"Lautaro",10);
insert into comunas values(null,"Loncoche",10);
insert into comunas values(null,"Melipeuco",10);
insert into comunas values(null,"Nueva Imperial",10);
insert into comunas values(null,"Padre de las Casas",10);
insert into comunas values(null,"Perquenco",10);
insert into comunas values(null,"Pitrufquén",10);
insert into comunas values(null,"Pucón",10);
insert into comunas values(null,"Saavedra",10);
insert into comunas values(null,"Teodoro Schmidt",10);
insert into comunas values(null,"Toltén",10);
insert into comunas values(null,"Vilcún",10);
insert into comunas values(null,"Villarrica",10);
insert into comunas values(null,"Cholchol",10);
insert into comunas values(null,"Angol",10);
insert into comunas values(null,"Collipulli",10);
insert into comunas values(null,"Curacautín",10);
insert into comunas values(null,"Ercilla",10);
insert into comunas values(null,"Lonquimay",10);
insert into comunas values(null,"Los Sauces",10);
insert into comunas values(null,"Lumaco",10);
insert into comunas values(null,"Purén",10);
insert into comunas values(null,"Renaico",10);
insert into comunas values(null,"Traguén",10);
insert into comunas values(null,"Victoria",10);

/*Comunas de la region de los RIOS*/
insert into comunas values(null,"Valdiva",11);
insert into comunas values(null,"Corral",11);
insert into comunas values(null,"Lanco",11);
insert into comunas values(null,"Los Lagos",11);
insert into comunas values(null,"Marfil",11);
insert into comunas values(null,"Mariquina",11);
insert into comunas values(null,"Paillaco",11);
insert into comunas values(null,"Panguipulli",11);
insert into comunas values(null,"La Unión",11);
insert into comunas values(null,"Futrono",11);
insert into comunas values(null,"lago Ranco",11);
insert into comunas values(null,"Río Bueno",11);

/*Comunas de la region los Lagos*/
insert into comunas values(null,"Puerto Montt",12);
insert into comunas values(null,"Calbuco",12);
insert into comunas values(null,"Cochamó",12);
insert into comunas values(null,"Fresia",12);
insert into comunas values(null,"Frutillar",12);
insert into comunas values(null,"Los Muermos",12);
insert into comunas values(null,"Llanquihue",12);
insert into comunas values(null,"Maullín",12);
insert into comunas values(null,"Puerto Varas",12);
insert into comunas values(null,"Castro",12);
insert into comunas values(null,"Ancud",12);
insert into comunas values(null,"Chonchi",12);
insert into comunas values(null,"Curaco de Vélez",12);
insert into comunas values(null,"Dalcahue",12);
insert into comunas values(null,"Puqueldón",12);
insert into comunas values(null,"Queilén",12);
insert into comunas values(null,"Quellón",12);
insert into comunas values(null,"Quemchi",12);
insert into comunas values(null,"Quimchao",12);
insert into comunas values(null,"Osorno",12);
insert into comunas values(null,"Puerto Octay",12);
insert into comunas values(null,"Purranque",12);
insert into comunas values(null,"Puyehue",12);
insert into comunas values(null,"Río Negro",12);
insert into comunas values(null,"San Juan de la Costa",12);
insert into comunas values(null,"San Pablo",12);
insert into comunas values(null,"Chaitén",12);
insert into comunas values(null,"Futaleufú",12);
insert into comunas values(null,"Hualaihúe",12);
insert into comunas values(null,"Palena",12);

/*Comunas de la region Aisen*/

insert into comunas values(null,"Coyhaique",13);
insert into comunas values(null,"Lago Verde",13);
insert into comunas values(null,"Aisén",13);
insert into comunas values(null,"Cisnes",13);
insert into comunas values(null,"Guaitecas",13);
insert into comunas values(null,"Cochrane",13);
insert into comunas values(null,"O'Higgins",13);
insert into comunas values(null,"Tortel",13);
insert into comunas values(null,"Chile Chico",13);
insert into comunas values(null,"Rio Ibáñez",13);

/*Region de MAGALLANES Y DE LA ANTÁRTICA CHILENA */
insert into comunas values(null,"Punta Arenas",14);
insert into comunas values(null,"Laguna Blanca",14);
insert into comunas values(null,"Río Verde",14);
insert into comunas values(null,"San Gregorio",14);
insert into comunas values(null,"Cabo de Hornos",14);
insert into comunas values(null,"Antártica",14);
insert into comunas values(null,"Porvenir",14);
insert into comunas values(null,"Primavera",14);
insert into comunas values(null,"Timaukel",14);
insert into comunas values(null,"Natales",14);
insert into comunas values(null,"Torres del Paine",14);

/*Comunas de la region Metropolitana de Santiago*/
insert into comunas values(null,"Santiago",15);
insert into comunas values(null,"Cerrillos",15);
insert into comunas values(null,"Cerro Navia",15);
insert into comunas values(null,"Conchali",15);
insert into comunas values(null,"El Bosque",15);
insert into comunas values(null,"Estación Central",15);
insert into comunas values(null,"Huechuraba",15);
insert into comunas values(null,"Independencia",15);
insert into comunas values(null,"La Cisterna",15);
insert into comunas values(null,"La Florida",15);
insert into comunas values(null,"La Granja",15);
insert into comunas values(null,"La Pintana",15);
insert into comunas values(null,"La Reina",15);
insert into comunas values(null,"Las Condes",15);
insert into comunas values(null,"Lo Barnechea",15);
insert into comunas values(null,"Lo Espejo",15);
insert into comunas values(null,"Lo Prado",15);
insert into comunas values(null,"Macul",15);
insert into comunas values(null,"Maipú",15);
insert into comunas values(null,"Ñuñoa",15);
insert into comunas values(null,"Pedro Aguirre Cerda",15);
insert into comunas values(null,"Peñalolén",15);
insert into comunas values(null,"Providencia",15);
insert into comunas values(null,"Pugahuel",15);
insert into comunas values(null,"Quilicura",15);
insert into comunas values(null,"Quinta Normal",15);
insert into comunas values(null,"Recoleta",15);
insert into comunas values(null,"Renca",15);
insert into comunas values(null,"San Joaquín",15);
insert into comunas values(null,"San Miguel",15);
insert into comunas values(null,"San Ramón",15);
insert into comunas values(null,"Vitacura",15);
insert into comunas values(null,"Puente Alto",15);
insert into comunas values(null,"Pirque",15);
insert into comunas values(null,"San José de Maipo",15);
insert into comunas values(null,"Colina",15);
insert into comunas values(null,"Lampa",15);
insert into comunas values(null,"Tiltril",15);
insert into comunas values(null,"San Bernardo",15);
insert into comunas values(null,"Buin",15);
insert into comunas values(null,"Calera de Tango",15);
insert into comunas values(null,"Paine",15);
insert into comunas values(null,"Melipilla",15);
insert into comunas values(null,"Alhué",15);
insert into comunas values(null,"Curacavi",15);
insert into comunas values(null,"María Pinto",15);
insert into comunas values(null,"San Pedro",15);
insert into comunas values(null,"Talagante",15);
insert into comunas values(null,"El Monte",15);
insert into comunas values(null,"Isla de Maipo",15);
insert into comunas values(null,"Padre Hurtado",15);
insert into comunas values(null,"Peñaflor",15);


insert into estado_mensaje values(1,'Mensaje Peluqueria');
insert into estado_mensaje values(2, 'Mensaje Cliente');


/*Insercion de Usuario*/
insert into usuarios values('25.484.361-K','Wilkens','Mompoint','mwforlife',sha1('21chichi'),'1999-10-24',1,'+56945250440',7,84,'Av OHiggins 740','mwforlife24@gmail.com',sha1('mwforlife24@gmail.com'),0,now(),null);
insert into usuarios values('11.111.111-1','Alvaro','Leiva','aleiva',sha1('123456'),'1999-10-24',1,'+56945250440',7,84,'Av OHiggins 740','aleiva@gmail.com',sha1('jperez@gmail.com'),0,now(),null);
insert into usuarios values('22.222.222-2','Luis','Sanchez','lsanchez',sha1('123456'),'1999-10-24',1,'+56945250440',7,84,'Av OHiggins 740','lsanchez@gmail.com',sha1('jperez@gmail.com'),0,now(),null);
insert into usuarios values('33.333.333-3','Oscar','Arias','oarias',sha1('123456'),'1999-10-24',1,'+56945250440',7,84,'Av OHiggins 740','oarias@gmail.com',sha1('jperez@gmail.com'),0,now(),null);
insert into usuarios values('44.444.444-4','Yohanna','Toledo','ytoledo',sha1('123456'),'1999-10-24',1,'+56945250440',7,84,'Av OHiggins 740','ytoledo@gmail.com',sha1('jperez@gmail.com'),0,now(),null);
insert into usuarios values('55.555.555-5','Paola','Pinto','ppinto',sha1('123456'),'1999-10-24',1,'+56945250440',7,84,'Av OHiggins 740','ppinto@gmail.com',sha1('jperez@gmail.com'),0,now(),null);
insert into usuarios values('66.666.666-6','Juan','Urrutia','jurrutia',sha1('123456'),'1999-10-24',1,'+56945250440',7,84,'Av OHiggins 740','jurrutia@gmail.com',sha1('jperez@gmail.com'),0,now(),null);
insert into usuarios values('77.777.777-7','Ariel','Melo','amelo',sha1('123456'),'1999-10-24',1,'+56945250440',7,84,'Av OHiggins 740','amelo@gmail.com',sha1('jperez@gmail.com'),0,now(),null);
insert into usuarios values('88.888.888-8','Cristian','Riquelme','criquelme',sha1('123456'),'1999-10-24',1,'+56945250440',7,84,'Av OHiggins 740','criquelme@gmail.com',sha1('jperez@gmail.com'),0,now(),null);
insert into usuarios values('99.999.999-9','Adolfo','Matus','amatus',sha1('123456'),'1999-10-24',1,'+56945250440',7,84,'Av OHiggins 740','amatus@gmail.com',sha1('jperez@gmail.com'),0,now(),null);
insert into usuarios values('3.516.816-8','Bastian','Riquelme','briquelme',sha1('123456'),'1999-10-24',1,'+56945250440',7,84,'Av OHiggins 740','briquelme@gmail.com',sha1('jperez@gmail.com'),0,now(),null);
insert into usuarios values('30.123.464-3','Francisco','Orellana','forellana',sha1('123456'),'1999-10-24',1,'+56945250440',7,84,'Av OHiggins 740','forellana@gmail.com',sha1('jperez@gmail.com'),0,now(),null);
insert into usuarios values('30.532.543-0','Juan','Perez','jperez',sha1('123456'),'1999-10-24',1,'+56945250440',7,84,'Av OHiggins 740','jperez@gmail.com',sha1('jperez@gmail.com'),0,now(),null);
insert into usuarios values('30.123.463-5','Joel','Pedro','jpedro',sha1('123456'),'1999-10-24',1,'+56945250440',7,84,'Av OHiggins 740','jpedro@gmail.com',sha1('jperez@gmail.com'),0,now(),null);
insert into usuarios values('30.123.462-7','Paul','Godin','pgodin',sha1('123456'),'1999-10-24',1,'+56945250440',7,84,'Av OHiggins 740','pdogin@gmail.com',sha1('jperez@gmail.com'),0,now(),null);


/*Insercion Usuario Administrador peluquerias*/
insert into peluquerias values(null,"Administrador General","admin",sha1('admin'),"Administrador",7,83,"Av Ohiggins 324","admin@nuevostyle.cl",now(),1,null);
#Registro de peluquerias
insert into peluquerias values(null,"Sucursal Rancagua","srancagua",sha1('123456'),"Juan Perez",7,83,"Av Ohiggins 324","srancagua@nuevostyle.cl",now(),1,null);
insert into peluquerias values(null,"Sucursal Rengo","srengo",sha1('123456'),"Juanito Perez",7,97,"Av Ohiggins 875","srengo@nuevostyle.cl",now(),1,null);
insert into peluquerias values(null,"Sucursal Arica","sarica",sha1('123456'),"Juanito Dominguez",1,1,"Av Ohiggins 24","sarica@nuevostyle.cl",now(),1,null);
insert into peluquerias values(null,"Sucursal Nacagua","snacagua",sha1('123456'),"Juanito Dominguez",7,110,"Av Ohiggins 24","snacagua@nuevostyle.cl",now(),1,null);


#Registro de trabajadores
insert into trabajadores values('24.880.292-8','Ben ','Parker','1985-10-14',1,1,'Colina 123',1,now(),now(),'men_1.jpg');
insert into trabajadores values('25.270.710-7','Peter ','Parker','1985-10-14',1,1,'Colina 123',4,now(),now(),'men_2.jpg');
insert into trabajadores values('44.444.444-4','Rashford ','Jhon','1985-10-14',1,1,'Colina 123',3,now(),now(),'men_3.jpg');
insert into trabajadores values('55.555.555-5','Naranjo ','Gonzalez','1985-10-14',1,1,'Colina 123',4,now(),now(),'men_4.jpg');
insert into trabajadores values('66.666.666-6','Campos ','Hernandez','1985-10-14',1,1,'Colina 123',3,now(),now(),'men_5.jpg');
insert into trabajadores values('77.777.777-7','Berumen ','Cedillo','1985-10-14',1,1,'Colina 123',4,now(),now(),'men_7.jpg');
insert into trabajadores values('88.888.888-8','Escalante ','Palafox','1985-10-14',1,1,'Colina 123',5,now(),now(),'men_1.jpg');
insert into trabajadores values('99.999.999-9','Flores ','Olivares','1985-10-14',1,1,'Colina 123',5,now(),now(),'men_2.jpg');
insert into trabajadores values('25.544.456-8','Ramon ','Fierros','1985-10-14',1,1,'Colina 123',3,now(),now(),'men_3.jpg');
insert into trabajadores values('CH4585424','Gonzalo ','Jimenez','1985-10-14',1,1,'Colina 123',7,now(),now(),'men_4.jpg');


insert into nub_trabajadores values(null,2,'24.880.292-8','PBen',sha1('123456'),350000,'pben@gmail.com',987654321,now(),'2022-05-22');
insert into nub_trabajadores values(null,2,'25.270.710-7','PPeter',sha1('123456'),350000,'ppeter@gmail.com',987654321,now(),'2022-05-22');
insert into nub_trabajadores values(null,2,'44.444.444-4','JRasford',sha1('123456'),350000,'jrasford@gmail.com',987654321,now(),'2022-05-22');
insert into nub_trabajadores values(null,2,'55.555.555-5','GNaranjo',sha1('123456'),350000,'gnaranjo@gmail.com',987654321,now(),'2022-05-22');
insert into nub_trabajadores values(null,2,'66.666.666-6','HCampos',sha1('123456'),350000,'hcampos@gmail.com',987654321,now(),'2022-05-22');
insert into nub_trabajadores values(null,2,'77.777.777-7','CBerumen',sha1('123456'),350000,'cberumen@gmail.com',987654321,now(),'2022-05-22');
insert into nub_trabajadores values(null,2,'88.888.888-8','PEscalante',sha1('123456'),350000,'pescalante@gmail.com',987654321,now(),'2022-05-22');
insert into nub_trabajadores values(null,2,'99.999.999-9','OFlores',sha1('123456'),350000,'oflores@gmail.com',987654321,now(),'2022-05-22');
insert into nub_trabajadores values(null,2,'25.544.456-8','FRamon',sha1('123456'),350000,'framon@gmail.com',987654321,now(),'2022-05-22');
insert into nub_trabajadores values(null,2,'CH4585424','JGonzalo',sha1('123456'),350000,'jgonzalo@gmail.com',987654321,now(),'2022-05-22');




/*Insercion reservas Sucursal 1*/
insert into reservas values(null,2,1,1,'25.484.361-K',1,'2021-11-25','25.270.710-7');
insert into reservas values(null,2,1,2,'11.111.111-1',2,'2021-11-25','25.270.710-7');
insert into reservas values(null,2,1,3,'22.222.222-2',3,'2021-11-25','44.444.444-4');
insert into reservas values(null,2,1,4,'33.333.333-3',4,'2021-11-25','44.444.444-4');
insert into reservas values(null,2,1,5,'44.444.444-4',5,'2021-11-25','55.555.555-5');
insert into reservas values(null,2,1,6,'55.555.555-5',6,'2021-11-25','66.666.666-6');
insert into reservas values(null,2,1,7,'25.484.361-K',7,'2021-11-25','77.777.777-7');
insert into reservas values(null,2,1,8,'25.484.361-K',8,'2021-11-25','77.777.777-7');


insert into trabajadores values('CL55486325','Alejandro ','Muñoz','1985-10-14',1,1,'Colina 123',3,now(),now(),'men_5.jpg');
insert into trabajadores values('CL8754632','Francisco ','Gomez','1985-10-14',1,1,'Colina 123',3,now(),now(),'men_6.jpg');
insert into trabajadores values('CL8754965','Ivan ','Campos','1985-10-14',1,1,'Colina 123',3,now(),now(),'men_7.jpg');
insert into trabajadores values('PP87546985','Alicia ', 'Muñoz','1985-10-14',1,1,'Colina 123',1,now(),now(),'women_1.jpg');
insert into trabajadores values('GV87546855','Martha ', 'Saucedo','1985-10-14',1,1,'Colina 123',5,now(),now(),'women_2.jpg');
insert into trabajadores values('CA58754521','Angelica ', 'Gonzalez','1985-10-14',1,1,'Colina 123',4,now(),now(),'women_5.jpg');
insert into trabajadores values('MK58754213','Rolasia ', 'Rios','1985-10-14',1,1,'Colina 123',3,now(),now(),'women_8.jpg');
insert into trabajadores values('PL54874512','Fernanda ', 'Gutierrez','1985-10-14',1,1,'Colina 123',4,now(),now(),'women_9.jpg');
insert into trabajadores values('CL875418524','Fabiola ', 'Estrada','1985-10-14',1,1,'Colina 123',3,now(),now(),'women_1.jpg');
insert into trabajadores values('PP87546358','Maria ', 'Esquivel','1985-10-14',1,1,'Colina 123',4,now(),now(),'women_1.jpg');


insert into nub_trabajadores values(null,3,'CL55486325','malejandro',sha1('123456'),350000,'@gmail.com',987654321,now(),'2022-05-22');
insert into nub_trabajadores values(null,3,'CL8754632','gfrancisco',sha1('123456'),350000,'@gmail.com',987654321,now(),'2022-05-22');
insert into nub_trabajadores values(null,3,'CL8754965','civan',sha1('123456'),350000,'@gmail.com',987654321,now(),'2022-05-22');
insert into nub_trabajadores values(null,3,'PP87546985','malicia',sha1('123456'),350000,'@gmail.com',987654321,now(),'2022-05-22');
insert into nub_trabajadores values(null,3,'GV87546855','smartha',sha1('123456'),350000,'@gmail.com',987654321,now(),'2022-05-22');
insert into nub_trabajadores values(null,3,'CA58754521','gangelica',sha1('123456'),350000,'@gmail.com',987654321,now(),'2022-05-22');
insert into nub_trabajadores values(null,3,'MK58754213','rrosalia',sha1('123456'),350000,'@gmail.com',987654321,now(),'2022-05-22');
insert into nub_trabajadores values(null,3,'PL54874512','gfernanda',sha1('123456'),350000,'@gmail.com',987654321,now(),'2022-05-22');
insert into nub_trabajadores values(null,3,'CL875418524','efabiola',sha1('123456'),350000,'@gmail.com',987654321,now(),'2022-05-22');
insert into nub_trabajadores values(null,3,'PP87546358','emaria',sha1('123456'),350000,'@gmail.com',987654321,now(),'2022-05-22');


/*Insercion reservas Sucursal 2*/
insert into reservas values(null,3,1,1,'66.666.666-6',1,'2021-11-26','CL55486325');
insert into reservas values(null,3,1,2,'66.666.666-6',2,'2021-11-26','CL55486325');
insert into reservas values(null,3,1,3,'66.666.666-6',3,'2021-11-26','CL8754965');
insert into reservas values(null,3,1,4,'77.777.777-7',4,'2021-11-26','GV87546855');
insert into reservas values(null,3,1,5,'77.777.777-7',5,'2021-11-26','CA58754521');
insert into reservas values(null,3,1,6,'88.888.888-8',6,'2021-11-26','CA58754521');
insert into reservas values(null,3,1,7,'88.888.888-8',7,'2021-11-26','MK58754213');
insert into reservas values(null,3,1,8,'99.999.999-9',8,'2021-11-26','MK58754213');

insert into mensajes values(null,'25.484.361-K',1,'Hola Buenas tardes ¿Alguien me puede ayudar?',1,now(),curdate());
insert into mensajes values(null,'25.484.361-K',1,'Hola Buenas tardes ¿En que podemos ayudarle?',2,now(),curdate());



insert into telefonos values(null,1,'987654721');
insert into telefonos values(null,1,'722541254');
insert into telefonos values(null,2,'968563254');
insert into telefonos values(null,2,'722541253');
insert into telefonos values(null,3,'986532587');
insert into telefonos values(null,3,'722541252');
insert into telefonos values(null,4,'986585654');
insert into telefonos values(null,5,'722541251');




select * from mensajes;
select * from peluquerias;
select * from trabajadores;
select nub_trabajadores.id_tra,id_pel,nom_tra,ape_tra,fec_nac,nom_reg,nom_com,direccion,trabajadores.id_tip, nom_tip from nub_trabajadores, trabajadores,regiones,comunas, tipo_trabajador where nub_Trabajadores.id_tra=trabajadores.id_tra and trabajadores.id_reg=regiones.id_reg and trabajadores.id_tip=tipo_trabajador.id_tip and trabajadores.id_com=comunas.id_com and trabajadores.id_tip!=1;
select nub_trabajadores.id_tra,nom_tra,ape_tra,fec_nac,nom_usu,pas_usu,nom_reg,nom_com,direccion,nom_tip, ini_con, term_con,sue_tra,ult_vis, created from trabajadores,nub_trabajadores,tipo_trabajador,regiones,comunas where trabajadores.id_tip=tipo_trabajador.id_tip and trabajadores.id_tra=nub_trabajadores.id_tra and regiones.id_reg=trabajadores.id_reg and comunas.id_com=trabajadores.id_com ;
select nub_trabajadores.id_tra,foto,nom_tra,id_pel,ape_tra,fec_nac,nom_reg,nom_com,direccion,sue_tra,cor_tra,term_con,timestampdiff(year,fec_nac,curdate()) as edad,trabajadores.id_tip, nom_tip from nub_trabajadores, trabajadores,regiones,comunas, tipo_trabajador where nub_Trabajadores.id_tra=trabajadores.id_tra and trabajadores.id_reg=regiones.id_reg and trabajadores.id_tip=tipo_trabajador.id_tip and trabajadores.id_com=comunas.id_com and trabajadores.id_tip!=1 and nom_usu='PJuan' and pas_usu=sha1('123456');
select *  from reservas;
update usuarios set ult_vis=now() where id_usu='25484361-K';
select * from usuarios;
delete from trabajadores where id_tra='99.999.999-9';
delete from usuarios where id_usu='33.333.333-3';
select id_men,nom_usu,ape_usu,nom_com,text_men,count(*),hora_men,fecha_men from mensajes,usuarios,peluquerias,comunas where mensajes.id_usu=usuarios.id_usu and mensajes.id_pel=peluquerias.id_pel and peluquerias.id_com=comunas.id_com and mensajes.id_usu='25484361-k' and mensajes.id_pel=2;
select count(*) as Cantidad,nom_pel from peluquerias,reservas,comunas where reservas.id_pel=peluquerias.id_pel and peluquerias.id_com=comunas.id_com  group by peluquerias.nom_pel;
select count(id_res) as Cantidad, nom_com from reservas,peluquerias,comunas where reservas.id_pel=peluquerias.id_pel and peluquerias.id_com=comunas.id_com group by peluquerias.id_pel;
select nub_trabajadores.id_tra,nom_tra,nom_pel,ape_tra, TIMESTAMPDIFF(YEAR, fec_nac, CURDATE()) AS age ,nom_reg,nom_com,trabajadores.direccion,nom_tip,ini_con,term_con,trabajadores.ult_vis, sue_tra from peluquerias,trabajadores,nub_trabajadores,tipo_trabajador,regiones,comunas where peluquerias.id_pel=nub_trabajadores.id_pel and trabajadores.id_tip=tipo_trabajador.id_tip and trabajadores.id_tra=nub_trabajadores.id_tra and trabajadores.id_reg=regiones.id_reg and trabajadores.id_com=comunas.id_com;
select * from servicios;
select nom_est, count(nom_est) as cantidad from estado_reservas,reservas where estado_reservas.id_est=reservas.id_est and reservas.id_est=1;
select count(id_res) as Cantidad, nom_com from reservas,peluquerias,comunas where reservas.id_pel=peluquerias.id_pel and peluquerias.id_com=comunas.id_com and peluquerias.id_pel=2 group by peluquerias.id_pel;
select servicios.nom_ser, COUNT(reservas.id_res) AS 'cantidad' FROM reservas,servicios where reservas.id_ser = servicios.id_ser and id_pel=2  GROUP BY servicios.nom_ser ORDER BY 'cantidad' DESC;
select count(*) from mensajes where id_pel=2 and id_usu="25484361-k";
select * from nub_trabajadores;
update usuarios set reporte=0;
select id_men, datediff(fecha_men,curdate()) as times,id_pel,text_men as mensaje,id_est as estado,Date_format(hora_men,"%H:%i") as hora,fecha_men as fecha from mensajes;
select nub_trabajadores.id_tra,nom_tra,id_pel,ape_tra,fec_nac,nom_reg,nom_com,direccion,trabajadores.id_tip, nom_tip from nub_trabajadores, trabajadores,regiones,comunas, tipo_trabajador where nub_Trabajadores.id_tra=trabajadores.id_tra and trabajadores.id_reg=regiones.id_reg and trabajadores.id_tip=tipo_trabajador.id_tip and trabajadores.id_com=comunas.id_com ;
select distinct(nom_usu) ,ape_usu,mensajes.id_usu from mensajes,usuarios where usuarios.id_usu=mensajes.id_usu and id_pel=3;
select distinct Date_format(fec_res,'%d %M %Y') as fecha , count(*) as cantidad from reservas where id_pel=3 group by fec_res ;
#Select por mes
select distinct Date_format(fec_res,'%M %Y') as mes, count(*) as cantidad from reservas where Date_format(fec_res,'%M %Y')=Date_format(curdate(),'%M %Y') and id_est=5 and id_tra='' group by fec_res  ;
#Select por años
select distinct Date_format(fec_res,'%M') as mes, sum(precio) as cantidad from reservas,servicios where reservas.id_ser=servicios.id_ser group by Date_format(fec_res,'%M') ;
#Select atenciones por dias
select distinct fec_res as mes, count(*) as cantidad from reservas where fec_res=curdate() and id_est=5 group by fec_res ;
select distinct fec_res as fecha, count(*) as cantidad from reservas where fec_res=curdate() and id_est=5 and id_tra='55.555.555-5' group by fec_res ;
select * from usuarios;
update soportes set id_est=1;
select * from reservas;
delete from mensajes;
select count(*) from reservas where id_est=5;
select * from estado_reservas;
select * from trabajadores;
select id_men, datediff(curdate(),fecha_men) as times,id_pel,text_men,id_est,Date_format(hora_men,'%H:%i') as hora,fecha_men from mensajes where id_usu='25484361-k' and id_pel=2;
select nub_trabajadores.id_tra,foto ,nom_tra,id_pel,ape_tra,fec_nac,nom_reg,nom_com,direccion,sue_tra,cor_tra,term_con,timestampdiff(year,fec_nac,curdate()) as edad,trabajadores.id_tip, nom_tip from nub_trabajadores, trabajadores,regiones,comunas, tipo_trabajador where nub_Trabajadores.id_tra=trabajadores.id_tra and trabajadores.id_reg=regiones.id_reg and trabajadores.id_tip=tipo_trabajador.id_tip and trabajadores.id_com=comunas.id_com and trabajadores.id_tip=1 and nom_usu='PJuanito' and pas_usu=sha1('123456');
select distinct reservas.id_tra, nom_tra, ape_tra, nom_tip, count(id_res) as cantidad from reservas, trabajadores, tipo_trabajador where reservas.id_tra=trabajadores.id_tra and tipo_trabajador.id_tip=trabajadores.id_tip and id_pel=2 group by trabajadores.id_tra;