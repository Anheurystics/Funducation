drop database bh2017;
create database bh2017;
use bh2017;

create table users (
    id int not null primary key auto_increment,
    name varchar(255),
    email varchar(255),
    password varchar(255),
    role_id int
);

create table schools (
    id int not null primary key auto_increment,
    name varchar(255),
    location varchar(255),
    user_id int,
    foreign key (user_id) references users(id)
);

create table projects (
    id int not null primary key auto_increment,
    name varchar(255),
    school_id int,
    collectedAmount decimal,
    foreign key (school_id) references schools(id)
);

create table project_teacher (
    id int not null primary key auto_increment,
    project_id int,
    teacher_id int,
    foreign key (project_id) references projects(id),
    foreign key (teacher_id) references users(id)
);

create table project_donor (
    id int not null primary key auto_increment,
    project_id int,
    donor_id int,
    foreign key (project_id) references projects(id),
    foreign key (donor_id) references users(id)
);

create table school_teacher (
    id int not null primary key auto_increment,
    school_id int,
    teacher_id int,
    foreign key (school_id) references schools(id),
    foreign key (teacher_id) references users(id)
);