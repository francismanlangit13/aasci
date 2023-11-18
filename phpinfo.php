<?php
    if(!defined('DB_SERVER')){
        include("db_conn.php");
        $version = phpversion();
    }
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="A web-based Farmers monitoring management system" name="description">
        <meta content="Monitoring, Management, System, Notification" name="keywords">
        <title><?= $system['shortname'] ?> | PHP <?=$version?></title>
        <link href="<?php echo base_url ?>assets/css/bootstrap-4.css" rel="stylesheet">

        <!-- Remove Banner -->
        <script src="<?php echo base_url ?>assets/js/fwhabannerfix.js"></script>

        <!-- Favicons -->
        <link rel="shortcut icon" href="<?php echo base_url ?>assets/img/system/favicon.png" type="image/x-icon">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url ?>assets/img/system/favicon.png">
        <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url ?>assets/img/system/favicon.png">

        <!-- Loading CSS -->
        <link href="<?php echo base_url ?>assets/css/loader.css" rel="stylesheet">
    </head>
    <body>
        <!-- Loading Screen -->
        <div id="loading">
            <img id="loading-image" src="<?php echo base_url ?>assets/files/system/loading.gif" alt="Loading" />
        </div>
        <?php phpinfo(); ?>
        <script>
            var base_url = "<?php echo base_url ?>"; // global location for javascript
        </script>
        <!-- Disable-key -->
        <script src="<?php echo base_url ?>assets/js/disable-key.js"></script>
        <!-- Loading JS -->
        <script src="<?php echo base_url ?>assets/js/loader.js"></script>
        <script src="<?php echo base_url ?>assets/js/underscore-min.js"></script>
    </body>
</html>