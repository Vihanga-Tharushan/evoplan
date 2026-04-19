<?php
class Message extends Controller {

    private $messageModel;  

    public function __construct() {
        
        $this->messageModel = $this->model('M_Message');
    
    }


    public function sendMessage() {
        // Check if the request method is POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            // Get the raw POST data
            $inputdata = json_decode(file_get_contents("php://input"), true);
            
            // Get the message from POST data
            $messageText = trim($inputdata['message']);

            $data['message_text'] = $messageText;
            $data['conversation_id'] = $inputdata['conversation_id'];
            $data['sender_type'] = $inputdata['sender_type'];
            $data['sender_id'] = $inputdata['sender_id'];
            $data['status'] = $inputdata['status'];

            // Validate the message
            if (empty($messageText)) {
                echo json_encode(['status' => 'error', 'message' => 'Message cannot be empty.']);
                return;
            }

            // Check if this is a coordinator message (sender_type = 'ISSUE_COORDINATOR')
            if ($data['sender_type'] === 'ISSUE_COORDINATOR') {
                // Use IC message endpoint
                $result = $this->messageModel->sendICMessage($data);
            } else {
                // Use regular message endpoint for client-provider conversations
                $result = $this->messageModel->sendMessage($data);
            }

             if ($result) {
                 echo json_encode(['status' => 'success', 'message' => 'Message sent successfully.']);
             } else {
                 echo json_encode(['status' => 'error', 'message' => 'Failed to send message.']);
             }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
        }

 
    }

    public function fetchMessagesbyID($conversation_id) {
        // Check if the request method is GET
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            // Check if this is an IC conversation (coordinator messaging)
            $isICMessage = isset($_GET['is_ic_message']) && $_GET['is_ic_message'] === 'true';
            
            // Fetch messages using the appropriate model method
            if ($isICMessage) {
                $messages = $this->messageModel->getICMessagesByConversationID($conversation_id);
            } else {
                $messages = $this->messageModel->getMessagesByID($conversation_id);
            }
            
            // Return messages as JSON
            echo json_encode(['status' => 'success', 'messages' => $messages]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
        }
    }

    public function updateMessage(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Get the raw POST data
            $inputdata = json_decode(file_get_contents("php://input"), true);

            $message_id = $inputdata['message_id'];
            $new_text = trim($inputdata['message']);
            $isICMessage = isset($inputdata['is_ic_message']) && $inputdata['is_ic_message'] === true;

            // Validate the new message text
            if(empty($new_text)){
                echo json_encode(['status' => 'error', 'message' => 'Message cannot be empty.']);
                return;
            }

            $data =[
                'message_id' => $message_id,
                'message_text' => $new_text
            ];

            // Update the message using the appropriate model method
            if ($isICMessage) {
                $result = $this->messageModel->updateICMessage($data);
            } else {
                $result = $this->messageModel->updateMessage($data);
            }
            
            if($result){
                echo json_encode(['status' => 'success', 'message' => 'Message updated successfully.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to update message.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
        }
    }

    public function deleteMessage(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Get the raw POST data
            $inputdata = json_decode(file_get_contents("php://input"), true);

            $message_id = $inputdata['message_id'];
            $isICMessage = isset($inputdata['is_ic_message']) && $inputdata['is_ic_message'] === true;

            // Delete the message using the appropriate model method
            if ($isICMessage) {
                $result = $this->messageModel->deleteICMessage($message_id);
            } else {
                $result = $this->messageModel->deleteMessage($message_id);
            }
            
            if($result){
                echo json_encode(['status' => 'success', 'message' => 'Message deleted successfully.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to delete message.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
        }
    }


}

?>