<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require_once APPROOT . '/libraries/PHPMailer/Exception.php';
    require_once APPROOT . '/libraries/PHPMailer/PHPMailer.php';
    require_once APPROOT . '/libraries/PHPMailer/SMTP.php';

    class Clients extends Controller {
        private $clientModel;

        private $packageModel;

        private $profileModel;

        private $ratingModel;

        private $availabilityModel;

        private $postModel;

        private $messageModel;

        private $eventModel;

        private $notificationModel;

        public function __construct(){

            $this->clientModel = $this->model('M_Client');
            $this->packageModel = $this->model('M_package');
            $this->profileModel = $this->model('M_ServicsProfile');
            $this->ratingModel = $this->model('M_ratings');
            $this->availabilityModel = $this->model('M_Availability');
            $this->postModel = $this->model('M_Posts');
            $this->messageModel = $this->model('M_Message');
            $this->eventModel = $this->model('M_Event');
            $this->notificationModel = $this->model('M_notification');

        }


        private function sendOtpEmail($email, $otp){
    $mail = new PHPMailer(true);

    try {
        // SMTP settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = '2023cs023@stu.ucsc.cmb.ac.lk';        // 🔴 YOUR GMAIL
        $mail->Password   = 'wsec epbh hyxg tzte';     // 🔴 APP PASSWORD
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Sender & receiver
        $mail->setFrom('chathusha15@gmail.com', 'EvoPlan');
        $mail->addAddress($email);

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'EvoPlan Email Verification';
        $mail->Body    = "
            <h2>Email Verification</h2>
            <p>Your 4-digit verification code is:</p>
            <h1 style='letter-spacing:3px;'>$otp</h1>
            <p>Do not share this code.</p>
        ";

        $mail->send();
        return true;

    } catch (Exception $e) {
        die('Mail Error: ' . $mail->ErrorInfo);
    }
}

        public function home(){

            $this->view('clients/v_home');

        }


        public function register(){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form data
                //input data
                $data =[
                        'name' => trim($_POST['name']),
                        'address' => trim($_POST['address']),
                        'email' => trim($_POST['email']),
                        'password' => trim($_POST['password']),
                        'confirm_password' => trim($_POST['confirm_password']),
                        'terms' => isset($_POST['terms']) ? true : false,

                        'name_err' => '',
                        'address_err' => '',
                        'email_err' => '',
                        'password_err' => '',
                        'confirm_password_err' => '',
                        'terms_err' => ''
                ];

                // Validate Name
                if(empty($data['name'])){
                    $data['name_err'] = 'Please enter your name';
                }
                // Validate Address
                if(empty($data['address'])){
                    $data['address_err'] = 'Please enter your address';
                }
                // Validate Email
                if(empty($data['email'])){
                    $data['email_err'] = 'Please enter your email';
                } else{
                    if($this->clientModel->findClientByEmail($data['email'])){
                        $data['email_err'] = 'Email is already taken';
                    }
                }

                // Validate Password
                if(empty($data['password'])){
                    $data['password_err'] = 'Please enter a password';
                } elseif(strlen($data['password']) < 6){
                    $data['password_err'] = 'Password must be at least 6 characters';
                }

                // Validate Confirm Password
                if(empty($data['confirm_password'])){
                    $data['confirm_password_err'] = 'Please confirm your password';
                }else{
                    if($data['password'] != $data['confirm_password']){
                        $data['confirm_password_err'] = 'Passwords do not match';
                    }
                }

                // Validate Terms and Conditions
                if(!$data['terms']){
                    $data['terms_err'] = 'You must accept the terms and conditions';
                }

                // Make sure errors are empty
                if(empty($data['name_err']) && empty($data['address_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err']) && empty($data['terms_err'])){
                    // Validated
                    // Register Client
                    if($this->clientModel->register($data)){
                        // Redirect to login
                        flash('register_success', 'You are registered and can log in');
                        redirect('Clients/login');
                    } else{
                        die('Something went wrong');
                    }
                } else{
                    // Load view with errors
                    $this->view('clients/v_register', $data);
                }
            }
            else{
                //if not post request, load the register view

                $data =[
                    'name' => '',
                    'address' => '',
                    'email' => '',
                    'password' => '',
                    'confirm_password' => '',
                    'terms' => false,

                    'name_err' => '',
                    'address_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => '',
                    'terms_err' => ''
                ];

                $this->view('clients/v_signup', $data);
            }
        }


        public function createClientSession($client){
            $_SESSION['client_id'] = $client->client_id;
            $_SESSION['client_email'] = $client->email;
            $_SESSION['client_name'] = $client->name;
            redirect('Clients/home');
        }

        public function login(){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form data
                $data =[
                        'email' => trim($_POST['email']),
                        'password' => trim($_POST['password']),

                        'email_err' => '',
                        'password_err' => ''
                ];

                // Validate Email
                if(empty($data['email'])){
                    $data['email_err'] = 'Please enter your email';
                }

                // Validate Password
                if(empty($data['password'])){
                    $data['password_err'] = 'Please enter your password';
                }

                // Check for user/email
                if($this->clientModel->findClientByEmail($data['email'])){
                    // User found
                } else{
                    $data['email_err'] = 'No client found with that email';
                }

                // Make sure errors are empty
                if(empty($data['email_err']) && empty($data['password_err'])){
                    // Validated
                    // Check and set logged in user
                    $loggedInClient = $this->clientModel->login($data['email'], $data['password']);
                    
                    if($loggedInClient){
                        // Create session
                        $this->createClientSession($loggedInClient);
                    } else{
                        $data['password_err'] = 'Password incorrect';

                        $this->view('Users/v_client_login', $data);
                    }
                } else{
                    // Load view with errors
                    $this->view('Users/v_client_login', $data);
                }
            }
            else{
                // Load the login view

                $data =[
                    'email' => '',
                    'password' => '',

                    'email_err' => '',
                    'password_err' => ''
                ];
                $this->view('Users/v_client_login', $data);
            }
        }

        public function logout(){
            // Unset session variables
            unset($_SESSION['client_id']);
            unset($_SESSION['client_email']);
            unset($_SESSION['client_name']);

            // Destroy the session
            session_destroy();

            // Redirect to login
            redirect('Clients/login');
        }
        
        public function allevents(){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form data
                redirect('Clients/allevents');
            }
            else{
                // Load the allevents view
                $this->view('clients/v_allevents');
            }
        }
        public function allservpro(){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form data
                redirect('Clients/allservpro');
            }
            else{
                // Load the allservpro view
                $this->view('clients/v_allservpro');
            }
        }
        public function packages(){

            $packages = $this->packageModel->getAllPackages();
            $data = [
                'packages' => $packages
            ];
            
            $this->view('clients/v_packages', $data);
        }
        public function payments(){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form data
                redirect('clients/payments');
            }
            else{
                // Load the payments view
                $this->view('clients/v_payments');
            }
        }

        public function previewEvent($event_id){
            
            $data = [
                'event_id' => $event_id
            ];
            // Load the previewEvent view
            $this->view('clients/event/v_previewEvent', $data);
        
        }

        public function getSessionSelectedPackages(){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                $inputdata = json_decode(file_get_contents("php://input"), true);
                $eventId = $inputdata['eventId'];
                // Fetch selected packages from session
                $selectedPackages = $this->eventModel->getSelectedPackages($eventId);
                echo json_encode(['packages' => $selectedPackages]);
            }
           
        }

        public function getEventDetails(){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                
                $inputdata = json_decode(file_get_contents("php://input"), true);
                // Fetch event details
                $eventId = $inputdata['eventId'];
                $eventDetails = $this->eventModel->getEventById($eventId);
                echo json_encode($eventDetails);
            }
           
        }
        public function profile(){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form data
                redirect('clients/profile');
            }
            else{
                // Load the profile view
                $this->view('clients/v_profile');
            }
        }

        public function profiles() {

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form data
                redirect('clients/profiles');
            }
            else{
                // Load the profiles view
                $this->view('clients/v_profiles');
            }
            
        }


        public function findServices($eventId){

            $data = [
                'eventId' => $eventId
            ];
            // Load the findServices view
            $this->view('clients/event/v_findServices', $data);
            
        }


        public function getRequiredServices($eventId){

            if($_SERVER['REQUEST_METHOD'] == 'GET'){
                 // Fetch required services for the event
                $requiredServices = $this->eventModel->getRequiredServicesByEventId($eventId);
                echo json_encode($requiredServices);
            }
           
        }
        public function viewpackage(){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form data
                redirect('clients/viewpackage');
            }
            else{
                // Load the viewpackage view
                $this->view('clients/v_viewpackage');
            }
        }
        public function allfinalpayment(){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form data
                redirect('clients/allfinalpayment');
            }
            else{
                // Load the allfinalpayment view
                $this->view('clients/v_allfinalpayment');
            }
        }
        public function allphotography(){

            // Load the allphotography view
            $this->view('clients/v_allphotography');
        
        }

        public function viewprovider($id){

            $profile = $this->profileModel->getProfileByServiceId($id);
            $rating = $this->ratingModel->getRatingsSummary($id);
            $availability = $this->availabilityModel->getAvailabilityByServiceProvider($id);
            $EventsPosts = $this->postModel->getEventPostsByServiceProvider($id);
            $EventMedia = $this->postModel->getMediaByServiceId($id);
            $data = [
                'profile' => $profile,
                'rating' => $rating,
                'availability' => $availability,
                'EventsPosts' => $EventsPosts,
                'EventMedia' => $EventMedia
            ];
            $this->view('clients/serviceProviderprofile/serviceProviderprofile', $data);
        }
        public function allvenues(){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form data
                redirect('clients/allvenues');
            }
            else{
                // Load the allvenues view
                $this->view('clients/v_allvenue');
            }
        }
        public function allmusic(){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form data
                redirect('clients/allmusic');
            }
            else{
                // Load the allmusic view
                $this->view('clients/v_allmusic');
            }
        }
        public function allcakedesigners(){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form data
                redirect('clients/allcakedesigners');
            }
            else{
                // Load the allcakedesigners view
                $this->view('clients/v_cakedesigners');
            }
        }
        public function alldecorators(){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form data
                redirect('clients/alldecorators');
            }
            else{
                // Load the alldecorators view
                $this->view('clients/v_alldecorators');
            }
        }
        
        public function allequipments(){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form data
                redirect('clients/allequipments');
            }
            else{
                // Load the allequipments view
                $this->view('clients/v_allequipments');
            }
        }

        public function allentertainers(){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form data
                redirect('clients/allentertainers');
            }
            else{
                // Load the allentertainers view
                $this->view('clients/v_allentertainers');
            }
        }

        public function alltransport(){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form data
                redirect('clients/alltransport');
            }
            else{
                // Load the alltransport view
                $this->view('clients/v_alltransport');
            }
        }
        public function chatbox(){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form data
                redirect('clients/chatbox');
            }
            else{
                // Load the chatbox view
                $this->view('clients/v_chatbox');
            }
        }
        public function allvenuep(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form data
                redirect('clients/allvenuep');
            }
            else{
                // Load the allvenuep view
                $this->view('clients/v_allvenuep');
            }
        }

        public function allphotographyp(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form data
                redirect('clients/allphotographyp');
            }
            else{
                // Load the allphotographyp view
                $this->view('clients/v_allphotographyp');
            }
        }

        public function musics(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form data
                redirect('clients/musics');
            }
            else{
                // Load the musics view
                $this->view('clients/v_musics');
            }
        }

        public function  allcakes(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form data
                redirect('clients/allcakes');
            }
            else{
                // Load the allcakes view
                $this->view('clients/v_allcakes');
            }
        }

        public function alldecoratorsp(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form data
                redirect('clients/alldecoratorsp');
            }
            else{
                // Load the alldecoratorsp view
                $this->view('clients/v_alldecoratorsp');
            }
        }

        public function allequipmentsp(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form data
                redirect('clients/allequipmentsp');
            }
            else{
                // Load the allequipmentsp view
                $this->view('clients/v_allequipmentsp');
            }
        }
        public function allhosts(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form data
                redirect('clients/allhosts');
            }
            else{
                // Load the allhosts view
                $this->view('clients/v_allhosts');
            }
        }

        public function alltransportp(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form data
                redirect('clients/alltransportp');
            }
            else{
                // Load the alltransportp view
                $this->view('clients/v_alltransportp');
            }
        }

        public function portfolio(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form data
                redirect('clients/portfolio');
            }
            else{
                // Load the portfolio view
                $this->view('clients/v_portfolio');
            }
        }
        public function terms(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form data
                redirect('clients/terms');
            }
            else{
                // Load the terms view
                $this->view('clients/v_terms');
            }
        }

        public function createEvent(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                
                $inputdata = json_decode(file_get_contents("php://input"), true);
                // Process event creation
                
                $data['event_name'] = $inputdata['eventName'];
                $data['event_type'] = $inputdata['eventType'];
                $data['event_description'] = $inputdata['eventDescription'];
                $data['start_datetime'] = $inputdata['startDate'];
                $data['end_datetime'] = $inputdata['endDate'];
                $data['guest_count'] = $inputdata['guestCount'];
                $data['venue_address'] = $inputdata['venueAddress'];
                $data['venue_type'] = $inputdata['haveVenue'];
                $data['client_id'] = $_SESSION['client_id'];
                $serviceList = $inputdata['services']; //array of service IDs



                //check if client has an event at that moment
                if($this->eventModel->checkEventHasThisTime($data)){
                    //client has an event at that time
                    echo json_encode(['error' => 'You already have an event scheduled during this time. Please choose a different time.']);
                    return;
                }
                // Save event to database
                $eventId = $this->eventModel->createEvent($data);

                // Save services for the event
                foreach($serviceList as $service_type_id){
                    $this->eventModel->addServiceNeedToEvent($eventId, $service_type_id);
                }

                echo json_encode(["eventId" => $eventId]);
            }
            else{
                // Load the createEvent view
                $this->view('clients/event/v_createEvent');
            }
        }

        public function addPackageToEvent(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                
                $inputdata = json_decode(file_get_contents("php://input"), true);
                // Process adding package to event
                
                $eventId = $inputdata['eventId'];
                $packageIds = $inputdata['packageIds'];
                $serviceOwnerIds = $inputdata['ownerIds'];
                $clientId = $_SESSION['client_id'];

                $addedCount = 0;
                for($i = 0; $i < count($packageIds); $i++){
                    $packageId = $packageIds[$i];
                    $ownerId = $serviceOwnerIds[$i];
                    //check if package already added to event
                    if($this->eventModel->checkPackageInEvent($eventId, $packageId)){
                        //package already added
                        continue; //skip to next package
                    }
                    // Add package to event in database
                    if($this->eventModel->addPackageToEvent($eventId, $packageId, $ownerId, $clientId)){
                        $addedCount++;
                    } else {
                        echo json_encode(['error' => 'Failed to add package ID ' . $packageId . ' to event.']);
                        return;
                    }
                }

                // After all packages processed, check and update progress if needed
                if($addedCount > 0 && $this->eventModel->checkEventProgress($eventId) === 33){

                    $this->eventModel->updateEventProgress($eventId, 66, 'STEP_2_PACKAGES');
                    echo json_encode(['status' => 'success', 'message' => 'Packages added and progress updated', 'added' => $addedCount]);
                    
                } else {
                    echo json_encode(['status' => 'success', 'message' => 'Packages processed', 'added' => $addedCount]);
                }

            }
        }

        //about package addition notification to service provider
        public function sendPackageNotification($serviceProviderId, $eventId, $packageId){
            
            $event = $this->eventModel->getEventById($eventId);
            $package = $this->packageModel->getPackageById($packageId);
            $client = $this->clientModel->getClientById($event->client_id);

            // Use helper function to send notification
            $notificationResult = sendPackageNotification(
                $serviceProviderId, 
                $event, 
                $package, 
                $client
            );
            
        }
        public function feedback(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form data
                redirect('clients/feedback');
            }
            else{
                // Load the feedback view
                $this->view('clients/v_feedback');
            }
        }
        public function complains(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form data
                redirect('clients/complains');
            }
            else{
                // Load the complains view
                $this->view('clients/v_complains');
            }
        }
        public function spro(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form data
                redirect('clients/spro');
            }
            else{
                // Load the spro view
                $this->view('clients/v_spro');
            }
        }
        
        public function pawani(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form data
                redirect('clients/pawani');
            }
            else{
                // Load the pawani view
                $this->view('clients/v_pawani');
            }
        }

        public function finaleventview(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form data
                redirect('clients/finaleventview');
            }
            else{
                // Load the finaleventview view
                $this->view('clients/v_finaleventview');
            }
        }

        public function chats(){

            $conversationsList = $this->messageModel->getConversationProfiles($_SESSION['client_id']);

            $data = [
                'conversationsList' => $conversationsList
            ];

            $this->view('clients/chats/v_mainChat', $data);
        }

        public function myevents(){
    
            $upcomingEvents = $this->eventModel->getUpcomingEventsByClientId($_SESSION['client_id']);
            $previousEvents = $this->eventModel->getPreviousEventsByClientId($_SESSION['client_id']);
            
            $data = [
                'upcomingEvents' => $upcomingEvents,
                'previousEvents' => $previousEvents
            ];
            $this->view('clients/v_myevents', $data);
        }

        public function message($service_id){

            //check if they have a conversation already

            if(!$this->messageModel->checkConversationExists( $_SESSION['client_id'], $service_id)) {
                //create a new conversation
                $this->messageModel->createConversation($_SESSION['client_id'], $service_id);

                //send first message form service provider
                $msgdata = [
                    'conversation_id' => $this->messageModel->checkConversationExists( $_SESSION['client_id'], $service_id)->conversation_id,
                    'sender_type' => 'PROVIDER',
                    'sender_id' => $service_id,
                    'message_text' => 'Hello! How can I assist you today?'
                ];                
                $this->messageModel->sendMessage($msgdata);

            }

            $conversation_id = $this->messageModel->checkConversationExists( $_SESSION['client_id'], $service_id)->conversation_id;
            $conversationsList = $this->messageModel->getConversationProfiles($_SESSION['client_id']);
            $messages = $this->messageModel->getMessagesByID($conversation_id);
            
            $data = [
                'service_id' => $service_id,
                'messages' => $messages,
                'conversationsList' => $conversationsList,
                'conversation_id' => $conversation_id
            ];
            $this->view('clients/chats/v_chat', $data);
        }


        public function getPackages(){
            if($_SERVER['REQUEST_METHOD'] == 'GET'){

                $packages = $this->packageModel->getAllPackages();
                echo json_encode($packages);

            }
        }
        
    }
?>