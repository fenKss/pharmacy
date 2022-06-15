use pharmacy
go

create table disease
(
    id                 int identity
        constraint disease_pk
            primary key,
    name               varchar(max) not null,
    population_type_id int          not null,
    code_mkb10         varchar(255),
    testimony          varchar(max)
)
go

create table disease_has_drug
(
    disease_id int not null,
    drug_id    int not null
)
go

create table disease_type
(
    id   int identity
        constraint disease_type_pk
            primary key,
    name varchar(max) not null
)
go

create table drug
(
    id       int identity
        constraint drug_pk
            primary key,
    name     varchar(max) not null,
    code_ATX varchar(255) not null
)
go

create table population_type
(
    id   int identity
        constraint population_type_pk
            primary key,
    name varchar(max) not null
)
go

