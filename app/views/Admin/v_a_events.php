<?php require_once APPROOT . '/views/Admin/Sidebar/v_a_sidebar.php'; ?>
<?php require_once APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="../public/css/components/Admin/style(Admin_Events).css">
<link rel="stylesheet" href="../public/css/components/Admin/Popup.css">
<link rel="stylesheet" href="../public/css/components/table1.css">

<div class="container">
  <!-- Page Header -->
  <div class="events-header">
    <h1>Events Management</h1>
    <p>Manage and track all events</p>
  </div>

  <!-- Event Tabs -->
  <div class="event-tabs">
    <button class="tab-btn active" data-tab="upcoming" onclick="switchTab('upcoming')">
      <i class="fas fa-calendar-check"></i>
      <span>Upcoming Events</span>
    </button>
    <button class="tab-btn" data-tab="previous" onclick="switchTab('previous')">
      <i class="fas fa-history"></i>
      <span>Previous Events</span>
    </button>
  </div>

  <!-- Filters Section -->
  <div class="filters-section">
    <div class="filter-group">
      <label for="progressFilter">Progress</label>
      <select id="progressFilter" class="filter-select">
        <option value="">All Progress</option>
        <option value="33">33% - Basic Info</option>
        <option value="66">66% - Packages Selected</option>
        <option value="100">100% - Payment Complete</option>
      </select>
    </div>
    <div class="filter-group search-group">
      <label for="searchInput">Search</label>
      <input type="text" id="searchInput" class="search-input" placeholder="Search by event or client...">
    </div>
  </div>

  <!-- Upcoming Events Tab -->
  <div id="upcoming" class="tab-content active">
    <div id="upcomingEventsContainer">
      <!-- Grouped by date -->
    </div>
  </div>

  <!-- Previous Events Tab -->
  <div id="previous" class="tab-content">
    <div id="previousEventsContainer">
      <!-- Grouped by date -->
    </div>
  </div>
</div>

<!-- Event Details Modal -->
<div id="eventModal" class="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 id="modalEventName">Event Details</h2>
        <button class="close-btn" onclick="closeEventModal()">&times;</button>
      </div>
      <div class="modal-body">
        <!-- Event Info Section -->
        <div class="modal-section">
          <h3 class="section-title">
            <i class="fas fa-info-circle"></i>
            Event Information
          </h3>
          <div class="info-grid">
            <div class="info-item">
              <label>Event Type</label>
              <p id="modalEventType"></p>
            </div>
            <div class="info-item">
              <label>Event Date</label>
              <p id="modalEventDate"></p>
            </div>
            <div class="info-item">
              <label>Start Time</label>
              <p id="modalStartTime"></p>
            </div>
            <div class="info-item">
              <label>End Time</label>
              <p id="modalEndTime"></p>
            </div>
            <div class="info-item">
              <label>Guest Count</label>
              <p id="modalGuestCount"></p>
            </div>
            <div class="info-item">
              <label>Total Cost</label>
              <p id="modalTotalCost"></p>
            </div>
            <div class="info-item full-width">
              <label>Venue</label>
              <p id="modalVenue"></p>
            </div>
            <div class="info-item full-width">
              <label>Description</label>
              <p id="modalDescription"></p>
            </div>
          </div>
        </div>

        <!-- Client Info Section -->
        <div class="modal-section">
          <h3 class="section-title">
            <i class="fas fa-user"></i>
            Client Information
          </h3>
          <div class="client-info-card">
            <div class="client-details">
              <div class="info-item">
                <label>Name</label>
                <p id="modalClientName"></p>
              </div>
              <div class="info-item">
                <label>Email</label>
                <p id="modalClientEmail"></p>
              </div>
              <div class="info-item">
                <label>Phone</label>
                <p id="modalClientPhone"></p>
              </div>
            </div>
          </div>
        </div>

        <!-- Packages & Service Providers Section -->
        <div class="modal-section">
          <h3 class="section-title">
            <i class="fas fa-box"></i>
            Selected Packages & Service Providers
          </h3>
          <div id="modalPackages" class="packages-list">
            <!-- Dynamically populated -->
          </div>
        </div>

        <!-- Event Timeline Section -->
        <div class="modal-section">
          <h3 class="section-title">
            <i class="fas fa-history"></i>
            Event Timeline
          </h3>
          <div id="modalTimeline" class="timeline">
            <!-- Dynamically populated -->
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" onclick="closeEventModal()">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
// Event Data - Fetched from database
const URLROOT = '<?php echo URLROOT; ?>';

// Initialize mockEvents from PHP data
let mockEvents = <?php echo json_encode($events ?? []) ?>;
let filteredEvents = [...mockEvents];

// Function to get event data from controller and update UI
function getEventData(){
  var xml = new XMLHttpRequest();
  xml.open("GET", URLROOT + "/Admin/getEventsData", true);
  xml.onload = function(){
    if(xml.status === 200){
      console.log("Event data fetched successfully");
      try {
        const data = JSON.parse(xml.responseText);
        if(data && data.length > 0){
          mockEvents = data;
          filteredEvents = [...mockEvents];
          renderEventsByTab();
          updateStats();
          console.log("Events rendered from API", mockEvents);
        }
      } catch(e) {
        console.error("Error parsing event data:", e);
      }
    } else {
      console.error("Failed to fetch event data. Status:", xml.status);
    }
  };
  xml.onerror = function(){
    console.error("Error fetching event data");
  };
  xml.send(null);
}

// State
let currentEvent = null;
let currentTab = 'upcoming';
const CURRENT_DATE = new Date('2026-04-03');

// Initialize
document.addEventListener('DOMContentLoaded', () => {
  renderEventsByTab();
  updateStats();
  setupFilters();
  getEventData();
});

// Update Stats
function updateStats() {
  const total = mockEvents.length;
  const active = mockEvents.filter(e => e.status === 'Active').length;
  const atRisk = mockEvents.filter(e => e.status === 'At Risk').length;
  const completed = mockEvents.filter(e => e.status === 'Completed').length;
  
  const totalEventsEl = document.getElementById('totalEvents');
  const activeEventsEl = document.getElementById('activeEvents');
  const atRiskEventsEl = document.getElementById('atRiskEvents');
  const completedEventsEl = document.getElementById('completedEvents');
  
  if (totalEventsEl) totalEventsEl.textContent = total;
  if (activeEventsEl) activeEventsEl.textContent = active;
  if (atRiskEventsEl) atRiskEventsEl.textContent = atRisk;
  if (completedEventsEl) completedEventsEl.textContent = completed;
}

// Utility Functions
function formatDate(dateString) {
  const date = new Date(dateString);
  return date.toLocaleDateString('en-US', { 
    year: 'numeric', 
    month: 'short', 
    day: 'numeric' 
  });
}

function formatTime(dateString) {
  const date = new Date(dateString);
  return date.toLocaleTimeString('en-US', { 
    hour: '2-digit', 
    minute: '2-digit' 
  });
}

function formatDateTime(dateString) {
  const date = new Date(dateString);
  return date.toLocaleDateString('en-US', { 
    year: 'numeric', 
    month: 'short', 
    day: 'numeric',
    hour: '2-digit',
    minute: '2-digit'
  });
}

function getDateKey(dateString) {
  const date = new Date(dateString);
  return date.toISOString().split('T')[0];
}

function formatDateLabel(dateString) {
  const date = new Date(dateString);
  const today = new Date(CURRENT_DATE);
  const tomorrow = new Date(today);
  tomorrow.setDate(tomorrow.getDate() + 1);
  
  const dateKey = date.toISOString().split('T')[0];
  const todayKey = today.toISOString().split('T')[0];
  const tomorrowKey = tomorrow.toISOString().split('T')[0];
  
  if (dateKey === todayKey) {
    return `Today, ${date.toLocaleDateString('en-US', { month: 'short', day: 'numeric' })}`;
  } else if (dateKey === tomorrowKey) {
    return `Tomorrow, ${date.toLocaleDateString('en-US', { month: 'short', day: 'numeric' })}`;
  } else {
    return date.toLocaleDateString('en-US', { weekday: 'long', month: 'short', day: 'numeric', year: 'numeric' });
  }
}

// Switch Tab
function switchTab(tab) {
  currentTab = tab;
  
  document.querySelectorAll('.event-tabs .tab-btn').forEach(btn => btn.classList.remove('active'));
  document.querySelector(`[data-tab="${tab}"]`).classList.add('active');
  
  document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
  document.getElementById(tab).classList.add('active');
  
  renderEventsByTab();
}

// Render Events By Tab
function renderEventsByTab() {
  const upcomingEvents = [];
  const previousEvents = [];
  
  filteredEvents.forEach(event => {
    const eventDate = new Date(event.start_datetime);
    if (eventDate >= CURRENT_DATE) {
      upcomingEvents.push(event);
    } else {
      previousEvents.push(event);
    }
  });
  
  upcomingEvents.sort((a, b) => new Date(a.start_datetime) - new Date(b.start_datetime));
  previousEvents.sort((a, b) => new Date(b.start_datetime) - new Date(a.start_datetime));
  
  renderEventsSingleTable('upcomingEventsContainer', upcomingEvents);
  renderEventsSingleTable('previousEventsContainer', previousEvents);
}

// Render Events Single Table
function renderEventsSingleTable(containerId, events) {
  const container = document.getElementById(containerId);
  if (!container) return;
  
  if (events.length === 0) {
    container.innerHTML = `
      <div class="empty-state">
        <i class="fas fa-calendar-xmark"></i>
        <p>No events found matching your filters</p>
      </div>
    `;
    return;
  }
  
  const tableHtml = `
    <div class="table-container">
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Event</th>
            <th>Client</th>
            <th>Date & Time</th>
            <th>Progress</th>
            <th>Providers</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          ${events.map(event => renderEventRow(event)).join('')}
        </tbody>
      </table>
    </div>
  `;
  
  container.innerHTML = tableHtml;
}

// Render Event Row
function renderEventRow(event) {
  const progressClass = event.progress_percent === 33 ? 'low' : event.progress_percent === 66 ? 'medium' : 'high';
  
  return `
    <tr>
      <td class="table-id">#${event.event_id}</td>
      <td class="table-event" title="${event.event_name}">${event.event_name}</td>
      <td class="table-client" title="${event.client_name}">${event.client_name}</td>
      <td class="table-date">
        <div class="table-date-main">${formatDate(event.start_datetime)}</div>
        <div class="table-date-sub">${formatTime(event.start_datetime)}</div>
      </td>
      <td>
        <div class="progress-container">
          <div class="progress-bar">
            <div class="progress-fill ${progressClass}" style="width: ${event.progress_percent}%"></div>
          </div>
          <span class="progress-text">${event.progress_percent}% Complete</span>
        </div>
      </td>
      <td>
        <div class="providers-pills">
          ${event.packages.flatMap(pkg => pkg.providers || []).slice(0, 3).map(p => `
            <span class="provider-pill">
              <i class="fas fa-user"></i>
              ${p.name.split(' ')[0]}
            </span>
          `).join('')}
          ${event.packages.flatMap(pkg => pkg.providers || []).length > 3 ? `<span class="provider-pill">+${event.packages.flatMap(pkg => pkg.providers || []).length - 3}</span>` : ''}
        </div>
      </td>
      <td>
        <div class="table-actions">
          <button class="table-view-btn" onclick="openEventModal(${event.event_id})">
            <i class="fas fa-eye"></i>
            <span>View</span>
          </button>
        </div>
      </td>
    </tr>
  `;
}

// Setup Filters
function setupFilters() {
  const progressFilter = document.getElementById('progressFilter');
  const searchInput = document.getElementById('searchInput');
  
  if (progressFilter) progressFilter.addEventListener('change', applyFilters);
  if (searchInput) searchInput.addEventListener('input', applyFilters);
}

// Apply Filters
function applyFilters() {
  const progress = document.getElementById('progressFilter').value;
  const search = document.getElementById('searchInput').value.toLowerCase();

  filteredEvents = mockEvents.filter(event => {
    const matchesProgress = !progress || event.progress_percent == progress;
    const matchesSearch = !search || 
      event.event_name.toLowerCase().includes(search) ||
      event.client_name.toLowerCase().includes(search) ||
      event.event_type.toLowerCase().includes(search);

    return matchesProgress && matchesSearch;
  });

  renderEventsByTab();
}

// Open Event Modal
function openEventModal(eventId) {
  currentEvent = mockEvents.find(e => e.event_id === eventId);
  if (!currentEvent) return;

  // Populate event details
  document.getElementById('modalEventName').textContent = currentEvent.event_name;
  document.getElementById('modalEventType').textContent = currentEvent.event_type;
  document.getElementById('modalEventDate').textContent = formatDate(currentEvent.start_datetime);
  document.getElementById('modalStartTime').textContent = formatTime(currentEvent.start_datetime);
  document.getElementById('modalEndTime').textContent = formatTime(currentEvent.end_datetime);
  document.getElementById('modalGuestCount').textContent = `${currentEvent.guest_count} guests`;
  document.getElementById('modalTotalCost').textContent = `$${currentEvent.total_cost.toLocaleString()}`;
  document.getElementById('modalVenue').textContent = currentEvent.venue_address;
  document.getElementById('modalDescription').textContent = currentEvent.event_description;

  // Client info
  document.getElementById('modalClientName').textContent = currentEvent.client_name;
  document.getElementById('modalClientEmail').textContent = currentEvent.client_email;
  document.getElementById('modalClientPhone').textContent = currentEvent.client_phone;

  // Packages with their Providers
  const packagesHtml = currentEvent.packages.length > 0 
    ? currentEvent.packages.map(pkg => {
      return `
        <div class="package-card">
          <h4>${pkg.name}</h4>
          <div class="package-details">
            <div class="package-detail">
              <span class="package-detail-label">Cost:</span>
              <span class="package-detail-value">$${pkg.cost.toLocaleString()}</span>
            </div>
          </div>
          
          ${pkg.providers && pkg.providers.length > 0 ? `
            <div class="package-providers">
              <h5 style="margin-top: 12px; margin-bottom: 8px; font-size: 0.95rem;">Assigned Service Providers:</h5>
              ${pkg.providers.map(provider => {
                const confirmationClass = provider.confirmation.toLowerCase();
                return `
                  <div class="provider-card-modal" style="margin-bottom: 8px;">
                    <div class="provider-info-modal">
                      <div class="info-item">
                        <label>Provider Name</label>
                        <p>${provider.name || 'N/A'}</p>
                      </div>
                      <div class="info-item">
                        <label>Role</label>
                        <p>${provider.role || 'Service Provider'}</p>
                      </div>
                      <div class="info-item">
                        <label>Confirmation Status</label>
                        <p><span class="confirmation-badge ${confirmationClass}">${provider.confirmation || 'pending'}</span></p>
                      </div>
                    </div>
                  </div>
                `;
              }).join('')}
            </div>
          ` : `<p style="margin-top: 8px; color: #999; font-size: 0.9rem;"><i class="fas fa-exclamation-circle"></i> No providers assigned yet</p>`}
        </div>
      `;
    }).join('')
    : '<p class="empty-state"><i class="fas fa-box-open"></i><p>No packages selected yet</p></p>';
  
  document.getElementById('modalPackages').innerHTML = packagesHtml;

  // Timeline
  const timelineHtml = currentEvent.timeline.length > 0 
    ? currentEvent.timeline.map(item => `
      <div class="timeline-item">
        <div class="timeline-content">
          <div class="timeline-header">
            <span class="timeline-title">${item.title}</span>
            <span class="timeline-time">${formatDateTime(item.date)}</span>
          </div>
          <p class="timeline-description">${item.description}</p>
        </div>
      </div>
    `).join('')
    : '<p class="empty-state"><i class="fas fa-clock"></i><p>No timeline entries yet</p></p>';
  
  document.getElementById('modalTimeline').innerHTML = timelineHtml;

  // Show modal
  document.getElementById('eventModal').classList.add('active');
}

// Close Event Modal
function closeEventModal() {
  document.getElementById('eventModal').classList.remove('active');
  currentEvent = null;
}

// Close modals when clicking outside
document.addEventListener('click', (e) => {
  if (e.target.id === 'eventModal') {
    closeEventModal();
  }
});

// Close modal with Escape key
document.addEventListener('keydown', (e) => {
  if (e.key === 'Escape') {
    closeEventModal();
  }
});


</script>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>
