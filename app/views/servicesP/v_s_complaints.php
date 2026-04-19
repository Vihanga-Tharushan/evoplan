<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/inc/components/sidebar/sidebar1.php'; ?>
<!-- <?php //require_once APPROOT . '/views/inc/components/taskbar/taskbar.php'; ?> -->
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/components/servicesP/s_complaints.css">

<div class="complaint-container">
    

    <!-- Tab Navigation -->
    <div class="tabs-container">
        <div class="tabs">
            
            <button class="tab" data-tab="create-complaint">
                <i class="fa fa-plus"></i>
                Create Complaint
            </button>
            <button class="tab" data-tab="my-complaints">
                <i class="fa fa-list"></i>
                My Submitted Complaints
            </button>
        </div>
    </div>

    <!-- Create Complaint Section -->
    <div class="complaint-section" id="create-complaint">
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
                        <select class="form-input" name="event_id">
                            <option value="" class="fade">Select Event</option>
                            <?php foreach($data['previousEvents'] as $event): ?>
                                <option value="<?php echo $event->event_id; ?>" data-event-name="<?php echo htmlspecialchars($event->event_name); ?>"><?php echo htmlspecialchars($event->event_name); ?></option>
                            <?php endforeach; ?>
                            <?php foreach($data['upcomingEvents'] as $event): ?>
                                <option value="<?php echo $event->event_id; ?>" data-event-name="<?php echo htmlspecialchars($event->event_name); ?>"><?php echo htmlspecialchars($event->event_name); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <br><span class="error" id="event-name-error"></span>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Complainant Type</label>
                        <select class="form-input" name="complainant_type">
                            <option value="" class="fade">Select Type</option>
                            <option value="CLIENT">Client</option>
                            <option value="IC">Issue Coordinator</option>
                            <option value="SYSTEM">System</option>
                            <option value="OTHER">Other</option>
                        </select>
                        <br><span class="error" id="complainant-type-error"></span>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Complaint Type</label>
                        <select class="form-input" name="complaint_type">
                            <option value="" class="fade">Select Complaint Type</option>
                            <option value="NO_SHOW">No Show</option>
                            <option value="LATE_CANCELLATION">Late Cancellation</option>
                            <option value="QUALITY_ISSUE">Quality Issue</option>
                            <option value="PAYMENT_DISPUTE">Payment Dispute</option>
                            <option value="MISCONDUCT">Misconduct</option>
                            <option value="OTHER">Other</option>
                        </select>
                        <br><span class="error" id="complaint-type-error"></span>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Complaint Description</label>
                        <textarea id="complaint-desc-input" class="form-textarea" name="description" placeholder="Please provide detailed information about your complaint..."></textarea>
                        <div style="display:flex;justify-content:space-between;align-items:center;margin-top:6px;">
                            <span><br><span class="error" id="description-error"></span></span>
                            <small id="complaint-wordcount" style="color:var(--muted);font-size:0.9rem;">0 / 500 words</small>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button class="btn btn-primary" type="submit">Submit Complaint</button>
                        <button class="btn btn-outline" type="cancel">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- My Complaints Section -->
    <div class="complaint-section" id="my-complaints">
        <div class="section-header">
            <span>My Submitted Complaints</span>
        </div>

        <!-- My Complaints Table -->
        <div class="table-container">
            <table class="complaints-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Event</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="my-complaints-list">
                    <!-- Complaints will be loaded dynamically via AJAX -->
                    <tr class="loading-row">
                        <td colspan="7" style="text-align: center; padding: 20px;">
                            <i class="fas fa-spinner fa-spin"></i> Loading complaints...
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>

<div class="complaint-popup">
    <div class="popup-overlay"></div>
    <div class="popup-content">
        <div class="popup-header">
            <h3 class="popup-title">Complaint Details</h3>
            <button class="popup-close-btn">&times;</button>
        </div>
        
        <div class="popup-body">
            <div class="complaint-detail-grid">
                <div class="detail-section">
                    <h4>Complaint Information</h4>
                    <div class="detail-row">
                        <span class="detail-label">Complaint ID:</span>
                        <span class="detail-value" id="complaint-id">#CP-001</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Type:</span>
                        <span class="detail-value complaint-type-badge" id="complaint-type">Client Complaint</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Status:</span>
                        <span class="detail-value status-badge" id="complaint-status">Open</span>
                    </div>
    
                    <div class="detail-row">
                        <span class="detail-label">Date Submitted:</span>
                        <span class="detail-value" id="complaint-date">Jan 10, 2026</span>
                    </div>
                    <div class="detail-row" id="complainant-row">
                        <span class="detail-label">Complainant:</span>
                        <span class="detail-value" id="complaint-complainant">John Doe</span>
                    </div>
                    <div class="detail-row" id="event-row">
                        <span class="detail-label">Related Event:</span>
                        <span class="detail-value" id="complaint-event">Wedding Reception - John Doe</span>
                    </div>
                </div>
                
                <div class="detail-section">
                    <h4>Description</h4>
                    <div class="complaint-description" id="complaint-description">
                        The technician arrived 2 hours later than scheduled without any prior notification. This caused significant inconvenience and disrupted the entire event timeline.
                    </div>
                </div>
                
                <div class="detail-section" id="resolution-section" style="display: none;">
                    <h4>Resolution</h4>
                    <div class="detail-row">
                        <span class="detail-label">Resolution Type:</span>
                        <span class="detail-value" id="resolution-type">Refund Issued</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Resolution Note:</span>
                        <span class="detail-value" id="resolution-note">Partial refund of 50% issued to client</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Resolved At:</span>
                        <span class="detail-value" id="resolved-at">Jan 15, 2026</span>
                    </div>
                </div>
                
                <div class="detail-section" id="assignment-section" style="display: none;">
                    <h4>Assignment</h4>
                    <div class="detail-row">
                        <span class="detail-label">Assigned IC:</span>
                        <span class="detail-value" id="assigned-ic">Issue Coordinator Name</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="popup-actions">
            <!-- Dynamic buttons based on complaint type and status -->
            <div class="action-buttons" id="action-buttons">
                <!-- Buttons will be dynamically added here -->
            </div>
            <button class="btn btn-outline" id="popup-close-bottom">Close</button>
        </div>
    </div>
</div>


<script>



// Tab switching functionality with smooth transitions
function showSection(section){
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
                
                // Load complaints if switching to "My Complaints" tab
                if (tabId === 'my-complaints') {
                    displayComplaints();
                }
            }, 300);

        } else if (!currentActiveSection) {

            // No active section, just show the new one
            document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
            showSection(newSection);
            
            // Load complaints if "My Complaints" tab is active
            if (tabId === 'my-complaints') {
                displayComplaints();
            }
        }
    });
});

// Complaint Popup Functionality
const complaintPopup = document.querySelector('.complaint-popup');
const popupCloseBtn = document.querySelector('.popup-close-btn');
const popupCloseBottom = document.getElementById('popup-close-bottom');


// Open complaint popup and populate data
function openComplaintPopup(complaintInput){
    if (!complaintInput) return;

    // If input is a string ID, look it up in dummy data
    let complaint = complaintInput;
    if (typeof complaintInput === 'string') {
        complaint = dummyComplaints[complaintInput];
        if (!complaint) {
            console.error('Complaint not found:', complaintInput);
            return;
        }
    }

    // Populate popup with complaint data
    document.getElementById('complaint-id').textContent = '#' + complaint.complaint_id;
    document.getElementById('complaint-type').textContent = complaint.complaint_type;
    document.getElementById('complaint-type').className = 'detail-value complaint-type-badge ' + complaint.complainant_type.toLowerCase();
    
    // Format status with proper class name (in_progress becomes in-progress)
    const statusClass = complaint.status.toLowerCase().replace(/_/g, '-');
    document.getElementById('complaint-status').textContent = complaint.status.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
    document.getElementById('complaint-status').className = 'detail-value status-badge status-' + statusClass;
    
    // // Format priority with proper class name
    // const priorityClass = complaint.priority.toLowerCase().replace(/_/g, '-');
    // document.getElementById('complaint-priority').textContent = complaint.priority.charAt(0).toUpperCase() + complaint.priority.slice(1).toLowerCase();
    // document.getElementById('complaint-priority').className = 'detail-value priority-badge priority-' + priorityClass;
    
    document.getElementById('complaint-date').textContent = complaint.created_at;
    document.getElementById('complaint-description').textContent = complaint.description_text;
    document.getElementById('complaint-complainant').textContent = complaint.complainant_type.charAt(0).toUpperCase() + complaint.complainant_type.slice(1).toLowerCase();
    document.getElementById('complaint-event').textContent = complaint.event_name;
    

    // Handle conditional fields
    const complainantRow = document.getElementById('complainant-row');
    const eventRow = document.getElementById('event-row');
    const resolutionSection = document.getElementById('resolution-section');
    const assignmentSection = document.getElementById('assignment-section');

    if (complaint.type === 'provider') {
        complainantRow.style.display = 'none';
        eventRow.style.display = 'none';
    } else {
        complainantRow.style.display = 'flex';
        eventRow.style.display = 'flex';
    }

    if (complaint.resolution) {
        resolutionSection.style.display = 'block';
        document.getElementById('resolution-type').textContent = complaint.resolution.typeLabel;
        document.getElementById('resolution-note').textContent = complaint.resolution.note;
        document.getElementById('resolved-at').textContent = complaint.resolution.resolvedAt;
    } else {
        resolutionSection.style.display = 'none';
    }

    if (complaint.assignedIC) {
        assignmentSection.style.display = 'block';
        document.getElementById('assigned-ic').textContent = complaint.assignedIC;
    } else {
        assignmentSection.style.display = 'none';
    }

    // Generate action buttons based on complaint type and status
    generateActionButtons(complaint);

    // Show popup
    complaintPopup.classList.add('show');
    document.body.style.overflow = 'hidden';
}

// Generate action buttons based on complaint context
function generateActionButtons(complaint) {
    const actionButtons = document.getElementById('action-buttons');
    actionButtons.innerHTML = '';

    if (complaint.type === 'provider') {
        // My complaints - view only actions
        if (complaint.status === 'open' || complaint.status === 'in_progress') {
            actionButtons.innerHTML = `
                <button class="btn btn-primary" onclick="updateComplaint('${complaint.id}', 'request_update')">
                    Request Update
                </button>
            `;
        }
    } else {
        // Complaints for me - provider actions
        if (complaint.status === 'open') {
            actionButtons.innerHTML = `
                <button class="btn btn-primary" onclick="respondToComplaint('${complaint.id}')">
                    Respond
                </button>
            `;
        } else if (complaint.status === 'in_progress') {
            actionButtons.innerHTML = `
                <button class="btn btn-success" onclick="resolveComplaint('${complaint.id}')">
                    Mark Resolved
                </button>
            `;
        }
    }
}

// Action functions (placeholders - implement actual functionality)
function respondToComplaint(complaintId) {
    alert('Respond to complaint: ' + complaintId);
    // Implement response functionality
}

function resolveComplaint(complaintId) {
    if (confirm('Mark this complaint as resolved?')) {
        alert('Complaint resolved: ' + complaintId);
        // Implement resolution functionality
    }
}

function updateComplaint(complaintId, action) {
    alert('Requesting update for complaint: ' + complaintId);
    // Implement update request functionality
}

// Close popup functions
function closeComplaintPopup(){
    complaintPopup.classList.remove('show');
    document.body.style.overflow = 'auto';
}

// Event listeners for closing popup
popupCloseBtn.addEventListener('click', closeComplaintPopup);
popupCloseBottom.addEventListener('click', closeComplaintPopup);
complaintPopup.addEventListener('click', function(e) {
    if (e.target === complaintPopup) {
        closeComplaintPopup();
    }
});

// Add click listeners to "View Details" buttons (only in complaint lists, not form buttons)
document.querySelectorAll('.complaints-table .table-view-btn').forEach(button => {
    button.addEventListener('click', function(e) {
        e.preventDefault();
        const row = this.closest('tr');
        const complaintIndex = Array.from(row.parentElement.children).indexOf(row) + 1;
        const complaintId = 'complaint-' + complaintIndex;
        openComplaintPopup(complaintId);
    });
});

// Close popup on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && complaintPopup.classList.contains('show')) {
        closeComplaintPopup();
    }
});


//complaint form submission handler
// Word limit enforcement: 500 words for complaint description
(function(){
    const textarea = document.getElementById('complaint-desc-input');
    const counter = document.getElementById('complaint-wordcount');
    const MAX_WORDS = 500;

    if (textarea && counter) {
        const updateCount = () => {
            const text = textarea.value.trim();
            const words = text.length ? text.split(/\s+/).filter(Boolean) : [];
            if (words.length > MAX_WORDS) {
                // Trim to first MAX_WORDS words
                textarea.value = words.slice(0, MAX_WORDS).join(' ');
            }
            const current = textarea.value.trim().length ? textarea.value.trim().split(/\s+/).filter(Boolean).length : 0;
            counter.textContent = current + ' / ' + MAX_WORDS + ' words';
        };

        textarea.addEventListener('input', updateCount);
        // Initialize counter on load
        updateCount();
    }
})();

document.querySelector('.complaint-form').addEventListener('submit', function(e) {

    e.preventDefault();
    
    // Gather form data
    const formData = new FormData(this);
    // Enforce 500-word limit server-side check (in case input event didn't trim)
    const desc = formData.get('description') ? String(formData.get('description')).trim() : '';
    const descWords = desc.length ? desc.split(/\s+/).filter(Boolean) : [];
    if (descWords.length > 500) {
        document.getElementById('description-error').textContent = 'Description exceeds 500-word limit. It has been trimmed in the input.';
        // Trim the textarea value to first 500 words to keep consistent
        const trimmed = descWords.slice(0,500).join(' ');
        const ta = document.getElementById('complaint-desc-input');
        if (ta) ta.value = trimmed;
        return;
    }
    
    //handle form validation here
    let hasError = false;
    document.querySelectorAll('.complaint-form .error').forEach(span => span.textContent = '');
    if (!formData.get('event_id')) {
        document.getElementById('event-name-error').textContent = 'Please select an event';
        hasError = true;
    }
    if (!formData.get('complainant_type')) {
        document.getElementById('complainant-type-error').textContent = 'Please select complainant type';
        hasError = true;
    }
    if (!formData.get('complaint_type')) {
        document.getElementById('complaint-type-error').textContent = 'Please select complaint type';
        hasError = true;
    }
    if (!formData.get('description')) {
        document.getElementById('description-error').textContent = 'Please enter complaint description';
        hasError = true;
    }
    if (hasError) return;
    //do the submission via AJAX
    submitComplaint(formData);

    //reget the complaints list
    displayComplaints();

});

function submitComplaint(formData) {
    // Remap form field names to match backend expectations
    const mappedData = new FormData();
    
    // Get the selected event name from the data attribute
    const eventSelect = document.querySelector('select[name="event_id"]');
    const selectedOption = eventSelect.options[eventSelect.selectedIndex];
    const eventName = selectedOption ? selectedOption.getAttribute('data-event-name') : '';
    
    // Append form data to mappedData
    mappedData.append('event_id', formData.get('event_id'));
    mappedData.append('event_name', eventName);
    mappedData.append('complainant_type', formData.get('complainant_type'));
    mappedData.append('complaint_type', formData.get('complaint_type'));
    mappedData.append('description_text', formData.get('description'));

    var xml = new XMLHttpRequest();

    xml.onload = function(){
        if(this.status === 200){
            try { 
                var response = JSON.parse(this.responseText);
                if(response.success){
                    alert('Complaint submitted successfully');
                    document.querySelector('.complaint-form').reset();
                    clearFormErrors();
                    displayComplaints();
                } else {
                    alert('Failed to submit complaint: ' + (response.error || 'Unknown error'));
                }
            } catch(e) {
                console.error('Error parsing response:', e);
                alert('Error processing response from server');
            }
        } else {
            alert('Server error: ' + this.status);
        }
    };

    xml.onerror = function(){
        alert('Network error: Failed to submit complaint');
    };

    xml.open("POST", "<?php echo URLROOT; ?>/Service/submitComplaint", true);
    xml.send(mappedData);
}

//cancel button handler
document.querySelector('.complaint-form .btn-outline').addEventListener('click', function(e) {
    e.preventDefault();
    //clear form fields
    document.querySelector('.complaint-form').reset();
    //clear error messages
    clearFormErrors();
});

function clearFormErrors() {
    document.querySelectorAll('.complaint-form .error').forEach(span => span.textContent = '');
}


function getAllComplaints() {
   let complaints = [];
   let xml = new XMLHttpRequest();

   xml.onload = function(){
        if(this.status === 200){
            try {
                let response = JSON.parse(this.responseText);
                if(response.complaints){
                    complaints = response.complaints;
                } else {
                    console.error('No complaints data in response');
                }
            } catch(e) {
                console.error('Error parsing response:', e);
            }
        } else {
            console.error('Server error:', this.status);
        }
   };

    xml.onerror = function(){
        console.error('Network error: Failed to fetch complaints');
    };

    xml.open("GET", "<?php echo URLROOT; ?>/Service/getmyComplaints", false);
    xml.send();
    
    return complaints;
}

function displayComplaints() {
    const complaintsList = document.getElementById('my-complaints-list');
    var complaints = getAllComplaints();
    console.log('Fetched complaints:', complaints);
    // Clear existing table
    complaintsList.innerHTML = '';

    if (complaints && complaints.length > 0) {
        let complaintsHTML = '';
        complaints.forEach(function(complaint, index) {
            const statusText = complaint.status ? complaint.status.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase()) : 'Unknown';
            const priorityText = complaint.priority ? complaint.priority.charAt(0).toUpperCase() + complaint.priority.slice(1).toLowerCase() : 'Unknown';
            const dateText = complaint.created_at ? new Date(complaint.created_at).toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'short',
                day: 'numeric'
            }) : 'Unknown Date';
            
            const statusClass = complaint.status ? complaint.status.toLowerCase().replace(/ /g, '-') : '';
            const priorityClass = complaint.priority ? 'priority-' + complaint.priority.toLowerCase() : '';

            complaintsHTML += `
                <tr>
                    <td><span class="id-badge">#${complaint.complaint_id || 'N/A'}</span></td>
                    <td><span class="table-type">${complaint.complaint_type || 'Unknown'}</span></td>
                    <td><span class="status-badge ${statusClass}">${statusText}</span></td>
                    <td class="table-event">${complaint.event_name || 'N/A'}</td>
                    <td class="table-created">${dateText}</td>
                    <td><button class="table-view-btn" onclick="viewMyComplaintDetails('${complaint.complaint_id}')"><i class="fas fa-eye"></i> View</button></td>
                </tr>
            `;
        });
        complaintsList.innerHTML = complaintsHTML;
    } else {
        complaintsList.innerHTML = `
            <tr class="empty-row">
                <td colspan="7" style="text-align: center; padding: 40px; color: #6b7280;">
                    <i class="fas fa-inbox" style="font-size: 2rem; margin-bottom: 10px; display: block;"></i>
                    You have not submitted any complaints yet.
                </td>
            </tr>
        `;
    }
}


    
// Function to view details of my complaint
function viewMyComplaintDetails(complaintId) {
    let xml = new XMLHttpRequest();
    
    xml.onload = function(){
        if(this.status === 200){
            try {
                let response = JSON.parse(this.responseText);
                if(response.success && response.complaint){
                    // Transform database complaint to popup format
                    let complaint = response.complaint;
                    
                    openComplaintPopup(complaint);
                } else {
                    alert('Error: ' + (response.error || 'Could not load complaint details'));
                }
            } catch(e) {
                console.error('Error parsing response:', e);
                alert('Error processing response from server');
            }
        } else {
            alert('Server error: ' + this.status);
        }
    };
    
    xml.onerror = function(){
        alert('Network error: Failed to fetch complaint details');
    };

    xml.open("GET", "<?php echo URLROOT; ?>/Service/getComplaintDetails?complaintId=" + encodeURIComponent(complaintId), true);
    xml.send();
}

// Initialize page - load create-complaint section by default
document.addEventListener('DOMContentLoaded', function() {
    const createComplaintSection = document.getElementById('create-complaint');
    const firstTab = document.querySelector('.tab[data-tab="create-complaint"]');
    
    if (createComplaintSection && firstTab) {
        firstTab.classList.add('active');
        showSection(createComplaintSection);
    }
});

</script>
<?php require_once APPROOT . '/views/inc/footer.php'; ?>