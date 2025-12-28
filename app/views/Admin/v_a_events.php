<?php require_once APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="../public/css/components/Admin/style(Admin_Events).css">

<div class="dashboard-events">

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

        <div class="select">
          <div class="dashboard-items">
            <img src="../public/img/Admin/Dashboard/Events.svg"/>
            Events
          </div>
        </div>

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
          <div>See all</div>
          <img class="icon-from-tabler-io" src="../public/img/Admin/Events/icon-from-tabler-io0.svg" />
        </div>
      </div>
      <div class="div">......</div>

      <div class="frame-480962875">
        <div class="event-id2">Event_ID</div>
        <div class="client-id">Client_ID</div>
        <div class="event-category">Event_Category</div>
        <div class="date">Date</div>
        <div class="status">Status</div>
      </div>

      <div class="frame-48096287">
        <div class="evt-2031">Evt-2031</div>
        <div class="c-2453">C-0099</div>
        <div class="birthday">Birthday</div>
        <div class="_2025-11-05">2025/11/05</div>
        <div class="frame-48096288">
          <div class="up-coming">Up Coming</div>
        </div>
      </div>
      <div class="frame-480962882">
        <div class="evt-2031">Evt-2030</div>
        <div class="c-2453">C-0664</div>
        <div class="birthday">Wedding</div>
        <div class="_2025-11-05">2025/11/03</div>
        <div class="frame-48096288">
          <div class="up-coming">Up Coming</div>
        </div>
      </div>
      <div class="frame-48096289">
        <div class="evt-2031">Evt-2029</div>
        <div class="c-2453">C-2453</div>
        <div class="birthday">Fam Party</div>
        <div class="_2025-11-05">2025/10/31</div>
        <div class="frame-48096288">
          <div class="up-coming">Up Coming</div>
        </div>
      </div>
      <div class="frame-48096290">
        <div class="evt-2031">Evt-2028</div>
        <div class="c-2453">C-0864</div>
        <div class="birthday">Anniversary</div>
        <div class="_2025-11-05">2025/10/29</div>
        <div class="frame-48096288">
          <div class="up-coming">Up Coming</div>
        </div>
      </div>
      <div class="frame-48096291">
        <div class="evt-2031">Evt-2027</div>
        <div class="c-2453">C-0929</div>
        <div class="birthday">Birthday</div>
        <div class="_2025-11-05">2025/10/26</div>
        <div class="frame-48096288">
          <div class="up-coming">Up Coming</div>
        </div>
      </div>
      <div class="frame-48096292">
        <div class="evt-2031">Evt-2026</div>
        <div class="c-2453">C-0042</div>
        <div class="birthday">Party</div>
        <div class="_2025-11-05">2025/10/23</div>
        <div class="frame-480962883">
          <div class="in-progress">In-progress</div>
        </div>
      </div>
      <div class="frame-48096293">
        <div class="evt-2031">Evt-2025</div>
        <div class="c-2453">C-2632</div>
        <div class="birthday">Birthday</div>
        <div class="_2025-11-05">2025/10/23</div>
        <div class="frame-480962883">
          <div class="in-progress">In-progress</div>
        </div>
      </div>
      <div class="frame-48096294">
        <div class="evt-2031">Evt-2024</div>
        <div class="c-2453">C-0531</div>
        <div class="birthday">Wedding</div>
        <div class="_2025-11-05">2025/10/20</div>
        <div class="frame-480962884">
          <div class="completed">Completed</div>
        </div>
      </div>
      <div class="frame-48096295">
        <div class="evt-2031">Evt-2023</div>
        <div class="c-2453">C-2456</div>
        <div class="birthday">Birthday</div>
        <div class="_2025-11-05">2025/10/17</div>
        <div class="frame-480962884">
          <div class="completed">Completed</div>
        </div>
      </div>
      <div class="frame-48096296">
        <div class="evt-2031">Evt-2022</div>
        <div class="c-2453">C-1053</div>
        <div class="birthday">Birthday</div>
        <div class="_2025-11-05">2025/10/15</div>
        <div class="frame-480962885">
          <div class="cancelled">Cancelled</div>
        </div>
      </div>
      <div class="events">Events</div>
    </div>

    <div class="frame-480962886">
      <div class="search-events">Search Events</div>
      <div class="search-bar">
        <div class="rectangle-24"></div>
        <div class="rectangle-25"></div>
        <div class="event-id">Event ID</div>
        <img
          class="pngwing-com-2025-08-10-t-210607-925-1"
          src="../public/img/Admin/Events/pngwing-com-2025-08-10-t-210607-925-10.png"
        />
      </div>
      <div class="frame-48096286">
        <div class="event-id2">Event_ID</div>
        <div class="event-category">Event_Category</div>
        <div class="client-id">Client _ID</div>
        <div class="date">Date</div>
        <div class="status">Status</div>
      </div>
    </div>
    
    <div class="frame-31">
      <button class="logout-btn" onclick="window.location.href='<?php echo URLROOT ?>/Admin/main_page'">Log Out</button>
      <img
        class="evo-plan-logo-new-removebg-preview-2"
        src="../public/img/Admin/Events/evo-plan-logo-new-removebg-preview-20.png"
      />
    </div>
  </div>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>