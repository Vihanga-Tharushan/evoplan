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

    public function getUnreadByUser($type, $id) {
        $this->db->query("SELECT * FROM notifications WHERE receiver_type = :type AND receiver_id = :id AND is_read = 'OFF' AND status = 'ON' ORDER BY created_at DESC");

        $this->db->bind(':type', $type);
        $this->db->bind(':id', $id);

        return $this->db->resultSet();
    }

    public function getAllByUser($type, $id) {
        $this->db->query("SELECT * FROM notifications WHERE receiver_type = :type AND receiver_id = :id AND status = 'ON' ORDER BY created_at DESC");

        $this->db->bind(':type', $type);
        $this->db->bind(':id', $id);

        return $this->db->resultSet();
    }

    public function markAsRead($notificationId) {
        $this->db->query("UPDATE notifications SET is_read = 'ON', read_at = NOW() WHERE notification_id = :notification_id");
        $this->db->bind(':notification_id', $notificationId);
        return $this->db->execute();
    }

    public function markAllAsRead($type, $id) {
        $this->db->query("UPDATE notifications SET is_read = 'ON', read_at = NOW() WHERE receiver_type = :type AND receiver_id = :id AND is_read = 'OFF'");
        $this->db->bind(':type', $type);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function deleteNotification($notificationId) {
        $this->db->query("UPDATE notifications SET status = 'OFF' WHERE notification_id = :notification_id");
        $this->db->bind(':notification_id', $notificationId);
        return $this->db->execute();
    }

    public function getNotificationStats($type, $id) {
        $this->db->query("SELECT 
            COUNT(*) as total,
            SUM(CASE WHEN is_read = 'OFF' THEN 1 ELSE 0 END) as unread,
            SUM(CASE WHEN DATE(created_at) = CURDATE() THEN 1 ELSE 0 END) as today
            FROM notifications 
            WHERE receiver_type = :type AND receiver_id = :id AND status = 'ON'");
        
        $this->db->bind(':type', $type);
        $this->db->bind(':id', $id);
        
        return $this->db->single();
    }

}
?>