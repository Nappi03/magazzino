CREATE TABLE utente
(
    idUtente INTEGER PRIMARY KEY AUTOINCREMENT,
    nome TEXT NOT NULL,
    cognome TEXT NOT NULL,
    username TEXT NOT NULL,
    email TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL
);

CREATE TABLE fornitore
(
    idFornitore TEXT PRIMARY KEY,
    nominativo TEXT NOT NULL
);

CREATE TABLE prodotto
(
    QRcode TEXT PRIMARY KEY,
    nomeProd TEXT NOT NULL,
    categoria TEXT NOT NULL,
    foto TEXT
);

CREATE TABLE carico
(
    idCarico INTEGER PRIMARY KEY AUTOINCREMENT,
    dataOraCarico DATETIME DEFAULT CURRENT_TIMESTAMP,
    idUtente INTEGER NOT NULL,
    idFornitore TEXT NOT NULL,
    FOREIGN KEY (idUtente) REFERENCES utente (idUtente) ON UPDATE CASCADE,
    FOREIGN KEY (idFornitore) REFERENCES fornitore (idFornitore) ON UPDATE CASCADE
);

CREATE TABLE operatore
(
    idOperatore TEXT PRIMARY KEY,
    nominativo TEXT NOT NULL
);

CREATE TABLE scarico
(
    idScarico INTEGER PRIMARY KEY AUTOINCREMENT,
    dataOraScarico DATETIME DEFAULT CURRENT_TIMESTAMP,
    idUtente INTEGER,
    idOperatore TEXT,
    FOREIGN KEY (idUtente) REFERENCES utente (idUtente) ON UPDATE CASCADE,
    FOREIGN KEY (idOperatore) REFERENCES operatore (idOperatore) ON UPDATE CASCADE
);

CREATE TABLE scarico_prodotti
(
    QRcode TEXT,
    idScarico INTEGER,
    qt REAL NOT NULL,
    PRIMARY KEY (QRcode, idScarico),
    FOREIGN KEY (QRcode) REFERENCES prodotto (QRcode) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (idScarico) REFERENCES scarico (idScarico) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE carico_prodotti
(
    QRcode TEXT,
    idCarico INTEGER,
    qt REAL NOT NULL,
    PRIMARY KEY (QRcode, idCarico),
    FOREIGN KEY (QRcode) REFERENCES prodotto (QRcode) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (idCarico) REFERENCES carico (idCarico) ON UPDATE CASCADE ON DELETE CASCADE
);
