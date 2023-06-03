create database php1_login;
use php1_login;

create table userlist (
	id int not null auto_increment primary key,
	name varchar(30) not null unique,
	password varchar(150) not null
	);

grant all on php1_login.userlist to 'php1'@'%';
	
