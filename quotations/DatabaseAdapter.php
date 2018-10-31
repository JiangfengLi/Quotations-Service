<?php
class DatabaseAdaptor {
    private $DB; // The instance variable used in every method
    // Connect to an existing data based named 'first'
    public function __construct() {
        $dataBase = 'mysql:dbname=quotes; charset=utf8; host=127.0.0.1';
        $user = 'root';
        $password = '';
        try {
            $this->DB = new PDO ( $dataBase, $user, $password );
            $this->DB->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        } catch ( PDOException $e ) {
            echo ('Error establishing Connection');
            exit ();
        }
    }
    
    // Return all customer records as a PHP associative array.
    public function getAllQuotes() {
        $stmt = $this->DB->prepare ( "SELECT * FROM quotations order by rating desc, added asc" );
        $stmt->execute();
        return $stmt->fetchAll ( PDO::FETCH_ASSOC );
    }
    
    public function getRatesAdd($id){
        $stmt = $this->DB->prepare ("UPDATE quotations SET rating = rating + 1 WHERE id = ". $id. ";");
        $stmt->execute();
        return $stmt->fetchAll ( PDO::FETCH_ASSOC );
    }
    
    public function getRatesMinus($id){
        $stmt = $this->DB->prepare ("UPDATE quotations SET rating = rating - 1 WHERE id = ". $id. ";");
        $stmt->execute();
        return $stmt->fetchAll ( PDO::FETCH_ASSOC );
    }
    
    public function getFlag($id){
        $stmt = $this->DB->prepare ("UPDATE quotations SET flagged = flagged + 1 WHERE id = ". $id. ";");
        $stmt->execute();
        return $stmt->fetchAll ( PDO::FETCH_ASSOC );
    }
    
    public function getAllUsers(){
        $stmt = $this->DB->prepare ("SELECT * FROM users;");
        $stmt->execute();
        return $stmt->fetchAll ( PDO::FETCH_ASSOC );
    }
    
    public function setUser($username, $hash){
        $stmt = $this->DB->prepare ("insert into users(username, hash) values('".$username. "', '".$hash."');");
        $stmt->execute();
    }
    
    public function UnflagAll(){
        $stmt = $this->DB->prepare ("UPDATE quotations SET flagged = 0;");
        $stmt->execute();
    }
    
    public function addNewQuotes($quote, $author){
        $stmt = $this->DB->prepare ("insert into quotations(quote, author, rating, flagged, added) values('".$quote. "', '".$author."', 0, 0, NOW());");
        $stmt->execute();
    }
    
} // End class DatabaseAdaptor


?>