<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/components/servicesP/taskbar.css">
</head>
<body>
    <div class="taskbar">
        <!-- Logo container -->
        
        <!-- EvoPlan Logo -->
        <div class="evo-plan-logo">
            <img src="<?php echo URLROOT; ?>/public/img/taskbar/EvoPlan_Logo_new-removebg-preview 2.svg" alt="EvoPlan Logo" class="evo-plan-image" onclick="location.href='<?php echo URLROOT; ?>/Evo/Evoplan';"">
        </div>

        
        
        <!-- Notification icon -->
        <div class="notification-icon">
            <img src="<?php echo URLROOT; ?>/public/img/taskbar/notification.svg" alt="Notification Icon" class="notification-image" onclick="window.location.href='<?php echo URLROOT; ?>/Clients/notifications'">
        </div>
        
        <!-- Profile picture -->
        <div class="profile-picture">
            <img src="<?php echo URLROOT; ?>/public/img/taskbar/profile.svg" alt="Profile Picture" class="profile-image" onclick="location.href='<?php echo URLROOT; ?>/clients/profile';" >
        </div>
    </div>
</body>
</html>
