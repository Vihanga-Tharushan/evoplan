<?php
    class Package extends Controller {
        private $packageModel;

        public function __construct(){
            $this->packageModel = $this->model('M_package');
        }

        public function createPackage(){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                
                
                $data =[
                        'title' => trim($_POST['title']),
                        'details' => trim($_POST['details']),
                        'price' => trim($_POST['price']),
                        'bg_image' => $_FILES['bg_image'],
                        'bg_image_name' => time() . '_' . $_FILES['bg_image']['name'],
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
                if(isset($_FILES['bg_image']) && $_FILES['bg_image']['error'] == 0){
                    if(uploadImage($_FILES['bg_image']['tmp_name'], $data['bg_image_name'], '/img/packageImg/')){
                        // Image uploaded successfully
                    } else {
                        $data['bg_image_err'] = 'Image upload failed. Please try again.';
                    }
                } else {
                    $data['bg_image_err'] = 'Please select an image';
                }

                // Make sure errors are empty
                if(empty($data['title_err']) && empty($data['details_err']) && empty($data['price_err']) && empty($data['bg_image_err'])){
                    // Validated - Add package to database
                    if($this->packageModel->create($data)){
                        // Return success JSON for AJAX
                        echo json_encode(['success' => true, 'message' => 'Package created successfully']);
                        exit;
                    }else{
                        echo json_encode(['success' => false, 'message' => 'Failed to create package']);
                        exit;
                    }
                }else{
                    // Return errors JSON for AJAX
                    $errors = [];
                    if(!empty($data['title_err'])) $errors['title'] = $data['title_err'];
                    if(!empty($data['details_err'])) $errors['details'] = $data['details_err'];
                    if(!empty($data['price_err'])) $errors['price'] = $data['price_err'];
                    if(!empty($data['bg_image_err'])) $errors['bg_image'] = $data['bg_image_err'];
                    
                    echo json_encode(['success' => false, 'errors' => $errors]);
                    exit;
                }
                
            }else{
                // For non-AJAX requests, redirect
                redirect('Service/packages');
            }
        }

        public function editPackage(){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                
                // Handle AJAX FormData submission
                $data =[
                        'id' => $_POST['id'],
                        'title' => trim($_POST['title']),
                        'details' => trim($_POST['details']),
                        'price' => trim($_POST['price']),
                        'bg_image' => $_FILES['bg_image'],
                        'bg_image_name' => time() . '_' . $_FILES['bg_image']['name'],
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

                // Validate and upload Background Image (optional for edit)
                if(isset($_FILES['bg_image']) && $_FILES['bg_image']['error'] == 0){
                    if(uploadImage($_FILES['bg_image']['tmp_name'], $data['bg_image_name'], '/img/packageImg/')){
                        // Image uploaded successfully
                    } else {
                        $data['bg_image_err'] = 'Image upload failed. Please try again.';
                    }
                } else {
                    // Keep existing image if no new image uploaded
                    $existingPackage = $this->packageModel->getPackageById($_POST['id']);
                    $data['bg_image_name'] = $existingPackage->bg_image_name;
                }

                // Make sure errors are empty
                if(empty($data['title_err']) && empty($data['details_err']) && empty($data['price_err']) && empty($data['bg_image_err'])){
                    // Validated - Update package in database
                    if($this->packageModel->edit($data)){
                        // Return success JSON for AJAX
                        echo json_encode(['success' => true, 'message' => 'Package updated successfully']);
                        exit;
                    }else{
                        echo json_encode(['success' => false, 'message' => 'Failed to update package']);
                        exit;
                    }
                }else{
                    // Return errors JSON for AJAX
                    $errors = [];
                    if(!empty($data['title_err'])) $errors['title'] = $data['title_err'];
                    if(!empty($data['details_err'])) $errors['details'] = $data['details_err'];
                    if(!empty($data['price_err'])) $errors['price'] = $data['price_err'];
                    if(!empty($data['bg_image_err'])) $errors['bg_image'] = $data['bg_image_err'];
                    
                    echo json_encode(['success' => false, 'errors' => $errors]);
                    exit;
                }
                
            }else{
                // For non-AJAX requests, redirect
                redirect('Service/packages');
            }
        }

        public function deletePackage(){

            if($_SERVER['REQUEST_METHOD'] = 'POST'){
                    $input = json_decode(file_get_contents('php://input'), true);
                $id = $input['package_id'];
                //check ownership

                $package = $this->packageModel->getPackageById($id);
                if($package->service_id != $_SESSION['service_id']){
                    echo json_encode(['success' => false, 'message' => 'Unauthorized action']);
                    exit;
                }
                // Process service deletion
                if($this->packageModel->deletePackage($id)){
                    echo json_encode(['success' => true, 'message' => 'Package deleted successfully']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Something went wrong']);
                }
            }else{
                redirect('Service/packages');
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