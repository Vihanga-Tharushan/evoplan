<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/inc/clientsidebar/sidebar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/components/client/profile.css">

<!-- Main content wrapper -->
<div class="dashboard-container">
    

    <!-- Main Content Area -->
    <main class="main-content">
        <div class="profile-wrapper">
            <form id="profileForm" method="POST" action="#" class="profile-form">
                
                <div class="grid-layout">
                    <!-- Left profile card -->
                    <section class="profile-card">
                      <div class="containt-avatar">
                        <div class="profile-card__avatar">
                            <!-- Profile Picture Preview -->
                            <img id="profilePicPreview" src="<?php echo URLROOT; ?>/img/profilePics/default-avatar.png" alt="Profile Picture" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; display: none;" />
                            <i class="fas fa-user-circle avatar-placeholder" id="avatarPlaceholder" style="font-size: 100px; color: var(--light);"></i>
                        </div>
                        <div class="profile-info">
                            <h3 class="profile-name">Karen Smith</h3>
                            <p class="profile-title">Premium Member</p>
                        </div>
                        <div class="card-actions">
                            <input type="file" id="profilePicInput" name="profile_pic" accept="image/*" style="display: none;" />
                            <button class="btn btn--outline-white" type="button" id="editAvatarBtn">
                               <i class="fas fa-edit"></i>
                                Edit Avatar
                            </button>
                        </div>
                      </div>
                    </section>

                    <!-- Right form card -->
                    <section class="form-card">
                        <header class="form-card__head">
                            <div>
                                <h2>Account Settings</h2>
                                <p class="subtitle">Update your profile details and security preferences.</p>
                            </div>
                            <div class="header-actions">
                                <button type="button" class="btn btn--icon" id="editBtn" aria-label="Edit Form" title="Edit">
                                  <i class="fas fa-edit"></i>
                                </button>
                                <button type="button" class="btn btn--icon" id="resetBtn" aria-label="Reset Form" title="Reset">
                                  <i class="fas fa-undo"></i>
                                </button>
                            </div>
                        </header>

                        <div class="form-card__body">
                            <div class="form-grid">
                                <div class="form__col">
                                    <label class="field">
                                        <span class="field__label">Full Name</span>
                                        <input class="input" type="text" name="name" value="Karen Smith" required disabled />
                                    </label>

                                    <label class="field">
                                        <span class="field__label">Email Address</span>
                                        <input class="input" type="email" name="email" value="karen@example.com" required disabled />
                                    </label>

                                    <label class="field">
                                        <span class="field__label">Phone Number</span>
                                        <input class="input" type="tel" name="contact" placeholder="+94 7X XXX XXXX" disabled />
                                    </label>

                                    <label class="field">
                                        <span class="field__label"></aside>Address</span>
                                        <input class="input" type="text" name="address" placeholder="Street, City, Zip" disabled />
                                    </label>
                                </div>

                                <aside class="form__aside">
                                    <h3 class="aside__title">Security</h3>
                                    
                                    <div class="status-badge success">
                                        <span class="dot"></span>
                                        Account Active
                                    </div>

                                    <div class="password-section" id="passwordSection">
                                        <label class="field">
                                            <span class="field__label">Current Password</span>
                                            <div class="input-group">
                                                <input class="input" type="password" id="currentPass" value="********" readonly disabled />
                                                <button type="button" class="btn btn--text" id="togglePasswordBtn" disabled>Change</button>
                                            </div>
                                        </label>

                                        <!-- Hidden fields that appear on click -->
                                        <div class="password-fields hidden" id="newPasswordFields">
                                            <label class="field">
                                                <span class="field__label">New Password</span>
                                                <input class="input" type="password" id="newPass" placeholder="Min 8 characters" />
                                            </label>
                                            <label class="field">
                                                <span class="field__label">Confirm New Password</span>
                                                <input class="input" type="password" id="confirmPass" placeholder="Re-enter password" />
                                            </label>
                                            <div class="password-strength">
                                                <div class="strength-bar" id="strengthBar"></div>
                                                <span class="strength-text" id="strengthText"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <p class="muted note">
                                      <i class="fas fa-info-circle"></i>
                                        Ensure your new password is unique and not used on other sites.
                                    </p>
                                </aside>
                            </div>
                        </div>

                        <footer class="form-card__foot hidden" id="formFooter">
                            <button class="btn btn--secondary" type="button" id="cancelBtn">Cancel</button>
                            <button class="btn btn--primary" type="submit" id="submitBtn">Save Changes</button>
                        </footer>
                    </section>
                </div>
            </form>
        </div>
    </main>
</div>

<!-- JS SCRIPT BELOW -->
<script>
  document.addEventListener('DOMContentLoaded', () => {
    
    // Elements
    const editBtn = document.getElementById('editBtn');
    const cancelBtn = document.getElementById('cancelBtn');
    const toggleBtn = document.getElementById('togglePasswordBtn');
    const currentPassInput = document.getElementById('currentPass');
    const newPasswordFields = document.getElementById('newPasswordFields');
    const newPassInput = document.getElementById('newPass');
    const confirmPassInput = document.getElementById('confirmPass');
    const resetBtn = document.getElementById('resetBtn');
    const profileForm = document.getElementById('profileForm');
    const formFooter = document.getElementById('formFooter');
    const submitBtn = document.getElementById('submitBtn');
    
    // Strength Meter Elements
    const strengthBar = document.getElementById('strengthBar');
    const strengthText = document.getElementById('strengthText');
    
    // Store original values
    let originalValues = {};
    
    // Get all form inputs
    const formInputs = profileForm.querySelectorAll('input[type="text"], input[type="email"], input[type="tel"]');

    // Load client settings on page load
    function loadSettings() {
        fetch('<?php echo URLROOT; ?>/Clients/getSettings', {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Populate form with client data
                document.querySelector('input[name="name"]').value = data.data.name;
                document.querySelector('input[name="email"]').value = data.data.email;
                document.querySelector('input[name="contact"]').value = data.data.contact || '';
                document.querySelector('input[name="address"]').value = data.data.address || '';
                
                // Update profile name at the top
                document.querySelector('.profile-name').textContent = data.data.name;
                
                // Update profile picture if exists
                if (data.data.profile_pic) {
                    profilePicPreview.src = '<?php echo URLROOT; ?>/img/clientProfilePic/' + data.data.profile_pic;
                    profilePicPreview.style.display = 'block';
                    avatarPlaceholder.style.display = 'none';
                }
                
                storeOriginalValues();
            } else {
                showToast('Failed to load client data', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('An error occurred while loading settings.', 'error');
        });
    }

    // Initialize - Store original values
    function storeOriginalValues() {
        formInputs.forEach(input => {
            originalValues[input.name] = input.value;
        });
    }
    
    // Load settings on page load
    loadSettings();

    // Profile Picture Upload Functionality
    const editAvatarBtn = document.getElementById('editAvatarBtn');
    const profilePicInput = document.getElementById('profilePicInput');
    const profilePicPreview = document.getElementById('profilePicPreview');
    const avatarPlaceholder = document.getElementById('avatarPlaceholder');

    editAvatarBtn.addEventListener('click', function() {
        profilePicInput.click();
    });

    profilePicInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            // Validate file type
            if (!file.type.startsWith('image/')) {
                showToast('Please select an image file', 'error');
                return;
            }
            
            // Validate file size (max 5MB)
            if (file.size > 5 * 1024 * 1024) {
                showToast('Image size should be less than 5MB', 'error');
                return;
            }

            // Preview image
            const reader = new FileReader();
            reader.onload = function(e) {
                profilePicPreview.src = e.target.result;
                profilePicPreview.style.display = 'block';
                avatarPlaceholder.style.display = 'none';
            };
            reader.readAsDataURL(file);
            
            // Automatically show footer for save button
            formFooter.classList.remove('hidden');
            
            showToast('Profile picture selected. Click Save Changes to upload.', 'success');
        }
    });

    // 0. EDIT MODE TOGGLE
    editBtn.addEventListener('click', (e) => {
        e.preventDefault();
        
        // Enable all inputs
        formInputs.forEach(input => {
            input.removeAttribute('disabled');
        });
        
        // Enable password input
        currentPassInput.removeAttribute('disabled');
        
        // Enable toggle password button
        toggleBtn.removeAttribute('disabled');
        
        // Show footer
        formFooter.classList.remove('hidden');
        
        // Hide edit button, show reset button with different style
        editBtn.style.display = 'none';
        resetBtn.textContent = '';
        resetBtn.innerHTML = '<i class="fas fa-times"></i>';
        resetBtn.setAttribute('title', 'Exit Edit Mode');
        
        // Focus first input
        formInputs[0].focus();
    });

    // Exit Edit Mode
    function exitEditMode() {
        // Disable all inputs
        formInputs.forEach(input => {
            input.setAttribute('disabled', 'disabled');
        });
        
        // Disable password input
        currentPassInput.setAttribute('disabled', 'disabled');
        
        // Disable toggle password button
        toggleBtn.setAttribute('disabled', 'disabled');
        
        // Hide footer
        formFooter.classList.add('hidden');
        
        // Show edit button again
        editBtn.style.display = '';
        resetBtn.innerHTML = '<i class="fas fa-undo"></i>';
        resetBtn.setAttribute('title', 'Reset');
        
        // Reset password section
        resetPasswordSection();
    }

    // 1. CANCEL BUTTON - Exit edit mode without saving
    cancelBtn.addEventListener('click', (e) => {
        e.preventDefault();
        
        // Reset form to original values
        profileForm.reset();
        formInputs.forEach(input => {
            if (originalValues[input.name]) {
                input.value = originalValues[input.name];
            }
        });
        
        exitEditMode();
        showToast('Changes discarded', 'info');
    });

    // 2. RESET BUTTON - Clear everything when in edit mode
    resetBtn.addEventListener('click', (e) => {
        e.preventDefault();
        
        if(!editBtn.style.display || editBtn.style.display === 'none') {
            // In edit mode - exit
            if(confirm('Discard all changes and exit edit mode?')) {
                profileForm.reset();
                formInputs.forEach(input => {
                    if (originalValues[input.name]) {
                        input.value = originalValues[input.name];
                    }
                });
                exitEditMode();
            }
        }
    });

    // 3. Handle "Change Password" Toggle
    toggleBtn.addEventListener('click', (e) => {
        e.preventDefault();
        const isReadonly = currentPassInput.hasAttribute('readonly');
        
        if (isReadonly) {
            // Enable editing mode
            currentPassInput.removeAttribute('readonly');
            currentPassInput.value = ''; // Clear stars
            currentPassInput.placeholder = 'Enter current password';
            currentPassInput.focus();
            
            // Show new password fields
            newPasswordFields.classList.remove('hidden');
            toggleBtn.textContent = 'Cancel';
            toggleBtn.classList.add('btn--danger-text');
        } else {
            // Cancel editing mode
            resetPasswordSection();
        }
    });

    // 4. Password Strength Logic
    newPassInput.addEventListener('input', (e) => {
        const val = e.target.value;
        let strength = 0;
        
        if (val.length > 5) strength += 1;
        if (val.length > 8) strength += 1;
        if (/[A-Z]/.test(val)) strength += 1;
        if (/[0-9]/.test(val)) strength += 1;
        if (/[^A-Za-z0-9]/.test(val)) strength += 1;

        // Update UI
        let width = '0%';
        let color = 'var(--border)';
        let text = '';

        if (strength === 0) {
            text = '';
        } else if (strength <= 2) {
            width = '33%';
            color = 'var(--danger)';
            text = 'Weak';
        } else if (strength <= 4) {
            width = '66%';
            color = 'var(--warning)';
            text = 'Medium';
        } else {
            width = '100%';
            color = 'var(--success)';
            text = 'Strong';
        }

        // Create or update bar
        let barFill = strengthBar.querySelector('.strength-bar-fill');
        if (!barFill) {
            barFill = document.createElement('div');
            barFill.className = 'strength-bar-fill';
            strengthBar.appendChild(barFill);
        }
        
        barFill.style.width = width;
        barFill.style.background = color;
        strengthText.textContent = text;
        strengthText.style.color = color;
    });

    // 5. Form Submission with AJAX - Profile Update Only
    profileForm.addEventListener('submit', (e) => {
        e.preventDefault();
        
        // Check if password is being changed
        const isPasswordChange = !newPasswordFields.classList.contains('hidden');
        
        if (isPasswordChange) {
            // Validate password fields
            if (newPassInput.value !== confirmPassInput.value) {
                showToast('New passwords do not match!', 'error');
                confirmPassInput.focus();
                confirmPassInput.style.borderColor = 'var(--danger)';
                return;
            }
            if (newPassInput.value.length < 6) {
                showToast('Password must be at least 6 characters long.', 'error');
                return;
            }
            
            // Submit password change
            submitPasswordChange();
        } else {
            // Submit profile update
            submitProfileUpdate();
        }
    });

    // Submit Profile Update
    function submitProfileUpdate() {
        // Prepare FormData
        const formData = new FormData();
        formData.append('name', document.querySelector('input[name="name"]').value);
        formData.append('email', document.querySelector('input[name="email"]').value);
        formData.append('contact', document.querySelector('input[name="contact"]').value);
        formData.append('address', document.querySelector('input[name="address"]').value);
        
        // Add profile picture if selected
        const profilePicInput = document.getElementById('profilePicInput');
        if (profilePicInput.files.length > 0) {
            formData.append('profile_pic', profilePicInput.files[0]);
        }
        
        // Disable submit button during request
        submitBtn.setAttribute('disabled', 'disabled');
        const originalText = submitBtn.textContent;
        submitBtn.textContent = 'Saving...';
        
        // AJAX Request
        fetch('<?php echo URLROOT; ?>/Clients/updateSettings', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showToast(data.message || 'Profile updated successfully!', 'success');
                storeOriginalValues();
                exitEditMode();
            } else {
                showToast(data.message || 'Error saving profile', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('An error occurred. Please try again.', 'error');
        })
        .finally(() => {
            submitBtn.removeAttribute('disabled');
            submitBtn.textContent = originalText;
        });
    }

    // Submit Password Change
    function submitPasswordChange() {
        // Prepare FormData
        const formData = new FormData();
        formData.append('currentPassword', currentPassInput.value);
        formData.append('newPassword', newPassInput.value);
        formData.append('confirmPassword', confirmPassInput.value);
        
        // Disable submit button during request
        submitBtn.setAttribute('disabled', 'disabled');
        const originalText = submitBtn.textContent;
        submitBtn.textContent = 'Changing Password...';
        
        // AJAX Request to separate password endpoint
        fetch('<?php echo URLROOT; ?>/Clients/updatePassword', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showToast(data.message || 'Password changed successfully!', 'success');
                resetPasswordSection();
                exitEditMode();
            } else {
                showToast(data.message || 'Error changing password', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('An error occurred. Please try again.', 'error');
        })
        .finally(() => {
            submitBtn.removeAttribute('disabled');
            submitBtn.textContent = originalText;
        });
    }

    // Helper function to reset password section
    function resetPasswordSection() {
        currentPassInput.setAttribute('readonly', true);
        currentPassInput.value = '********';
        currentPassInput.placeholder = '';
        
        newPasswordFields.classList.add('hidden');
        newPassInput.value = '';
        confirmPassInput.value = '';
        
        // Reset strength bar
        const barFill = strengthBar.querySelector('.strength-bar-fill');
        if(barFill) barFill.style.width = '0%';
        strengthText.textContent = '';
        
        toggleBtn.textContent = 'Change';
        toggleBtn.classList.remove('btn--danger-text');
    }
    
    // Toast Notification Helper
    function showToast(message, type = 'info') {
        const toast = document.createElement('div');
        toast.className = `toast ${type} show`;
        toast.innerHTML = `
            <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'}"></i>
            <span>${message}</span>
        `;
        
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => toast.remove(), 300);
        }, 4000);
    }
});
</script>

<?php require APPROOT . '/views/inc/footer.php';?>