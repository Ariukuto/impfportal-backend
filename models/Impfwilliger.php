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

    public function getAll() {
        $sth = $this->connection->prepare("
            SELECT * FROM impfwillige 
            ORDER BY listennummer
        ");
        $sth->execute();
        $result = $sth->fetchAll();
        if(!empty($result)) {
            return $result;
        }
        return false;
    }

    // Einen bestimmten impfwilligen Datensatz bekommen
    public function get($id) {  
        $sth = $this->connection->prepare("SELECT * FROM {$this->table} WHERE impfwilliger_id =".$id);
        $sth->$sth->execute();
        $result = $sth->fetchAll();
        if(!empty($result)) {
            return $result;
        }
        return "Es konnte kein Datensatz mit der id {$id} gefunden werden";
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

