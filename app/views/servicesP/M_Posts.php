<?php
class M_Posts {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

        public function UploadEvent($data) {
            $this->db->query("INSERT INTO event_posts (title, event_date, location, description, guestCount, service_id) VALUES (:title, :event_date, :location, :description, :guestCount, :service_id)");
            // Bind values
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':event_date', $data['event_date']);
            $this->db->bind(':location', $data['location']);
            $this->db->bind(':description', $data['description']);
            $this->db->bind(':service_id', $data['service_id']);
            $this->db->bind(':guestCount', $data['guestCount']); 
            
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

    public function getEventPostsByServiceProvider($serviceId) {
        $this->db->query("SELECT * FROM event_posts WHERE service_id = :service_id and status = 'ON' ORDER BY created_at DESC");
        $this->db->bind(':service_id', $serviceId);
        $results = $this->db->resultSet();
        return $results;
    }

    public function getEventPostLikesById($eventId) {
        $this->db->query("SELECT * FROM event_posts WHERE event_id = :event_id and status = 'ON'");
        $this->db->bind(':event_id', $eventId);
        $row = $this->db->single();
        return $row->like_count;
    }

    public function EditEventPost($event_id, $data) {
        $this->db->query("UPDATE event_posts SET title = :title, event_date = :event_date, location = :location, description = :description WHERE event_id = :event_id");
        // Bind values
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':event_date', $data['event_date']);
        $this->db->bind(':location', $data['location']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':event_id', $event_id);

        // Execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function DeleteEventPost($event_id) {
        //we off the state 
        $this->db->query("UPDATE event_posts SET status = 'OFF' WHERE event_id = :event_id");
        // Bind value
        $this->db->bind(':event_id', $event_id);

        // Execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function AddMediaToEvent($event_id, $data) {
        $this->db->query("INSERT INTO event_media (service_id, event_id, file_path) VALUES (:service_id, :event_id, :file_path)");
        // Bind values
        $this->db->bind(':event_id', $event_id);
        $this->db->bind(':file_path', $data['file_path']);
        $this->db->bind(':service_id', $data['service_id']);

        // Execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function getMediaByServiceId($service_id) {
        $this->db->query("SELECT * FROM event_media WHERE service_id = :service_id");
        $this->db->bind(':service_id', $service_id);
        $results = $this->db->resultSet();
        return $results;
    }

    public function AddEventLikes($data) {
        $this->db->query("INSERT INTO event_likes (event_id, client_id) VALUES (:event_id, :client_id)");
        // Bind values
        $this->db->bind(':event_id', $data['event_id']);
        $this->db->bind(':client_id', $data['client_id']);

        // Execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function RemoveEventLikes($data) {
        $this->db->query("DELETE FROM event_likes WHERE event_id = :event_id AND client_id = :client_id");
        // Bind values
        $this->db->bind(':event_id', $data['event_id']);
        $this->db->bind(':client_id', $data['client_id']);

        // Execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function CheckLiked($event_id, $client_id) {
        $this->db->query("SELECT * FROM event_likes WHERE event_id = :event_id AND client_id = :client_id AND status = 'ON'");
        $this->db->bind(':event_id', $event_id);
        $this->db->bind(':client_id', $client_id);
        $row = $this->db->single();
        if($row){
            return true;
        } else {
            return false;
        }
    }

    public function getEventPostById($eventId) {
        $this->db->query("SELECT * FROM event_posts WHERE event_id = :event_id and status = 'ON'");
        $this->db->bind(':event_id', $eventId);
        $row = $this->db->single();
        return $row;
    }

    public function GetCommentsByEventId($eventId) {
        $this->db->query("SELECT * FROM event_comments WHERE event_id = :event_id AND status = 'ON' ORDER BY created_at DESC");
        $this->db->bind(':event_id', $eventId);
        $results = $this->db->resultSet();
        if($results){
            return $results;
        } else {
            return [];
        }
    }

    public function AddCommentToEvent($data) {
        $this->db->query("INSERT INTO event_comments (event_id, client_id, comment_text) VALUES (:event_id, :client_id, :comment_text)");
        // Bind values
        $this->db->bind(':event_id', $data['event_id']);
        $this->db->bind(':client_id', $data['client_id']);
        $this->db->bind(':comment_text', $data['comment_text']);

        // Execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }
   
}