<?php
class M_Landing {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getLandingPhotos() {
        try {
            // Fetch only ACTIVE photos from landing_photos table
            $this->db->query("SELECT photo_id, event_name, event_photo_name FROM landing_photos WHERE status = 'ACTIVE' ORDER BY photo_id DESC");
            $result = $this->db->resultSet();
            
            // Debug logging
            error_log("Landing photos query executed");
            error_log("Result type: " . gettype($result));
            
            // Handle different return types
            if($result === false) {
                error_log("Database query returned false - check table exists");
                return [];
            }
            
            if(is_array($result) && count($result) > 0) {
                error_log("Found " . count($result) . " active photos");
                return $result;
            }
            
            error_log("No photos found in database (empty result set or no rows with status='ACTIVE')");
            return [];
        } catch (Exception $e) {
            error_log("Error fetching landing photos: " . $e->getMessage());
            return [];
        }
    }
}
?>