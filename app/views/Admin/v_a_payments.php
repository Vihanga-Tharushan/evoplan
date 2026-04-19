<?php require_once APPROOT . '/views/Admin/Sidebar/v_a_sidebar.php'; ?>
<?php require_once APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="../public/css/components/Admin/style(Admin_Payments).css">
<link rel="stylesheet" href="../public/css/components/table1.css">

<style>
  .notification-badge {
    display: inline-block;
    width: 10px;
    height: 10px;
    background-color: #dc3545;
    border-radius: 50%;
    margin-left: 6px;
  }
</style>

<div class="payments-container">
  <!-- Header -->
  <div class="payments-header">
    <h1>Payment Management</h1>
    <p>Manage payments and payment requests</p>
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
    <button class="tab-btn active" data-tab="all-transactions" onclick="switchTab('all-transactions')">
      <i class="fas fa-exchange-alt"></i>
      All Transactions
    </button>
    <button class="tab-btn" data-tab="client-payment" onclick="switchTab('client-payment')">
      <i class="fas fa-wallet"></i>
      Payments from Clients
    </button>
    <button class="tab-btn" data-tab="provider-payment" onclick="switchTab('provider-payment')">
      <i class="fas fa-handshake"></i>
      Payment Requests
      <span class="notification-badge" id="providerPaymentBadge" style="display: none;">●</span>
    </button>
  </div>

  <!-- Table View - All Transactions -->
  <div class="table-scroll" id="allTransactionsTable">
    <table class="table">
      <thead>
        <tr>
          <th>Transaction ID</th>
          <th>Event Name</th>
          <th>From</th>
          <th>To</th>
          <th>Amount</th>
          <th>Payment Method</th>
          <th>Date</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody id="allTransactionsTableBody"></tbody>
    </table>
  </div>

  <!-- Table View - Client Payments -->
  <div class="table-scroll" id="clientPaymentTable" style="display: none;">
    <table class="table">
      <thead>
        <tr>
          <th>Transaction ID</th>
          <th>Event Name</th>
          <th>Event Category</th>
          <th>Client Name</th>
          <th>Amount</th>
          <th>Date</th>
          <th>Payment Status</th>
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
          <th>Event Name</th>
          <th>Service Provider Name</th>
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
</div>

<script>
  // Fetch client and provider payments data from database
  const paymentsData = [
    <?php 
      if (!empty($data['allTransactions'])) {
        foreach ($data['allTransactions'] as $transaction) {
          echo "{
            id: '#{$transaction->transaction_id}',
            type: 'all-transactions',
            eventName: '" . ucwords(strtolower($transaction->event_name ?? 'N/A')) . "',
            fromName: '" . ucwords(strtolower($transaction->sender_name ?? 'System')) . "',
            fromType: '{$transaction->sender_type}',
            toName: '" . ucwords(strtolower($transaction->receiver_name ?? 'System')) . "',
            toType: '{$transaction->receiver_type}',
            amount: 'Rs. " . number_format($transaction->total_amount, 2) . "',
            amountNum: {$transaction->total_amount},
            paymentMethod: '" . ucwords(strtolower(str_replace('_', ' ', $transaction->payment_method))) . "',
            date: '" . date('M d, Y H:i', strtotime($transaction->created_at)) . "',
            status: '" . strtolower($transaction->payment_status) . "',
            senderType: '{$transaction->sender_type}',
            receiverType: '{$transaction->receiver_type}',
            description: 'Transaction record'
          },\n";
        }
      }
      if (!empty($data['clientPayments'])) {
        foreach ($data['clientPayments'] as $payment) {
          $statusLabel = strtolower($payment->payment_status) === 'paid' ? 'completed' : 'pending';
          echo "{
            id: '#{$payment->transaction_id}',
            type: 'client-payment',
            eventName: '" . ucwords(strtolower($payment->event_name)) . "',
            clientId: 'C-{$payment->sender_id}',
            clientName: '" . ucwords(strtolower($payment->client_name)) . "',
            eventCategory: '" . ucwords(strtolower($payment->event_type)) . "',
            amount: 'Rs. " . number_format($payment->total_amount, 2) . "',
            amountNum: {$payment->total_amount},
            date: '" . date('M d, Y', strtotime($payment->event_created_at)) . "',
            status: '{$statusLabel}',
            description: 'Client payment transaction'
          },\n";
        }
      }
      if (!empty($data['providerPayments'])) {
        foreach ($data['providerPayments'] as $request) {
          $statusLabel = strtolower($request->payment_status) === 'pending' ? 'pending' : 'completed';
          echo "{
            id: 'PREQ-{$request->payment_id}',
            type: 'provider-payment',
            eventId: '" . ucwords(strtolower($request->event_name)) . "',
            providerName: '" . ucwords(strtolower($request->businessName)) . "',
            serviceType: '" . ucwords(strtolower($request->serviceType)) . "',
            amount: 'Rs. " . number_format($request->amount, 2) . "',
            amountNum: {$request->amount},
            date: '" . date('M d, Y', strtotime($request->created_at)) . "',
            status: '{$statusLabel}',
            description: 'Payment request from service provider'
          },\n";
        }
      }
    ?>
  ];

  // Initialize
  function initPayments() {
    updateCounts();
    switchTab('all-transactions');
    setupSearch();
  }

  // Switch tab and render appropriate table
  function switchTab(type) {
    activeTab = type;
    
    // Hide all tables
    document.getElementById('allTransactionsTable').style.display = 'none';
    document.getElementById('clientPaymentTable').style.display = 'none';
    document.getElementById('providerPaymentTable').style.display = 'none';
    
    // Update active tab button
    document.querySelectorAll('.tab-btn').forEach(btn => {
      btn.classList.remove('active');
    });
    document.querySelector(`[data-tab="${type}"]`).classList.add('active');
    
    // Show and render appropriate table
    if (type === 'all-transactions') {
      document.getElementById('allTransactionsTable').style.display = 'block';
      renderAllTransactionsTable();
    } else if (type === 'client-payment') {
      document.getElementById('clientPaymentTable').style.display = 'block';
      renderClientPaymentTable();
    } else if (type === 'provider-payment') {
      document.getElementById('providerPaymentTable').style.display = 'block';
      renderProviderPaymentTable();
    }
  }

  // Render All Transactions Table
  function renderAllTransactionsTable() {
    const tbody = document.getElementById('allTransactionsTableBody');
    const filteredData = paymentsData.filter(item => item.type === 'all-transactions');
    
    if (filteredData.length === 0) {
      tbody.innerHTML = '<tr><td colspan="8" style="text-align: center; padding: 40px;">No transactions found</td></tr>';
      return;
    }

    tbody.innerHTML = filteredData.map(item => {
      const statusBadgeClass = `badge-${item.status}`;
      const statusLabel = item.status === 'pending' ? '⏳ Pending' : '✓ Completed';
      
      // Color coding: Green for CLIENT->SYSTEM (incoming), Red for outgoing (SYSTEM->SERVICEP or SYSTEM->CLIENT)
      let amountColorStyle = '';
      if (item.senderType === 'CLIENT' && item.receiverType === 'SYSTEM') {
        amountColorStyle = 'color: #28a745; font-weight: bold;'; // Green for incoming
      } else if ((item.senderType === 'SYSTEM' && item.receiverType === 'SERVICEP') || 
                 (item.senderType === 'SYSTEM' && item.receiverType === 'CLIENT')) {
        amountColorStyle = 'color: #dc3545; font-weight: bold;'; // Red for outgoing
      }
      
      return `
        <tr>
          <td><strong>${item.id}</strong></td>
          <td>${item.eventName}</td>
          <td>${item.fromName} <small>(${item.fromType})</small></td>
          <td>${item.toName} <small>(${item.toType})</small></td>
          <td style="${amountColorStyle}">${item.amount}</td>
          <td>${item.paymentMethod}</td>
          <td>${item.date}</td>
          <td><span class="${statusBadgeClass}">${statusLabel}</span></td>
        </tr>
      `;
    }).join('');
  }

  // Render Client Payments Table
  function renderClientPaymentTable() {
    const tbody = document.getElementById('clientPaymentTableBody');
    const filteredData = paymentsData.filter(item => item.type === 'client-payment');
    
    if (filteredData.length === 0) {
      tbody.innerHTML = '<tr><td colspan="7" style="text-align: center; padding: 40px;">No transactions found</td></tr>';
      return;
    }

    tbody.innerHTML = filteredData.map(item => {
      const statusBadgeClass = `badge-${item.status}`;
      const statusLabel = item.status === 'pending' ? '⏳ Pending' : '✓ Completed';
      
      return `
        <tr>
          <td><strong>${item.id}</strong></td>
          <td>${item.eventName}</td>
          <td>${item.eventCategory}</td>
          <td>${item.clientName}</td>
          <td><strong>${item.amount}</strong></td>
          <td>${item.date}</td>
          <td><span class="${statusBadgeClass}">${statusLabel}</span></td>
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


  // Setup search functionality
  function setupSearch() {
    const searchInput = document.getElementById('searchInput');
    searchInput.addEventListener('input', function() {
      const query = this.value.toLowerCase();
      
      // Search in the currently active table
      let tableBodyId = '';
      if (activeTab === 'all-transactions') {
        tableBodyId = 'allTransactionsTableBody';
      } else if (activeTab === 'client-payment') {
        tableBodyId = 'clientPaymentTableBody';
      } else if (activeTab === 'provider-payment') {
        tableBodyId = 'providerPaymentTableBody';
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
    // Show red badge if there are pending provider payments
    const pendingCount = paymentsData.filter(p => p.type === 'provider-payment' && p.status === 'pending').length;
    const badge = document.getElementById('providerPaymentBadge');
    if (pendingCount > 0) {
      badge.style.display = 'inline-block';
    } else {
      badge.style.display = 'none';
    }
  }

  // Approve request
  function approveRequest(type, id) {
    if (type !== 'provider-payment') {
      alert('Only provider payment requests can be approved');
      return;
    }
    
    // Extract payment_id from the id (remove 'PREQ-' prefix)
    const payment_id = id.replace('PREQ-', '');
    
    // Make AJAX call to approve payment
    fetch('<?php echo URLROOT; ?>/Admin/approvePayment', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: 'payment_id=' + encodeURIComponent(payment_id)
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        alert('Payment approved successfully!');
        // Update local data
        const item = paymentsData.find(p => p.id === id);
        if (item) {
          item.status = 'completed';
          renderProviderPaymentTable();
          updateCounts();
        }
      } else {
        alert('Error: ' + (data.message || 'Failed to approve payment'));
      }
    })
    .catch(error => {
      console.error('Error:', error);
      alert('Error approving payment');
    });
  }

  // Deny/Reject request
  function denyRequest(type, id) {
    if (type !== 'provider-payment') {
      alert('Only provider payment requests can be rejected');
      return;
    }
    
    if (confirm('Are you sure you want to reject this payment request?')) {
      const item = paymentsData.find(p => p.id === id);
      if (item) {
        paymentsData = paymentsData.filter(p => p.id !== id);
        alert(`Payment Request ${id} rejected successfully!`);
        updateCounts();
        
        // Re-render the appropriate table
        if (type === 'provider-payment') {
          renderProviderPaymentTable();
        }
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