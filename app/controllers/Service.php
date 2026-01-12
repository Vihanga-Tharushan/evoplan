<?php
    class Service extends Controller {

        private $serviceModel;
        private $ratingModel;
        private $availabilityModel;
        private $postModel;

        private $packageModel;

        private $profileModel;

        private $messageModel;

        private $eventModel;

        private $notificationModel;

        public function __construct(){

            $this->serviceModel = $this->model('M_ServiceP');
            $this->ratingModel = $this->model('M_ratings');
            $this->availabilityModel = $this->model('M_Availability');
            $this->postModel = $this->model('M_Posts');
            $this->packageModel = $this->model('M_package');
            $this->profileModel = $this->model('M_ServicsProfile');
            $this->messageModel = $this->model('M_Message');
            $this->eventModel = $this->model('M_Event');
            $this->notificationModel = $this->model('M_notification');

        }
        public function register(){

            $this->view('servicesP/v_s_register');

        }

        public function create(){ //register user
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                
                //$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                //input data
                $data = [
                    'fname' => trim($_POST['fname']), 
                    'lname' => trim($_POST['lname']),
                    'nic' => trim($_POST['nic']),
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'confirm_password' => trim($_POST['confirm_password']),
                    'contact' => trim($_POST['contact']),
                    'address' => trim($_POST['address']),
                    'district' => trim($_POST['district']),
                    'businessName' => trim($_POST['businessName']),
                    'businessId' => trim($_POST['businessId']),
                    'serviceType' => trim($_POST['serviceType']),
                    'contactB' => trim($_POST['contactB']),
                    'emailB' => trim($_POST['emailB']),
                    'businessAddress' => trim($_POST['businessAddress']),
                    'bizDistrict' => trim($_POST['bizDistrict']),
                    'description' => trim($_POST['description']),
                    'experience' => trim($_POST['experience']),
                    'license' => $_FILES['license']['name'],
                    'license_tmp' => $_FILES['license']['tmp_name'],

                    'name_err' => '',
                    'email_err' => '',
                    'nic_err' => '',
                    'address_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => '',
                    'contact_err' => '',
                    'businessName_err' => '',
                    'businessId_err' => '',
                    'serviceType_err' => '',
                    'contactB_err' => '',
                    'emailB_err' => '',
                ];

                // Debug: print the $_FILES array
        

        


                //validation
                //validate name
                if(empty($data['fname'])){
                    $data['name_err'] = "Please enter a valid name";
                }
                //validate email
                if(empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
                    $data['email_err'] = "Please enter a valid email";
                } else {
                    // FIXED: Use the correct model reference
                    if($this->serviceModel->findUserByEmail($data['email'])){
                        $data['email_err'] = "Email is already Registered";
                    }
                }

                //validate password
                if(empty($data['password']) || strlen($data['password']) < 6){
                    $data['password_err'] = "Please enter a password with at least 6 characters";
                }
                //validate confirm password
                if(empty($data['confirm_password']) || $data['password'] != $data['confirm_password']){
                    $data['confirm_password_err'] = "Passwords do not match";
                }

                //validate nic
                if(empty($data['nic'])){
                    $data['nic_err'] = "Please enter a valid NIC number";
                }

                //validate contact
                if(empty($data['contact']) || !preg_match("/^[0-9]{10}$/", $data['contact'])){
                    $data['contact_err'] = "Please enter a valid contact number";
                }

                //validate address
                if(empty($data['address'])){
                    $data['address_err'] = "Please enter a valid address";
                }

                //validate business name
                if(empty($data['businessName'])){
                    $data['businessName_err'] = "Please enter a valid business name";
                }
                //validate business id
                if(empty($data['businessId'])){
                    $data['businessId_err'] = "Please enter a valid business ID";
                }
                //validate business contact
                if(empty($data['contactB']) || !preg_match("/^[0-9]{10}$/", $data['contactB'])){
                    $data['contactB_err'] = "Please enter a valid business contact number";
                }

                //validate business email
                if(empty($data['emailB']) || !filter_var($data['emailB'], FILTER_VALIDATE_EMAIL)){
                    $data['emailB_err'] = "Please enter a valid business email";
                }



                //validation is complete
                if(empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err']) && empty($data['contact_err']) && empty($data['contactB_err']) && empty($data['emailB_err'])){
                    
                    // Handle file upload FIRST before registration
                    $fileName = time() . '_' . basename($data['license']);
                    
                    if(uploadImage($data['license_tmp'], $fileName, '/uploads/licenses/')) {
                        // File uploaded successfully, update data with the file path
                        $data['license'] = '/uploads/licenses/' . $fileName;
                        
                        // Hash password
                        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                        
                        // Register user with license file path
                        if($this->serviceModel->register($data)){
                            flash('register_success', 'You are registered and can log in');
                            redirect('Service/login');
                        } else {
                            die("Something went wrong with registration");
                        }
                    } else {
                        // File upload failed
                        $data['license_err'] = 'License file upload failed. Please try again.';
                        $this->view('servicesP/v_s_register', $data);
                    }
                } else {
                    // Load view with errors
                    $this->view('servicesP/v_s_register', $data);
                }
                
            } else {
                //if not a post request, load the register view
                $data = [
                    'fname' => '',
                    'lname' => '',
                    'nic' => '',
                    'email' => '',
                    'password' => '',
                    'confirm_password' => '',
                    'contact' => '',
                    'address' => '',
                    'district' => '',
                    'businessName' => '',
                    'businessId' => '',
                    'serviceType' => '',
                    'contactB' => '',
                    'emailB' => '',
                    'businessAddress' => '',
                    'bizDistrict' => '',
                    'description' => '',
                    'experience' => '',
                    'license' => '',
                    'license_tmp' => '',

                    'name_err' => '',
                    'email_err' => '',
                    'nic_err' => '',
                    'address_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => '',
                    'contact_err' => '',
                    'businessName_err' => '',
                    'businessId_err' => '',
                    'serviceType_err' => '',
                    'contactB_err' => '',
                    'emailB_err' => '',
                ];

                $this->view('servicesP/v_s_register', $data);
            }
        }

        public function login(){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process registration
                //$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                 $data = [
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),

                    'email_err' => '',
                    'password_err' => '',
                ];


                // Validate email
                if(empty($data['email'])){
                    $data['email_err'] = 'Please enter email';
                }else{
                    if($this->serviceModel->findUserByEmail($data['email'])){
                        // User found
                    } else {
                        $data['email_err'] = 'No user found';
                    }
                }

                // Validate password
                if(empty($data['password'])){
                    $data['password_err'] = 'Please enter password';
                }

                //if no errors, proceed to login
                if(empty($data['email_err']) && empty($data['password_err'])){
                    // Log user in
                    $loggedInUser = $this->serviceModel->login($data['email'], $data['password']);
                    if($loggedInUser){
                        $this->createUserSession($loggedInUser);
                        
                    } else {
                        $data['password_err'] = 'Incorrect password';
                        // Load view with errors
                        $this->view('Users/v_serviceP_login', $data);
                    }
                } else {
                    // Load view with errors
                    $this->view('Users/v_serviceP_login', $data);
                }

            }
            else {

                $data = [
                    'email' => '',
                    'password' => '',

                    'email_err' => '',
                    'password_err' => '',
                ];

                // Load view with errors
                $this->view('Users/v_serviceP_login', $data);
            }

        }

        public function createUserSession($service){

            $_SESSION['service_id'] = $service->service_id;
            $_SESSION['service_email'] = $service->email;
            $_SESSION['service_name'] = $service->fname.' '.$service->lname;
            $_SESSION['service_contact'] = $service->contact;

            redirect('Service/profile');
        }


        public function logout(){
            unset($_SESSION['service_id']);
            unset($_SESSION['service_email']);
            unset($_SESSION['service_name']);
            unset($_SESSION['service_contact']);
            session_destroy();
            redirect('Service/login');
        }

        public function isloggedIn(){
            if(isset($_SESSION['service_id'])){
                return true;
            } else {
                return false;
            }
        }

        public function events(){

            $events = $this->eventModel->getUpcomingEventsByServiceProvider($_SESSION['service_id']);
            $previousEvents = $this->eventModel->getPreviousEventsByServiceProvider($_SESSION['service_id']);
            $data = [
                'events' => $events,
                'previousEvents' => $previousEvents
            ];

            $this->view('servicesP/v_s_events', $data);

        }

        public function packages(){

            $packages = $this->packageModel->getPackagesByProvider($_SESSION['service_id']);
            $data = [
                'packages' => $packages
            ];
            $this->view('servicesP/v_s_packages', $data);
        }

        public function profile(){

            $profile = $this->profileModel->getProfileById($_SESSION['service_id']);
            $rating = $this->ratingModel->getRatingsSummary($_SESSION['service_id']);
            $availability = $this->availabilityModel->getAvailabilityByServiceProvider($_SESSION['service_id']);
            $EventsPosts = $this->postModel->getEventPostsByServiceProvider($_SESSION['service_id']);
            $EventMedia = $this->postModel->getMediaByServiceId($_SESSION['service_id']);

            $data = [
                'profile' => $profile,
                'rating' => $rating,
                'availability' => $availability,
                'EventsPosts' => $EventsPosts,
                'EventMedia' => $EventMedia
            ];

            $this->view('servicesP/v_s_profile', $data);
        }

        public function editProfile(){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                
                $data = [
                    'profile_pic' => time() . '_' . $_FILES['profile-pic-input']['name'],
                    'background_image' => time() . '_' . $_FILES['cover-input']['name'],
                    'profile_pic_file' => $_FILES['profile-pic-input'],
                    'background_image_file' => $_FILES['cover-input'],
                    'background_text' => trim($_POST['background-text']),
                    'intro' => trim($_POST['intro-text']),
                    'service_id' => $_SESSION['service_id'],

                    'profile_pic_err' => '',
                    'background_image_err' => '',
                    'intro_err' => ''

                ];

                
                //profile pic Upload
                if(uploadImage($data['profile_pic_file']['tmp_name'], $data['profile_pic'], '/img/profilePics/')){
                    // Image uploaded successfully
                } else {
                    $data['profile_pic_err'] = 'Profile picture upload failed. Please try again.';
                }

                //cover photo validations
                if(uploadImage($data['background_image_file']['tmp_name'], $data['background_image'], '/img/coverPhotos/')){
                    // Image uploaded successfully
                } else {
                    $data['background_image_err'] = 'Cover photo upload failed. Please try again.';
                }

                //bio text validations
                if(empty($data['intro'])){
                    $data['intro_err'] = 'Bio text is required.';
                }

                if(empty($data['profile_pic_err']) && empty($data['background_image_err']) && empty($data['intro_err'])){
                    // No errors, proceed with profile update
                    if($this->profileModel->updateProfile($data)){
                        flash('profile_message', 'Profile updated successfully');
                        redirect('Service/profile');
                    } else {
                        die('Something went wrong');
                    }


                } else {
                    // Load view with errors
                    $this->view('servicesP/v_s_editProfile', $data);
                }

            }
            else {

                //show existing profile data
                $profile = $this->profileModel->getProfileById($_SESSION['service_id']);
                $data = [
                    'profile_pic' => $profile->profile_pic,
                    'background_image' => $profile->background_image,
                    'background_text' => $profile->background_text,
                    'intro' => $profile->intro,

                    'profile_pic_err' => '',
                    'background_image_err' => '',
                    'intro_err' => ''
                ];
                $this->view('servicesP/v_s_editProfile', $data);
            }
           
        }

        

        public function complains(){

            $this->view('servicesP/v_s_complains');
        }

    
        public function chat(){

            $conversationList = $this->messageModel->getConversationProfilesForProvider($_SESSION['service_id']);

            $data = [
                'conversationsList' => $conversationList
            ];
            $this->view('servicesP/v_s_messages', $data);
        }

        public function terms(){

            $this->view('servicesP/v_s_terms');
        }

        public function dashboard(){
            
            $this->view('servicesP/v_s_dashboard');
            
        }

        public function tempDashboard(){

            $this->view('servicesP/v_s_tempDashboard');

        }

        

        public function viewUpcomingEvent($eventId){

            $event = $this->eventModel->getEventById($eventId);
            $selectedPackage = $this->eventModel->getSelectedPackages($eventId);
            $client = $this->eventModel->getClientByEventId($eventId);
            $data = [
                'event' => $event,
                'selectedPackage' => $selectedPackage,
                'client' => $client
            ];
            $this->view('servicesP/events/v_s_oneupcoming', $data);

        }

        public function getPackagesForEvent(){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $inputdata = json_decode(file_get_contents("php://input"), true);
                $eventId = $inputdata['eventId'];

                $packages = $this->eventModel->getSelectedPackages($eventId);
                echo json_encode($packages);
            }
            

        }

        public function rejectConfirmation(){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $inputdata = json_decode(file_get_contents("php://input"), true);
                $eventId = $inputdata['eventId'];
                $reason = $inputdata['reason'];
                $serviceId = $_SESSION['service_id'];

                if($this->eventModel->rejectEventByProvider($eventId, $serviceId, $reason)){
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false, 'error' => 'Failed to reject event']);
                }
            }

        }

        public function sendConfirmation(){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $inputdata = json_decode(file_get_contents("php://input"), true);
                $eventId = $inputdata['eventId'];
                $message = $inputdata['message'];
                $serviceId = $_SESSION['service_id'];

                if($this->eventModel->confirmEventByProvider($eventId, $serviceId, $message)){
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false, 'error' => 'Failed to confirm event']);
                }
            }
        }

       

        public function previousEvents(){

            $this->view('servicesP/events/v_s_previouslist');

        }

        public function onePreviousEvent(){

            $this->view('servicesP/events/v_s_oneprevious');

        }

        public function viewPackage(){

            $this->view('servicesP/packages/v_s_viewpackage');

        }

        public function makePackage(){
            
            $this->view('servicesP/packages/v_s_createpackage');
            
        }

        public function accountSettings(){

            $this->view('servicesP/v_s_accountSettings');

        }

        public function notifications(){

            $notifications = $this->notificationModel->getAllByUser('PROVIDER', $_SESSION['service_id']);
            $stats = $this->notificationModel->getNotificationStats('PROVIDER', $_SESSION['service_id']);
            
            $data = [
                'notifications' => $notifications,
                'stats' => $stats
            ];

            $this->view('servicesP/v_s_notification', $data);
        }

        public function markNotificationAsRead(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $inputdata = json_decode(file_get_contents("php://input"), true);
                $notificationId = $inputdata['notificationId'];
                
                if($this->notificationModel->markAsRead($notificationId)){
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false, 'error' => 'Failed to mark as read']);
                }
            }
        }

        public function markAllNotificationsAsRead(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                if($this->notificationModel->markAllAsRead('PROVIDER', $_SESSION['service_id'])){
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false, 'error' => 'Failed to mark all as read']);
                }
            }
        }

        public function deleteNotification(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $inputdata = json_decode(file_get_contents("php://input"), true);
                $notificationId = $inputdata['notificationId'];
                
                if($this->notificationModel->deleteNotification($notificationId)){
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false, 'error' => 'Failed to delete notification']);
                }
            }
        }

        public function edit($id){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process service editing
                redirect('Service/dashboard');
            }
            else {
                $this->view('service/v_edit', ['id' => $id]);
            }
        }

        public function delete($id){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process service deletion
                redirect('Service/dashboard');
            }
            else {
                $this->view('service/v_delete', ['id' => $id]);
            }
        }

        public function availability(){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                
                // Process availability update
                
                // Sanitize POST data
                //$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data =[
                        'start_date' => trim($_POST['from-date']),
                        'end_date' => trim($_POST['to-date']),
                        'status' => trim($_POST['status']),
                        'service_id' => $_SESSION['service_id'],

                ];

                // TO DO: Update availability in database
                if($this->availabilityModel->AddAvailability($data)){
                    flash('availability_message', 'Availability updated successfully');
                    redirect('Service/Profile');
                }else{
                    die('Something went wrong');
                }
                
            }
            else{
                
                $availability = $this->availabilityModel->getAvailabilityByServiceProvider($_SESSION['service_id']);
                $data = [
                    'availability' => $availability
                ];

                $this->view('servicesP/v_s_availability', $data);

            }

        }


        public function deleteAvailability($id){

            $id = ['availability_id' => $id];
            if($this->availabilityModel->DeleteAvailability($id)){
                flash('availability_message', 'Availability deleted successfully');
                redirect('Service/availability');
            } else {
                die("Something went wrong");
            }
        }
    }


?>
