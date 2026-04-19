<?php require_once APPROOT . '/views/Admin/Sidebar/v_a_sidebar.php'; ?>
<?php require_once APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="../public/css/components/Admin/style(Admin_Payments).css">
<link rel="stylesheet" href="../public/css/components/table1.css">

<div class="payments-container">
  <!-- Header -->
  <div class="payments-header">
    <h1>Payment Management</h1>
    <p>Manage payments, payment requests, and refund requests</p>
  </div>

  <!-- Search Bar
  <div class="search-section">
    <div class="search-bar-wrapper">
      <i class="fas fa-search"></i>
      <input 
        type="text" 
        id="searchInput" 
        placeholder="Search by Event ID, Client ID, or Name..." 
        class="search-input"
      >
    </div>
  </div> -->

  <!-- Tab Navigation -->
  <div class="category-tabs">
    <button class="tab-btn active" data-tab="client-payment" onclick="switchTab('client-payment')">
      <i class="fas fa-wallet"></i>
      Payments from Clients
      <span class="count" id="clientPaymentCount">0</span>
    </button>
    <button class="tab-btn" data-tab="provider-payment" onclick="switchTab('provider-payment')">
      <i class="fas fa-handshake"></i>
      Payment Requests
      <span class="count" id="providerPaymentCount">0</span>
    </button>
    <button class="tab-btn" data-tab="refund" onclick="switchTab('refund')">
      <i class="fas fa-undo"></i>
      Refund Requests
      <span class="count" id="refundRequestCount">0</span>
    </button>
  </div>

  <!-- Table View - Client Payments -->
  <div class="table-scroll" id="clientPaymentTable">
    <table class="table">
      <thead>
        <tr>
          <th>Transaction ID</th>
          <th>Event ID</th>
          <th>Event Category</th>
          <th>Client Name</th>
          <th>Amount</th>
          <th>Date</th>
          <th>Payment Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody id="clientPaymentTableBody"></tbody>
    </table>
  </div>

  <!-- Table View - Payment Requests -->
  <div class="table-scroll" id="providerPaymentTable" style="display: none;">
    <table class="table">
      <thead>
        <tr>
          <th>Request ID</th>
          <th>Event ID</th>
          <th>Provider Name</th>
          <th>Service Type</th>
          <th>Amount</th>
          <th>Request Date</th>
          <th>Request Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody id="providerPaymentTableBody"></tbody>
    </table>
  </div>

  <!-- Table View - Refund Requests -->
  <div class="table-scroll" id="refundRequestTable" style="display: none;">
    <table class="table">
      <thead>
        <tr>
          <th>Refund ID</th>
          <th>Event ID</th>
          <th>Client Name</th>
          <th>Refund Reason</th>
          <th>Amount</th>
          <th>Request Date</th>
          <th>Refund Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody id="refundRequestTableBody"></tbody>
    </table>
  </div>
</div>

<script>
  // Sample payment and refund data
  const paymentsData = [
    // Payments from Clients
    {
      id: 'PAY-5032',
      type: 'client-payment',
      eventId: 'EVT-2031',
      clientId: 'C-2542',
      clientName: 'Ramya De Silva',
      eventCategory: 'Birthday',
      amount: 'Rs. 45,000',
      amountNum: 45000,
      date: '2 hours ago',
      status: 'pending',
      paymentMethod: 'Card',
      description: 'Birthday event payment - Partial advance'
    },
    {
      id: 'PAY-5031',
      type: 'client-payment',
      eventId: 'EVT-2030',
      clientId: 'C-0099',
      clientName: 'Sarah Johnson',
      eventCategory: 'Wedding',
      amount: 'Rs. 125,000',
      amountNum: 125000,
      date: '5 hours ago',
      status: 'completed',
      paymentMethod: 'Bank Transfer',
      description: 'Wedding venue and decoration payment'
    },
    {
      id: 'PAY-5030',
      type: 'client-payment',
      eventId: 'EVT-2029',
      clientId: 'C-2453',
      clientName: 'Emily Brown',
      eventCategory: 'Family Gathering',
      amount: 'Rs. 35,500',
      amountNum: 35500,
      date: '1 day ago',
      status: 'completed',
      paymentMethod: 'Card',
      description: 'Family gathering catering service'
    },
    {
      id: 'PAY-5029',
      type: 'client-payment',
      eventId: 'EVT-2028',
      clientId: 'C-0864',
      clientName: 'Jessica Williams',
      eventCategory: 'Anniversary',
      amount: 'Rs. 28,000',
      amountNum: 28000,
      date: '2 days ago',
      status: 'completed',
      paymentMethod: 'Card',
      description: 'Anniversary party setup'
    },

    // Payment Requests from Service Providers
    {
      id: 'PREQ-4021',
      type: 'provider-payment',
      eventId: 'EVT-2027',
      clientId: 'SP-0929',
      clientName: 'Michael Chen',
      providerName: 'Elite Photography',
      eventCategory: 'Corporate Event',
      amount: 'Rs. 85,000',
      amountNum: 85000,
      date: '3 days ago',
      status: 'pending',
      serviceType: 'Photography',
      description: 'Corporate event photography - Full package'
    },
    {
      id: 'PREQ-4020',
      type: 'provider-payment',
      eventId: 'EVT-2026',
      clientId: 'SP-0842',
      clientName: 'Garden Dreams Decor',
      providerName: 'Garden Dreams Decor',
      eventCategory: 'Wedding',
      amount: 'Rs. 95,000',
      amountNum: 95000,
      date: '1 day ago',
      status: 'pending',
      serviceType: 'Decoration',
      description: 'Wedding hall decoration - Complete setup'
    },
    {
      id: 'PREQ-4019',
      type: 'provider-payment',
      eventId: 'EVT-2025',
      clientId: 'SP-1105',
      clientName: 'Supreme Catering',
      providerName: 'Supreme Catering',
      eventCategory: 'Birthday',
      amount: 'Rs. 42,500',
      amountNum: 42500,
      date: '5 hours ago',
      status: 'pending',
      serviceType: 'Catering',
      description: 'Birthday party catering - 150 guests'
    },

    // Refund Requests from Clients
    {
      id: 'REF-1024',
      type: 'refund',
      eventId: 'EVT-2024',
      clientId: 'C-0042',
      clientName: 'David Miller',
      eventCategory: 'Party',
      amount: 'Rs. 15,000',
      amountNum: 15000,
      date: '6 hours ago',
      status: 'pending',
      reason: 'Event cancelled due to venue unavailability',
      originalPayment: 'PAY-4998',
      description: 'Refund request for cancelled event'
    },
    {
      id: 'REF-1023',
      type: 'refund',
      eventId: 'EVT-2023',
      clientId: 'C-2632',
      clientName: 'Kasuni Perera',
      eventCategory: 'Wedding',
      amount: 'Rs. 50,000',
      amountNum: 50000,
      date: '1 day ago',
      status: 'pending',
      reason: 'Partial refund - Changed decoration style',
      originalPayment: 'PAY-4997',
      description: 'Partial refund request'
    },
    {
      id: 'REF-1022',
      type: 'refund',
      eventId: 'EVT-2022',
      clientId: 'C-0531',
      clientName: 'Roshan Lokuge',
      eventCategory: 'Birthday',
      amount: 'Rs. 20,000',
      amountNum: 20000,
      date: '2 days ago',
      status: 'completed',
      reason: 'Duplicate booking refund',
      originalPayment: 'PAY-4996',
      description: 'Refund approved and processed'
    }
  ];

  // Initialize
  function initPayments() {
    updateCounts();
    switchTab('client-payment');
    setupSearch();
  }

  // Switch tab and render appropriate table
  function switchTab(type) {
    activeTab = type;
    
    // Hide all tables
    document.getElementById('clientPaymentTable').style.display = 'none';
    document.getElementById('providerPaymentTable').style.display = 'none';
    document.getElementById('refundRequestTable').style.display = 'none';
    
    // Update active tab button
    document.querySelectorAll('.tab-btn').forEach(btn => {
      btn.classList.remove('active');
    });
    document.querySelector(`[data-tab="${type}"]`).classList.add('active');
    
    // Show and render appropriate table
    if (type === 'client-payment') {
      document.getElementById('clientPaymentTable').style.display = 'block';
      renderClientPaymentTable();
    } else if (type === 'provider-payment') {
      document.getElementById('providerPaymentTable').style.display = 'block';
      renderProviderPaymentTable();
    } else if (type === 'refund') {
      document.getElementById('refundRequestTable').style.display = 'block';
      renderRefundRequestTable();
    }
  }

  // Render Client Payments Table
  function renderClientPaymentTable() {
    const tbody = document.getElementById('clientPaymentTableBody');
    const filteredData = paymentsData.filter(item => item.type === 'client-payment');
    
    if (filteredData.length === 0) {
      tbody.innerHTML = '<tr><td colspan="8" style="text-align: center; padding: 40px;">No transactions found</td></tr>';
      return;
    }

    tbody.innerHTML = filteredData.map(item => {
      const statusBadgeClass = `badge-${item.status}`;
      const statusLabel = item.status === 'pending' ? '⏳ Pending' : '✓ Completed';
      
      let actionButtons = `
        <button class="btn-icon btn-primary" title="View Details" onclick="viewDetails('${item.id}')">
          <i class="fas fa-eye"></i>
        </button>
      `;
      
      return `
        <tr>
          <td><strong>${item.id}</strong></td>
          <td>${item.eventId}</td>
          <td>${item.eventCategory}</td>
          <td>${item.clientName}</td>
          <td><strong>${item.amount}</strong></td>
          <td>${item.date}</td>
          <td><span class="${statusBadgeClass}">${statusLabel}</span></td>
          <td>${actionButtons}</td>
        </tr>
      `;
    }).join('');
  }

  // Render Provider Payment Requests Table
  function renderProviderPaymentTable() {
    const tbody = document.getElementById('providerPaymentTableBody');
    const filteredData = paymentsData.filter(item => item.type === 'provider-payment');
    
    if (filteredData.length === 0) {
      tbody.innerHTML = '<tr><td colspan="8" style="text-align: center; padding: 40px;">No requests found</td></tr>';
      return;
    }

    tbody.innerHTML = filteredData.map(item => {
      const statusBadgeClass = `badge-${item.status}`;
      const statusLabel = item.status === 'pending' ? '⏳ Pending' : '✓ Approved';
      
      let actionButtons = '';
      if (item.status === 'pending') {
        actionButtons = `
          <div class="action-buttons-inline">
            <button class="btn-icon btn-success" title="Approve" onclick="approveRequest('provider-payment', '${item.id}')">
              <i class="fas fa-check"></i>
            </button>
            <button class="btn-icon btn-danger" title="Reject" onclick="denyRequest('provider-payment', '${item.id}')">
              <i class="fas fa-times"></i>
            </button>
          </div>
        `;
      } else {
        actionButtons = `
          <button class="btn-icon btn-primary" title="View Details" onclick="viewDetails('${item.id}')">
            <i class="fas fa-eye"></i>
          </button>
        `;
      }
      
      return `
        <tr>
          <td><strong>${item.id}</strong></td>
          <td>${item.eventId}</td>
          <td>${item.providerName}</td>
          <td>${item.serviceType}</td>
          <td><strong>${item.amount}</strong></td>
          <td>${item.date}</td>
          <td><span class="${statusBadgeClass}">${statusLabel}</span></td>
          <td>${actionButtons}</td>
        </tr>
      `;
    }).join('');
  }

  // Render Refund Requests Table
  function renderRefundRequestTable() {
    const tbody = document.getElementById('refundRequestTableBody');
    const filteredData = paymentsData.filter(item => item.type === 'refund');
    
    if (filteredData.length === 0) {
      tbody.innerHTML = '<tr><td colspan="8" style="text-align: center; padding: 40px;">No refund requests found</td></tr>';
      return;
    }

    tbody.innerHTML = filteredData.map(item => {
      const statusBadgeClass = `badge-${item.status}`;
      const statusLabel = item.status === 'pending' ? '⏳ Pending' : '✓ Approved';
      
      let actionButtons = '';
      if (item.status === 'pending') {
        actionButtons = `
          <div class="action-buttons-inline">
            <button class="btn-icon btn-success" title="Approve" onclick="approveRequest('refund', '${item.id}')">
              <i class="fas fa-check"></i>
            </button>
            <button class="btn-icon btn-danger" title="Deny" onclick="denyRequest('refund', '${item.id}')">
              <i class="fas fa-times"></i>
            </button>
          </div>
        `;
      } else {
        actionButtons = `
          <button class="btn-icon btn-primary" title="View Details" onclick="viewDetails('${item.id}')">
            <i class="fas fa-eye"></i>
          </button>
        `;
      }
      
      return `
        <tr>
          <td><strong>${item.id}</strong></td>
          <td>${item.eventId}</td>
          <td>${item.clientName}</td>
          <td>${item.reason}</td>
          <td><strong>${item.amount}</strong></td>
          <td>${item.date}</td>
          <td><span class="${statusBadgeClass}">${statusLabel}</span></td>
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
      
      // Search in the currently active table
      let tableBodyId = '';
      if (activeTab === 'client-payment') {
        tableBodyId = 'clientPaymentTableBody';
      } else if (activeTab === 'provider-payment') {
        tableBodyId = 'providerPaymentTableBody';
      } else if (activeTab === 'refund') {
        tableBodyId = 'refundRequestTableBody';
      }
      
      if (tableBodyId) {
        const tbody = document.getElementById(tableBodyId);
        const rows = tbody.querySelectorAll('tr');
        
        rows.forEach(row => {
          const text = row.textContent.toLowerCase();
          row.style.display = text.includes(query) ? '' : 'none';
        });
      }
    });
  }

  // Update counts on tabs
  function updateCounts() {
    document.getElementById('clientPaymentCount').textContent = paymentsData.filter(p => p.type === 'client-payment').length;
    document.getElementById('providerPaymentCount').textContent = paymentsData.filter(p => p.type === 'provider-payment').length;
    document.getElementById('refundRequestCount').textContent = paymentsData.filter(p => p.type === 'refund').length;
  }

  // Approve request (payment or refund)
  function approveRequest(type, id) {
    const item = paymentsData.find(p => p.id === id);
    if (item) {
      item.status = 'completed';
      const typeLabel = type === 'provider-payment' ? 'Payment Request' : 'Refund Request';
      alert(`${typeLabel} ${id} approved successfully!`);
      
      // Re-render the appropriate table
      if (type === 'provider-payment') {
        renderProviderPaymentTable();
      } else if (type === 'refund') {
        renderRefundRequestTable();
      }
    }
  }

  // Deny/Reject request (payment or refund)
  function denyRequest(type, id) {
    const item = paymentsData.find(p => p.id === id);
    if (item) {
      paymentsData = paymentsData.filter(p => p.id !== id);
      const typeLabel = type === 'provider-payment' ? 'Payment Request' : 'Refund Request';
      alert(`${typeLabel} ${id} rejected successfully!`);
      updateCounts();
      
      // Re-render the appropriate table
      if (type === 'provider-payment') {
        renderProviderPaymentTable();
      } else if (type === 'refund') {
        renderRefundRequestTable();
      }
    }
  }

  // View transaction details
  function viewDetails(id) {
    const item = paymentsData.find(p => p.id === id);
    if (item) {
      let details = `Transaction Details:\n\nID: ${item.id}\nEvent: ${item.eventId}\nCategory: ${item.eventCategory}\nAmount: ${item.amount}\nDate: ${item.date}\nStatus: ${item.status}\nDescription: ${item.description}`;
      if (item.reason) {
        details += `\nReason: ${item.reason}`;
      }
      alert(details);
    }
  }

  // Initialize on page load
  window.addEventListener('DOMContentLoaded', initPayments);
</script>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>