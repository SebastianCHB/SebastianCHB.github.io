create database Routify;
use Routify;
drop database Routify

drop table users;
create table users(
 id_user integer not null auto_increment,
 nombre varchar(30),
 rol TINYINT,
 email varchar(100),
 password varchar(100),
 primary key (id_user)
);

create table reservations(
id_reserva integer not null auto_increment,
fecha_ida date,
fecha_regreso date,
id_user int,
id_paquete int,
primary key (id_reserva))

create table paquete_viaje(
id_paquete integer not null auto_increment,
nombre_paquete varchar(30),
descripcion varchar(50),
precio decimal(10),
duracion varchar(20),
imagen varchar (35),
primary key (id_paquete))

create table pago(
id_pago int not null auto_increment,
tipo varchar(30),
detalles varchar(20),
fecha_registro date,
id_paquete int,
primary key(id_pago))

create table categorias(
id_categoria int not null auto_increment,
nombre_categoria varchar(40),
descripcion varchar (30),
primary key (id_categoria))

insert into users (nombre, rol, email, password)
values ('Sebastian',1,'sebastianadmin@gmail.com','12345678'),
('Andres',2,'andresillo@gmail.com','87654321'),
('Pepe',2,'Pepepro@gmail.com','pepe123')

drop table reservations
INSERT INTO reservations (fecha_ida, fecha_regreso, id_user, id_paquete) 
VALUES ('2024-12-15', '2024-12-20',1, 1),
('2024-12-22', '2024-12-30', 2, 2)

select * from paquete_viaje
drop table paquete_viaje 
INSERT INTO paquete_viaje (nombre_paquete, descripcion, precio, duracion, imagen) 
VALUES ('Paquete Caribe', 'Viaje al Caribe todo incluido', 1200.50, '5 días', 'caribe.jpg'),
('Paquete Europa', 'Tour por Europa', 2500.75, '10 días', 'europa.jpg');

drop table pago 
INSERT INTO pago (tipo, detalles, fecha_registro, id_paquete) 
VALUES ('Tarjeta de crédito', 'Pago por VISA', '2024-12-01',1),
('Transferencia bancaria', 'Pago por Banco XYZ', '2024-12-02',2)

/*RESERVAS FORANEAS*/
alter table reservations add constraint id_userr foreign key (id_user) references users(id_user)
alter table reservations add constraint id_paquetee foreign key (id_paquete) references paquete_viaje(id_paquete)
alter table pago add constraint id_paqueteon foreign key (id_paquete) references paquete_viaje(id_paquete)


ALTER TABLE reservations DROP FOREIGN KEY id_userr;

ALTER TABLE reservations
ADD CONSTRAINT id_userr FOREIGN KEY (id_user) REFERENCES users(id_user) ON DELETE CASCADE;
ALTER TABLE reservations
MODIFY COLUMN id_user INT NULL;



/*FUNCION*/
CREATE FUNCTION calcular_ingresos_paquete(id_paquete INT)
RETURNS DECIMAL(10, 2)
DETERMINISTIC
BEGIN
    DECLARE total_ingresos DECIMAL(10, 2);
    SELECT SUM(precio)
    INTO total_ingresos
    FROM paquete_viaje pv
    JOIN reservations r ON pv.id_paquete = r.id_paquete
    WHERE pv.id_paquete = id_paquete;
    RETURN IFNULL(total_ingresos, 0);
END;

SELECT calcular_ingresos_paquete(2) AS total_ingresos;
/*END FUNCTION*/

/*PROCEDIMIENTO PARA INSERTAR*/
CREATE PROCEDURE registrar_paquete_simple(
    IN p_nombre_paquete VARCHAR(30),
    IN p_descripcion VARCHAR(50),
    IN p_precio DECIMAL(10, 2),
    IN p_duracion VARCHAR(20),
    IN p_imagen VARCHAR(35)
)
BEGIN
    INSERT INTO paquete_viaje (nombre_paquete, descripcion, precio, duracion, imagen)
    VALUES (p_nombre_paquete, p_descripcion, p_precio, p_duracion, p_imagen);
END;

CALL registrar_paquete_simple(
    'Paquete Andino',
    'Explora los Andes y sus maravillas',
    1800.00,
    '7 días',
    'andes.jpg'
);



select * from paquete_viaje
/*END PROCEDIMIENTO PARA INSERTAR*/

/*DISPARADORRRRRRRRRR*/
CREATE TABLE paquete_viaje_historial (
    id_historial INT NOT NULL AUTO_INCREMENT,
    id_paquete INT,
    nombre_paquete VARCHAR(30),
    descripcion VARCHAR(50),
    precio DECIMAL(10, 2),
    duracion VARCHAR(20),
    imagen VARCHAR(35),
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_historial)
);

CREATE TRIGGER after_paquete_insert
AFTER INSERT ON paquete_viaje
FOR EACH ROW
BEGIN
    INSERT INTO paquete_viaje_historial (
        id_paquete,
        nombre_paquete,
        descripcion,
        precio,
        duracion,
        imagen
    )
    VALUES (
        NEW.id_paquete,
        NEW.nombre_paquete,
        NEW.descripcion,
        NEW.precio,
        NEW.duracion,
        NEW.imagen
    );
END;

INSERT INTO paquete_viaje (nombre_paquete, descripcion, precio, duracion, imagen)
VALUES ('Paquete Selva', 'Aventura en la selva tropical', 1500.00, '5 días', 'selva.jpg');

SELECT * FROM paquete_viaje_historial;
/* END DISPARADORRRRRRRRRR*/

/*INNER JOIN DEL REGISTRO*/
SELECT 
    reservations.id_reserva,
    reservations.fecha_ida,
    reservations.fecha_regreso,
    reservations.id_user,
    reservations.id_paquete
FROM 
    reservations
INNER JOIN 
    users ON reservations.id_user = users.id_user
INNER JOIN 
    paquete_viaje ON reservations.id_paquete = paquete_viaje.id_paquete;
/*END INNER JOIN DEL REGISTRO*/