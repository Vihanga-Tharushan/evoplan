<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/inc/clientsidebar/sidebar.php'; ?>

<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/components/client/postpayment.css">

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
$isCancelled = strtoupper((string)($event->progress_step ?? '')) === 'CANCELLED';
$statusLabel = $isCancelled ? 'Event Cancelled' : 'Event Completed';
$statusHint = $isCancelled ? 'This event was cancelled.' : 'This event has ended.';
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
      <div class="status-chip"><?php echo htmlspecialchars($statusLabel); ?></div>
    </div>
  </div>
</div>

<div class="main">

  <!-- Event Details -->
  <div class="card">
    <div class="card-header"><div class="icon"><i class="fa-solid fa-file-lines"></i></div><h2>Event Details</h2></div>
    <div class="card-body">
      <div class="payment-grid event-details-grid">
        <div class="pay-stat">
          <span class="label">Client Name</span>
          <div class="value event-value"><?php echo htmlspecialchars($clientName ?: '-'); ?></div>
        </div>
        <div class="pay-stat">
          <span class="label">Client Contact</span>
          <div class="value event-value"><?php echo htmlspecialchars($clientEmail ?: '-'); ?></div>
        </div>
        <div class="pay-stat">
          <span class="label">Packages Selected</span>
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
    <div class="card-header"><div class="icon"><i class="fa-solid fa-people-group"></i></div><h2>Assigned Service Providers</h2></div>
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
                        <p class="service-desc"><?php echo htmlspecialchars($item->package_details ?? ''); ?></p>
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
    <div class="card-header"><div class="icon"><i class="fa-solid fa-credit-card"></i></div><h2>Payment Status</h2></div>
    <div class="card-body">
      <div class="payment-grid">
        <div class="pay-stat"><span class="label">Total Event Cost</span><div class="value">LKR <?php echo number_format($totalAmount, 2); ?></div></div>
        <div class="pay-stat"><span class="label">Amount Paid</span><div class="value green">LKR <?php echo $isPaid ? number_format($totalAmount, 2) : number_format(0, 2); ?></div></div>
        <div class="pay-stat"><span class="label">Balance Due</span><div class="value">LKR <?php echo $isPaid ? number_format(0, 2) : number_format($totalAmount, 2); ?></div></div>
      </div>
      <div class="payment-rows">
        <div class="pay-row"><span class="label">Event Status</span><span class="val"><?php echo htmlspecialchars($statusLabel); ?></span></div>
        <div class="pay-row"><span class="label">Payment Status</span><span class="val"><?php echo $isPaid ? 'PAID' : 'Pending'; ?></span></div>
        <?php if ($isPaid && !empty($eventPin)): ?>
          <div class="pay-row"><span class="label">Event PIN</span><span class="val"><strong><?php echo htmlspecialchars($eventPin); ?></strong></span></div>
        <?php endif; ?>
        <div class="pay-row"><span class="label">Last Updated</span><span class="val"><?php echo !empty($event->updated_at) ? date('d M Y, h:i A', strtotime($event->updated_at)) : date('d M Y, h:i A'); ?></span></div>
      </div>
    </div>
  </div>

</div>

<!-- Action Bar -->
<div class="action-bar">
  <p class="action-note">
    <?php echo htmlspecialchars($statusHint); ?> View your event breakdown and provider details here.<br>
    Need any help? Contact support for records and follow-up actions.
  </p>
  <a class="btn-cancel" href="<?php echo URLROOT; ?>/clients/myevents" style="text-decoration:none;">
    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
      <path d="M10.5 3.5L5.5 8l5 4.5"/><path d="M6 8h6"/>
    </svg>
    Back To My Events
  </a>
</div>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>
