<?php

    class Users extends Controller {
        public function __construct(){
           
        }

        public function landing(){
            $this->view('users/v_landing');
        }
        public function login(){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process login
                redirect('Users/dashboard');
            }
            else {
                $this->view('users/v_login');
            }
        }

        public function choose_register(){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process registration
                redirect('Clients/signup');
            }
            else {
                $this->view('users/v_choose_register');
            }
        }

        public function processRegistration() {
            
        }

    }

?>