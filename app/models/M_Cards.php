<?php
    class M_Cards {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        /** READ **/
    public function getAllMethods(){
        $this->db->query('SELECT id, card_name, card_number, expiry_date, cvv FROM addmethod ORDER BY id DESC');
        return $this->db->resultSet();
    }

public function getMethodsById($id) {
    $this->db->query('SELECT card_id, card_name, card_number, expiry_date, cvv 
                      FROM addmethod 
                      WHERE holder_id = :id');
    $this->db->bind(':id', $id);
    $this->db->execute();      
    return $this->db->resultSet();
}

public function getMethodsByCardNumber($id) {
    $this->db->query('SELECT card_id, card_name, card_number, expiry_date, cvv 
                      FROM addmethod 
                      WHERE card_id = :id');
    $this->db->bind(':id', $id);
    $this->db->execute();      
    return $this->db->resultSet();
}
        

        public function addMethod($data){
            $this->db->query('INSERT INTO addmethod (holder_id, card_name, card_number, expiry_date, cvv) VALUES (:holder_id, :card_name, :card_number, :expiry_date, :cvv)');
            // Bind values
            $this->db->bind(':card_name', $data['card_name']);
            $this->db->bind(':holder_id', $data['holder_id']);
            $this->db->bind(':card_number', $data['card_number']);
            $this->db->bind(':expiry_date', $data['expiry_date']); // "06/2027"
            $this->db->bind(':cvv', $data['cvv']);

            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function updateMethod($data){
            var_dump($data);
            $this->db->query('UPDATE addmethod SET expiry_date = :expiry_date, cvv = :cvv WHERE card_id = :card_id');
            // Bind values
            $this->db->bind(':card_id', $data['card_id']);
            $this->db->bind(':expiry_date', $data['expiry_date']); // "06/2027"
            $this->db->bind(':cvv', $data['cvv']);

            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function deleteMethod($id){
            $this->db->query('DELETE FROM addmethod WHERE card_id = :card_id');
            // Bind values
            $this->db->bind(':card_id', $id);

            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }
    }
    ?>