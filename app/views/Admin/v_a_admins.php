<?php require_once APPROOT . '/views/Admin/Sidebar/v_a_sidebar.php'; ?>
<?php require_once APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="../public/css/components/Admin/style(Admin_Admins).css">
<link rel="stylesheet" href="../public/css/components/table1.css">

<div class="admins-container">
  <!-- Header -->
  <div class="admins-header">
    <h1>Admin Management</h1>
    <p>Manage all administrators and issue coordinators</p>
  </div>

  <!-- Admin Section -->
  <div class="admin-section">
    <div class="section-header">
      <h2>Administrators</h2>
      <button class="add-btn" onclick="window.location.href='<?php echo URLROOT ?>/Admin/add_admin'">
        <i class="fas fa-plus"></i> Add New Admin
      </button>
    </div>

    <!-- Admins Table -->
    <div class="table-scroll">
      <table class="table">
        <thead>
          <tr>
            <th>Admin ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody id="adminsTableBody">
          <?php
            if (!empty($data['admins'])) {
              $a_rowCount = 0;
              foreach ($data['admins'] as $row) {
                $a_rowCount++;
                $isFirstRow = ($a_rowCount == 1);
                ?>
                <tr>
                  <td><strong><?php echo $row->a_id; ?></strong></td>
                  <td><?php echo $row->a_name; ?></td>
                  <td><?php echo $row->a_email; ?></td>
                  <td><?php echo $row->a_phone; ?></td>
                  <td>
                    <div class="action-buttons-inline">
                      <?php if ($isFirstRow): ?>
                        <button class="btn-icon btn-primary" title="Cannot edit principal admin" disabled>
                          <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn-icon btn-danger" title="Cannot delete principal admin" disabled>
                          <i class="fas fa-trash"></i>
                        </button>
                      <?php else: ?>
                        <a href="<?php echo URLROOT ?>/Admin/update_admin/<?php echo $row->a_id; ?>">
                          <button class="btn-icon btn-primary" title="Edit">
                            <i class="fas fa-edit"></i>
                          </button>
                        </a>
                        <button class="btn-icon btn-danger" title="Delete" onclick="confirmDeleteAdmin(<?php echo $row->a_id; ?>)">
                          <i class="fas fa-trash"></i>
                        </button>
                      <?php endif; ?>
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

  <!-- Coordinator Section -->
  <div class="coordinator-section">
    <div class="section-header">
      <h2>Issue Coordinators</h2>
      <button class="add-btn" onclick="window.location.href='<?php echo URLROOT ?>/Admin/add_coordinator'">
        <i class="fas fa-plus"></i> Add New Coordinator
      </button>
    </div>

    <!-- Coordinators Table -->
    <div class="table-scroll">
      <table class="table">
        <thead>
          <tr>
            <th>Coordinator ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody id="coordinatorsTableBody">
          <?php
            if (!empty($data['coordinators'])) {
              $ic_rowCount = 0;
              foreach ($data['coordinators'] as $row) {
                $ic_rowCount++;
                $isFirstRow = ($ic_rowCount == 1);
                ?>
                <tr>
                  <td><strong><?php echo $row->ic_id; ?></strong></td>
                  <td><?php echo $row->ic_name; ?></td>
                  <td><?php echo $row->ic_email; ?></td>
                  <td><?php echo $row->ic_phone; ?></td>
                  <td>
                    <div class="action-buttons-inline">
                      <?php if ($isFirstRow): ?>
                        <button class="btn-icon btn-primary" title="Cannot edit principal coordinator" disabled>
                          <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn-icon btn-danger" title="Cannot delete principal coordinator" disabled>
                          <i class="fas fa-trash"></i>
                        </button>
                      <?php else: ?>
                        <a href="<?php echo URLROOT ?>/Admin/update_coordinator/<?php echo $row->ic_id; ?>">
                          <button class="btn-icon btn-primary" title="Edit">
                            <i class="fas fa-edit"></i>
                          </button>
                        </a>
                        <button class="btn-icon btn-danger" title="Delete" onclick="confirmDeleteCoordinator(<?php echo $row->ic_id; ?>)">
                          <i class="fas fa-trash"></i>
                        </button>
                      <?php endif; ?>
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
  function confirmDeleteAdmin(adminId) {
    if (confirm('Are you sure you want to delete this admin? This action cannot be undone.')) {
      window.location.href = '<?php echo URLROOT; ?>/Admin/delete_admin/' + adminId;
    }
  }

  function confirmDeleteCoordinator(coordinatorId) {
    if (confirm('Are you sure you want to delete this coordinator? This action cannot be undone.')) {
      window.location.href = '<?php echo URLROOT; ?>/Admin/delete_coordinator/' + coordinatorId;
    }
  }
</script>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>
