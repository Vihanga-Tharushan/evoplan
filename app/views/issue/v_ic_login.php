<?php require_once APPROOT . '/views/inc/header.php'; ?>
  <link rel="stylesheet" href="/evoplan/public/css/components/Admin/form.css">

  <div class="form-container-login">
      <form action="<?php echo URLROOT; ?>/IssueC/coordinator_login" method="POST">

        <div class="form-img-container">
        <img class="form-topic" src="../public/img/choose_register/EvoPlan_Logo_new-removebg-preview 2.svg"/>
        </div>

        <div class="form-topic-login">Issue Coordinator Login</div>

        
        <div class="form-input-title">Email</div>
        <input type="text" name="ic_email" id="ic_email" class="email" placeholder="Enter your email" value="<?php echo $data['ic_email']; ?>">
        <span class="form-invalid"><?php echo $data['ic_email_err']; ?></span>

        <div class="form-input-title">Password</div>
        <input type="password" name="ic_password" id="ic_password" class="password" placeholder="Enter your password" value="<?php echo $data['ic_password']; ?>">
        <span class="form-invalid"><?php echo $data['ic_password_err']; ?></span>

        <button type="submit" class="form-btn">
          Login
        </button>

      </form>
      
        <button class="form-cn-btn" onclick="window.location.href='<?php echo URLROOT ?>/Admin/main_page'">
          Back
        </button>
    </div>


<?php require_once APPROOT . '/views/inc/footer.php'; ?>