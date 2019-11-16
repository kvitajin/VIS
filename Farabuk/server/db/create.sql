PRAGMA encoding = 'UTF-8';
PRAGMA journal_mode = wal;
PRAGMA foreign_keys = OFF;

CREATE TABLE album (
	id_album INTEGER PRIMARY KEY,
	nazev TEXT NOT NULL,
	je_uvodni INTEGER,
	viditelne INTEGER DEFAULT 1,
	ck_id_obec INTEGER REFERENCES obec NOT NULL
);
-- CREATE INDEX idx_album_obec ON album(ck_id_obec)

CREATE TABLE dokument (
	id_dokument INTEGER PRIMARY KEY,
	nadpis TEXT NOT NULL,
	uri TEXT NOT NULL,
	obsah TEXT NOT NULL,
	datum TEXT NOT NULL,
	datum_vyveseni TEXT,
	datum_stazeni TEXT,
	obrazek TEXT,

	ck_id_druh_dokumentu INTEGER REFERENCES druh_dokumentu NOT NULL,
	ck_id_kategorie_dokumentu INTEGER REFERENCES kategorie_dokumentu NOT NULL
);
-- CREATE INDEX idx_dokument_druh_dokumentu ON dokument(ck_id_druh_dokumentu)
-- CREATE INDEX idx_dokument_dokument ON dokument(ck_id_kategorie_dokumentu)

CREATE TABLE foto (
	id_foto INTEGER PRIMARY KEY,
	datum TEXT NOT NULL,
	sirka INTEGER NOT NULL,
	nazev_souboru TEXT NOT NULL,
	popis TEXT,
	viditelna INTEGER DEFAULT 1,
	ck_id_album INTEGER REFERENCES album
);
-- CREATE INDEX idx_foto_album ON foto(ck_id_album)

CREATE TABLE komentar (
	id_komentar INTEGER PRIMARY KEY,
	obsah TEXT NOT NULL,
	viditelny INTEGER DEFAULT 1,
	ck_id_uzivatel INTEGER REFERENCES uzivatel NOT NULL,
	ck_id_dokument INTEGER REFERENCES dokument,
	ck_id_foto INTEGER REFERENCES foto
);

CREATE TABLE obec (
	id_obec INTEGER PRIMARY KEY,
	erb TEXT NOT NULL,
	nazev TEXT NOT NULL,
	uri TEXT NOT NULL,
	viditelna INTEGER DEFAULT 1
);

CREATE TABLE druh_dokumentu (
	id_druh_dokumentu INTEGER PRIMARY KEY,
	nazev TEXT NOT NULL,
	uri TEXT NOT NULL
);

CREATE TABLE kategorie_dokumentu (
	id_kategorie_dokumentu INTEGER PRIMARY KEY,
	nazev TEXT NOT NULL
);

CREATE TABLE uzivatel (
	id_uzivatel INTEGER PRIMARY KEY,
	nick TEXT NOT NULL,
	heslo TEXT NOT NULL,
	email TEXT NOT NULL,
	datum_narozeni TEXT NOT NULL,
	ban INTEGER,
	ck_id_obec INTEGER REFERENCES obec
);

CREATE TABLE skupina (
	id_skupina INTEGER PRIMARY KEY,
	nazev TEXT NOT NULL,
	opravneni INTEGER NOT NULL
);

CREATE TABLE dokument_obec (
	ck_id_dokument INTEGER REFERENCES dokument NOT NULL,
	ck_id_obec INTEGER REFERENCES obec NOT NULL,
	PRIMARY KEY (ck_id_dokument, ck_id_obec)
);

CREATE TABLE skupina_uzivatel (
	ck_id_skupina INTEGER REFERENCES skupina NOT NULL,
	ck_id_uzivatel INTEGER REFERENCES uzivatel NOT NULL,
	PRIMARY KEY (ck_id_skupina, ck_id_uzivatel)
);

CREATE TABLE like_foto (
	ck_id_uzivatel INTEGER REFERENCES uzivatel NOT NULL,
	ck_id_foto INTEGER REFERENCES foto NOT NULL,
	PRIMARY KEY (ck_id_uzivatel, ck_id_foto)
);

CREATE TABLE like_komentar (
	ck_id_uzivatel INTEGER REFERENCES uzivatel NOT NULL,
	ck_id_komentar INTEGER REFERENCES komentar NOT NULL,
	PRIMARY KEY (ck_id_uzivatel, ck_id_komentar)
);

CREATE TABLE like_dokument (
	ck_id_uzivatel INTEGER REFERENCES uzivatel NOT NULL,
	ck_id_dokument INTEGER REFERENCES dokument NOT NULL,
	PRIMARY KEY (ck_id_uzivatel, ck_id_dokument)
);

PRAGMA foreign_keys = ON;
