<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/inc/components/sidebar/sidebar1.php'; ?>
<!-- <?php //require_once APPROOT . '/views/inc/components/taskbar/taskbar.php'; ?> -->
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/components/servicesP/s_complaints.css">

    <div class="complaint-container">
        

        <!-- Tab Navigation -->
        <div class="tabs">
            <div class="tab active" data-tab="complaints-for-me">
                Complaints for Me 
                <span class="tab-badge">3</span>
            </div>
            <div class="tab" data-tab="my-complaints">
                My Complaints
            </div>
        </div>

        <!-- Complaints For Me Section -->
        <div class="complaint-section active" id="complaints-for-me">


            <!-- Stats Cards -->
        <div class="stats-cards">
            <div class="stat-card total">
                <div class="stat-title">Number of Complaints</div>
                <div class="stat-value">15</div>
               
            </div>
            
            <div class="stat-card user">
                <div class="stat-title">User Complaints</div>
                <div class="stat-value">10</div>
                
            </div>
            
            <div class="stat-card admin">
                <div class="stat-title">Admin Complaints</div>
                <div class="stat-value">5</div>
                
            </div>
        </div>

            <div class="section-header">
                <span>Received Complaints</span>
            </div>
            
            <ul class="complaint-list">
                <!-- Client Complaint -->
                <li class="complaint-item">
                    <div class="complaint-content">
                        <div class="complaint-title">
                            Service Delay Issue
                            <span class="complaint-type client">Client</span>
                        </div>
                        <div class="complaint-text">
                            The technician arrived 2 hours later than scheduled without any prior notification.
                        </div>
                        <div class="complaint-date">Jan 10, 2026 • John Doe</div>
                    </div>
                    <button class="btn btn-outline">View Details</button>
                </li>
                
                <!-- Admin Complaint -->
                <li class="complaint-item">
                    <div class="complaint-content">
                        <div class="complaint-title">
                            Policy Violation Report
                            <span class="complaint-type admin">Admin</span>
                        </div>
                        <div class="complaint-text">
                            Multiple reports of unprofessional conduct during client interactions.
                        </div>
                        <div class="complaint-date">Jan 12, 2026</div>
                    </div>
                    <button class="btn btn-outline">View Details</button>
                </li>
                
                <!-- Another Client Complaint -->
                <li class="complaint-item">
                    <div class="complaint-content">
                        <div class="complaint-title">
                            Poor Work Quality
                            <span class="complaint-type client">Client</span>
                        </div>
                        <div class="complaint-text">
                            The installation was incomplete and several components were damaged.
                        </div>
                        <div class="complaint-date">Jan 14, 2026 • Sarah Johnson</div>
                    </div>
                    <button class="btn btn-outline">View Details</button>
                </li>
            </ul>
        </div>

        <!-- My Complaints Section -->
        <div class="complaint-section" id="my-complaints">
            
            <div class="complaint-form-container">
                <!-- Left image / illustration -->
                <div class="form-image">
                    <div class="image-placeholder">
                        <img src="<?php echo URLROOT; ?>/public/img/ServiceP/complaints/complaints.jpg" alt="Complaints illustration">
                        
                    </div>
                </div>

                <!-- Right: form panel -->
                <div class="complaint-form-panel">
                    <div class="section-header">
                        <span>Submit New Complaint</span>
                    </div>

                    <form class="complaint-form">
                        <div class="form-group">
                            <label class="form-label">Related Event</label>
                            <select class="form-input" name="event_id" required>
                                <option value="" class="fade">Select Event</option>
                                <option value="1">Wedding Reception - John Doe</option>
                                <option value="2">Birthday Party - Sarah Johnson</option>
                                <option value="3">Corporate Event - Tech Corp</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Complainant Type</label>
                            <select class="form-input" name="complainant_type" required>
                                <option value="" class="fade">Select Type</option>
                                <option value="CLIENT">Client</option>
                                <option value="IC">Issue Coordinator</option>
                                <option value="SYSTEM">System</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Complaint Type</label>
                            <select class="form-input" name="complaint_type" required>
                                <option value="" class="fade">Select Complaint Type</option>
                                <option value="NO_SHOW">No Show</option>
                                <option value="LATE_CANCELLATION">Late Cancellation</option>
                                <option value="QUALITY_ISSUE">Quality Issue</option>
                                <option value="PAYMENT_DISPUTE">Payment Dispute</option>
                                <option value="MISCONDUCT">Misconduct</option>
                                <option value="OTHER">Other</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Complaint Description</label>
                            <textarea class="form-textarea" name="description" placeholder="Please provide detailed information about your complaint..." required></textarea>
                        </div>

                        <div class="form-actions">
                            <button class="btn btn-primary" type="submit">Submit Complaint</button>
                            <button class="btn btn-outline" type="button">Cancel</button>
                        </div>
                    </form>

                    
                </div>
                
            </div>

            <div class="section-header-list" style="margin-top: 24px;">
                        <span>My Submitted Complaints</span>
                    </div>

                    <ul class="complaint-list">
                        <li class="complaint-item">
                            <div class="complaint-content">
                                <div class="complaint-title">Equipment Malfunction</div>
                                <div class="complaint-text">The diagnostic tool provided is consistently giving false readings.</div>
                                <div class="complaint-date">Jan 5, 2026 • Status: Under Review</div>
                            </div>
                            <button class="btn btn-outline">View Details</button>
                        </li>
                    </ul>
        </div>
    </div>

    <script>
        // Tab switching functionality with smooth transitions
        function showSection(section) {
            section.style.display = 'block';
            // Force reflow to ensure display change takes effect
            section.offsetHeight;
            section.classList.add('active');
        }

        function hideSection(section) {
            section.classList.remove('active');
            setTimeout(() => {
                section.style.display = 'none';
            }, 300); // Match transition duration
        }

        document.querySelectorAll('.tab').forEach(tab => {
            tab.addEventListener('click', () => {
                const currentActiveSection = document.querySelector('.complaint-section.active');
                const tabId = tab.getAttribute('data-tab');
                const newSection = document.getElementById(tabId);
                
                if (currentActiveSection && currentActiveSection !== newSection) {
                    // Hide current section with transition
                    hideSection(currentActiveSection);
                    
                    // After current section fades out, show new section
                    setTimeout(() => {
                        // Update tab states
                        document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
                        tab.classList.add('active');
                        
                        // Show new section
                        showSection(newSection);
                    }, 300);
                } else if (!currentActiveSection) {
                    // No active section, just show the new one
                    document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
                    tab.classList.add('active');
                    showSection(newSection);
                }
            });
        });
    </script>
</body>
</html>
<?php require_once APPROOT . '/views/inc/footer.php'; ?>