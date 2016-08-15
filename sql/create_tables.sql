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

CREATE TABLE Viesti(
	id SERIAL PRIMARY KEY,
        ketjuId INTEGER REFERENCES Viesti(id),
	kayttajaId INTEGER REFERENCES Kayttaja(id),
	alueId INTEGER REFERENCES Alue(id),
	sisalto varchar(300) NOT NULL,
	otsikko varchar(40) NOT NULL,
	paivays DATE NOT NULL
);


CREATE TABLE Tagiliitos(
	viestiId INTEGER REFERENCES Viesti(id),
	tagiId INTEGER REFERENCES Tagi(id)
);

CREATE TABLE Tagi(
        id SERIAL PRIMARY KEY,
        tagi varchar(20) NOT NULL
);