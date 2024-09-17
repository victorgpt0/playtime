create database if not exists railway;

use railway;

create table tbl_gender(
genderId tinyint(1) not null primary key auto_increment,
gender varchar(10) not null
);

create table tbl_role(
roleId tinyint(1) not null primary key auto_increment,
roles varchar(10) not null
);

create table tbl_users(
userid bigint(10) not null primary key auto_increment,
fullname varchar(50),
email varchar(50) not null unique,
username varchar(20)  not null unique,
password varchar(100) not null,
created datetime not null default current_timestamp,
updated datetime not null default current_timestamp,
roleId tinyint(1) not null,
genderId tinyint(1) not null,
foreign key (genderId) references tbl_gender(genderId) on delete no action on update no action,
foreign key(roleId) references tbl_role(roleId) on delete no action on update no action
);



