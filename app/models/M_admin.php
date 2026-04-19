<?php
    class M_Admin {
        private $db;

        public function __construct() {
            $this->db = new Database();
        }

        // Get all clients data
        public function getClients(){
            $this->db->query("SELECT * FROM clients");
            $results = $this->db->resultSet();
            return $results;
        }

        // Get all service providers data
        public function getServiceProviders(){
            $this->db->query("SELECT * FROM service_providers");
            $results = $this->db->resultSet();
            return $results;
        }

        // Delete profiles by ID and type (client or service provider)
        public function deleteProfile($user_id, $type = 'client'){
            if ($type === 'service_provider') {
                return $this->deleteServiceProvider($user_id);
            } else {
                return $this->deleteClient($user_id);
            }
        }


        public function deleteClient($client_id){
            $this->db->query("DELETE FROM clients WHERE c_id = :client_id");
            // Bind values
            $this->db->bind(':client_id', $client_id);

            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function deleteServiceProvider($service_id){
            $this->db->query("UPDATE service_providers SET status = 'INACTIVE' WHERE sp_id = :service_id");
            // Bind values
            $this->db->bind(':service_id', $service_id);

            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
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

        // Load all admins
        public function getAdmins(){
            $this->db->query("SELECT * FROM admins");
            $results = $this->db->resultSet();
            return $results;
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

        // Load all coordinators
        public function getCoordinators(){
            $this->db->query("SELECT * FROM coordinators");
            $results = $this->db->resultSet();
            return $results;
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

        // Add Photo to Landing Page
        public function addPhoto($data){
            $this->db->query("INSERT INTO landing_photos (event_name, event_date, event_photo_name) VALUES (:event_name, :event_date, :event_photo_name)");
            // Bind values
            $this->db->bind(':event_name', $data['event_name']);
            $this->db->bind(':event_date', $data['event_date']);
            $this->db->bind(':event_photo_name', $data['event_photo_name']);

            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        // Load all landing page photos to display in admin features page
        public function getLandingPagePhotos(){
            $this->db->query("SELECT * FROM landing_photos");
            $results = $this->db->resultSet();
            return $results;
        }

        // Get Photo by ID
        public function getPhotoById($photo_id){
            $this->db->query("SELECT * FROM landing_photos WHERE photo_id = :photo_id");
            $this->db->bind(':photo_id', $photo_id);

            $row = $this->db->single();

            return $row;
        }

        // Update landing page photo (with new photo)
        public function updatePhoto($data){
            $this->db->query("UPDATE landing_photos SET event_name = :event_name, event_date = :event_date, event_photo_name = :event_photo_name WHERE photo_id = :photo_id");
            // Bind values
            $this->db->bind(':event_name', $data['event_name']);
            $this->db->bind(':event_date', $data['event_date']);
            $this->db->bind(':event_photo_name', $data['event_photo_name']);
            $this->db->bind(':photo_id', $data['photo_id']);

            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        // Update landing page photo info only (without changing photo)
        public function updatePhotoInfo($data){
            $this->db->query("UPDATE landing_photos SET event_name = :event_name, event_date = :event_date WHERE photo_id = :photo_id");
            // Bind values
            $this->db->bind(':event_name', $data['event_name']);
            $this->db->bind(':event_date', $data['event_date']);
            $this->db->bind(':photo_id', $data['photo_id']);

            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        // Delete landing page photo
        public function deletePhoto($photo_id){
            $this->db->query("DELETE FROM landing_photos WHERE photo_id = :photo_id");
            // Bind values
            $this->db->bind(':photo_id', $photo_id);

            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }
    }