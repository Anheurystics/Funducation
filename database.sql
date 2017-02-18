drop database bh2017;
create database bh2017;
use bh2017;

create table donors (
    id int not null primary key auto_increment,
    name varchar(255),
    email varchar(255),
    password varchar(255)
);

create table principals (
    id int not nulL primary key auto_increment,
    name varchar(255),
    email varchar(255),
    password varchar(255),
    school_id int
);

create table schools (
    id int not null primary key auto_increment,
    name varchar(255),
    location varchar(255),
    principal_id int
);

create table teachers (
    id int not nulL primary key auto_increment,
    name varchar(255),
    email varchar(255),
    password varchar(255),
    school_id int,
    foreign key (school_id) references schools(id)
);

alter table schools add foreign key (principal_id) references principals(id);
alter table principals add foreign key (school_id) references schools(id);

create table projects (
    id int not null primary key auto_increment,
    name varchar(255),
    school_id int,
    description varchar(255),
    collectedAmount decimal default 0,
    goalAmount decimal,
    foreign key (school_id) references schools(id)
);

create table project_needs (
    id int not null primary key auto_increment,
    project_id int,
    need varchar(255),
    price decimal,
    foreign key (project_id) references projects(id)
);

create table project_donor (
    id int not null primary key auto_increment,
    project_id int,
    donor_id int,
    amount decimal,
    donated_date datetime not null default now(),
    foreign key (project_id) references projects(id),
    foreign key (donor_id) references donors(id)
);

create table school_teacher (
    id int not null primary key auto_increment,
    school_id int,
    teacher_id int,
    pending int,
    foreign key (school_id) references schools(id),
    foreign key (teacher_id) references teachers(id)
);