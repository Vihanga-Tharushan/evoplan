<!DOCTYPE html>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/components/issueC/sidebar/sidebar.css">

<html>
  <body>
  <aside class="component" id="component">
      <nav class="menu">

        <button class="collapse" type="button" aria-label="Collapse sidebar">

          <img class="vector" src="<?php echo URLROOT; ?>/public/img/sidebar/Collapse icon.svg" alt="" role="presentation" />
        </button>

        <nav class="frame-default">

          <a href="<?php echo URLROOT; ?>/IssueC/dashboard" class="frame" role="menuitem" aria-current="page" title="Dashboard">
            <div class="div">
              <img class="img" src="<?php echo URLROOT; ?>/public/img/sidebar/SquaresFour.svg" alt="" role="presentation" />
              <span class="text-wrapper">Dashboard</span>
            </div>
          </a>

          <a href="<?php echo URLROOT; ?>/IssueC/v_replacementslist" class="frame-2" role="menuitem" title="Replacements">
            <img class="img" src="<?php echo URLROOT; ?>\public\img\sidebar\phosphor-icons-git-diff0.svg" alt="" role="presentation" />
            <span class="text-wrapper-2">Replacements</span>
          </a>

          <a href="<?php echo URLROOT; ?>/IssueC/v_refund" class="frame-2" role="menuitem">
            <img class="img" src="<?php echo URLROOT; ?>\public\img\sidebar\package.svg" alt="" role="presentation" />
            <span class="text-wrapper-2">Payments Adjustments</span>

          </a>
          <a href="<?php echo URLROOT; ?>/Service/profile" class="frame-2" role="menuitem">
            <img class="img" src="<?php echo URLROOT; ?>\public\img\sidebar\phosphor-icons-paper-plane-right0.svg" alt="" role="presentation" />
            <span class="text-wrapper-2">Reports</span>
          </a>
          <a href="<?php echo URLROOT; ?>/IssueC/v_adminreport" class="frame-2" role="menuitem">
            <img class="img" src="<?php echo URLROOT; ?>\public\img\sidebar\phosphor-icons-user0.svg" alt="" role="presentation" />
            <span class="text-wrapper-2">Reports to Admin</span>
          </a>
          
        </nav>
      </nav>
    </aside>
  </body>
</html>
