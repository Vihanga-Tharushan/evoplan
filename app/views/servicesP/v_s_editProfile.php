<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php
$backUrl = URLROOT . '/Service/profile';
require_once APPROOT . '/views/inc/components/taskbar/navbar.php'; ?>


<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/components/servicesP/s_editprofile.css">

<form method="post" action="<?php echo URLROOT; ?>/Service/editProfile" enctype="multipart/form-data">
<div class="container">
    <div class="header">
        
        <div class="header-title">Edit Profile</div>
    </div>
    
    <div class="section">
        <div class="section-title">
            <span>Profile picture</span>
            <a href="#" class="edit-link" id="edit-profile-pic">Edit</a>
        </div>
        <img src="<?php echo URLROOT; ?>/public/img/profilePics/<?php echo $data['profile_pic']; ?>" alt="Profile Picture" class="profile-pic" id="profile-pic">
        <input type="file" class="file-input" name="profile-pic-input" id="profile-pic-input" accept="image/*">
        <!-- <button class="upload-btn" id="upload-profile-pic">Upload Photo</button> -->
         <span class="error-message"><?php echo $data['profile_pic_err']; ?></span>
    </div>
    
    
    <div class="section">
        <div class="section-title">
            <span>Background Images</span>
            <a href="#" class="edit-link" id="edit-cover">Edit</a>
        </div>
        <div class="preview-container">
            <img src="<?php echo URLROOT; ?>/public/img/coverPhotos/<?php echo $data['background_image']; ?>" alt="Cover Photo" class="cover-photo" id="cover-photo">
            <!-- <div class="overlay"> 
                <div class="change-text" for="cover_input">Click to change</div>
            </div>-->
        </div>
        <input type="file" class="file-input" name="cover-input" id="cover-input" accept="image/*">
        <!-- <button class="upload-btn" id="upload-cover">Upload Cover</button> -->
        <span class="error-message"><?php echo $data['background_image_err']; ?></span>
    </div>

    <div class="section">
        <div class="section-title">
            <span>Add more</span>
        </div>
        <div class="background-images-container">
            <div class="images-grid" id="images-grid">
                <!-- Existing background images will be loaded here -->
                <div class="image-upload-slot" id="add-more-slot">
                    <div class="upload-placeholder">
                        <i class="fas fa-plus"></i>
                        <span>Add Image</span>
                    </div>
                    <input type="file" class="file-input" name="background-image-1" id="background-image-1" accept="image/*">
                </div>
            </div>
            <div class="upload-info">
                <small>You can add up to 4 background images. Click "Add Image" to upload more.</small>
            </div>
        </div>
    </div>

    <div class="section">
         <div class="section-title">
            <span>Text for Background Image</span>
            <a href="#" class="edit-link" id="edit-bio">Edit</a>
        </div>
        <div class="bio-container">
            <div class="bio-title">TEXT</div>
            <textarea class="input-field" name="background-text" id="background-text" rows="4" placeholder="Write something about you need to put infront of the Background Image..."><?php echo $data['background_text']; ?></textarea>
        </div>

    </div>
    
    <div class="section">
        <div class="section-title">
            <span>Introduction</span>
            <a href="#" class="edit-link" id="edit-bio">Edit</a>
        </div>
        <div class="bio-container">
            <div class="bio-title">Introduction</div>
            <textarea class="input-field" id="intro-text" name="intro-text" rows="4" placeholder="Write something about yourself..."><?php echo $data['intro']; ?></textarea>
            <span class="error-message"><?php echo $data['intro_err']; ?></span>
        </div>
    </div>
    
    <button type="submit" class="save-btn" id="save-btn">Save Changes</button>
    <a href="<?php echo URLROOT; ?>/Service/profile" class="cancel-btn" id="cancel-btn">Cancel</a>

</div>
</form>
<script>
    const maxImages = 4;
    const imagesGrid = document.getElementById('images-grid');
    const addMoreSlot = document.getElementById('add-more-slot');
    
    // Function to get the next available slot number
    function getNextAvailableSlot() {
        const usedSlots = new Set();
        
        // Check all existing file inputs
        imagesGrid.querySelectorAll('input[type="file"][name^="background-image-"]').forEach(input => {
            const match = input.name.match(/^background-image-(\d)$/);
            if (match) {
                const num = parseInt(match[1]);
                if (num >= 2 && num <= 4) {
                    usedSlots.add(num);
                }
            }
        });
        
        // Find first available slot from 2-4
        for (let i = 2; i <= 4; i++) {
            if (!usedSlots.has(i)) {
                return i;
            }
        }
        return null; // All slots full
    }
    
    // Function to count how many images are uploaded
    function getUploadedImageCount() {
        return imagesGrid.querySelectorAll('.image-preview').length;
    }
    
    // Basic functionality for file inputs
    document.querySelectorAll('.edit-link').forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const section = link.closest('.section');
            const fileInput = section.querySelector('.file-input');
            if (fileInput) {
                fileInput.click();
            }
        });
    });

    // Handle file selection preview
    document.querySelectorAll('.file-input').forEach(input => {
        input.addEventListener('change', function(e) {
            if (e.target.files && e.target.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = input.closest('.section').querySelector('img');
                    if (img) {
                        img.src = e.target.result;
                    }
                }
                reader.readAsDataURL(e.target.files[0]);
            }
        });
    });
    
    // Function to add new image slot
    function addImageSlot() {
        const uploadedCount = getUploadedImageCount();
        if (uploadedCount >= 3) return; // Can add max 3 extra images (slots 2, 3, 4)
        
        const slotIndex = getNextAvailableSlot();
        if (slotIndex === null) return;
        
        // Create new image preview element
        const imagePreview = document.createElement('div');
        imagePreview.className = 'image-preview';
        imagePreview.innerHTML = `
            <img src="" alt="Background Image ${slotIndex}">
            <button type="button" class="image-remove" title="Remove image">
                <i class="fas fa-times"></i>
            </button>
            <input type="file" class="file-input" name="background-image-${slotIndex}" id="background-image-${slotIndex}" accept="image/*" required>
        `;
        
        // Insert before the add-more slot
        imagesGrid.insertBefore(imagePreview, addMoreSlot);
        
        // Setup file input for this slot
        const fileInput = imagePreview.querySelector('.file-input');
        const img = imagePreview.querySelector('img');
        
        fileInput.addEventListener('change', function(e) {
            if (e.target.files && e.target.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    img.src = e.target.result;
                }
                reader.readAsDataURL(e.target.files[0]);
                
                // Update visibility of add more slot
                const currentCount = getUploadedImageCount();
                if (currentCount < 3) {
                    addMoreSlot.style.display = 'flex';
                } else {
                    addMoreSlot.style.display = 'none';
                }
            }
        });
        
        // Setup remove button
        const removeBtn = imagePreview.querySelector('.image-remove');
        removeBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            imagePreview.remove();
            
            // Show add more slot if we can add more
            const currentCount = getUploadedImageCount();
            if (currentCount < 3) {
                addMoreSlot.style.display = 'flex';
            }
        });
        
        // Trigger file input when clicking on the preview
        imagePreview.addEventListener('click', function(e) {
            if (!e.target.classList.contains('image-remove')) {
                fileInput.click();
            }
        });
        
        // Update visibility
        const currentCount = getUploadedImageCount();
        if (currentCount >= 3) {
            addMoreSlot.style.display = 'none';
        }
    }
    
    // Setup initial add more slot click
    addMoreSlot.addEventListener('click', function() {
        addImageSlot();
    });

</script>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>