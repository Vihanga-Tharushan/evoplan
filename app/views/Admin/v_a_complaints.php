<?php require_once APPROOT . '/views/Admin/Sidebar/v_a_sidebar.php'; ?>
<?php require_once APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="../public/css/components/Admin/style(Admin_Complains).css">

<div class="complaints-container">
  <!-- Header -->
  <div class="complaints-header">
    <h1>Complaints Management</h1>
    <p>View and manage all customer and service provider complaints</p>
  </div>

  <!-- Status Filter Tabs -->
  <div class="status-tabs">
    <button class="status-btn active" data-status="all" onclick="filterStatus('all')">
      <i class="fas fa-list"></i>
      <span>All Complaints</span>
      <span class="count">0</span>
    </button>
    <button class="status-btn" data-status="new" onclick="filterStatus('new')">
      <i class="fas fa-clock"></i>
      <span>New</span>
      <span class="count">0</span>
    </button>
    <button class="status-btn" data-status="in-progress" onclick="filterStatus('in-progress')">
      <i class="fas fa-spinner"></i>
      <span>In Progress</span>
      <span class="count">0</span>
    </button>
    <button class="status-btn" data-status="resolved" onclick="filterStatus('resolved')">
      <i class="fas fa-check-circle"></i>
      <span>Resolved</span>
      <span class="count">0</span>
    </button>
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
  // Sample complaints data
  const complaintsData = [
    {
      id: 'CC-4259',
      type: 'client',
      subject: 'One album is missing',
      category: 'Product Defect',
      name: 'Malika Nishantha',
      company: 'Amari Supermarket',
      date: '2 hours ago',
      status: 'new',
      avatar: '../public/img/Admin/Complains/rectangle-14.png',
      description: 'Customer reported that one of the photo albums from the event package is missing.'
    },
    {
      id: 'CSP-1558',
      type: 'provider',
      subject: 'Stats missing',
      category: 'System',
      name: 'Shanika Perera',
      company: 'Amari Supermarket',
      date: '2 hours ago',
      status: 'new',
      avatar: '../public/img/Admin/Complains/rectangle-10.png',
      description: 'Service provider reported missing statistics in their dashboard.'
    },
    {
      id: 'CC-4258',
      type: 'client',
      subject: 'One album is missing',
      category: 'Product Defect',
      name: 'Sanju de Silva',
      company: 'Amari Supermarket',
      date: '2 days ago',
      status: 'in-progress',
      avatar: '../public/img/Admin/Complains/rectangle-15.png',
      description: 'Follow-up complaint regarding missing photo album delivery.'
    },
    {
      id: 'CSP-1557',
      type: 'provider',
      subject: 'Payment fail',
      category: 'Payment',
      name: 'Kasuni Perera',
      company: 'Amari Supermarket',
      date: '2 days ago',
      status: 'in-progress',
      avatar: '../public/img/Admin/Complains/rectangle-11.png',
      description: 'Service provider experiencing payment processing failures.'
    },
    {
      id: 'CC-4257',
      type: 'client',
      subject: 'One album is missing',
      category: 'Service',
      name: 'Nethmi Liyanage',
      company: 'Amari Supermarket',
      date: '1 week ago',
      status: 'resolved',
      avatar: '../public/img/Admin/Complains/rectangle-16.png',
      description: 'Service quality complaint - resolved with replacement.'
    },
    {
      id: 'CSP-1556',
      type: 'provider',
      subject: 'Payment fail',
      category: 'Payment',
      name: 'Roshan Lokuge',
      company: 'Amari Supermarket',
      date: '1 week ago',
      status: 'resolved',
      avatar: '../public/img/Admin/Complains/rectangle-12.png',
      description: 'Payment issue successfully resolved.'
    },
    {
      id: 'CC-4256',
      type: 'client',
      subject: 'One album is missing',
      category: 'Product Defect',
      name: 'Chanalee Hiranya',
      company: 'Amari Supermarket',
      date: '1 week ago',
      status: 'resolved',
      avatar: '../public/img/Admin/Complains/rectangle-17.png',
      description: 'Missing album issue resolved with replacement delivery.'
    },
    {
      id: 'CSP-1555',
      type: 'provider',
      subject: 'Stats missing',
      category: 'System',
      name: 'Malinga Silva',
      company: 'Amari Supermarket',
      date: '1 week ago',
      status: 'resolved',
      avatar: '../public/img/Admin/Complains/rectangle-13.png',
      description: 'System statistics issue has been fixed.'
    }
  ];

  let currentStatus = 'all';
  let currentType = 'all';

  // Initialize
  function initComplaints() {
    renderComplaints();
    updateCounts();
  }

  // Render complaints
  function renderComplaints() {
    const container = document.getElementById('complaintsList');
    let filtered = complaintsData;

    // Filter by status
    if (currentStatus !== 'all') {
      filtered = filtered.filter(c => c.status === currentStatus);
    }

    // Filter by type
    if (currentType !== 'all') {
      filtered = filtered.filter(c => c.type === currentType);
    }

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
              <img class="complaint-avatar" src="${complaint.avatar}" alt="${complaint.name}" />
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
            <span class="complaint-date"><i class="fas fa-calendar-alt"></i> ${complaint.date}</span>
            <div class="complaint-actions">
              <button class="btn-icon" title="View Details">
                <i class="fas fa-eye"></i>
              </button>
              <button class="btn-icon" title="Reply">
                <i class="fas fa-reply"></i>
              </button>
              <button class="btn-icon danger" title="Delete">
                <i class="fas fa-trash"></i>
              </button>
            </div>
          </div>
        </div>
      `;
    }).join('');
  }

  // Filter by status
  function filterStatus(status) {
    currentStatus = status;
    document.querySelectorAll('.status-btn').forEach(btn => btn.classList.remove('active'));
    document.querySelector(`[data-status="${status}"]`).classList.add('active');
    renderComplaints();
  }

  // Filter by type
  function filterType(type) {
    currentType = type;
    document.querySelectorAll('.type-btn').forEach(btn => btn.classList.remove('active'));
    document.querySelector(`[data-type="${type}"]`).classList.add('active');
    renderComplaints();
  }

  // Update counts
  function updateCounts() {
    // Status counts
    const statusCounts = {
      all: complaintsData.length,
      new: complaintsData.filter(c => c.status === 'new').length,
      'in-progress': complaintsData.filter(c => c.status === 'in-progress').length,
      resolved: complaintsData.filter(c => c.status === 'resolved').length
    };

    Object.keys(statusCounts).forEach(key => {
      const btn = document.querySelector(`[data-status="${key}"]`);
      if (btn) btn.querySelector('.count').textContent = statusCounts[key];
    });

    // Type counts
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