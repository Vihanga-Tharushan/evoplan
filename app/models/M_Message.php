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

    // ============= COORDINATOR CONVERSATIONS (NEW) =============
    
    public function checkCoordinatorConversationExists($ic_id, $receiver_type, $receiver_id) {
        $this->db->query('SELECT * FROM coordinator_conversations 
                         WHERE ic_id = :ic_id 
                         AND receiver_type = :receiver_type 
                         AND receiver_id = :receiver_id');
        $this->db->bind(':ic_id', $ic_id);
        $this->db->bind(':receiver_type', $receiver_type);
        $this->db->bind(':receiver_id', $receiver_id);
        
        $row = $this->db->single();
        return $row ? $row : false;
    }

    public function createCoordinatorConversation($ic_id, $receiver_type, $receiver_id) {
        $this->db->query('INSERT INTO coordinator_conversations (ic_id, receiver_type, receiver_id) 
                         VALUES (:ic_id, :receiver_type, :receiver_id)');
        $this->db->bind(':ic_id', $ic_id);
        $this->db->bind(':receiver_type', $receiver_type);
        $this->db->bind(':receiver_id', $receiver_id);
        
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function checkOrCreateCoordinatorConversation($ic_id, $receiver_type, $receiver_id) {
        // Check if conversation already exists
        $conversation = $this->checkCoordinatorConversationExists($ic_id, $receiver_type, $receiver_id);
        
        if ($conversation) {
            return $conversation;
        }
        
        // Create new conversation if it doesn't exist
        if ($this->createCoordinatorConversation($ic_id, $receiver_type, $receiver_id)) {
            return $this->checkCoordinatorConversationExists($ic_id, $receiver_type, $receiver_id);
        }
        
        return false;
    }

    public function getCoordinatorConversations($ic_id): mixed {
        $this->db->query('SELECT 
                cc.conversation_id,
                cc.ic_id,
                cc.receiver_type,
                cc.receiver_id,
                cc.last_message,
                cc.last_message_time,
                
                CASE 
                    WHEN cc.receiver_type = "CLIENT" THEN cc.receiver_id
                    ELSE NULL
                END AS client_id,
                
                CASE
                    WHEN cc.receiver_type = "PROVIDER" THEN cc.receiver_id
                    ELSE NULL
                END AS provider_id,
                
                CASE 
                    WHEN cc.receiver_type = "CLIENT" THEN c.name
                    WHEN cc.receiver_type = "PROVIDER" THEN CONCAT(COALESCE(sp.fname, ""), " ", COALESCE(sp.lname, ""))
                    ELSE "Unknown User"
                END AS receiver_name,
                
                CASE
                    WHEN cc.receiver_type = "CLIENT" THEN c.name
                    WHEN cc.receiver_type = "PROVIDER" THEN CONCAT(COALESCE(sp.fname, ""), " ", COALESCE(sp.lname, ""))
                    ELSE "Unknown User"
                END AS client_name,
                
                CASE
                    WHEN cc.receiver_type = "CLIENT" THEN COALESCE(c.profile_pic, "default.png")
                    WHEN cc.receiver_type = "PROVIDER" THEN COALESCE(pp.profile_pic, "default.png")
                    ELSE "default.png"
                END AS profile_pic
                
            FROM coordinator_conversations cc
            LEFT JOIN clients c ON cc.receiver_type = "CLIENT" AND cc.receiver_id = c.client_id
            LEFT JOIN service_providers sp ON cc.receiver_type = "PROVIDER" AND cc.receiver_id = sp.service_id
            LEFT JOIN provider_profiles pp ON cc.receiver_type = "PROVIDER" AND sp.service_id = pp.service_id
            
            WHERE cc.ic_id = :ic_id
            ORDER BY COALESCE(cc.last_message_time, "1970-01-01") DESC');
        
        $this->db->bind(':ic_id', $ic_id);
        $results = $this->db->resultSet();
        return $results;
    }

    // ============= IC MESSAGES =============
    
    public function sendICMessage($data) {
        $this->db->query('INSERT INTO ic_messages (conversation_id, sender_id, sender_type, message_text) 
                         VALUES (:conversation_id, :sender_id, :sender_type, :message_text)');
        $this->db->bind(':conversation_id', $data['conversation_id']);
        $this->db->bind(':sender_id', $data['sender_id']);
        $this->db->bind(':sender_type', $data['sender_type']);
        $this->db->bind(':message_text', $data['message_text']);
        
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function getICMessagesByConversationID($conversation_id) {
        $this->db->query('SELECT 
                im.message_id,
                im.conversation_id,
                im.sender_id,
                im.message_text,
                im.is_seen,
                im.sender_deleted,
                im.receiver_deleted,
                im.created_at,
                im.sender_type,
                
                -- Get sender name based on sender_type
                CASE 
                    WHEN im.sender_type = "CLIENT" THEN c.name
                    WHEN im.sender_type = "PROVIDER" THEN CONCAT(COALESCE(sp.fname, ""), " ", COALESCE(sp.lname, ""))
                    WHEN im.sender_type = "ISSUE_COORDINATOR" THEN "Issue Coordinator"
                    ELSE "Unknown User"
                END AS sender_name,
                
                -- Get receiver info from coordinator_conversations
                cc.receiver_type,
                cc.receiver_id,
                
                -- Get receiver name based on receiver_type
                CASE 
                    WHEN cc.receiver_type = "CLIENT" THEN rc.name
                    WHEN cc.receiver_type = "PROVIDER" THEN CONCAT(COALESCE(rsp.fname, ""), " ", COALESCE(rsp.lname, ""))
                    ELSE "Unknown User"
                END AS receiver_name
                
            FROM ic_messages im
            JOIN coordinator_conversations cc ON im.conversation_id = cc.conversation_id
            
            -- Left joins for sender details
            LEFT JOIN clients c ON im.sender_type = "CLIENT" AND im.sender_id = c.client_id
            LEFT JOIN service_providers sp ON im.sender_type = "PROVIDER" AND im.sender_id = sp.service_id
            
            -- Left joins for receiver details
            LEFT JOIN clients rc ON cc.receiver_type = "CLIENT" AND cc.receiver_id = rc.client_id
            LEFT JOIN service_providers rsp ON cc.receiver_type = "PROVIDER" AND cc.receiver_id = rsp.service_id
            
            WHERE im.conversation_id = :conversation_id
            ORDER BY im.created_at ASC');
        
        $this->db->bind(':conversation_id', $conversation_id);
        
        $results = $this->db->resultSet();
        return $results;
    }

    public function updateICMessage($data) {
        $this->db->query('UPDATE ic_messages SET message_text = :message_text WHERE message_id = :message_id');
        $this->db->bind(':message_text', $data['message_text']);
        $this->db->bind(':message_id', $data['message_id']);
        
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function deleteICMessage($message_id) {
        $this->db->query('UPDATE ic_messages SET sender_deleted = 1 WHERE message_id = :message_id');
        $this->db->bind(':message_id', $message_id);
        
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function getOrCreateProviderICConversation($service_id) {
        $conversation = $this->getCoordinatorConversationForProvider($service_id);
        
        if ($conversation) {
            return $conversation;
        }
        
        return $this->createProviderICConversation($service_id);
    }

    // ============= CLIENT IC CONVERSATIONS =============
    
    public function getCoordinatorConversationForClient($client_id) {
        $this->db->query('SELECT 
                cc.conversation_id,
                cc.ic_id,
                cc.receiver_type,
                cc.receiver_id,
                cc.last_message,
                cc.last_message_time,
                "Issue Coordinator" AS name,
                "ic_avatar.png" AS profile_pic,
                :client_id as client_id,
                NULL AS provider_id,
                "IC" as conversation_type
            FROM coordinator_conversations cc
            WHERE cc.receiver_type = "CLIENT" 
            AND cc.receiver_id = :client_id
            LIMIT 1');
        
        $this->db->bind(':client_id', $client_id);
        return $this->db->single();
    }

    public function createClientICConversation($client_id) {
        $this->db->query('INSERT INTO coordinator_conversations (ic_id, receiver_type, receiver_id) 
                         VALUES (1, "CLIENT", :client_id)');
        $this->db->bind(':client_id', $client_id);
        
        if($this->db->execute()){
            return $this->getCoordinatorConversationForClient($client_id);
        } else {
            return false;
        }
    }

    public function getOrCreateClientICConversation($client_id) {
        $conversation = $this->getCoordinatorConversationForClient($client_id);
        
        if ($conversation) {
            return $conversation;
        }
        
        return $this->createClientICConversation($client_id);
    }

    // ============= PROVIDER IC CONVERSATIONS =============

    public function getCoordinatorConversationForProvider($service_id) {
        $this->db->query('SELECT 
                cc.conversation_id,
                cc.ic_id,
                cc.receiver_type,
                cc.receiver_id,
                cc.last_message,
                cc.last_message_time,
                "Issue Coordinator" AS name,
                "ic_avatar.png" AS profile_pic,
                NULL AS client_id,
                :service_id as provider_id,
                "IC" as conversation_type
            FROM coordinator_conversations cc
            WHERE cc.receiver_type = "PROVIDER" 
            AND cc.receiver_id = :service_id
            LIMIT 1');
        
        $this->db->bind(':service_id', $service_id);
        return $this->db->single();
    }

    public function createProviderICConversation($service_id) {
        $this->db->query('INSERT INTO coordinator_conversations (ic_id, receiver_type, receiver_id) 
                         VALUES (1, "PROVIDER", :service_id)');
        $this->db->bind(':service_id', $service_id);
        
        if($this->db->execute()){
            return $this->getCoordinatorConversationForProvider($service_id);
        } else {
            return false;
        }
    }


    public function getConversationsForCoordinator(): mixed {
        $this->db->query('SELECT DISTINCT 
                cc.conversation_id,
                cc.ic_id,
                cc.receiver_type,
                cc.receiver_id,
                cc.last_message,
                cc.last_message_time,
                
                -- Client details (if receiver is CLIENT)
                CASE 
                    WHEN cc.receiver_type = "CLIENT" THEN c.name
                    WHEN cc.receiver_type = "PROVIDER" THEN CONCAT(sp.fname, " ", sp.lname)
                END AS receiver_name,
                
                CASE
                    WHEN cc.receiver_type = "CLIENT" THEN c.profile_pic
                    WHEN cc.receiver_type = "PROVIDER" THEN pp.profile_pic
                END AS profile_pic,
                
                -- For compatibility with old code
                c.client_id,
                sp.service_id as provider_id,
                cc.receiver_type
                
            FROM coordinator_conversations cc
            LEFT JOIN clients c ON cc.receiver_type = "CLIENT" AND cc.receiver_id = c.client_id
            LEFT JOIN service_providers sp ON cc.receiver_type = "PROVIDER" AND cc.receiver_id = sp.service_id
            LEFT JOIN provider_profiles pp ON sp.service_id = pp.service_id
            
            ORDER BY cc.last_message_time DESC NULLS LAST');
       
        $results = $this->db->resultSet();
        return $results;
    }

    // ============= COORDINATOR CLIENT CONVERSATIONS =============
    
    public function getCoordinatorClientConversations($ic_id): mixed {
        $this->db->query('SELECT 
                cc.conversation_id,
                cc.ic_id,
                cc.receiver_type,
                cc.receiver_id,
                cc.last_message,
                cc.last_message_time,
                c.name,
                c.profile_pic,
                c.client_id,
                NULL AS provider_id,
                "COORDINATOR_CLIENT" as conversation_type
            FROM coordinator_conversations cc
            LEFT JOIN clients c ON cc.receiver_type = "CLIENT" AND cc.receiver_id = c.client_id
            WHERE cc.ic_id = :ic_id
            AND cc.receiver_type = "CLIENT"
            ORDER BY COALESCE(cc.last_message_time, "1970-01-01") DESC');
        
        $this->db->bind(':ic_id', $ic_id);
        return $this->db->resultSet();
    }

    // ============= COORDINATOR PROVIDER CONVERSATIONS =============
    
    public function getCoordinatorProviderConversations($ic_id): mixed {
        $this->db->query('SELECT 
                cc.conversation_id,
                cc.ic_id,
                cc.receiver_type,
                cc.receiver_id,
                cc.last_message,
                cc.last_message_time,
                CONCAT(sp.fname, " ", sp.lname) AS name,
                pp.profile_pic,
                NULL AS client_id,
                sp.service_id as provider_id,
                "COORDINATOR_PROVIDER" as conversation_type
            FROM coordinator_conversations cc
            LEFT JOIN service_providers sp ON cc.receiver_type = "PROVIDER" AND cc.receiver_id = sp.service_id
            LEFT JOIN provider_profiles pp ON sp.service_id = pp.service_id
            WHERE cc.ic_id = :ic_id
            AND cc.receiver_type = "PROVIDER"
            ORDER BY COALESCE(cc.last_message_time, "1970-01-01") DESC');
        
        $this->db->bind(':ic_id', $ic_id);
        return $this->db->resultSet();
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