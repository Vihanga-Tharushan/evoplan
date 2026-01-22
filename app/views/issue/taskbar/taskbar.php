<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/components/servicesP/taskbar.css">
</head>
<body>
    <div class="taskbar">
        <!-- Logo container -->
        <div class="bar-container">
            
        </div>
        
        <!-- EvoPlan Logo -->
        <div class="evo-plan-logo" style="left:-78px">
            <img src="<?php echo URLROOT; ?>/public/img/taskbar/EvoPlan_Logo_new-removebg-preview 2.svg" alt="EvoPlan Logo" class="evo-plan-image" onclick="window.location.href='<?php echo URLROOT; ?>/Evo/evoplan'">
        </div>
         
        <!-- Notification icon -->
        <div class="notification-icon">
            <img src="<?php echo URLROOT; ?>/public/img/taskbar/notification.svg" alt="Notification Icon" class="notification-image" onclick="window.location.href='<?php echo URLROOT; ?>/Service/notifications'">
        </div>
        
        <!-- Profile picture -->
        <div class="profile-picture">
            <img src="https://i.pravatar.cc/160?img=12" alt="Profile Picture" class="profile-image" onclick="window.location.href='<?php echo URLROOT; ?>/Service/accountSettings'">
        </div>
    </div>
</body>
</html>
