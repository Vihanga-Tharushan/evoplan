<?php require_once APPROOT . '/views/Admin/Sidebar/v_a_sidebar.php'; ?>
<?php require_once APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="../public/css/components/Admin/style(Admin_Admins).css">
<link rel="stylesheet" href="../public/css/components/table1.css">

<div class="admins-container">
  <!-- Header -->
  <div class="admins-header">
    <h1>Landing Page Features</h1>
    <p>Manage photos featured on the landing page</p>
  </div>

  <!-- Photos Section -->
  <div class="admin-section">
    <div class="section-header">
      <h2>Photos to Landing Page</h2>
      <button class="add-btn" onclick="window.location.href='<?php echo URLROOT ?>/Admin/add_photo'">
        <i class="fas fa-plus"></i> Add Photo
      </button>
    </div>

    <!-- Photos Table -->
    <div class="table-scroll">
      <table class="table">
        <thead>
          <tr>
            <th>Photo ID</th>
            <th>Event Name</th>
            <th>Event Date</th>
            <th>Photo Name</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
            if (!empty($data['photos'])) {
              foreach ($data['photos'] as $row) {
                ?>
                <tr>
                  <td><strong><?php echo $row->photo_id; ?></strong></td>
                  <td><?php echo $row->event_name; ?></td>
                  <td><?php echo $row->event_date; ?></td>
                  <td><?php echo $row->event_photo_name; ?></td>
                  <td>
                    <div class="action-buttons-inline">
                      <a href="<?php echo URLROOT ?>/Admin/update_photo/<?php echo $row->photo_id; ?>">
                        <button class="btn-icon btn-primary" title="Edit">
                          <i class="fas fa-edit"></i>
                        </button>
                      </a>
                      <button class="btn-icon btn-danger" title="Delete" onclick="confirmDeletePhoto(<?php echo $row->photo_id; ?>)">
                        <i class="fas fa-trash"></i>
                      </button>
                    </div>
                  </td>
                </tr>
                <?php
              }
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script>
  function confirmDeletePhoto(photoId) {
    if (confirm('Are you sure you want to delete this photo? This action cannot be undone.')) {
      window.location.href = '<?php echo URLROOT; ?>/Admin/delete_photo/' + photoId;
    }
  }
</script>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>