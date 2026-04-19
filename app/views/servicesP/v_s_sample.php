<?php require APPROOT . '/views/inc/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form with All Input Types</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 40px 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
            margin-bottom: 30px;
            text-align: center;
            font-size: 2rem;
        }

        .form-group {
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 600;
            font-size: 0.95rem;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="phone"],
        input[type="number"],
        input[type="url"],
        input[type="date"],
        input[type="time"],
        input[type="color"],
        input[type="range"],
        select,
        textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 6px;
            font-size: 1rem;
            font-family: inherit;
            transition: all 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus,
        input[type="phone"]:focus,
        input[type="number"]:focus,
        input[type="url"]:focus,
        input[type="date"]:focus,
        input[type="time"]:focus,
        input[type="color"]:focus,
        select:focus,
        textarea:focus {
            border-color: #667eea;
            outline: none;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        .checkbox-group,
        .radio-group {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .checkbox-item,
        .radio-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        input[type="checkbox"],
        input[type="radio"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: #667eea;
        }

        .checkbox-item label,
        .radio-item label {
            margin-bottom: 0;
            font-weight: normal;
            cursor: pointer;
        }

        .file-upload {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        input[type="file"] {
            display: none;
        }

        .file-label {
            display: block;
            padding: 12px 15px;
            border: 2px dashed #667eea;
            border-radius: 6px;
            text-align: center;
            cursor: pointer;
            background: #f8f9ff;
            transition: all 0.3s ease;
        }

        .file-label:hover {
            background: #eff0ff;
            border-color: #764ba2;
        }

        .file-name {
            display: block;
            margin-top: 8px;
            font-size: 0.9rem;
            color: #666;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .error {
            color: #ef4444;
            font-size: 0.85rem;
            margin-top: 5px;
            display: none;
        }

        .error.show {
            display: block;
        }

        input.invalid,
        select.invalid,
        textarea.invalid {
            border-color: #ef4444;
        }

        input.valid,
        select.valid,
        textarea.valid {
            border-color: #10b981;
        }

        .success-message {
            background: #d1fae5;
            color: #065f46;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            display: none;
        }

        .success-message.show {
            display: block;
        }

        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 30px;
        }

        button {
            flex: 1;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-submit {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-reset {
            background: #e5e7eb;
            color: #333;
        }

        .btn-reset:hover {
            background: #d1d5db;
        }

        .range-value {
            display: inline-block;
            margin-left: 10px;
            color: #667eea;
            font-weight: 600;
        }

        @media (max-width: 600px) {
            .form-row {
                grid-template-columns: 1fr;
            }

            .container {
                padding: 20px;
            }

            h1 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Comprehensive Form Example</h1>

        <div class="success-message" id="successMessage">
            ✓ Form submitted successfully!
        </div>

        <form id="sampleForm" novalidate>
            <!-- Text Input -->
            <div class="form-group">
                <label for="fullName">Full Name *</label>
                <input type="text" id="fullName" name="fullName" placeholder="Enter your full name">
                <div class="error" id="fullNameError">Please enter a valid name (min 3 characters)</div>
            </div>

            <!-- Email Input -->
            <div class="form-group">
                <label for="email">Email Address *</label>
                <input type="email" id="email" name="email" placeholder="you@example.com">
                <div class="error" id="emailError">Please enter a valid email address</div>
            </div>

            <!-- Password Input -->
            <div class="form-group">
                <label for="password">Password *</label>
                <input type="password" id="password" name="password" placeholder="Enter a strong password">
                <div class="error" id="passwordError">Password must be at least 8 characters with uppercase, lowercase, and number</div>
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="confirmPassword">Confirm Password *</label>
                <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm your password">
                <div class="error" id="confirmPasswordError">Passwords do not match</div>
            </div>

            <!-- Phone Number -->
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" placeholder="+1 (555) 000-0000">
                <div class="error" id="phoneError">Please enter a valid phone number (10-15 digits)</div>
            </div>

            <!-- URL Input -->
            <div class="form-group">
                <label for="website">Website URL</label>
                <input type="url" id="website" name="website" placeholder="https://example.com">
                <div class="error" id="websiteError">Please enter a valid URL</div>
            </div>

            <!-- Two Column Row -->
            <div class="form-row">
                <!-- Number Input -->
                <div class="form-group">
                    <label for="age">Age</label>
                    <input type="number" id="age" name="age" min="18" max="120" placeholder="Enter your age">
                    <div class="error" id="ageError">Age must be between 18 and 120</div>
                </div>

                <!-- Date Input -->
                <div class="form-group">
                    <label for="birthDate">Date of Birth</label>
                    <input type="date" id="birthDate" name="birthDate">
                    <div class="error" id="birthDateError">Please select a valid date</div>
                </div>
            </div>

            <!-- Two Column Row -->
            <div class="form-row">
                <!-- Time Input -->
                <div class="form-group">
                    <label for="meetingTime">Meeting Time</label>
                    <input type="time" id="meetingTime" name="meetingTime">
                    <div class="error" id="meetingTimeError">Please select a valid time</div>
                </div>

                <!-- Color Picker -->
                <div class="form-group">
                    <label for="favoriteColor">Favorite Color</label>
                    <input type="color" id="favoriteColor" name="favoriteColor" value="#667eea">
                </div>
            </div>

            <!-- Range Input -->
            <div class="form-group">
                <label for="satisfaction">Satisfaction Level <span class="range-value">50%</span></label>
                <input type="range" id="satisfaction" name="satisfaction" min="0" max="100" value="50">
            </div>

            <!-- Select/Dropdown -->
            <div class="form-group">
                <label for="country">Country *</label>
                <select id="country" name="country">
                    <option value="">Select a country</option>
                    <option value="usa">United States</option>
                    <option value="canada">Canada</option>
                    <option value="uk">United Kingdom</option>
                    <option value="australia">Australia</option>
                    <option value="sri-lanka">Sri Lanka</option>
                </select>
                <div class="error" id="countryError">Please select a country</div>
            </div>

            <!-- Radio Buttons -->
            <div class="form-group">
                <label>Gender *</label>
                <div class="radio-group">
                    <div class="radio-item">
                        <input type="radio" id="male" name="gender" value="male">
                        <label for="male">Male</label>
                    </div>
                    <div class="radio-item">
                        <input type="radio" id="female" name="gender" value="female">
                        <label for="female">Female</label>
                    </div>
                    <div class="radio-item">
                        <input type="radio" id="other" name="gender" value="other">
                        <label for="other">Other</label>
                    </div>
                </div>
                <div class="error" id="genderError">Please select a gender</div>
            </div>

            <!-- Checkboxes -->
            <div class="form-group">
                <label>Interests *</label>
                <div class="checkbox-group">
                    <div class="checkbox-item">
                        <input type="checkbox" id="sports" name="interests" value="sports">
                        <label for="sports">Sports</label>
                    </div>
                    <div class="checkbox-item">
                        <input type="checkbox" id="music" name="interests" value="music">
                        <label for="music">Music</label>
                    </div>
                    <div class="checkbox-item">
                        <input type="checkbox" id="reading" name="interests" value="reading">
                        <label for="reading">Reading</label>
                    </div>
                    <div class="checkbox-item">
                        <input type="checkbox" id="travel" name="interests" value="travel">
                        <label for="travel">Travel</label>
                    </div>
                </div>
                <div class="error" id="interestsError">Please select at least one interest</div>
            </div>

            <!-- Textarea -->
            <div class="form-group">
                <label for="message">Message *</label>
                <textarea id="message" name="message" placeholder="Enter your message (min 10 characters)"></textarea>
                <div class="error" id="messageError">Message must be at least 10 characters</div>
            </div>

            <!-- File Upload -->
            <div class="form-group">
                <label for="fileUpload">Upload File (Image or PDF)</label>
                <div class="file-upload">
                    <input type="file" id="fileUpload" name="fileUpload" accept=".jpg,.jpeg,.png,.pdf">
                    <label for="fileUpload" class="file-label">
                        <span>📁 Click to upload or drag and drop</span>
                        <span class="file-name" id="fileName">No file chosen</span>
                    </label>
                </div>
                <div class="error" id="fileError">Please upload a valid file (JPG, PNG, or PDF)</div>
            </div>

            <!-- Terms and Conditions -->
            <div class="form-group">
                <div class="checkbox-item">
                    <input type="checkbox" id="terms" name="terms">
                    <label for="terms">I agree to the terms and conditions *</label>
                </div>
                <div class="error" id="termsError">You must accept the terms and conditions</div>
            </div>

            <!-- Buttons -->
            <div class="button-group">
                <button type="submit" class="btn-submit">Submit Form</button>
                <button type="reset" class="btn-reset">Reset Form</button>
            </div>
        </form>
    </div>

    <script>
        const form = document.getElementById('sampleForm');
        const successMessage = document.getElementById('successMessage');
        const fileUploadInput = document.getElementById('fileUpload');
        const fileNameDisplay = document.getElementById('fileName');
        const satisfactionInput = document.getElementById('satisfaction');
        const rangeValue = document.querySelector('.range-value');

        // Update range value display
        satisfactionInput.addEventListener('input', function() {
            rangeValue.textContent = this.value + '%';
        });

        // File upload display
        fileUploadInput.addEventListener('change', function() {
            if (this.files.length > 0) {
                fileNameDisplay.textContent = this.files[0].name;
            }
        });

        // ============ VALIDATION FUNCTIONS ============

        /**
         * Validate Full Name
         * Requirements: Minimum 3 characters, only letters and spaces
         */
        function validateFullName(value) {
            const regex = /^[a-zA-Z\s]{3,}$/;
            return regex.test(value.trim());
        }

        /**
         * Validate Email
         * Requirements: Valid email format
         */
        function validateEmail(value) {
            const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return regex.test(value.trim());
        }

        /**
         * Validate Password
         * Requirements: Min 8 chars, 1 uppercase, 1 lowercase, 1 number
         */
        function validatePassword(value) {
            const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;
            return regex.test(value);
        }

        /**
         * Validate Password Match
         * Requirements: Passwords must match
         */
        function validatePasswordMatch(password, confirmPassword) {
            return password === confirmPassword && password.length > 0;
        }

        /**
         * Validate Phone Number
         * Requirements: 10-15 digits
         */
        function validatePhoneNumber(value) {
            const regex = /^[\d\s\-\+\(\)]{10,15}$/;
            return regex.test(value.trim());
        }

        /**
         * Validate URL
         * Requirements: Valid URL format
         */
        function validateURL(value) {
            try {
                new URL(value);
                return true;
            } catch {
                return false;
            }
        }

        /**
         * Validate Age
         * Requirements: Between 18 and 120
         */
        function validateAge(value) {
            const age = parseInt(value);
            return age >= 18 && age <= 120;
        }

        /**
         * Validate Date of Birth
         * Requirements: Valid date and not in future
         */
        function validateBirthDate(value) {
            if (!value) return false;
            const selectedDate = new Date(value);
            const today = new Date();
            return selectedDate <= today && selectedDate.getFullYear() >= 1900;
        }

        /**
         * Validate Meeting Time
         * Requirements: Not empty
         */
        function validateMeetingTime(value) {
            return value.trim().length > 0;
        }

        /**
         * Validate Dropdown Selection
         * Requirements: Not empty
         */
        function validateDropdown(value) {
            return value.trim().length > 0;
        }

        /**
         * Validate Radio Button Selection
         * Requirements: At least one selected
         */
        function validateRadioGroup(name) {
            return document.querySelector(`input[name="${name}"]:checked`) !== null;
        }

        /**
         * Validate Checkbox Group
         * Requirements: At least one checked
         */
        function validateCheckboxGroup(name) {
            return document.querySelectorAll(`input[name="${name}"]:checked`).length > 0;
        }

        /**
         * Validate Single Checkbox
         * Requirements: Must be checked
         */
        function validateCheckbox(elementId) {
            return document.getElementById(elementId).checked;
        }

        /**
         * Validate Textarea
         * Requirements: Minimum 10 characters
         */
        function validateTextarea(value) {
            return value.trim().length >= 10;
        }

        /**
         * Validate File Upload
         * Requirements: Valid file types (jpg, jpeg, png, pdf)
         */
        function validateFileUpload(files) {
            if (files.length === 0) return true; // Optional field
            const allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];
            const file = files[0];
            return allowedTypes.includes(file.type) && file.size <= 5 * 1024 * 1024; // 5MB max
        }

        // ============ DISPLAY ERROR FUNCTION ============

        /**
         * Show or hide error message
         */
        function showError(elementId, show = true) {
            const errorElement = document.getElementById(elementId);
            const inputElement = errorElement.previousElementSibling;

            if (show) {
                errorElement.classList.add('show');
                inputElement.classList.add('invalid');
                inputElement.classList.remove('valid');
            } else {
                errorElement.classList.remove('show');
                inputElement.classList.remove('invalid');
                inputElement.classList.add('valid');
            }
        }

        // ============ FORM SUBMISSION ============

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            // Clear previous success message
            successMessage.classList.remove('show');

            // Validate all fields
            let isValid = true;

            // Full Name
            if (!validateFullName(document.getElementById('fullName').value)) {
                showError('fullNameError', true);
                isValid = false;
            } else {
                showError('fullNameError', false);
            }

            // Email
            if (!validateEmail(document.getElementById('email').value)) {
                showError('emailError', true);
                isValid = false;
            } else {
                showError('emailError', false);
            }

            // Password
            if (!validatePassword(document.getElementById('password').value)) {
                showError('passwordError', true);
                isValid = false;
            } else {
                showError('passwordError', false);
            }

            // Confirm Password
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            if (!validatePasswordMatch(password, confirmPassword)) {
                showError('confirmPasswordError', true);
                isValid = false;
            } else {
                showError('confirmPasswordError', false);
            }

            // Phone (Optional)
            const phoneValue = document.getElementById('phone').value;
            if (phoneValue && !validatePhoneNumber(phoneValue)) {
                showError('phoneError', true);
                isValid = false;
            } else {
                showError('phoneError', false);
            }

            // Website (Optional)
            const websiteValue = document.getElementById('website').value;
            if (websiteValue && !validateURL(websiteValue)) {
                showError('websiteError', true);
                isValid = false;
            } else {
                showError('websiteError', false);
            }

            // Age (Optional)
            const ageValue = document.getElementById('age').value;
            if (ageValue && !validateAge(ageValue)) {
                showError('ageError', true);
                isValid = false;
            } else {
                showError('ageError', false);
            }

            // Birth Date (Optional)
            const birthDateValue = document.getElementById('birthDate').value;
            if (birthDateValue && !validateBirthDate(birthDateValue)) {
                showError('birthDateError', true);
                isValid = false;
            } else {
                showError('birthDateError', false);
            }

            // Meeting Time (Optional)
            const meetingTimeValue = document.getElementById('meetingTime').value;
            if (meetingTimeValue && !validateMeetingTime(meetingTimeValue)) {
                showError('meetingTimeError', true);
                isValid = false;
            } else {
                showError('meetingTimeError', false);
            }

            // Country
            if (!validateDropdown(document.getElementById('country').value)) {
                showError('countryError', true);
                isValid = false;
            } else {
                showError('countryError', false);
            }

            // Gender
            if (!validateRadioGroup('gender')) {
                showError('genderError', true);
                isValid = false;
            } else {
                showError('genderError', false);
            }

            // Interests
            if (!validateCheckboxGroup('interests')) {
                showError('interestsError', true);
                isValid = false;
            } else {
                showError('interestsError', false);
            }

            // Message
            if (!validateTextarea(document.getElementById('message').value)) {
                showError('messageError', true);
                isValid = false;
            } else {
                showError('messageError', false);
            }

            // File Upload (Optional)
            if (!validateFileUpload(document.getElementById('fileUpload').files)) {
                showError('fileError', true);
                isValid = false;
            } else {
                showError('fileError', false);
            }

            // Terms
            if (!validateCheckbox('terms')) {
                showError('termsError', true);
                isValid = false;
            } else {
                showError('termsError', false);
            }

            // If valid, show success message
            if (isValid) {
                successMessage.classList.add('show');
                console.log('Form is valid! Ready to submit.');
                // Uncomment below to actually submit the form
                // form.submit();
            } else {
                console.log('Form has validation errors.');
            }
        });

        // Real-time validation on blur
        document.getElementById('fullName').addEventListener('blur', function() {
            if (this.value) {
                if (validateFullName(this.value)) {
                    showError('fullNameError', false);
                } else {
                    showError('fullNameError', true);
                }
            }
        });

        document.getElementById('email').addEventListener('blur', function() {
            if (this.value) {
                if (validateEmail(this.value)) {
                    showError('emailError', false);
                } else {
                    showError('emailError', true);
                }
            }
        });

        document.getElementById('password').addEventListener('blur', function() {
            if (this.value) {
                if (validatePassword(this.value)) {
                    showError('passwordError', false);
                } else {
                    showError('passwordError', true);
                }
            }
        });
    </script>
</body>
</html>
<?php require APPROOT . '/views/inc/footer.php'; ?>
