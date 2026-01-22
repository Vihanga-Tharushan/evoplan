<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/inc/clientTaskbar/clientTaskbar.php'; ?>
<?php require_once APPROOT . '/views/inc/clientsidebar/sidebar2.php'; ?>
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

        <!-- Payment Options -->
        <div class="payment-section">
            <h3>Payment Method</h3>
            <div class="payment-options">
                <div class="payment-option active" data-method="credit-card">
                    <div class="payment-icon credit-card"></div>
                    <div class="payment-details">
                        <h4>Credit/Debit Card</h4>
                        <p>Pay securely with your credit or debit card</p>
                    </div>
                </div>
                <div class="payment-option" data-method="bank-transfer">
                    <div class="payment-icon bank-transfer"></div>
                    <div class="payment-details">
                        <h4>Bank Transfer<?php echo $data['event_id']; ?>'</h4>
                        <p>Direct bank transfer with payment confirmation</p>
                    </div>
                </div>
                <div class="payment-option" data-method="e-wallet">
                    <div class="payment-icon e-wallet"></div>
                    <div class="payment-details">
                        <h4>E-Wallet</h4>
                        <p>Pay via your preferred e-wallet service</p>
                    </div>
                </div>
            </div>

            <div class="payment-details-form">
                <div id="credit-card-form" class="payment-form active">
                    <div class="form-group">
                        <label for="card-number">Card Number</label>
                        <input type="text" id="card-number" placeholder="XXXX XXXX XXXX XXXX" maxlength="19">
                    </div>
                    <div class="form-row">
                        <div class="form-group half">
                            <label for="expiry-date">Expiry Date</label>
                            <input type="text" id="expiry-date" placeholder="MM/YY" maxlength="5">
                        </div>
                        <div class="form-group half">
                            <label for="cvv">CVV</label>
                            <input type="text" id="cvv" placeholder="XXX" maxlength="4">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cardholder-name">Cardholder Name</label>
                        <input type="text" id="cardholder-name" placeholder="John Doe">
                    </div>
                </div>
                <!-- Other payment forms would go here -->
            </div>
        </div>

        <!-- Terms & Conditions -->
        <div class="terms-section">
            <label class="checkbox-container">
                <input type="checkbox" id="terms-checkbox">
                <span class="checkmark"></span>
                <span class="terms-text">I agree to the <a href="#">Terms & Conditions</a> and <a href="#">Cancellation Policy</a></span>
            </label>
        </div>

        <!-- Make Payment Button -->
        <button class="payment-btn" id="make-payment-btn" disabled>
            Make Payment for Full Event (Rs. 0.00)
        </button>
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
      
    // Initialize payment option listeners
    setupPaymentOptions();
      
    // Setup terms checkbox listener
    document.getElementById('terms-checkbox').addEventListener('change', togglePaymentButton);
      
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
      }
    };

    var datastring = JSON.stringify(data);
    xml.open("POST", URLROOT + "/Clients/getSessionSelectedPackages", true);
    xml.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xml.send(datastring);
  }

  function setupPaymentOptions(){

    document.querySelectorAll('.payment-option').forEach(option => {

      option.addEventListener('click', function() {
          // Remove active class from all options
          document.querySelectorAll('.payment-option').forEach(opt => {
              opt.classList.remove('active');
          });
          
          // Add active class to clicked option
          this.classList.add('active');
          
          // Hide all payment forms
          document.querySelectorAll('.payment-form').forEach(form => {
              form.classList.remove('active');
          });
          
          // Show the relevant payment form
          const method = this.dataset.method;
          document.getElementById(`${method}-form`).classList.add('active');
      });
    });
  }

  function togglePaymentButton() {
      const termsChecked = document.getElementById('terms-checkbox').checked;
      const paymentBtn = document.getElementById('make-payment-btn');
      
      // Check if all providers have confirmed (in a real app)
      const allConfirmed = document.querySelectorAll('.confirmation-status .declined').length === 0;
      
      paymentBtn.disabled = !termsChecked || !allConfirmed;
  }

  function processPayment() {
      if (!document.getElementById('terms-checkbox').checked) {
          showNotification('Please accept the terms and conditions', 'error');
          return;
      }
      
      // Disable button during processing
      const paymentBtn = document.getElementById('make-payment-btn');
      const originalText = paymentBtn.innerHTML;
      paymentBtn.disabled = true;
      paymentBtn.innerHTML = '<span class="spinner"></span> Processing Payment...';
      
      // Simulate payment processing
      setTimeout(() => {
          // In a real app, this would be an API call to process payment
          console.log('Payment processed successfully');
          
          // Show success message
          showNotification('Payment processed successfully! Your event is confirmed.', 'success');
          
          // Redirect to confirmation page after delay
          setTimeout(() => {
              window.location.href = `${URLROOT}/client/event/confirmation`;
          }, 2000);
      }, 2000);
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
      document.getElementById('make-payment-btn').textContent = `Make Payment for Full Event (Rs. ${totalAmount.toLocaleString('en', {minimumFractionDigits: 2, maximumFractionDigits: 2})})`;
      
      return { subtotal, serviceFee, tax, totalAmount };
  }

</script>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>