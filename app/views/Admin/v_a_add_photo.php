<?php require_once APPROOT . '/views/inc/header.php'; ?>
  <link rel="stylesheet" href="../public/css/components/Admin/form.css">

    <div class="form-container">
      <form action="<?php echo URLROOT; ?>/Admin/add_photo" method="POST" enctype="multipart/form-data">

        <div class="form-img-container">
        <img class="form-topic" src="../public/img/choose_register/EvoPlan_Logo_new-removebg-preview 2.svg"/>
        </div>

        <div class="form-topic">Add Photo</div>

        <div class="form-input-title">Event Name</div>
        <input type="text" name="event_name" id="event_name" class="name" value="<?php echo $data['event_name']; ?>">
        <span class="form-invalid"><?php echo $data['event_name_err']; ?></span>

        <div class="form-input-title">Event Date</div>
        <input type="date" name="event_date" id="event_date" class="email" value="<?php echo $data['event_date']; ?>">
        <span class="form-invalid"><?php echo $data['event_date_err']; ?></span>

        <div class="form-input-title">Event Photo</div>
        <input type="file" name="event_photo" id="event_photo" accept="image/*" onchange="previewImage(event)">
        <label class="file__label" for="event_photo">Choose image…</label>
        <span class="error" style="display: block; margin-top: 5px; color: red;"><?php echo $data['event_photo_err']; ?></span>
        <p class="file__hint">JPG/PNG up to 5MB.</p>

        <div class="form-preview-container">
          <p style="color: #6F1A8C; font-weight: 600; margin-top: 0;">Photo Preview</p>
          <img id="previewImg" class="form-preview-img" style="display: none;">
        </div>

        <br>
        <button type="submit" class="form-btn">
          Add Photo
        </button>

      </form>
      
        <button class="form-cn-btn" onclick="window.location.href='<?php echo URLROOT ?>/Admin/features'">
          Cancel
        </button>
    </div>

    <script>
    function previewImage(event) {
        if(event.target.files && event.target.files[0]) {
            const preview = document.getElementById('previewImg');
            const file = event.target.files[0];
            
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
            
            preview.onload = function() {
                URL.revokeObjectURL(preview.src);
            }
        }
    }

    // Set max date to today for event_date input
    const today = new Date().toISOString().split("T")[0];
    document.getElementById("event_date").setAttribute("max", today);
    </script>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>