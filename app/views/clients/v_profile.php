<?php require_once APPROOT . '/views/inc/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Settings</title>
    <!-- Using a font like Inter or Poppins looks best with this palette -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
    --primary: #4B006E;
    --secondary: #6F1A8C;
    --dark: #0b1026;
    --light: #f7f8fc;
    --text: #111827;
    --muted: #6b7280;
    --success: #10b981;
    --warning: #f59e0b;
    --danger: #ef4444;
    --border: #e5e7eb;
    --shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    --shadow-hover: 0 6px 12px rgba(0, 0, 0, 0.1);
    --radius: 12px;
    --transition: all 0.3s ease;
    --lightbg: #f9f6fa;
    --font-main: 'Inter', sans-serif;
}

* { box-sizing: border-box; margin: 0; padding: 0; }

body {
    font-family: var(--font-main);
    background-color: var(--lightbg);
    color: var(--text);
    line-height: 1.5;
}

/* Layout Wrapper */
.dashboard-container {
    display: flex;
    min-height: 100vh;
}

/* Sidebar Placeholder Styling (For Context) */
.sidebar-placeholder {
    width: 260px;
    background: var(--dark);
    color: white;
    padding: 2rem;
    display: flex;
    flex-direction: column;
    gap: 2rem;
    flex-shrink: 0;
}
.sidebar-placeholder .logo { font-size: 1.5rem; font-weight: 700; color: white; }
.sidebar-placeholder nav a {
    display: block;
    color: #9ca3af;
    text-decoration: none;
    padding: 0.75rem 0;
    transition: var(--transition);
}
.sidebar-placeholder nav a:hover, .sidebar-placeholder nav a.active {
    color: white;
    padding-left: 10px;
}

/* Main Content */
.main-content {
    flex: 1;
    padding: 2rem;
    overflow-y: auto;
}

.profile-wrapper {
    max-width: 1200px;
    margin: 0 auto;
}

/* Grid Layout */
.grid-layout {
    display: grid;
    grid-template-columns: 300px 1fr;
    gap: 2rem;
}

@media (max-width: 900px) {
    .grid-layout { grid-template-columns: 1fr; }
    .dashboard-container { flex-direction: column; }
    .sidebar-placeholder { width: 100%; padding: 1rem; }
}

/* Profile Card (Left) */
.profile-card {
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    border-radius: var(--radius);
    padding: 2rem;
    color: white;
    text-align: center;
    box-shadow: var(--shadow);
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1.5rem;
    height: fit-content;
}

.profile-card__avatar {
    width: 100px;
    height: 100px;
    background: rgba(255,255,255,0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 2px solid rgba(255,255,255,0.3);
}
.profile-card__avatar svg { width: 50px; height: 50px; color: white; }

.profile-name { font-size: 1.5rem; font-weight: 600; margin: 0; }
.profile-title { font-size: 0.9rem; opacity: 0.8; margin: 0; }

.btn--outline-white {
    background: transparent;
    border: 1px solid rgba(255,255,255,0.4);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    cursor: pointer;
    font-size: 0.85rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    transition: var(--transition);
}
.btn--outline-white:hover { background: rgba(255,255,255,0.1); border-color: white; }

/* Form Card (Right) */
.form-card {
    background: white;
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    overflow: hidden;
    display: flex;
    flex-direction: column;
}

.form-card__head {
    padding: 1.5rem 2rem;
    border-bottom: 1px solid var(--border);
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.form-card__head h2 { font-size: 1.25rem; color: var(--dark); margin-bottom: 0.25rem; }
.form-card__head .subtitle { font-size: 0.875rem; color: var(--muted); }

.header-actions {
    display: flex;
    gap: 0.5rem;
    align-items: center;
}

.btn--icon {
    background: none;
    border: none;
    cursor: pointer;
    color: var(--muted);
    padding: 0.5rem;
    border-radius: 50%;
    transition: var(--transition);
}
.btn--icon:hover { background: var(--lightbg); color: var(--primary); }

.form-card__body { padding: 2rem; }

/* Form Grid inside Card */
.form-grid {
    display: grid;
    grid-template-columns: 1fr 300px;
    gap: 3rem;
}
@media (max-width: 768px) { .form-grid { grid-template-columns: 1fr; gap: 2rem; } }

/* Inputs */
.field { display: flex; flex-direction: column; gap: 0.5rem; margin-bottom: 1.25rem; }
.field__label { font-size: 0.875rem; font-weight: 500; color: var(--text); }

.input {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 1px solid var(--border);
    border-radius: var(--radius);
    font-family: inherit;
    font-size: 0.95rem;
    color: var(--text);
    background: #fff;
    transition: var(--transition);
}
.input:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(75, 0, 110, 0.1);
}
.input[readonly] { background-color: var(--lightbg); cursor: not-allowed; }
.input:disabled { 
    background-color: #f3f4f6; 
    cursor: not-allowed; 
    color: var(--muted);
    border-color: #e5e7eb;
}

/* Input Group (Password) */
.input-group { display: flex; gap: 0.5rem; }
.input-group .input { flex: 1; }

/* Buttons */
.btn {
    padding: 0.75rem 1.5rem;
    border-radius: var(--radius);
    font-weight: 500;
    cursor: pointer;
    transition: var(--transition);
    border: none;
    font-size: 0.95rem;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}
.btn--primary { background: var(--primary); color: white; }
.btn--primary:hover { background: var(--secondary); transform: translateY(-1px); box-shadow: var(--shadow-hover); }

.btn--secondary { background: white; border: 1px solid var(--border); color: var(--text); }
.btn--secondary:hover { background: var(--lightbg); border-color: var(--muted); }

.btn--text { background: none; color: var(--primary); font-weight: 600; padding: 0.5rem; }
.btn--text:hover { text-decoration: underline; }
.btn:disabled { 
    opacity: 0.6; 
    cursor: not-allowed; 
    pointer-events: none;
}
.btn--primary:disabled { background: var(--muted); }
.btn--secondary:disabled { background: #f3f4f6; border-color: #d1d5db; color: var(--muted); }

/* Aside / Security Section */
.form__aside { display: flex; flex-direction: column; gap: 1.5rem; }
.aside__title { font-size: 1.1rem; color: var(--dark); margin-bottom: 0.5rem; }

.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 500;
    width: fit-content;
}
.status-badge.success { background: rgba(16, 185, 129, 0.1); color: var(--success); }
.dot { width: 8px; height: 8px; border-radius: 50%; background: currentColor; }

.muted { color: var(--muted); font-size: 0.85rem; line-height: 1.6; }
.note { display: flex; gap: 0.5rem; align-items: flex-start; background: var(--lightbg); padding: 1rem; border-radius: var(--radius); }
.icon-sm { width: 18px; height: 18px; flex-shrink: 0; color: var(--muted); }

/* Password Animation & States */
.password-fields {
    animation: slideDown 0.3s ease forwards;
    margin-top: 1rem;
    padding-top: 1rem;
    border-top: 1px dashed var(--border);
}
.hidden { display: none; }

@keyframes slideDown {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

.password-strength { margin-top: 0.5rem; }
.strength-bar { height: 4px; background: var(--border); border-radius: 2px; overflow: hidden; margin-bottom: 0.25rem; }
.strength-bar-fill { height: 100%; width: 0%; transition: width 0.3s ease, background 0.3s ease; }
.strength-text { font-size: 0.75rem; color: var(--muted); }

/* Footer */
.form-card__foot {
    padding: 1.5rem 2rem;
    background: var(--light);
    border-top: 1px solid var(--border);
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
    transition: all 0.3s ease;
    max-height: 100px;
    opacity: 1;
}
.form-card__foot.hidden {
    max-height: 0;
    opacity: 0;
    padding: 0 2rem;
    border-top: none;
    overflow: hidden;
}

.hidden { display: none; }
    </style>
</head>
<body>

<!-- Main content wrapper -->
<div class="dashboard-container">
    

    <!-- Main Content Area -->
    <main class="main-content">
        <div class="profile-wrapper">
            <form id="profileForm" method="POST" action="#" class="profile-form">
                
                <div class="grid-layout">
                    <!-- Left profile card -->
                    <section class="profile-card">
                        <div class="profile-card__avatar">
                            <!-- Profile Picture Preview -->
                            <img id="profilePicPreview" src="<?php echo URLROOT; ?>/img/clientProfilePics/default-avatar.png" alt="Profile Picture" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; display: none;" />
                            <!-- Placeholder SVG if image fails -->
                            <svg id="avatarPlaceholder" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        </div>
                        <div class="profile-info">
                            <h3 class="profile-name">Karen Smith</h3>
                            <p class="profile-title">Premium Member</p>
                        </div>
                        <div class="card-actions">
                            <input type="file" id="profilePicInput" name="profile_pic" accept="image/*" style="display: none;" />
                            <button class="btn btn--outline-white" type="button" id="editAvatarBtn">
                                <svg class="icon" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                Edit Avatar
                            </button>
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
                                  <svg class="icon" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                </button>
                                <button type="button" class="btn btn--icon" id="resetBtn" aria-label="Reset Form" title="Reset">
                                  <svg class="icon" viewBox="0 0 24 24"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>
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
                                        <span class="field__label">Contact Number</span>
                                        <input class="input" type="tel" name="contact" placeholder="+94 7X XXX XXXX" disabled />
                                    </label>

                                    <label class="field">
                                        <span class="field__label">Address</span>
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
                                        <svg class="icon-sm" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
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
        resetBtn.innerHTML = '<svg class="icon" viewBox="0 0 24 24"><path d="M18 6l-12 12"/><path d="M6 6l12 12"/></svg>';
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
        resetBtn.innerHTML = '<svg class="icon" viewBox="0 0 24 24"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>';
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
            <svg class="icon" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"/></svg>
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

</body>
</html>

<?php require APPROOT . '/views/inc/footer.php';?>