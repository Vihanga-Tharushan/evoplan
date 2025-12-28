<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="../public/css/components/servicesP/s_register.css">

<main class="registration">
		<header class="registration__header">
			<a href="#" class="brand" aria-label="EvoPlan Home">
				<img src="../public/img/choose_register/EvoPlan_Logo_new-removebg-preview 2.svg" alt="EvoPlan" class="brand__logo">
			</a>
		</header>

		<section class="banner" aria-hidden="true">
			<div class="banner__bar"></div>
			<h1 class="banner__title">Create Service Provider Account</h1>
		</section>

<form  action="<?php echo URLROOT?>/Service/create" method="POST" enctype="multipart/form-data">

  <!-- Profile Info Section -->
  <section class="form-block">
    <h2 class="form-block__title">Profile Info</h2>

    <label class="form__label" for="fname">First Name</label>
    <input class="form__input" id="fname" name="fname" type="text" placeholder="Your name" value="<?php echo $data['fname']; ?>">
    <span class="invalidFeedback"><?php echo $data['name_err']; ?></span>

    <label class="form__label" for="lname">Last Name</label>
    <input class="form__input" id="lname" name="lname" type="text" placeholder="Your last name" accept="" required value="<?php echo $data['lname']; ?>">

    <label class="form__label" for="nic">NIC Number</label>
    <input class="form__input" id="nic" name="nic" type="text" placeholder="Your NIC number" required value="<?php echo $data['nic']; ?>">
    <span class="invalidFeedback"><?php echo $data['nic_err']; ?></span>

    <label class="form__label" for="email">Email</label>
    <input class="form__input" id="email" name="email" type="email" placeholder="you@example.com" required value="<?php echo $data['email']; ?>">
    <span class="invalidFeedback"><?php echo $data['email_err']; ?></span>

	  <label class="form__label" for="password">Password</label>
	  <input class="form__input" id="password" name="password" type="password" placeholder="Create a password" required value="<?php echo $data['password']; ?>">
    <span class="invalidFeedback"><?php echo $data['password_err']; ?></span>

	  <label class="form__label" for="confirm_password">Confirm Password</label>
    <input class="form__input" id="confirm_password" name="confirm_password" type="password" placeholder="Confirm your password" required accept="" value="<?php echo $data['confirm_password']; ?>">
    <span class="invalidFeedback"><?php echo $data['confirm_password_err']; ?></span>

    <label class="form__label" for="contact">Contact Number</label>
    <input class="form__input" id="contact" name="contact" type="tel" placeholder="Your contact number" required value="<?php echo $data['contact']; ?>">
    <span class="invalidFeedback"><?php echo $data['contact_err']; ?></span>

    <label class="form__label" for="address">Address</label>
    <input class="form__input" id="address" name="address" type="text" placeholder="Your address" required value="<?php echo $data['address']; ?>">
    <span class="invalidFeedback"><?php echo $data['address_err']; ?></span>

    <label class="form__label" for="district">District</label>
    <select class="form__select" id="district" name="district" required value="<?php echo $data['district']; ?>">
      <option value="">Select District</option>
      <option value="Colombo" <?php echo ($data['district'] == 'Colombo') ? 'selected' : ''; ?>>Colombo</option>
      <option value="Kandy" <?php echo ($data['district'] == 'Kandy') ? 'selected' : ''; ?>>Kandy</option>
      <option value="Galle" <?php echo ($data['district'] == 'Galle') ? 'selected' : ''; ?>>Galle</option>
    </select>
  </section>

  <!-- Business Info Section -->
  <section class="form-block">
    <h2 class="form-block__title">Business Info</h2>

    <label class="form__label" for="businessName">Business Name</label>
    <input class="form__input" id="businessName" name="businessName" type="text" placeholder="Your business name" required accept="" value="<?php echo $data['businessName']; ?>">
    <span class="invalidFeedback"><?php echo $data['businessName_err']; ?></span>

    <label class="form__label" for="businessId">Business ID</label>
    <input class="form__input" id="businessId" name="businessId" type="text" placeholder="Your business ID"  value="<?php echo $data['businessId']; ?>">
    <span class="invalidFeedback"><?php echo $data['businessId_err']; ?></span>

    <label class="form__label" for="serviceType">Service Type</label>
    <select class="form__select" id="serviceType" name="serviceType" required value="<?php echo $data['serviceType']; ?>">
      <option value="">Select Service Type</option>
      <option value="Decorators and Event Stylists" <?php echo ($data['serviceType'] == 'Decorators and Event Stylists') ? 'selected' : ''; ?>>Decorators and Event Stylists</option>
      <option value="Event Equipment and Rentals" <?php echo ($data['serviceType'] == 'Event Equipment and Rentals') ? 'selected' : ''; ?>>Event Equipment and Rentals</option>
      <option value="Music and DJ Services" <?php echo ($data['serviceType'] == 'Music and DJ Services') ? 'selected' : ''; ?>>Music and DJ Services</option>
      <option value="Hosts, MCs and Entertainers" <?php echo ($data['serviceType'] == 'Hosts, MCs and Entertainers') ? 'selected' : ''; ?>>Hosts, MCs and Entertainers</option>
      <option value="Transport and Logistics Services" <?php echo ($data['serviceType'] == 'Transport and Logistics Services') ? 'selected' : ''; ?>>Transport and Logistics Services</option>
      <option value="Florists and Cake Designers" <?php echo ($data['serviceType'] == 'Florists and Cake Designers') ? 'selected' : ''; ?>>Florists and Cake Designers</option>
      <option value="Venue Providing" <?php echo ($data['serviceType'] == 'Venue Providing') ? 'selected' : ''; ?>>Venue Providing</option>
      <option value="Catering" <?php echo ($data['serviceType'] == 'Catering') ? 'selected' : ''; ?>>Catering</option>
      <option value="Photography" <?php echo ($data['serviceType'] == 'Photography') ? 'selected' : ''; ?>>Photography</option>
    </select>

    <label class="form__label" for="contactB">Business Contact Number</label>
    <input class="form__input" id="contactB" name="contactB" type="tel" placeholder="Your contact number" required value="<?php echo $data['contactB']; ?>">
    <span class="invalidFeedback"><?php echo $data['contactB_err']; ?></span>

    <label class="form__label" for="emailB">Business Email</label>
    <input class="form__input" id="emailB" name="emailB" type="email" placeholder="business@example.com" required value="<?php echo $data['emailB']; ?>">
    <span class="invalidFeedback"><?php echo $data['emailB_err']; ?></span>

    <label class="form__label" for="businessAddress">Business Address</label>
    <input class="form__input" id="businessAddress" name="businessAddress" type="text" placeholder="Street, City" required value="<?php echo $data['businessAddress']; ?>">

    <label class="form__label" for="bizDistrict">District</label>
    <select class="form__select" id="bizDistrict" name="bizDistrict" required>
      <option value="">Select District</option>
      <option value="Colombo" <?php echo ($data['bizDistrict'] == 'Colombo') ? 'selected' : ''; ?>>Colombo</option>
      <option value="Kandy" <?php echo ($data['bizDistrict'] == 'Kandy') ? 'selected' : ''; ?>>Kandy</option>
      <option value="Galle" <?php echo ($data['bizDistrict'] == 'Galle') ? 'selected' : ''; ?>>Galle</option>
    </select>

    <label class="form__label" for="description">Business Description</label>
    <textarea class="form__textarea" id="description" name="description" placeholder="Tell us about your business"><?php echo $data['description']; ?></textarea>

    <label class="form__label" for="experience">Years of Experience</label>
    <select class="form__select" id="experience" name="experience" required>
      <option value="">Select Experience</option>
      <option value="0-1 years" <?php echo ($data['experience'] == '0-1 years') ? 'selected' : ''; ?>>0-1 years</option>
      <option value="2-5 years" <?php echo ($data['experience'] == '2-5 years') ? 'selected' : ''; ?>>2-5 years</option>
      <option value="6-10 years" <?php echo ($data['experience'] == '6-10 years') ? 'selected' : ''; ?>>6-10 years</option>
      <option value="10+ years" <?php echo ($data['experience'] == '10+ years') ? 'selected' : ''; ?>>10+ years</option>
    </select>

    <div class="form-group">
    <label class="form__label" for="license">Upload Business License / Verified Document *</label>
    
    <div class="file-upload-wrapper">
        <input class="form__file" id="license" name="license" type="file" 
               accept="image/jpeg,image/png,image/jpg,application/pdf" 
               
               onchange="updateFileName(this)">
        
        <label for="license" class="file-upload-label">
            <span class="file-upload-text">Choose file</span>
            <span class="file-upload-button">Browse</span>
        </label>
        
        <span class="file-name" id="fileName">No file chosen</span>
    </div>
    
    <span class="invalidFeedback"><?php echo isset($data['license_err']) ? $data['license_err'] : ''; ?></span>
    <small class="form-text text-muted">Accepted formats: JPG, PNG, PDF. Max size: 5MB</small>
</div>

    <script>
        function updateFileName(input) {
            const fileNameSpan = document.getElementById('fileName');
            if (input.files && input.files.length > 0) {
                fileNameSpan.textContent = input.files[0].name;
            } else {
                fileNameSpan.textContent = 'No file chosen';
            }
        }
    </script>
  </section>

  <!-- Submit Section -->
  <section class="submit">
    <label class="checkbox">
      <input type="checkbox" name="terms" required>
      <span>I accept the <strong class="accent">EvoPlan</strong> 
        <a href="<?php echo URLROOT; ?>/Service/terms" target="_blank"><u>terms and conditions</u></a>
      </span>
    </label>

    <button class="btn btn--primary" type="submit">Create Account</button>
  </section>

</form>

</main>
<?php require APPROOT . '/views/inc/footer.php'; ?>
