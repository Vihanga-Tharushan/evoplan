<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/inc/clientsidebar/sidebar.php'; ?>

<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/components/client/event/completeEvent.css">

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
    if (!$sid) continue;
    if (!isset($providers[$sid])) {
        $providerName = trim($pkg->service_provider_name ?? '');
        if ($providerName === '') $providerName = 'Provider #' . $sid;
        $providers[$sid] = [
            'service_id' => $sid,
            'name' => $providerName,
            'role' => $pkg->serviceType ?? 'Service Provider',
            'items' => []
        ];
    }
    $providers[$sid]['items'][] = $pkg;
}

$startTs = !empty($event->start_datetime) ? strtotime($event->start_datetime) : null;
$endTs = !empty($event->end_datetime) ? strtotime($event->end_datetime) : null;
?>

<!-- Hero Section -->
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
            <div class="status-chip">✓ Event Confirmed</div>
        </div>
    </div>
</div>

<div class="container">
    <div class="main">

        <!-- Event Details Card -->
        <div class="card">
            <div class="card-header">
                <div class="icon">📋</div>
                <h2>Event Details</h2>
            </div>
            <div class="card-body">
                <div class="details-grid">
                    <div class="detail-item">
                        <label>Event Name</label>
                        <span><?php echo htmlspecialchars($event->event_name ?? '-'); ?></span>
                    </div>
                    <div class="detail-item">
                        <label>Event Type</label>
                        <span><?php echo htmlspecialchars($event->event_type ?? '-'); ?></span>
                    </div>
                    <div class="detail-item">
                        <label>Date</label>
                        <span><?php echo $startTs ? date('l, d M Y', $startTs) : '-'; ?></span>
                    </div>
                    <div class="detail-item">
                        <label>Time</label>
                        <span><?php echo $startTs ? date('g:i A', $startTs) : '-'; ?> - <?php echo $endTs ? date('g:i A', $endTs) : '-'; ?></span>
                    </div>
                    <div class="detail-item">
                        <label>Venue</label>
                        <span><?php echo htmlspecialchars($event->venue_address ?? '-'); ?></span>
                    </div>
                    <div class="detail-item">
                        <label>Guest Count</label>
                        <span><?php echo (int)($event->guest_count ?? 0); ?> Attendees</span>
                    </div>
                    <div class="detail-item">
                        <label>Venue Type</label>
                        <span><?php echo htmlspecialchars($event->venue_type ?? '-'); ?></span>
                    </div>
                    <div class="detail-item">
                        <label>Packages Selected</label>
                        <span><?php echo count($packages); ?></span>
                    </div>
                </div>
                <div class="detail-divider"></div>
                <div class="details-grid">
                    <div class="detail-item">
                        <label>Event Description</label>
                        <span><?php echo htmlspecialchars($event->event_description ?? '-'); ?></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Client Information Card -->
        <div class="card">
            <div class="card-header">
                <div class="icon">👤</div>
                <h2>Client Information</h2>
            </div>
            <div class="card-body">
                <div class="details-grid">
                    <div class="detail-item">
                        <label>Client Name</label>
                        <span><?php echo htmlspecialchars($clientName ?: '-'); ?></span>
                    </div>
                    <div class="detail-item">
                        <label>Email Address</label>
                        <span><?php echo htmlspecialchars($clientEmail ?: '-'); ?></span>
                    </div>
                    <div class="detail-item">
                        <label>Event ID</label>
                        <span class="mono">EVT-<?php echo str_pad((string)($event->event_id ?? 0), 5, '0', STR_PAD_LEFT); ?></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Service Providers Card -->
        <div class="card">
            <div class="card-header">
                <div class="icon">👥</div>
                <h2>Assigned Service Providers</h2>
            </div>
            <div class="card-body">
                <div class="providers-list">
                    <?php if (empty($providers)): ?>
                        <p style="color: var(--muted); text-align: center; padding: 20px;">No providers assigned for this event yet.</p>
                    <?php else: ?>
                        <?php foreach ($providers as $provider): ?>
                            <div class="provider-card">
                                <div class="provider-header">
                                    <div class="provider-avatar"><?php echo strtoupper(substr($provider['name'], 0, 2)); ?></div>
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

        <!-- Payment Status Card -->
        <div class="card">
            <div class="card-header">
                <div class="icon">💳</div>
                <h2>Payment Status</h2>
            </div>
            <div class="card-body">
                <div class="payment-grid">
                    <div class="pay-stat">
                        <label>Total Event Cost</label>
                        <div class="value">LKR <?php echo number_format($totalAmount, 2); ?></div>
                    </div>
                    <div class="pay-stat">
                        <label>Amount Paid</label>
                        <div class="value green">LKR <?php echo $isPaid ? number_format($totalAmount, 2) : '0.00'; ?></div>
                    </div>
                    <div class="pay-stat">
                        <label>Balance Due</label>
                        <div class="value">LKR <?php echo $isPaid ? '0.00' : number_format($totalAmount, 2); ?></div>
                    </div>
                </div>
                <div class="payment-rows">
                    <div class="pay-row">
                        <span class="label">Payment Status</span>
                        <span class="val"><?php echo $isPaid ? '✓ PAID' : 'Pending'; ?></span>
                    </div>
                    <div class="pay-row">
                        <span class="label">Event Reference</span>
                        <span class="val mono">EVT-<?php echo str_pad((string)($event->event_id ?? 0), 5, '0', STR_PAD_LEFT); ?></span>
                    </div>
                    <?php if ($isPaid && !empty($eventPin)): ?>
                        <div class="pay-row">
                            <span class="label">Event PIN</span>
                            <span class="val"><strong><?php echo htmlspecialchars($eventPin); ?></strong></span>
                        </div>
                    <?php endif; ?>
                    <div class="pay-row">
                        <span class="label">Last Updated</span>
                        <span class="val"><?php echo date('d M Y, h:i A'); ?></span>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Action Bar -->
    <div class="action-bar">
        <p class="action-note">
            ✓ Event confirmed and fully paid.<br>
            Contact support if you need to make changes or cancel this event.
        </p>
        <button class="btn-cancel" onclick="openCancelModal()">
            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="8" cy="8" r="6.5"/><path d="M5.5 5.5l5 5M10.5 5.5l-5 5"/>
            </svg>
            Cancel Event
        </button>
    </div>
</div>

<!-- Cancel Modal -->
<div class="modal-overlay" id="cancelModal" onclick="handleOverlayClick(event)">
    <div class="modal" id="modal">
        <div class="modal-header">
            <div style="display:flex;gap:12px;align-items:flex-start;flex:1;">
                <div class="modal-icon">
                    <svg viewBox="0 0 18 18" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="9" cy="9" r="7.5"/><path d="M9 5.5v4M9 12.5h.01"/>
                    </svg>
                </div>
                <div>
                    <p class="modal-title">Cancel Event</p>
                    <p class="modal-subtitle">This action cannot be undone. Please tell us why you're cancelling.</p>
                </div>
            </div>
            <button class="modal-close" onclick="closeCancelModal()">
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
                Cancelling may incur fees per the refund policy. All assigned service providers will be notified.
            </div>
            <label class="field-label">Cancellation Reason <span style="color: var(--danger);">*</span></label>
            <textarea id="cancelReason" placeholder="Please describe why you are cancelling this event…" maxlength="500" oninput="updateCharCount()"></textarea>
            <p class="char-count"><span id="charCount">0</span> / 500</p>
        </div>
        <div class="modal-footer">
            <button class="btn-ghost" onclick="closeCancelModal()">Keep Event</button>
            <button class="btn-confirm-cancel" onclick="confirmCancelEvent()">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="8" cy="8" r="6.5"/><path d="M5.5 5.5l5 5M10.5 5.5l-5 5"/>
                </svg>
                Confirm Cancellation
            </button>
        </div>
    </div>
</div>

<script>
function openCancelModal() {
    document.getElementById('cancelModal').classList.add('active');
}

function closeCancelModal() {
    document.getElementById('cancelModal').classList.remove('active');
    document.getElementById('cancelReason').value = '';
    updateCharCount();
}

function handleOverlayClick(e) {
    if (e.target === document.getElementById('cancelModal')) {
        closeCancelModal();
    }
}

function updateCharCount() {
    const textarea = document.getElementById('cancelReason');
    document.getElementById('charCount').textContent = textarea.value.length;
}

function confirmCancelEvent() {
    const reason = document.getElementById('cancelReason').value.trim();
    
    if (!reason) {
        const textarea = document.getElementById('cancelReason');
        textarea.focus();
        textarea.style.borderColor = 'rgba(239, 68, 68, 0.7)';
        textarea.style.boxShadow = '0 0 0 3px rgba(239, 68, 68, 0.1)';
        setTimeout(() => {
            textarea.style.borderColor = '';
            textarea.style.boxShadow = '';
        }, 1500);
        return;
    }
    
    closeCancelModal();
    alert('Event cancellation submitted successfully.\nReason: ' + reason + '\n\nYou will receive a confirmation email shortly.');
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeCancelModal();
    }
});
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>