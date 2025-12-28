<?php require_once APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/components/client/signup.css">

 
<div class="container signup-container">
  <!-- Header with Logo -->
  <header class="header">
    <img src="<?php echo URLROOT; ?>/img/EvoPlan_Logo_new-removebg-preview 2.svg" alt="EvoPlans Logo" class="logo">
  </header>

  <!-- Main Title -->
  <div class="main-title">
    <h1>UPDATE PAYMENT METHOD</h1>
  </div>

  <!-- Form Card -->
  <div class="form-container">
    <div class="form-header">
      <h2>Personal Info</h2>
    </div>

    <form  class="signup-form" method="POST" action="<?php echo URLROOT; ?>/Cards/addmethodup" >
      <!-- Form Fields -->
                 <input type="hidden" name="card_id" value="<?php echo ($_GET['cid']); ?>">

        <div class="form-fields">
        <div class="form-group">
          
          <label for="cardName">Card Name</label>
          <input type="text" id="cardName" name="card_name" class="form-input" value="<?=htmlspecialchars($data['methods'][0]->card_name)?>" readonly>
        </div>

        <div class="form-group">
          <label for="cardNumber">Card Number</label>
          <input type="text" id="cardNumber" name="card_number" class="form-input" value="•••• •••• •••• <?=htmlspecialchars(substr($data['methods'][0]->card_number, -4))?>" readonly>
         </div>

        <div class="form-group">
          <label for="expiryDate">Expiry Date</label>
          <input type="date" id="expiryDate" name="expiry_date" class="form-input" placeholder="MM/YY" >
        </div>

        <div class="form-group">
          <label for="cvv">CVV</label>
          <input type="number" id="cvv" name="cvv" class="form-input" placeholder="123" >
        </div>

        <div style="text-align: center;">
        <button type="submit" class="submit-btn" onclick="location.href='<?php echo URLROOT; ?>/Clients/payments'">update</button>
        </div>
      </div>
    </form>
  </div>
</div>

<?php require APPROOT . '/views/inc/footer.php';?>
