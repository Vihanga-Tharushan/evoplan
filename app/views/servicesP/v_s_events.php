<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/inc/components/sidebar/sidebar1.php'; ?>
<!-- <?php //require_once APPROOT . '/views/inc/components/taskbar/taskbar.php'; ?> -->
<link href="<?php echo URLROOT; ?>/css/components/servicesP/s_events.css" rel="stylesheet">

<div class="main-container">

    <!-- Main Content -->
    <main class="main-content">
        
        
        <!-- Events Container -->
        <div class="events-container">
            <!-- Tabs -->
            <div class="events-tabs">
                <button class="tab-btn active" data-tab="upcoming">
                    <i class="fas fa-calendar-alt"></i> Upcoming Events
                </button>
                <button class="tab-btn" data-tab="previous">
                    <i class="fas fa-history"></i> Previous Events
                </button>
            </div>
            
            <!-- Upcoming Events Tab -->
                
            <div id="upcoming-tab" class="tab-content active" >
                <div class="events-grid">
                    
                   
                   
                    <!-- Event Card 2 -->

                  <?php foreach($data['events'] as $event) : ?>
                   <div class="event-card upcoming" event-id="<?php echo $event->event_id; ?>">
                        <div class="event-card-header">
                            <span class="event-type <?php echo strtolower(str_replace(' ', '-', $event->event_type)); ?>">
                                <?php
                                    // Determine icon based on event type
                                    $iconClass = 'fas fa-calendar';
                                    switch (strtolower($event->event_type)) {
                                        case 'wedding':
                                            $iconClass = 'fas fa-ring';
                                            break;
                                        case 'birthday':
                                            $iconClass = 'fas fa-birthday-cake';
                                            break;
                                        case 'business conference':
                                            $iconClass = 'fas fa-briefcase';
                                            break;
                                        // more cases as needed
                                    }
                                ?>
                                <i class="<?php echo  $iconClass; ?>"></i> <?php echo htmlspecialchars($event->event_type); ?>
                            </span>
                            <span class="event-status status-upcoming">Upcoming</span>
                        </div>  
                        <div class="event-card-body">
                            <h3 class="event-name"><?php echo htmlspecialchars($event->event_name); ?></h3>
                            <div class="event-details">
                                <div class="event-detail">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span><strong>Location:</strong> <?php echo htmlspecialchars($event->venue_address); ?></span>
                                </div>  
                                <div class="event-detail">
                                    <i class="fas fa-calendar-day"></i>
                                    <span><strong>Date:</strong> <?php echo date('F j, Y', strtotime($event->start_datetime)); ?></span>
                                </div>  
                                <div class="event-detail">
                                    <i class="fas fa-clock"></i>
                                    <span><strong>Time:</strong> <?php echo date('g:i A', strtotime($event->start_datetime)); ?> - <?php echo date('g:i A', strtotime($event->end_datetime)); ?></span>
                                </div>  
                                <div class="event-detail">
                                    <i class="fas fa-user-friends"></i>
                                    <span><strong>Guests:</strong> <?php echo htmlspecialchars($event->guest_count); ?> attendees</span>
                                </div>  
                            </div>
                        </div>
                        <div class="event-card-footer">
                            <div class="event-actions">
                                <button class="action-btn view-event-btn">
                                    <i class="fas fa-eye"></i> View
                                </button>
                                
                            </div>
                            <div class="days-left">
                                <?php
                                    $now = new DateTime();
                                    $startDate = new DateTime($event->start_datetime);
                                    $interval = $now->diff($startDate);
                                    if ($now < $startDate) {
                                        echo '<span style="font-weight: 600; color: var(--success);">In ' . $interval->days . ' days</span>';
                                    } else {
                                        echo '<span style="font-weight: 600; color: var(--danger);">Started ' . $interval->days . ' days ago</span>';
                                    }
                                ?>
                            </div>
                        </div> 
                    </div>
                   <?php endforeach; ?>
<!--                   
                    <div class="event-card upcoming" event-id="101">
                        <div class="event-card-header">
                            <span class="event-type business">
                                <i class="fas fa-briefcase"></i> Business Conference
                            </span>
                            <span class="event-status status-upcoming">Upcoming</span>
                        </div>
                        <div class="event-card-body">
                            <h3 class="event-name">Tech Innovators Summit 2024</h3>
                            <div class="event-details">
                                <div class="event-detail">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span ><strong>Location:</strong> Convention Center, Downtown</span>
                                </div>
                                <div class="event-detail">
                                    <i class="fas fa-calendar-day"></i>
                                    <span><strong>Date:</strong> May 22, 2024</span>
                                </div>
                                <div class="event-detail">
                                    <i class="fas fa-clock"></i>
                                    <span><strong>Time:</strong> 9:00 AM - 6:00 PM</span>
                                </div>
                                <div class="event-detail">
                                    <i class="fas fa-user-friends"></i>
                                    <span><strong>Guests:</strong> 500 attendees</span>
                                </div>
                            </div>
                        </div>
                        <div class="event-card-footer">
                            <div class="event-actions">
                                <button class="action-btn view-event-btn">
                                    <i class="fas fa-eye"></i> View
                                </button>
                                <button class="action-btn confirm-btn">
                                    <i class="fas fa-check-circle"></i> Send Confirmation
                                </button>
                                
                            </div>
                            <div class="days-left">
                                <span style="font-weight: 600; color: var(--success);">In 22 days</span>
                            </div>
                        </div>
                    </div> -->
                    
                    <!-- Event Card 3 -->
                    <!-- <div class="event-card upcoming" event-id="102">
                        <div class="event-card-header">
                            <span class="event-type birthday">
                                <i class="fas fa-birthday-cake"></i> Birthday Party
                            </span>
                            <span class="event-status status-upcoming">Upcoming</span>
                        </div>
                        <div class="event-card-body">
                            <h3 class="event-name">Sophia's 30th Birthday Celebration</h3>
                            <div class="event-details">
                                <div class="event-detail">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span><strong>Location:</strong> Skyline Rooftop Lounge</span>
                                </div>
                                <div class="event-detail">
                                    <i class="fas fa-calendar-day"></i>
                                    <span><strong>Date:</strong> April 30, 2024</span>
                                </div>
                                <div class="event-detail">
                                    <i class="fas fa-clock"></i>
                                    <span><strong>Time:</strong> 7:00 PM - 12:00 AM</span>
                                </div>
                                <div class="event-detail">
                                    <i class="fas fa-user-friends"></i>
                                    <span><strong>Guests:</strong> 80 attendees</span>
                                </div>
                            </div>
                        </div>
                        <div class="event-card-footer">
                            <div class="event-actions">
                                <button class="action-btn view-event-btn">
                                    <i class="fas fa-eye"></i> View
                                </button>
                                <button class="action-btn confirm-btn">
                                    <i class="fas fa-check-circle"></i> Send Confirmation
                                </button>
                               
                            </div>
                            <div class="days-left">
                                <span style="font-weight: 600; color: var(--warning);">In 8 days</span>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
            
            
            <!-- Previous Events Tab -->
            <div id="previous-tab" class="tab-content">
                <div class="events-grid">
                    


                <?php foreach($data['previousEvents'] as $event): ?>
                    <div class="event-card previous" event-id="<?php echo $event->event_id; ?>">
                        <div class="event-card-header">
                            <span class="event-type <?php echo strtolower(str_replace(' ', '-', $event->event_type)); ?>">
                                <?php
                                    // Determine icon based on event type
                                    $iconClass = 'fas fa-calendar';
                                    switch (strtolower($event->event_type)) {
                                        case 'wedding':
                                            $iconClass = 'fas fa-ring';
                                            break;
                                        case 'birthday':
                                            $iconClass = 'fas fa-birthday-cake';
                                            break;
                                        case 'business conference':
                                            $iconClass = 'fas fa-briefcase';
                                            break;
                                        // Add more cases as needed
                                    }
                                ?>
                                <i class="<?php echo  $iconClass; ?>"></i> <?php echo htmlspecialchars($event->event_type); ?>
                            </span>
                            <span class="event-status status-completed">Completed</span>
                        </div>
                        <div class="event-card-body">
                            <h3 class="event-name"><?php echo htmlspecialchars($event->event_name); ?></h3>
                            <div class="event-details"> 
                                <div class="event-detail">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span><strong>Location:</strong> <?php echo htmlspecialchars($event->venue_address); ?></span>
                                </div>
                                <div class="event-detail">
                                    <i class="fas fa-calendar-day"></i>
                                    <span><strong>Date:</strong> <?php echo date('F j, Y', strtotime($event->start_datetime)); ?></span>
                                </div>
                                <div class="event-detail">
                                    <i class="fas fa-clock"></i>
                                    <span><strong>Time:</strong> <?php echo date('g:i A', strtotime($event->start_datetime)); ?> - <?php echo date('g:i A', strtotime($event->end_datetime)); ?></span>
                                </div>
                                <div class="event-detail">
                                    <i class="fas fa-user-friends"></i>
                                    <span><strong>Guests:</strong> <?php echo htmlspecialchars($event->guest_count); ?> attendees</span>
                                </div>
                            </div>
                        </div>
                        <div class="event-card-footer">
                            <div class="event-actions">
                                <button class="action-btn view-event-btn">
                                    <i class="fas fa-eye"></i> View Event
                                </button>
                                <button class="action-btn get-pics-btn">
                                    <i class="fas fa-image"></i> Get Pictures
                                </button>
                            </div>
                            <div class="event-date">
                                <span style="color: var(--muted); font-size: 0.9rem;">Completed on <?php echo date('M j, Y', strtotime($event->end_datetime)); ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                    
                    
                    <!-- Event Card 2 (Previous) -->
                    <!-- <div class="event-card previous" event-id="201">
                        <div class="event-card-header">
                            <span class="event-type wedding">
                                <i class="fas fa-ring"></i> Wedding Reception
                            </span>
                        </div>
                        <div class="event-card-body">
                            <h3 class="event-name">Michael & Sarah's Wedding Reception</h3>
                            <div class="event-details">
                                <div class="event-detail">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span><strong>Location:</strong> Oceanview Banquet Hall</span>
                                </div>
                                <div class="event-detail">
                                    <i class="fas fa-calendar-day"></i>
                                    <span><strong>Date:</strong> November 5, 2023</span>
                                </div>
                                <div class="event-detail">
                                    <i class="fas fa-clock"></i>
                                    <span><strong>Time:</strong> 5:00 PM - 1:00 AM</span>
                                </div>
                                <div class="event-detail">
                                    <i class="fas fa-user-friends"></i>
                                    <span><strong>Guests:</strong> 300 attendees</span>
                                </div>
                            </div>
                        </div>
                        <div class="event-card-footer">
                            <div class="event-actions">
                                <button class="action-btn view-event-btn">
                                    <i class="fas fa-eye"></i> View Event
                                </button>
                                <button class="action-btn get-pics-btn">
                                    <i class="fas fa-image"></i> Get Pictures
                                </button>
                                
                            </div>
                            <div class="event-date">
                                <span style="color: var(--muted); font-size: 0.9rem;">Completed on Nov 5, 2023</span>
                            </div>
                        </div>
                    </div>
                     -->
                    <!-- Event Card 3 (Previous) -->
                    <!-- <div class="event-card previous" event-id="202">
                        <div class="event-card-header">
                            <span class="event-type party">
                                <i class="fas fa-glass-cheers"></i> Anniversary Party
                            </span>
                            <span class="event-status status-completed">Completed</span>
                        </div>
                        <div class="event-card-body">
                            <h3 class="event-name">10th Anniversary Celebration</h3>
                            <div class="event-details">
                                <div class="event-detail">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span><strong>Location:</strong> The Garden Terrace</span>
                                </div>
                                <div class="event-detail">
                                    <i class="fas fa-calendar-day"></i>
                                    <span><strong>Date:</strong> October 18, 2023</span>
                                </div>
                                <div class="event-detail">
                                    <i class="fas fa-clock"></i>
                                    <span><strong>Time:</strong> 6:30 PM - 11:00 PM</span>
                                </div>
                                <div class="event-detail">
                                    <i class="fas fa-user-friends"></i>
                                    <span><strong>Guests:</strong> 60 attendees</span>
                                </div>
                            </div>
                        </div>
                        <div class="event-card-footer">
                            <div class="event-actions">
                                <button class="action-btn view-event-btn">
                                    <i class="fas fa-eye"></i> View Event
                                </button>
                                <button class="action-btn get-pics-btn">
                                    <i class="fas fa-image"></i> Get Pictures
                                </button>
                            </div>
                            <div class="event-date">
                                <span style="color: var(--muted); font-size: 0.9rem;">Completed on Oct 18, 2023</span>
                            </div>
                        </div>
                    </div> -->
                    
                    <!-- Empty State for when there are no previous events -->
                     <div class="empty-state" style="display: none;">
                        <div class="empty-state-icon">
                            <i class="fas fa-calendar-times"></i>
                        </div>
                        <h3>No Previous Events</h3>
                        <p>You haven't completed any events yet. Once you complete an event, it will appear here along with options to rate service providers and repeat the event.</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>



<script>
    const URLROOT = '<?php echo URLROOT; ?>';
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        
        // Tab switching functionality
        const tabBtns = document.querySelectorAll('.tab-btn');
        const tabContents = document.querySelectorAll('.tab-content');
        
        tabBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const tabId = this.getAttribute('data-tab');
                
                // Update active tab button
                tabBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                
                // Hide all tab contents and remove show class from cards
                tabContents.forEach(content => {
                    content.classList.remove('active');
                    const cards = content.querySelectorAll('.event-card');
                    cards.forEach(card => card.classList.remove('show'));
                });
                
                // Show active tab content
                document.getElementById(`${tabId}-tab`).classList.add('active');
                
                // Staggered reveal for the new tab's cards
                const newEventCards = document.querySelectorAll(`#${tabId}-tab .event-card:not(.create-event-card)`);
                newEventCards.forEach((card, i) => {
                    setTimeout(() => card.classList.add('show'), i * 80);
                });
            });
        });
        
        // Initial staggered reveal for active tab
        const initialEventCards = document.querySelectorAll('.tab-content.active .event-card:not(.create-event-card)');
        initialEventCards.forEach((card, i) => {
            setTimeout(() => card.classList.add('show'), i * 80);
        });
        

        // Service provider specific action handlers
        
        

        // View event details
        document.querySelectorAll('.view-event-btn').forEach(btn => {
            btn.addEventListener('click', function(e){
                e.stopPropagation();
                const eventId = this.closest('.event-card').getAttribute('event-id');
                if(!eventId) return alert('Missing event ID');
                window.location.href = `${URLROOT}/Service/viewupcomingEvent/${eventId}`;
            });
        });

        // Get pictures for previous events
        document.querySelectorAll('.get-pics-btn').forEach(btn => {
            btn.addEventListener('click', function(e){
                e.stopPropagation();
                const eventId = this.closest('.event-card').getAttribute('event-id');
                if(!eventId) return alert('Missing event ID');
                window.location.href = `${URLROOT}/Service/eventPictures/${eventId}`;
            });
        });
        
        // Event card click (excluding buttons)
        const eventCards = document.querySelectorAll('.event-card:not(.create-event-card)');
        eventCards.forEach(card => {
            card.addEventListener('click', function(e) {
                // Only trigger if not clicking on a button inside the card
                if (!e.target.closest('.action-btn') && !e.target.closest('.create-event-card')) {
                    alert('Opening event details page...');
                    //same as view event details
                    const eventId = this.getAttribute('event-id');
                    if(!eventId) return alert('Missing event ID');
                    window.location.href = `${URLROOT}/Service/viewupcomingEvent/${eventId}`;
                }
            });
        });

    });

    
  
    
</script>
       

<?php require_once APPROOT . '/views/inc/footer.php'; ?>