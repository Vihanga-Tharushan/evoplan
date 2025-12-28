<?php
    class Package extends Controller {
        private $packageModel;

        public function __construct(){
            $this->packageModel = $this->model('M_package');
        }

        public function createPackage(){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                
                // Process package creation
                
                // Sanitize POST data
                //$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data =[
                        'title' => trim($_POST['title']),
                        'details' => trim($_POST['details']),
                        'price' => trim($_POST['price']),
                        'bg_image' => $_FILES['bg_image'],
                        'bg_image_name' => time() . '_' . $_FILES['bg_image']['name'],
                        'notes' => trim($_POST['notes']),
                        'service_id' => $_SESSION['service_id'],

                        'title_err' => '',
                        'details_err' => '',
                        'price_err' => '',
                        'bg_image_err' => ''
                ];

                // Validate Title
                
                    if(empty($data['title'])){
                        $data['title_err'] = 'Please enter a title';
                    }

                    // Validate Details
                    if(empty($data['details'])){
                        $data['details_err'] = 'Please enter package details';
                    }

                    // Validate Price
                    if(empty($data['price'])){
                        $data['price_err'] = 'Please enter a price';
                    }

                    // Validate and upload Background Image
                    if(uploadImage($_FILES['bg_image']['tmp_name'], $data['bg_image_name'], '/img/packageImg/')){
                        // Image uploaded successfully
                    } else {
                        $data['bg_image_err'] = 'Image upload failed. Please try again.';
                    }

                    // Make sure errors are empty
                    if(empty($data['title_err']) && empty($data['details_err']) && empty($data['price_err']) && empty($data['bg_image_err'])){
                        // Validated
                        // TO DO: Add package to database
                        if($this->packageModel->create($data)){
                            flash('package_message', 'Package created successfully');
                            redirect('Service/packages');
                        }else{
                            die('Something went wrong');
                        }
                    }else{
                        $this->view('servicesP/packages/v_s_createpackage', $data);
                    }
                
            }else{
                $data =[
                    'title' => '',
                    'details' => '',
                    'price' => '',
                    'bg_image' => '',
                    'notes' => '',
                    'bg_image_name' => '',
                    

                    'title_err' => '',
                    'details_err' => '',
                    'price_err' => '',
                    'bg_image_err' => ''
                ];

                $this->view('servicesP/packages/v_s_createpackage', $data);
            }
        }

        public function editPackage($package_id){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                
                // Process package creation
                
                // Sanitize POST data
                //$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data =[
                        'id' => $package_id,
                        'title' => trim($_POST['title']),
                        'details' => trim($_POST['details']),
                        'price' => trim($_POST['price']),
                        'bg_image' => $_FILES['bg_image'],
                        'bg_image_name' => time() . '_' . $_FILES['bg_image']['name'],
                        'notes' => trim($_POST['notes']),
                        

                        'title_err' => '',
                        'details_err' => '',
                        'price_err' => '',
                        'bg_image_err' => ''
                ];

                // Validate Title
                
                    if(empty($data['title'])){
                        $data['title_err'] = 'Please enter a title';
                    }

                    // Validate Details
                    if(empty($data['details'])){
                        $data['details_err'] = 'Please enter package details';
                    }

                    // Validate Price
                    if(empty($data['price'])){
                        $data['price_err'] = 'Please enter a price';
                    }

                    // Validate and upload Background Image
                    if(uploadImage($_FILES['bg_image']['tmp_name'], $data['bg_image_name'], '/img/packageImg/')){
                        // Image uploaded successfully
                    } else {
                        $data['bg_image_err'] = 'Image upload failed. Please try again.';
                    }

                    // Make sure errors are empty
                    if(empty($data['title_err']) && empty($data['details_err']) && empty($data['price_err'])){
                        // Validated
                        // TO DO: Add package to database
                        if($this->packageModel->edit($data)){
                            flash('package_message', 'Package edited successfully');
                            redirect('Service/packages');
                        }else{
                            die('Something went wrong');
                        }
                    }else{
                        $this->view('servicesP/packages/v_s_createpackage', $data);
                    }
                
            }else{
                $package = $this->packageModel->getPackageById($package_id);
                //check ownership
                if($package->service_id != $_SESSION['service_id']){
                    redirect('Service/packages');
                }
                $data =[
                    'id' => $package_id,
                    'title' => $package->title,
                    'details' => $package->details,
                    'price' => $package->price,
                    'bg_image' => '',
                    'notes' => $package->notes,
                    'bg_image_name' => $package->bg_image_name,

                    'title_err' => '',
                    'details_err' => '',
                    'price_err' => '',
                    'bg_image_err' => ''
                ];

                $this->view('servicesP/packages/v_s_updatepackage', $data);
            }
        }

        public function deletePackage($id){

            
            //check ownership
                $package = $this->packageModel->getPackageById($id);
                if($package->service_email != $_SESSION['service_email']){
                    redirect('Service/packages');
                }
                // Process service deletion
                if($this->packageModel->deletePackage($id)){
                    flash('package_message', 'Package deleted successfully');
                    redirect('Service/packages');
                } else {
                    die("Something went wrong");
                }

                
           
        }

        public function viewPackage($package_id){

            $package = $this->packageModel->getPackageById($package_id);

            $data = [
                'package' => $package
            ];

            $this->view('clients/packages/v_viewpackage', $data);
        }
        

    }