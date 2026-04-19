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
        
        private $complaintsModel;

        private $paymentModel;

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
            $this->complaintsModel = $this->model('M_Complaints');
            $this->paymentModel = $this->model('M_Payment');

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
            $_SESSION['service_name'] = $service->businessName;
            $_SESSION['service_contact'] = $service->contact;
            $_SESSION['service_profile_pic'] = $service->profile_pic;

            redirect('Service/profile');
        }


        public function logout(){
            unset($_SESSION['service_id']);
            unset($_SESSION['service_email']);
            unset($_SESSION['service_name']);
            unset($_SESSION['service_contact']);
            unset($_SESSION['service_profile_pic']);
            session_destroy();
            redirect('Evo/evoplan');
        }

        public function isloggedIn(){

            if(!isset($_SESSION['service_id'])){
                redirect('Service/login');
            }
        }


        public function updatePersonalInfo(){
            $this->isloggedIn();
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Handle AJAX JSON submission
                $inputData = json_decode(file_get_contents('php://input'), true);
                $data =[
                        'fname' => trim($inputData['fname']),
                        'lname' => trim($inputData['lname']),
                        'contact' => trim($inputData['contact']),
                        'address' => trim($inputData['address']),
                        'district' => trim($inputData['district']),
                        'service_id' => $_SESSION['service_id']
                ];

                if($this->serviceModel->updatePersonalInfo($data)){
                    echo json_encode(['success' => true, 'message' => 'Personal information updated successfully']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to update personal information']);
                }


            }
        }

        public function updateBusinessInfo(){
            $this->isloggedIn();
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Handle AJAX JSON submission
                $inputData = json_decode(file_get_contents('php://input'), true);
                $data =[
                        'businessName' => trim($inputData['businessName']),
                        'contactB' => trim($inputData['contactB']),
                        'emailB' => trim($inputData['emailB']),
                        'businessAddress' => trim($inputData['businessAddress']),
                        'bizDistrict' => trim($inputData['bizDistrict']),
                        'description' => trim($inputData['description']),
                        'experience' => trim($inputData['experience']),
                        'service_id' => $_SESSION['service_id']
                ];

                if($this->serviceModel->updateBusinessInfo($data)){
                    echo json_encode(['success' => true, 'message' => 'Business information updated successfully']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to update business information']);
                }
            }
        }

        public function verifyPassword(){
            $this->isloggedIn();
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Handle AJAX JSON submission
                $inputData = json_decode(file_get_contents('php://input'), true);
                $currentPassword = $inputData['currentPassword'] ?? '';
                
                // Get the user's password hash from database
                $service = $this->serviceModel->getServiceById($_SESSION['service_id']);
                
                // Verify password using password_verify
                if(password_verify($currentPassword, $service->password)){
                    echo json_encode(['passwordValid' => true, 'success' => true]);
                } else {
                    echo json_encode(['passwordValid' => false, 'success' => false]);
                }
            }
        }

        public function updatePassword(){
            $this->isloggedIn();
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Handle AJAX JSON submission
                $inputData = json_decode(file_get_contents('php://input'), true);
                $newPassword = $inputData['newPassword'] ?? '';
                
                // Hash the new password
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                
                $data = [
                    'password' => $hashedPassword,
                    'service_id' => $_SESSION['service_id']
                ];
                
                if($this->serviceModel->updatePassword($data)){
                    echo json_encode(['success' => true, 'message' => 'Password updated successfully']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to update password']);
                }
            }
        }

        public function events(){
            $this->isloggedIn();

            $events = $this->eventModel->getUpcomingEventsByServiceProvider($_SESSION['service_id']);
            $previousEvents = $this->eventModel->getPreviousEventsByServiceProvider($_SESSION['service_id']);
            $data = [
                'events' => $events,
                'previousEvents' => $previousEvents
            ];

            $this->view('servicesP/v_s_events', $data);

        }

        public function packages(){
            $this->isloggedIn();

            $packages = $this->packageModel->getPackagesByProvider($_SESSION['service_id']);
            $data = [
                'packages' => $packages
            ];
            $this->view('servicesP/v_s_packages', $data);
        }

        public function getPackageDetails(){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                $inputdata = json_decode(file_get_contents("php://input"), true);
                $packageId = $inputdata['packageId'];
                $package = $this->packageModel->getPackageById($packageId);
                echo json_encode(['package' => $package]);
            }

        }

        public function getPackagePerformanceData(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $inputdata = json_decode(file_get_contents("php://input"), true);
                $serviceId = $inputdata['service_id'];
                $performanceData = $this->packageModel->getPackagePerformanceData($serviceId);
                echo json_encode($performanceData);
            }
        }

        //this is for analyzing financial data and generating reports, not for regular page view
        public function getEventStatus(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $inputdata = json_decode(file_get_contents("php://input"), true);
                $serviceId = $inputdata['service_id'];
                $eventStatusData = $this->eventModel->getEventStatusData($serviceId);
                echo json_encode($eventStatusData);
            }
        }

        public function payment(){

            $totalEarnings = $this->paymentModel->getTotalEarningsByServiceProvider($_SESSION['service_id']);
            $pendingPayments = $this->paymentModel->getTotalPendingPaymentAmountByServiceProvider($_SESSION['service_id']);
            $paidoutPayments = $this->paymentModel->getTotalPaidOutPaymentsAmountByServiceProvider($_SESSION['service_id']);
            $totalEventCompleted = $this->eventModel->getTotalEventsByProvider($_SESSION['service_id']);
            $bankdetails = $this->paymentModel->getBankDetailsByServiceProvider($_SESSION['service_id']);

           

            $data = [
                'totalEarnings' => $totalEarnings,
                'pendingPayments' => $pendingPayments,
                'paidoutPayments' => $paidoutPayments,
                'totalEventCompleted' => $totalEventCompleted,
                'bankdetails' => $bankdetails
            ];



            $this->view('servicesP/v_s_payments', $data);

        }


        public function getPaymentDetails(){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                $inputdata = json_decode(file_get_contents("php://input"), true);
                $paymentId = $inputdata['paymentId'];
                $paymentDetails = $this->paymentModel->getPaymentById($paymentId);
                echo json_encode(['paymentDetails' => $paymentDetails]);
            }

        }

        public function getAllPayments(){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                $inputdata = json_decode(file_get_contents("php://input"), true);
                $serviceId = $inputdata['serviceId'];
                $allPayments = $this->paymentModel->getAllPaymentsByServiceProvider($serviceId);
                
                // Extract unique event IDs for event details
                $eventIds = [];
                foreach ($allPayments as $payment) {
                    if (!in_array($payment->event_id, $eventIds)) {
                        $eventIds[] = $payment->event_id;
                    }
                }
                
                // Fetch event details for all unique event IDs
                $eventsMap = [];
                if (!empty($eventIds)) {
                    $events = $this->paymentModel->getEventDetailsForPayments($eventIds);
                    foreach ($events as $event) {
                        $eventsMap[$event->event_id] = $event;
                    }
                }
                
                // Enhance payment data with event details
                foreach ($allPayments as $payment) {
                    if (isset($eventsMap[$payment->event_id])) {
                        $event = $eventsMap[$payment->event_id];
                        $payment->event_name = $event->event_name;
                        $payment->event_type = $event->event_type;
                        $payment->event_description = $event->event_description;
                        $payment->start_datetime = $event->start_datetime;
                        $payment->end_datetime = $event->end_datetime;
                        $payment->guest_count = $event->guest_count;
                        $payment->venue_address = $event->venue_address;
                        $payment->venue_type = $event->venue_type;
                    }
                }
                
                echo json_encode(['allPayments' => $allPayments]);
            }

        }

        // update bank details

        public function updateBankDetails(){
                $this->isloggedIn(); 

            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                $inputdata = json_decode(file_get_contents("php://input"), true);
                $data = [
                    'bankName' => $inputdata['bankName'] ?? '',
                    'accountHolderName' => $inputdata['accountHolder'] ?? '',
                    'accountNumber' => $inputdata['accountNumber'] ?? '',
                    'branchName' => $inputdata['branchName'] ?? ''
                ];

                if($this->paymentModel->updateBankDetails($data)){
                    echo json_encode(['success' => true, 'message' => 'Bank details updated successfully']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to update bank details']);
                }
            }
        }

        // Verify PIN and confirm payment
        public function verifyPaymentPin(){
            $this->isloggedIn();

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $inputdata = json_decode(file_get_contents("php://input"), true);
                $eventId = $inputdata['eventId'] ?? null;
                $pin = $inputdata['pin'] ?? null;

                if (!$eventId || !$pin) {
                    echo json_encode(['success' => false, 'message' => 'Invalid request data']);
                    return;
                }

                $result = $this->eventModel->verifyAndConfirmEventPin($eventId, $pin);
                $service_id = $_SESSION['service_id'];

                if($result['success']){
                   // mark as pin verified and update payment status in service_provider_payments table
                   $pinConfirmed = $this->paymentModel->markAsPinConfirmed($eventId, $service_id);
                   if($pinConfirmed['success']){
                        echo json_encode(['success' => true, 'message' => 'PIN verified and payment confirmed successfully']);
                   } else {
                        echo json_encode(['success' => false, 'message' => 'PIN verified but failed to update payment confirmation']);
                   }
                } else {
                    // PIN verification failed - send error response
                    echo json_encode(['success' => false, 'message' => $result['message']]);
                }
            }
        }

        public function profile(){
            $this->isloggedIn();

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
                'EventMedia' => $EventMedia,
                'sidebar' => 'profile'
            ];

            $this->view('servicesP/v_s_profile', $data);
        }

        public function getRatingsSummary(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $inputdata = json_decode(file_get_contents("php://input"), true);
                $serviceId = $inputdata['service_id'];
                $ratingsSummary = $this->ratingModel->getRatingsforServiceProvider($serviceId);
                echo json_encode($ratingsSummary);
            }
        }


        public function getReviewData(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $inputdata = json_decode(file_get_contents("php://input"), true);
                $serviceId = $inputdata['service_id'];
                $reviewCounts = $this->ratingModel->getReviewCountByRating($serviceId);
                echo json_encode($reviewCounts);
            }
        }

        public function getFinancialData(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $inputdata = json_decode(file_get_contents("php://input"), true);
                $serviceId = $inputdata['service_id'];
                $year = $inputdata['year'];
                $financialData = $this->paymentModel->getFinancialOverviewByServiceProvider($serviceId, $year);
                echo json_encode($financialData);
            }
        }

        public function editProfile(){
            $this->isloggedIn();

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                
                $data = [
                    'profile_pic' => time() . '_' . $_FILES['profile-pic-input']['name'],
                    'background_image' => time() . '_' . $_FILES['cover-input']['name'],
                    'profile_pic_file' => $_FILES['profile-pic-input'],
                    'background_image_file' => $_FILES['cover-input'],
                    'background_text' => trim($_POST['background-text']),
                    'intro' => trim($_POST['intro-text']),
                    'service_id' => $_SESSION['service_id'],
                    'background-image-2' => (isset($_FILES['background-image-2']['name']) && !empty($_FILES['background-image-2']['name']) ? time() . '_' . $_FILES['background-image-2']['name'] : null),
                    'background-image-3' => (isset($_FILES['background-image-3']['name']) && !empty($_FILES['background-image-3']['name']) ? time() . '_' . $_FILES['background-image-3']['name'] : null),
                    'background-image-4' => (isset($_FILES['background-image-4']['name']) && !empty($_FILES['background-image-4']['name']) ? time() . '_' . $_FILES['background-image-4']['name'] : null),
                    'background-image-2_file' => (isset($_FILES['background-image-2']) ? $_FILES['background-image-2'] : null),
                    'background-image-3_file' => (isset($_FILES['background-image-3']) ? $_FILES['background-image-3'] : null),
                    'background-image-4_file' => (isset($_FILES['background-image-4']) ? $_FILES['background-image-4'] : null),

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

                //upload additional background images if provided
                for ($i = 2; $i <= 4; $i++) {
                    $bgImageKey = 'background-image-' . $i;
                    $bgImageFileKey = $bgImageKey . '_file';
                    
                    if ($data[$bgImageFileKey] !== null && !empty($data[$bgImageFileKey]['name'])) {

                        if (uploadImage($data[$bgImageFileKey]['tmp_name'], $data[$bgImageKey], '/img/coverPhotos/')) {
                            // Image uploaded successfully
                            $this->profileModel->uploadAdditionalBackgroundImage($data, $i);
                        } else {
                            $data['background_image_err'] .= " Background image $i upload failed. Please try again.";
                        }
                    } else {
                        // No new image uploaded for this slot, set to null or handle accordingly
                        $data[$bgImageKey] = null;
                    }
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

        

        public function complaints(){
            $this->isloggedIn();

            $Previousevents = $this->eventModel->getPreviousEventsByServiceProvider($_SESSION['service_id']);
            $Upcomingevents = $this->eventModel->getUpcomingEventsByServiceProvider($_SESSION['service_id']);

            $data = [
                'previousEvents'=> $Previousevents,
                'upcomingEvents'=> $Upcomingevents
            ];
            $this->view('servicesP/v_s_complaints', $data);
        }

        public function complaintDetails(){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $complaintId = $_GET['complaintId'] ?? null;
                
                if(!$complaintId){
                    echo json_encode(['success' => false, 'error' => 'Complaint ID is required']);
                    return;
                }
                
                $complaint = $this->complaintsModel->getComplaintById($complaintId);
                echo json_encode(['success' => true, 'complaint' => $complaint]);
            }

        }

        public function getmyComplaints(){

            if($_SERVER['REQUEST_METHOD'] == 'GET'){


                $complaints = $this->complaintsModel->getComplaintsByServiceProvider($_SESSION['service_id']);
                echo json_encode(['complaints' => $complaints]);

            }
           
        }

        public function getComplaintDetails(){

            if($_SERVER['REQUEST_METHOD'] == 'GET'){
                $complaintId = $_GET['complaintId'] ?? null;
                
                if(!$complaintId){
                    echo json_encode(['success' => false, 'error' => 'Complaint ID is required']);
                    return;
                }
                
                $complaint = $this->complaintsModel->getComplaintById($complaintId);
                echo json_encode(['success' => true, 'complaint' => $complaint]);
            }

        }


        public function submitComplaint(){
            $this->isloggedIn();

            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                // Handle FormData from AJAX
                $data = [
                    'service_id' => $_SESSION['service_id'] ?? null,
                    'event_id' => $_POST['event_id'] ?? null,
                    'complainant_type' => $_POST['complainant_type'] ?? null,
                    'complaint_type' => $_POST['complaint_type'] ?? null,
                    'description_text' => $_POST['description_text'] ?? null,
                    'event_name' => $_POST['event_name'] ?? null
                ];
            
                // Validate required fields
                if(empty($data['service_id']) || empty($data['event_id']) || empty($data['complainant_type']) || empty($data['complaint_type']) || empty($data['description_text'])){
                    echo json_encode(['success' => false, 'error' => 'All fields are required']);
                    return;
                }

                if($this->complaintsModel->submitServicePComplaint($data)){
                    $this->notificationModel->ProvidercreateComplaintNotification($data['service_id'], $data['event_id']);

                    echo json_encode(['success' => true, 'message' => 'Complaint submitted successfully']);
                } else {
                    echo json_encode(['success' => false, 'error' => 'Failed to submit complaint. Please try again.']);
                }
            }

        }                                 

    
        public function chat(){
            $this->isloggedIn();

            // Get client conversations
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
            
            $data = [
                'totalEvents' => $this->eventModel->getTotalEventsByProvider($_SESSION['service_id']),
                'upcomingEventsCount' => $this->eventModel->getUpcomingEventsCountByServiceProvider($_SESSION['service_id']),
                'previousEvents' => $this->eventModel->getPreviousEventsByServiceProvider($_SESSION['service_id']),
                'totalPackages' => $this->packageModel->getTotalPackagesByProvider($_SESSION['service_id']),
                'Rating' => $this->ratingModel->getRatingsSummary($_SESSION['service_id']),
                'totalEarnings' => $this->paymentModel->getTotalEarningsByServiceProvider($_SESSION['service_id']),
            ];
            $this->view('servicesP/v_s_dashboard', $data);

            
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
            $this->isloggedIn();

            $data = [
                'accountdata' => $this->serviceModel->getServiceById($_SESSION['service_id'])
            ];
            $this->view('servicesP/v_s_accountSettings', $data);

        }

        public function notifications(){
            $this->isloggedIn();

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

        public function getUnreadNotificationCount(){
            $this->isloggedIn();
            
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $unreadNotifications = $this->notificationModel->getUnreadByUser('PROVIDER', $_SESSION['service_id']);
                $unreadCount = count($unreadNotifications);
                echo json_encode(['unreadCount' => $unreadCount, 'success' => true]);
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
            $this->isloggedIn();

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                
                // Process availability update
                
                // Sanitize POST data
                //$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data =[
                        'start_date' => trim($_POST['from-date']),
                        'end_date' => trim($_POST['to-date']),
                        'status' =>"booked",
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
            $this->isloggedIn();

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
