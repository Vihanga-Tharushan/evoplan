<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/inc/clientsidebar/sidebar.php'; ?>
<link href="<?php echo URLROOT; ?>/css/components/client/myevents.css" rel="stylesheet">

<div class="main-container">

    <!-- Main Content -->
    <main class="main-content">
        <!-- Page Header -->
        <!-- <header class="page-header">
            <div class="page-header-content">
                <div class="page-title">My Events</div>
                <div class="page-subtitle">Manage your upcoming events and view your event history</div>
            </div>
        </header> -->
        
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
                    <!-- Create New Event Card -->
                    
                    <div class="create-event-card" id="createEventBtn">
                        <div class="create-event-icon">
                            <i class="fas fa-plus">+</i>
                        </div>
                        <h3>Create New Event</h3>
                        <p>Start planning your next event by adding details, selecting service providers, and managing everything in one place.</p>
                        <div class="action-btn primary" id="action-btn primary">
                            <div class="fas fa-plus-circle"></div> Create Event
                        </div>
                    </div>
                   
                    <!-- Event Card 1 -->
                <?php foreach($data['upcomingEvents'] as $event): ?>
                    <div class="event-card upcoming" event-id="<?php echo $event->event_id ?>">
                        <div class="event-card-header">
                            <span class="event-type <?php echo strtolower($event->event_type); ?>">
                                <i class="fas fa-ring"></i><?php echo $event->event_type; ?>
                            </span>
                            <span class="event-status status-upcoming">Upcoming</span>
                        </div>
                        <div class="event-card-body">
                            <h3 class="event-name"><?php echo $event->event_name; ?></h3>
                            <div class="event-details">
                                <div class="event-detail">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span><strong>Location:</strong> <?php echo $event->venue_address; ?></span>
                                </div>
                                <div class="event-detail">
                                    <i class="fas fa-calendar-day"></i>
                                    <span><strong>Date:</strong> <?php echo date('F j, Y', strtotime($event->start_datetime)); ?></span>
                                </div>
                                <div class="event-detail">
                                    <i class="fas fa-clock"></i>
                                    <span><strong>Time:</strong> <?php echo date('g:i A', strtotime($event->start_datetime)) . ' - ' . date('g:i A', strtotime($event->end_datetime)); ?></span>
                                </div>
                                <div class="event-detail">
                                    <i class="fas fa-user-friends"></i>
                                    <span><strong>Guests:</strong> <?php echo $event->guest_count; ?></span>
                                </div>
                            </div>
                            <div class="precentagebar">
                                <?php
                                    $pct = 0;
                                    if (isset($event->progress_precent)) {
                                        $pct = (int)$event->progress_precent;
                                    }
                                    $pct = max(0, min(100, $pct));

                                    if ($pct >= 70) {
                                        $fillColor = 'var(--success)';
                                    } elseif ($pct >= 50) {
                                        $fillColor = 'var(--warning)';
                                    } else {
                                        $fillColor = 'var(--danger)';
                                    }
                                ?>
                                <div class="progress" role="progressbar" aria-valuenow="<?php echo $pct; ?>" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-fill" style="width: <?php echo $pct; ?>%; background-color: <?php echo $fillColor; ?>;"></div>
                                </div>
                                <div class="progress-label"><?php echo $pct; ?>%</div>
                            </div>
                        </div>
                        <div class="event-card-footer">
                            <div class="event-actions">
                                <button class="action-btn">
                                    <i class="fas fa-eye"></i> View
                                </button>
                                <button class="action-btn">
                                    <i class="fas fa-delete"></i> Delete
                                </button>
                               
                            </div>
                            <div class="days-left">
                                <?php
                                    $diff = strtotime($event->start_datetime) - time();
                                    $days = (int) ceil($diff / (60 * 60 * 24));

                                    if ($diff < 0) {
                                        $label = 'Passed';
                                    } elseif ($days === 0) {
                                        $label = 'Today';
                                    } elseif ($days === 1) {
                                        $label = 'Tomorrow';
                                    } else {
                                        $label = 'In ' . $days . ' days';
                                    }
                                ?>
                                <span style="font-weight: 600; color: var(--success);"><?php echo $label; ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>  
                    <!-- Event Card 2 -->
                    <div class="event-card upcoming">
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
                                    <span><strong>Location:</strong> Convention Center, Downtown</span>
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
                                <button class="action-btn">
                                    <i class="fas fa-eye"></i> View
                                </button>
                                <button class="action-btn">
                                    <i class="fas fa-delete"></i> Delete
                                </button>
                                
                            </div>
                            <div class="days-left">
                                <span style="font-weight: 600; color: var(--success);">In 22 days</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Event Card 3 -->
                    <div class="event-card upcoming">
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
                                <button class="action-btn">
                                    <i class="fas fa-eye"></i> View
                                </button>
                                <button class="action-btn">
                                    <i class="fas fa-delete"></i> Delete
                                </button>
                               
                            </div>
                            <div class="days-left">
                                <span style="font-weight: 600; color: var(--warning);">In 8 days</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            
            <!-- Previous Events Tab -->
            <div id="previous-tab" class="tab-content">
                <div class="events-grid">
                    <!-- Event Card 1 (Previous) -->
                    <?php foreach($data['previousEvents'] as $event): ?>
                    <div class="event-card previous" event-id="<?php echo $event->event_id ?>">
                        <div class="event-card-header">
                            <span class="event-type conference">
                                <i class="fas fa-users"></i> <?php echo $event->event_type; ?>
                            </span>
                            <span class="event-status status-completed"><?php echo ($event->is_completed)=== "YES" ? "Completed" : "Not Completed"; ?></span>
                        </div>
                        <div class="event-card-body">
                            <h3 class="event-name"><?php echo $event->event_name; ?></h3>
                            <div class="event-details">
                                <div class="event-detail">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span><strong>Location:</strong> <?php echo $event->venue_address; ?></span>
                                </div>
                                <div class="event-detail">
                                    <i class="fas fa-calendar-day"></i>
                                    <span><strong>Date:</strong> <?php echo date('F j, Y', strtotime($event->start_datetime)); ?></span>
                                </div>
                                <div class="event-detail">
                                    <i class="fas fa-clock"></i>
                                    <span><strong>Time:</strong> <?php echo date('g:i A', strtotime($event->start_datetime)) . ' - ' . date('g:i A', strtotime($event->end_datetime)); ?></span>
                                </div>
                                <div class="event-detail">
                                    <i class="fas fa-user-friends"></i>
                                    <span><strong>Guests:</strong> <?php echo $event->guest_count; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="event-card-footer">
                            <div class="event-actions">
                                <button class="action-btn">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                                <button class="action-btn">
                                    <i class="fas fa-star"></i> Rate Providers
                                </button>
                            </div>
                        
                            <div class="event-date">
                                <span>Completed on <?php echo date('M j, Y', strtotime($event->end_datetime)); ?></span>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    
                    <!-- Event Card 2 (Previous) -->
                    <div class="event-card previous">
                        <div class="event-card-header">
                            <span class="event-type wedding">
                                <i class="fas fa-ring"></i> Wedding Reception
                            </span>
                            <span class="event-status status-completed"><?php echo ($event->is_completed)=== "YES" ? "Completed" : "Not Completed"; ?></span>
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
                                <button class="action-btn">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                                <button class="action-btn">
                                    <i class="fas fa-star"></i> Rate Providers
                                </button>
                                
                            </div>
                            <div class="event-date">
                                <span style="color: var(--muted); font-size: 0.9rem;">Completed on Nov 5, 2023</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Event Card 3 (Previous) -->
                    <div class="event-card previous">
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
                                <button class="action-btn">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                                <button class="action-btn">
                                    <i class="fas fa-star"></i> Rate Providers
                                </button>
                                <button class="action-btn">
                                    <i class="fas fa-redo"></i> Repeat Event
                                </button>
                            </div>
                            <div class="event-date">
                                <span style="color: var(--muted); font-size: 0.9rem;">Completed on Oct 18, 2023</span>
                            </div>
                        </div>
                    </div>
                    
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
                
                // Show active tab content
                tabContents.forEach(content => content.classList.remove('active'));
                document.getElementById(`${tabId}-tab`).classList.add('active');
            });
        });
        
        // Create Event Button
        const createEventBtn = document.getElementById('createEventBtn');
        const createEventActionBtn = document.getElementById('action-btn primary');
        if (createEventBtn) {
            createEventBtn.addEventListener('click', function() {
                

               window.location.href = `${URLROOT}/Clients/createEvent`;
            });
        }
        
        if (createEventActionBtn) {
            createEventActionBtn.addEventListener('click', function(e) {
                e.stopPropagation(); // Prevent event card click
                window.location.href = `${URLROOT}/Clients/createEvent`;
            });
        }

        // Action buttons on event cards
        const viewButtons = document.querySelectorAll('.action-btn');
        viewButtons.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                const action = this.textContent.trim();
                const eventId = this.closest('.event-card').getAttribute('event-id');
                const precentage = this.closest('.event-card').querySelector('.progress-label') ? this.closest('.event-card').querySelector('.progress-label').textContent.trim() : null;
                
                if (action.includes('View')) {

                    alert(precentage);
                    if(precentage == "33%"){
                        alert('Event is 33% completed. Redirecting to service selection page...');
                        window.location.href = `${URLROOT}/Clients/findServices/${eventId}`;
                        return;
                    }
                    else if(precentage == "66%"){
                    
                        alert('Event is 66% completed. Redirecting to event overview page...');
                        window.location.href =`${URLROOT}/Clients/previewEvent/${eventId}`;
                        return;
                    }
                    else if(precentage == "100%")
                    {
                        alert('Event is completed. Redirecting to event summary page...');
                        window.location.href = `/events/${eventId}/summary`;
                        return;
                    }
                    
                } else if (action.includes('Delete')) {
                    alert('Opening event editor...');
                    window.location.href = `/events/${eventId}/edit`;

                } else if (action.includes('Rate')) {
                    alert('Redirecting to provider rating page...');
                }
            });
        });
        
        // Event card click (excluding buttons)
        const eventCards = document.querySelectorAll('.event-card:not(.create-event-card)');
        eventCards.forEach(card => {
            card.addEventListener('click', function(e) {
                // Only trigger if not clicking on a button inside the card
                if (!e.target.closest('.action-btn') && !e.target.closest('.create-event-card')) {
                    alert('Opening event details page...');
                    // window.location.href = '/events/event-id';
                }
            });
        });

    });

    
  
    
</script>
       
<?php require APPROOT . '/views/inc/footer.php';?>