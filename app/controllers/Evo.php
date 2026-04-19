<?php

class Evo extends Controller {
      private $landingModel;
        public function __construct(){

            $this->landingModel = $this->model('M_Landing');
    }
    public function EvoPlan(){
      // Get landing page photos from database
      $photos = $this->landingModel->getLandingPhotos();
      
      // Initialize data array with photos
      $data = [
        'photos' => is_array($photos) ? $photos : []
      ];
      
      $this->view('LandingPage/LandingPage', $data);
    }

    public function Client(){
      $this->view('Users/v_client_login');
    }

    public function ServiceProvider(){
     
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Process login
        redirect('Service/dashboard');
      } else {
        //initial form
        $this->view('Users/v_serviceP_login');
      }
    }

    public function AdminLogin(){
      $this->view('Admin/v_a_login');
    }

     public function Login(){
      $this->view('users/v_login');
    }

     public function Register(){
      $this->view('users/v_choose_register');
    }

}


?>