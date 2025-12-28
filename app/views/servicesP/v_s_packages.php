<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/inc/components/sidebar/sidebar3.php'; ?>
<?php require_once APPROOT . '/views/inc/components/taskbar/taskbar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/components/servicesP/s_packages.css">

<section class="packages">
  <h2 class="packages__title">Packages</h2>

  <div class="packages-grid">
    <!-- Diamond -->
    <?php foreach($data['packages'] as $package): ?>
    <article class="pkg-card tier--diamond">
      <figure class="pkg-media">
        <img src="<?php echo URLROOT; ?>/Public/img/packageImg/<?php echo $package->bg_image_name; ?>" alt="Camera on table">
        <div class="pkg-overlay">
          <div class="pkg-top">
            <h3 class="pkg-title"><?php echo $package->title; ?></h3>
            <ul class="pkg-list">
              <li><?php echo $package->details; ?></li>
            </ul>
            <div class="pkg-price"><?php echo $package->price; ?></div>
          </div>

          <div class="pkg-author">
            <div class="avatar"></div>
            <div class="author-text">
              <div class="author-name"><?php echo $_SESSION['service_name']; ?></div>
            </div>
          </div>
        </div>
      </figure>
      <?php if($package->service_id == $_SESSION['service_id']): ?>
      <a class="pkg-link" href="<?php echo URLROOT; ?>/Package/editPackage/<?php echo $package->package_id?>">View&nbsp;Package →</a>
      <?php endif; ?>
    </article>
    <?php endforeach; ?>

  

    <!-- Add Package -->
    <article class="pkg-card pkg-card--add">
      <div class="pkg-media add-media">
        <div class="add-square" aria-hidden="true">+</div>
      </div>
      <a class="pkg-link" href="<?php echo URLROOT; ?>/Package/createPackage">Add&nbsp;Package →</a>
    </article>
  </div>
</section>
<?php require_once APPROOT . '/views/inc/footer.php'; ?>