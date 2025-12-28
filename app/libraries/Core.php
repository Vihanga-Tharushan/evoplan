<?php
    class Core{
        // URL format --> /controller/method/params
        protected $currentController = 'Pages';
        protected $currentMethod = 'index';
        protected $params = [];

        public function __construct(){
            $url = $this->getURL();

            //if the controller file exists, then load it
            if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php')){
                $this->currentController = ucwords($url[0]);

                // unset the first element of the URL array
                unset($url[0]);

                //call the controller
                require_once '../app/controllers/'.$this->currentController.'.php';

                // instantiate the controller class
                $this->currentController = new $this->currentController;
 
                //check wheather the method exists in the controller

                if(isset($url[1])){
                    if(method_exists($this->currentController, $url[1])){
                        $this->currentMethod = $url[1];

                        // unset the second element of the URL array
                        unset($url[1]);
                    }
                }

                //get the parameter list
                $this->params = $url ? array_values($url) : [];


                //call the current method with the parameters
                call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
            }
        }

        public function getURL(){
            
            if(isset($_GET['url'])){
                $url = rtrim($_GET['url'], '/');
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = explode('/', $url);

                return $url;
            }
        }

    }

?>