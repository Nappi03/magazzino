create table if not exists utente
(
    idUtente integer primary key autoincrement,
    nome     varchar(32)  not null,
    cognome  varchar(32)  not null,
    username varchar(32)  not null,
    email    varchar(32)  not null unique,
    password varchar(128) not null
);

create table if not exists fornitore
(
    idFornitore varchar(128) primary key,
    nominativo  varchar(32) not null
);

create table if not exists prodotto
(
    QRcode    varchar(128) primary key,
    nomeProd  varchar(32) not null,
    categoria varchar(32) not null,
    foto      varchar(255)
);

create table if not exists carico
(
    idCarico      integer primary key autoincrement,
    dataOraCarico datetime default current_timestamp,
    idUtente      integer      not null,
    idFornitore   varchar(128) not null,
    foreign key (idUtente) references utente (idUtente) on update cascade,
    foreign key (idFornitore) references fornitore (idFornitore) on update cascade
);

create table if not exists operatore
(
    idOperatore varchar(128) primary key,
    nominativo  varchar(32) not null
);

create table if not exists scarico
(
    idScarico      integer primary key autoincrement,
    dataOraScarico datetime default current_timestamp,
    idUtente       integer,
    idOperatore    varchar(128),
    foreign key (idUtente) references utente (idUtente) on update cascade,
    foreign key (idOperatore) references operatore (idOperatore) on update cascade
);

create table if not exists scarico_prodotti
(
    QRcode    varchar(128),
    idScarico integer,
    qt        float not null,
    primary key (QRcode, idScarico),
    foreign key (QRcode) references prodotto (QRcode) on update cascade on delete cascade,
    foreign key (idScarico) references scarico (idScarico) on update cascade on delete cascade
);

create table if not exists carico_prodotti
(
    QRcode   varchar(128),
    idCarico integer,
    qt       float not null,
    primary key (QRcode, idCarico),
    foreign key (QRcode) references prodotto (QRcode) on update cascade on delete cascade,
    foreign key (idCarico) references carico (idCarico) on update cascade on delete cascade
);

create table if not exists registro
(
    qrcode        varchar(128) primary key,
    data_registro timestamp   not null,
    tipo_registro varchar(64) not null,
    id_utente     integer     not null,
    foreign key (id_utente) references utente (idUtente)
);

create table if not exists accessi
(
    id      integer primary key autoincrement,
    stringa varchar(200)
);
