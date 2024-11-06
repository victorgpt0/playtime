create database if not exists railway;

use railway;

create table if not exists tbl_gender(
genderId tinyint(1) not null primary key auto_increment,
gender varchar(10) not null
);

create table if not exists tbl_role(
roleId tinyint(1) not null primary key auto_increment,
roles varchar(10) not null
);

create table if not exists tbl_users(
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

INSERT INTO `tbl_gender` (`genderId`, `gender`) VALUES
(1, 'Male'),
(2, 'Female');

INSERT INTO `tbl_role` (`roleId`, `roles`) VALUES
(1, 'Admin'),
(2, 'Owner'),
(3, 'Staff'),
(4, 'Captain');

CREATE TABLE if not exists `tbl_status` (
  `statusId` tinyint(1) NOT NULL primary  key,
  `status` varchar(20) NOT NULL
);


INSERT INTO `tbl_status` (`statusId`, `status`) VALUES
(1, 'Available'),
(2, 'Unavailable'),
(3, 'Pending'),
(4, 'Confirmed'),
(5, 'Cancelled');


CREATE TABLE if not exists `tbl_facilities` (
  `facilityId` bigint(10) NOT NULL primary key auto_increment,
  `name` varchar(255) NOT NULL,
  `latitude` decimal(10,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL,
  `place_id` varchar(255) NOT NULL,
  `price_per_hour` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `userid` bigint(10) NOT NULL,
  `statusId` tinyint(1) NOT NULL,
  foreign key (userid) references tbl_users(userid) on delete no action on update no action,
  foreign key (statusId) references tbl_status(statusId) on delete no action on update no action
);

CREATE TABLE if not exists `tbl_bookings` (
  `booking_id` bigint(10) NOT NULL primary key auto_increment,
  `facilityId` bigint(10) NOT NULL,
  `userid` bigint(10) NOT NULL,
  `booked_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `totalprice` decimal(10,2) NOT NULL,
  `statusId` tinyint(1) NOT NULL,
  foreign key (facilityId) references tbl_facilities(facilityId) on delete no action on update no action,
  foreign key (userid) references tbl_users(userid) on delete no action on update no action,
  foreign key (statusId) references tbl_status(statusId) on delete no action on update no action
);

