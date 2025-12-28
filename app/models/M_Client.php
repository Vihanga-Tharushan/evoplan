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
}
