<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/components/servicesP/s_register.css">

<main class="registration">
	<header class="registration__header">
		<a href="<?php echo URLROOT; ?>" class="brand" aria-label="EvoPlan Home">
			<img src="<?php echo URLROOT; ?>/public/img/LandingPage/Logo.svg" alt="EvoPlan" class="brand__logo">
		</a>
	</header>

	<section class="banner">
		<h1 class="banner__title">Create Service Provider Account</h1>
	</section>

	<form action="<?php echo URLROOT?>/Service/create" method="POST" enctype="multipart/form-data">

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
      <optgroup label="Western Province">
        <option value="Colombo" <?php echo ($data['district'] == 'Colombo') ? 'selected' : ''; ?>>Colombo</option>
        <option value="Gampaha" <?php echo ($data['district'] == 'Gampaha') ? 'selected' : ''; ?>>Gampaha</option>
        <option value="Kalutara" <?php echo ($data['district'] == 'Kalutara') ? 'selected' : ''; ?>>Kalutara</option>
      </optgroup>
      <optgroup label="Central Province">
        <option value="Kandy" <?php echo ($data['district'] == 'Kandy') ? 'selected' : ''; ?>>Kandy</option>
        <option value="Matale" <?php echo ($data['district'] == 'Matale') ? 'selected' : ''; ?>>Matale</option>
        <option value="Nuwara Eliya" <?php echo ($data['district'] == 'Nuwara Eliya') ? 'selected' : ''; ?>>Nuwara Eliya</option>
      </optgroup>
      <optgroup label="Southern Province">
        <option value="Galle" <?php echo ($data['district'] == 'Galle') ? 'selected' : ''; ?>>Galle</option>
        <option value="Matara" <?php echo ($data['district'] == 'Matara') ? 'selected' : ''; ?>>Matara</option>
        <option value="Hambantota" <?php echo ($data['district'] == 'Hambantota') ? 'selected' : ''; ?>>Hambantota</option>
      </optgroup>
      <optgroup label="Northern Province">
        <option value="Jaffna" <?php echo ($data['district'] == 'Jaffna') ? 'selected' : ''; ?>>Jaffna</option>
        <option value="Kilinochchi" <?php echo ($data['district'] == 'Kilinochchi') ? 'selected' : ''; ?>>Kilinochchi</option>
        <option value="Mannar" <?php echo ($data['district'] == 'Mannar') ? 'selected' : ''; ?>>Mannar</option>
        <option value="Vavuniya" <?php echo ($data['district'] == 'Vavuniya') ? 'selected' : ''; ?>>Vavuniya</option>
        <option value="Mullaitivu" <?php echo ($data['district'] == 'Mullaitivu') ? 'selected' : ''; ?>>Mullaitivu</option>
      </optgroup>
      <optgroup label="Eastern Province">
        <option value="Batticaloa" <?php echo ($data['district'] == 'Batticaloa') ? 'selected' : ''; ?>>Batticaloa</option>
        <option value="Ampara" <?php echo ($data['district'] == 'Ampara') ? 'selected' : ''; ?>>Ampara</option>
        <option value="Trincomalee" <?php echo ($data['district'] == 'Trincomalee') ? 'selected' : ''; ?>>Trincomalee</option>
      </optgroup>
      <optgroup label="North Western Province">
        <option value="Kurunegala" <?php echo ($data['district'] == 'Kurunegala') ? 'selected' : ''; ?>>Kurunegala</option>
        <option value="Puttalam" <?php echo ($data['district'] == 'Puttalam') ? 'selected' : ''; ?>>Puttalam</option>
      </optgroup>
      <optgroup label="North Central Province">
        <option value="Anuradhapura" <?php echo ($data['district'] == 'Anuradhapura') ? 'selected' : ''; ?>>Anuradhapura</option>
        <option value="Polonnaruwa" <?php echo ($data['district'] == 'Polonnaruwa') ? 'selected' : ''; ?>>Polonnaruwa</option>
      </optgroup>
      <optgroup label="Uva Province">
        <option value="Badulla" <?php echo ($data['district'] == 'Badulla') ? 'selected' : ''; ?>>Badulla</option>
        <option value="Moneragala" <?php echo ($data['district'] == 'Moneragala') ? 'selected' : ''; ?>>Moneragala</option>
      </optgroup>
      <optgroup label="Sabaragamuwa Province">
        <option value="Ratnapura" <?php echo ($data['district'] == 'Ratnapura') ? 'selected' : ''; ?>>Ratnapura</option>
        <option value="Kegalle" <?php echo ($data['district'] == 'Kegalle') ? 'selected' : ''; ?>>Kegalle</option>
      </optgroup>
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
      <option value="Decorators and Event Stylists" <?php echo ($data['serviceType'] == 'Decorators') ? 'selected' : ''; ?>>Decorators and Event Stylists</option>
      <option value="Event Equipment and Rentals" <?php echo ($data['serviceType'] == 'Event Equipment') ? 'selected' : ''; ?>>Event Equipment and Rentals</option>
      <option value="Music and DJ Services" <?php echo ($data['serviceType'] == 'Music') ? 'selected' : ''; ?>>Music and DJ Services</option>
      <option value="Hosts, MCs and Entertainers" <?php echo ($data['serviceType'] == 'Entertainers') ? 'selected' : ''; ?>>Hosts, MCs and Entertainers</option>
      <option value="Transport and Logistics Services" <?php echo ($data['serviceType'] == 'Transportation') ? 'selected' : ''; ?>>Transport and Logistics Services</option>
      <option value="Florists and Cake Designers" <?php echo ($data['serviceType'] == 'Florists') ? 'selected' : ''; ?>>Florists and Cake Designers</option>
      <option value="Venue Providing" <?php echo ($data['serviceType'] == 'Venue') ? 'selected' : ''; ?>>Venue Providing</option>
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
      <optgroup label="Western Province">
        <option value="Colombo" <?php echo ($data['bizDistrict'] == 'Colombo') ? 'selected' : ''; ?>>Colombo</option>
        <option value="Gampaha" <?php echo ($data['bizDistrict'] == 'Gampaha') ? 'selected' : ''; ?>>Gampaha</option>
        <option value="Kalutara" <?php echo ($data['bizDistrict'] == 'Kalutara') ? 'selected' : ''; ?>>Kalutara</option>
      </optgroup>
      <optgroup label="Central Province">
        <option value="Kandy" <?php echo ($data['bizDistrict'] == 'Kandy') ? 'selected' : ''; ?>>Kandy</option>
        <option value="Matale" <?php echo ($data['bizDistrict'] == 'Matale') ? 'selected' : ''; ?>>Matale</option>
        <option value="Nuwara Eliya" <?php echo ($data['bizDistrict'] == 'Nuwara Eliya') ? 'selected' : ''; ?>>Nuwara Eliya</option>
      </optgroup>
      <optgroup label="Southern Province">
        <option value="Galle" <?php echo ($data['bizDistrict'] == 'Galle') ? 'selected' : ''; ?>>Galle</option>
        <option value="Matara" <?php echo ($data['bizDistrict'] == 'Matara') ? 'selected' : ''; ?>>Matara</option>
        <option value="Hambantota" <?php echo ($data['bizDistrict'] == 'Hambantota') ? 'selected' : ''; ?>>Hambantota</option>
      </optgroup>
      <optgroup label="Northern Province">
        <option value="Jaffna" <?php echo ($data['bizDistrict'] == 'Jaffna') ? 'selected' : ''; ?>>Jaffna</option>
        <option value="Kilinochchi" <?php echo ($data['bizDistrict'] == 'Kilinochchi') ? 'selected' : ''; ?>>Kilinochchi</option>
        <option value="Mannar" <?php echo ($data['bizDistrict'] == 'Mannar') ? 'selected' : ''; ?>>Mannar</option>
        <option value="Vavuniya" <?php echo ($data['bizDistrict'] == 'Vavuniya') ? 'selected' : ''; ?>>Vavuniya</option>
        <option value="Mullaitivu" <?php echo ($data['bizDistrict'] == 'Mullaitivu') ? 'selected' : ''; ?>>Mullaitivu</option>
      </optgroup>
      <optgroup label="Eastern Province">
        <option value="Batticaloa" <?php echo ($data['bizDistrict'] == 'Batticaloa') ? 'selected' : ''; ?>>Batticaloa</option>
        <option value="Ampara" <?php echo ($data['bizDistrict'] == 'Ampara') ? 'selected' : ''; ?>>Ampara</option>
        <option value="Trincomalee" <?php echo ($data['bizDistrict'] == 'Trincomalee') ? 'selected' : ''; ?>>Trincomalee</option>
      </optgroup>
      <optgroup label="North Western Province">
        <option value="Kurunegala" <?php echo ($data['bizDistrict'] == 'Kurunegala') ? 'selected' : ''; ?>>Kurunegala</option>
        <option value="Puttalam" <?php echo ($data['bizDistrict'] == 'Puttalam') ? 'selected' : ''; ?>>Puttalam</option>
      </optgroup>
      <optgroup label="North Central Province">
        <option value="Anuradhapura" <?php echo ($data['bizDistrict'] == 'Anuradhapura') ? 'selected' : ''; ?>>Anuradhapura</option>
        <option value="Polonnaruwa" <?php echo ($data['bizDistrict'] == 'Polonnaruwa') ? 'selected' : ''; ?>>Polonnaruwa</option>
      </optgroup>
      <optgroup label="Uva Province">
        <option value="Badulla" <?php echo ($data['bizDistrict'] == 'Badulla') ? 'selected' : ''; ?>>Badulla</option>
        <option value="Moneragala" <?php echo ($data['bizDistrict'] == 'Moneragala') ? 'selected' : ''; ?>>Moneragala</option>
      </optgroup>
      <optgroup label="Sabaragamuwa Province">
        <option value="Ratnapura" <?php echo ($data['bizDistrict'] == 'Ratnapura') ? 'selected' : ''; ?>>Ratnapura</option>
        <option value="Kegalle" <?php echo ($data['bizDistrict'] == 'Kegalle') ? 'selected' : ''; ?>>Kegalle</option>
      </optgroup>
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
