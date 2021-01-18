
/* Hersteller der Impfstoffe */
DROP TABLE IF EXISTS hersteller;
CREATE TABLE hersteller (
    hersteller_id INTEGER NOT NULL AUTO_INCREMENT,
    hersteller_name VARCHAR(255) NOT NULL,
    hersteller_url VARCHAR(255) NOT NULL,
    PRIMARY KEY (hersteller_id)
);
INSERT INTO hersteller(hersteller_name, hersteller_url)
VALUES("BioNTech", "https://biontech.de/de"),
VALUES("Moderna", "https://www.modernatx.com/"),
VALUES("AstraZeneca Life Science / Oxford University (UK)", "https://www.astrazeneca.com/");

/* Verschiedene Impfstoffe von unterschiedlichen Herstellern */
DROP TABLE IF EXISTS impfstoffe;
CREATE TABLE impfstoffe (
    impfstoff_id INTEGER NOT NULL AUTO_INCREMENT,
    bezeichnung VARCHAR(255) NOT NULL,
    impfstofftyp VARCHAR(255) NOT NULL,
    hersteller_id INTEGER NOT NULL,
    abklingzeit_tage INTEGER NOT NULL,
    created_at TIMESTAMP,
    PRIMARY KEY (impfstoff_id),
    FOREIGN KEY (hersteller_id) REFERENCES hersteller(hersteller_id)
);
INSERT INTO impfstoffe(bezeichnung, impfstofftyp, hersteller_id, abklingzeit_tage)
VALUES("BNT162b2", "mRNA-basierter Impfstoff", 1, 20),
VALUES("mRNA-1273", "mRNA-basierter Impfstoff", 2, 20),
VALUES("ChAdOx1 nCoV-19", "Vektorviren-Impfstoff", 3, 20);


/* Impftermine */
DROP TABLE IF EXISTS termine;
CREATE TABLE termine (
    termin_id INTEGER NOT NULL AUTO_INCREMENT,
    datum DATETIME NOT NULL,
    bezeichnung VARCHAR(255) NOT NULL,
    teilnehmeranzahl INTEGER NOT NULL,
    termin_plz VARCHAR(255) NOT NULL,
    termin_straße VARCHAR(255) NOT NULL,
    termin_hausnummer VARCHAR(255),
    impfstoff_id INTEGER NOT NULL,
    PRIMARY KEY (termin_id),
    FOREIGN KEY (impfstoff_id) REFERENCES impfstoffe(impfstoff_id)
);

/* Nebenwirkungen die bei Impfungen auftreten könnten */
DROP TABLE IF EXISTS nebenwirkungen;
CREATE TABLE nebenwirkungen (
    nebenwirkung_id INTEGER NOT NULL AUTO_INCREMENT,
    bezeichnung VARCHAR(255) NOT NULL,
    beschreibung TEXT,
    fachbegriff VARCHAR(255) NOT NULL,
    impfstoff_id INTEGER NOT NULL,
    PRIMARY KEY (nebenwirkung_id),
    FOREIGN KEY (impfstoff_id) REFERENCES impfstoffe(impfstoff_id)
);
INSERT INTO nebenwirkungen(bezeichnung, fachbegriff, impfstoff_id)
VALUES("Kopfschmerzen", "", "Keine Ahnung", 1),
VALUES("Übelkeit/Erbrechen", "Keine Ahnung" 2),
VALUES("Schwindel/Müdigkeit", "Keine Ahnung" 3);

/* impfwillige */
DROP TABLE IF EXISTS impfwillige;
CREATE TABLE impfwillige (
    impfwilliger_id INTEGER NOT NULL AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL UNIQUE,
    vorname VARCHAR(50) NOT NULL,
    nachname VARCHAR(50) NOT NULL,
    bday DATE NOT NULL,
    passworthash VARCHAR(255) NOT NULL UNIQUE,
    berechtigtePerson BOOLEAN DEFAULT NULL,
    berechtigtenGruppe INTEGER DEFAULT NULL,
    apikey VARCHAR(255) NOT NULL,
    impfwillen_status BOOLEAN DEFAULT 1,
    krankengeschichte TEXT DEFAULT NULL,
    medikamente TEXT DEFAULT NULL,Übelkeit/Erbrechen
    listennummer INTEGER NOT NULL,
    anzahl_erkrankt INTEGER DEFAULT NULL,
    anzahl_erholt INTEGER DEFAULT NULL,
    PRIMARY KEY (impfwilliger_id)
);
INSERT INTO impfwillige (email, vorname, nachname, bday, passworthash, berechtigtePerson, apikey, listennummer)
VALUES ("max@muster.de", "Frederik", "Alt", '1950-02-05', "b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86", 1, "c6825b6ea41a5b5747e35cc22b2744e2881e50fd", 1),
VALUES ("jungermann@gmx.de", "Alex", "Jung", '1998-06-12', "bcad0c7b087ecb084b1e2323dd9617151d74323dd200755840a8f1949392d1f5fbedcec6f8fd718bc3184bb5f1137f4bbf120bf3d87eb066241f977823495eca", 0, "8260c6ad9ef4614045b629bf77cfb7a8e4552475636abafde701d71f261c8623", 2);

/* Fragebogen */
DROP TABLE IF EXISTS fragebogen;
CREATE TABLE fragebogen (
    fragebogen_id INTEGER NOT NULL AUTO_INCREMENT,
    impfwilliger_id INTEGER NOT NULL,
    expositionsrisiko INTEGER NOT NULL,
    bewohner_von_seniorenheim BOOLEAN NOT NULL,
    personal_in_medizinischer_einrichtung BOOLEAN NOT NULL,
    tätigkeit_in_seniorenheimen BOOLEAN NOT NULL,
    down_syndrom BOOLEAN NOT NULL,
    pflegepersonal_in_altenpflege BOOLEAN NOT NULL,
    kontakt_zu_bewohner_in_seniorenheimen BOOLEAN NOT NULL,
    geistige_behinderung BOOLEAN NOT NULL,
    versorgung_personen_geistige_behinderung BOOLEAN NOT NULL,
    organtransplantation BOOLEAN NOT NULL,
    vorerkrankung_risiko INTEGER NOT NULL,
    bewohner_tätig_in_gemeinschaftsunterkunft BOOLEAN NOT NULL,
    enger_kontakt_zu_schwangeren BOOLEAN NOT NULL,
    enger_kontakt_zu_personen_mit_hohem_risiko BOOLEAN NOT NULL,
    enger_kontakt_zu_personen_mit_moderaten_risiko BOOLEAN NOT NULL,
    personal_für_aufrechterhaltung_Krankenhausinfrastruktur BOOLEAN NOT NULL,
    schlüsselpositionen_der_landes_bundesregierung BOOLEAN NOT NULL,
    teilbereich_ögd BOOLEAN NOT NULL,
    lehrer_erzieher BOOLEAN NOT NULL,
    prekäre_bedingungen BOOLEAN NOT NULL,
    beschäfigte_einzelhandel BOOLEAN NOT NULL,
    personen_zur_aufrechterhaltung_der_öffentlichen_Sicherheit BOOLEAN NOT NULL,
    berufe_der_kritischen_infrastruktur BOOLEAN NOT NULL,
    PRIMARY KEY (fragebogen_id),
    FOREIGN KEY (impfwilliger_impfwilligeid) REFERENCES impfwillige(impfwilliger_id)
);

/* Alle Nachrichten */
DROP TABLE IF EXISTS messages;
CREATE TABLE messages (
    message_id INTEGER NOT NULL AUTO_INCREMENT,
    impfwilliger_id INTEGER NOT NULL,
    PRIMARY KEY (message_id),
    FOREIGN KEY (impfwilliger_id) REFERENCES impfwillige(impfwilliger_id)
);

/*  nebenwirkungen der impfwilligen  n zu m 
CREATE TABLE impfwillige_impfstoff_nebenwirkung (
    impfwilliger_id INTEGER NOT NULL,
    impfstoff_id INTEGER NOT NULL,
    nebenwirkung_id INTEGER NOT NULL,
    PRIMARY KEY (impfwilliger_id, impfstoff_id, nebenwirkung_id),
    FOREIGN KEY (impfstoff_id) REFERENCES impfwillige(impfwilliger_id),
    FOREIGN KEY (impfstoff_id) REFERENCES Impfstoffe(impfstoff_id),
    FOREIGN KEY (nebenwirkung_id) REFERENCES nebenwirkungen(nebenwirkung_id)
);
*/




