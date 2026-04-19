<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/inc/clientsidebar/sidebar.php'; ?>
<link accesskey="" rel="stylesheet" href="<?php echo URLROOT; ?>/css/components/client/createEvent.css">

<div class="main-container">
    
    <!-- Main Content -->
    <main class="main-content">
        <!-- Page Header -->
        <header class="page-header">
            <div class="page-header-content">
                <div class="header">Create New Event</div>
                <div class="section-subtitle">Plan your perfect event in just a few simple steps</div>
            </div>
        </header>
        
        <!-- Create Event Container -->
        <div class="create-event-container">
            <!-- Form Area -->
            <div class="form-area">
                <!-- Progress Bar -->
                <div class="progress-bar">
                    <div class="progress-line" id="progress-line"></div>
                    
                    <div class="step active" id="step1">
                        <div class="step-number">1</div>
                        <div class="step-label">Event Details</div>
                        <div class="step-sublabel">Basic information</div>
                    </div>
                    
                    <div class="step" id="step2">
                        <div class="step-number">2</div>
                        <div class="step-label">Find Services</div>
                        <div class="step-sublabel">Select packages</div>
                    </div>
                    
                    <div class="step" id="step3">
                        <div class="step-number">3</div>
                        <div class="step-label">Review & Pay</div>
                        <div class="step-sublabel">Confirm & payment</div>
                    </div>
                </div>
                
                <!-- Form Steps -->
                <div class="form-container">
                    <!-- Step 1: Event Details -->
                    <div class="step-content active" id="content1">
                        <!-- Event Basics -->
                        <div class="section">
                            <h2 class="section-title">Event Basics</h2>
                            <p class="section-subtitle">Tell us about your event</p>
                            <div class="form-group">
                                <label for="eventName" class="form-label required">Event Name</label>
                                <input type="text" id="eventName" class="form-input" placeholder="e.g., Sarah & John's Wedding">
                                <span id="eventName-span"></span>
                            </div>
                            <div class="form-group">
                                <label for="eventType" class="form-label required">Event Type</label>
                                <select id="eventType" class="form-select">
                                    <option value="" disabled selected>Select an event type</option>
                                    <option value="wedding">Wedding</option>
                                    <option value="birthday">Birthday</option>
                                    <option value="corporate">Corporate Event</option>
                                    <option value="graduation">Graduation</option>
                                    <option value="anniversary">Anniversary</option>
                                    <option value="conference">Conference</option>
                                    <option value="party">Party</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="eventDescription" class="form-label required">Event Description</label>
                                <textarea id="eventDescription" class="form-input form-textarea" placeholder="Describe your event, theme, vision, and any special requirements..."></textarea>
                            </div>
                        </div>

                        <!-- Date & Time -->
                        <div class="section">
                            <h2 class="section-title">Date & Time</h2>
                            <p class="section-subtitle">When is your event?</p>
                            <div class="date-time-container">
                                <div class="date-time-field">
                                    <label for="startDate" class="form-label required">Start Date & Time</label>
                                    <div class="date-time-input">
                                        <input type="datetime-local" id="startDate" class="form-input">
                                        <span class="icon">📅</span>
                                    </div>
                                </div>
                                <div class="date-time-field">
                                    <label for="endDate" class="form-label required">End Date & Time</label>
                                    <div class="date-time-input">
                                        <input type="datetime-local" id="endDate" class="form-input">
                                        <span class="icon">📅</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Guest Information -->
                        <div class="section">
                            <h2 class="section-title">Guest Information</h2>
                            <p class="section-subtitle">How many guests are you expecting?</p>
                            <div class="form-group">
                                <label for="guestCount" class="form-label required">Estimated Number of Guests</label>
                                <input type="number" id="guestCount" class="form-input" placeholder="e.g., 150" min="1">
                            </div>
                        </div>

                        <!-- Location -->
                        <div class="section">
                            <h2 class="section-title">Location</h2>
                            <p class="section-subtitle">Where will your event take place?</p>
                            <div class="form-group">
                                <label class="form-label required">Venue Type</label>
                                <div class="radio-group">
                                    <div class="radio-option">
                                        <input type="radio" id="haveVenue" name="venueType" value="have" checked>
                                        <label for="haveVenue">I have a venue</label>
                                    </div>
                                    <div class="radio-option">
                                        <input type="radio" id="needVenue" name="venueType" value="need">
                                        <label for="needVenue">I need to find one</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" id="venueAddressGroup">
                                <label for="venueAddress" class="form-label required">Venue Address</label>
                                <input type="text" id="venueAddress" class="form-input" placeholder="Enter your venue address">
                            </div>
                        </div>

                        <!-- Services Needed -->
                        <div class="section">
                            <h2 class="section-title">Services Needed</h2>
                            <p class="section-subtitle">Select the services you need for your event</p>
                            <div class="services-grid">
                                <div class="service-item">
                                    <input type="checkbox" id="catering" id-number="1">
                                    <label for="catering">Catering</label>
                                </div>
                                <div class="service-item">
                                    <input type="checkbox" id="photography" id-number="2">
                                    <label for="photography">Photography</label>
                                </div>
                                <div class="service-item">
                                    <input type="checkbox" id="music" id-number="3">
                                    <label for="music">Music</label>
                                </div>
                                <div class="service-item">
                                    <input type="checkbox" id="entertainers" id-number="4">
                                    <label for="entertainers">Entertainers</label>
                                </div>
                                <div class="service-item">
                                    <input type="checkbox" id="decorations" id-number="5">
                                    <label for="decorations">Decorations</label>
                                </div>
                                <div class="service-item">
                                    <input type="checkbox" id="venueService" id-number="6">
                                    <label for="venueService">Venue</label>
                                </div>
                                <div class="service-item">
                                    <input type="checkbox" id="transportation" id-number="7">
                                    <label for="transportation">Transportation</label>
                                </div>
                                <div class="service-item">
                                    <input type="checkbox" id="florist" id-number="8">
                                    <label for="florist">Florist</label>
                                </div>
                                <div class="service-item">
                                    <input type="checkbox" id="cakeDesigning" id-number="9">
                                    <label for="cakeDesigning">Cake Designing</label>
                                </div>
                                <div class="service-item">
                                    <input type="checkbox" id="eventEquipments" id-number="10">
                                    <label for="eventEquipments">Event Equipments</label>
                                </div>
                        
                            </div>
                        </div>
                    </div>

                    <!-- Go to Next Step Button -->
                    <div class="form-navigation">
                        <button class="btn btn-submit" id="nextBtn">Next: Find Services</button>
                    </div>
                </div>
            </div>
            
           
        </div>
    </main>
</div>
<script>
    const URLROOT = "<?php echo URLROOT; ?>";
</script>
<script src="<?php echo URLROOT; ?>/js/event/createEvent.js"></script>
<?php require_once APPROOT . '/views/inc/footer.php'; ?>