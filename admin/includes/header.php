<?php include ('authentication.php'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Meta for website -->
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="<?= $system['description'] ?>">
        <meta name="keywords" content="<?= $system['keywords'] ?>">
        <meta name="author" content="<?= $system['author'] ?>">
        <!-- Website Title -->
        <title>AASCI System | Admin</title>
        <!-- Bootstrap CSS -->
        <link href="<?php echo base_url ?>assets/css/styles.css" rel="stylesheet" />
        <!-- Website Logo -->
        <link rel="icon" type="image/x-icon" href="<?php echo base_url ?>assets/img/favicon.png" />
        <!-- DataTables CSS -->
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <!-- Icons -->
        <script data-search-pseudo-elements defer src="<?php echo base_url ?>assets/vendor/font-awesome/js/all.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo base_url ?>assets/vendor/feather-icons/feather.min.js" crossorigin="anonymous"></script>
        <!-- Loader CSS -->
        <link href="<?php echo base_url ?>assets/css/loader.css" rel="stylesheet">
    </head>
    <body class="nav-fixed">
        <!-- Loading Screen -->
        <div class="noprint-scroll" id="loading">
            <img id="loading-image" src="<?php echo base_url ?>assets/files/system/loading.gif" alt="Loading" />
        </div>
        <?php 
            include ('navbar.php'); 
            include ('sidebar.php');
            include ('../../message.php');
        ?>