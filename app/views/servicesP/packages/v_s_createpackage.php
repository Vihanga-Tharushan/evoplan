<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php
$backUrl = URLROOT . '/Service/packages';
require_once APPROOT . '/views/inc/components/taskbar/taskbar_back.php';
?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/components/servicesP/packages/s_createpackage.css">

<!-- Success toast (CSS-only via :target) -->
<div id="created-toast" class="toast toast--success" role="status" aria-live="polite" aria-atomic="true">
  <span class="toast__icon" aria-hidden="true">
    <svg viewBox="0 0 24 24" width="18" height="18">
      <circle cx="12" cy="12" r="10" fill="#10b981"></circle>
      <path d="M7 12l3 3 7-7" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
  </span>
  <span class="toast__text">Package created successfully</span>
  <a class="toast__close" href="#" aria-label="Dismiss">×</a>
</div>

<main class="cnp-page" aria-label="Create new package">
  <div class="cnp-frame">
    <h1 class="cnp-title">Create New Package</h1>

    <form class="cnp-card" method="post" action="<?php echo URLROOT; ?>/Package/createPackage" enctype="multipart/form-data">

      <!-- Owner -->
      <div class="row">
        <div class="label">Package Owner</div>
        <div class="value">
          <div class="owner">
            <img class="owner__avatar" src="https://i.pravatar.cc/40?img=12" alt="">
            <div>
              <div class="owner__name"><?php echo $_SESSION['service_name'] ?></div>

            </div>
          </div>
        </div>
      </div>

      <!-- Title -->
      <div class="row">
        <label class="label" for="title">Package Title</label>
        <div class="value">
          <input class="input" type="text" id="title" name="title" placeholder="Simple Shoot" value="<?php echo $data['title']; ?>">
          <span class="error"><?php echo $data['title_err']; ?></span>
        </div>
      </div>

      <!-- Details -->
      <div class="row">
        <label class="label" for="details">Package Details</label>
        <div class="value">
          <input type="textarea" class="textarea" id="details" name="details" rows="6" placeholder="Describe what's included…" value="<?php echo $data['details']; ?>"></input>
          <span class="error"><?php echo $data['details_err']; ?></span>
        </div>
      </div>

      <!-- Price -->
      <div class="row">
        <label class="label" for="price">Package Price</label>
        <div class="value">
          <div class="price">
            <span class="currency">RS.</span>
            <input class="input input--price" type="number" id="price" name="price" min="0" step="1" placeholder="25000" value="<?php echo $data['price']; ?>">
            <span class="error"><?php echo $data['price_err']; ?></span>
          </div>
        </div>
      </div>

      <!-- Background Image -->
      <div class="row">
        <div class="label">Background Image</div>
        <div class="value">
          <div class="image-preview" id="imagePreview">
            <img src="" alt="Image Preview" id="previewImg">
          </div>
          <div class="file">
            <input class="file__input" type="file" name="bg_image" id="bg_image" accept="image/*" value="<?php echo $data['bg_image']; ?>" onchange="previewImage(event)">
            <span class="error"><?php echo $data['bg_image_err']; ?></span>
            <label class="file__label" for="bg_image">Choose image…</label>
            <p class="file__hint">JPG/PNG up to 5MB.</p>
          </div>
        </div>
      </div>

      <!-- Notes -->
      <div class="row">
        <label class="label" for="notes">Special Notes (Details in front)</label>
        <div class="value">
          <input type="textarea" class="textarea" id="notes" name="notes" rows="6" placeholder="Optional" value="<?php echo $data['notes']; ?>"></input>
        </div>
      </div>

      <!-- Actions -->
      <div class="actions">
        <button type="submit" class="btn btn--primary">Create</button>
      </div>

    </form>

  </div>
</main>

<script>
function previewImage(event) {
  const preview = document.getElementById('previewImg');
  preview.style.display = 'block';
  preview.src = URL.createObjectURL(event.target.files[0]);
  
  preview.onload = function() {
    URL.revokeObjectURL(preview.src) // free memory
  }
}
</script>
<?php require_once APPROOT . '/views/inc/footer.php'; ?>