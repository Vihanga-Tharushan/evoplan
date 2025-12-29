<?php

class M_notification{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function createNotification($data){
        $this->db->query("INSERT INTO notifications (sender_type, sender_id, receiver_type, receiver_id, title, message, event_id, package_id, is_read, created_at) VALUES (:sender_type, :sender_id, :receiver_type, :receiver_id, :title, :message, :event_id, :package_id, :is_read, :created_at)");
        
        // Bind values
        $this->db->bind(':sender_type', $data['sender_type']);
        $this->db->bind(':sender_id', $data['sender_id']);
        $this->db->bind(':receiver_type', $data['receiver_type']);
        $this->db->bind(':receiver_id', $data['receiver_id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':message', $data['message']);
        $this->db->bind(':event_id', $data['event_id']);
        $this->db->bind(':package_id', $data['package_id']);
        $this->db->bind(':is_read', $data['is_read']);
        $this->db->bind(':created_at', $data['created_at']);

        // Execute
        return $this->db->execute();
    }
}
?>