<!DOCTYPE html>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/components/servicesP/sidebar.css">
<script src="<?php echo URLROOT; ?>/public/js/sidebar/script.js"></script>
<html>
  <body>
  <aside class="component" id="component">
      <nav class="menu">

        <button class="collapse" type="button" aria-label="Collapse sidebar">

          <img class="vector" src="<?php echo URLROOT; ?>/public/img/sidebar/Collapse icon.svg" alt="" role="presentation" />
        </button>

        <nav class="frame-default">

          <!-- EvoPlan Logo -->
          <div class="evo-plan-logo">
                <img src="<?php echo URLROOT; ?>/public/img/taskbar/EvoPlan_Logo_new-removebg-preview 2.svg" alt="EvoPlan Logo" class="evo-plan-image" onclick="window.location.href='<?php echo URLROOT; ?>/Evo/evoplan'">
          </div>
          <br>

          <a href="<?php echo URLROOT; ?>/IssueC/dashboard" class="frame-2" role="menuitem" aria-current="page" title="Dashboard">
            
              <img class="img" src="<?php echo URLROOT; ?>/public/img/sidebar/SquaresFour.svg" alt="" role="presentation" />
              <span class="text-wrapper-2">Dashboard</span>
            </div>
          </a>

          <a href="<?php echo URLROOT; ?>/IssueC/replacement" class="frame-2" role="menuitem">
            <img class="img" src="<?php echo URLROOT; ?>/public/img/sidebar/User.svg" alt="" role="presentation" />
            <span class="text-wrapper-2">Replacement</span>
          </a>
          

          <a href="<?php echo URLROOT; ?>/IssueC/events" class="frame-2" role="menuitem" title="Events">
            
            <img class="img" src="<?php echo URLROOT; ?>/public/img/sidebar/event.svg" alt="" role="presentation" />
            <span class="text-wrapper-2">Events</span>
            
          </a>

          <a href="<?php echo URLROOT; ?>/IssueC/payments" class="frame" role="menuitem">
            <div class="div">
            <img class="img" src="<?php echo URLROOT; ?>/public/img/sidebar/CurrencyCircleDollar.svg" alt="" role="presentation" />
            <span class="text-wrapper">Payments</span>
            </div>
          </a>
          
          <a href="<?php echo URLROOT; ?>/IssueC/messages" class="frame-2" role="menuitem">
            <img class="img" src="<?php echo URLROOT; ?>/public/img/sidebar/PaperPlaneRight.svg" alt="" role="presentation" />
            <span class="text-wrapper-2">Messages</span>
          </a>
          <a href="<?php echo URLROOT; ?>/IssueC/complains" class="frame-2" role="menuitem">
            <img class="img" src="<?php echo URLROOT; ?>/public/img/sidebar/Warning.svg" alt="" role="presentation" />
            <span class="text-wrapper-2">Complains</span>

          </a>

          <a href="<?php echo URLROOT; ?>/IssueC/reports" class="frame-2" role="menuitem">
            <img class="img" src="<?php echo URLROOT; ?>/public/img/sidebar/reports.svg" alt="" role="presentation" />
            <span class="text-wrapper-2">Reports</span>

          </a>
          
        </nav>
      </nav>
    </aside>
  </body>
</html>
