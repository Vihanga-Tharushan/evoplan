<?php require_once APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/components/client/signup.css">

<main class="container">
  <!-- Header with Logo -->
  <header class="header">
    <a href="<?php echo URLROOT; ?>" class="brand" aria-label="EvoPlan Home">
      <img src="<?php echo URLROOT; ?>/public/img/LandingPage/Logo.svg" alt="EvoPlan" class="logo">
    </a>
  </header>

  <!-- Main Title -->
  <section class="main-title">
    <h1>Create Client Account</h1>
  </section>

  <!-- Form Card -->
  <section class="form-container">
    <div class="form-header">
      <h2>Personal Info</h2>
    </div>

    <form method="POST" action="<?php echo URLROOT; ?>/Clients/register">
      <!-- Form Fields -->
      <div class="form-fields">
        <div class="form-group">
          <label for="name">Full Name</label>
          <input type="text" id="name" name="name" class="form-input" placeholder="Your full name" autocomplete="name" value="<?php echo $data['name']; ?>">
          <span><?php echo $data['name_err']; ?></span>
        </div>

        <div class="form-group">
          <label for="address">Address</label>
          <input type="text" id="address" name="address" class="form-input" placeholder="Your address" autocomplete="street-address" value="<?php echo $data['address']; ?>">
          <span><?php echo $data['address_err']; ?></span>
        </div>

        <div class="form-group span-2">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" class="form-input" placeholder="you@example.com" autocomplete="email" value="<?php echo $data['email']; ?>">
          <span><?php echo $data['email_err']; ?></span>
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" class="form-input" placeholder="Create a password" autocomplete="new-password" value="<?php echo $data['password']; ?>">
          <span><?php echo $data['password_err']; ?></span>
        </div>

        <div class="form-group">
          <label for="confirm_password">Confirm Password</label>
          <input type="password" id="confirm_password" name="confirm_password" class="form-input" placeholder="Confirm your password" autocomplete="new-password" value="<?php echo $data['confirm_password']; ?>">
          <span><?php echo $data['confirm_password_err']; ?></span>
        </div>
      </div>

      <!-- Terms and Conditions -->
      <div class="terms-section">
        <label class="checkbox-container">
          <input type="checkbox" id="terms" name="terms" class="checkbox" required>
          <span class="terms-text">
            I accept the <span class="highlight" onclick="location.href='<?php echo URLROOT; ?>/Clients/terms'">EvoPlan Terms and Conditions</span>
          </span>
          <span><?php echo $data['terms_err']; ?></span>
        </label>
      </div>

      <!-- Submit Button -->
      <button type="submit" class="submit-btn">Create Account</button>
    </form>
  </section>
</main>

<?php require APPROOT . '/views/inc/footer.php'; ?>
