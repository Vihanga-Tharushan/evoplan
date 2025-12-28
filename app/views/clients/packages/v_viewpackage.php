<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/inc/components/taskbar/taskbar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/components/client/viewpackage.css">

    <div class="container" style="margin-top: 70px;">
        <div class="header">
            <h1>About the Package</h1>
        </div>
        
        <div class="form-container">
            <form>
                <div class="form-row">
                    <label class="form-label">Package Owner</label>
                    <div class="form-content">
                        <div class="user-profile">
                            <div class="avatar">CF</div>
                            <div class="user-info">
                                <h3>Chris Friedky</h3>
                                <p>Supermarket Villanova</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <label class="form-label">Package Title</label>
                    <div class="form-content">
                        <input type="text" class="form-input" value="Simple Shoot" placeholder="Enter package title">
                    </div>
                </div>

                <div class="form-row">
                    <label class="form-label">Package Details</label>
                    <div class="form-content">
                        <textarea class="form-textarea" placeholder="Enter package details and description..."></textarea>
                    </div>
                </div>

                <div class="form-row">
                    <label class="form-label">Package Price</label>
                    <div class="form-content">
                        <input type="text" class="form-input" value="RS. 25,000" placeholder="Enter package price">
                    </div>
                </div>

                <div class="form-row">
                    <label class="form-label">Background Image</label>
                    <div class="form-content">
                        <div class="image-upload-area">
                            <img src="https://images.unsplash.com/photo-1606983340126-99ab4feaa64a?w=200&h=120&fit=crop" alt="Camera setup" class="uploaded-image">
                            <p class="upload-text">Click to upload or drag and drop</p>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <label class="form-label">Special Notes<br><small>(Details in front)</small></label>
                    <div class="form-content">
                        <textarea class="form-textarea special-notes-textarea" placeholder="Enter any special notes or additional details..."></textarea>
                    </div>
                </div>

                <span type="submit" style="text-align: center;" class="create-button" onclick="location.href='<?php echo URLROOT; ?>/Clients/createEvent';">Confirm</span>
                <span type="submit" style="text-align: center;" class="create-button" onclick="location.href='<?php echo URLROOT; ?>/Clients/createEvent';">Reject</span>
            </form>
        </div>
    </div>
<?php require APPROOT . '/views/inc/footer.php';?>