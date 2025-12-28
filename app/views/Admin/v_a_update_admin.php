<?php require_once APPROOT . '/views/inc/header.php'; ?>
  <link rel="stylesheet" href="/evoplan/public/css/components/Admin/form.css">

    <div class="form-container">
      <form action="<?php echo URLROOT; ?>/Admin/update_admin/<?php echo $data['a_id']; ?>" method="POST" >

        <div class="form-img-container">
        <img class="form-topic" src="/evoplan/public/img/choose_register/EvoPlan_Logo_new-removebg-preview 2.svg"/>
        </div>

        <div class="form-topic">Update Admin</div>

        <div class="form-input-title">Name</div>
        <input type="text" name="a_name" id="a_name" class="name" value="<?php echo $data['a_name']; ?>">
        <span class="form-invalid"><?php echo $data['a_name_err']; ?></span>

        <div class="form-input-title">Email</div>
        <input type="text" name="a_email" id="a_email" class="email" value="<?php echo $data['a_email']; ?>">
        <span class="form-invalid"><?php echo $data['a_email_err']; ?></span>

        <div class="form-input-title">Phone Number</div>
        <input type="text" name="a_phone" id="a_phone" class="phone" value="<?php echo $data['a_phone']; ?>" placeholder="7********">
        <span class="form-invalid"><?php echo $data['a_phone_err']; ?></span>

        <div class="form-input-title">Password</div>
        <input type="password" name="a_password" id="a_password" class="password" value="<?php echo $data['a_password']; ?>" placeholder="••••••>
        <span class="form-invalid"><?php echo $data['a_password_err']; ?></span>

        <div class="form-input-title">Confirm Password</div>
        <input type="password" name="a_Cpassword" id="a_Cpassword" class="Cpassword" value="<?php echo $data['a_Cpassword']; ?>" placeholder="••••••">
        <span class="form-invalid"><?php echo $data['a_Cpassword_err']; ?></span>
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