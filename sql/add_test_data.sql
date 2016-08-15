INSERT INTO Kayttaja (nimi, luomispaivamaara, password) VALUES ('Kartsa', NOW(), 'kartsa1');

INSERT INTO Kayttaja (nimi, luomispaivamaara, password) VALUES ('meetvurstimies', NOW(), 'metukka1');

INSERT INTO Alue (nimi) VALUES ('juoppokeskustelua');

INSERT INTO Alue (nimi) VALUES ('peruskeskustelua');

INSERT INTO Ketju (alueId, otsikko) VALUES (1, 'olen kännisä taas');

INSERT INTO Ketju (alueId, otsikko) VALUES (1, 'viina vie miestä');

INSERT INTO Ketju (alueId, otsikko) VALUES (2, 'mun hepan nimi on meetvursti');

INSERT INTO Viesti (ketjuId, kayttajaId, sisalto, paivays) VALUES (1, 1, 'viina vie', NOW());

INSERT INTO Viesti (ketjuId, kayttajaId, sisalto, paivays) VALUES (2, 2, 'jep', NOW());

INSERT INTO Viesti (ketjuId, kayttajaId, sisalto, paivays) VALUES (1, 2, 'ei hitto', NOW());

INSERT INTO Viesti (ketjuId, kayttajaId, sisalto, paivays) VALUES (1, 1, 'eiii', NOW());