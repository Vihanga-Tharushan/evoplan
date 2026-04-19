<?php require_once APPROOT . '/views/Admin/Sidebar/v_a_sidebar.php'; ?>
<?php require_once APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="../public/css/components/Admin/style(Admin_Applications).css">
<link rel="stylesheet" href="../public/css/components/table1.css">
<link rel="stylesheet" href="../public/css/components/Admin/Popup.css">

<div class="applications-container">
  <!-- Header -->
  <div class="applications-header">
    <h1>Service Provider Applications</h1>
    <p>Manage and review service provider applications</p>
  </div>

  <!-- Search Bar -->
  <div class="search-section">
    <div class="search-bar-wrapper">
      <i class="fas fa-search"></i>
      <input 
        type="text" 
        id="searchInput" 
        placeholder="Search by App ID, Business Name, or Category..." 
        class="search-input"
      >
    </div>
  </div>

  <!-- Status Filter Tabs -->
  <div class="category-tabs">
    <button class="tab-btn active" data-status="all" onclick="filterByStatus('all')">
      <i class="fas fa-list"></i>
      All Applications
      <span class="count" id="allCount">0</span>
    </button>
    <button class="tab-btn" data-status="pending" onclick="filterByStatus('pending')">
      <i class="fas fa-hourglass-half"></i>
      Pending
      <span class="count" id="pendingCount">0</span>
    </button>
    <button class="tab-btn" data-status="approved" onclick="filterByStatus('approved')">
      <i class="fas fa-check-circle"></i>
      Approved
      <span class="count" id="approvedCount">0</span>
    </button>
    <button class="tab-btn" data-status="rejected" onclick="filterByStatus('rejected')">
      <i class="fas fa-times-circle"></i>
      Rejected
      <span class="count" id="rejectedCount">0</span>
    </button>
  </div>

  <!-- Applications Table -->
  <div class="table-scroll">
    <table class="table">
      <thead>
        <tr>
          <th>Application ID</th>
          <th>Service Category</th>
          <th>Business Name</th>
          <th>Documentation</th>
          <th>Submitted Date</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody id="applicationsTableBody"></tbody>
    </table>
  </div>

  <!-- Application Details Modal -->
  <div class="modal" id="applicationModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h2>Application Details</h2>
          <button class="close-btn" onclick="closeApplicationModal()">
            <i class="fas fa-times"></i>
          </button>
        </div>
        <div class="modal-body">
          <!-- Application Info Section -->
          <div class="modal-section">
            <div class="section-title">
              <i class="fas fa-file-alt"></i>
              Application Information
            </div>
            <div class="info-grid">
              <div class="info-item">
                <label>Application ID</label>
                <p id="modalAppId">-</p>
              </div>
              <div class="info-item">
                <label>Business Name</label>
                <p id="modalBusinessName">-</p>
              </div>
              <div class="info-item">
                <label>Service Category</label>
                <p id="modalCategory">-</p>
              </div>
              <div class="info-item">
                <label>Submitted Date</label>
                <p id="modalSubmittedDate">-</p>
              </div>
              <div class="info-item full-width">
                <label>Details</label>
                <p id="modalDetails">-</p>
              </div>
            </div>
          </div>

          <!-- Documentation Preview Section -->
          <div class="modal-section">
            <div class="section-title">
              <i class="fas fa-image"></i>
              Documentation
            </div>
            <div class="documentation-preview">
              <img id="modalDocImage" src="" alt="Documentation" class="doc-preview-image">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" onclick="closeApplicationModal()">Close</button>
          <button class="btn btn-success" id="approveBtn" onclick="approveFromModal()">
            <i class="fas fa-check"></i> Approve
          </button>
          <button class="btn btn-danger" id="rejectBtn" onclick="rejectFromModal()">
            <i class="fas fa-times"></i> Reject
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  // Application data
  const applicationsData = [
    {
      id: 'App-1033',
      documentName: 'Avenra Hikkaduwa.jpg',
      documentPath: '../public/img/applications/avenra-hikkaduwa.jpg',
      category: 'Venue & Halls',
      businessName: 'Avenra Hotels, Hikkaduwa',
      submittedDate: '2 hours ago',
      status: 'pending',
      details: 'Luxury venue with capacity for 500+ guests'
    },
    {
      id: 'App-1032',
      documentName: 'MacroLens.jpg',
      documentPath: '../public/img/applications/macrolens.jpg',
      category: 'Photography',
      businessName: 'MacroLens',
      submittedDate: '3 hours ago',
      status: 'approved',
      details: 'Professional photography services'
    },
    {
      id: 'App-1031',
      documentName: 'Wisithuru Flora.jpg',
      documentPath: '../public/img/applications/wisithuru-flora.jpg',
      category: 'Florist',
      businessName: 'Wisithuru Flora',
      submittedDate: '6 hours ago',
      status: 'pending',
      details: 'Wedding and event floral arrangements'
    },
    {
      id: 'App-1030',
      documentName: 'Ocean View.jpg',
      documentPath: '../public/img/applications/ocean-view.jpg',
      category: 'Venue & Halls',
      businessName: 'Ocean View, Galle',
      submittedDate: '10 hours ago',
      status: 'pending',
      details: 'Beachfront venue with modern facilities'
    },
    {
      id: 'App-1029',
      documentName: 'Leo Studio.jpg',
      documentPath: '../public/img/applications/leo-studio.jpg',
      category: 'Videography',
      businessName: 'Leo Studio',
      submittedDate: '16 hours ago',
      status: 'pending',
      details: 'Professional videography and editing'
    },
    {
      id: 'App-1028',
      documentName: 'Nisha Cake.jpg',
      documentPath: '../public/img/applications/nisha-cake.jpg',
      category: 'Cake Designer',
      businessName: 'Nisha Cake',
      submittedDate: '23 hours ago',
      status: 'approved',
      details: 'Custom cake design and baking services'
    },
    {
      id: 'App-1027',
      documentName: 'Monarch.jpg',
      documentPath: '../public/img/applications/monarch.jpg',
      category: 'Photography',
      businessName: 'Monarch',
      submittedDate: '1 day ago',
      status: 'approved',
      details: 'Professional photography studio'
    },
    {
      id: 'App-1026',
      documentName: 'Wijerathna Logi.jpg',
      documentPath: '../public/img/applications/wijerathna-logi.jpg',
      category: 'Transport & Logistic',
      businessName: 'Wijerathna Logistic',
      submittedDate: '2 days ago',
      status: 'rejected',
      details: 'Transportation and logistics services'
    },
    {
      id: 'App-1025',
      documentName: 'Blue Moon Resort.jpg',
      documentPath: '../public/img/applications/blue-moon-resort.jpg',
      category: 'Venue & Halls',
      businessName: 'Blue Moon Resort, Colombo',
      submittedDate: '5 hours ago',
      status: 'approved',
      details: 'Premium resort venue with banquet halls'
    },
    {
      id: 'App-1024',
      documentName: 'Dj Russo.jpg',
      documentPath: '../public/img/applications/dj-russo.jpg',
      category: 'DJ Artist',
      businessName: 'DJ Russo',
      submittedDate: '8 hours ago',
      status: 'approved',
      details: 'Professional DJ and music services'
    }
  ];

  let currentFilter = 'all';
  let currentApplicationId = null;

  // Initialize
  function initApplications() {
    updateCounts();
    renderApplications();
    setupSearch();
  }

  // Get document icon based on type
  function getDocumentIcon(documentType) {
    const iconMap = {
      'jpg': '<i class="fas fa-image" style="color: #f59e0b;"></i>',
      'jpeg': '<i class="fas fa-image" style="color: #f59e0b;"></i>',
    };
    return iconMap[documentType.toLowerCase()] || '<i class="fas fa-image" style="color: #f59e0b;"></i>';
  }

  // Get status badge
  function getStatusBadge(status) {
    const statusMap = {
      'pending': { class: 'badge-pending', label: '⏳ Pending' },
      'approved': { class: 'badge-success', label: '✓ Approved' },
      'rejected': { class: 'badge-danger', label: '✗ Rejected' }
    };
    const badge = statusMap[status] || statusMap['pending'];
    return `<span class="${badge.class}">${badge.label}</span>`;
  }

  // Filter by status
  function filterByStatus(status) {
    currentFilter = status;
    
    // Update active tab
    document.querySelectorAll('.tab-btn').forEach(btn => {
      btn.classList.remove('active');
    });
    document.querySelector(`[data-status="${status}"]`).classList.add('active');
    
    renderApplications();
  }

  // Render applications table
  function renderApplications() {
    const tbody = document.getElementById('applicationsTableBody');
    let filteredData = applicationsData;
    
    if (currentFilter !== 'all') {
      filteredData = applicationsData.filter(app => app.status === currentFilter);
    }
    
    if (filteredData.length === 0) {
      tbody.innerHTML = '<tr><td colspan="7" style="text-align: center; padding: 40px;">No applications found</td></tr>';
      return;
    }

    tbody.innerHTML = filteredData.map(app => {
      let actionButtons = '';
      
      if (app.status === 'pending') {
        actionButtons = `
          <div class="action-buttons-inline">
            <button class="btn-icon btn-success" title="Approve Application" onclick="approveApplication('${app.id}')">
              <i class="fas fa-check"></i>
            </button>
            <button class="btn-icon btn-danger" title="Reject Application" onclick="rejectApplication('${app.id}')">
              <i class="fas fa-times"></i>
            </button>
            <button class="btn-icon btn-primary" title="View Details" onclick="viewDetails('${app.id}')">
              <i class="fas fa-eye"></i>
            </button>
          </div>
        `;
      } else {
        actionButtons = `
          <button class="btn-icon btn-primary" title="View Details" onclick="viewDetails('${app.id}')">
            <i class="fas fa-eye"></i>
          </button>
        `;
      }
      
      return `
        <tr>
          <td><strong>${app.id}</strong></td>
          <td>${app.category}</td>
          <td><strong>${app.businessName}</strong></td>
          <td>
            <div class="document-icon">
              ${getDocumentIcon('jpg')}
              <span class="doc-name">${app.documentName}</span>
            </div>
          </td>
          <td>${app.submittedDate}</td>
          <td>${getStatusBadge(app.status)}</td>
          <td>${actionButtons}</td>
        </tr>
      `;
    }).join('');
  }

  // Setup search functionality
  function setupSearch() {
    const searchInput = document.getElementById('searchInput');
    searchInput.addEventListener('input', function() {
      const query = this.value.toLowerCase();
      const tbody = document.getElementById('applicationsTableBody');
      const rows = tbody.querySelectorAll('tr');
      
      rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(query) ? '' : 'none';
      });
    });
  }

  // Update tab counts
  function updateCounts() {
    document.getElementById('allCount').textContent = applicationsData.length;
    document.getElementById('pendingCount').textContent = applicationsData.filter(app => app.status === 'pending').length;
    document.getElementById('approvedCount').textContent = applicationsData.filter(app => app.status === 'approved').length;
    document.getElementById('rejectedCount').textContent = applicationsData.filter(app => app.status === 'rejected').length;
  }

  // View details in modal
  function viewDetails(appId) {
    const app = applicationsData.find(a => a.id === appId);
    if (app) {
      currentApplicationId = appId;
      
      // Populate modal fields
      document.getElementById('modalAppId').textContent = app.id;
      document.getElementById('modalBusinessName').textContent = app.businessName;
      document.getElementById('modalCategory').textContent = app.category;
      document.getElementById('modalSubmittedDate').textContent = app.submittedDate;
      document.getElementById('modalDetails').textContent = app.details;
      document.getElementById('modalDocImage').src = app.documentPath;
      
      // Show/hide approve and reject buttons based on status
      const approveBtn = document.getElementById('approveBtn');
      const rejectBtn = document.getElementById('rejectBtn');
      
      if (app.status === 'pending') {
        approveBtn.style.display = 'inline-flex';
        rejectBtn.style.display = 'inline-flex';
      } else {
        approveBtn.style.display = 'none';
        rejectBtn.style.display = 'none';
      }
      
      // Open modal
      openApplicationModal();
    }
  }

  // Open modal
  function openApplicationModal() {
    const modal = document.getElementById('applicationModal');
    modal.classList.add('active');
  }

  // Close modal
  function closeApplicationModal() {
    const modal = document.getElementById('applicationModal');
    modal.classList.remove('active');
    currentApplicationId = null;
  }

  // Approve from modal
  function approveFromModal() {
    if (currentApplicationId) {
      const app = applicationsData.find(a => a.id === currentApplicationId);
      if (app) {
        app.status = 'approved';
        updateCounts();
        renderApplications();
        closeApplicationModal();
        alert(`Application ${currentApplicationId} for ${app.businessName} has been approved!`);
      }
    }
  }

  // Reject from modal
  function rejectFromModal() {
    if (currentApplicationId) {
      const app = applicationsData.find(a => a.id === currentApplicationId);
      if (app) {
        app.status = 'rejected';
        updateCounts();
        renderApplications();
        closeApplicationModal();
        alert(`Application ${currentApplicationId} for ${app.businessName} has been rejected!`);
      }
    }
  }

  // Approve application (from table button)
  function approveApplication(appId) {
    const app = applicationsData.find(a => a.id === appId);
    if (app) {
      app.status = 'approved';
      updateCounts();
      renderApplications();
      alert(`Application ${appId} for ${app.businessName} has been approved!`);
    }
  }

  // Reject application (from table button)
  function rejectApplication(appId) {
    const app = applicationsData.find(a => a.id === appId);
    if (app) {
      app.status = 'rejected';
      updateCounts();
      renderApplications();
      alert(`Application ${appId} for ${app.businessName} has been rejected!`);
    }
  }

  // Initialize on page load
  window.addEventListener('DOMContentLoaded', initApplications);
</script>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>