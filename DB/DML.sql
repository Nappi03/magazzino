-- Inserimento degli utenti
INSERT INTO utente (idUtente, nome, cognome, username, email, password) VALUES 
(1, 'Admin', 'Admin', 'Admin', 'admin@admin.it', 'admin123'),
(2, 'Utente1', 'Cognome1', 'utente1', 'utente1@email.it', 'utente123');

-- Inserimento dei fornitori
INSERT INTO fornitore (idFornitore, nominativo) VALUES 
('QR11111', 'FornitoreElettronicaSRL'),
('QR22222', 'FornitoreModaSRL'),
('QR33333', 'FornitoreCasaSRL'),
('QR44444', 'FornitoreSportSRL'),
('QR55555', 'FornitoreGioielliSRL'),
('QR66666', 'FornitoreCucinaSRL');

-- Inserimento dei prodotti
INSERT INTO prodotto (QRcode, nomeProd, categoria, foto) VALUES 
('QR12345', 'Cemento', 'Informatica e Accessori', 'img/QR12345.png'),
('QR67890', 'Cono', 'Fotografia e Videocamere', 'img/QR67890.png'),
('QR24680', 'Martello', 'Elettronica e Audio', 'img/QR24680.png'),
('QR13579', 'Guanti', 'Moda e Accessori', 'img/QR13579.png'),
('QR98765', 'Nastro segnaletico', 'Telefonia e Cellulari', 'img/QR98765.png'),
('QR54321', 'Gruppo elettrogeno', 'Elettrodomestici', 'img/QR54321.png'),
('QR11111', 'Casco', 'Informatica e Accessori' , 'img/QR11111.png'),
('QR22222', 'Lana Roccia', 'Scarpe e Calzature', 'img/QR22222.png'),
('QR33333', 'Scarpe antinfortunistiche', 'Orologi e Gioielli', 'img/QR33333.png'),
('QR44444', 'Tubo Innocente', 'Cucina e Caffè', 'img/QR44444.png'),
('QR55555', 'Pennello', 'Elettrodomestici', 'img/QR55555.png'),
('QR66666', 'Trapano', 'Abbigliamento e Moda', 'img/QR66666.png');

-- Inserimento dei carichi
INSERT INTO carico (idCarico, dataOraCarico, idUtente, idFornitore) VALUES 
(1, '2023-11-10 09:30:15', 1, 'QR11111'),
(2, '2023-11-12 14:45:55', 2, 'QR22222'),
(3, '2023-11-14 17:20:30', 1, 'QR33333'),
(4, '2023-11-20 08:30:10', 1, 'QR44444'),
(5, '2023-11-25 12:15:25', 2, 'QR55555'),
(6, '2023-11-28 14:20:50', 2, 'QR66666'),
(7, '2023-11-10 09:30:15', 1, 'QR11111'),
(8, '2023-11-12 14:45:55', 2, 'QR22222'),
(9, '2023-11-14 17:20:30', 1, 'QR33333'),
(10, '2023-11-20 08:30:10', 1, 'QR44444');

-- Inserimento degli scarichi
INSERT INTO scarico (idScarico, dataOraScarico, idUtente) VALUES 
(1, '2023-12-05 09:30:15', 1),
(2, '2023-12-10 14:45:55', 2),
(3, '2023-12-15 17:20:30', 1),
(4, '2023-12-20 18:30:45', 2),
(5, '2023-12-25 20:15:55', 1),
(6, '2023-12-30 21:40:30', 1),
(7, '2024-01-05 08:15:45', 2),
(8, '2024-01-10 10:20:55', 1),
(9, '2024-01-15 11:35:30', 2),
(10, '2024-01-20 14:50:15', 1);

-- Inserimento dei prodotti nei carichi di scarico
INSERT INTO scarico_prodotti (QRcode, idScarico, qt) VALUES 
('QR12345', 1, 15),
('QR67890', 2, 13),
('QR24680', 3, 12),
('QR13579', 4, 14),
('QR98765', 5, 16),
('QR54321', 6, 12),
('QR11111', 7, 15),
('QR22222', 8, 13),
('QR33333', 9, 12),
('QR44444', 10, 14);

-- Inserimento dei prodotti nei carichi
INSERT INTO carico_prodotti (QRcode, idCarico, qt) VALUES 
('QR12345', 1, 35),
('QR67890', 2, 23),
('QR24680', 3, 42),
('QR13579', 4, 24),
('QR98765', 5, 36),
('QR54321', 6, 52),
('QR11111', 7, 35),
('QR22222', 8, 23),
('QR33333', 9, 22),
('QR44444', 10, 24);
