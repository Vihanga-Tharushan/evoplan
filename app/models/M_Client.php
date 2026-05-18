<?php

class M_Client {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function register($data) {
        $this->db->query("INSERT INTO clients (name, address, contact, email, password) VALUES (:name, :address, :contact, :email, :password)");
        // Bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':contact', $data['contact']);
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

    public function getClientByEmail($email) {
        $this->db->query("SELECT * FROM clients WHERE email = :email");
        $this->db->bind(':email', $email);

        return $this->db->single();
    }

    public function setPasswordResetToken($email, $tokenHash, $expiresAt) {
        $this->db->query("UPDATE clients SET reset_token = :token, reset_token_expires_at = :expires WHERE email = :email");
        $this->db->bind(':token', $tokenHash);
        $this->db->bind(':expires', $expiresAt);
        $this->db->bind(':email', $email);

        return $this->db->execute();
    }

    public function getClientByResetToken($tokenHash) {
        $this->db->query("SELECT * FROM clients WHERE reset_token = :token AND reset_token_expires_at >= NOW()");
        $this->db->bind(':token', $tokenHash);

        return $this->db->single();
    }

    public function clearPasswordResetToken($client_id) {
        $this->db->query("UPDATE clients SET reset_token = NULL, reset_token_expires_at = NULL WHERE client_id = :client_id");
        $this->db->bind(':client_id', $client_id);

        return $this->db->execute();
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
    

    // Add feedback (submit or draft)
    public function addFeedback($data) {
        // Insert into `reviews` table (new schema)
        // Ensure we provide `service_id` if the reviews table requires it
        $serviceId = isset($data['service_id']) ? $data['service_id'] : null;

        if (empty($serviceId) && !empty($data['provider_name'])) {
            // Try to resolve service_id by provider name (match businessName or "fname lname")
            $this->db->query("SELECT service_id FROM service_providers WHERE businessName = :name LIMIT 1");
            $this->db->bind(':name', $data['provider_name']);
            $row = $this->db->single();
            if ($row && isset($row->service_id)) {
                $serviceId = $row->service_id;
            } else {
                // try matching by full name
                $this->db->query("SELECT service_id FROM service_providers WHERE CONCAT(fname, ' ', lname) = :name LIMIT 1");
                $this->db->bind(':name', $data['provider_name']);
                $row2 = $this->db->single();
                if ($row2 && isset($row2->service_id)) {
                    $serviceId = $row2->service_id;
                }
            }
        }

        
        // Insert including service_id into reviews table
        $this->db->query(
            "INSERT INTO reviews (client_id, service_id, provider_name, rating, review_text, created_at) VALUES (:client_id, :service_id, :provider_name, :rating, :review_text, NOW())"
        );

        $this->db->bind(':client_id', $data['client_id']);
        $this->db->bind(':service_id', $serviceId);
        $this->db->bind(':provider_name', $data['provider_name']);
        $this->db->bind(':rating', $data['rating']);
        $this->db->bind(':review_text', $data['feedback_text']);

        if (!$this->db->execute()) return false;
        $id = $this->db->lastInsertId();

        // return inserted row in the legacy shape used by views
        $this->db->query("SELECT review_id AS feedback_id, client_id, provider_name, rating, review_text AS feedback_text, created_at FROM reviews WHERE review_id = :id LIMIT 1");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    // Get all feedback by logged client
    public function getClientFeedbacks($client_id) {
        $this->db->query(
            "SELECT review_id AS feedback_id, client_id, provider_name, rating, review_text AS feedback_text 
             FROM reviews 
             WHERE client_id = :client_id 
             ORDER BY review_id DESC"
        );

        $this->db->bind(':client_id', $client_id);
        return $this->db->resultSet();
    }

    // Get single feedback (for edit)
    public function getFeedbackById($feedback_id) {
        $this->db->query(
            "SELECT review_id AS feedback_id, client_id, provider_name, rating, review_text AS feedback_text 
             FROM reviews 
             WHERE review_id = :feedback_id LIMIT 1"
        );
        $this->db->bind(':feedback_id', $feedback_id);
        return $this->db->single();
    }

    // Update feedback (edit / save draft)
    public function updateFeedback($data) {
        // Update `reviews` table only
        $this->db->query(
            "UPDATE reviews 
             SET rating = :rating,
                 review_text = :feedback_text
             WHERE review_id = :feedback_id"
        );

        $this->db->bind(':rating', $data['rating']);
        $this->db->bind(':feedback_text', $data['feedback_text']);
        $this->db->bind(':feedback_id', $data['feedback_id']);

        return $this->db->execute();
    }

    // Delete feedback
    public function deleteFeedback($feedback_id) {
        $this->db->query(
            "DELETE FROM reviews WHERE review_id = :feedback_id"
        );

        $this->db->bind(':feedback_id', $feedback_id);
        return $this->db->execute();
    }
}
