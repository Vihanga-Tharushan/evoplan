<?php
    class Posts extends Controller {
        private $postModel;

        public function __construct(){
            $this->postModel = $this->model('M_Posts');
        }

        //creation of event post
        public function UploadEvent(){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                
                // Process event upload
                
                // Sanitize POST data
                //$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data =[
                        'title' => trim($_POST['title']),
                        'event_date' => trim($_POST['event_date']),
                        'location' => trim($_POST['location']),
                        'description' => trim($_POST['description']),
                        'service_id' => $_SESSION['service_id'],

                        'title_err' => '',
                        'event_date_err' => '',
                        'location_err' => '',
                        'description_err' => '',

                ];

                //validations can be added here
                if(empty($data['title'])){
                    $data['title_err'] = 'Please enter event title';
                }
                if(empty($data['event_date'])){
                    $data['event_date_err'] = 'Please enter event date';
                }
                if(empty($data['location'])){
                    $data['location_err'] = 'Please enter event location';
                }
                if(empty($data['description'])){
                    $data['description_err'] = 'Please enter event description';
                }
                // Make sure errors are empty
                if(empty($data['title_err']) && empty($data['event_date_err']) && empty($data['location_err']) && empty($data['description_err'])){
                    // Validated

                    // TO DO: Add event to database
                    if($this->postModel->UploadEvent($data)){
                        flash('event_message', 'Event uploaded successfully');
                        redirect('Service/profile');
                    }else{
                        die('Something went wrong');
                    }
                }else{
                    // Load view with errors
                    $this->view('servicesP/EventPosts/v_s_uploadEvent', $data);
                }

            
            }else{

                $data =[
                    'title' => '',
                    'event_date' => '',
                    'location' => '',
                    'description' => '',

                    'title_err' => '',
                    'event_date_err' => '',
                    'location_err' => '',
                    'description_err' => '',
                ];
                $this->view('servicesP/EventPosts/v_s_uploadEvent', $data);
            }
        }

        //update event post
        public function EditEventPost($event_id){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form data
                $data =[
                    'event_id' => $event_id,
                    'title' => trim($_POST['title']),
                    'event_date' => trim($_POST['event_date']),
                    'location' => trim($_POST['location']),
                    'description' => trim($_POST['description']),

                    'title_err' => '',
                    'event_date_err' => '',
                    'location_err' => '',
                    'description_err' => '',
                ];

                // Validations can be added here
                if(empty($data['title'])){
                    $data['title_err'] = 'Please enter event title';
                }
                if(empty($data['event_date'])){
                    $data['event_date_err'] = 'Please enter event date';
                }

                if(empty($data['location'])){
                    $data['location_err'] = 'Please enter event location';
                }
                if(empty($data['description'])){
                    $data['description_err'] = 'Please enter event description';
                }

                // Make sure errors are empty
                if(empty($data['title_err']) && empty($data['event_date_err']) && empty($data['location_err']) && empty($data['description_err'])){
                    // Validated
                    if($this->postModel->EditEventPost($event_id, $data)){
                        flash('event_message', 'Event updated successfully');
                        redirect('Service/profile');
                    }else{
                        die('Something went wrong');
                    }
                }else{
                    // Load view with errors
                    $this->view('servicesP/EventPosts/v_s_editEventPost', $data);
                }
            }else{
                // Load existing event data
                $event = $this->postModel->getEventPostById($event_id);
                if($event){
                    $data =[
                        'event_id' => $event->event_id,
                        'title' => $event->title,
                        'event_date' => $event->event_date,
                        'location' => $event->location,
                        'description' => $event->description,

                        'title_err' => '',
                        'event_date_err' => '',
                        'location_err' => '',
                        'description_err' => '',
                    ];
                    $this->view('servicesP/EventPosts/v_s_editEventPost', $data);
                }else{
                    die('Event not found');
                }
            }
        }

        public function DeleteEventPost($event_id){

            if($this->postModel->DeleteEventPost($event_id)){
                flash('event_message', 'Event deleted successfully');
                redirect('Service/profile');
            }else{
                die('Something went wrong');
            }
        }

        public function AddMediaToEvent($event_id){
            // Implementation for adding media to event
            

            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                $event = $this->postModel->getEventPostById($event_id);
                // Process media upload
                // Handle file uploads and save media to database
                $data =[
                    'service_id' => $_SESSION['service_id'],
                    'event' => $event,
                    'event_id' => $event_id,
                    'fileInput' => $_FILES['fileInput'],
                    'file_path' => time() . '_' . $_FILES['fileInput']['name'],
                    'file_path_err' => '',
                ];

                if(empty($data['fileInput'])){
                    $data['file_path_err'] = 'Please upload a file';
                }
                //validated and upload file

                if(uploadImage($_FILES['fileInput']['tmp_name'], $data['file_path'],'/uploads/postsMedia/')){
                    
                }
                    // Validated
                if(empty($data['file_path_err'])){
                    if($this->postModel->AddMediaToEvent($data['event_id'], $data)){
                        flash('event_message', 'Media added successfully');
                        redirect('Service/profile');
                    }else{
                        die('Something went wrong');
                    }
                }else{
                    // Load view with errors
                    $this->view('servicesP/EventPosts/v_s_addMedia', $data);
                }




            }
            else{

            $event = $this->postModel->getEventPostById($event_id);
            $data = [
                'service_id' => $_SESSION['service_id'],
                'event' => $event,
                'event_id' => $event_id,
                'fileInput' => '',
                'file_path' => '',
                'media_type' => '',
                'file_path_err' => '',
                ];
        
                // Load the add media view
                $this->view('servicesP/EventPosts/v_s_addMedia', $data);
            }

        }
        
        public function LikeEvent(){
        // Check if it's an AJAX request
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get data from POST
            $data = json_decode(file_get_contents('php://input'), true);
            $event_id = $data['event_id'] ?? null;
            $client_id = $data['client_id'] ?? null;
            
            // Validate input
            if (!$event_id || !$client_id) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Missing event ID or client ID'
                ]);
                return;
            }
            
            // Check if already liked
            if($this->postModel->CheckLiked($event_id, $client_id)){
                $data = [
                    'event_id' => $event_id,
                    'client_id' => $client_id
                ];

                if($this->postModel->RemoveEventLikes($data)){
                    // Get updated like count
                    $like_count = $this->getUpdatedLikeCount($event_id);
                    echo json_encode([
                        'success' => true,
                        'message' => 'Like removed',
                        'liked' => false,
                        'like_count' => $like_count
                    ]);
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Failed to remove like'
                    ]);
                }
            } else {
                $data = [
                    'event_id' => $event_id,
                    'client_id' => $client_id
                ];

                if($this->postModel->AddEventLikes($data)){
                    // Get updated like count
                    $like_count = $this->getUpdatedLikeCount($event_id);
                    echo json_encode([
                        'success' => true,
                        'message' => 'Like added',
                        'liked' => true,
                        'like_count' => $like_count
                    ]);
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Failed to add like'
                    ]);
                }
            }
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid request method'
            ]);
        }
        }

        public function getUpdatedLikeCount($event_id){

        return $this->postModel->getEventPostById($event_id);

        }


        public function AddComment(){
        // Check if it's an AJAX request
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get data from POST
            $data = json_decode(file_get_contents('php://input'), true);
            $event_id = $data['event_id'] ?? null;
            $client_id = $_SESSION['client_id'] ?? null;
            $comment_text = $data['comment'] ?? null;
            
            // Validate input
            if (!$event_id || !$client_id || !$comment_text) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Missing event ID, client ID, or comment text'
                ]);
                return;
            }

            $data = [
                'event_id' => $event_id,
                'client_id' => $client_id,
                'comment_text' => $comment_text
            ];
            
            // Add comment to database
            if($this->postModel->AddCommentToEvent($data)){
                echo json_encode([
                    'success' => true,
                    'message' => 'Comment added successfully'
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Failed to add comment'
                ]);
            }
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid request method'
            ]);
        }
        }

        public function GetComments($event_id){
        // Fetch comments from database

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $comments = $this->postModel->GetCommentsByEventId($event_id);
        // Return comments as JSON
        echo json_encode([
            'status'=>'success',
            'comments'=>$comments
        ]);
        }else{
            echo json_encode([
                'status'=>'error',
                'message'=>'Invalid request method'
            ]);
        }
        }
}
