<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
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

        private $complaintModel;

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
            $this->complaintModel = $this->model('M_Complaints');


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
            $_SESSION['client_profile_pic'] = isset($client->profile_pic) ? $client->profile_pic : '';
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
            unset($_SESSION['client_profile_pic']);

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

        public function updateEventVenue(){
            
            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                $inputdata = json_decode(file_get_contents("php://input"), true);
                $eventId = $inputdata['eventId'];
                $venueAddress = $inputdata['venueAddress'];
                // Update event venue in database
                if($this->eventModel->updateEventVenue($eventId, $venueAddress)){
                    echo json_encode(['status' => 'success', 'message' => 'Venue updated successfully']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to update venue']);
                }
            }
        }


        public function updateSettings(){
            
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                
                // Set JSON header
                header('Content-Type: application/json');
                
                $formData = $_POST;
                
                // Validate input
                if(empty($formData['name']) || empty($formData['email'])){
                    echo json_encode(['success' => false, 'message' => 'Name and email are required']);
                    return;
                }
                
                // Prepare base update data
                $updateData = [
                    'name' => trim($formData['name']),
                    'email' => trim($formData['email']),
                    'contact' => isset($formData['contact']) ? trim($formData['contact']) : '',
                    'address' => isset($formData['address']) ? trim($formData['address']) : '',
                    'client_id' => $_SESSION['client_id']
                ];

                // Handle profile picture upload
                if(isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == 0){
                    // Validate file type
                    $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
                    if(!in_array($_FILES['profile_pic']['type'], $allowedTypes)){
                        echo json_encode(['success' => false, 'message' => 'Invalid image type. Only JPG, PNG and GIF are allowed.']);
                        return;
                    }
                    
                    // Validate file size (5MB max)
                    if($_FILES['profile_pic']['size'] > 5 * 1024 * 1024){
                        echo json_encode(['success' => false, 'message' => 'Image size should be less than 5MB']);
                        return;
                    }
                    
                    // Generate unique filename
                    $profilePicName = time() . '_' . $_FILES['profile_pic']['name'];
                    
                    // Get old profile picture to delete if exists
                    $client = $this->clientModel->getClientById($_SESSION['client_id']);
                    $oldProfilePic = isset($client->profile_pic) ? $client->profile_pic : null;
                    
                    // Upload new image
                    if($oldProfilePic && file_exists(PUBROOT . '/img/clientProfilePic/' . $oldProfilePic)){
                        // Update existing image
                        if(updateImage(PUBROOT . '/img/clientProfilePic/' . $oldProfilePic, $_FILES['profile_pic']['tmp_name'], $profilePicName, '/img/clientProfilePic/')){
                            $updateData['profile_pic'] = $profilePicName;
                            $_SESSION['client_profile_pic'] = $profilePicName;
                        } else {
                            echo json_encode(['success' => false, 'message' => 'Failed to upload profile picture']);
                            return;
                        }
                    } else {
                        // Upload new image
                        if(uploadImage($_FILES['profile_pic']['tmp_name'], $profilePicName, '/img/clientProfilePic/')){
                            $updateData['profile_pic'] = $profilePicName;
                            $_SESSION['client_profile_pic'] = $profilePicName;
                        } else {
                            echo json_encode(['success' => false, 'message' => 'Failed to upload profile picture']);
                            return;
                        }
                    }
                }

                // Update client profile in database
                if($this->clientModel->updateProfile($updateData)){
                    // If email was changed, update session email
                    if($_SESSION['client_email'] != $updateData['email']){
                        $_SESSION['client_email'] = $updateData['email'];
                    }
                    // Update session name if changed
                    if($_SESSION['client_name'] != $updateData['name']){
                        $_SESSION['client_name'] = $updateData['name'];
                    }
                    echo json_encode(['success' => true, 'message' => 'Profile updated successfully']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to update profile']);
                }
            }
            else{
                $this->view('clients/v_settings');
            }
        }

        public function updatePassword(){
            
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                
                $formData = $_POST;
                $clientId = $_SESSION['client_id'];
                
                // Validate input
                if(empty($formData['currentPassword']) || empty($formData['newPassword']) || empty($formData['confirmPassword'])){
                    echo json_encode(['success' => false, 'message' => 'All password fields are required']);
                    return;
                }
                
                // Verify new passwords match
                if($formData['newPassword'] !== $formData['confirmPassword']){
                    echo json_encode(['success' => false, 'message' => 'New passwords do not match']);
                    return;
                }
                
                // Validate password length
                if(strlen($formData['newPassword']) < 6){
                    echo json_encode(['success' => false, 'message' => 'Password must be at least 6 characters long']);
                    return;
                }
                
                // Get current client data to verify current password
                $client = $this->clientModel->getClientById($clientId);
                
                if(!$client || !password_verify($formData['currentPassword'], $client->password)){
                    echo json_encode(['success' => false, 'message' => 'Current password is incorrect']);
                    return;
                }
                
                // Update password
                if($this->clientModel->updatePassword($clientId, $formData['newPassword'])){
                    echo json_encode(['success' => true, 'message' => 'Password updated successfully']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to update password']);
                }
            }
        }

        public function getSettings(){

            if($_SERVER['REQUEST_METHOD'] == 'GET'){
                // Fetch client settings from database
                $clientId = $_SESSION['client_id'];
                $client = $this->clientModel->getClientById($clientId);
                
                if($client){
                    echo json_encode([
                        'success' => true,
                        'data' => [
                            'name' => $client->name,
                            'email' => $client->email,
                            'contact' => isset($client->contact) ? $client->contact : '',
                            'address' => isset($client->address) ? $client->address : '',
                            'profile_pic' => isset($client->profile_pic) ? $client->profile_pic : ''
                        ]
                    ]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to load settings']);
                }
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


        public function settings(){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form data
                redirect('clients/settings');
            }
            else{
                // Load the settings view
                $this->view('clients/v_settings');
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

        public function analytics(){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form data
                redirect('clients/analytics');
            }
            else{
                // Load the analytics view
                $this->view('clients/v_analytics');
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

            $profile = $this->profileModel->getProfileById($id);
            $profileV = $this->profileModel->getProfileByServiceId($id);
            $rating = $this->ratingModel->getRatingsSummary($id);
            $availability = $this->availabilityModel->getAvailabilityByServiceProvider($id);
            $EventsPosts = $this->postModel->getEventPostsByServiceProvider($id);
            $EventMedia = $this->postModel->getMediaByServiceId($id);
            $data = [

                'profile' => $profile,
                'rating' => $rating,
                'availability' => $availability,
                'EventsPosts' => $EventsPosts,
                'EventMedia' => $EventMedia,
                'profileV' => $profileV

            ];
            $this->view('clients/serviceProviderprofile/serviceProviderprofile', $data);
        }

        public function getPackagesByProvider(){

            if($_SERVER['REQUEST_METHOD'] == 'GET'){
                $serviceProviderId = $_GET['service_id'];
                 // Fetch packages for the service provider

                $packages = $this->packageModel->getPackagesByProvider($serviceProviderId);
                echo json_encode($packages);
            }
           
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
                        // Send notification to service provider about package addition
                        $this->sendPackageNotificationfromClient($ownerId, $eventId, $packageId);

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
        public function sendPackageNotificationfromClient($serviceProviderId, $eventId, $packageId){
            
            $event = $this->eventModel->getEventById($eventId);
            $package = $this->packageModel->getPackageById($packageId);
            $client = $this->clientModel->getClientById($event->client_id);

            // Use helper function to send notification
            sendPackageNotification(
                $serviceProviderId, 
                $event, 
                $package, 
                $client
            );            
        }

        public function notifications(){
            
            $notifications = $this->notificationModel->getAllByUser('CLIENT', $_SESSION['client_id']);
            $stats = $this->notificationModel->getNotificationStats('CLIENT', $_SESSION['client_id']);
            
            $data = [
                'notifications' => $notifications,
                'stats' => $stats
            ];
            // Load the notifications view
            $this->view('clients/v_notifications', $data);
        
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


        public function submitComplaint(){
            // Only accept POST
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                http_response_code(405);
                echo json_encode(['success' => false, 'message' => 'Method not allowed']);
                return;
            }

            // Get JSON input
            $data = json_decode(file_get_contents("php://input"), true);

            // Validate required fields
            if (!isset($data['event_id']) || empty($data['event_id']) ||
                !isset($data['complainant_type']) || empty($data['complainant_type']) ||
                !isset($data['issue_type']) || empty($data['issue_type']) ||
                !isset($data['description']) || empty($data['description'])) {
                
                echo json_encode([
                    'success' => false,
                    'message' => 'Missing required fields'
                ]);
                return;
            }

            // Validate service_id if complainant_type is SERVICEP
            if ($data['complainant_type'] === 'SERVICEP') {
                if (!isset($data['service_id']) || empty($data['service_id'])) {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Service provider is required when complaint type is Service Provider'
                    ]);
                    return;
                }
            }

            // Prepare data for insertion
            $complaintData = [
                'client_id' => $_SESSION['client_id'] ?? null,
                'event_id' => $data['event_id'],
                'complainant_type' => $data['complainant_type'],
                'issue_type' => $data['issue_type'],
                'description' => $data['description']
            ];

            // Add service_id if provided
            if ($data['complainant_type'] === 'SERVICEP' && isset($data['service_id'])) {
                $complaintData['service_id'] = $data['service_id'];
            }

            // Check if client_id exists
            if (!$complaintData['client_id']) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Client not authenticated'
                ]);
                return;
            }

            // Submit complaint using the model
            if ($this->complaintModel->submitClientComplaint($complaintData)) {
                echo json_encode([
                    'success' => true,
                    'message' => 'Complaint submitted successfully'
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Failed to submit complaint'
                ]);
            }
        }
        
        public function getClientEvents(){
            if($_SERVER['REQUEST_METHOD'] == 'GET'){
                if(!isset($_SESSION['client_id'])){
                    http_response_code(401);
                    echo json_encode(['success' => false, 'error' => 'Not logged in']);
                    return;
                }
                
                $events = $this->eventModel->getEventsByClientId($_SESSION['client_id']);
                echo json_encode(['success' => true, 'events' => $events]);
            }
        }
        
        public function getEventServiceProviders(){
            if($_SERVER['REQUEST_METHOD'] == 'GET'){
                $eventId = isset($_GET['eventId']) ? intval($_GET['eventId']) : null;
                
                if(!$eventId){
                    http_response_code(400);
                    echo json_encode(['success' => false, 'error' => 'Event ID required']);
                    return;
                }
                
                // Get service providers hired for this event
                $providers = $this->eventModel->getServiceProvidersForEvent($eventId);
                echo json_encode(['success' => true, 'providers' => $providers]);
            }
        }

        public function getClientComplaints(){
            if($_SERVER['REQUEST_METHOD'] == 'GET'){
                if(!isset($_SESSION['client_id'])){
                    http_response_code(401);
                    echo json_encode(['success' => false, 'error' => 'Not logged in']);
                    return;
                }
                
                $complaints = $this->complaintModel->getClientComplaintsByClientId($_SESSION['client_id']);
                echo json_encode(['success' => true, 'complaints' => $complaints]);
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

        public function getAllServiceProviders(){
            if($_SERVER['REQUEST_METHOD'] == 'GET'){

                $services = $this->profileModel-> getAllServiceProviders();
                echo json_encode($services);

            }
        }

        public function getServiceProviderById($service_id){
            if($_SERVER['REQUEST_METHOD'] == 'GET'){

                $service = $this->profileModel->getProfileByServiceId($service_id);
                echo json_encode($service);

            }
        }

        public function getServiceProvidersRattings(){

                if($_SERVER['REQUEST_METHOD'] == 'GET'){

                    $ratings = $this->ratingModel->getAllRatings();
                    echo json_encode($ratings);
    
                }
        }

        public function addFavoriteProviders(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                $inputdata = json_decode(file_get_contents("php://input"), true);
                $serviceProviderId = $inputdata['profileId'] ?? null;
                $clientId = $_SESSION['client_id'] ?? null;

                if(!$serviceProviderId || !$clientId){
                    echo json_encode(['success' => false, 'message' => 'Missing data']);
                    return;
                }

                if($this->clientModel->addFavoriteProvider($clientId, $serviceProviderId)){
                    echo json_encode(['success' => true, 'message' => 'Service provider added to favorites']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to add service provider to favorites']);
                }
            }
        }

        public function getFavoriteProviders(){
            if($_SERVER['REQUEST_METHOD'] == 'GET'){

                $clientId = $_SESSION['client_id'] ?? null;
                if(!$clientId){
                    echo json_encode([]);
                    return;
                }
                
                $favoriteProviders = $this->profileModel->getFavoriteProvidersWithDetails($clientId);
                echo json_encode($favoriteProviders);

            }
        }

        public function removeFavoriteProviders(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                $inputdata = json_decode(file_get_contents("php://input"), true);
                $serviceProviderId = $inputdata['profileId'] ?? null;
                $clientId = $_SESSION['client_id'] ?? null;

                if(!$serviceProviderId || !$clientId){
                    echo json_encode(['success' => false, 'message' => 'Missing data']);
                    return;
                }

                if($this->clientModel->removeFavoriteProvider($clientId, $serviceProviderId)){
                    echo json_encode(['success' => true, 'message' => 'Service provider removed from favorites']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to remove service provider from favorites']);
                }
            }
        }

        public function paymentGateway($eventId) {
            // Check if user is logged in
            if(!isset($_SESSION['client_id'])){
                redirect('users/login');
            }

            $clientId = $_SESSION['client_id'];
            
            // Get event details
            $eventDetails = $this->eventModel->getEventById($eventId);
            
            // Get selected packages for this event
            $selectedPackages = $this->eventModel->getSelectedPackages($eventId);
            
            // Calculate total amount
            $totalAmount = 0;
            foreach($selectedPackages as $package) {
                $totalAmount += floatval($package->package_price);
            }
            
            // Get client details
            $clientDetails = $this->clientModel->getClientById($clientId);
            
            // Load PayHere config
            $payhereConfig = require_once APPROOT . '/config/payhere.php';
            $merchant_id = $payhereConfig['merchant_id'];
            $merchant_secret = $payhereConfig['merchant_secret'];
            
            // Generate order ID
            $order_id = 'EVT_' . $eventId . '_' . time();
            
            // Format amount to 2 decimal places
            $amount = number_format($totalAmount, 2, '.', '');
            $currency = 'LKR';
            
            // Generate hash
            // Hash formula: MD5(merchant_id + order_id + amount + currency + MD5(merchant_secret))
            $hash = strtoupper(
                md5(
                    $merchant_id . 
                    $order_id . 
                    $amount . 
                    $currency . 
                    strtoupper(md5($merchant_secret))
                )
            );
            
            $data = [
                'event_id' => $eventId,
                'client_id' => $clientId,
                'event_details' => $eventDetails,
                'packages' => $selectedPackages,
                'total_amount' => $totalAmount,
                'client_name' => $clientDetails->name,
                'client_email' => $clientDetails->email,
                'merchant_id' => $merchant_id,
                'order_id' => $order_id,
                'amount' => $amount,
                'currency' => $currency,
                'hash' => $hash
            ];
            
            $this->view('clients/payment/makepayment', $data);
        }
        
        
    }
?>