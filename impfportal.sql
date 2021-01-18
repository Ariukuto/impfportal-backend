
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
    vorerkrankung_risikio INTEGER NOT NULL,
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




