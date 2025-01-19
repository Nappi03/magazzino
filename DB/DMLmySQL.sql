-- Inserimento degli utenti
insert into utente values (1, 'Admin', 'Admin', 'Admin', 'admin@admin.it', 'admin123');
insert into utente values (2, 'Utente1', 'Cognome1', 'utente1', 'utente1@email.it', 'utente123');

-- Inserimento dei fornitori
insert into fornitore values ('QR11111', 'FornitoreElettronicaSRL');
insert into fornitore values ('QR22222', 'FornitoreModaSRL');
insert into fornitore values ('QR33333', 'FornitoreCasaSRL');
insert into fornitore values ('QR44444', 'FornitoreSportSRL');
insert into fornitore values ('QR55555', 'FornitoreGioielliSRL');
insert into fornitore values ('QR66666', 'FornitoreCucinaSRL');

-- Inserimento dei prodotti
insert into prodotto values ('QR12345', 'Cemento', 'Informatica e Accessori', 'img/QR12345.png');
insert into prodotto values ('QR67890', 'Cono', 'Fotografia e Videocamere', 'img/QR67890.png');
insert into prodotto values ('QR24680', 'Martello', 'Elettronica e Audio', 'img/QR24680.png');
insert into prodotto values ('QR13579', 'Guanti', 'Moda e Accessori', 'img/QR13579.png');
insert into prodotto values ('QR98765', 'Nastro segnaletico', 'Telefonia e Cellulari', 'img/QR98765.png');
insert into prodotto values ('QR54321', 'Gruppo elettrogeno', 'Elettrodomestici', 'img/QR54321.png');
insert into prodotto values ('QR11111', 'Casco', 'Informatica e Accessori' , 'img/QR11111.png');
insert into prodotto values ('QR22222', 'Lana Roccia', 'Scarpe e Calzature', 'img/QR22222.png');
insert into prodotto values ('QR33333', 'Scarpe antinfortunistiche', 'Orologi e Gioielli', 'img/QR33333.png');
insert into prodotto values ('QR44444', 'Tubo Innocente', 'Cucina e Caffè', 'img/QR44444.png');
insert into prodotto values ('QR55555', 'Pennello', 'Elettrodomestici', 'img/QR55555.png');
insert into prodotto values ('QR66666', 'Trapano', 'Abbigliamento e Moda', 'img/QR66666.png');

-- Inserimento dei carichi
insert into carico values(1, '2023-11-10 09:30:15', 1, 'QR11111');
insert into carico values(2, '2023-11-12 14:45:55', 2, 'QR22222');
insert into carico values(3, '2023-11-14 17:20:30', 1, 'QR33333');
insert into carico values(4, '2023-11-20 08:30:10', 1, 'QR44444');
insert into carico values(5, '2023-11-25 12:15:25', 2, 'QR55555');
insert into carico values(6, '2023-11-28 14:20:50', 2, 'QR66666');
insert into carico values(7, '2023-11-10 09:30:15', 1, 'QR11111');
insert into carico values(8, '2023-11-12 14:45:55', 2, 'QR22222');
insert into carico values(9, '2023-11-14 17:20:30', 1, 'QR33333');
insert into carico values(10, '2023-11-20 08:30:10', 1, 'QR44444');

-- Inserimento degli scarichi
insert into scarico values(1, '2023-12-05 09:30:15', 1);
insert into scarico values(2, '2023-12-10 14:45:55', 2);
insert into scarico values(3, '2023-12-15 17:20:30', 1);
insert into scarico values(4, '2023-12-20 18:30:45', 2);
insert into scarico values(5, '2023-12-25 20:15:55', 1);
insert into scarico values(6, '2023-12-30 21:40:30', 1);
insert into scarico values(7, '2024-01-05 08:15:45', 2);
insert into scarico values(8, '2024-01-10 10:20:55', 1);
insert into scarico values(9, '2024-01-15 11:35:30', 2);
insert into scarico values(10, '2024-01-20 14:50:15', 1);

-- Inserimento dei prodotti nei carichi di scarico
insert into scarico_prodotti values ('QR12345', 1, 15);
insert into scarico_prodotti values ('QR67890', 2, 13);
insert into scarico_prodotti values ('QR24680', 3, 12);
insert into scarico_prodotti values ('QR13579', 4, 14);
insert into scarico_prodotti values ('QR98765', 5, 16);
insert into scarico_prodotti values ('QR54321', 6, 12);
insert into scarico_prodotti values ('QR11111', 7, 15);
insert into scarico_prodotti values ('QR22222', 8, 13);
insert into scarico_prodotti values ('QR33333', 9, 12);
insert into scarico_prodotti values ('QR44444', 10, 14);

-- Inserimento dei prodotti nei carichi
insert into carico_prodotti values ('QR12345', 1, 35);
insert into carico_prodotti values ('QR67890', 2, 23);
insert into carico_prodotti values ('QR24680', 3, 42);
insert into carico_prodotti values ('QR13579', 4, 24);
insert into carico_prodotti values ('QR98765', 5, 36);
insert into carico_prodotti values ('QR54321', 6, 52);
insert into carico_prodotti values ('QR11111', 7, 35);
insert into carico_prodotti values ('QR22222', 8, 23);
insert into carico_prodotti values ('QR33333', 9, 22);
insert into carico_prodotti values ('QR44444', 10, 24);
