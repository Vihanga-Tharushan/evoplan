<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/inc/components/sidebar/sidebar3.php'; ?>
<?php require_once APPROOT . '/views/inc/components/taskbar/taskbar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/components/servicesP/s_packages.css">

<section class="packages">
  <h2 class="packages__title">Packages</h2>

  <div class="packages-grid">
    <?php foreach($data['packages'] as $package): ?>
    <article class="package-card">
      <div class="card-image">
        <img src="<?php echo URLROOT; ?>/Public/img/packageImg/<?php echo $package->bg_image_name; ?>" alt="<?php echo $package->title; ?>">
      </div>
      <div class="card-content">
        <h3 class="package-title"><?php echo $package->title; ?></h3>
        <p class="package-description"><?php echo substr($package->details, 0, 100) . (strlen($package->details) > 100 ? '...' : ''); ?></p>
        
        <div class="provider-info-static">
          <div class="provider-avatar">
            <div class="avatar-placeholder"><?php echo strtoupper(substr($_SESSION['service_name'], 0, 1)); ?></div>
          </div>
          <div class="provider-details">
            <span class="provider-name"><?php echo $_SESSION['service_name']; ?></span>
            <span class="provider-badge">Verified Provider</span>
          </div>
        </div>
        
        <span class="price">Rs.<?php echo number_format($package->price, 2); ?></span>
        
        <?php if($package->service_id == $_SESSION['service_id']): ?>
        <a class="view-package-btn" href="<?php echo URLROOT; ?>/Package/editPackage/<?php echo $package->package_id?>">View Package →</a>
        <?php endif; ?>
      </div>
    </article>
    <?php endforeach; ?>

    <!-- Add Package -->
    <article class="package-card package-card--add">
      <div class="card-image add-card-image">
        <div class="add-icon">+</div>
        <div class="add-text">Add New Package</div>
      </div>
      <div class="card-content">
        <a class="add-package-btn" href="<?php echo URLROOT; ?>/Package/createPackage">Create Package →</a>
      </div>
    </article>
  </div>
</section>
<?php require_once APPROOT . '/views/inc/footer.php'; ?>