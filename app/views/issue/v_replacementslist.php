<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/issue/taskbar/taskbar.php'; ?>
<link rel="stylesheet" href="../public/css/components/issueC/replacementslist.css" />

<?php require_once APPROOT . '/views/issue/sidebar/sidebar2.php'; ?>


  <!--<div class="replacements">
    <div class="frame-32">
      <img class="rectangle-21" src="../public/img/Issue/replacements/rectangle-210.pngrectangle-210.png" />
      <img class="vector" src="../public/img/Issue/replacements/vector0.svg" />
      <img
        class="phosphor-icons-chats-circle"
        src="../public/img/Issue/replacements/phosphor-icons-chats-circle0.svg"
      />
      <img class="vector2" src="../public/img/Issue/replacements/vector1.svg" />
      <div class="frame-48096275">
        <img class="group-40" src="../public/img/Issue/replacements/group-400.svg" />
      </div>
      <div class="frame-280">
        <div class="home">Home</div>
      </div>
      <img
        class="evo-plan-logo-new-removebg-preview-2"
        src="../public/img/Issue/replacements/evo-plan-logo-new-removebg-preview-20.png"
      />-->
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
                <div class="customer__org">Supermarket Villanova</div>
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
                <div class="customer__org">Supermarket Villanova</div>
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
                <div class="customer__org">Supermarket Villanova</div>
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
                <div class="customer__org">Supermarket Villanova</div>
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

    <!--<div class="component-13">
      <div class="collapse">
        <img class="collapse-icon" src="../public/img/Issue/replacements/collapse-icon0.svg" />
        <img class="vector3" src="../public/img/Issue/replacements/vector2.svg" />
      </div>
      <div class="frame-46-default">
        <div class="frame-36">
          <img
            class="phosphor-icons-squares-four"
            src="../public/img/Issue/replacements/phosphor-icons-squares-four0.svg"
          />
          <div class="dashboard">Dashboard</div>
        </div>
        <div class="frame-48096278">
          <div class="frame-51">
            <img
              class="phosphor-icons-git-diff"
              src="../public/img/Issue/replacements/phosphor-icons-git-diff0.svg"
            />
            <div class="replacements2">Replacements</div>
          </div>
        </div>
        <div class="frame-49">
          <img class="fether-icons-package" src="../public/img/Issue/replacements/fether-icons-package0.svg" />
          <div class="payments-adjustments">
            Payments
            <br />
            Adjustments
          </div>
        </div>
        <div class="frame-38">
          <img class="phosphor-icons-user" src="../public/img/Issue/replacements/phosphor-icons-user0.svg" />
          <div class="reports">Reports</div>
        </div>
        <div class="frame-50">
          <img
            class="phosphor-icons-paper-plane-right"
            src="../public/img/Issue/replacements/phosphor-icons-paper-plane-right0.svg"
          />
          <div class="reports-to-admin">Reports to Admin</div>
        </div>
      </div>
    </div>
  </div>
  

<?php require APPROOT . '/views/inc/footer.php'; ?>