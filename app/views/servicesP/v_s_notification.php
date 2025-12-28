<?php require APPROOT . '/views/inc/header.php'; ?>
<?php
$backUrl = URLROOT . '/Service/dashboard';
require_once APPROOT . '/views/inc/components/taskbar/taskbar_back.php';
?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/components/servicesP/s_notification.css">

<section class="cmp-page" aria-label="Complaints list">
  <div class="cmp-frame">
    <h1 class="cmp-title">Complaints</h1>

    <div class="cmp-panel">
      <ul class="cmp-list" role="list">
        <!-- Row 1 -->
        <li class="cmp-item">
          <a class="cmp-hit" href="#cmp-4256-1" aria-label="Open complaint CMP-4256">
            <div class="cmp-id">#CMP-4256</div>
            <div class="cmp-subject">One album is missing</div>

            <div class="cmp-customer">
              <img class="avatar" src="https://i.pravatar.cc/40?img=21" alt="">
              <div>
                <div class="name">Maggie Johnson</div>
                <div class="org">Supermarket Villanova</div>
              </div>
            </div>

            <div class="cmp-time">2 hours ago</div>
            <div class="cmp-status"><span class="pill pill--new">New</span></div>
          </a>
        </li>

        <!-- Row 2 -->
        <li class="cmp-item">
          <a class="cmp-hit" href="#cmp-4256-2">
            <div class="cmp-id">#CMP-4256</div>
            <div class="cmp-subject">One album is missing</div>

            <div class="cmp-customer">
              <img class="avatar" src="https://i.pravatar.cc/40?img=12" alt="">
              <div>
                <div class="name">Gael Harry</div>
                <div class="org">New York Finest Fruits</div>
              </div>
            </div>

            <div class="cmp-time">2 hours ago</div>
            <div class="cmp-status"><span class="pill pill--new">New</span></div>
          </a>
        </li>

        <!-- Row 3 -->
        <li class="cmp-item">
          <a class="cmp-hit" href="#cmp-4256-3">
            <div class="cmp-id">#CMP-4256</div>
            <div class="cmp-subject">One album is missing</div>

            <div class="cmp-customer">
              <img class="avatar" src="https://i.pravatar.cc/40?img=8" alt="">
              <div>
                <div class="name">Ralph Edwards</div>
                <div class="org">New York Finest Fruits</div>
              </div>
            </div>

            <div class="cmp-time">2 hours ago</div>
            <div class="cmp-status"><span class="pill pill--new">New</span></div>
          </a>
        </li>

        <li class="cmp-item">
          <a class="cmp-hit" href="#cmp-4256-1" aria-label="Open complaint CMP-4256">
            <div class="cmp-id">#CMP-4256</div>
            <div class="cmp-subject">One album is missing</div>

            <div class="cmp-customer">
              <img class="avatar" src="https://i.pravatar.cc/40?img=21" alt="">
              <div>
                <div class="name">Maggie Johnson</div>
                <div class="org">Supermarket Villanova</div>
              </div>
            </div>

            <div class="cmp-time">2 hours ago</div>
            <div class="cmp-status"><span class="pill pill--new">New</span></div>
          </a>
        </li>

        <!-- Row 2 -->
        <li class="cmp-item">
          <a class="cmp-hit" href="#cmp-4256-2">
            <div class="cmp-id">#CMP-4256</div>
            <div class="cmp-subject">One album is missing</div>

            <div class="cmp-customer">
              <img class="avatar" src="https://i.pravatar.cc/40?img=12" alt="">
              <div>
                <div class="name">Gael Harry</div>
                <div class="org">New York Finest Fruits</div>
              </div>
            </div>

            <div class="cmp-time">2 hours ago</div>
            <div class="cmp-status"><span class="pill pill--new">New</span></div>
          </a>
        </li>

        <!-- Row 3 -->
        <li class="cmp-item">
          <a class="cmp-hit" href="#cmp-4256-3">
            <div class="cmp-id">#CMP-4256</div>
            <div class="cmp-subject">One album is missing</div>

            <div class="cmp-customer">
              <img class="avatar" src="https://i.pravatar.cc/40?img=8" alt="">
              <div>
                <div class="name">Ralph Edwards</div>
                <div class="org">New York Finest Fruits</div>
              </div>
            </div>

            <div class="cmp-time">2 hours ago</div>
            <div class="cmp-status"><span class="pill pill--new">New</span></div>
          </a>
        </li>
      </ul>
    </div>
  </div>
</section>

<?php require APPROOT . '/views/inc/footer.php'; ?>