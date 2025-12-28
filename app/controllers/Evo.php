<?php

class Evo extends Controller {
        public function __construct(){
    }
    public function EvoPlan(){
      $this->view('LandingPage/LandingPage');
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