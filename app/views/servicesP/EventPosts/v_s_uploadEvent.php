<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php $backUrl =  URLROOT . '/Service/profile'; 
require_once APPROOT . '/views/inc/components/taskbar/navbar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/components/servicesP/EventPosts/s_uploadEvent.css">
<div class="container">
        <div class="header">
        <br>
        <br>
        </div>

        <div class="event-card">
            <h2 class="form-title">Create New Event</h2>

            <form id="eventForm" method="POST" action="<?php echo URLROOT; ?>/Posts/UploadEvent" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Event Title *</label>
                    <input type="text" id="title" name="title" placeholder="Enter event title" value="<?php echo $data['title']; ?>">
                    <span class="error"><?php echo $data['title_err']; ?></span>
                </div>

                <div class="form-group">
                    <label for="event_date">Event Date *</label>
                    <input type="date" id="event_date" name="event_date" value="<?php echo $data['event_date']; ?>">
                    <span class="error"><?php echo $data['event_date_err']; ?></span>
                </div>

                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" id="location" name="location" placeholder="Enter event location" value="<?php echo $data['location']; ?>">
                    <span class="error"><?php echo $data['location_err']; ?></span>
                </div>

                
                <div class="form-group">
                    <label for="guestCount">Number of Guest</label>
                    <select id="guestCount" name="guestCount">
                        <option value="11" <?php echo ($data['guestCount'] == 11) ? 'selected' : ''; ?>>0-50 Guest</option>
                        <option value="51" <?php echo ($data['guestCount'] == 51) ? 'selected' : ''; ?>>51-100 Guest</option>
                        <option value="101" <?php echo ($data['guestCount'] == 101) ? 'selected' : ''; ?>>101 or more</option>
                    </select>
                </div>

                <div class="form-group">                    
                    <label for="description">Description</label>
                    <textarea id="description" name="description" placeholder="Describe your event..."><?php echo $data['description']; ?></textarea>
                    <span class="error"><?php echo $data['description_err']; ?></span>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-post" id="postEventBtn">Post Event</button>
                    <button type="button" class="btn btn-clear" id="clearFormBtn">Clear</button>
                </div>
            </form>
        </div>
</div>



<?php require_once APPROOT . '/views/inc/footer.php'; ?>
