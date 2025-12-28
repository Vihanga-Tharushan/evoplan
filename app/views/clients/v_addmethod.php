<?php require_once APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/components/client/signup.css">

 
<div class="container signup-container">
  <!-- Header with Logo -->
  <header class="header">
    <img src="<?php echo URLROOT; ?>/img/EvoPlan_Logo_new-removebg-preview 2.svg" alt="EvoPlans Logo" class="logo">
  </header>

  <!-- Main Title -->
  <div class="main-title">
    <h1>ADD THE PAYMENT METHOD</h1>
  </div>

  <!-- Form Card -->
  <div class="form-container">
    <div class="form-header">
      <h2>Personal Info</h2>
    </div>

    <form action="<?php echo URLROOT; ?>/Cards/addmethod" class="signup-form" method="POST">
      <!-- Form Fields -->
      <div class="form-fields">
        <div class="form-group">          
          <label for="cardName">Card Name</label>
          <input type="text" id="cardName" name="card_name" class="form-input"
       placeholder="e.g., John Doe"
       pattern="[A-Za-z\s]+"
       title="Only English letters and spaces are allowed"
       value="<?php echo isset($data['card_name']) ? $data['card_name'] : ''; ?>">

          <span class="form-invalid"><?php echo isset($data['card_name_err']) ? $data['card_name_err'] : ''; ?></span>
        </div>

        <div class="form-group">
          <label for="cardNumber">Card Number</label>
          <input type="number" id="cardNumber" name="card_number" class="form-input" autocomplete="family-name" value="<?php echo isset($data['card_number']) ? $data['card_number'] : ''; ?>">
          <span class="form-invalid"><?php echo isset($data['card_number_err']) ? $data['card_number_err'] : ''; ?></span>
        </div>

        <div class="form-group">
          <label for="expiryDate">Expiry Date</label>
          <input type="text" id="expiryDate" name="expiry_date" class="form-input" placeholder="MM/YY" value="<?php echo isset($data['expiry_date']) ? $data['expiry_date'] : ''; ?>">
          <span class="form-invalid"><?php echo isset($data['expiry_date_err']) ? $data['expiry_date_err'] : ''; ?></span>
        </div>

        <div class="form-group">
          <label for="cvv">CVV</label>
          <input type="number" id="cvv" name="cvv" class="form-input" placeholder="123" value="<?php echo isset($data['cvv']) ? $data['cvv'] : ''; ?>">
          <span class="form-invalid"><?= $data['cvv_err'] ?? ""; ?></span>
        </div>

        <div style="text-align: center;">
          <button type="submit" class="submit-btn">Add</button>
        </div>
      </div>
    </form>
  </div>
</div>

<?php require APPROOT . '/views/inc/footer.php';?>
