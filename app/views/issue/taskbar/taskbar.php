<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taskbar</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/components/issueC/taskbar/taskbar.css">
</head>
<body>
    <div class="taskbar">
        <!-- Logo container -->
        <div class="bar-container">
            
        </div>
        
        <!-- EvoPlan Logo -->
        <div class="evo-plan-logo">
            <img src="<?php echo URLROOT; ?>/public/img/taskbar/EvoPlan_Logo_new-removebg-preview 2.svg" alt="EvoPlan Logo" class="evo-plan-image" onclick="window.location.href='<?php echo URLROOT; ?>/Evo/evoplan'">
        </div>
        
        <!-- Chat icon -->
        <div class="chat-icon">
            <div class="chat-circle">
                <img src="<?php echo URLROOT; ?>/public/img/taskbar/ChatsCircle.svg" alt="Chat Icon" class="chat-image" onclick="window.location.href='<?php echo URLROOT; ?>/IssueC/chats'">
            </div>
        </div>
        
        <!-- Notification icon -->
        <div class="notification-icon">
            <img src="<?php echo URLROOT; ?>/public/img/taskbar/notification.svg" alt="Notification Icon" class="notification-image" onclick="window.location.href='<?php echo URLROOT; ?>/IssueC/notifications'">
        </div>
        
        <!-- Profile picture -->
         <form method="post" action="<?php echo URLROOT; ?>/IssueC/issuecprofile">
			<button class="btn btn--primary" type="submit"> <a class="see-all"><div class="profile-picture">
            <img src="<?php echo URLROOT; ?>/public/img/taskbar/profile.svg" alt="Profile Picture" class="profile-image" onclick="window.location.href='<?php echo URLROOT; ?>/IssueC/accountSettings'">
        </div></a></button>
		</form>
       
    </div>
</body>
</html>
