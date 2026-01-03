<?php

    //load helpers
    require_once 'helpers/URL_Helper.php';
    require_once 'helpers/Session_Helper.php';
    require_once 'helpers/imageUpload_Helper.php';
    require_once 'helpers/notification_Helper.php';
    //load configuration
    require_once 'config/config.php';
    //load libraries

    require_once APPROOT . '/libraries/PHPMailer/Exception.php';
    require_once APPROOT . '/libraries/PHPMailer/PHPMailer.php';
    require_once APPROOT . '/libraries/PHPMailer/SMTP.php';

    require_once 'libraries/Core.php';
    require_once 'libraries/Database.php';
    require_once 'libraries/Controller.php';

?>