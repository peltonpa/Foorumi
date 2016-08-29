INSERT INTO Kayttaja (nimi, luomispaivamaara, password) VALUES ('Kartsa', NOW(), 'kartsa1');

INSERT INTO Kayttaja (nimi, luomispaivamaara, password) VALUES ('meetvurstimies', NOW(), 'metukka1');

INSERT INTO Alue (nimi) VALUES ('juoppokeskustelua');

INSERT INTO Alue (nimi) VALUES ('peruskeskustelua');

INSERT INTO Ketju (alueId, otsikko) VALUES (1, 'olen kännisä taas');

INSERT INTO Ketju (alueId, otsikko) VALUES (1, 'viina vie miestä');

INSERT INTO Ketju (alueId, otsikko) VALUES (2, 'mun hepan nimi on meetvursti');

INSERT INTO Viesti (ketjuId, kayttajaId, sisalto) VALUES (1, 1, 'viina vie');

INSERT INTO Viesti (ketjuId, kayttajaId, sisalto) VALUES (2, 2, 'jep');

INSERT INTO Viesti (ketjuId, kayttajaId, sisalto) VALUES (3, 2, 'ei hitto');

INSERT INTO Viesti (ketjuId, kayttajaId, sisalto) VALUES (1, 1, 'eiii');