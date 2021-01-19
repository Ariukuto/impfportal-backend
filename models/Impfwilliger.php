<?php 

class Impfwilliger {
    private $connection;
    private $table = 'impfwillige';
    public $impfwilliger_id;
    public $email;
    public $vorname;
    public $nachname;
    public $ausweisnummer;
    public $bday;
    public $passworthash;
    public $berechtigePerson;
    public $berechtigtenGruppe;
    public $apikey;
    public $impfwillen_status;
    public $krankengeschichte;
    public $medikamente;
    public $listennummer;
    public $anzahl_erkrankt;
    public $anzahl_erholt;

    // Constructor with DB
    public function __construct($db) {
        $this->connection = $db;
    }

    // Alle Impfwilligen Datensätze bekommen
    public function getAll() {
        // $query = 'SELECT * FROM ' . $this->table . ' ORDER BY listennummer DESC';
        $data = [];
        $query = "SELECT * FROM impfwillige";
        foreach ($this->connection->query($query) as $row) {
            $data[] = $row;
        }
        return $data;
    }

    // Einen bestimmten impfwilligen Datensatz bekommen
    public function get(){
        $query = 'SELECT * FROM ' . $this->table . ' WHERE impfwilliger_id = ? LIMIT 0,1';
        $stmt = $this->database->prepare($query);
        $stmt->bindParam('?', $this->impfwilliger_id);
        $stmt->execute();
        $record = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->impfwilliger_id = $record['impfwilliger_id'];
        $this->email = $record['email'];
        $this->vorname = $record['vorname'];
        $this->nachname = $record['nachname'];
        $this->ausweisnummer = $record['ausweisnummer'];
        $this->bday = $record['bday'];
        $this->passworthash = $record['passworthash'];
        $this->berechtigePerson = $record['berechtigePerson'];
        $this->berechtigtenGruppe = $record['berechtigtenGruppe'];
        $this->apikey = $record['apikey'];
        $this->impfwillen_status = $record['impfwillen_status'];
        $this->krankengeschichte = $record['krankengeschichte'];
        $this->medikamente = $record['medikamente'];
        $this->listennummer = $record['listennummer'];
        $this->anzahl_erkrankt = $record['anzahl_erkrankt'];
        $this->anzahl_erholt = $record['anzahl_erholt'];
    }

    // Einen neuen Datensatz erstellen
    public function create($email, $ausweisnummer, $vorname, $nachname, $bday, $passworthash, $apikey, $listennummer) {
        $query = 'INSERT INTO ' . $this->table . '(email, $ausweisnummer, vorname, nachname, bday, passworthash, apikey, listennummer)
            VALUES (
                email = :email,
                vorname = :vorname,
                ausweisnummer = :ausweisnummer
                nachname = :nachname,
                bday = :bday,
                passworthash = :passworthash
                apikey = :apikey
                listennummer = :listennummer
            );
        ';
        $stmt = $this->database->prepare($query);
        // Clean data
        $email = htmlspecialchars(strip_tags($email));
        $ausweisnummer = htmlspecialchars(strip_tags($ausweisnummer));
        $vorname = htmlspecialchars(strip_tags($vorname));
        $nachname = htmlspecialchars(strip_tags($nachname));
        $bday = htmlspecialchars(strip_tags($bday));
        $stmt-> bindParam(':email', $email);
        $stmt-> bindParam(':ausweisnummer', $ausweisnummer);
        $stmt-> bindParam(':vorname', $vorname);
        $stmt-> bindParam(':nachname', $nachname);
        $stmt-> bindParam(':bday', $this->bday);
        $stmt-> bindParam(':passworthash', $passworthash);
        $stmt-> bindParam(':apikey', $apikey);
        $stmt-> bindParam(':listennummer', $listennummer);
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    /* Einen bestehenden Datensatz aktualisieren */
    public function update($column, $value) {
        $query = '
            UPDATE ' . $this->table . 
            ' SET :column = :value 
            WHERE impfwilliger_id = :impfwilliger_id
        ';
        $stmt = $this->database->prepare($query);
        // Clean data
        $column = htmlspecialchars(strip_tags($column));
        $value = htmlspecialchars(strip_tags($value));
        $stmt-> bindParam(':column', $column);
        $stmt-> bindParam(':value', $value);
        $stmt-> bindParam(':impfwilliger_id', $this->impfwilliger_id);
        if($stmt->execute()) {
            return true;
        } 
        return false;
    }
 // ENDE
}

