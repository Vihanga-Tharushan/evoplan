<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/issue/sidebar/sidebar5.php';?>
<?php require_once APPROOT . '/views/issue/taskbar/taskbar.php'; ?>

<link rel="stylesheet" href="../public/css/components/issueC/adminreports.css" />



<section class="packages">
  <h2 class="packages__title">Admin Reports</h2>

    


  <div class="package-card">
    <?php foreach($data['issueReports'] as $report): ?>
    <h3 class="package-card__title"><?php echo $report->issue_type; ?></h3>
    <p class="id">Report ID: <?php echo $report->id; ?></p>
    <p class="package-card__description"><?php echo $report->notes; ?></p>
    <p class="package-card_cost"><strong><?php echo $report->cost; ?></strong></p>
    <p class="replace_item">Replace Item: <?php echo $report->replace_item; ?></p>
    <p class="Vendor_Responsibility">Vendor Responsibility: <?php echo $report->v_response; ?></p>
    <p class="refund-status">Refund Status: <?php echo $report->refund; ?></p>
    <p class="priority">Priority: <?php echo  $report->priority; ?> </p>
    <p class ="admin_note">Admin Notes: <?php echo  $report->a_note; ?></p>
    <a class="pkg-link" href="<?php echo URLROOT; ?>/IssueC/editReport/<?php echo $report->id?>">View&nbsp;Report →</a>


    <br>
  <?php endforeach; ?>
  </div>
</section>


<?php require APPROOT . '/views/inc/footer.php'; ?>