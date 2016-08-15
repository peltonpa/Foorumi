INSERT INTO Kayttaja (nimi, luomispaivamaara, password) VALUES ('Kartsa', NOW(), 'kartsa1');

INSERT INTO Kayttaja (nimi, luomispaivamaara, password) VALUES ('meetvurstimies', NOW(), 'metukka1');

INSERT INTO Alue (nimi) VALUES ('Hevoskeskustelua');

INSERT INTO Alue (nimi) VALUES ('juoppokeskustelua');

INSERT INTO Alue (nimi) VALUES ('peruskeskustelua');

INSERT INTO Viesti (kayttajaId, alueId, sisalto, otsikko, paivays) VALUES (1, 2, 'viina vie', 'olen känni', NOW());

INSERT INTO Viesti (kayttajaId, alueId, sisalto, otsikko, paivays) VALUES (2, 1, 'jep', 'mun hevosen nimi on meetvursti', NOW());

INSERT INTO Viesti (ketjuId, kayttajaId, alueId, sisalto, otsikko, paivays) VALUES (1, 2, 2, 'ei hitto', 'voi jitto', NOW());

INSERT INTO Viesti (kayttajaId, alueId, sisalto, otsikko, paivays) VALUES (1, 2, 'eiii', 'olen taas kännisä', NOW());