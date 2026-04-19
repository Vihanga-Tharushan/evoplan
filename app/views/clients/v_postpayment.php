<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/inc/clientsidebar/sidebar.php'; ?>

<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/components/client/postpayment.css">

<style>
  /* Attention Notice Styling */
  .attention-notice {
    background: linear-gradient(135deg, #fff9e6 0%, #ffeb99 100%);
    border: 2px solid #ffc107;
    border-radius: 12px;
    padding: 20px 24px;
    margin: 24px 0;
    display: flex;
    align-items: flex-start;
    gap: 16px;
    box-shadow: 0 4px 12px rgba(255, 193, 7, 0.2);
  }

  .notice-icon {
    font-size: 32px;
    flex-shrink: 0;
    margin-top: 2px;
  }

  .notice-content {
    flex: 1;
  }

  .notice-title {
    font-size: 1.1rem;
    font-weight: 700;
    color: #856404;
    margin: 0 0 8px 0;
  }

  .notice-text {
    font-size: 0.95rem;
    color: #856404;
    margin: 0;
    line-height: 1.6;
  }

  /* Responsive */
  @media (max-width: 768px) {
    .attention-notice {
      flex-direction: column;
      align-items: center;
      text-align: center;
      padding: 16px 20px;
    }

    .notice-icon {
      margin-top: 0;
    }
  }
</style>

<?php
$event = $data['event_details'] ?? null;
$packages = $data['packages'] ?? [];
$totalAmount = (float)($data['total_amount'] ?? 0);
$clientName = $data['client_name'] ?? '';
$clientEmail = $data['client_email'] ?? '';
$payment = $data['payment'] ?? null;
$eventPin = $data['event_pin'] ?? null;
$isPaid = $payment && strtoupper((string)($payment->payment_status ?? '')) === 'PAID';

$providers = [];
foreach ($packages as $pkg) {
  $sid = $pkg->service_id ?? 0;
  if (!$sid) {
    continue;
  }
  if (!isset($providers[$sid])) {
    $providerName = trim($pkg->service_provider_name ?? '');
    if ($providerName === '') {
      $providerName = 'Provider #' . $sid;
    }
    $providers[$sid] = [
      'service_id' => $sid,
      'name' => $providerName,
      'role' => $pkg->serviceType ?? 'Service Provider',
      'profile_pic' => trim((string)($pkg->profile_pic ?? '')),
      'items' => []
    ];
  }
  $providers[$sid]['items'][] = $pkg;
}

$startTs = !empty($event->start_datetime) ? strtotime($event->start_datetime) : null;
$endTs = !empty($event->end_datetime) ? strtotime($event->end_datetime) : null;
?>


<!-- Hero -->
<div class="hero">
  <div class="hero-inner">
    <div class="breadcrumb">Events <span class="sep">›</span> <span><?php echo htmlspecialchars($event->event_name ?? 'Event'); ?></span></div>
    <div class="event-id-badge">EVT-<?php echo str_pad((string)($event->event_id ?? 0), 5, '0', STR_PAD_LEFT); ?></div>
    <h1 class="hero-title"><?php echo htmlspecialchars($event->event_name ?? 'Event'); ?></h1>
    <p class="hero-subtitle">Hosted by <?php echo htmlspecialchars($clientName ?: 'Client'); ?><?php if (!empty($event->created_at)): ?> · Created <?php echo date('d M Y', strtotime($event->created_at)); ?><?php endif; ?></p>
    <div class="hero-chips">
      <div class="chip"><span class="dot"></span> <strong><?php echo $startTs ? date('d M Y', $startTs) : '-'; ?></strong>&nbsp;<?php echo $startTs ? date('l', $startTs) : ''; ?></div>
      <div class="chip"><span class="dot"></span> <strong><?php echo htmlspecialchars($event->venue_address ?? 'No venue'); ?></strong></div>
      <div class="chip"><span class="dot"></span> <strong><?php echo (int)($event->guest_count ?? 0); ?></strong> Guests</div>
      <div class="chip"><span class="dot"></span> <?php echo $startTs ? date('g:i A', $startTs) : '-'; ?> – <?php echo $endTs ? date('g:i A', $endTs) : '-'; ?></div>
      <div class="status-chip">Event Confirmed</div>
    </div>
  </div>
</div>

<div class="main">

  <!-- Event Details -->
  <div class="card">
    <div class="card-header"><div class="icon">📋</div><h2>Event Details</h2></div>
    <div class="card-body">
      <div class="payment-grid event-details-grid">
        <div class="pay-stat">
          <label>Client Name</label>
          <div class="value event-value"><?php echo htmlspecialchars($clientName ?: '-'); ?></div>
        </div>
        <div class="pay-stat">
          <label>Client Contact</label>
          <div class="value event-value"><?php echo htmlspecialchars($clientEmail ?: '-'); ?></div>
        </div>
        <div class="pay-stat">
          <label>Packages Selected</label>
          <div class="value event-value"><?php echo count($packages); ?></div>
        </div>
      </div>

      <div class="payment-rows event-details-rows">
        <div class="pay-row">
          <span class="label">Venue Type</span>
          <span class="val"><?php echo htmlspecialchars($event->venue_type ?? '-'); ?></span>
        </div>
        <div class="pay-row">
          <span class="label">Description</span>
          <span class="val"><?php echo htmlspecialchars($event->event_description ?? '-'); ?></span>
        </div>
      </div>
    </div>
  </div>

  <!-- Service Providers -->
  <div class="card">
    <div class="card-header"><div class="icon">👥</div><h2>Assigned Service Providers</h2></div>
    <div class="card-body">
      <div class="providers-list">
        <?php if (empty($providers)): ?>
          <p>No providers assigned for this event yet.</p>
        <?php else: ?>
          <?php foreach ($providers as $provider): ?>
            <div class="provider-card">
              <div class="provider-header">
                <div class="provider-avatar">
                  <?php if (!empty($provider['profile_pic'])): ?>
                    <img src="<?php echo URLROOT; ?>/public/img/profilePics/<?php echo htmlspecialchars($provider['profile_pic']); ?>" alt="<?php echo htmlspecialchars($provider['name']); ?>">
                  <?php else: ?>
                    <?php echo strtoupper(substr($provider['name'], 0, 2)); ?>
                  <?php endif; ?>
                </div>
                <div class="provider-info">
                  <p class="provider-name"><?php echo htmlspecialchars($provider['name']); ?></p>
                  <p class="provider-role"><?php echo htmlspecialchars($provider['role']); ?></p>
                </div>
                <div class="provider-contact">ID: <?php echo (int)$provider['service_id']; ?></div>
              </div>
              <div class="services-list">
                <?php foreach ($provider['items'] as $item): ?>
                  <div class="service-row">
                    <div class="service-left">
                      <span class="service-dot"></span>
                      <div>
                        <p class="service-name"><?php echo htmlspecialchars($item->package_name ?? 'Package'); ?></p>
                      </div>
                    </div>
                    <span class="service-price">LKR <?php echo number_format((float)($item->package_price ?? 0), 2); ?></span>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>

      </div>
    </div>
  </div>

  <!-- Payment Status -->
  <div class="card">
    <div class="card-header"><div class="icon">💳</div><h2>Payment Status</h2></div>
    <div class="card-body">
      <div class="payment-grid">
        <div class="pay-stat"><label>Total Event Cost</label><div class="value">LKR <?php echo number_format($totalAmount, 2); ?></div></div>
        <div class="pay-stat"><label>Amount Paid</label><div class="value green">LKR <?php echo $isPaid ? number_format($totalAmount, 2) : number_format(0, 2); ?></div></div>
        <div class="pay-stat"><label>Balance Due</label><div class="value">LKR <?php echo $isPaid ? number_format(0, 2) : number_format($totalAmount, 2); ?></div></div>
      </div>
      <div class="payment-rows">
        <div class="pay-row"><span class="label">Payment Status</span><span class="val"><?php echo $isPaid ? 'PAID' : 'Pending'; ?></span></div>
        <?php if ($isPaid && !empty($eventPin)): ?>
          <div class="pay-row"><span class="label">Event PIN</span><span class="val"><strong><?php echo htmlspecialchars($eventPin); ?></strong></span></div>
        <?php endif; ?>
        <div class="pay-row"><span class="label">Last Updated</span><span class="val"><?php echo date('d M Y, h:i A'); ?></span></div>
        </div>
    </div>
  </div>
  <!-- Attention Notice -->
  <div class="attention-notice">
    <div class="notice-icon">⚠️</div>
    <div class="notice-content">
      <p class="notice-title">Attention Notice</p>
      <p class="notice-text">You have to share this event PIN with the assigned service providers. They will use this PIN to confirm their attendance and access event details. So give this PIN after the service providers have finished or completed the event.</p>
    </div>
  </div>
</div>

<!-- Action Bar -->
<div class="action-bar">
  <p class="action-note">
    Event confirmed and fully paid. Contact support if you need to make changes.<br>
    Cancellations may be subject to the refund policy agreed at registration.
  </p>
  <button class="btn-cancel" onclick="openModal()">
    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
      <circle cx="8" cy="8" r="6.5"/><path d="M5.5 5.5l5 5M10.5 5.5l-5 5"/>
    </svg>
    Cancel Event
  </button>
</div>

<!-- Modal -->
<div class="modal-overlay" id="modal-overlay" onclick="handleOverlayClick(event)">
  <div class="modal" id="modal">
    <div class="modal-header">
      <div style="display:flex;gap:12px;align-items:flex-start;">
        <div class="modal-icon">
          <svg viewBox="0 0 18 18" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="9" cy="9" r="7.5"/><path d="M9 5.5v4M9 12.5h.01"/>
          </svg>
        </div>
        <div>
          <p class="modal-title">Cancel Event</p>
          <p class="modal-subtitle">This action cannot be undone. Please provide a reason for cancellation.</p>
        </div>
      </div>
      <button class="modal-close" onclick="closeModal()">
        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round">
          <path d="M3 3l10 10M13 3L3 13"/>
        </svg>
      </button>
    </div>
    <div class="modal-body">
      <div class="modal-warning">
        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round">
          <path d="M7 1.5L12.5 11H1.5L7 1.5z"/><path d="M7 5.5v2.5M7 9.5h.01"/>
        </svg>
        Cancelling this event may incur fees per the refund policy. All assigned service providers will be notified automatically.
      </div>
      <label class="field-label" for="cancel-reason">Cancellation Reason</label>
      <textarea id="cancel-reason" placeholder="Please describe why you are cancelling this event…" maxlength="500" oninput="updateCount()"></textarea>
      <p class="char-count"><span id="char-count">0</span> / 500</p>
    </div>
    <div class="modal-footer">
      <button class="btn-ghost" onclick="closeModal()">Keep Event</button>
      <button class="btn-confirm-cancel" onclick="confirmCancel()">
        <svg width="13" height="13" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="8" cy="8" r="6.5"/><path d="M5.5 5.5l5 5M10.5 5.5l-5 5"/>
        </svg>
        Confirm Cancellation
      </button>
    </div>
  </div>
</div>

<script>
  const eventId = <?php echo (int)($event->event_id ?? 0); ?>;

  function openModal() { document.getElementById('modal-overlay').classList.add('active'); }
  function closeModal() { document.getElementById('modal-overlay').classList.remove('active'); }
  function handleOverlayClick(e) { if (e.target === document.getElementById('modal-overlay')) closeModal(); }
  function updateCount() { document.getElementById('char-count').textContent = document.getElementById('cancel-reason').value.length; }

  async function confirmCancel() {
    const ta = document.getElementById('cancel-reason');
    const confirmBtn = document.querySelector('.btn-confirm-cancel');
    if (!ta.value.trim()) {
      ta.focus();
      ta.style.borderColor = 'rgba(192,57,43,0.7)';
      ta.style.boxShadow = '0 0 0 3px rgba(192,57,43,0.1)';
      setTimeout(() => { ta.style.borderColor = ''; ta.style.boxShadow = ''; }, 1600);
      return;
    }

    if (!eventId) {
      alert('Invalid event reference. Please reload the page and try again.');
      return;
    }

    const originalBtnText = confirmBtn ? confirmBtn.innerHTML : '';
    if (confirmBtn) {
      confirmBtn.disabled = true;
      confirmBtn.innerHTML = 'Cancelling...';
    }

    try {
      const response = await fetch('<?php echo URLROOT; ?>/clients/cancelEvent/' + eventId, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({ reason: ta.value.trim() })
      });

      const result = await response.json();
      if (!response.ok || !result.success) {
        throw new Error(result.message || 'Failed to cancel event.');
      }

      closeModal();
      console.log('Event cancelled successfully:' || result);
      alert(result.message || 'Event cancelled successfully.');
      window.location.href = '<?php echo URLROOT; ?>/clients/myevents';
    } catch (error) {
      console.error(error);
      alert(error.message || 'Something went wrong while cancelling the event.');
    } finally {
      if (confirmBtn) {
        confirmBtn.disabled = false;
        confirmBtn.innerHTML = originalBtnText;
      }
    }
  }

  document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModal(); });
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>