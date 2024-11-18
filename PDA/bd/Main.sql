create database Dietas;
use Dietas;

drop table users

create table users(
 id integer not null auto_increment,
 name varchar(30),
 last_name varchar(30),
 age integer(2),
 wight double,
 height double,
 email varchar(50),
 password varchar(100),
 primary key (id)
):

select * from users

insert into users (name,last_name,age,wight,height,email,password)
values ('Andres','Queso',30,62,1.72,'moralesquezo@gmail.com','12345678');