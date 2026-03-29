<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/inc/components/sidebar/sidebar1.php';?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/components/servicesP/s_accountSettings.css">

<div class="main-content">
    <div class="settings-container">
        <!-- Account Status Banner -->
        <div class="status-banner" id="statusBanner">
            <div class="status-info">
                <div class="status-icon">
                <i class="fa fa-check-circle"></i>
                </div>
                <div>
                    <h3>Account Active</h3>
                    <p>Your service provider account is currently active and visible to customers</p>
                </div>
            </div>
            <button class="status-toggle" id="statusToggle">Deactivate</button>
        </div>

        <!-- Settings Sections -->
        <div class="settings-sections">
            <!-- Personal Information -->
            <div class="settings-card" data-section="personal-info">
              <button class="edit-toggle" onclick="toggleEdit('personal-info')">
                    <i class="fas fa-edit"></i> Edit
              </button>
                <div class="card-header">
                    <h2><i class="fa fa-user" style="margin-left: 8px;color:var(--primary);"></i><span style="margin-left: 8px;">Personal Information</span></h2>
                    <p class="card-description">Manage your personal details</p>
                </div>
                <form class="settings-form" id="personalInfoForm">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="fname">First Name</label>
                            <input type="text" id="fname" name="fname" value="<?php echo $data['accountdata']->fname; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="lname">Last Name</label>
                            <input type="text" id="lname" name="lname" value="<?php echo $data['accountdata']->lname; ?>" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="nic">NIC Number</label>
                            <input type="text" id="nic" name="nic" value="<?php echo $data['accountdata']->nic; ?>" disabled>
                            <span class="input-helper">NIC cannot be changed</span>
                        </div>
                        <div class="form-group">
                            <label for="contact">Contact Number</label>
                            <input type="tel" id="contact" name="contact" value="<?php echo $data['accountdata']->contact; ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <div style="display: flex; align-items: center;">
                            <input type="email" id="email" name="email" value="<?php echo $data['accountdata']->email; ?>" disabled>
                            <i class="fas fa-check-circle" style="color: var(--success); margin-left: 8px; font-size: 14px;"></i>
                            
                        </div>
                        <span class="input-helper">Email is verified</span>
                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea id="address" name="address" rows="2" required><?php echo $data['accountdata']->address; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="district">District</label>
                        <select id="district" name="district" required>
                            <option value="Colombo"<?php if($data['accountdata']->district == 'Colombo') echo ' selected'; ?>>Colombo</option>
                            <option value="Gampaha"<?php if($data['accountdata']->district == 'Gampaha') echo ' selected'; ?>>Gampaha</option>
                            <option value="Kalutara"<?php if($data['accountdata']->district == 'Kalutara') echo ' selected'; ?>>Kalutara</option>
                            <option value="Kandy"<?php if($data['accountdata']->district == 'Kandy') echo ' selected'; ?>>Kandy</option>
                            <option value="Matale"<?php if($data['accountdata']->district == 'Matale') echo ' selected'; ?>>Matale</option>
                            <option value="Nuwara Eliya"<?php if($data['accountdata']->district == 'Nuwara Eliya') echo ' selected'; ?>>Nuwara Eliya</option>
                            <option value="Galle"<?php if($data['accountdata']->district == 'Galle') echo ' selected'; ?>>Galle</option>
                            <option value="Matara"<?php if($data['accountdata']->district == 'Matara') echo ' selected'; ?>>Matara</option>
                            <option value="Hambantota"<?php if($data['accountdata']->district == 'Hambantota') echo ' selected'; ?>>Hambantota</option>
                            <option value="Jaffna"<?php if($data['accountdata']->district == 'Jaffna') echo ' selected'; ?>>Jaffna</option>
                            <option value="Kilinochchi"<?php if($data['accountdata']->district == 'Kilinochchi') echo ' selected'; ?>>Kilinochchi</option>
                            <option value="Mannar"<?php if($data['accountdata']->district == 'Mannar') echo ' selected'; ?>>Mannar</option>
                            <option value="Vavuniya"<?php if($data['accountdata']->district == 'Vavuniya') echo ' selected'; ?>>Vavuniya</option>
                            <option value="Mullaitivu"<?php if($data['accountdata']->district == 'Mullaitivu') echo ' selected'; ?>>Mullaitivu</option>
                            <option value="Batticaloa"<?php if($data['accountdata']->district == 'Batticaloa') echo ' selected'; ?>>Batticaloa</option>
                            <option value="Ampara"<?php if($data['accountdata']->district == 'Ampara') echo ' selected'; ?>>Ampara</option>
                            <option value="Trincomalee"<?php if($data['accountdata']->district == 'Trincomalee') echo ' selected'; ?>>Trincomalee</option>
                            <option value="Kurunegala"<?php if($data['accountdata']->district == 'Kurunegala') echo ' selected'; ?>>Kurunegala</option>
                            <option value="Puttalam"<?php if($data['accountdata']->district == 'Puttalam') echo ' selected'; ?>>Puttalam</option>
                            <option value="Anuradhapura"<?php if($data['accountdata']->district == 'Anuradhapura') echo ' selected'; ?>>Anuradhapura</option>
                            <option value="Polonnaruwa"<?php if($data['accountdata']->district == 'Polonnaruwa') echo ' selected'; ?>>Polonnaruwa</option>
                            <option value="Badulla"<?php if($data['accountdata']->district == 'Badulla') echo ' selected'; ?>>Badulla</option>
                            <option value="Moneragala"<?php if($data['accountdata']->district == 'Moneragala') echo ' selected'; ?>>Moneragala</option>
                            <option value="Ratnapura"<?php if($data['accountdata']->district == 'Ratnapura') echo ' selected'; ?>>Ratnapura</option>
                            <option value="Kegalle"<?php if($data['accountdata']->district == 'Kegalle') echo ' selected'; ?>>Kegalle</option>
                        </select>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <button type="button" class="btn btn-secondary" id="cancelPersonalInfo">Cancel</button>
                    </div>
                </form>
            </div>

            <!-- Business Information -->
            <div class="settings-card" data-section="business-info">
                <button class="edit-toggle" onclick="toggleEdit('business-info')">
                    <i class="fas fa-edit"></i> Edit
                </button>
                <div class="card-header">
                    <h2><i class="fa fa-briefcase" style="margin-left: 8px;color:var(--primary);"></i><span style="margin-left: 8px;">Business Information</span></h2>
                    <p class="card-description">Manage your business profile</p>
                </div>
                <form class="settings-form" id="businessInfoForm">
                    <div class="form-group">
                        <label for="businessName">Business Name</label>
                        <input type="text" id="businessName" name="businessName" value="<?php echo $data['accountdata']->businessName; ?>" required>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="businessId">Business Registration ID</label>
                            <input type="text" id="businessId" name="businessId" value="<?php echo $data['accountdata']->businessId; ?>" disabled>
                            <span class="input-helper">Business ID cannot be changed</span>
                        </div>
                        <div class="form-group">
                            <label for="serviceType">Service Type</label>
                            <select id="serviceType" name="serviceType" disabled>
                               <option value="Decorators and Event Stylists" <?php if($data['accountdata']->serviceType == 'Decorators and Event Stylists') echo 'selected'?> >Decorators and Event Stylists</option>
                                <option value="Event Equipment and Rentals" <?php if($data['accountdata']->serviceType == 'Event Equipment and Rentals') echo 'selected'?> >Event Equipment and Rentals</option>
                                <option value="Music and DJ Services" <?php if($data['accountdata']->serviceType == 'Music and DJ Services') echo 'selected'?> >Music and DJ Services</option>
                                <option value="Hosts, MCs and Entertainers" <?php if($data['accountdata']->serviceType == 'Hosts, MCs and Entertainers') echo 'selected'?> >Hosts, MCs and Entertainers</option>
                                <option value="Transport and Logistics Services"<?php if($data['accountdata']->serviceType == 'Transport and Logistics Services') echo 'selected'?>  >Transport and Logistics Services</option>
                                <option value="Florists and Cake Designers"<?php if($data['accountdata']->serviceType == 'Florists and Cake Designers') echo 'selected'?>  >Florists and Cake Designers</option>
                                <option value="Venue Providing"<?php if($data['accountdata']->serviceType == 'Venue Providing') echo 'selected'?>  >Venue Providing</option>
                                <option value="Catering"<?php if($data['accountdata']->serviceType == 'Catering') echo 'selected'?>  >Catering</option>
                                <option value="Photography"<?php if($data['accountdata']->serviceType == 'Photography') echo 'selected'?> >Photography</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="contactB">Business Contact</label>
                            <input type="tel" id="contactB" name="contactB" value="<?php echo $data['accountdata']->contactB; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="emailB">Business Email</label>
                            <input type="email" id="emailB" name="emailB" value="<?php echo $data['accountdata']->emailB; ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="businessAddress">Business Address</label>
                        <textarea id="businessAddress" name="businessAddress" rows="2" required><?php echo $data['accountdata']->businessAddress; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="bizDistrict">Business District</label>
                        <select id="bizDistrict" name="bizDistrict" required>
                            <option value="Colombo"<?php if($data['accountdata']->bizDistrict == 'Colombo') echo 'selected'?> >Colombo</option>
                            <option value="Gampaha"<?php if($data['accountdata']->bizDistrict == 'Gampaha') echo 'selected'?> >Gampaha</option>
                            <option value="Kalutara"<?php if($data['accountdata']->bizDistrict == 'Kalutara') echo 'selected'?> >Kalutara</option>
                            <option value="Kandy"<?php if($data['accountdata']->bizDistrict == 'Kandy') echo 'selected'?> >Kandy</option>
                            <option value="Matale"<?php if($data['accountdata']->bizDistrict == 'Matale') echo 'selected'?> >Matale</option>
                            <option value="Nuwara Eliya"<?php if($data['accountdata']->bizDistrict == 'Nuwara Eliya') echo 'selected'?> >Nuwara Eliya</option>
                            <option value="Galle"<?php if($data['accountdata']->bizDistrict == 'Galle') echo 'selected'?> >Galle</option>
                            <option value="Matara"<?php if($data['accountdata']->bizDistrict == 'Matara') echo 'selected'?> >Matara</option>
                            <option value="Hambantota"<?php if($data['accountdata']->bizDistrict == 'Hambantota') echo 'selected'?> >Hambantota</option>
                            <option value="Jaffna"<?php if($data['accountdata']->bizDistrict == 'Jaffna') echo 'selected'?> >Jaffna</option>
                            <option value="Kilinochchi"<?php if($data['accountdata']->bizDistrict == 'Kilinochchi') echo 'selected'?> >Kilinochchi</option>
                            <option value="Mannar"<?php if($data['accountdata']->bizDistrict == 'Mannar') echo 'selected'?> >Mannar</option>
                            <option value="Vavuniya"<?php if($data['accountdata']->bizDistrict == 'Vavuniya') echo 'selected'?> >Vavuniya</option>
                            <option value="Mullaitivu"<?php if($data['accountdata']->bizDistrict == 'Mullaitivu') echo 'selected'?> >Mullaitivu</option>
                            <option value="Batticaloa"<?php if($data['accountdata']->bizDistrict == 'Batticaloa') echo 'selected'?> >Batticaloa</option>
                            <option value="Ampara"<?php if($data['accountdata']->bizDistrict == 'Ampara') echo 'selected'?> >Ampara</option>
                            <option value="Trincomalee"<?php if($data['accountdata']->bizDistrict == 'Trincomalee') echo 'selected'?> >Trincomalee</option>
                            <option value="Kurunegala"<?php if($data['accountdata']->bizDistrict == 'Kurunegala') echo 'selected'?> >Kurunegala</option>
                            <option value="Puttalam"<?php if($data['accountdata']->bizDistrict == 'Puttalam') echo 'selected'?> >Puttalam</option>
                            <option value="Anuradhapura"<?php if($data['accountdata']->bizDistrict == 'Anuradhapura') echo 'selected'?> >Anuradhapura</option>
                            <option value="Polonnaruwa"<?php if($data['accountdata']->bizDistrict == 'Polonnaruwa') echo 'selected'?> >Polonnaruwa</option>
                            <option value="Badulla"<?php if($data['accountdata']->bizDistrict == 'Badulla') echo 'selected'?> >Badulla</option>
                            <option value="Moneragala"<?php if($data['accountdata']->bizDistrict == 'Moneragala') echo 'selected'?> >Moneragala</option>
                            <option value="Ratnapura"<?php if($data['accountdata']->bizDistrict == 'Ratnapura') echo 'selected'?> >Ratnapura</option>
                            <option value="Kegalle"<?php if($data['accountdata']->bizDistrict == 'Kegalle') echo 'selected'?> >Kegalle</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="experience">Years of Experience</label>
                        <select id="experience" name="experience" required>
                          <option value="0-1 years" <?php echo ($data['accountdata']->experience == '0-1 years') ? 'selected' : ''; ?>>0-1 years</option>
                          <option value="2-5 years" <?php echo ($data['accountdata']->experience == '2-5 years') ? 'selected' : ''; ?>>2-5 years</option>
                          <option value="6-10 years" <?php echo ($data['accountdata']->experience == '6-10 years') ? 'selected' : ''; ?>>6-10 years</option>
                          <option value="10+ years" <?php echo ($data['accountdata']->experience == '10+ years') ? 'selected' : ''; ?>>10+ years</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="description">Business Description</label>
                        <textarea id="description" name="description" rows="4"><?php echo htmlspecialchars($data['accountdata']->description); ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="license">License Information</label>
                        <div style="display: flex; align-items: center;">
                            <input type="text" id="license" name="license" value="License #PL-2019-4567" disabled>
                            <i class="fas fa-check-circle" style="color: var(--success); margin-left: 8px; font-size: 14px;"></i>
                        </div>
                        <span class="input-helper">License information cannot be modified. Contact support for changes.</span>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <button type="button" class="btn btn-secondary" id="cancelBusinessInfo">Cancel</button>
                    </div>
                </form>
            </div>

            <!-- Security Settings -->
            <div class="settings-card" data-section="security-settings">
                <button class="edit-toggle" onclick="toggleEdit('security-settings')">
                    <i class="fas fa-edit"></i> Edit
                </button>
                <div class="card-header">
                    <h2><i class="fa fa-lock" style="margin-left: 8px;color:var(--primary);"></i><span style="margin-left: 8px;">Security Settings</span></h2>
                    <p class="card-description">Update your password and security preferences</p>
                </div>
                <form class="settings-form" id="passwordForm">
                    <div class="form-group">
                        <label for="currentPassword">Current Password</label>
                        <div class="password-input-wrapper">
                            <input type="password" id="currentPassword" name="currentPassword" placeholder="Enter current password" required>
                            <button type="button" class="password-toggle" onclick="togglePassword('currentPassword')">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="newPassword">New Password</label>
                        <div class="password-input-wrapper">
                            <input type="password" id="newPassword" name="newPassword" placeholder="Enter new password" required>
                            <button type="button" class="password-toggle" onclick="togglePassword('newPassword')">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <div class="password-strength" id="passwordStrength">
                            <div class="strength-bar">
                                <div class="strength-bar-fill" id="strengthBarFill"></div>
                            </div>
                            <span class="strength-text" id="strengthText">Password strength</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="confirmPassword">Confirm New Password</label>
                        <div class="password-input-wrapper">
                            <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Re-enter new password" required>
                            <button type="button" class="password-toggle" onclick="togglePassword('confirmPassword')">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <span class="input-helper" id="passwordMatch"></span>
                    </div>

                    <div class="password-requirements">
                        <p class="requirements-title">Password must contain:</p>
                        <ul>
                            <li id="req-length" class="requirement">At least 8 characters</li>
                            <li id="req-uppercase" class="requirement">One uppercase letter</li>
                            <li id="req-lowercase" class="requirement">One lowercase letter</li>
                            <li id="req-number" class="requirement">One number</li>
                            <li id="req-special" class="requirement">One special character</li>
                        </ul>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Update Password</button>
                        <button type="button" class="btn btn-secondary" id="cancelPassword">Cancel</button>
                    </div>
                </form>
            </div>

            <!-- Account Actions -->
            <div class="settings-card danger-zone">
                <div class="card-header">
                    <h2><i class="fa fa-exclamation-triangle" style="margin-left: 8px;color:red;"></i><span style="margin-left: 8px;">Account Actions</span></h2>
                    <p class="card-description">Manage your account status</p>
                </div>
                <div class="action-buttons">
                    <button type="button" class="btn btn-logout" id="logoutBtnForm">
                        <i class="fa fa-sign-out-alt" style="margin-right: 8px;font-size: 20px"></i>
                        Logout
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Success Toast -->
    <div class="toast" id="successToast">
        <i class="fas fa-check-circle toast-icon"></i>
        <span id="toastMessage">Changes saved successfully!</span>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal" id="confirmModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modalTitle">Confirm Action</h3>
            </div>
            <div class="modal-body">
                <p id="modalMessage">Are you sure you want to proceed?</p>
            </div>
            <div class="modal-actions">
                <button class="btn btn-secondary" id="modalCancel">Cancel</button>
                <button class="btn btn-primary" id="modalConfirm">Confirm</button>
            </div>
        </div>
    </div>

<script>

const URLROOT = "<?php echo URLROOT; ?>";

// State Management
let accountActive = true;
let originalPersonalData = {};
let originalBusinessData = {};

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    initializeData();
    attachEventListeners();
});

// Initialize data
function initializeData() {
    // Store original personal info (including disabled fields)
    const personalForm = document.getElementById('personalInfoForm');
    const personalInputs = personalForm.querySelectorAll('input, select, textarea');
  
    personalInputs.forEach(input => {
        originalPersonalData[input.id] = input.value;
    });

    // Store original business info (including disabled fields)
    const businessForm = document.getElementById('businessInfoForm');
    const businessInputs = businessForm.querySelectorAll('input, select, textarea');
    businessInputs.forEach(input => {
        originalBusinessData[input.id] = input.value;
    });
}

// Attach event listeners
function attachEventListeners() {


    // Status toggle
    document.getElementById('statusToggle').addEventListener('click', toggleAccountStatus);

    // Logout
    document.getElementById('logoutBtnForm').addEventListener('click', handleLogout);

    // Form submissions
    document.getElementById('personalInfoForm').addEventListener('submit', handlePersonalInfoSubmit);
    document.getElementById('businessInfoForm').addEventListener('submit', handleBusinessInfoSubmit);
    document.getElementById('passwordForm').addEventListener('submit', handlePasswordSubmit);

    // Cancel buttons
    document.getElementById('cancelPersonalInfo').addEventListener('click', () => resetForm('personalInfoForm', originalPersonalData));
    document.getElementById('cancelBusinessInfo').addEventListener('click', () => resetForm('businessInfoForm', originalBusinessData));
    document.getElementById('cancelPassword').addEventListener('click', resetPasswordForm);

    // Password validation
    document.getElementById('newPassword').addEventListener('input', validatePassword);
    document.getElementById('confirmPassword').addEventListener('input', checkPasswordMatch);

    

    // Modal buttons
    document.getElementById('modalCancel').addEventListener('click', hideModal);
}

// Toggle edit mode for forms
function toggleEdit(sectionId) {
    const card = document.querySelector(`[data-section="${sectionId}"]`);
    const editButton = card.querySelector('.edit-toggle');
    
    if (card.classList.contains('edit-mode')) {
        // Exit edit mode
        card.classList.remove('edit-mode');
        editButton.innerHTML = '<i class="fas fa-edit"></i> Edit';
        // Reset form to original values
        const formId = card.querySelector('form').id;
        if (formId === 'personalInfoForm') {
            resetForm(formId, originalPersonalData);
        } else if (formId === 'businessInfoForm') {
            resetForm(formId, originalBusinessData);
        }
        // For security settings, just reset the form
        if (formId === 'passwordForm') {
            resetPasswordForm();
        }
    } else {
        // Enter edit mode
        card.classList.add('edit-mode');
        editButton.innerHTML = '<i class="fas fa-times"></i> Cancel Edit';
    }
}

// Toggle password visibility password to text conversion
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const type = field.getAttribute('type');
    field.setAttribute('type', type === 'password' ? 'text' : 'password');
}

// Validate password strength
function validatePassword() {
    const password = document.getElementById('newPassword').value;
    const strengthBar = document.getElementById('strengthBarFill');
    const strengthText = document.getElementById('strengthText');
    
    // Requirements
    const requirements = {
        length: password.length >= 8,
        uppercase: /[A-Z]/.test(password),
        lowercase: /[a-z]/.test(password),
        number: /[0-9]/.test(password),
        special: /[!@#$%^&*(),.?":{}|<>]/.test(password)
    };

    // Update requirement indicators
    document.getElementById('req-length').classList.toggle('valid', requirements.length);
    document.getElementById('req-uppercase').classList.toggle('valid', requirements.uppercase);
    document.getElementById('req-lowercase').classList.toggle('valid', requirements.lowercase);
    document.getElementById('req-number').classList.toggle('valid', requirements.number);
    document.getElementById('req-special').classList.toggle('valid', requirements.special);

    // Calculate strength
    const metRequirements = Object.values(requirements).filter(Boolean).length;
    let strength = 'weak';
    
    if (metRequirements >= 5) {
        strength = 'strong';
        strengthText.textContent = 'Strong password';
    } else if (metRequirements >= 3) {
        strength = 'medium';
        strengthText.textContent = 'Medium password';
    } else if (password.length > 0) {
        strength = 'weak';
        strengthText.textContent = 'Weak password';
    } else {
        strengthText.textContent = 'Password strength';
    }

    // Update strength bar
    strengthBar.className = 'strength-bar-fill ' + strength;
    strengthText.className = 'strength-text ' + strength;

    // Check password match if confirm field has value
    if (document.getElementById('confirmPassword').value) {
        checkPasswordMatch();
    }

    return metRequirements === 5;
}

// Check password match
function checkPasswordMatch() {
    const newPassword = document.getElementById('newPassword').value;
    const confirmPassword = document.getElementById('confirmPassword').value;
    const matchText = document.getElementById('passwordMatch');

    if (confirmPassword === '') {
        matchText.textContent = '';
        matchText.style.color = 'var(--muted)';
        return true;
    }

    if (newPassword === confirmPassword) {
        matchText.textContent = '✓ Passwords match';
        matchText.style.color = 'var(--success)';
        return true;
    } else {
        matchText.textContent = '✗ Passwords do not match';
        matchText.style.color = 'var(--danger)';
        return false;
    }
}

// Toggle account status "active" or "deactivate"
function toggleAccountStatus() {
    const statusBanner = document.getElementById('statusBanner');
    const statusToggle = document.getElementById('statusToggle');
    const statusInfo = statusBanner.querySelector('.status-info');
    
    if (accountActive) {
        showModal(
            'Deactivate Account',
            'Are you sure you want to deactivate your account? Your profile will not be visible to customers.',
            () => {
                accountActive = false;
                statusBanner.classList.add('inactive');
                statusToggle.textContent = 'Activate';
                statusInfo.querySelector('h3').textContent = 'Account Inactive';
                statusInfo.querySelector('p').textContent = 'Your service provider account is currently inactive and not visible to customers';
                statusInfo.querySelector('.status-icon').innerHTML = '<i class="fa fa-times-circle"></i>';
                showToast('Account deactivated successfully');
            }
        );
    } else {
        accountActive = true;
        statusBanner.classList.remove('inactive');
        statusToggle.textContent = 'Deactivate';
        statusInfo.querySelector('h3').textContent = 'Account Active';
        statusInfo.querySelector('p').textContent = 'Your service provider account is currently active and visible to customers';
        statusInfo.querySelector('.status-icon').innerHTML = '<i class="fa fa-check-circle"></i>';
        showToast('Account activated successfully');
    }
}

// Handle personal info form submission
function handlePersonalInfoSubmit(e) {
    e.preventDefault();
    
    const formData = new FormData(e.target);
    const data = Object.fromEntries(formData);
    
    //send via AJAX
    var xml = new XMLHttpRequest();

    xml.onload = function(){
      if(this.readyState == 4 && this.status == 200){
        try {
            var response = JSON.parse(this.responseText);
            if(response.success == true){
                // Success
                setTimeout(() => {
                    // Update original data
                    Object.keys(data).forEach(key => {
                        originalPersonalData[key] = data[key];
                    });
                    
                    // Exit edit mode
                    const card = document.querySelector('[data-section="personal-info"]');
                    card.classList.remove('edit-mode');
                    const editButton = card.querySelector('.edit-toggle');
                    editButton.innerHTML = '<i class="fas fa-edit"></i> Edit';
                    
                    showToast('Personal information updated successfully');
                }, 500);
            }else{
                showToast(response.message || 'Failed to update personal information', 'error');
            }
        } catch(e) {
            showToast('Error parsing response', 'error');
            console.error(e);
        }
      }
    }
    
    xml.onerror = function(){
        showToast('Network error occurred', 'error');
    }

    var stringifiedData = JSON.stringify(data);
    xml.open("POST", URLROOT + "/Service/updatePersonalInfo",true);
    xml.setRequestHeader("Content-Type","application/json;charset=UTF-8");
    xml.send(stringifiedData);

}

// Handle business info form submission
function handleBusinessInfoSubmit(e) {
    e.preventDefault();
    
    const formData = new FormData(e.target);
    const data = Object.fromEntries(formData);
    
    
    //send as AJAX
    var xml = new XMLHttpRequest();

    xml.onload = function(){
      if(this.readyState == 4 && this.status == 200){
        try {
            var response = JSON.parse(this.responseText);
            if(response.success == true){
                // Success
                setTimeout(() => {
                    // Update original data
                    Object.keys(data).forEach(key => {
                        originalBusinessData[key] = data[key];
                    });
                    
                    // Exit edit mode
                    const card = document.querySelector('[data-section="business-info"]');
                    card.classList.remove('edit-mode');
                    const editButton = card.querySelector('.edit-toggle');
                    editButton.innerHTML = '<i class="fas fa-edit"></i> Edit';
                    
                    showToast('Business information updated successfully');
                }, 500);
            }else{
                showToast(response.message || 'Failed to update business information', 'error');
            }
        } catch(e) {
            showToast('Error parsing response', 'error');
            console.error(e);
        }
      }
    }

    xml.onerror = function(){
        showToast('Network error occurred', 'error');
    }

    var stringifiedData = JSON.stringify(data);
    xml.open("POST", URLROOT + "/Service/updateBusinessInfo",true);
    xml.setRequestHeader("Content-Type","application/json;charset=UTF-8");
    xml.send(stringifiedData);
}

// Handle password form submission
function handlePasswordSubmit(e) {
    e.preventDefault();
    
    const currentPassword = document.getElementById('currentPassword').value;
    const newPassword = document.getElementById('newPassword').value;
    const confirmPassword = document.getElementById('confirmPassword').value;
    
    // Validate new password
    if (!validatePassword()) {
        showToast('Password does not meet requirements', 'error');
        return;
    }
    
    // Check password match
    if (!checkPasswordMatch()) {
        showToast('Passwords do not match', 'error');
        return;
    }
    
    // Verify current password with backend
    var xml = new XMLHttpRequest();
    
    xml.onload = function(){
        if(this.readyState == 4 && this.status == 200){
            try {
                var response = JSON.parse(this.responseText);
                if(response.passwordValid == false){
                    showToast('Current password is incorrect', 'error');
                    return;
                }
                
                // If password is valid, show confirmation modal
                showModal(
                    'Update Password',
                    'Are you sure you want to update your password? You will need to log in again with your new password.',
                    () => {
                        // Send password update request
                        updatePassword(newPassword);
                    }
                );
            } catch(e) {
                showToast('Error verifying password', 'error');
                console.error(e);
            }
        }
    }
    
    xml.onerror = function(){
        showToast('Network error occurred', 'error');
    }
    
    var data = {
        currentPassword: currentPassword
    };
    
    var stringifiedData = JSON.stringify(data);
    xml.open("POST", URLROOT + "/Service/verifyPassword", true);
    xml.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xml.send(stringifiedData);
}

// Update password after verification
function updatePassword(newPassword) {
    var xml = new XMLHttpRequest();
    
    xml.onload = function(){
        if(this.readyState == 4 && this.status == 200){
            try {
                var response = JSON.parse(this.responseText);
                if(response.success == true){
                    setTimeout(() => {
                        resetPasswordForm();
                        // Exit edit mode
                        const card = document.querySelector('[data-section="security-settings"]');
                        card.classList.remove('edit-mode');
                        const editButton = card.querySelector('.edit-toggle');
                        editButton.innerHTML = '<i class="fas fa-edit"></i> Edit';
                        showToast('Password updated successfully');
                    }, 500);
                } else {
                    showToast(response.message || 'Failed to update password', 'error');
                }
            } catch(e) {
                showToast('Error updating password', 'error');
                console.error(e);
            }
        }
    }
    
    xml.onerror = function(){
        showToast('Network error occurred', 'error');
    }
    
    var data = {
        newPassword: newPassword
    };
    
    var stringifiedData = JSON.stringify(data);
    xml.open("POST", URLROOT + "/Service/updatePassword", true);
    xml.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xml.send(stringifiedData);
}

// Reset form
function resetForm(formId, originalData) {
    const form = document.getElementById(formId);
    Object.keys(originalData).forEach(key => {
        const element = document.getElementById(key);
        if (element) {
            element.value = originalData[key];
        }
    });
    showToast('Changes discarded');
}

// Handle logout
function handleLogout() {
    showModal(
        'Logout',
        'Are you sure you want to logout?',
        () => {
            window.location.href = URLROOT + '/Service/logout';
        }
    );
}

// Show toast notification
function showToast(message, type = 'success') {
    const toast = document.getElementById('successToast');
    const toastMessage = document.getElementById('toastMessage');
    const toastIcon = toast.querySelector('.toast-icon');
    
    toastMessage.textContent = message;
    
    // Update color based on type
    if (type === 'error') {
        toast.style.borderLeftColor = 'var(--danger)';
        toastIcon.style.color = 'var(--danger)';
    } else {
        toast.style.borderLeftColor = 'var(--success)';
        toastIcon.style.color = 'var(--success)';
    }
    
    toast.classList.add('show');
    
    setTimeout(() => {
        toast.classList.remove('show');
    }, 3000);
}

// Show modal
function showModal(title, message, onConfirm) {
    const modal = document.getElementById('confirmModal');
    const modalTitle = document.getElementById('modalTitle');
    const modalMessage = document.getElementById('modalMessage');
    const modalConfirm = document.getElementById('modalConfirm');
    
    modalTitle.textContent = title;
    modalMessage.textContent = message;
    
    // Remove old event listener and add new one
    const newConfirmBtn = modalConfirm.cloneNode(true);
    modalConfirm.parentNode.replaceChild(newConfirmBtn, modalConfirm);
    
    newConfirmBtn.addEventListener('click', () => {
        hideModal();
        onConfirm();
    });
    
    modal.classList.add('show');
}

// Reset password form
function resetPasswordForm() {
    document.getElementById('currentPassword').value = '';
    document.getElementById('newPassword').value = '';
    document.getElementById('confirmPassword').value = '';
    document.getElementById('passwordMatch').textContent = '';
    document.getElementById('strengthBarFill').style.width = '0%';
    document.getElementById('strengthText').textContent = 'Password strength';
    document.getElementById('strengthText').className = 'strength-text';
    
    // Reset requirement indicators
    const requirements = ['req-length', 'req-uppercase', 'req-lowercase', 'req-number', 'req-special'];
    requirements.forEach(id => {
        document.getElementById(id).classList.remove('valid');
    });
}

// Hide modal
function hideModal() {
    const modal = document.getElementById('confirmModal');
    modal.classList.remove('show');
}

// Close modal when clicking outside
document.addEventListener('click', (e) => {
    const modal = document.getElementById('confirmModal');
    if (e.target === modal) {
        hideModal();
    }
});

</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>