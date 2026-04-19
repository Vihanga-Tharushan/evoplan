<?php

    class Controller{
        public function model($model){
            //to load a model
            require_once '../app/models/' . $model . '.php';

            //Instantiate the model and pass it to the controller member variable
            return new $model();
        }
        public function view($view, $data= []){
            //to load a view 
            if(file_exists('../app/views/'. $view . '.php')){
                extract($data);
                require_once '../app/views/' . $view . '.php';
            }else{
                //view does not exist
                die('View does not exist');
            }
        }
    }





?>