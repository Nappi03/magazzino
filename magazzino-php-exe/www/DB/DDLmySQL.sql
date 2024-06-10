create table utente
(

    idUtente int primary key auto_increment,
    nome     varchar(32)  not null,
    cognome  varchar(32)  not null,
    username varchar(32)  not null,
    email    varchar(32)  not null unique,
    password varchar(128) not null
);



create table fornitore
(
    idFornitore varchar(128) primary key,
    nominativo  varchar(32) not null
);

create table prodotto
(
    QRcode    varchar(128) primary key,
    nomeProd  varchar(32) not null,
    categoria varchar(32) not null,
    foto varchar(255)

);


create table carico
(

    idCarico      int primary key auto_increment,
    dataOraCarico datetime default current_timestamp,
    idUtente      int not null,
    idFornitore   varchar(128) not null,

    constraint FK_carico_utente
        foreign key (idUtente) references utente (idUtente)
            on update cascade,

    constraint FK_carico_fornitore
        foreign key (idFornitore) references fornitore (idFornitore)
            on update cascade
);
-- auto-generated definition
create table operatore
(
    idOperatore varchar(128) not null
        primary key,
    nominativo  varchar(32)  not null
);


-- auto-generated definition
create table scarico
(
    idScarico      int auto_increment
        primary key,
    dataOraScarico datetime default current_timestamp() null,
    idUtente       int                                  null,
    idOperatore    varchar(128)                         null,
    constraint FK_scarico_utente
        foreign key (idUtente) references utente (idUtente)
            on update cascade,
    constraint operatore
        foreign key (idOperatore) references operatore (idOperatore)
);



create table scarico_prodotti
(
    QRcode    varchar(128),
    idScarico int,
    qt        float not null,

    constraint pk_scarico_prodotti
        primary key (QRcode, idScarico),

    constraint fk_scarico_prodotti_prodotti
        foreign key (QRcode) references prodotto (QRcode) on update cascade on delete cascade,

    constraint fk_scarico_prodotti_scarico
        foreign key (idScarico) references scarico (idScarico) on update cascade on delete cascade


);

create table carico_prodotti
(
    QRcode    varchar(128),
    idCarico int,
    qt        float not null,

    constraint pk_scarico_prodotti
        primary key (QRcode, idCarico),

    constraint fk_carico_prodotti_prodotti
        foreign key (QRcode) references prodotto (QRcode) on update cascade on delete cascade,

    constraint fk_scarico_prodotti_carico
        foreign key (idCarico) references carico (idCarico) on update cascade on delete cascade
);
