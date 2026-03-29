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

    public function addFavoriteProvider($client_id, $service_id) {
        $this->db->query("INSERT INTO favorite_providers (client_id, service_id) VALUES (:client_id, :service_id)");
        $this->db->bind(':client_id', $client_id);
        $this->db->bind(':service_id', $service_id);

        return $this->db->execute();
    }

    public function removeFavoriteProvider($client_id, $service_id) {
        $this->db->query("DELETE FROM favorite_providers WHERE client_id = :client_id AND service_id = :service_id");
        $this->db->bind(':client_id', $client_id);
        $this->db->bind(':service_id', $service_id);

        return $this->db->execute();
    }

    public function getFavoriteProviders($client_id) {
        $this->db->query("SELECT * FROM favorite_providers WHERE client_id = :client_id");
        $this->db->bind(':client_id', $client_id);

        return $this->db->resultSet();
    }

    public function updateProfile( $data) {
        // Build dynamic SQL based on whether profile_pic is included
        if(isset($data['profile_pic'])){
            $this->db->query("UPDATE clients SET name = :name, address = :address, email = :email, contact = :contact, profile_pic = :profile_pic WHERE client_id = :client_id");
            $this->db->bind(':profile_pic', $data['profile_pic']);
        } else {
            $this->db->query("UPDATE clients SET name = :name, address = :address, email = :email, contact = :contact WHERE client_id = :client_id");
        }
        
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':contact', $data['contact']);
        $this->db->bind(':client_id', $data['client_id']);

        return $this->db->execute();
    }

    public function updatePassword($client_id, $new_password) {
        $this->db->query("UPDATE clients SET password = :password WHERE client_id = :client_id");
        $this->db->bind(':password', password_hash($new_password, PASSWORD_DEFAULT));
        $this->db->bind(':client_id', $client_id);

        return $this->db->execute();
    }
    
}
