CREATE TABLE Kayttaja(
	id SERIAL PRIMARY KEY,
	nimi varchar(50) NOT NULL,
	luomispaivamaara DATE NOT NULL,
	password varchar(50) NOT NULL
);

CREATE TABLE Alue(
	id SERIAL PRIMARY KEY,
	nimi varchar(40) NOT NULL
);

CREATE TABLE Ketju(
        id SERIAL PRIMARY KEY,
        alueId INTEGER REFERENCES Alue(id) NOT NULL,
        otsikko varchar(40),
        viimeinenViestiPaivays TIMESTAMP DEFAULT now(),
        perustaja INTEGER REFERENCES Kayttaja(id)
);

CREATE TABLE Viesti(
	id SERIAL PRIMARY KEY,
        ketjuId INTEGER REFERENCES Ketju(id),
	kayttajaId INTEGER REFERENCES Kayttaja(id),
	sisalto varchar(300) NOT NULL,
	paivays CURRENT_TIMESTAMP
);


CREATE TABLE Tagiliitos(
	ketjuId INTEGER REFERENCES Ketju(id),
	tagiId INTEGER REFERENCES Tagi(id)
);

CREATE TABLE Tagi(
        id SERIAL PRIMARY KEY,
        tagi varchar(20) NOT NULL
);