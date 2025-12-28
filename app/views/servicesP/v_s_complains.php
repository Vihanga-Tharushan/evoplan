<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/inc/components/sidebar/sidebar6.php'; ?>
<?php require_once APPROOT . '/views/inc/components/taskbar/taskbar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/components/servicesP/s_complains.css">

<!-- Metric Card -->
<div class="metric-card" role="group" aria-labelledby="metric-title-complains" style=" left: 300px;
  top: 100px;">
  <h3 id="metric-title-complains" class="metric-card__title">Number of Complains</h3>
  <div class="metric-card__value">15</div>
  <p class="metric-card__note">Increase compared to last week</p>
</div>


<div class="metric-card" role="group" aria-labelledby="metric-title-complains" style="left: 600px; top: -45px;">
  <h3 id="metric-title-complains" class="metric-card__title">User Complains</h3>
  <div class="metric-card__value">10</div>
  <p class="metric-card__note">Increase compared to last week</p>

</div>

<div class="metric-card" role="group" aria-labelledby="metric-title-complains" style=" left: 900px; top: -190px;">
  <h3 id="metric-title-complains" class="metric-card__title">Admin Complains</h3>
  <div class="metric-card__value">5</div>
  <p class="metric-card__note">Increase compared to last week</p>

</div>


<!-- Recent Complains Card -->
<section class="complaints-card" role="region" aria-labelledby="complaints-title">
  <header class="complaints-card__header">
    <h3 id="complaints-title" class="complaints-card__title">Recent Complains</h3>
  </header>

  <div class="complaints-card__table-wrap">
    <table class="complaints-table">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Subject</th>
          <th scope="col">Category</th>
          <th scope="col">Customer</th>
          <th scope="col">Date</th>
          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>#CMP-4256</td>
          <td>One album is missing</td>
          <td><strong>Product Defect</strong></td>
          <td>
            <div class="customer">
              <img class="customer__avatar" src="https://i.pravatar.cc/40?img=11" alt="Avatar of Maggie Johnson">
              <div>
                <div class="customer__name">Maggie Johnson</div>
              </div>
            </div>
          </td>
          <td>2 hours ago</td>
          <td><span class="status status--new">New</span></td>
        </tr>

        <tr>
          <td>#CMP-4256</td>
          <td>One album is missing</td>
          <td><strong>Product Defect</strong></td>
          <td>
            <div class="customer">
              <img class="customer__avatar" src="https://i.pravatar.cc/40?img=22" alt="Avatar of Maggie Johnson">
              <div>
                <div class="customer__name">Maggie Johnson</div>
              </div>
            </div>
          </td>
          <td>2 days ago</td>
          <td><span class="status status--inprogress">In Progress</span></td>
        </tr>

        <tr>
          <td>#CMP-4256</td>
          <td>One album is missing</td>
          <td><strong>Service</strong></td>
          <td>
            <div class="customer">
              <img class="customer__avatar" src="https://i.pravatar.cc/40?img=33" alt="Avatar of Maggie Johnson">
              <div>
                <div class="customer__name">Maggie Johnson</div>
              </div>
            </div>
          </td>
          <td>1 week ago</td>
          <td><span class="status status--resolved">Resolved</span></td>
        </tr>

        <tr>
          <td>#CMP-4256</td>
          <td>One album is missing</td>
          <td><strong>Product Defect</strong></td>
          <td>
            <div class="customer">
              <img class="customer__avatar" src="https://i.pravatar.cc/40?img=44" alt="Avatar of Maggie Johnson">
              <div>
                <div class="customer__name">Maggie Johnson</div>
              </div>
            </div>
          </td>
          <td>1 week ago</td>
          <td><span class="status status--inprogress">In Progress</span></td>
        </tr>

        <!-- Ellipsis row -->
        <tr class="ellipsis-row" aria-hidden="true">
          <td colspan="6">......</td>
        </tr>
      </tbody>
    </table>
  </div>

  <footer class="complaints-card__footer">
    <a href="#" class="complaints-card__link">See all →</a>
  </footer>
</section>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>