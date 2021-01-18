<?php 

class Impfwillige {
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

    // Get categories
    public function getAll() {
        $query = 'SELECT * FROM ' . $this->table . ' ORDER BY listennummer DESC';
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Get Single Category
    public function get(){
        $query = 'SELECT * FROM ' . $this->table . ' WHERE id = ? LIMIT 0,1';
        $stmt = $this->connection->prepare($query);
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

    // Create impfwilligen
    public function create() {
        $query = 'INSERT INTO ' . $this->table . '(email, vorname, nachname, bday, passworthash, apikey, listennummer)
            VALUES (
                email = :email,
                vorname = :vorname,
                nachname = :nachname,
                bday = :bday,
                passworthash = :passworthash
                apikey = :apikey
                listennummer = :listennummer
            );
        ';
        $stmt = $this->connection->prepare($query);
        // Clean data
        $this->name = htmlspecialchars(strip_tags($this->email));
        $this->name = htmlspecialchars(strip_tags($this->vorname));
        $this->name = htmlspecialchars(strip_tags($this->nachname));
        $this->name = htmlspecialchars(strip_tags($this->bday));
        $stmt-> bindParam(':email', $this->email);
        $stmt-> bindParam(':vorname', $this->vorname);
        $stmt-> bindParam(':nachname', $this->nachname);
        $stmt-> bindParam(':bday', $this->bday);
        $stmt-> bindParam(':passworthash', $this->passworthash);
        $stmt-> bindParam(':apikey', $this->apikey);
        $stmt-> bindParam(':listennummer', $this->listennummer);
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function update($values) {
        while($values) {
            
        }
    }

    
    
}