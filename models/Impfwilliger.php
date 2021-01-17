<?php 

class Impfwillige {
    private $conn;
    private $table = 'impfwillige';

    public $impfwilliger_id;
    public $email;
    public $vorname;
    public $nachname;
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
        $this->conn = $db;
    }

    // Get categories
    public function showall() {
        $query = 'SELECT * FROM ' . $this->table . ' ORDER BY listennummer DESC';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Get Single Category
    public function show_by_id(){
        $query = 'SELECT * FROM ' . $this->table . ' WHERE id = ? LIMIT 0,1';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->impfwilliger_id);
        $stmt->execute();
        $record = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->impfwilliger_id = $record['impfwilliger_id'];
        $this->email = $record['email'];
        $this->vorname = $record['vorname'];
        $this->nachname = $record['nachname'];
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
        $query = 'INSERT INTO ' .
            $this->table . '
            SET
            email = :email
        ';
        $stmt = $this->conn->prepare($query);
        // Clean data
        $this->name = htmlspecialchars(strip_tags($this->name));
        $stmt-> bindParam(':name', $this->name);
        if($stmt->execute()) {
            return true;
        }
        // printf("Error: $s.\n", $stmt->error);
        return false;
    }

    
    
}