<?php
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    // Sets default timezome to +8 GMT
    date_default_timezone_set("Asia/Manila");

    // This is global hosting configuration.
    if(!defined('date')) define('date', date("Y-m-d h:i:s"));
    if(!defined('base_url')) define('base_url','http://localhost/aasci/');
    if(!defined('base_app')) define('base_app', str_replace('\\','/',__DIR__).'/' ); // Directory
    if(!defined('emailuser')) define('emailuser', 'maojimenez.ueuo@gmail.com'); // Email for GoogleAPI
    if(!defined('emailpass')) define('emailpass', 'zyppycyqpqhpxxbf'); // Password for GoogleAPI
    if(!defined('DB_SERVER')) define('DB_SERVER',"localhost");
    if(!defined('DB_USERNAME')) define('DB_USERNAME',"root");
    if(!defined('DB_PASSWORD')) define('DB_PASSWORD',"");
    if(!defined('DB_NAME')) define('DB_NAME',"aasci");
?>