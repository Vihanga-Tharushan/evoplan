<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/issue/sidebar/sidebar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/components/issueC/myaccount.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>

<div class="main-content">
    <div class="settings-container">
        <!-- Account Status Banner -->
        <div class="status-banner">
            <div class="status-info">
                <div class="status-icon">
                    <i class="fas fa-user-circle"></i>
                </div>
                <div>
                    <h3>Issue Coordinator Account</h3>
                    <p>Manage your account settings and monitor your performance</p>
                </div>
            </div>
        </div>

        <!-- Settings Sections -->
        <div class="settings-sections">
            <!-- Personal Information -->
            <div class="settings-card" data-section="personal">
                <button class="edit-toggle" onclick="toggleEdit('personal')">
                    <i class="fas fa-edit"></i> Edit
                </button>
                <div class="card-header">
                    <h2>Personal Information</h2>
                    <p class="card-description">Update your basic information</p>
                </div>
                <form class="settings-form" id="personalInfoForm">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="ic_id">Coordinator ID</label>
                            <input type="text" id="ic_id" name="ic_id" disabled>
                        </div>
                        <div class="form-group">
                            <label for="ic_name">Full Name</label>
                            <input type="text" id="ic_name" name="ic_name" placeholder="Enter your full name">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="ic_email">Email Address</label>
                            <input type="email" id="ic_email" name="ic_email" placeholder="Enter your email">
                        </div>
                        <div class="form-group">
                            <label for="ic_phone">Phone Number</label>
                            <input type="tel" id="ic_phone" name="ic_phone" placeholder="Enter your phone number">
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save Changes
                        </button>
                        <button type="button" class="btn btn-secondary" id="cancelPersonalInfo">
                            <i class="fas fa-times"></i> Cancel
                        </button>
                    </div>
                </form>
            </div>

            <!-- Security Settings -->
            <div class="settings-card" data-section="security">
                <button class="edit-toggle" onclick="toggleEdit('security')">
                    <i class="fas fa-edit"></i> Edit
                </button>
                <div class="card-header">
                    <h2>Security Settings</h2>
                    <p class="card-description">Manage your password and security preferences</p>
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
                        <div class="password-strength">
                            <div class="strength-bar">
                                <div class="strength-bar-fill" id="strengthBarFill"></div>
                            </div>
                            <div class="strength-text" id="strengthText">Password strength</div>
                        </div>
                        <div class="password-requirements">
                            <div class="requirements-title">Password Requirements:</div>
                            <ul>
                                <li class="requirement" id="req-length">At least 8 characters</li>
                                <li class="requirement" id="req-uppercase">At least one uppercase letter</li>
                                <li class="requirement" id="req-lowercase">At least one lowercase letter</li>
                                <li class="requirement" id="req-number">At least one number</li>
                                <li class="requirement" id="req-special">At least one special character (!@#$%^&*)</li>
                            </ul>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="confirmPassword">Confirm New Password</label>
                        <div class="password-input-wrapper">
                            <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm new password" required>
                            <button type="button" class="password-toggle" onclick="togglePassword('confirmPassword')">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <div class="input-helper" id="passwordMatch"></div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-lock"></i> Update Password
                        </button>
                        <button type="button" class="btn btn-secondary" id="cancelPassword">
                            <i class="fas fa-times"></i> Cancel
                        </button>
                    </div>
                </form>
            </div>

            <!-- Income & Performance -->
            <div class="settings-card" data-section="income">
                <div class="card-header">
                    <h2>Monthly Income</h2>
                    <p class="card-description">Track your earnings over the last 6 months</p>
                </div>
                <div class="income-chart-wrapper">
                    <canvas id="incomeChart"></canvas>
                </div>
                <div class="income-summary">
                    <div class="summary-stat">
                        <span class="summary-label">Total Income (6 months)</span>
                        <span class="summary-value" id="totalIncome">LKR 0.00</span>
                    </div>
                    <div class="summary-stat">
                        <span class="summary-label">Average Monthly</span>
                        <span class="summary-value" id="averageIncome">LKR 0.00</span>
                    </div>
                    <div class="summary-stat">
                        <span class="summary-label">Highest Month</span>
                        <span class="summary-value" id="highestIncome">LKR 0.00</span>
                    </div>
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
            <h3 id="modalTitle">Confirmation</h3>
        </div>
        <div class="modal-body">
            <p id="modalMessage">Are you sure?</p>
        </div>
        <div class="modal-actions">
            <button class="btn btn-secondary" onclick="hideModal()">Cancel</button>
            <button class="btn btn-primary" id="modalConfirm">Confirm</button>
        </div>
    </div>
</div>

<script>
const URLROOT = "<?php echo URLROOT; ?>";

let originalPersonalData = {};

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    initializeData();
    attachEventListeners();
    loadIncomeChart();
});

// Initialize data
function initializeData() {
    // Store original personal info (including disabled fields)
    const personalForm = document.getElementById('personalInfoForm');
    const personalInputs = personalForm.querySelectorAll('input, select, textarea');
  
    personalInputs.forEach(input => {
        // Set dummy data if empty
        if (!input.value) {
            if (input.id === 'ic_id') input.value = 'IC-2024-001';
            else if (input.id === 'ic_name') input.value = 'Kumara Silva';
            else if (input.id === 'ic_email') input.value = 'kumara.silva@evoplan.com';
            else if (input.id === 'ic_phone') input.value = '+94 771 234567';
        }
        originalPersonalData[input.id] = input.value;
    });
}

// Attach event listeners
function attachEventListeners() {
    // Form submissions
    document.getElementById('personalInfoForm').addEventListener('submit', handlePersonalInfoSubmit);
    document.getElementById('passwordForm').addEventListener('submit', handlePasswordSubmit);

    // Cancel buttons
    document.getElementById('cancelPersonalInfo').addEventListener('click', () => resetForm('personalInfoForm', originalPersonalData));
    document.getElementById('cancelPassword').addEventListener('click', resetPasswordForm);

    // Password validation
    document.getElementById('newPassword').addEventListener('input', validatePassword);
    document.getElementById('confirmPassword').addEventListener('input', checkPasswordMatch);

    // Modal buttons
    document.getElementById('modalCancel')?.addEventListener('click', hideModal);
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
        }
        if (formId === 'passwordForm') {
            resetPasswordForm();
        }
    } else {
        // Enter edit mode
        card.classList.add('edit-mode');
        editButton.innerHTML = '<i class="fas fa-times"></i> Cancel Edit';
    }
}

// Toggle password visibility
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

// Handle personal info form submission
function handlePersonalInfoSubmit(e) {
    e.preventDefault();
    
    const formData = new FormData(e.target);
    const data = Object.fromEntries(formData);
    
    var xml = new XMLHttpRequest();

    xml.onload = function(){
        if(this.readyState == 4 && this.status == 200){
            try {
                const response = JSON.parse(this.responseText);
                if(response.success) {
                    Object.assign(originalPersonalData, data);
                    showToast('Personal information updated successfully');
                    toggleEdit('personal');
                } else {
                    showToast(response.message || 'Error updating information', 'error');
                }
            } catch(e) {
                showToast('Error processing response', 'error');
            }
        }
    }
    
    xml.onerror = function(){
        showToast('Network error occurred', 'error');
    }

    var stringifiedData = JSON.stringify(data);
    xml.open("POST", URLROOT + "/IssueC/updatePersonalInfo", true);
    xml.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
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
    
    // Send password update
    var xml = new XMLHttpRequest();
    
    xml.onload = function(){
        if(this.readyState == 4 && this.status == 200){
            try {
                const response = JSON.parse(this.responseText);
                if(response.success) {
                    showToast('Password updated successfully');
                    resetPasswordForm();
                    toggleEdit('security');
                } else {
                    showToast(response.message || 'Error updating password', 'error');
                }
            } catch(e) {
                showToast('Error processing response', 'error');
            }
        }
    }
    
    xml.onerror = function(){
        showToast('Network error occurred', 'error');
    }
    
    var data = {
        currentPassword: currentPassword,
        newPassword: newPassword
    };
    
    var stringifiedData = JSON.stringify(data);
    xml.open("POST", URLROOT + "/IssueC/updatePassword", true);
    xml.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xml.send(stringifiedData);
}

// Dummy data for income chart
function getDummyIncomeData() {
    const currentDate = new Date();
    const months = [];
    const incomes = [];
    
    // Generate last 6 months
    for (let i = 5; i >= 0; i--) {
        const date = new Date(currentDate.getFullYear(), currentDate.getMonth() - i, 1);
        months.push(date.toLocaleString('default', { month: 'short', year: '2-digit' }));
    }
    
    // Dummy income data (realistic values for issue coordinator)
    incomes.push(12500, 15800, 14200, 18500, 16700, 19200);
    
    return { months, incomes };
}

// Load income chart
function loadIncomeChart() {
    var xml = new XMLHttpRequest();
    
    xml.onload = function(){
        if(this.readyState == 4 && this.status == 200){
            try {
                const response = JSON.parse(this.responseText);
                if(response.success) {
                    renderIncomeChart(response.data);
                    updateIncomeSummary(response.data);
                } else {
                    // Fallback to dummy data
                    const dummyData = getDummyIncomeData();
                    renderIncomeChart(dummyData);
                    updateIncomeSummary(dummyData);
                }
            } catch(e) {
                console.error('Error parsing income data, using dummy data', e);
                // Fallback to dummy data
                const dummyData = getDummyIncomeData();
                renderIncomeChart(dummyData);
                updateIncomeSummary(dummyData);
            }
        }
    }
    
    xml.onerror = function(){
        console.error('Error loading income data, using dummy data');
        // Fallback to dummy data
        const dummyData = getDummyIncomeData();
        renderIncomeChart(dummyData);
        updateIncomeSummary(dummyData);
    }
    
    xml.open("GET", URLROOT + "/IssueC/getMonthlyIncome", true);
    xml.send();
}

// Render income chart
function renderIncomeChart(data) {
    const ctx = document.getElementById('incomeChart').getContext('2d');
    
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: data.months,
            datasets: [{
                label: 'Monthly Income (LKR)',
                data: data.incomes,
                backgroundColor: '#4B006E',
                borderRadius: 6,
                borderSkipped: false,
                hoverBackgroundColor: '#6F1A8C'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: true,
                    labels: {
                        font: { size: 14, weight: '600' },
                        padding: 20,
                        color: '#111827'
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Income (LKR)',
                        font: { size: 14, weight: 'bold' }
                    },
                    ticks: {
                        callback: function(value) {
                            return 'LKR ' + value.toLocaleString();
                        }
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Month',
                        font: { size: 14, weight: 'bold' }
                    }
                }
            }
        }
    });
}

// Update income summary
function updateIncomeSummary(data) {
    const total = data.incomes.reduce((a, b) => a + b, 0);
    const average = Math.round(total / data.incomes.length);
    const highest = Math.max(...data.incomes);
    
    document.getElementById('totalIncome').textContent = 'LKR ' + total.toLocaleString();
    document.getElementById('averageIncome').textContent = 'LKR ' + average.toLocaleString();
    document.getElementById('highestIncome').textContent = 'LKR ' + highest.toLocaleString();
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