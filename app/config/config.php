<?php
    
    // database configuration
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASSWORD', 'new_password');
    define('DB_NAME', 'evoplan_db');

    // Define the root directory of the application
    define('APPROOT',dirname(dirname(__FILE__)));

    // Define the root URL of the application
    define('URLROOT','http://localhost/evoplan');

    // Define the site name
    define('SITENAME','EvoPlan');

    //PUBROOT
    define('PUBROOT', dirname(dirname(dirname(__FILE__))) . '\public');

?>