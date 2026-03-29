<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/inc/clientsidebar/sidebar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/components/client/event/previewEvent.css">

<div class="container">
<!--    
    <div class="back-navigation">
        <button class="back-btn" onclick="goBackToPackages()">
            <span class="back-icon">←</span> Back to Packages
        </button>
    </div> -->

    <!-- Progress Bar -->
    <div class="progress-bar">
        <div class="progress-line" id="progress-line"></div>
        <div class="step completed" id="step1">
            <div class="step-number"></div>
            <div class="step-label">Event Details</div>
            <div class="step-sublabel">Basic information</div>
        </div>
        <div class="step completed" id="step2">
            <div class="step-number"></div>
            <div class="step-label">Find Services</div>
            <div class="step-sublabel">Select packages</div>
        </div>
        <div class="step active" id="step3">
            <div class="step-number">3</div>
            <div class="step-label">Preview & Pay</div>
            <div class="step-sublabel">Confirm & payment</div>
        </div>
    </div>

    <!-- Event Summary Section -->
    <div class="event-summary">
        <div class="summary-header">
            <h2>Event Package Preview</h2>
            <div class="event-date">
                <span class="date-label">Event Date:</span>
                <span class="date-value" id="event-date-display">December 23, 2025</span>
            </div>
        </div>
        
        <!-- Packages Table -->
        <div class="packages-table-container">
            <table class="packages-table">
                <thead>
                    <tr>
                        <th>Package</th>
                        <th>Service Provider</th>
                        <th>Price</th>
                        <th>Notification Status</th>
                        <th>Confirmation Status</th>
                        <th>View Confirmation</th>
                    </tr>
                </thead>
                <tbody id="packages-table-body">
                    <!-- Packages will be dynamically inserted here -->
                </tbody>
            </table>
            <div class="addpackages">
                <button class="add-packages" onclick="goBackToPackages()">Add More Packages</button>
            </div>
        </div>

        <!-- Budget Summary -->
        <div class="budget-summary">
            <div class="summary-row">
                <span class="summary-label">Package Subtotal</span>
                <span class="summary-value" id="subtotal-value">Rs. 0.00</span>
            </div>
            <div class="summary-row">
                <span class="summary-label">Service Fee (0%)</span>
                <span class="summary-value" id="service-fee-value">Rs. 0.00</span>
            </div>
            <div class="summary-row">
                <span class="summary-label">Tax (0%)</span>
                <span class="summary-value" id="tax-value">Rs. 0.00</span>
            </div>
            <div class="summary-row total-row">
                <span class="summary-label total-label">Total Amount</span>
                <span class="summary-value total-value" id="total-value">Rs. 0.00</span>
            </div>
        </div>

        <!-- Pay Now Button -->
        <button class="payment-btn" id="make-payment-btn" disabled>
            <span class="btn-text">Pay Now (Rs. 0.00)</span>
        </button>
        <p class="payment-note">Payment button will be enabled once all service providers confirm your packages.</p>
    </div>
</div>

<script>
    const eventId = '<?php echo $data['event_id']; ?>';
    const URLROOT = '<?php echo URLROOT; ?>';
    
</script>

<script>
  
  let totalAmount = 0;

  document.addEventListener('DOMContentLoaded', function() {
      
    // Load event date from session storage or server
    loadEventDetails();
      
    // Get selected packages (would typically come from session or previous page)
      
    getSelectedPackages(eventId);
      

    // Setup payment button listener
    document.getElementById('make-payment-btn').addEventListener('click', processPayment);
  });

  function loadEventDetails() {
      
     var xml = new XMLHttpRequest();
     
     var data = {
         eventId: eventId
     };

     xml.onload = function(){
          if(this.readyState == 4 || this.status == 200){
              var response = JSON.parse(this.responseText);
              console.log(response);
              // Normalize and show only the date portion (no time)
              var raw = response.start_datetime || response.start_date || response.startDate || '';
              var displayDate = '';
              if(raw) {
                  // Extract YYYY-MM-DD if present, handling ' ' or 'T' separators
                  var datePart = raw.split(' ')[0].split('T')[0];
                  var parsed = new Date(datePart);
                  if(!isNaN(parsed)) {
                      displayDate = parsed.toLocaleDateString(undefined, { year: 'numeric', month: 'long', day: 'numeric' });
                  } else {
                      displayDate = datePart; // fallback
                  }
              }
              document.getElementById('event-date-display').textContent = displayDate || '—';
          }
     }

     var datastring = JSON.stringify(data);
     xml.open("POST", URLROOT + "/Clients/getEventDetails" ,true);
     xml.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
     xml.send(datastring);
  }
  
  function updateEventVenue(eventId, venueAddress) {
    const data ={
        eventId: eventId,
        venueAddress: venueAddress
    };

    var xml = new XMLHttpRequest();
    xml.onload = function() {
        if(this.readyState == 4 || this.status == 200){
            var response = JSON.parse(this.responseText);
            console.log('Venue update response:', response);
            if(response.status === 'success') {
                console.log('Event venue address updated successfully');
            } else {
                console.warn('Failed to update venue address:', response.message);
            }
        }
    };
    var datastring = JSON.stringify(data);
    xml.open("POST", URLROOT + "/Clients/updateEventVenue", true);
    xml.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xml.send(datastring);
  }

  function getSelectedPackages(eventId) {
      
      const data = {
          eventId: eventId
      };

    var xml = new XMLHttpRequest();

    xml.onload = function() {
        
      if(this.readyState == 4 || this.status == 200){
          var response = JSON.parse(this.responseText);
          console.log(response);
          renderPackages(response.packages);
          calculateTotals(response.packages);
          
          // Check if there's a venue package and update event venue address
          if(response.packages && response.packages.length > 0) {
              const venuePackage = response.packages.find(pkg => pkg.serviceType && pkg.serviceType.toLowerCase() === 'venue');
              if(venuePackage && venuePackage.businessAddress) {
                  console.log('Venue package found, updating event venue address...');
                  updateEventVenue(eventId, venuePackage.businessAddress);
              }
          }
      }
    };

    var datastring = JSON.stringify(data);
    xml.open("POST", URLROOT + "/Clients/getSessionSelectedPackages", true);
    xml.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xml.send(datastring);
  }

  function checkAllConfirmed() {
      const paymentBtn = document.getElementById('make-payment-btn');
      const packageRows = document.querySelectorAll('.package-row');
      
      if (packageRows.length === 0) {
          paymentBtn.disabled = true;
          return false;
      }
      
      // Check if all packages have ACCEPTED status
      const confirmedBadges = document.querySelectorAll('.confirmation-status .status-badge.confirmed');
      const allConfirmed = confirmedBadges.length === packageRows.length;
      
      paymentBtn.disabled = !allConfirmed;
      
      return allConfirmed;
  }

  function processPayment() {
      // Check if all packages are confirmed
      if (!checkAllConfirmed()) {
          alert('Please wait for all service providers to confirm your packages before making payment.');
          return;
      }
      
      // Redirect to payment gateway
      window.location.href = `${URLROOT}/Clients/paymentGateway/${eventId}`;
  }

  function goBackToPackages() {
      window.location.href = `${URLROOT}/Clients/findServices/${eventId}`;
  }

  function renderPackages(packages) {
      const tableBody = document.getElementById('packages-table-body');
      tableBody.innerHTML = '';
      
      if (!packages || packages.length === 0) {
          tableBody.innerHTML = '<tr><td colspan="6" style="text-align:center; padding:30px; color:var(--muted)">No packages selected yet</td></tr>';
          return;
      }
      
      packages.forEach(pkg => {
          const row = document.createElement('tr');
          row.className = 'package-row';
          row.dataset.packageId = pkg.package_id;
          
          // Notification status badge
          let notificationStatusHTML = '';
          if (pkg.sent_status === 'ON' || pkg.sent_status === 'SENT') {
              notificationStatusHTML = `
                  <div class="status-badge sent">
                      <span class="status-icon">✓</span> Sent
                  </div>
              `;
          } else if (pkg.sent_status === 'PENDING' || !pkg.sent_status) {
              notificationStatusHTML = `
                  <div class="status-badge pending">
                      <span class="status-icon">⋯</span> Pending
                  </div>
                  <button class="send-notification" data-package-id="${pkg.event_package_id}">Send</button>
              `;
          } else if (pkg.sent_status === 'FAILED') {
              notificationStatusHTML = `
                  <div class="status-badge failed">
                      <span class="status-icon">✗</span> Failed
                  </div>
                  <button class="send-notification" data-package-id="${pkg.event_package_id}">Retry</button>
              `;
          }
          
          // Confirmation status badge
          let confirmationStatusHTML = '';
          const confirmStatus = (pkg.confirmation_status || '').toUpperCase();
          
          if (confirmStatus === 'ACCEPTED') {
              confirmationStatusHTML = `
                  <div class="status-badge confirmed">
                      <span class="status-icon">✓</span> Confirmed
                  </div>
              `;
          } else if (confirmStatus === 'PENDING') {
              confirmationStatusHTML = `
                  <div class="status-badge pending">
                      <span class="status-icon"></span> Pending
                  </div>
              `;
          } else if (confirmStatus === 'REJECTED') {
              confirmationStatusHTML = `
                  <div class="status-badge declined">
                      <span class="status-icon">✗</span> Declined
                  </div>
              `;
          } else {
              confirmationStatusHTML = `
                  <div class="status-badge not-sent">
                      Not Sent
                  </div>
              `;
          }
          
          // View confirmation link
          let viewConfirmationHTML = '';
          if (pkg.confirmed_at) {
              viewConfirmationHTML = `<a href="${URLROOT}/clients/viewConfirmation/${pkg.event_package_id}" class="view-link">View</a>`;
          } else {
              viewConfirmationHTML = '<span style="color:var(--muted); font-size:0.85rem;">N/A</span>';
          }
          
          row.innerHTML = `
              <td class="package-name">
                  <strong>${pkg.package_name}</strong>
              </td>
              <td class="provider-info">
                  <a href="${URLROOT}/clients/viewprovider/${pkg.service_id}" class="provider-link">
                      
                      <span class="provider-name">${pkg.service_provider_name}</span>
                  </a>
              </td>
              <td class="package-price">Rs. ${parseFloat(pkg.package_price).toLocaleString('en', {minimumFractionDigits: 2, maximumFractionDigits: 2})}</td>
              <td class="notification-status">
                  ${notificationStatusHTML}
              </td>
              <td class="confirmation-status">
                  ${confirmationStatusHTML}
              </td>
              <td>
                  ${viewConfirmationHTML}
              </td>
          `;
          
          tableBody.appendChild(row);
      });
      
      // Add event listeners to notification buttons
      document.querySelectorAll('.send-notification, .resend-notification').forEach(button => {
          button.addEventListener('click', function() {
              const packageId = this.dataset.packageId;
              sendNotification(packageId);
          });
      });
      
      // Check if all packages are confirmed and enable/disable payment button
      checkAllConfirmed();
  }

  function calculateTotals(packages) {
      if (!packages || packages.length === 0) {
          document.getElementById('subtotal-value').textContent = 'Rs. 0.00';
          document.getElementById('service-fee-value').textContent = 'Rs. 0.00';
          document.getElementById('tax-value').textContent = 'Rs. 0.00';
          document.getElementById('total-value').textContent = 'Rs. 0.00';
          document.getElementById('make-payment-btn').textContent = 'Make Payment for Full Event (Rs. 0.00)';
          return;
      }
      
      const subtotal = packages.reduce((sum, pkg) => sum + parseFloat(pkg.package_price || 0), 0);
      const serviceFee = subtotal * 0.00;
      const tax = subtotal * 0.00;
      totalAmount = subtotal + serviceFee + tax;
      
      // Update UI with formatted values
      document.getElementById('subtotal-value').textContent = `Rs. ${subtotal.toLocaleString('en', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
      document.getElementById('service-fee-value').textContent = `Rs. ${serviceFee.toLocaleString('en', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
      document.getElementById('tax-value').textContent = `Rs. ${tax.toLocaleString('en', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
      document.getElementById('total-value').textContent = `Rs. ${totalAmount.toLocaleString('en', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
      document.querySelector('#make-payment-btn .btn-text').textContent = `Pay Now (Rs. ${totalAmount.toLocaleString('en', {minimumFractionDigits: 2, maximumFractionDigits: 2})})`;
      
      return { subtotal, serviceFee, tax, totalAmount };
  }

</script>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>