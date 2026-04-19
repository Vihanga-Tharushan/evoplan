<?php require APPROOT . '/views/inc/header.php'; ?>
<?php $backUrl = URLROOT . '/Service/events';
require_once APPROOT . '/views/inc/components/taskbar/navbar.php'; ?>

<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/components/servicesP/events/s_oneupcoming.css">
<div class="event-container">
    <!-- Event Owner & Basic Info -->
    <div class="section-card">

        <div class="owner-header">

                <div class="owner-avatar"><?php echo htmlspecialchars($data['client']->profile_pic ?? substr($data['client']->name ?? '', 0, 1)); ?></div>
                <div class="owner-details">
                    <div class="owner-name"><?php echo htmlspecialchars($data['client']->name ?? ''); ?></div>
                    <h1 class="event-title"><?php echo htmlspecialchars($data['event']->event_name ?? ''); ?></h1>
                    <?php if(!empty($data['event'])): ?>
                    <div class="event-type"><?php echo htmlspecialchars($data['event']->event_type ?? ''); ?></div>
                    <?php endif; ?>
                </div>
        </div>
        
        <div class="meta-container">
            
            <div class="meta-item">
                <span class="meta-label">Guest Count</span>
                <span class="meta-value"><?php echo htmlspecialchars($data['event']->guest_count ?? ''); ?></span>
            </div>
        </div>
    </div>
    
    <!-- Event Timeline -->
    <div class="section-card">
        <h2 class="section-title">Event Timeline</h2>
        <div class="timeline-container">
            <div class="timeline-item">
                <div>
                    <div class="timeline-label">Start Time</div>
                    <div class="timeline-time"><?php echo htmlspecialchars($data['event']->start_datetime ?? ''); ?></div>
                    <div class="timeline-description">Event start</div>
                </div>
            </div>
            
            <div class="timeline-item">
                <div>
                    <div class="timeline-label">End Time</div>
                    <div class="timeline-time"><?php echo htmlspecialchars($data['event']->end_datetime ?? ''); ?></div>
                    <div class="timeline-description">Event end</div>
                </div>
            </div>
    
        </div>
    </div>
    
    <!-- Venue & Location -->
    <div class="section-card">
        <h2 class="section-title">Venue & Location</h2>
        <div class="venue-details">
            <p class="venue-address">
                <?php echo nl2br(htmlspecialchars($data['event']->venue_address ?? '')); ?>
            </p>
        </div>
    </div>


    <!-- Event Description -->
    <div class="section-card">
        <h2 class="section-title">Event Description</h2>
        <p class="event-description-text">
            <?php echo isset($data['event']->event_description) ? nl2br(htmlspecialchars($data['event']->event_description)) : 'No description provided.'; ?>
        </p>
    </div>
    
    
    
    <!-- Packages -->
    <div class="section-card">
        <h2 class="section-title">Selected Package</h2>
        <div class="packages-section">
            <?php
            // Normalize selected packages to array
           
            $selectedPackage = $data['selectedPackage'];
            $packagesList = is_array($selectedPackage) ? $selectedPackage : [$selectedPackage];
            $hasConfirmedPackage = false;

            if (!empty($packagesList)) :
                foreach ($packagesList as $pkg):
                    // determine property names
                    $pname = $pkg->package_name ?? $pkg->title ?? 'Package';
                    $pprice = $pkg->package_price ?? $pkg->price ?? null;
                    $provider = $pkg->service_provider_name ?? ($pkg->service_name ?? 'Provider');
                    $status = $pkg->confirmation_status ?? $pkg->sent_status ?? null;
                    
                    // Check if this service provider's package has a confirmed/accepted status
                    if($pkg->service_id == $_SESSION['service_id'] && ($status === 'CONFIRMED' || $status === 'ACCEPTED')) {
                        $hasConfirmedPackage = true;
                    }
            ?>

            <?php if($pkg->service_id == $_SESSION['service_id']): ?>
                <div class="package-card">
                    <div class="package-header" style="align-items:center; gap:1rem;">
                        <div>
                            <h3 class="package-name"><?php echo htmlspecialchars($pname); ?></h3>

                            <div  class="package-provider">By: <?php echo htmlspecialchars($provider); ?></div>

                        </div>
                        <div class="package-header-right">

                            <div class="package-price"><?php echo $pprice !== null ? 'LKR ' . number_format($pprice, 2) : '—'; ?></div>
                            <div class="view-package" data-package-id="<?php echo htmlspecialchars($pkg->package_id ?? ''); ?>" >View Package</div>
                            
                        </div>
                    </div>


                    <?php if(!empty($pkg->description)): ?>
                    <p><?php echo htmlspecialchars($pkg->description); ?></p>
                    <?php endif; ?>
                    <?php if(!empty($status)): ?>
                    <div style="margin-top:8px;">
                        <span class="status-badge <?php echo $status === 'CONFIRMED' ? 'status-confirmed' : 'status-pending'; ?>"><?php echo htmlspecialchars($status); ?></span>
                    </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <?php
                endforeach;
            else: ?>
                
            <?php endif; ?>
        </div>
    </div>
  
    <?php if(!$hasConfirmedPackage): ?>
    <div class="section-card confirm-section">
        <div class="confirm-actions">
            <button type="button" class="send-confirmation" id="sendConfirmation" data-event-id="<?php echo $data['event']->event_id ?? ''; ?>">Send Confirmation</button>

            <button type="button" class="reject-confirmation" id="rejectConfirmation" data-event-id="<?php echo $data['event']->event_id ?? ''; ?>">Reject</button>
        </div>
    </div>
    <?php endif; ?>


    <div class="popup-package hidden" id="packagePopup">
        <div class="popup-content">
            <button type="button" class="close-popup" aria-label="Close popup">&times;</button>
            <div class="package-details-content">
                <!-- Package details will be loaded here dynamically -->
            </div>
        </div>
    </div>

    <div class="popup-send-confirmation hidden" id="confirmationpopup">
        <div class="popup-content">
            <button type="button" class="close-popup" aria-label="Close popup">&times;</button>
            <div class="confirmation-content">
                <div class="title-popup">Confirmation</div>
                <div class="default-msg">
                    We are pleased to confirm our participation in your event. Looking forward to making it a memorable occasion!
                </div>

                <div class="custom-msg">
                    <label for="customMessage">Add a custom message (optional):</label>
                    <textarea id="customMessage" rows="4" placeholder="Write your message here..."></textarea>
                </div>

                <button type="button" class="send-confirmation-btn">Send Confirmation</button>
            </div>
        </div>
    </div>

    <div class="popup-reject-confirmation hidden" id="rejectPopup" >
        <div class="popup-content">
            <button type="button" class="close-popup" aria-label="Close popup">&times;</button>
            <div class="reject-content">
                <div class="title-popup">Rejection</div>
                <div class="reson-message-tittle">
                    reason for rejecting the event:
                </div>
                <textarea id="rejectReason" rows="4" placeholder="Write your reason here..."></textarea>
                <button type="button" class="reject-confirmation-btn">Reject Event</button> 
            </div>
        </div>

    </div>


    
  
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
      
        const viewPackageButtons = document.querySelectorAll('.view-package');
        const packagePopup = document.querySelector('.popup-package');
        const packagePopupContent = packagePopup.querySelector('.package-details-content');
        const packageCloseBtn = packagePopup.querySelector('.close-popup');
        const confirmationPopup = document.getElementById('confirmationpopup');
        const confirmationCloseBtn = confirmationPopup.querySelector('.close-popup');
        const sendConfirmBtn = document.querySelector('.send-confirmation-btn');
        const mainSendConfirmBtn = document.getElementById('sendConfirmation');
        const mainRejectBtn = document.getElementById('rejectConfirmation');
        const rejectConfirmBtn = document.querySelector('.reject-confirmation-btn');
        const rejectPopup = document.getElementById('rejectPopup');
        const rejectCloseBtn = rejectPopup.querySelector('.close-popup');

        function closePackagePopup() {
            packagePopup.classList.add('hidden');
            document.body.style.overflow = '';
        }

        function closeConfirmationPopup() {
            confirmationPopup.classList.add('hidden');
            document.body.style.overflow = '';
        }

        function openConfirmationPopup(eventId) {
            confirmationPopup.classList.remove('hidden');
            confirmationPopup.setAttribute('data-event-id', eventId);
            document.body.style.overflow = 'hidden';
        }

        function closeRejectPopup() {
            rejectPopup.classList.add('hidden');
            document.body.style.overflow = '';
        }

        function openRejectPopup(eventId) {
            rejectPopup.classList.remove('hidden');
            rejectPopup.setAttribute('data-event-id', eventId);
            document.body.style.overflow = 'hidden';
        }

        mainSendConfirmBtn.addEventListener('click', function() {
            const eventId = this.getAttribute('data-event-id');
            openConfirmationPopup(eventId);
        });

        mainRejectBtn.addEventListener('click', function() {
            const eventId = this.getAttribute('data-event-id');
            openRejectPopup(eventId);
        });

        sendConfirmBtn.addEventListener('click', function() {
            const eventId = confirmationPopup.getAttribute('data-event-id');
            const customMessage = document.getElementById('customMessage').value || '';
            
            sendConfirmation(eventId, customMessage)
                .then(data => {
                    if(data.success) {
                        alert('Confirmation sent successfully.');
                        closeConfirmationPopup();
                    } else {
                        alert('Error: ' + (data.error || 'Failed to send confirmation'));
                    }
                })
                .catch(err => {
                    console.error('Error:', err);
                    alert('An error occurred. Please try again.');
                });
        });

        rejectConfirmBtn.addEventListener('click', function() {
            const eventId = rejectPopup.getAttribute('data-event-id');
            const reason = document.getElementById('rejectReason').value || '';

            rejectConfirmation(eventId, reason)
                .then(data => {
                    if(data.success) {
                        alert('Event rejected.');
                        closeRejectPopup();
                    } else {
                        alert('Error: ' + (data.error || 'Failed to reject'));
                    }
                })
                .catch(err => {
                    console.error('Error:', err);
                    alert('An error occurred. Please try again.');
                });

        });

        viewPackageButtons.forEach(button => {
            button.addEventListener('click', function() {
                const packageId = this.getAttribute('data-package-id');

                getPackagesForEvent(<?php echo $data['event']->event_id ?? 'null'; ?>)
                    .then(packages => {
                        if (!Array.isArray(packages)) {
                            packagePopupContent.innerHTML = '<p>No packages available.</p>';
                            packagePopup.classList.remove('hidden');
                            document.body.style.overflow = 'hidden';
                            return;
                        }
                        const selectedPackage = packages.find(pkg => String(pkg.package_id) === String(packageId));
                        if (selectedPackage) {
                            packagePopupContent.innerHTML = `
                                <div class="title-popup">${escapeHtml(selectedPackage.package_name || 'Package')}</div>
                                <div class="price-popup"><strong>Price:</strong> ${selectedPackage.package_price != null ? 'LKR ' + Number(selectedPackage.package_price).toFixed(2) : '—'}</div>
                                <div class="details-popup"><strong>Details:</strong> ${escapeHtml(selectedPackage.package_details)}</div>
                                <div class="details-popup"><strong>Notes:</strong> ${escapeHtml(selectedPackage.package_notes )}</div>
                            `;
                            packagePopup.classList.remove('hidden');
                            document.body.style.overflow = 'hidden';
                        } else {
                            packagePopupContent.innerHTML = '<p>Package details not found.</p>';
                            packagePopup.classList.remove('hidden');
                            document.body.style.overflow = 'hidden';
                        }
                    })
                    .catch(err => {
                        console.error('Error fetching packages:', err);
                        packagePopupContent.innerHTML = '<p>Error loading package details. Please try again.</p>';
                        packagePopup.classList.remove('hidden');
                        document.body.style.overflow = 'hidden';
                    });
            });
        });

        packageCloseBtn.addEventListener('click', closePackagePopup);
        confirmationCloseBtn.addEventListener('click', closeConfirmationPopup);

        // Close popups when clicking on overlay backgrounds
        packagePopup.addEventListener('click', function(event) {
            if (event.target === packagePopup) closePackagePopup();
        });

        confirmationPopup.addEventListener('click', function(event) {
            if (event.target === confirmationPopup) closeConfirmationPopup();
        });

        rejectCloseBtn.addEventListener('click', closeRejectPopup);
        rejectPopup.addEventListener('click', function(event) {
            if (event.target === rejectPopup) closeRejectPopup();
        });

        // HTML escape helper
        function escapeHtml(str) {
            if (typeof str !== 'string') return str;
            return str.replace(/[&<>"']/g, function(m) {
                return {'&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;'}[m];
            });
        }
    });

    function getPackagesForEvent(eventId) {
        return fetch("<?php echo URLROOT; ?>/Service/getPackagesForEvent/", {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ eventId: eventId })
        })
        .then(res => {
            if (!res.ok) throw new Error('Network response was not ok');
            return res.json();
        });
    }

    function sendConfirmation(eventId, message) {
        return fetch("<?php echo URLROOT; ?>/Service/sendConfirmation/", {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ eventId: eventId, message: message })
        })
        .then(res => {
            if (!res.ok) throw new Error('Network response was not ok');
            return res.json();
        });
    }

    function rejectConfirmation(eventId, reason) {
        return fetch("<?php echo URLROOT; ?>/Service/rejectConfirmation/", {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ eventId: eventId, reason: reason })
        })
        .then(res => {
            if (!res.ok) throw new Error('Network response was not ok');
            return res.json();
        });
    }
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>