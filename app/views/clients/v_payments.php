<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php
$backUrl = URLROOT . '/Clients/createEvent';
require_once APPROOT . '/views/inc/clientTaskbar/clientTaskbarBack.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/components/client/payments.css">
  <!-- Page -->
  <main class="page">
    <div class="columns">
      <!-- Left: Payment methods -->
      <section class="card card--grow" style="margin-top: 70px;">
        <h2 class="title">Payment Methods</h2>

        <!-- <div class="pm-row">
          <div class="pm-left">
            <div class="pm-icon pm-icon--blue" aria-hidden="true">
              <svg viewBox="0 0 24 24"><rect x="2" y="5" width="20" height="14" rx="2" ry="2" fill="currentColor"/></svg>
            </div>
            <div class="pm-info">
              <div class="pm-number">•••• •••• •••• 424</div>
              <div class="muted">Expires 12/25</div>
            </div>
          </div>
          <button class="chip chip--soft">Primary</button>
        </div>

        <div class="pm-row">
          <div class="pm-left">
            <div class="pm-icon pm-icon--green" aria-hidden="true">
              <svg viewBox="0 0 24 24"><rect x="2" y="5" width="20" height="14" rx="2" ry="2" fill="currentColor"/></svg>
            </div>
            <div class="pm-info">
              <div class="pm-number">•••• •••• •••• 5555</div>
              <div class="muted">Expires 08/26</div>
            </div>
          </div>
          <button class="chip">Remove</button>
        </div> -->

      <?php if (!empty($data['methods'])): ?>
  <?php foreach ($data['methods'] as $method): ?>
    <div class="pm-row">
      <div class="pm-left">
        <div class="pm-icon pm-icon--blue">
          <svg viewBox="0 0 24 24"><rect x="2" y="5" width="20" height="14" rx="2" ry="2" fill="currentColor"/></svg>
        </div>
        <div class="pm-info">
          <div class="pm-number">•••• •••• •••• <?=htmlspecialchars(substr($method->card_number, -4))?></div>
          <div class="muted">Expires <?=date('m/y', strtotime($method->expiry_date))?></div>
        </div>
      </div>
      <div>
        <button class="chip btn--green" onclick="location.href='<?php echo URLROOT; ?>/Cards/addmethodup?cid=<?=htmlspecialchars($method->card_id)?>'">Update</button>
        <button class="chip btn--red" onclick="confirmRemove(<?=htmlspecialchars($method->card_id)?>)">Remove</button>
      </div>
    </div>
  <?php endforeach; ?>
<?php else: ?>
  <p>No payment methods found.</p>
<?php endif; ?>


        <div class="note">
          <h4>Service Provider Integration</h4>
          <p>Payments should be processed according to selected service providers and their specific requirements.</p>
        </div>

        <a class="btn btn--dark mt" onclick="location.href='<?php echo URLROOT; ?>/Cards/addmethod'">
          <svg class="icon" viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="14" rx="2" ry="2" fill="none" stroke="currentColor" stroke-width="2"/><path d="M7 10h10" fill="none" stroke="currentColor" stroke-width="2"/></svg>
          Add Payment Method
        </a>
        <a class="btn btn--dark mt" style="text-align: center;" onclick="location.href='<?php echo URLROOT; ?>/Clients/complains'">
          Complains
        </a>
      </section>

      <!-- Right: Payment info -->
      <aside class="card card--side">
        <h3 class="sub">Payment Info</h3>

        <div class="kv">
          <div class="k">Current Plan</div>
          <div class="v"><span class="pill">Pro</span></div>
        </div>

        <div class="kv">
          <div class="k">Final Payment</div>
          <div class="v price">Rs. 110 000</div>
        </div>

        <div class="kv">
          <div class="k">Bill Date</div>
          <div class="v">Aug 30, 2025</div>
        </div>

        <div class="kv">
          <div class="k">Payment Method</div>
          <div class="v">Credit Card</div>
        </div>

        <div class="kv">
          <div class="k">Billing Address</div>
          <div class="v">123 Main St, Colombo</div>
        </div>
      </aside>
    </div>
  </main>
<?php require APPROOT . '/views/inc/footer.php';?>

<script>
function confirmRemove(cardId) {
    if (confirm('Are you sure you want to remove this payment method?')) {
        window.location.href = '<?php echo URLROOT; ?>/Cards/removemethod?cid=' + cardId;
    }
}
</script>