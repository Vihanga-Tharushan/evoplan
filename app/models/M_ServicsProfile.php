 <?php 
    class M_ServicsProfile {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function getServiceProviderById($id){
            $this->db->query("SELECT * FROM service_providers WHERE id = :id");
            $this->db->bind(':id', $id);
            $row = $this->db->single();
            return $row;
        }



        public function updateProfile($data){
            $this->db->query("UPDATE provider_profiles SET profile_pic = :profile_pic, background_image = :background_image, intro = :intro WHERE service_id = :service_id");
            // Bind values
            $this->db->bind(':profile_pic', $data['profile_pic']);
            $this->db->bind(':background_image', $data['background_image']);
            $this->db->bind(':intro', $data['intro']);
            $this->db->bind(':service_id', $data['service_id']);
           
             // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function uploadAdditionalBackgroundImage($data, $imagenumber){
            $this->db->query("UPDATE provider_profiles SET background_img_$imagenumber = :image_path WHERE service_id = :service_id");
            // Bind values
            $this->db->bind(':image_path', $data["background-image-$imagenumber"]);
            $this->db->bind(':service_id', $data['service_id']);
           
             // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function getProfileById($service_id){
            $this->db->query("SELECT * FROM provider_profiles WHERE service_id = :service_id");
            $this->db->bind(':service_id', $service_id);
            $row = $this->db->single();
            return $row;
        }


        public function getProfileByServiceId($service_id){
            $this->db->query("SELECT * FROM v_provider_full_profile WHERE service_id = :service_id");
            $this->db->bind(':service_id', $service_id);
            $row = $this->db->single();
            return $row;
        }

        public function getAllServiceProviders(){
            $this->db->query("SELECT * FROM v_provider_full_profile");
            $rows = $this->db->resultSet();
            return $rows;
        }

        public function getFavoriteProvidersWithDetails($client_id){
            $this->db->query("SELECT * FROM v_provider_full_profile WHERE service_id IN (SELECT service_id FROM favorite_providers WHERE client_id = :client_id)");
             // Bind values
            $this->db->bind(':client_id', $client_id);
            return $this->db->resultSet();
        }

         public function addFavoriteProvider($client_id, $service_id) {
            $this->db->query("INSERT INTO favorites (client_id, service_id) VALUES (:client_id, :service_id)");
             // Bind values
            $this->db->bind(':client_id', $client_id);
            $this->db->bind(':service_id', $service_id);
           
             // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }
    }
?>