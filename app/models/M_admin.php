<?php
    class M_Admin {
        private $db;

        public function __construct() {
            $this->db = new Database();
        }
        
        // Add Admin
        public function addAdmin($data){
            $this->db->query("INSERT INTO admins (a_name, a_email, a_phone, a_password) VALUES (:a_name, :a_email, :a_phone, :a_password)");
            // Bind values
            $this->db->bind(':a_name', $data['a_name']);
            $this->db->bind(':a_email', $data['a_email']);
            $this->db->bind(':a_phone', $data['a_phone']);
            $this->db->bind(':a_password', $data['a_password']);

            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        // Find admin by email
        public function findAdminByEmail($a_email) {
            $this->db->query("SELECT * FROM admins WHERE a_email = :a_email");
            $this->db->bind(':a_email', $a_email);

            $row = $this->db->single();

            // Check row
            if($row){
                return true;
            } else {
                return false;
            }
        }
        
        // Update Admin
        public function updateAdmin($data){
            $this->db->query("UPDATE admins SET a_name = :a_name, a_email = :a_email, a_phone = :a_phone, a_password = :a_password WHERE a_id = :a_id");
            // Bind values
            $this->db->bind(':a_name', $data['a_name']);
            $this->db->bind(':a_email', $data['a_email']);
            $this->db->bind(':a_phone', $data['a_phone']);
            $this->db->bind(':a_password', password_hash($data['a_password'], PASSWORD_DEFAULT));
            $this->db->bind(':a_id', $data['a_id']);

            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        // Get Admin by ID
        public function getAdminById($a_id){
            $this->db->query("SELECT * FROM admins WHERE a_id = :a_id");
            $this->db->bind(':a_id', $a_id);

            $row = $this->db->single();

            return $row;
        }

        // Delete Admin
        public function deleteAdmin($a_id){
            $this->db->query("DELETE FROM admins WHERE a_id = :a_id");
            // Bind values
            $this->db->bind(':a_id', $a_id);

            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }
        
        // Login Admin
        public function adminLogin($a_email, $a_password){
            $this->db->query("SELECT * FROM admins WHERE a_email = :a_email");
            $this->db->bind(':a_email', $a_email);

            $row = $this->db->single();

            $hashed_password = $row->a_password;

            if(password_verify($a_password, $hashed_password)){
                return $row;
            } else {
                return false;
            }
        }

        // Add Coordinator
        public function addCoordinator($data){
            $this->db->query("INSERT INTO coordinators (ic_name, ic_email, ic_phone, ic_password) VALUES (:ic_name, :ic_email, :ic_phone, :ic_password)");
            // Bind values
            $this->db->bind(':ic_name', $data['ic_name']);
            $this->db->bind(':ic_email', $data['ic_email']);
            $this->db->bind(':ic_phone', $data['ic_phone']);
            $this->db->bind(':ic_password', $data['ic_password']);

            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        // Find coordinator by email
        public function findCoordinatorByEmail($ic_email) {
            $this->db->query("SELECT * FROM coordinators WHERE ic_email = :ic_email");
            $this->db->bind(':ic_email', $ic_email);

            $row = $this->db->single();

            // Check row
            if($row){
                return true;
            } else {
                return false;
            }
        }

        // Update Coordinator
        public function updateCoordinator($data){
            $this->db->query("UPDATE coordinators SET ic_name = :ic_name, ic_email = :ic_email, ic_phone = :ic_phone, ic_password = :ic_password WHERE ic_id = :ic_id");
            // Bind values
            $this->db->bind(':ic_name', $data['ic_name']);
            $this->db->bind(':ic_email', $data['ic_email']);
            $this->db->bind(':ic_phone', $data['ic_phone']);
            $this->db->bind(':ic_password', password_hash($data['ic_password'], PASSWORD_DEFAULT));
            $this->db->bind(':ic_id', $data['ic_id']);

            // Execute  
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        // Get Coordinator by ID
        public function getCoordinatorById($ic_id){
            $this->db->query("SELECT * FROM coordinators WHERE ic_id = :ic_id");
            $this->db->bind(':ic_id', $ic_id);

            $row = $this->db->single();

            return $row;
        }

        // Delete Coordinator
        public function deleteCoordinator($ic_id){
            $this->db->query("DELETE FROM coordinators WHERE ic_id = :ic_id");
            // Bind values
            $this->db->bind(':ic_id', $ic_id);

            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        // Login Coordinator
        public function coordinatorLogin($ic_email, $ic_password){
            $this->db->query("SELECT * FROM coordinators WHERE ic_email = :ic_email");
            $this->db->bind(':ic_email', $ic_email);

            $row = $this->db->single();

            $hashed_password = $row->ic_password;

            if(password_verify($ic_password, $hashed_password)){
                return $row;
            } else {
                return false;
            }
        }
    }