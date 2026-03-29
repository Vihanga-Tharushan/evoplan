<?php
    class M_ServiceP {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        //Register user
        public function register($data){
            $this->db->query("INSERT INTO service_providers (fname, lname, nic, email, password, contact, address, district, businessName, businessId, serviceType, contactB, emailB, businessAddress, bizDistrict, description, experience, license) VALUES (:fname, :lname, :nic, :email, :password, :contact, :address, :district, :businessName, :businessId, :serviceType, :contactB, :emailB, :businessAddress, :bizDistrict, :description, :experience, :license)");            // Bind values
            $this->db->bind(':fname', $data['fname']);
            $this->db->bind(':lname', $data['lname']);
            $this->db->bind(':nic', $data['nic']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':password', $data['password']);
            $this->db->bind(':contact', $data['contact']);
            $this->db->bind(':address', $data['address']);
            $this->db->bind(':district', $data['district']);
            $this->db->bind(':businessName', $data['businessName']);
            $this->db->bind(':businessId', $data['businessId']);
            $this->db->bind(':serviceType', $data['serviceType']);
            $this->db->bind(':contactB', $data['contactB']);
            $this->db->bind(':emailB', $data['emailB']);
            $this->db->bind(':businessAddress', $data['businessAddress']);
            $this->db->bind(':bizDistrict', $data['bizDistrict']);
            $this->db->bind(':description', $data['description']);
            $this->db->bind(':experience', $data['experience']);
            $this->db->bind(':license', $data['license']);
           
             // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }


        public function updatePersonalInfo($data){
            $this->db->query("UPDATE service_providers SET fname = :fname, lname = :lname, contact = :contact, address = :address, district = :district WHERE service_id = :service_id");
            // Bind values
            $this->db->bind(':fname', $data['fname']);
            $this->db->bind(':lname', $data['lname']);
            $this->db->bind(':contact', $data['contact']);
            $this->db->bind(':address', $data['address']);
            $this->db->bind(':district', $data['district']);
            $this->db->bind(':service_id', $data['service_id']);
           
             // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }


        public function updateBusinessInfo($data){
            $this->db->query("UPDATE service_providers SET businessName = :businessName, contactB = :contactB, emailB = :emailB, businessAddress = :businessAddress, bizDistrict = :bizDistrict, description = :description, experience = :experience WHERE service_id = :service_id");
            // Bind values
            $this->db->bind(':businessName', $data['businessName']);
            $this->db->bind(':contactB', $data['contactB']);
            $this->db->bind(':emailB', $data['emailB']);
            $this->db->bind(':businessAddress', $data['businessAddress']);
            $this->db->bind(':bizDistrict', $data['bizDistrict']);
            $this->db->bind(':description', $data['description']);
            $this->db->bind(':experience', $data['experience']);
            $this->db->bind(':service_id', $data['service_id']);
           
             // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function updatePassword($data){
            $this->db->query("UPDATE service_providers SET password = :password WHERE service_id = :service_id");
            // Bind values
            $this->db->bind(':password', $data['password']);
            $this->db->bind(':service_id', $data['service_id']);
           
             // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }
        //Find user by email
        public function findUserByEmail($email){
        $this->db->query("SELECT * FROM service_providers WHERE email = :email");
        $this->db->bind(':email', $email);
        
        $row = $this->db->single();
        
        // Check if we got a row
        if($row) {
            return true;
        } else {
            return false;
        }
    }

        //Login user
        public function login($email, $password){
            $this->db->query("SELECT sp.*, pp.* FROM service_providers sp LEFT JOIN provider_profiles pp ON sp.service_id = pp.service_id WHERE sp.email = :email");
            $this->db->bind(':email', $email);
            
            $row = $this->db->single();
            $hashed_password = $row->password;
            if(password_verify($password, $hashed_password)){
                return $row;
            } else {
                return false;
            }
        }

        public function getServiceById($id){
            $this->db->query("SELECT * FROM service_providers WHERE service_id = :service_id");
            $this->db->bind(':service_id', $id);
            $row = $this->db->single();
            return $row;
        }
    
}

?>