<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/inc/components/sidebar/sidebar1.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/components/servicesP/filter_packages.css">

<section class="packages">
  <div class="packages-header">
    <h2 class="packages__title">Packages</h2>
    <button class="create-package-header-btn add-package-btn">
      <i class="fas fa-plus"></i> Create Package
    </button>
  </div>

  <!-- Filter Section -->
  <div class="packages-filter">
    <div class="filter-group">
      <label for="filterSelect">Sort by:</label>
      <select id="filterSelect" class="filter-select">
        <option value="newest">Newest First</option>
        <option value="oldest">Oldest First</option>
        <option value="price-low-to-high">Price: Low to High</option>
        <option value="price-high-to-low">Price: High to Low</option>
      </select>
    </div>
    <button id="resetFilterBtn" class="filter-reset-btn">
      <i class="fas fa-redo"></i> Reset
    </button>
  </div>

  <div class="packages-grid" id="packagesGrid">
    <?php foreach($data['packages'] as $package): ?>
    <article class="package-card" data-package-id="<?php echo $package->package_id; ?>" data-price="<?php echo $package->price; ?>" data-created="<?php echo strtotime($package->created_at ?? date('Y-m-d H:i:s')); ?>">
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
        <a class="view-package-btn" href="" data-package-id="<?php echo $package->package_id; ?>">View Package →</a>
        <?php endif; ?>
      </div>
    </article>
    <?php endforeach; ?>

  </div>
</section>

<!-- Package Details Popup -->
<section class="view-package-popup">
  <div class="popup-content">
    <span class="close-popup-btn">&times;</span>
    <h3 class="popup-title">Package Details</h3>
    <div class="popup-body">
      <div class="popup-image">
        <img id="popup-image" src="" alt="Package Image">
      </div>
      <div class="popup-details">
        <h4 id="popup-title"></h4>
        <p id="popup-description"></p>
        
        <div class="popup-price">
          <span id="popup-price"></span>
        </div>
      </div>
      <div class="popup-actions">
        <button class="btn btn-edit" id="edit-package-btn">
          <i class="fas fa-edit"></i> Edit Package
        </button>
        <button class="btn btn-delete" id="delete-package-btn">
          <i class="fas fa-trash"></i> Delete Package
        </button>
      </div>
    </div>
  </div>
</section>

<!-- Create Package Popup -->
<section class="create-package-popup">
  
<main class="cnp-page" aria-label="Create new package">
  <span class="close-popup-btn">&times;</span>
  <div class="cnp-frame">
    <h1 class="cnp-title">Create New Package</h1>

    <form class="cnp-card">

      <!-- Owner -->
      <div class="row">
        <div class="label">Package Owner</div>
        <div class="value">
          <div class="owner">
            <img class="owner__avatar" src="" alt="">
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
          <input class="input" type="text" id="title" name="title" placeholder="Simple Shoot">
          <span class="error"></span>
        </div>
      </div>

      <!-- Details -->
      <div class="row">
        <label class="label" for="details">Package Details</label>
        <div class="value">
          <textarea class="textarea" id="details" name="details" rows="6" placeholder="Describe what's included…" maxlength="500"></textarea>
          <div class="char-counter">
            <span class="char-count">0</span>/500 characters
          </div>
          <span class="error"></span>
        </div>
      </div>

      <!-- Price -->
      <div class="row">
        <label class="label" for="price">Package Price</label>
        <div class="value">
          <div class="price">
            <span class="currency">RS.</span>
            <input class="input input--price" type="number" id="price" name="price" min="0" step="1" placeholder="25000">
            <span class="error"></span>
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
            <input class="file__input" type="file" name="bg_image" id="bg_image" accept="image/*" onchange="previewImage(event)">
            <span class="error"></span>
            <label class="file__label" for="bg_image">Choose image…</label>
            <p class="file__hint">JPG/PNG up to 5MB.</p>
          </div>
        </div>
      </div>

      <!-- Actions -->
      <div class="actions">
        <button id="submit" class="btn btn--primary">Create</button>
        <button id="cancel" class="btn btn--secondary">Cancel</button>
      </div>

    </form>

  </div>
</main>

</section>

<!-- edit package section -->

<section class="create-package-popup edit-package-popup">
  
  <main class="cnp-page" aria-label="Create new package">
    <span class="edit-close-popup-btn">&times;</span>
    <div class="cnp-frame">
      <h1 class="cnp-title" >Edit Package</h1>

      <form class="cnp-card">

        <!-- Owner -->
        <div class="row">
          <div class="label">Package Owner</div>
          <div class="value">
            <div class="owner">
              <img class="owner__avatar" src="" alt="">
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
            <input class="input" type="text" id="title" name="title" placeholder="Simple Shoot">
            <span class="error"></span>
          </div>
        </div>

        <!-- Details -->
        <div class="row">
          <label class="label" for="details" data-package-id="">Package Details</label>
          <div class="value">
            <textarea class="textarea" id="edit-details" name="details" rows="6" placeholder="Describe what's included…" maxlength="500"></textarea>
            <div class="char-counter">
              <span class="char-count">0</span>/500 characters
            </div>
            <span class="error"></span>
          </div>
        </div>

        <!-- Price -->
        <div class="row">
          <label class="label" for="price">Package Price</label>
          <div class="value">
            <div class="price">
              <span class="currency">RS.</span>
              <input class="input input--price" type="number" id="price" name="price" min="0" step="1" placeholder="25000">
              <span class="error"></span>
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
              <input class="file__input" type="file" name="bg_image" id="bg_image" accept="image/*" onchange="previewImage(event)">
              <span class="error"></span>
              <label class="file__label" for="bg_image">Choose image…</label>
              <p class="file__hint">JPG/PNG up to 5MB.</p>
            </div>
          </div>
        </div>

        <!-- Actions -->
        <div class="actions">
          <button id="submit" class="btn btn--primary">Save Changes</button>
          <button id="edit-cancel" class="btn btn--secondary">Cancel</button>
        </div>

      </form>

    </div>
  </main>

</section>


<script>
const URLROOT = '<?php echo URLROOT; ?>';

// Package filtering functionality
document.addEventListener('DOMContentLoaded', function() {
  const filterSelect = document.getElementById('filterSelect');
  const resetFilterBtn = document.getElementById('resetFilterBtn');
  const packagesGrid = document.getElementById('packagesGrid');
  const packageCards = document.querySelectorAll('.package-card');

  // Apply filter when selection changes
  filterSelect.addEventListener('change', function() {
    applyFilter(this.value);
  });

  // Reset filter
  resetFilterBtn.addEventListener('click', function() {
    filterSelect.value = 'newest';
    applyFilter('newest');
  });

  function applyFilter(filterType) {
    const cardsArray = Array.from(packageCards);

    switch(filterType) {
      case 'newest':
        cardsArray.sort((a, b) => {
          return parseInt(b.dataset.created) - parseInt(a.dataset.created);
        });
        break;
      case 'oldest':
        cardsArray.sort((a, b) => {
          return parseInt(a.dataset.created) - parseInt(b.dataset.created);
        });
        break;
      case 'price-low-to-high':
        cardsArray.sort((a, b) => {
          return parseFloat(a.dataset.price) - parseFloat(b.dataset.price);
        });
        break;
      case 'price-high-to-low':
        cardsArray.sort((a, b) => {
          return parseFloat(b.dataset.price) - parseFloat(a.dataset.price);
        });
        break;
      default:
        break;
    }

    // Re-render cards in sorted order
    cardsArray.forEach(card => {
      packagesGrid.appendChild(card);
    });
  }

  // Initialize view popup on button click
  const popup = document.querySelector('.view-package-popup');
  const closeBtn = document.querySelector('.close-popup-btn');
  const deleteBtn = document.getElementById('delete-package-btn');
  let currentPackageId = null;

  // Create Package Popup
  const createBtn = document.querySelector('.add-package-btn');
  const createPopup = document.querySelector('.create-package-popup');
  const createCloseBtn = createPopup.querySelector('.close-popup-btn');
  const cancelBtn = document.getElementById('cancel');
  const createHeaderBtn = document.querySelector('.create-package-header-btn');

  //edit package popup
    const editBtn = document.getElementById('edit-package-btn');
    const editPopup = document.querySelector('.edit-package-popup');
    const editCloseBtn = editPopup.querySelector('.edit-close-popup-btn');
    const editCancelBtn = document.getElementById('edit-cancel');
    const saveChanges = document.getElementById('save-changes');
    const editForm = document.querySelector('.edit-package-popup .cnp-card');


  // Open view popup on button click
  viewButtons.forEach(button => {
    button.addEventListener('click', function(e) {
      e.preventDefault();
      currentPackageId = this.getAttribute('data-package-id');
      getPackageDetails(currentPackageId);
      popup.classList.add('show');
      document.body.style.overflow = 'hidden';
      document.querySelector('.packages').classList.add('blur-background');
    });
  });

  // Open create popup on button click
  createBtn.addEventListener('click', function(e) {
    e.preventDefault();
    createPopup.classList.add('show');
    document.body.style.overflow = 'hidden';
    document.querySelector('.packages').classList.add('blur-background');
  });

  //edit button functionality
  editBtn.addEventListener('click', function() {
    if (currentPackageId) {
      // Close view popup
      closePopup();
      // Open create popup
      editPopup.classList.add('show');
      document.body.style.overflow = 'hidden';
      document.querySelector('.packages').classList.add('blur-background');
      // Populate edit form with current package details
      var xml = new XMLHttpRequest();

      xml.onload = function(){
        if(this.status == 200 || this.readyState == 4){

          console.log(this.responseText);
          var response = JSON.parse(this.responseText);

          if(response){
            const pkg = response.package;
            const editForm = document.querySelector('.edit-package-popup .cnp-card');
            editForm.title.value = pkg.title;
            editForm.details.value = pkg.details;
            editForm.price.value = pkg.price;
            editForm.querySelector('label[for="details"]').setAttribute('data-package-id', pkg.package_id);
            
            // Update character counter for edit form
            const editTextarea = document.getElementById('edit-details');
            const editCounter = document.querySelector('.edit-package-popup .char-counter');
            const editCharCount = editCounter.querySelector('.char-count');
            editCharCount.textContent = pkg.details.length;
            
            // Update counter styling
            editCounter.classList.remove('warning', 'danger');
            if (pkg.details.length > 400) {
              editCounter.classList.add('warning');
            }
            if (pkg.details.length > 450) {
              editCounter.classList.remove('warning');
              editCounter.classList.add('danger');
            }
          } else {
            alert('Error: ' + response.message);
          }

        }
      };

      xml.open('POST', URLROOT + '/Service/getPackageDetails', true);
      xml.setRequestHeader('Content-type', 'application/json');
      var data = {
        packageId: currentPackageId
      }
      var stringifydData = JSON.stringify(data);
      xml.send(stringifydData);

    }
  });

  //edit package form submission
  
  editForm.addEventListener('submit', function(e){
    e.preventDefault();

    // Clear previous errors
    const errorSpans = editForm.querySelectorAll('.error');
    errorSpans.forEach(span => span.textContent = '');

    var currentPackageId = editForm.querySelector('label[for="details"]').getAttribute('data-package-id');

    const formData = new FormData(editForm);
    formData.append('id', currentPackageId);

    var xml = new XMLHttpRequest();
    xml.onload = function(){
      if(this.status == 200 || this.readyState == 4){

        console.log(this.responseText);
        var response = JSON.parse(this.responseText);

        if(response.success){
          alert('Package updated successfully');
          closeEditPopup();
          location.reload();

        } else if(response.errors) {

          // Display validation errors
          for (const key in response.errors) {

            const errorSpan = editForm.querySelector(`[name="${key}"] ~ .error`);
            if (errorSpan) {

              errorSpan.textContent = response.errors[key];

            }
          }
        } else {
          alert(response.message || 'Error updating package');
        }
      }
    };

    xml.open('POST', URLROOT + '/Package/editPackage', true);
    xml.send(formData);
});


  // Open create popup from header button
  createHeaderBtn.addEventListener('click', function(e) {
    e.preventDefault();
    createPopup.classList.add('show');
    document.body.style.overflow = 'hidden';
    document.querySelector('.packages').classList.add('blur-background');
  });

  // Close view popup
  closeBtn.addEventListener('click', closePopup);
  popup.addEventListener('click', function(e) {
    if (e.target === popup) {
      closePopup();
    }
  });

  // Close edit popup
  editCloseBtn.addEventListener('click', closeEditPopup);
  editPopup.addEventListener('click', function(e) {
    if (e.target === editPopup) {
      closeEditPopup();
    }
  });

  // Close create popup
  createCloseBtn.addEventListener('click', closeCreatePopup);
  createPopup.addEventListener('click', function(e) {
    if (e.target === createPopup) {
      closeCreatePopup();
    }
  });

  cancelBtn.addEventListener('click', function(e) {
    e.preventDefault();
    closeCreatePopup();
  });

  editCancelBtn.addEventListener('click', function(e) {
    e.preventDefault();
    closeEditPopup();
  });

  function closePopup() {
    popup.classList.remove('show');
    document.body.style.overflow = 'auto';
    document.querySelector('.packages').classList.remove('blur-background');
  }

  function closeCreatePopup() {
    createPopup.classList.remove('show');
    document.body.style.overflow = 'auto';
    document.querySelector('.packages').classList.remove('blur-background');
    // Reset form and errors
    const createForm = document.querySelector('.create-package-popup .cnp-card');
    createForm.reset();
    const errorSpans = createForm.querySelectorAll('.error');
    errorSpans.forEach(span => span.textContent = '');

    // Reset character counter
    const createCounter = document.querySelector('.create-package-popup .char-counter');
    const createCharCount = createCounter.querySelector('.char-count');
    createCharCount.textContent = '0';
    createCounter.classList.remove('warning', 'danger');
  }

  function closeEditPopup() {
    editPopup.classList.remove('show');
    document.body.style.overflow = 'auto';
    document.querySelector('.packages').classList.remove('blur-background');
    // Reset form and errors
    const editForm = document.querySelector('.edit-package-popup .cnp-card');
    editForm.reset();
    const errorSpans = editForm.querySelectorAll('.error');
    errorSpans.forEach(span => span.textContent = '');

    // Reset character counter
    const editCounter = document.querySelector('.edit-package-popup .char-counter');
    const editCharCount = editCounter.querySelector('.char-count');
    editCharCount.textContent = '0';
    editCounter.classList.remove('warning', 'danger');
  }

  // Delete button functionality
  deleteBtn.addEventListener('click', function() {

    if (currentPackageId && confirm('Are you sure you want to delete this package? This action cannot be undone.')) {
      
          var xml = new XMLHttpRequest();

          xml.onload = function(){
            if(this.status == 200 || this.readyState == 4){

              console.log(this.responseText);
              var response = JSON.parse(this.responseText);

              if(response.success){
                alert('Package deleted successfully');
                location.reload();
              } else {
                alert(response.message || 'Error deleting package');
              }

            }
          };
          xml.open('POST', URLROOT + '/Package/deletePackage', true);
          xml.setRequestHeader('Content-type', 'application/json');
          var data = {
            package_id: currentPackageId
          }
          var stringifydData = JSON.stringify(data);
          xml.send(stringifydData);
    }
  });

  // Fetch package details via AJAX
  function getPackageDetails(packageId){

    var xml = new XMLHttpRequest();

    xml.onload = function(){
      if(this.status == 200 || this.readyState == 4){

        console.log(this.responseText);
        var response = JSON.parse(this.responseText);

        if(response){
          const pkg = response.package;
          document.getElementById('popup-image').src = URLROOT + '/Public/img/packageImg/' + pkg.bg_image_name;
          document.getElementById('popup-title').textContent = pkg.title;
          // Preserve line breaks and spaces in description
          document.getElementById('popup-description').innerHTML = pkg.details.replace(/\n/g, '<br>');
          document.getElementById('popup-price').textContent = 'Rs. ' + parseFloat(pkg.price).toFixed(2);
        } else {
          alert('Error: ' + response.message);
        }

      }
    };

    xml.open('POST', URLROOT + '/Service/getPackageDetails', true);
    xml.setRequestHeader('Content-type', 'application/json');
    var data = {
      packageId: packageId
    }
    var stringifydData = JSON.stringify(data);
    xml.send(stringifydData);

  }
  // Close popup with Escape key
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && popup.classList.contains('show')) {
      closePopup();
    }
    if (e.key === 'Escape' && createPopup.classList.contains('show')) {
      closeCreatePopup();
    }
    if (e.key === 'Escape' && editPopup.classList.contains('show')) {
      closeEditPopup();
    }
  });

  // Image preview functionality
  window.previewImage = function(event) {
    const file = event.target.files[0];
    const previewImg = document.getElementById('previewImg');
    const imagePreview = document.getElementById('imagePreview');

    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        previewImg.src = e.target.result;
        previewImg.style.display = 'block';
        imagePreview.style.borderColor = 'var(--primary)';
      };
      reader.readAsDataURL(file);
    } else {
      previewImg.src = '';
      previewImg.style.display = 'none';
      imagePreview.style.borderColor = 'var(--border)';
    }
  };

  // Character counter functionality
  function initializeCharCounter(textareaId, counterSelector) {
    const textarea = document.getElementById(textareaId);
    const counter = document.querySelector(counterSelector);
    const charCount = counter.querySelector('.char-count');
    const maxLength = textarea.getAttribute('maxlength');

    function updateCounter() {
      const currentLength = textarea.value.length;
      charCount.textContent = currentLength;

      // Remove existing classes
      counter.classList.remove('warning', 'danger');

      // Add warning/danger classes based on character count
      if (currentLength > maxLength * 0.8) {
        counter.classList.add('warning');
      }
      if (currentLength > maxLength * 0.9) {
        counter.classList.remove('warning');
        counter.classList.add('danger');
      }
    }

    textarea.addEventListener('input', updateCounter);
    textarea.addEventListener('keyup', updateCounter);
    textarea.addEventListener('paste', function() {
      setTimeout(updateCounter, 0);
    });

    // Initialize counter
    updateCounter();
  }

  // Initialize character counters for both forms
  initializeCharCounter('details', '.create-package-popup .char-counter');
  initializeCharCounter('edit-details', '.edit-package-popup .char-counter');

  // Create package form submission
  const createForm = document.querySelector('.create-package-popup .cnp-card');

  createForm.addEventListener('submit', function(e){
    e.preventDefault();

    // Clear previous errors
    const errorSpans = createForm.querySelectorAll('.error');
    errorSpans.forEach(span => span.textContent = '');

    const formData = new FormData(createForm);

    var xml = new XMLHttpRequest();
    xml.onload = function(){
      if(this.status == 200 || this.readyState == 4){

        console.log(this.responseText);
        var response = JSON.parse(this.responseText);

        if(response.success){
          alert('Package created successfully');
          closeCreatePopup();
          location.reload();

        } else if(response.errors) {

          // Display validation errors
          for (const key in response.errors) {

            const errorSpan = createForm.querySelector(`[name="${key}"] ~ .error`);
            if (errorSpan) {

              errorSpan.textContent = response.errors[key];

            }
          }
        } else {
          alert(response.message || 'Error creating package');
        }
      }
    };

    xml.open('POST', URLROOT + '/Package/createPackage', true);
    xml.send(formData);

});
 
  
});


</script>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>