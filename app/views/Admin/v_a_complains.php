<?php require_once APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="../public/css/components/Admin/style(Admin_Complains).css">

<div class="dashboard-complains">

    <div class="dashboard">
      <div class="dashboard-frame">

        <button class="button" onclick="window.location.href='<?php echo URLROOT ?>/Admin/Stats'">         
          <div class="dashboard-items">
            <img src="../public/img/Admin/Dashboard/Stats.svg" />
            Stats
          </div>
        </button>

        <button class="button" onclick="window.location.href='<?php echo URLROOT ?>/Admin/Payments'">         
          <div class="dashboard-items">
            <img src="../public/img/Admin/Dashboard/Payments.svg" />
            Payments
          </div>
        </button>

        <button class="button" onclick="window.location.href='<?php echo URLROOT ?>/Admin/Applications'">         
          <div class="dashboard-items">
            <img src="../public/img/Admin/Dashboard/Applications.svg" />
            Applications
          </div>
        </button>

        <div class="select">
          <div class="dashboard-items">
            <img src="../public/img/Admin/Dashboard/Complains.svg"/>
            Complains
          </div>
        </div>

        <button class="button" onclick="window.location.href='<?php echo URLROOT ?>/Admin/Profiles'">
            <div class="dashboard-items">
              <img src="../public/img/Admin/Dashboard/Profiles.svg" />
              Profiles
            </div>
        </button>
          
        <button class="button" onclick="window.location.href='<?php echo URLROOT ?>/Admin/Events'">
            <div class="dashboard-items">
              <img src="../public/img/Admin/Dashboard/Events.svg" />
              Events
            </div>
        </button>

        <button class="button" onclick="window.location.href='<?php echo URLROOT ?>/Admin/Feedbacks'">
            <div class="dashboard-items">
              <img src="../public/img/Admin/Dashboard/Feedbacks.svg"/>
              Feedbacks
            </div>
        </button>

        <button class="button" onclick="window.location.href='<?php echo URLROOT ?>/Admin/Admins'">
            <div class="dashboard-items">
              <img src="../public/img/Admin/Dashboard/Admins.svg"/>
              Admins &amp; <br /> Coordinators
            </div>
        </button>

      </div>
    </div>

    <div class="frame-48096286">
      <div class="service-provider-complains">Service Provider Complains</div>
      <div class="frame-480962862">
        <div class="complain-id">Complain_ID</div>
        <div class="subject">Subject</div>
        <div class="category">Category</div>
        <div class="service-provider">Service Provider</div>
        <div class="date">Date</div>
        <div class="status">Status</div>
      </div>
      <div class="frame-48096287">
        <div class="csp-1558">CSP-1558</div>
        <div class="stats-missing">Stats missing</div>
        <div class="system">System</div>
        <div class="frame-9">
          <div class="maggie-johnson">Shanika Perera</div>
          <div class="supermarket-villanova">Amari Supermarket</div>
        </div>
        <div class="avatar">
          <img class="rectangle-1" src="../public/img/Admin/Complains/rectangle-10.png" />
        </div>
        <div class="_2-hours-ago">2 hours ago</div>
        <div class="frame-48096288">
          <div class="new">New</div>
        </div>
      </div>
      <div class="frame-480962882">
        <div class="csp-1557">CSP-1557</div>
        <div class="payment-fail">Payment fail</div>
        <div class="payment">Payment</div>
        <div class="frame-9">
          <div class="maggie-johnson">Shanika Perera</div>
          <div class="supermarket-villanova">Amari Supermarket</div>
        </div>
        <div class="avatar">
          <img class="rectangle-1" src="../public/img/Admin/Complains/rectangle-11.png" />
        </div>
        <div class="_2-days-ago">2 days ago</div>
        <div class="frame-48096288">
          <div class="new">New</div>
        </div>
      </div>
      <div class="frame-48096289">
        <div class="csp-1556">CSP-1556</div>
        <div class="payment-fail">Payment fail</div>
        <div class="payment">Payment</div>
        <div class="frame-9">
          <div class="maggie-johnson">Shanika Perera</div>
          <div class="supermarket-villanova">Amari Supermarket</div>
        </div>
        <div class="avatar">
          <img class="rectangle-1" src="../public/img/Admin/Complains/rectangle-12.png" />
        </div>
        <div class="_1-week-ago">1 week ago</div>
        <div class="frame-480962883">
          <div class="new">New</div>
        </div>
      </div>
      <div class="frame-48096290">
        <div class="csp-1555">CSP-1555</div>
        <div class="stats-missing">Stats missing</div>
        <div class="system">System</div>
        <div class="frame-9">
          <div class="maggie-johnson">Shanika Perera</div>
          <div class="supermarket-villanova">Amari Supermarket</div>
        </div>
        <div class="avatar">
          <img class="rectangle-1" src="../public/img/Admin/Complains/rectangle-13.png" />
        </div>
        <div class="_1-week-ago">1 week ago</div>
        <div class="frame-480962884">
          <div class="resolved">Resolved</div>
        </div>
      </div>
      <div class="div">......</div>
      <div class="frame-4">
        <div class="frame-5">
          <div class="see-all">See all</div>
          <img class="icon-from-tabler-io" src="../public/img/Admin/Complains/icon-from-tabler-io0.svg" />
        </div>
      </div>
    </div>
    <div class="frame-48096285">
      <div class="client-complains">Client Complains</div>
      <div class="frame-480962862">
        <div class="complain-id2">Complain_ID</div>
        <div class="subject">Subject</div>
        <div class="category">Category</div>
        <div class="customer">Customer</div>
        <div class="date">Date</div>
        <div class="status">Status</div>
      </div>
      <button class="frame-48096287" onclick="window.location.href='<?php echo URLROOT ?>/Admin/complain_view'">
        <div class="cc-4259">CC-4259</div>
        <div class="one-album-is-missing">One album is missing</div>
        <div class="product-defect">Product Defect</div>
        <div class="frame-9">
          <div class="maggie-johnson">Shanika Perera</div>
          <div class="supermarket-villanova">Amari Supermarket</div>
        </div>
        <div class="avatar">
          <img class="rectangle-1" src="../public/img/Admin/Complains/rectangle-14.png" />
        </div>
        <div class="_2-hours-ago">2 hours ago</div>
        <div class="frame-48096288">
          <div class="new">New</div>
        </div>
      </button>
      <div class="frame-480962882">
        <div class="cc-4258">CC-4258</div>
        <div class="one-album-is-missing">One album is missing</div>
        <div class="product-defect">Product Defect</div>
        <div class="frame-9">
          <div class="maggie-johnson">Shanika Perera</div>
          <div class="supermarket-villanova">Amari Supermarket</div>
        </div>
        <div class="avatar">
          <img class="rectangle-1" src="../public/img/Admin/Complains/rectangle-15.png" />
        </div>
        <div class="_2-days-ago">2 days ago</div>
        <div class="frame-48096288">
          <div class="new">New</div>
        </div>
      </div>
      <div class="frame-48096289">
        <div class="cc-4257">CC-4257</div>
        <div class="one-album-is-missing">One album is missing</div>
        <div class="service">Service</div>
        <div class="frame-9">
          <div class="maggie-johnson">Shanika Perera</div>
          <div class="supermarket-villanova">Amari Supermarket</div>
        </div>
        <div class="avatar">
          <img class="rectangle-1" src="../public/img/Admin/Complains/rectangle-16.png" />
        </div>
        <div class="_1-week-ago">1 week ago</div>
        <div class="frame-480962883">
          <div class="new">New</div>
        </div>
      </div>
      <div class="frame-48096290">
        <div class="cc-4256">CC-4256</div>
        <div class="one-album-is-missing">One album is missing</div>
        <div class="product-defect">Product Defect</div>
        <div class="frame-9">
          <div class="maggie-johnson">Shanika Perera</div>
          <div class="supermarket-villanova">Amari Supermarket</div>
        </div>
        <div class="avatar">
          <img class="rectangle-1" src="../public/img/Admin/Complains/rectangle-17.png" />
        </div>
        <div class="_1-week-ago">1 week ago</div>
        <div class="frame-480962884">
          <div class="resolved">Resolved</div>
        </div>
      </div>
      <div class="div">......</div>
      <div class="frame-4">
        <div class="frame-5">
          <div class="see-all">See all</div>
          <img class="icon-from-tabler-io2" src="../public/img/Admin/Complains/icon-from-tabler-io1.svg" />
        </div>
      </div>
    </div>

    <div class="frame-31">
      <button class="logout-btn" onclick="window.location.href='<?php echo URLROOT ?>/Admin/main_page'">Log Out</button>
      <button class=btn_to_mainPage > 
        <img class="evo-plan-logo-new-removebg-preview-2" src="../public/img/Admin/Stats/evo-plan-logo-new-removebg-preview-20.png" />
      </button>
    </div>
  </div>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>