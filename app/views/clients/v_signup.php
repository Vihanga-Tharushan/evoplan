<?php require_once APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/components/client/signup.css">

 
<div class="container signup-container">
  <!-- Header with Logo -->
  <header class="header">
    <img src="<?php echo URLROOT; ?>/img/EvoPlan_Logo_new-removebg-preview 2.svg" alt="EvoPlans Logo" class="logo">
  </header>

  <!-- Main Title -->
  <div class="main-title">
    <h1>CREATE A NEW ACCOUNT</h1>
  </div>

  <!-- Form Card -->
  <div class="form-container">
    <div class="form-header">
      <h2>Personal Info</h2>
    </div>

    <form class="signup-form" method="POST" action="<?php echo URLROOT; ?>/Clients/register">
      <!-- Form Fields -->
      <div class="form-fields">
        <div class="form-group">
          <label for="firstName">name</label>
          <input type="text" id="name" name="name" class="form-input" autocomplete="given-name" >
          <span><?php echo $data['name_err']; ?></span>
        </div>

        <div class="form-group">
          <label for="Address">Address</label>
          <input type="text" id="dddress" name="address" class="form-input" autocomplete="street-address" >
          <span><?php echo $data['address_err']; ?></span>

        </div>

        <div class="form-group span-2">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" class="form-input" autocomplete="email" placeholder="you@example.com">
          <span><?php echo $data['email_err']; ?></span>
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" class="form-input" autocomplete="new-password" placeholder="xxxxxxxx">
          <span><?php echo $data['password_err']; ?></span>
        </div>

        <div class="form-group">
          <label for="confirmPassword">Confirm Password</label>
          <input type="password" id="confirm_Password" name="confirm_password" class="form-input" autocomplete="new-password" >
          <span><?php echo $data['confirm_password_err']; ?></span>
        </div>
      </div>

      <!-- Terms and Conditions -->
      <div class="terms-section">
        <label class="checkbox-container">
          <input type="checkbox" id="terms" name="terms" class="checkbox" >
          <span class="terms-text">
            I accept the <span class="highlight" onclick="location.href='<?php echo URLROOT; ?>/Clients/terms'">EvoPlans Terms and Conditions</span>
          </span>
          <span><?php echo $data['terms_err']; ?></span>
        </label>
      </div>

      <!-- Submit Button -->
      <button type="submit" class="submit-btn" onclick="location.href='<?php echo URLROOT; ?>/Clients/home'">Create</button>
    </form>
  </div>
</div>

<?php require APPROOT . '/views/inc/footer.php';?>
