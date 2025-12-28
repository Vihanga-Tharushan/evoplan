<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php
$backUrl = URLROOT . '/Service/profile';
require_once APPROOT . '/views/inc/components/taskbar/taskbar_back.php'; ?>


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
            <span>Cover photo</span>
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

</script>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>