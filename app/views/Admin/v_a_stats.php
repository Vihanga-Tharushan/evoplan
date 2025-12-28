<?php require_once APPROOT . '/views/inc/header.php'; ?>
    <link rel="stylesheet" href="../public/css/components/Admin/style(Admin_Stats).css">

    <div class="dashboard-stats">

    <div class="dashboard">
      <div class="dashboard-frame">

        <div class="select">
          <div class="dashboard-items">
            <img src="../public/img/Admin/Dashboard/Stats.svg"/>
            Stats
          </div>
        </div>

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


    <div class="row">
      <div class="rows">
        <div class="widget">
          <div class="heading">
            <div class="growth">Income Overview</div>
          </div>
          <div class="chart">
            <img src="../public/img/Admin/Stats/Graph1.svg" />
          </div>
        </div>
        
      </div>
    </div>

    <div class="row3">
      <div class="rows">
        <div class="widget">
          <div class="heading">
            <div class="growth">User Growth Summery</div>
          </div>
          <div class="chart">
            <img src="../public/img/Admin/Stats/Graph2.svg" />
          </div>
        </div>
        
      </div>
    </div>

    <!-- <div class="row3">

      <div class="frame-12">
          <div class="widget2">
            <div class="top-month">Top month</div>
            <div class="frame-26">
              <div class="november">September</div>
              <div class="_20192">2023</div>
            </div>
          </div>
          <div class="widget3">
            <div class="top-year">Top year</div>
            <div class="frame-262">
              <div class="_20232">2023</div>
              <div class="_96-k-sold-so-far">96K</div>
            </div>
          </div>
          <div class="widget3">
            <div class="top-service-provider">Top Service Provider</div>
            <div class="frame-263">
              <div class="avatar">
                <img class="rectangle-1" src="../public/img/Admin/Stats/rectangle-10.png" />
              </div>
              <div class="frame-9">
                <div class="maggie-johnson">Sachini Tharuka</div>
              </div>
            </div>
          </div>
          <div class="widget3">
            <div class="top-client">Top Client</div>
            <div class="frame-263">
              <div class="avatar">
                <img class="rectangle-1" src="../public/img/Admin/Stats/rectangle-11.png" />
              </div>
              <div class="frame-9">
                <div class="maggie-johnson">Hasarangi de Silva</div>
                <div class="oasis-organic-inc">Photographer</div>
              </div>
            </div>
          </div>
        </div>

    </div> -->

    <!-- <div class="rows2">
      <div class="widget">
        <div class="heading">
          <div class="earnings">Users Growth Summery</div>
        </div>
        <div class="chart">
          <img src="../public/img/Admin/Stats/Graph2.svg" />
        </div>
      </div>
    </div> -->

    <div class="aged-pie-chart">
      <!-- <div class="year">Year</div>
      <div class="frame-48096276">
        <div class="text"></div>
        <img class="arrow-drop-up" src="../public/img/Admin/Stats/arrow-drop-up0.svg" />
        <div class="_20233">2023</div>
      </div>
      <div class="month">Month</div>
      <div class="frame-480962762">
        <div class="january">January</div>
        <img class="arrow-drop-up2" src="../public/img/Admin/Stats/arrow-drop-up1.svg" />
      </div> -->
      <div class="title2">Clients based on Age Groups</div>
      <img class="ellipse-8" src="../public/img/Admin/Stats/Chart1.png" />
      <div class="key">
        <div class="_502">50+</div>
        <div class="_8">8%</div>
        <div class="ellipse-61"></div>
        <div class="_36-502">36 - 50</div>
        <div class="_22">22%</div>
        <div class="ellipse-612"></div>
        <div class="_26-352">26 - 35</div>
        <div class="_38">38%</div>
        <div class="ellipse-613"></div>
        <div class="_18-252">18 - 25</div>
        <div class="_32">32%</div>
        <div class="ellipse-614"></div>
      </div>
    </div>

    <div class="gender-pie-chart">
      <!-- <div class="year2">Year</div>
      <div class="frame-480962763">
        <div class="_20233">2023</div>
        <img class="arrow-drop-up3" src="../public/img/Admin/Stats/arrow-drop-up2.svg" />
      </div>
      <div class="month2">Month</div>
      <div class="frame-480962764">
        <div class="january2">January</div>
        <img class="arrow-drop-up4" src="../public/img/Admin/Stats/arrow-drop-up3.svg" />
      </div> -->
      <div class="title3">Clients based on Gender</div>
      <img class="ellipse-7" src="../public/img/Admin/Stats/Chart2.png" />
      <div class="key2">
        <div class="others">Others</div>
        <div class="_3">3%</div>
        <div class="ellipse-615"></div>
        <div class="male">Male</div>
        <div class="_40">40%</div>
        <div class="ellipse-616"></div>
        <div class="female">Female</div>
        <div class="_57">57%</div>
        <div class="ellipse-617"></div>
      </div>
    </div>
    
    <div class="clients-stats">Clients Stats</div>

    <div class="frame-31">
      
      <button class="logout-btn" onclick="window.location.href='<?php echo URLROOT ?>/Admin/main_page'">Log Out</button>

      <button class=btn_to_mainPage > 
        <img class="evo-plan-logo-new-removebg-preview-2" src="../public/img/Admin/Stats/evo-plan-logo-new-removebg-preview-20.png" />
      </button>

    </div>
  </div>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>