
/* Hersteller der Impfstoffe */
CREATE TABLE hersteller (
    hersteller_id INTEGER NOT NULL AUTO_INCREMENT,
    hersteller_name VARCHAR(255) NOT NULL,
    hersteller_url VARCHAR(255) NOT NULL,
    PRIMARY KEY (hersteller_id)
);

/* Verschiedene Impfstoffe von unterschiedlichen Herstellern */
CREATE TABLE impfstoffe (
    impfstoff_id INTEGER NOT NULL AUTO_INCREMENT,
    bezeichnung VARCHAR(255) NOT NULL,
    hersteller_id INTEGER NOT NULL,
    abklingzeit INTEGER NOT NULL,
    created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (impfstoff_id),
    FOREIGN KEY (hersteller_id) REFERENCES hersteller(hersteller_id)
);

/* Impftermine */
CREATE TABLE termine (
    termin_id INTEGER NOT NULL AUTO_INCREMENT,
    datum DATETIME NOT NULL,
    bezeichnung VARCHAR(255),
    teilnehmeranzahl INTEGER NOT NULL,
    termin_plz VARCHAR(255) NOT NULL,
    termin_straße VARCHAR(255) NOT NULL,
    termin_hausnummer VARCHAR(255),
    impfstoff_id INTEGER NOT NULL,
    PRIMARY KEY (termin_id),
    FOREIGN KEY (impfstoff_id) REFERENCES impfstoffe(impfstoff_id)
);

/* Nebenwirkungen die bei Impfungen auftreten könnten */
CREATE TABLE nebenwirkungen (
    nebenwirkung_id INTEGER NOT NULL AUTO_INCREMENT,
    bezeichnung VARCHAR(255) NOT NULL,
    beschreibung VARCHAR(255) NOT NULL,
    fachbegriff VARCHAR(255) NOT NULL,
    impfstoff_id INTEGER NOT NULL,
    PRIMARY KEY (nebenwirkung_id),
    FOREIGN KEY (impfstoff_id) REFERENCES impfstoffe(impfstoff_id)
);

/* impfwillige */
CREATE TABLE impfwillige (
    impfwilliger_id INTEGER NOT NULL AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL UNIQUE,
    vorname VARCHAR(50) NOT NULL,
    nachname VARCHAR(50) NOT NULL,
    bday DATE NOT NULL,
    passworthash VARCHAR(255) NOT NULL UNIQUE,
    berechtigePerson BOOLEAN DEFAULT NULL,
    berechtigtenGruppe INTEGER DEFAULT NULL,
    apikey VARCHAR(255) NOT NULL,
    impfwillen_status BOOLEAN DEFAULT 1,
    krankengeschichte TEXT DEFAULT NULL,
    medikamente TEXT DEFAULT NULL,
    listennummer INTEGER NOT NULL,
    anzahl_erkrankt INTEGER DEFAULT NULL,
    anzahl_erholt INTEGER DEFAULT NULL,
    PRIMARY KEY (impfwilliger_id)
);

/* Fragebogen */
CREATE TABLE fragebogen (
    fragebogen_id INTEGER NOT NULL AUTO_INCREMENT,
    impfwilliger_id INTEGER NOT NULL,
    bewohner_von_altenheim BOOLEAN NOT NULL,
    person_mit_expositionsrisiko BOOLEAN NOT NULL,
    person_in_medizinischer_einrichtung BOOLEAN NOT NULL,
    kontakt_zu_Vulnerablen_gruppen BOOLEAN NOT NULL,  
    pflegepersonal_altenpflege BOOLEAN NOT NULL,
    andere_tätigkeit_in_altenpflege BOOLEAN NOT NULL,
    geistige_behinderung BOOLEAN NOT NULL,
    tätigkeit_mit_geistig_behinderten BOOLEAN NOT NULL,
    PRIMARY KEY (fragebogen_id),
    FOREIGN KEY (impfwilliger_id) REFERENCES impfwillige(impfwilliger_id)
);

/* Alle Nachrichten */
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




