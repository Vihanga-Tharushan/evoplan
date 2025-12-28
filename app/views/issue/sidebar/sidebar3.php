<!DOCTYPE html>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/components/issueC/sidebar/sidebar.css">
<script src="<?php echo URLROOT; ?>/public/js/sidebar/script.js"></script>
<html>
  <body>
  <aside class="component" id="component">
      <nav class="menu">

        <button class="collapse" type="button" aria-label="Collapse sidebar">

          <img class="vector" src="<?php echo URLROOT; ?>/public/img/sidebar/Collapse icon.svg" alt="" role="presentation" />
        </button>

        <nav class="frame-default">
          <a href="<?php echo URLROOT; ?>/IssueC/dashboard" class="frame-2" role="menuitem" aria-current="page" title="Dashboard">
              <img class="img" src="<?php echo URLROOT; ?>/public/img/sidebar/SquaresFour.svg" alt="" role="presentation" />
              <span class="text-wrapper-2">Dashboard</span>
          </a>


          <a href="<?php echo URLROOT; ?>/IssueC/v_replacementslist" class="frame-2" role="menuitem" title="Events">
              <img class="img" src="<?php echo URLROOT; ?>/public/img/sidebar/event.svg" alt="" role="presentation" />
              <span class="text-wrapper-2">Replacements</span>
          </a>


          <a href="<?php echo URLROOT; ?>/IssueC/v_refund" class="frame" role="menuitem">
            <div class="div">
            <img class="img" src="<?php echo URLROOT; ?>/public/img/sidebar/package.svg" alt="" role="presentation" />
            <span class="text-wrapper">payments Adjustments</span>
            </div>
          </a>

          <a href="<?php echo URLROOT; ?>/IssueC/reports"  class="frame-2" role="menuitem">
            <img class="img" src="<?php echo URLROOT; ?>/public/img/sidebar/User.svg" alt="" role="presentation" />
            <span class="text-wrapper-2">Reports</span>
          </a>

          <a href="<?php echo URLROOT; ?>/IssueC/v_adminreports" class="frame-2" role="menuitem">
            <img class="img" src="<?php echo URLROOT; ?>/public/img/sidebar/PaperPlaneRight.svg" alt="" role="presentation" />
            <span class="text-wrapper-2">Reports to Admin</span>
          </a>
        </nav>
      </nav>
    </aside>
  </body>
</html>
