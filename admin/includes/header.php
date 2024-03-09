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
        <!-- Favicons -->
        <link rel="shortcut icon" href="<?php echo base_url ?>assets/files/system/<?= $system['icon'] ?>" type="image/x-icon">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url ?>assets/files/system/<?= $system['icon'] ?>">
        <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url ?>assets/files/system/<?= $system['icon'] ?>">
        <!-- Remove Banner -->
        <script src="<?php echo base_url ?>assets/js/fwhabannerfix.js"></script>
        <!-- Bootstrap CSS -->
        <link href="<?php echo base_url ?>assets/css/styles.css" rel="stylesheet" />
        <!-- DataTables CSS -->
        <link href="<?php echo base_url ?>assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
        <link href="<?php echo base_url ?>assets/vendor/datatables/colReorder.dataTables.min.css" rel="stylesheet">
        <script type="text/javascript" src="<?php echo base_url ?>assets/js/jquery-3.6.0.js"></script>
        <!-- Icons -->
        <script src="<?php echo base_url ?>assets/vendor/font-awesome/js/all.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo base_url ?>assets/vendor/feather-icons/feather.min.js" crossorigin="anonymous"></script>
        <!-- Loader CSS -->
        <link href="<?php echo base_url ?>assets/css/loader.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="<?php echo base_url ?>assets/css/custom.css" rel="stylesheet">
        <!-- Cookie CSS -->
        <link href="<?php echo base_url ?>assets/css/cookie.css" rel="stylesheet">
        <!-- GlightBox -->
        <link href="<?php echo base_url ?>assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    </head>
    <body class="nav-fixed">
        <!-- Loading Screen -->
        <div class="noprint-scroll" id="loading">
            <img id="loading-image" src="<?php echo base_url ?>assets/files/system/loading.gif" alt="Loading" />
        </div>
        <div id="connectionAlert" class="alert"></div>
        <?php 
            include ('navbar.php'); 
            include ('sidebar.php');
            include ('../../message.php');
        ?>