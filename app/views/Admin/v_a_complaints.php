<?php require_once APPROOT . '/views/Admin/Sidebar/v_a_sidebar.php'; ?>
<?php require_once APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="../public/css/components/Admin/style(Admin_Complains).css">

<div class="complaints-container">
  <!-- Header -->
  <div class="complaints-header">
    <h1>Complaints Management</h1>
    <p>View and manage all customer and service provider complaints</p>
  </div>

  <!-- Type Filter Tabs -->
  <div class="type-tabs">
    <button class="type-btn active" data-type="all" onclick="filterType('all')">
      All Types
      <span class="count">0</span>
    </button>
    <button class="type-btn" data-type="client" onclick="filterType('client')">
      Client Complaints
      <span class="count">0</span>
    </button>
    <button class="type-btn" data-type="provider" onclick="filterType('provider')">
      Service Provider Complaints
      <span class="count">0</span>
    </button>
  </div>

  <!-- Complaints List -->
  <div class="complaints-list" id="complaintsList"></div>
</div>

<script>
  // Helper function to format date
  function formatDate(dateString) {
    if (!dateString) return 'Just now';
    const date = new Date(dateString);
    const now = new Date();
    const diffMs = now - date;
    const diffMins = Math.floor(diffMs / 60000);
    const diffHours = Math.floor(diffMs / 3600000);
    const diffDays = Math.floor(diffMs / 86400000);
    
    if (diffMins < 1) return 'Just now';
    if (diffMins < 60) return `${diffMins} minute${diffMins > 1 ? 's' : ''} ago`;
    if (diffHours < 24) return `${diffHours} hour${diffHours > 1 ? 's' : ''} ago`;
    if (diffDays < 7) return `${diffDays} day${diffDays > 1 ? 's' : ''} ago`;
    return date.toLocaleDateString();
  }

  // Track current filter type
  let currentType = 'all';

  // Complaints data from database
  const complaintsData = <?php
    $complaintObjects = array();
    
    if (!empty($data['clientComplaints'])) {
      foreach ($data['clientComplaints'] as $complaint) {
        $statusMap = [
          'SEND' => 'new',
          'OPEN' => 'new',
          'IN_PROGRESS' => 'in-progress',
          'RESOLVED' => 'resolved',
          'REJECTED' => 'resolved',
          'ESCALATED' => 'in-progress'
        ];
        $status = isset($complaint->status) && isset($statusMap[$complaint->status]) ? $statusMap[$complaint->status] : 'new';
        
        $obj = array(
          'id' => 'CC-' . $complaint->complaint_id,
          'type' => 'client',
          'subject' => $complaint->issue_type ?? 'Other',
          'category' => 'Client Issue',
          'name' => $complaint->client_name ?? 'Unknown Client',
          'company' => 'Event Service',
          'date' => $complaint->created_at,
          'status' => $status,
          'avatar' => '../public/img/Admin/Complains/default-client.png',
          'description' => $complaint->description ?? ''
        );
        $complaintObjects[] = $obj;
      }
    }
    
    if (!empty($data['providerComplaints'])) {
      foreach ($data['providerComplaints'] as $complaint) {
        $statusMap = [
          'SEND' => 'new',
          'OPEN' => 'new',
          'IN_PROGRESS' => 'in-progress',
          'RESOLVED' => 'resolved',
          'REJECTED' => 'resolved',
          'ESCALATED' => 'in-progress'
        ];
        $status = isset($complaint->status) && isset($statusMap[$complaint->status]) ? $statusMap[$complaint->status] : 'new';
        
        $obj = array(
          'id' => 'CSP-' . $complaint->complaint_id,
          'type' => 'provider',
          'subject' => $complaint->complaint_type ?? 'Other',
          'category' => 'Provider Issue',
          'name' => $complaint->service_name ?? 'Unknown Provider',
          'company' => $complaint->event_name ?? 'N/A',
          'date' => $complaint->created_at,
          'status' => $status,
          'avatar' => '../public/img/Admin/Complains/default-provider.png',
          'description' => $complaint->description_text ?? ''
        );
        $complaintObjects[] = $obj;
      }
    }
    
    echo json_encode($complaintObjects);
  ?>;

  // Debug: Log data to console
  console.log('Complaints Data:', complaintsData);
  console.log('Total complaints:', complaintsData.length);

  // Initialize
  function initComplaints() {
    console.log('Initializing complaints...');
    renderComplaints();
    updateTypeCounts();
  }

  // Render complaints
  function renderComplaints() {
    console.log('renderComplaints called, currentType:', currentType);
    const container = document.getElementById('complaintsList');
    let filtered = complaintsData;

    // Filter by type
    if (currentType !== 'all') {
      filtered = filtered.filter(c => c.type === currentType);
    }
    
    console.log('Filtered complaints:', filtered);

    if (filtered.length === 0) {
      container.innerHTML = '<div class="empty-state"><p>No complaints found</p></div>';
      return;
    }

    container.innerHTML = filtered.map(complaint => {
      const typeLabel = complaint.type === 'client' ? 'Client' : 'Service Provider';
      const statusColors = {
        'new': 'status-new',
        'in-progress': 'status-progress',
        'resolved': 'status-resolved'
      };
      
      return `
        <div class="complaint-item" data-searchable="${(complaint.id + ' ' + complaint.subject + ' ' + complaint.name).toLowerCase()}">
          <div class="complaint-header">
            <div class="complaint-id">
              <span class="id-badge">${complaint.id}</span>
              <span class="type-badge ${complaint.type}">${typeLabel}</span>
            </div>
            <div class="complaint-status ${statusColors[complaint.status]}">
              <span>${complaint.status === 'new' ? '🔔 New' : complaint.status === 'in-progress' ? '⏳ In Progress' : '✓ Resolved'}</span>
            </div>
          </div>

          <div class="complaint-main">
            <div class="complaint-user">
              <!-- <img class="complaint-avatar" src="${complaint.avatar}" alt="${complaint.name}" /> -->
              <div class="complaint-info">
                <h3>${complaint.name}</h3>
                <p class="complaint-company">${complaint.company}</p>
              </div>
            </div>
          </div>

          <div class="complaint-subject">
            <strong>${complaint.subject}</strong>
            <span class="category-tag">${complaint.category}</span>
          </div>

          <div class="complaint-description">
            <p>${complaint.description}</p>
          </div>

          <div class="complaint-footer">
            <span class="complaint-date"><i class="fas fa-calendar-alt"></i> <span class="time-ago">${complaint.date}</span></span>
          </div>
        </div>
      `;
    }).join('');

    // Format all timestamps
    document.querySelectorAll('.time-ago').forEach(el => {
      el.textContent = formatDate(el.textContent);
    });
  }

  // Filter by type
  function filterType(type) {
    currentType = type;
    document.querySelectorAll('.type-btn').forEach(btn => btn.classList.remove('active'));
    document.querySelector(`[data-type="${type}"]`).classList.add('active');
    renderComplaints();
  }

  // Update type counts
  function updateTypeCounts() {
    const typeCounts = {
      all: complaintsData.length,
      client: complaintsData.filter(c => c.type === 'client').length,
      provider: complaintsData.filter(c => c.type === 'provider').length
    };

    Object.keys(typeCounts).forEach(key => {
      const btn = document.querySelector(`[data-type="${key}"]`);
      if (btn) btn.querySelector('.count').textContent = typeCounts[key];
    });
  }

  // Initialize on page load
  window.addEventListener('DOMContentLoaded', initComplaints);
</script>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>