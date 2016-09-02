INSERT INTO Kayttaja (nimi, luomispaivamaara, password) VALUES ('Kartsa', NOW(), 'kartsa1');

INSERT INTO Kayttaja (nimi, luomispaivamaara, password) VALUES ('meetvurstimies', NOW(), 'metukka1');

INSERT INTO Kayttaja (nimi, luomispaivamaara, password) VALUES ('fränkki', NOW(), 'frank');

INSERT INTO Alue (nimi) VALUES ('Sivistynyt keskustelu');

INSERT INTO Alue (nimi) VALUES ('Huumorijutut ja vitsit');

INSERT INTO Alue (nimi) VALUES ('Vapaa sana');

INSERT INTO Ketju (alueId, otsikko, perustaja) VALUES (1, 'Testaillaans', 1);

INSERT INTO Ketju (alueId, otsikko, perustaja) VALUES (1, 'Olen diletantti', 1);

INSERT INTO Ketju (alueId, otsikko, perustaja) VALUES (2, 'Voihan vitsi', 3);

INSERT INTO Ketju (alueId, otsikko, perustaja) VALUES (3, 'Painavaa sanottavaa', 2);

INSERT INTO Viesti (ketjuId, kayttajaId, sisalto) VALUES (1, 1, 'Joo kokeillaans');

INSERT INTO Viesti (ketjuId, kayttajaId, sisalto) VALUES (2, 1, 'Tiedoksi kaikille että olen erittäin sivistynyt diletantti-ihminen');

INSERT INTO Viesti (ketjuId, kayttajaId, sisalto) VALUES (2, 2, 'Biletantti');

INSERT INTO Viesti (ketjuId, kayttajaId, sisalto) VALUES (3, 3, 'Jepulis kebulis');

INSERT INTO Viesti (ketjuId, kayttajaId, sisalto) VALUES (4, 2, 'Kartsa lähetkö pelaamaan bilistä kylille?');

INSERT INTO Viesti (ketjuId, kayttajaId, sisalto) VALUES (4, 1, 'Ei pysty kun tulee emmerdale telkkarista');

INSERT INTO Tagi (tagi) VALUES ('Pokemon');

INSERT INTO Tagi (tagi) VALUES ('Järkipostaus');

INSERT INTO Tagi (tagi) VALUES ('Politiikka');

INSERT INTO Tagiliitos (ketjuId, tagiId) VALUES (1, 1);

INSERT INTO Tagiliitos (ketjuId, tagiId) VALUES (1, 3);