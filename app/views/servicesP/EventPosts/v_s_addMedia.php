<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php $backUrl =  URLROOT . '/Service/profile';
require_once APPROOT . '/views/inc/components/taskbar/navbar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/components/servicesP/EventPosts/s_addMedia.css">

<div class="container">
    <div class="event-info">
        <h2 class="event-title" id="eventTitle"><?php echo $data['event']->title; ?></h2>
        <p class="event-description" id="eventDescription"><?php echo $data['event']->description; ?></p>
    </div>

    <div class="upload-section">
        <form action="<?php echo URLROOT; ?>/Posts/AddMediaToEvent/<?php echo $data['event_id'] ?>" method="POST" enctype="multipart/form-data">
            <div class="upload-area">
                <h2 class="section-title">Upload Media</h2>
                
                <div class="drop-zone" id="dropZone">
                    <i class="fas fa-file-upload"></i>
                    <h3>Drag & Drop Files Here</h3>
                    <p>Supported formats: JPG, PNG, GIF, MP4, MOV</p>
                    <input type="file" id="fileInput" name="fileInput" class="fileInput" multiple accept="image/*,video/*" style="display: none;" value="<?php echo $data['fileInput']; ?>">
                    <label type="button" for="fileInput" class="browse-btn" id="browseBtn">Browse Files</label>

                </div> 
            </div>

            <div class="preview-section">
                <h2 class="section-title">Media Preview</h2>
                
                <div class="media-preview" id="mediaPreview">
                    <img src="" alt="Media Preview" class="media-item" id="image_placeholder" style="display: none;"></file>
                    <div class="empty-state">
                        <i>🖼️</i>
                        <p>No media added yet</p>
                    </div>
                </div>
                
                <div class="action-buttons">
                    <label class="cancel-btn" id="cancelBtn" onclick="removeMedia()">Cancel</label>
                    <button type="submit" class="save-btn" id="saveBtn" value="Save Media">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="<?php echo URLROOT; ?>/public/js/addMedia/addMedia.js"></script>
<?php require_once APPROOT . '/views/inc/footer.php'; ?>