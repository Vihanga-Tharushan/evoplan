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

          <a href="<?php echo URLROOT; ?>/Service/dashboard" class="frame-2" role="menuitem"   title="Dashboard">  
              <img class="img" src="<?php echo URLROOT; ?>/public/img/sidebar/SquaresFour.svg" alt="" role="presentation" />
              <span class="text-wrapper-2">Dashboard</span>
          </a>

          <a href="<?php echo URLROOT; ?>/Service/events" class="frame" role="menuitem" title="Events">
           <div class="div">
            <img class="img" src="<?php echo URLROOT; ?>/public/img/sidebar/event.svg" alt="" role="presentation" />
            <span class="text-wrapper">Replacements</span>
            </div>
          </a>

          <a href="<?php echo URLROOT; ?>/Service/packages" class="frame-2" role="menuitem">
            <img class="img" src="<?php echo URLROOT; ?>/public/img/sidebar/package.svg" alt="" role="presentation" />
            <span class="text-wrapper-2">Payments Adjustments</span>

          </a>
          <a href="<?php echo URLROOT; ?>/Service/profile" class="frame-2" role="menuitem">
            <img class="img" src="<?php echo URLROOT; ?>/public/img/sidebar/User.svg" alt="" role="presentation" />
            <span class="text-wrapper-2">Reports</span>
          </a>
          <a href="<?php echo URLROOT; ?>/Service/messages" class="frame-2" role="menuitem">
            <img class="img" src="<?php echo URLROOT; ?>/public/img/sidebar/PaperPlaneRight.svg" alt="" role="presentation" />
            <span class="text-wrapper-2">Reports to Admin</span>
          </a>
         
        </nav>
      </nav>
    </aside>
  </body>
</html>
