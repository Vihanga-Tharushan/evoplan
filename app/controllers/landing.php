<?php

class Landing extends Controller {
  private $landingModel;

  public function __construct() {
    $this->landingModel = $this->model('M_Landing'); 
  }

  public function index() {
    // Get landing page photos from database
    $photos = $this->landingModel->getLandingPhotos();
    
    // Initialize data array with photos
    $data = [
      'photos' => is_array($photos) ? $photos : []
    ];
    
    // Load the view and pass photos data
    $this->view('LandingPage/LandingPage', $data);
  }

  public function landingPhotos() {
    $photos = $this->landingModel->getLandingPhotos();
    return $photos;
  }
}
?>