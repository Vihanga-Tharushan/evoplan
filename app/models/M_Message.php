<?php
class M_Message {  

    private $db;

    public function __construct(){
        $this->db = new Database;
    }


    public function sendMessage($data) {
        $this->db->query('INSERT INTO messages (conversation_id, sender_type,sender_id,message_text) VALUES (:conversation_id, :sender_type, :sender_id, :message_text)');
        $this->db->bind(':conversation_id', $data['conversation_id']);
        $this->db->bind(':sender_type', $data['sender_type']);
        $this->db->bind(':sender_id', $data['sender_id']);
        $this->db->bind(':message_text', $data['message_text']);
        
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function getMessagesByID($conversation_id) {
        $this->db->query('SELECT * FROM messages WHERE conversation_id = :conversation_id');
        $this->db->bind(':conversation_id', $conversation_id);
        
        $results = $this->db->resultSet();
        return $results;
    }

    public function checkConversationExists($client_id, $provider_id) {
        $this->db->query('SELECT * FROM conversations WHERE client_id = :client_id AND provider_id = :provider_id');
        $this->db->bind(':client_id', $client_id);
        $this->db->bind(':provider_id', $provider_id);
        
        $row = $this->db->single();
        
        if($row){
            return $row;
        } else {
            return false;
        }
    }

    public function createConversation($client_id, $provider_id) {
        $this->db->query('INSERT INTO conversations (client_id, provider_id) VALUES (:client_id, :provider_id)');
        $this->db->bind(':client_id', $client_id);
        $this->db->bind(':provider_id', $provider_id);
        
        if($this->db->execute()){

            return true;
        } else {
            return false;
        }
    }

    //this returns all conversation ID between a client and the providers
    public function getConversationProfiles($client_id): mixed {
        $this->db->query('SELECT * FROM v_conversations_with_provider WHERE client_id = :client_id');
        $this->db->bind(':client_id', $client_id); 
       
        $results = $this->db->resultSet();
        return $results;
        
    }

    public function getConversationProfilesForProvider($provider_id): mixed {

        $this->db->query('SELECT * FROM v_conversations_with_client WHERE provider_id = :provider_id');
        $this->db->bind(':provider_id', $provider_id);
       
        $results = $this->db->resultSet();
        return $results;
    }


    public function updateMessage($data) {
        $this->db->query('UPDATE messages SET message_text = :message_text WHERE message_id = :message_id');
        $this->db->bind(':message_text', $data['message_text']);
        $this->db->bind(':message_id', $data['message_id']);
        
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }


    public function deleteMessage($message_id) {
        $this->db->query('UPDATE messages SET sender_deleted = 1 WHERE message_id = :message_id');
        $this->db->bind(':message_id', $message_id);
        
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }


   

}?>