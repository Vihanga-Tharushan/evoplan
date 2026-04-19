<?php

  class Admin extends Controller {

    private $adminModel;
    private $ratingsModel;
    private $eventViewModel;
  
    public function __construct(){
      $this->adminModel = $this->model('M_admin');
      $this->ratingsModel = $this->model('M_ratings');
      $this->eventViewModel = $this->model('M_eventView');
    }

    public function stats(){
      $this->view('Admin/v_a_stats');
    }

    public function payments(){
      $this->view('Admin/v_a_payments');
    }

    public function applications(){
      $this->view('Admin/v_a_applications');
    }

    public function complaints(){
      $this->view('Admin/v_a_complaints');
    }

    // Profiles management

    public function profiles(){
      // Get all clients and service providers data from database
      $data = [
        'clients' => $this->adminModel->getClients(),
        'serviceProviders' => $this->adminModel->getServiceProviders()
      ];
      $this->view('Admin/v_a_profiles', $data);
    }

    public function delete_profile($user_id, $type = 'client'){
      if($this->adminModel->deleteProfile($user_id, $type)){
        flash('admin_message', 'Profile Deleted Successfully');
        redirect('Admin/profiles');
      } else {
        die('Something went wrong');
      }
    }

    // Events management

    public function events(){
      $data = [
        'events' => $this->eventViewModel->getEventsFullView()
      ];
      $this->view('Admin/v_a_events', $data);
    }

    public function getEventsData(){
      if($_SERVER['REQUEST_METHOD'] == 'GET'){
        header('Content-Type: application/json');
        $events = $this->eventViewModel->getEventsFullView();
        echo json_encode($events);
        exit;
      }
    }

    // Feedbacks and Reviews management

    public function feedbacks(){
      // Get all feedbacks and reviews from database
      $data = [
        'feedbacks' => $this->ratingsModel->getAllRatingsToAdmin()
      ];

      $this->view('Admin/v_a_feedbacks', $data);
    }

    public function delete_feedback($rating_id){
      if($this->ratingsModel->deleteRating($rating_id)){
        flash('admin_message', 'Feedback Deleted Successfully');
        redirect('Admin/feedbacks');
      } else {
        die('Something went wrong');
      }
    }

    // Admins and Issue Coordinators management

    public function admins(){
      // Get all admins and coordinators data from database
      $data = [
        'admins' => $this->adminModel->getAdmins(),
        'coordinators' => $this->adminModel->getCoordinators()
      ];
      
      $this->view('Admin/v_a_admins', $data);
    }

    public function admin_login(){
      if($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Form submitting
        // $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'a_email' => trim($_POST['a_email']),
          'a_password' => trim($_POST['a_password']),

          'a_email_err' => '',
          'a_password_err' => ''
        ];

        // Validate email
        if(empty($data['a_email'])){
          $data['a_email_err'] = 'Please enter your email';
        } else {
          if($this->adminModel->findAdminByEmail($data['a_email'])) {
              // User found
          } else {
            $data['a_email_err'] = 'Email is incorrect';
          }
        }
        

        // Validate password
        if(empty($data['a_password'])) {
          $data['a_password_err'] = 'Please enter your password';
        } 

        if(empty($data['a_email_err']) && empty($data['a_password_err'])) {
          // Log the admin
          // $loggedInAdmin = $this->adminModel->adminLogin($data['a_email'], $data['a_password']);
          $loggedInAdmin = $this->adminModel->adminLogin($data['a_email'], $data['a_password']);

          if ($loggedInAdmin) {
            ////////////////////////////////////////////
            /////////// Create Session /////////////////
            ////////////////////////////////////////////
            $this->view('Admin/v_a_stats');
          } else {
            $data['a_password_err'] = 'Password is incorrect';
            $this->view('Admin/v_a_login', $data);
          }
        } else {
          // Load view with errors
          $this->view('Admin/v_a_login', $data);
        }

      
      } else {
        // Intial Form
        $data = [
          'a_email' => '',
          'a_password' => '',

          'a_email_err' => '',
          'a_password_err' => ''
        ];

        // Load view
        $this->view('Admin/v_a_login', $data);
      }

    }

    public function Add_admin(){

      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Form Submitting
        // Validation
        //$POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Input data
        $data = [
                  'a_name' => trim($_POST['a_name']),
                  'a_email' => trim($_POST['a_email']),
                  'a_phone' => trim($_POST['a_phone']),
                  'a_password' => trim($_POST['a_password']),
                  'a_Cpassword' => trim($_POST['a_Cpassword']),

                  'a_name_err' => '',
                  'a_email_err' => '',
                  'a_phone_err' => '',
                  'a_password_err' => '',
                  'a_Cpassword_err' => ''
          ];

          // Validation data
          // Validate Name
          if(empty($data['a_name'])){
            $data['a_name_err'] = 'Please enter the name';
          } 

          // Validate Email
          if(empty($data['a_email'])){
            $data['a_email_err'] = 'Please enter the email';
          } elseif(!filter_var($data['a_email'], FILTER_VALIDATE_EMAIL)) { // Check email format
            $data['a_email_err'] = 'Please enter a valid email';
          } elseif($this->adminModel->findAdminByEmail($data['a_email'])){ // Check email is already registered
            $data['a_email_err'] = 'Email is already registered';
          }

          // Validate Phone
          if(empty($data['a_phone'])){  
            $data['a_phone_err'] = 'Please enter phone number';
          } elseif(strlen($data['a_phone']) < 9 || strlen($data['a_phone']) > 9 || !preg_match('/^[0-9]{9}+$/', $data['a_phone'])){
            $data['a_phone_err'] = 'Please enter a valid phone number';
          }

          /// Validate Password
          if(empty($data['a_password'])){ 
            $data['a_password_err'] = 'Please enter password';
          } elseif(strlen($data['a_password']) < 6){
            $data['a_password_err'] = 'Password must be at least 6 characters';
          }elseif(empty($data['a_Cpassword'])){
            $data['a_Cpassword_err'] = 'Please confirm password';
          } elseif($data['a_password'] !== $data['a_Cpassword']){
            $data['a_Cpassword_err'] = 'Passwords are not matching';
          }

          // Validation passed
          if(empty($data['a_name_err']) && empty($data['a_email_err']) && empty($data['a_phone_err']) && empty($data['a_password_err']) && empty($data['a_Cpassword_err'])){
            // Hash Password
            $data['a_password'] = password_hash($data['a_password'], PASSWORD_DEFAULT);
          
            // Register Admin
              if($this->adminModel->addAdmin($data)){
                redirect('Admin/admins');
              } else {
                die('Something went wrong');
              }

          } else {
            // Load form with errors
            $this->view('Admin/v_a_add_admin', $data);
          }

      } else {
        // Initial form
        $data = [
          'a_name' => '',
          'a_email' => '',
          'a_phone' => '',
          'a_password' => '',
          'a_Cpassword' => '',

          'a_name_err' => '',
          'a_email_err' => '',
          'a_phone_err' => '',
          'a_password_err' => '',
          'a_Cpassword_err' => ''
            ];
      }
      $this->view('Admin/v_a_add_admin', $data);
    }

    public function update_admin($a_id){

      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Form Submitting
        // Validation
        //$POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Input data
        $data = [
                  'a_id' => $a_id,
                  'a_name' => trim($_POST['a_name']),
                  'a_email' => trim($_POST['a_email']),
                  'a_phone' => trim($_POST['a_phone']),
                  'a_password' => trim($_POST['a_password']),
                  'a_Cpassword' => trim($_POST['a_Cpassword']),

                  'a_name_err' => '',
                  'a_email_err' => '',
                  'a_phone_err' => '',
                  'a_password_err' => '',
                  'a_Cpassword_err' => ''
          ];

          // Validation data
          // Validate Name
          if(empty($data['a_name'])){
            $data['a_name_err'] = 'Please enter the name';
          } 

          // Validate Email
          if(empty($data['a_email'])){
            $data['a_email_err'] = 'Please enter the email';
          } elseif(!filter_var($data['a_email'], FILTER_VALIDATE_EMAIL)) { // Check email format
            $data['a_email_err'] = 'Please enter a valid email';
          }

          // Validate Phone
          if(empty($data['a_phone'])){  
            $data['a_phone_err'] = 'Please enter phone number';
          } elseif(strlen($data['a_phone']) < 9 || strlen($data['a_phone']) > 9 || !preg_match('/^[0-9]{9}+$/', $data['a_phone'])){
            $data['a_phone_err'] = 'Please enter a valid phone number';
          }

          /// Validate Password
          if(empty($data['a_password'])){ 
            $data['a_password_err'] = 'Please enter password';
          } elseif(strlen($data['a_password']) < 6){
            $data['a_password_err'] = 'Password must be at least 6 characters';
          }elseif(empty($data['a_Cpassword'])){
            $data['a_Cpassword_err'] = 'Please confirm password';
          } elseif($data['a_password'] !== $data['a_Cpassword']){
            $data['a_Cpassword_err'] = 'Passwords are not matching';
          }

          // Validation passed
          if(empty($data['a_name_err']) && empty($data['a_email_err']) && empty($data['a_phone_err']) && empty($data['a_password_err']) && empty($data['a_Cpassword_err'])){
            // Hash Password
            $data['a_password'] = password_hash($data['a_password'], PASSWORD_DEFAULT);
          
            // Register Admin
              if($this->adminModel->updateAdmin($data)){
                redirect('Admin/admins');
              } else {
                die('Something went wrong');
              }

          } else {
            // Load form with errors
            $this->view('Admin/v_a_update_admin', $data);
          }

      } else {
        $admin = $this->adminModel->getAdminById($a_id);

        $data = [
          'a_id' => $a_id,
          'a_name' => $admin->a_name,
          'a_email' => $admin->a_email,
          'a_phone' => $admin->a_phone,
          'a_password' => $admin->a_password,
          'a_Cpassword' => $admin->a_password,

          'a_name_err' => '',
          'a_email_err' => '',
          'a_phone_err' => '',
          'a_password_err' => '',
          'a_Cpassword_err' => ''
            ];
      }
      $this->view('Admin/v_a_update_admin', $data);
    }

    public function delete_admin($a_id){
        if($this->adminModel->deleteAdmin($a_id)){
          flash('admin_message', 'Admin Deleted Successfully');
          redirect('Admin/admins');
        } else {
          die('Something went wrong');
        }
    }

    public function Add_coordinator(){

      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Form Submitting
        // Validation
        //$POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Input data
        $data = [
                  'ic_name' => trim($_POST['ic_name']),
                  'ic_email' => trim($_POST['ic_email']),
                  'ic_phone' => trim($_POST['ic_phone']),
                  'ic_password' => trim($_POST['ic_password']),
                  'ic_Cpassword' => trim($_POST['ic_Cpassword']),

                  'ic_name_err' => '',
                  'ic_email_err' => '',
                  'ic_phone_err' => '',
                  'ic_password_err' => '',
                  'ic_Cpassword_err' => ''
          ];

          // Validation data
          // Validate Name
          if(empty($data['ic_name'])){
            $data['ic_name_err'] = 'Please enter the name';
          } 

          // Validate Email
          if(empty($data['ic_email'])){
            $data['ic_email_err'] = 'Please enter the email';
          } elseif(!filter_var($data['ic_email'], FILTER_VALIDATE_EMAIL)) { // Check email format
              $data['ic_email_err'] = 'Please enter a valid email';
          } elseif($this->adminModel->findCoordinatorByEmail($data['ic_email'])){ // Check email is already registered
              $data['ic_email_err'] = 'Email is already registered';
          }
          

          // Validate Phone
          if(empty($data['ic_phone'])){  
            $data['ic_phone_err'] = 'Please enter phone number';
          } elseif(strlen($data['ic_phone']) < 9 || strlen($data['ic_phone']) > 9 || !preg_match('/^[0-9]{9}+$/', $data['ic_phone'])){
            $data['ic_phone_err'] = 'Please enter a valid phone number';
          }

          /// Validate Password
          if(empty($data['ic_password'])){ 
            $data['ic_password_err'] = 'Please enter password';
          } elseif(strlen($data['ic_password']) < 6){
            $data['ic_password_err'] = 'Password must be at least 6 characters';
          }elseif(empty($data['ic_Cpassword'])){
            $data['ic_Cpassword_err'] = 'Please confirm password';
          } elseif($data['ic_password'] !== $data['ic_Cpassword']){
            $data['ic_Cpassword_err'] = 'Passwords are not matching';
          }

          // Validation passed
          if(empty($data['ic_name_err']) && empty($data['ic_email_err']) && empty($data['ic_phone_err']) && empty($data['ic_password_err']) && empty($data['ic_Cpassword_err'])){
            // Hash Password
            $data['ic_password'] = password_hash($data['ic_password'], PASSWORD_DEFAULT);

            // Register Coordinator
              if($this->adminModel->addCoordinator($data)){
                redirect('Admin/admins');
              } else {
                die('Something went wrong');
              }

          } else {
            // Load form with errors
            $this->view('Admin/v_a_add_coordinator', $data);
          }

      } else {
        // Initial form
        $data = [
          'ic_name' => '',
          'ic_email' => '',
          'ic_phone' => '',
          'ic_password' => '',
          'ic_Cpassword' => '',

          'ic_name_err' => '',
          'ic_email_err' => '',
          'ic_phone_err' => '',
          'ic_password_err' => '',
          'ic_Cpassword_err' => ''
            ];
      }
      $this->view('Admin/v_a_add_coordinator', $data);
    }

    public function update_coordinator($ic_id){

      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Form Submitting
        // Validation
        //$POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Input data
        $data = [
                  'ic_id' => $ic_id,
                  'ic_name' => trim($_POST['ic_name']),
                  'ic_email' => trim($_POST['ic_email']),
                  'ic_phone' => trim($_POST['ic_phone']),
                  'ic_password' => trim($_POST['ic_password']),
                  'ic_Cpassword' => trim($_POST['ic_Cpassword']),

                  'ic_name_err' => '',
                  'ic_email_err' => '',
                  'ic_phone_err' => '',
                  'ic_password_err' => '',
                  'ic_Cpassword_err' => ''
          ];

          // Validation data
          // Validate Name
          if(empty($data['ic_name'])){
            $data['ic_name_err'] = 'Please enter the name';
          } 

          // Validate Email
          if(empty($data['ic_email'])){
            $data['ic_email_err'] = 'Please enter the email';
          } elseif(!filter_var($data['ic_email'], FILTER_VALIDATE_EMAIL)) { // Check email format
            $data['ic_email_err'] = 'Please enter a valid email';
          }

          // Validate Phone
          if(empty($data['ic_phone'])){  
            $data['ic_phone_err'] = 'Please enter phone number';
          } elseif(strlen($data['ic_phone']) < 9 || strlen($data['ic_phone']) > 9 || !preg_match('/^[0-9]{9}+$/', $data['ic_phone'])){
            $data['ic_phone_err'] = 'Please enter a valid phone number';
          }

          /// Validate Password
          if(empty($data['ic_password'])){ 
            $data['ic_password_err'] = 'Please enter password';
          } elseif(strlen($data['ic_password']) < 6){
            $data['ic_password_err'] = 'Password must be at least 6 characters';
          }elseif(empty($data['ic_Cpassword'])){
            $data['ic_Cpassword_err'] = 'Please confirm password';
          } elseif($data['ic_password'] !== $data['ic_Cpassword']){
            $data['ic_Cpassword_err'] = 'Passwords are not matching';
          }

          // Validation passed
          if(empty($data['ic_name_err']) && empty($data['ic_email_err']) && empty($data['ic_phone_err']) && empty($data['ic_password_err']) && empty($data['ic_Cpassword_err'])){
            // Hash Password
            $data['ic_password'] = password_hash($data['ic_password'], PASSWORD_DEFAULT);

            // Register Admin
              if($this->adminModel->updateCoordinator($data)){
                redirect('Admin/admins');
              } else {
                die('Something went wrong');
              }

          } else {
            // Load form with errors
            $this->view('Admin/v_a_update_coordinator', $data);
          }

      } else {
        $coordinator = $this->adminModel->getCoordinatorById($ic_id);

        $data = [
          'ic_id' => $ic_id,
          'ic_name' => $coordinator->ic_name,
          'ic_email' => $coordinator->ic_email,
          'ic_phone' => $coordinator->ic_phone,
          'ic_password' => $coordinator->ic_password,
          'ic_Cpassword' => $coordinator->ic_password,

          'ic_name_err' => '',
          'ic_email_err' => '',
          'ic_phone_err' => '',
          'ic_password_err' => '',
          'ic_Cpassword_err' => ''
          ];
      }
      $this->view('Admin/v_a_update_coordinator', $data);
    }

    public function delete_coordinator($ic_id){
        if($this->adminModel->deleteCoordinator($ic_id)){
          flash('admin_message', 'Admin Deleted Successfully');
          redirect('Admin/admins');
        } else {
          die('Something went wrong');
        }
    }

    public function coordinator_login(){
      if($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Form submitting
        // $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'ic_email' => trim($_POST['ic_email']),
          'ic_password' => trim($_POST['ic_password']),

          'ic_email_err' => '',
          'ic_password_err' => ''
        ];

        // Validate email
        if(empty($data['ic_email'])){
          $data['ic_email_err'] = 'Please enter your email';
        } else {
          if($this->adminModel->findCoordinatorByEmail($data['ic_email'])) {
              // User found
          } else {
            $data['ic_email_err'] = 'Email is Incorrect';
          }
        }
        

        // Validate password
        if(empty($data['ic_password'])) {
          $data['ic_password_err'] = 'Please enter your password';
        } 

        if(empty($data['ic_email_err']) && empty($data['ic_password_err'])) {
          // Log the admin
          // $loggedInAdmin = $this->adminModel->adminLogin($data['a_email'], $data['a_password']);
          $loggedInAdmin = $this->adminModel->adminLogin($data['ic_email'], $data['ic_password']);

          if ($loggedInAdmin) {
            ////////////////////////////////////////////
            /////////// Create Session /////////////////
            ////////////////////////////////////////////
            die ('Login Successfull');
          } else {
            $data['ic_password_err'] = 'Password is incorrect';
            $this->view('issue/v_ic_login', $data);
          }
        } else {
          // Load view with errors
          $this->view('issue/v_ic_login', $data);
        }

      
      } else {
        // Intial Form
        $data = [
          'ic_email' => '',
          'ic_password' => '',

          'ic_email_err' => '',
          'ic_password_err' => ''
        ];

        // Load view
        $this->view('issue/v_ic_login', $data);
      }

    }

    // Feature page controller methods

    public function features(){
      // Get all landing page photos from database
      $data = [
        'photos' => $this->adminModel->getLandingPagePhotos()
      ];

      $this->view('Admin/v_a_features', $data);
    }

    public function Add_photo(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Form Submitting
        // Validation
        //$POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Input data
        $data = [
                  'event_name' => trim($_POST['event_name']),
                  'event_date' => trim($_POST['event_date']),
                  'event_photo' => isset($_FILES['event_photo']) ? $_FILES['event_photo'] : '',
                  'event_photo_name' => isset($_FILES['event_photo']['name']) ? time() . '_' . $_FILES['event_photo']['name'] : '',

                  'event_name_err' => '',
                  'event_date_err' => '',
                  'event_photo_err' => ''
          ];

          // Validation data
          // Validate Name
          if(empty($data['event_name'])){
            $data['event_name_err'] = 'Please enter the event name';
          } 

          // Validate Email
          if(empty($data['event_date'])){
            $data['event_date_err'] = 'Please enter the event date';
          }

          // Validate and upload Background Image
          if(empty($_FILES['event_photo']['name'])){
            $data['event_photo_err'] = 'Please select an image file';
          } elseif($_FILES['event_photo']['error'] !== UPLOAD_ERR_OK){
            $data['event_photo_err'] = 'Error uploading file. Please try again.';
          } elseif(!uploadImage($_FILES['event_photo']['tmp_name'], $data['event_photo_name'], '/img/packageImg/')){
            $data['event_photo_err'] = 'Image upload failed. Please try again.';
          }
          

          // Validation passed
          if(empty($data['event_name_err']) && empty($data['event_date_err']) && empty($data['event_photo_err'])){
            
            // Register Admin
              if($this->adminModel->addPhoto($data)){
                redirect('Admin/features');
              } else {
                die('Something went wrong');
              }

          } else {
            // Load form with errors
            $this->view('Admin/v_a_add_photo', $data);
          }

      } else {
        // Initial form
        $data = [
          'event_name' => '',
          'event_date' => '',
          'event_photo' => '',
          'event_photo_name' => '',

          'event_name_err' => '',
          'event_date_err' => '',
          'event_photo_err' => ''
            ];
      }
      $this->view('Admin/v_a_add_photo', $data);
    }

    public function Update_photo($photo_id){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Form Submitting
        // Validation
        //$POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Get existing photo to preserve old photo name if no new photo is uploaded
        $existingPhoto = $this->adminModel->getPhotoById($photo_id);

        // Input data
        $data = [
                  'photo_id' => $photo_id,
                  'event_name' => trim($_POST['event_name']),
                  'event_date' => trim($_POST['event_date']),
                  'event_photo' => isset($_FILES['event_photo']) ? $_FILES['event_photo'] : '',
                  'event_photo_name' => isset($_FILES['event_photo']['name']) ? time() . '_' . $_FILES['event_photo']['name'] : $existingPhoto->event_photo_name,

                  'event_name_err' => '',
                  'event_date_err' => '',
                  'event_photo_err' => ''
          ];

          // Validation data
          // Validate Name
          if(empty($data['event_name'])){
            $data['event_name_err'] = 'Please enter the event name';
          } 

          // Validate Date
          if(empty($data['event_date'])){
            $data['event_date_err'] = 'Please enter the event date';
          }

          // Validate and upload Background Image (only if a new file is selected)
          if(!empty($_FILES['event_photo']['name'])){
            if($_FILES['event_photo']['error'] !== UPLOAD_ERR_OK){
              $data['event_photo_err'] = 'Error uploading file. Please try again.';
            } elseif(!uploadImage($_FILES['event_photo']['tmp_name'], $data['event_photo_name'], '/img/packageImg/')){
                $data['event_photo_err'] = 'Image upload failed. Please try again.';
            }
          }
          

          // Validation passed
          if(empty($data['event_name_err']) && empty($data['event_date_err']) && empty($data['event_photo_err'])){
            
            // Check if new photo was uploaded
            if(!empty($_FILES['event_photo']['name'])){
              // New photo uploaded - update everything including photo
              if($this->adminModel->updatePhoto($data)){
                redirect('Admin/features');
              } else {
                die('Something went wrong');
              }
            } else {
              // No new photo - update only name and date, photo column stays same
              if($this->adminModel->updatePhotoInfo($data)){
                redirect('Admin/features');
              } else {
                die('Something went wrong');
              }
            }

          } else {
            // Load form with errors
            $this->view('Admin/v_a_update_photo', $data);
          }

      } else {
        $photo = $this->adminModel->getPhotoById($photo_id);
        
        if(!$photo){
          die('Photo not found');
        }
        
        $data = [
          'photo_id' => $photo_id,
          'event_name' => $photo->event_name,
          'event_date' => $photo->event_date,
          'photo_path' => isset($photo->event_photo_name) ? 'img/packageImg/' . $photo->event_photo_name : '',
          'event_photo' => '',
          'event_photo_name' => $photo->event_photo_name,

          'event_name_err' => '',
          'event_date_err' => '',
          'event_photo_err' => ''
            ];
      }
      $this->view('Admin/v_a_update_photo', $data);
    }
    
    public function Delete_photo($photo_id){
        if($this->adminModel->deletePhoto($photo_id)){
          flash('admin_message', 'Photo Deleted Successfully');
          redirect('Admin/features');
        } else {
          die('Something went wrong');
        }
    }

    public function main_page(){
      $this->view('LandingPage/LandingPage');
    }
  }

?>