<?php require_once APPROOT . '/views/inc/header.php'; ?>
  <link rel="stylesheet" href="/evoplan/public/css/components/Admin/form.css">

    <div class="form-container">
      <form action="<?php echo URLROOT; ?>/Admin/update_coordinator/<?php echo $data['ic_id']; ?>" method="POST" >

        <div class="form-img-container">
        <img class="form-topic" src="/evoplan/public/img/choose_register/EvoPlan_Logo_new-removebg-preview 2.svg"/>
        </div>

        <div class="form-topic">Update Issue Coordinator</div>

        <div class="form-input-title">Name</div>
        <input type="text" name="ic_name" id="ic_name" class="name" value="<?php echo $data['ic_name']; ?>">
        <span class="form-invalid"><?php echo $data['ic_name_err']; ?></span>

        <div class="form-input-title">Email</div>
        <input type="text" name="ic_email" id="ic_email" class="email" value="<?php echo $data['ic_email']; ?>">
        <span class="form-invalid"><?php echo $data['ic_email_err']; ?></span>

        <div class="form-input-title">Phone Number</div>
        <input type="text" name="ic_phone" id="ic_phone" class="phone" value="<?php echo $data['ic_phone']; ?>" placeholder="7********">
        <span class="form-invalid"><?php echo $data['ic_phone_err']; ?></span>

        <div class="form-input-title">Password</div>
        <input type="password" name="ic_password" id="ic_password" class="password" value="<?php echo $data['ic_password']; ?>" placeholder="••••••">
        <span class="form-invalid"><?php echo $data['ic_password_err']; ?></span>

        <div class="form-input-title">Confirm Password</div>
        <input type="password" name="ic_Cpassword" id="ic_Cpassword" class="Cpassword" value="<?php echo $data['ic_Cpassword']; ?>" placeholder="••••••">
        <span class="form-invalid"><?php echo $data['ic_Cpassword_err']; ?></span>
        <br>
        <button type="submit" class="form-btn">
          Update
        </button>

      </form>

        <button class="form-cn-btn" onclick="window.location.href='<?php echo URLROOT ?>/Admin/admins'">
          Cancel
        </button>
    </div>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>