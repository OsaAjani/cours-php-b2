create database test;
use test;

create table adress (id int not null auto_increment, city varchar(200) not null, primary key (id));

create table subscription (id int not null auto_increment, price float(6,2) not null, primary key (id));

create table user (id int not null auto_increment, name varchar(200) not null, adress_id int not null, subscription_id int not null, primary key (id), foreign key (adress_id) references adress (id) on delete cascade on update cascade, foreign key (subscription_id) references subscription (id) on delete cascade on update cascade);

insert into subscription (price) values (29.99);
insert into subscription (price) values (99.99);

insert into adress (city) values ('Bordeaux');
insert into adress (city) values ('Paris');

insert into user (name, adress_id, subscription_id) values ('Bernard', 1, 1);
insert into user (name, adress_id, subscription_id) values ('Monique', 2, 1);
insert into user (name, adress_id, subscription_id) values ('Josianne', 2, 2);