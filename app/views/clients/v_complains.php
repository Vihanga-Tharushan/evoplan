<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/inc/clientTaskbar/clientTaskbar.php'; ?>
<?php require_once APPROOT . '/views/inc/clientsidebar/sidebar6.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/components/client/signup.css">

<!-- Feedback Section -->
    <div class="container signup-container">
  <!-- Header with Logo -->
  <header class="header">
    <img src="<?php echo URLROOT; ?>/img/EvoPlan_Logo_new-removebg-preview 2.svg" alt="EvoPlans Logo" class="logo">
  </header>

  <!-- Main Title -->
  <div class="main-title">
    <h1>Complains Section</h1>
  </div>

  <!-- Form Card -->
  <div class="form-container">

    <form class="signup-form" method="POST" action="<?php echo URLROOT; ?>/Clients/complains">
      <!-- Form Fields -->
      <div class="form-fields">
        <div class="form-group">
          <label for="firstName">Name</label>
          <input type="text" id="firstName" name="first_name" class="form-input" autocomplete="given-name" >
        </div>

        <div class="form-group">
          <label for="firstName">Event Name</label>
          <input type="text" id="firstName" name="first_name" class="form-input" autocomplete="given-name" >
        </div>

        <div class="form-group">
          <label for="Address">Service Provider</label>
          <input type="text" id="Address" name="address" class="form-input" autocomplete="street-address" >
        </div>

        <div class="form-group">
          <label for="Address">Complain</label>
          <textarea rows="10" cols="90"></textarea>
        </div>

        

        
      <!-- Submit Button -->
      <span type="submit" class="submit-btn" style="text-align: center;" onclick="location.href='<?php echo URLROOT; ?>/Clients/home'">Send</span>
    </form>
  </div>
</div>

<?php require APPROOT . '/views/inc/footer.php';?>
