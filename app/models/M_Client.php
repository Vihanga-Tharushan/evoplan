<?php

class M_Client {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function register($data) {
        $this->db->query("INSERT INTO clients (name, address, email, password) VALUES (:name, :address, :email, :password)");
        // Bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', password_hash($data['password'], PASSWORD_DEFAULT));

        // Execute
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function login($email, $password) {
        $this->db->query("SELECT * FROM clients WHERE email = :email");
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        if($row && password_verify($password, $row->password)) {
            return $row;
        } else {
            return false;
        }
    }

    public function registerWithOtp($data) {
        $this->db->query("INSERT INTO clients (name, address, email, password, otp_code, is_verified) VALUES (:name, :address, :email, :password, :otp, 0)");
        // Bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        $this->db->bind(':otp', $data['otp']);

        // Execute
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function verifyOtp($email, $otp){
    $this->db->query('
        UPDATE clients
        SET is_verified = 1, otp_code = NULL
        WHERE email = :email AND otp_code = :otp
    ');

    $this->db->bind(':email', $email);
    $this->db->bind(':otp', $otp);

    return $this->db->execute() && $this->db->rowCount() > 0;
}

    public function findClientByEmail($email) {
        $this->db->query("SELECT * FROM clients WHERE email = :email");
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        if($row) {
            return true;
        } else {
            return false;
        }
    }

    public function getClientById($id) {
        $this->db->query("SELECT * FROM clients WHERE client_id = :id");
        $this->db->bind(':id', $id);

        return $this->db->single();
    }
}
