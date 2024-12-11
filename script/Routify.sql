create database Routify;
use Routify;
drop database Routify

-- Tabla de Usuarios
CREATE TABLE users (
    id_user INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(30),
    rol TINYINT,
    email VARCHAR(100),
    password VARCHAR(100),
    PRIMARY KEY (id_user)
);

-- Tabla de Paquetes de Viaje
CREATE TABLE paquete_viaje (
    id_paquete INT NOT NULL AUTO_INCREMENT,
    nombre_paquete VARCHAR(30),
    descripcion VARCHAR(50),
    precio DECIMAL(10, 2),
    duracion VARCHAR(20),
    imagen VARCHAR(35),
    PRIMARY KEY (id_paquete)
);

-- Tabla de Reservas
CREATE TABLE reservations (
    id_reserva INT NOT NULL AUTO_INCREMENT,
    fecha_ida DATE,
    fecha_regreso DATE,
    id_user INT,
    id_paquete INT,
    PRIMARY KEY (id_reserva),
    FOREIGN KEY (id_user) REFERENCES users(id_user)
        ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_paquete) REFERENCES paquete_viaje(id_paquete)
        ON DELETE SET NULL ON UPDATE CASCADE
);

-- Tabla de Pagos
CREATE TABLE pago (
    id_pago INT NOT NULL AUTO_INCREMENT,
    tipo VARCHAR(30),
    detalles VARCHAR(20),
    fecha_registro DATE,
    id_paquete INT,
    PRIMARY KEY (id_pago),
    FOREIGN KEY (id_paquete) REFERENCES paquete_viaje(id_paquete)
        ON DELETE CASCADE ON UPDATE CASCADE
);


create table categorias(
id_categoria int not null auto_increment,
nombre_categoria varchar(40),
descripcion varchar (30),
primary key (id_categoria))

insert into users (nombre, rol, email, password)
values ('Sebastian',1,'sebastianadmin@gmail.com','12345678'),
('Andres',2,'andresillo@gmail.com','87654321'),
('Pepe',2,'Pepepro@gmail.com','pepe123')

INSERT INTO paquete_viaje (nombre_paquete, descripcion, precio, duracion, imagen) 
VALUES ('Paquete Caribe', 'Viaje al Caribe todo incluido', 1200.50, '5 días', 'caribe.jpg'),
('Paquete Europa', 'Tour por Europa', 2500.75, '10 días', 'europa.jpg');

INSERT INTO reservations (fecha_ida, fecha_regreso, id_user, id_paquete) 
VALUES ('2024-12-15', '2024-12-20',1, 1),
('2024-12-22', '2024-12-30', 2, 2)

INSERT INTO pago (tipo, detalles, fecha_registro, id_paquete) 
VALUES ('Tarjeta de crédito', 'Pago por VISA', '2024-12-01',1),
('Transferencia bancaria', 'Pago por Banco XYZ', '2024-12-02',2)


/*REVISION A PARTE - NO EJECUTAR*/

/*RESERVAS FORANEAS*/
alter table reservations add constraint id_paquetee foreign key (id_paquete) references paquete_viaje(id_paquete)
alter table pago add constraint id_paqueteon foreign key (id_paquete) references paquete_viaje(id_paquete)

ALTER TABLE reservations
ADD CONSTRAINT id_userr FOREIGN KEY (id_user) REFERENCES users(id_user) ON DELETE CASCADE;
ALTER TABLE reservations
MODIFY COLUMN id_user INT NULL;

/*REVISION A PARTE - NO EJECUTAR*/


/*EVALUACION BASES DE DATOS */
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
 

   /*PRUEBAS*/
   DELETE FROM pago WHERE id_paquete = 2; 
   select * from users