<?php require_once APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="../public/css/components/Admin/style(Admin_Admins).css">
<link rel="stylesheet" href="../public/css/components/Admin/admin-dashboard.css">
<link rel="stylesheet" href="../public/css/components/table.css">
<link rel="stylesheet" href="../public/css/components/form.css">

<!-- Dashboard -->
<div class="dashboard-admins">

  <!-- Dashboard -->
    <div class="dashboard">
      <div class="dashboard-frame">

        <button class="button" onclick="window.location.href='<?php echo URLROOT ?>/Admin/Stats'">
            <div class="dashboard-items">
              <img src="../public/img/Admin/Dashboard/Stats.svg"/>
              Stats
            </div>
        </button>

        <button class="button" onclick="window.location.href='<?php echo URLROOT ?>/Admin/Payments'">         
          <div class="dashboard-items">
            <img src="../public/img/Admin/Dashboard/Payments.svg" />
            Payments
          </div>
        </button>

        <button class="button" onclick="window.location.href='<?php echo URLROOT ?>/Admin/Applications'">         
          <div class="dashboard-items">
            <img src="../public/img/Admin/Dashboard/Applications.svg" />
            Applications
          </div>
        </button>

        <button class="button" onclick="window.location.href='<?php echo URLROOT ?>/Admin/Complains'">         
          <div class="dashboard-items">
            <img src="../public/img/Admin/Dashboard/Complains.svg" />
            Complains
          </div>
        </button>

        <button class="button" onclick="window.location.href='<?php echo URLROOT ?>/Admin/Profiles'">
            <div class="dashboard-items">
              <img src="../public/img/Admin/Dashboard/Profiles.svg" />
              Profiles
            </div>
        </button>
          
        <button class="button" onclick="window.location.href='<?php echo URLROOT ?>/Admin/Events'">
            <div class="dashboard-items">
              <img src="../public/img/Admin/Dashboard/Events.svg" />
              Events
            </div>
        </button>

        <button class="button" onclick="window.location.href='<?php echo URLROOT ?>/Admin/Feedbacks'">
            <div class="dashboard-items">
              <img src="../public/img/Admin/Dashboard/Feedbacks.svg"/>
              Feedbacks
            </div>
        </button>

        <div class="select">
          <div class="dashboard-items">
            <img src="../public/img/Admin/Dashboard/Admins.svg"/>
            Admins &amp; <br /> Coordinators
          </div>
        </div>

      </div>
    </div>

<?php require_once('dbconnection.php'); ?>

<!-- Admin Table -->
  <div class="admins-frame">
    <div class="admin-topic">Admins</div>
      <button class="add-admin-btn" onclick="window.location.href='<?php echo URLROOT ?>/Admin/add_admin'">Add New Admin</button>

      <div class="admin-table-container">
        <table class="custom-table">
          <thead>
            <tr>
              <th>Admin ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>

            <?php

              $query = "SELECT * FROM admins";
              $result = mysqli_query($connection, $query);

              if (!$result) {
                // die("Query failed: " . mysqli_error());
              }

              else { 
                
                $a_rowCount = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                  $a_rowCount++;
                  ?>
                  <tr>
                    <td><?php echo $row['a_id']; ?></td>
                    <td><?php echo $row['a_name']; ?></td>
                    <td><?php echo $row['a_email']; ?></td>
                    <td><?php echo $row['a_phone']; ?></td>
                    <td>
                      <?php if ($a_rowCount != 1) { // show buttons only after first row ?>
                          <a href="<?php echo URLROOT ?>/Admin/update_admin/<?php echo $row['a_id']; ?>"><button class="custom-btn custom-btn-primary">Edit</button></a>
                          <a href="<?php echo URLROOT ?>/Admin/delete_admin/<?php echo $row['a_id']; ?>"><button class="custom-btn custom-btn-danger">Delete</button></a>
                    </td>
                  <?php
                  }
                }

              }

            ?>

            

          </tbody>
        </table>
      </div>
  </div>
  
<!-- Issue Coordinator Table -->
  <div class="coordinators-frame">
    <div class="coordinator-topic">Issue Coordinators</div>
      <button class="add-coordinator-btn" onclick="window.location.href='<?php echo URLROOT ?>/Admin/add_coordinator'">Add New Coordinator</button>

      <div class="admin-table-container">
        <table class="custom-table">
          <thead>
            <tr>
              <th>Admin ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>

            <?php

              $query = "SELECT * FROM coordinators";
              $result = mysqli_query($connection, $query);

              if (!$result) {
                //die("Query failed: " . mysqli_error());
              }

              else { 
                
                $ic_rowCount = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                  $ic_rowCount++;
                  ?>
                  <tr>
                    <td><?php echo $row['ic_id']; ?></td>
                    <td><?php echo $row['ic_name']; ?></td>
                    <td><?php echo $row['ic_email']; ?></td>
                    <td><?php echo $row['ic_phone']; ?></td>
                    <td>
                      <?php if ($ic_rowCount != 1) { // show buttons only after first row ?>
                          <a href="<?php echo URLROOT ?>/Admin/update_coordinator/<?php echo $row['ic_id']; ?>"><button class="custom-btn custom-btn-primary">Edit</button></a>
                          <a href="<?php echo URLROOT ?>/Admin/delete_coordinator/<?php echo $row['ic_id']; ?>"><button class="custom-btn custom-btn-danger">Delete</button></a>
                    </td>
                  <?php
                  }
                }

              }

            ?>

            

          </tbody>
        </table>
      </div>
        
    </div>


    
    <div class="frame-31">
      <button class="logout-btn" onclick="window.location.href='<?php echo URLROOT ?>/Admin/main_page'">Log Out</button>
      <button class="btn_to_mainPage" > 
        <img class="evo-plan-logo-new-removebg-preview-2" src="../public/img/Admin/Stats/evo-plan-logo-new-removebg-preview-20.png" />
      </button>
    </div>
  </div>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>