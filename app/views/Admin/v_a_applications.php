<?php require_once APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="../public/css/components/Admin/style(Admin_Applications).css">

<div class="dashboard-applications">

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

        <div class="select">
          <div class="dashboard-items">
            <img src="../public/img/Admin/Dashboard/Applications.svg"/>
            Applications
          </div>
        </div>

        <button class="button" onclick="window.location.href='<?php echo URLROOT ?>/Admin/Complains'">         
          <div class="dashboard-items">
            <img src="../public/img/Admin/Dashboard/Complains.svg" />
            Complains
          </div>
        </button>

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
    <div class="table">
      <div class="button">
        <div class="frame-5">
          <div class="see-all">See all</div>
          <img class="icon-from-tabler-io" src="../public/img/Admin/Applications/icon-from-tabler-io0.svg" />
        </div>
      </div>
      <div class="div">......</div>
      <div class="frame-48096288">
        <div class="macro-lens-doc">MacroLens.doc</div>
        <div class="app-1032">App-1032</div>
        <div class="photographer">Photographer</div>
        <div class="macro-lens">MacroLens</div>
        <div class="avatar">
          <img class="images-1-1" src="../public/img/Admin/Applications/images-1-10.png" />
        </div>
        <div class="_3-hours-ago">3 hours ago</div>
        <div class="frame-480962882">
          <div class="pending">Pending</div>
        </div>
      </div>
      <div class="frame-48096293">
        <div class="monatch-doc">Monatch.doc</div>
        <div class="app-1027">App-1027</div>
        <div class="photographer">Photographer</div>
        <div class="monarch">Monarch</div>
        <div class="avatar">
          <img class="images-1-1" src="../public/img/Admin/Applications/images-1-11.png" />
        </div>
        <div class="_1-day-ago">1 day ago</div>
        <div class="frame-480962883">
          <div class="approved">Approved</div>
        </div>
      </div>
      <div class="frame-48096289">
        <div class="wisithuru-flora-jpg">WisithuruFlora.jpg</div>
        <div class="app-1031">App-1031</div>
        <div class="florist">Florist</div>
        <div class="wisithuru-flora">Wisithuru Flora</div>
        <div class="avatar">
          <img class="images-2-1" src="../public/img/Admin/Applications/images-2-10.png" />
        </div>
        <div class="_6-hours-ago">6 hours ago</div>
        <div class="frame-480962884">
          <div class="pending">Pending</div>
        </div>
      </div>
      <div class="frame-48096294">
        <div class="wijerathna-logi-jpg">WijerathnaLogi.jpg</div>
        <div class="app-1026">App-1026</div>
        <div class="transport-logistic">Transport &amp; Logistic</div>
        <div class="wijerathna-logistic">Wijerathna Logistic</div>
        <div class="avatar">
          <img class="images-2-1" src="../public/img/Admin/Applications/images-2-11.png" />
        </div>
        <div class="_2-days-ago">2 days ago</div>
        <div class="frame-480962885">
          <div class="rejected">Rejected</div>
        </div>
      </div>
      <button class="frame-48096287" onclick="window.location.href='<?php echo URLROOT ?>/Admin/Application_view'">
        <div class="avenra-hikkaduwa-pdf">Avenra Hikkaduwa.pdf</div>
        <div class="app-1033">App-1033</div>
        <div class="venue-halls">Venue &amp; Halls</div>
        <div class="avenra-hotels-hikkaduwa">
          Avenra Hotels,
          <br />
          Hikkaduwa
        </div>
        <div class="avatar">
          <img
            class="pngtree-pdf-file-icon-png-png-image-7965915-1"
            src="../public/img/Admin/Applications/pngtree-pdf-file-icon-png-png-image-7965915-10.png"
          />
        </div>
        <div class="_2-hours-ago">2 hours ago</div>
        <div class="frame-480962886">
          <div class="pending">Pending</div>
        </div>
      </button>
      <div class="frame-48096295">
        <div class="nisha-cake-pdf">Nisha Cake.pdf</div>
        <div class="app-1028">App-1028</div>
        <div class="cake-designer">Cake Designer</div>
        <div class="nisha-cake">Nisha Cake</div>
        <div class="avatar">
          <img
            class="pngtree-pdf-file-icon-png-png-image-7965915-1"
            src="../public/img/Admin/Applications/pngtree-pdf-file-icon-png-png-image-7965915-11.png"
          />
        </div>
        <div class="_23-hours-ago">23 hours ago</div>
        <div class="frame-480962887">
          <div class="approved">Approved</div>
        </div>
      </div>
      <div class="frame-48096290">
        <div class="leo-studio-pdf">Leo Studio.pdf</div>
        <div class="app-1029">App-1029</div>
        <div class="videographer">Videographer</div>
        <div class="leo-studio">Leo Studio</div>
        <div class="avatar">
          <img
            class="pngtree-pdf-file-icon-png-png-image-7965915-1"
            src="../public/img/Admin/Applications/pngtree-pdf-file-icon-png-png-image-7965915-12.png"
          />
        </div>
        <div class="_16-hours-ago">16 hours ago</div>
        <div class="frame-480962888">
          <div class="pending">Pending</div>
        </div>
      </div>
      <div class="frame-48096296">
        <div class="dj-russo-pdf">Dj Russo.pdf</div>
        <div class="app-1024">App-1024</div>
        <div class="dj-artist">Dj Artist</div>
        <div class="dj-russo">Dj Russo</div>
        <div class="avatar">
          <img
            class="pngtree-pdf-file-icon-png-png-image-7965915-1"
            src="../public/img/Admin/Applications/pngtree-pdf-file-icon-png-png-image-7965915-13.png"
          />
        </div>
        <div class="_8-hours-ago">8 hours ago</div>
        <div class="frame-480962889">
          <div class="approved">Approved</div>
        </div>
      </div>
      <div class="frame-48096292">
        <div class="ocean-view-pdf">Ocean View.pdf</div>
        <div class="app-1030">App-1030</div>
        <div class="venue-halls">Venue &amp; Halls</div>
        <div class="ocean-view-galle">
          Ocean View,
          <br />
          Galle
        </div>
        <div class="avatar">
          <img
            class="pngtree-pdf-file-icon-png-png-image-7965915-1"
            src="../public/img/Admin/Applications/pngtree-pdf-file-icon-png-png-image-7965915-14.png"
          />
        </div>
        <div class="_10-hours-ago">10 hours ago</div>
        <div class="frame-4809628810">
          <div class="pending">Pending</div>
        </div>
      </div>
      <div class="frame-48096297">
        <div class="blue-moon-resort-pdf">Blue Moon Resort.pdf</div>
        <div class="app-1025">App-1025</div>
        <div class="venue-halls">Venue &amp; Halls</div>
        <div class="blue-moon-resort-colombo">
          Blue Moon Resort,
          <br />
          Colombo
        </div>
        <div class="avatar">
          <img
            class="pngtree-pdf-file-icon-png-png-image-7965915-1"
            src="../public/img/Admin/Applications/pngtree-pdf-file-icon-png-png-image-7965915-15.png"
          />
        </div>
        <div class="_5-hours-ago">5 hours ago</div>
        <div class="frame-4809628811">
          <div class="approved">Approved</div>
        </div>
      </div>
      <div class="frame-48096286">
        <div class="app-id">App_ID</div>
        <div class="documentation">Documentation</div>
        <div class="sp-category">SP_Category</div>
        <div class="business-name">Business Name</div>
        <div class="date">Date</div>
        <div class="status">Status</div>
      </div>
      <div class="service-provider-applications">
        Service Provider Applications
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