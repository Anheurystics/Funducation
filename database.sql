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
    collectedAmount decimal,
    goalAmount decimal,
    foreign key (school_id) references schools(id)
);

create table project_teacher (
    id int not null primary key auto_increment,
    project_id int,
    teacher_id int,
    foreign key (project_id) references projects(id),
    foreign key (teacher_id) references teachers(id)
);

create table project_donor (
    id int not null primary key auto_increment,
    project_id int,
    donor_id int,
    foreign key (project_id) references projects(id),
    foreign key (donor_id) references donors(id)
);

create table school_teacher (
    id int not null primary key auto_increment,
    school_id int,
    teacher_id int,
    foreign key (school_id) references schools(id),
    foreign key (teacher_id) references teachers(id)
);

insert into schools (name, location) values ("ABC school", "here"), ("XYZ Elementary", "there");
insert into projects (name, school_id, description, collectedAmount, goalAmount) values ("ABC project 1", 1, "This is ABC's project 1.", 10000, 100000), ("ABC project 2", 1, "This is ABC's project 2.", 2000, 50000), ("XYZ project 1", 2, "This is XYZ's project 1.", 4000, 100000);