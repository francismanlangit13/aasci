<?php include ('db_conn.php'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Title Page -->
        <title><?= $system['shortname'] ?></title>
        <!-- Favicons -->
        <link rel="shortcut icon" href="<?php echo base_url ?>assets/files/system/<?= $system['icon'] ?>" type="image/x-icon">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url ?>assets/files/system/<?= $system['icon'] ?>">
        <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url ?>assets/files/system/<?= $system['icon'] ?>">
        <!-- Loader CSS -->
        <link href="<?php echo base_url ?>assets/css/loader.css" rel="stylesheet">
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="<?php echo base_url ?>assets/css/styles.css" rel="stylesheet" />
        <style>
            .logo {
                max-height: 40px;
                margin-right: 8px;
            }
            body {
                display: flex;
                flex-direction: column;
                min-height: 100vh;
                margin: 0;
            }

            main {
                flex: 1;
            }

            /* Your existing styles for the footer */
            footer {
                py-5: 0;
            }
        </style>
    </head>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <img src="<?php echo base_url ?>assets/files/system/<?= $system['logo'] ?>" alt="MAO Jimenez" aria-label="<?= $system['shortname'] ?>" class="img-fluid logo">
                <a class="navbar-brand" href="#!"><?= $system['shortname'] ?></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <?php if($system_switch['facebook'] == "1"){ ?><li class="nav-item"><a class="nav-link" href="<?= $system['facebook'] ?>" target="_blank">Facebook</a></li> <?php } ?>
                        <?php if($system_switch['instagram'] == "1"){ ?><li class="nav-item"><a class="nav-link" href="<?= $system['instagram'] ?>"  target="_blank">Instagram</a></li> <?php } ?>
                        <?php if($system_switch['twitter'] == "1"){ ?><li class="nav-item"><a class="nav-link" href="<?= $system['twitter'] ?>"  target="_blank">Twitter</a></li> <?php } ?>
                        <?php if($system_switch['tumblr'] == "1"){ ?><li class="nav-item"><a class="nav-link" href="<?= $system['tumblr'] ?>"  target="_blank">Tumblr</a></li> <?php } ?>
                        <?php if($system_switch['email'] == "1"){ ?><li class="nav-item"><a class="nav-link" href="mailto:<?= $system['email'] ?>"  target="_blank">Email</a></li> <?php } ?>
                        <?php if($system_switch['number'] == "1"){ ?><li class="nav-item"><a class="nav-link" href="tel:<?= $system['number'] ?>"  target="_blank">Phone</a></li> <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page header with logo and tagline-->
        <header class="py-5 bg-light border-bottom mb-4">
            <div class="container">
                <div class="text-center my-5">
                    <h1 class="fw-bolder">Welcome to <?= $system['name'] ?></h1>
                    <p class="lead mb-0"><?= $system['description'] ?></p>
                </div>
            </div>
        </header>
        <?php
            if(isset($_GET['id'])){
                if ($_GET['referrer_sig'] == 'AQAAALlBtMUw4ijnuwuB1_ELMGm0j_LDQFR7JkepuUdtEUZlkWR_E8B1hpz84xnQcU2MWhGqYgqw1M2fKXNWP3tcP42AxniLgydvkoy2WHzQOrWSrT6wxtCsmk3ClX7csfHjkNFfHrR3BY5Q1evqYO43BcH51CGey1yhnFoukIyF7OPU') {
                    $id = $_GET['id'];
                    $senior = "SELECT * FROM `user` WHERE `user_id` = $id AND `user_type_id` = '3' AND `user_status_id` != '3' LIMIT 1";
                    $senior_run = mysqli_query($con, $senior);
                    if(mysqli_num_rows($senior_run) > 0){
                        foreach($senior_run as $row){
        ?>
        <main>
            <!-- Page content-->
            <div style="margin-right:30px; margin-left:30px;">
                <div class="row">
                    <!-- Side widgets-->
                    <div class="col-lg-5">
                        <!-- Categories widget-->
                        <div class="card mb-4">
                            <div class="card-header">Your Clearance (<?= $row['fname'] .' '. $row['mname'] .' '. $row['lname'] .' '. $row['suffix'] ?>)</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <ul class="list-unstyled mb-0">
                                            <li><a href="javascript:void(0);">PSA = <?= ($row['psa'] == "" || $row['psa'] == null) ? "<span class='text-danger'>No</span>" : "<span class='text-success'>Yes</span>"; ?></a></li>
                                            <li><a href="javascript:void(0);">SOC-PEN = <?= ($row['soc_pen'] == "No") ? "<span class='text-danger'>No</span>" : "<span class='text-success'>Yes</span>"; ?></a></li>
                                            <li><a href="javascript:void(0);">SUP-WITH = <?= ($row['sup_with'] == "No") ? "<span class='text-danger'>No</span>" : "<span class='text-success'>Yes</span>"; ?></a></li>
                                            <li><a href="javascript:void(0);">ID = <?= ($row['id_file'] == "No") ? "<span class='text-danger'>No</span>" : "<span class='text-success'>Yes</span>"; ?></a></li>
                                            <li><a href="javascript:void(0);">RRN = <?= ($row['rrn'] == "No") ? "<span class='text-danger'>No</span>" : "<span class='text-success'>Yes</span>"; ?></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-6">
                                        <ul class="list-unstyled mb-0">
                                            <li><a href="javascript:void(0);">GSIS = <?= ($row['gsis'] == "No") ? "<span class='text-danger'>No</span>" : "<span class='text-success'>Yes</span>"; ?></a></li>
                                            <li><a href="javascript:void(0);">SSS = <?= ($row['sss'] == "No") ? "<span class='text-danger'>No</span>" : "<span class='text-success'>Yes</span>"; ?></a></li>
                                            <li><a href="javascript:void(0);">4P's = <?= ($row['fourps'] == "No") ? "<span class='text-danger'>No</span>" : "<span class='text-success'>Yes</span>"; ?></a></li>
                                            <li><a href="javascript:void(0);">NHTS = <?= ($row['nhts'] == "No") ? "<span class='text-danger'>No</span>" : "<span class='text-success'>Yes</span>"; ?></a></li>
                                            <li><a href="javascript:void(0);">PVAO = <?= ($row['pvao'] == "No") ? "<span class='text-danger'>No</span>" : "<span class='text-success'>Yes</span>"; ?></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Side widget-->
                        <div class="card mb-4">
                            <div class="card-header">Recent Announcements</div>
                            <div class="card-body">
                                <?php
                                    $query = "SELECT *, DATE_FORMAT(ann_date, '%M %d, %Y %h:%i %p') as short_date FROM `announcement` WHERE `ann_status` = 'Posted' AND ann_date ORDER BY ann_date DESC LIMIT 5";
                                    $query_run = mysqli_query($con, $query);
                                    $check_announcement = mysqli_num_rows($query_run) > 0;
                                    if($check_announcement){
                                        $data_array = array();
                                        while($row = mysqli_fetch_array($query_run)){
                                ?>
                                <div class="card mt-3" style="border: 1.5px solid #000000 !important; color:black !important; font-size:12px">
                                    <div class="card-header" style="background-color:#b5f1ff;">Title: <?php echo $row['ann_title']; ?>
                                        <br>
                                        <span class="float-start">Date: <?php echo $row['short_date']; ?></span>
                                    </div>
                                    <div class="card-body">
                                        <h6 class="card-title" style="font-size:14px"><?php echo $row['ann_description']; ?></h6>
                                    </div>
                                </div>
                                <?php } } ?>
                            </div>
                        </div>
                    </div>
                    <!-- Blog entries-->
                    <div class="col-lg-7">
                        <div class="card mb-4">
                            <div class="card-header"><?= $system['sysacttitle'] ?></div>
                            <div class="card-body" style="font-size:14px">
                                <?= $system['sysact'] ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <?php } } else { ?>
            <main>
                <h4 class="text-center">No Record Found!</h4>
            </main>
        <?php } } else { header("Location: " . base_url . "forbidden"); } } ?>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container-xl px-4">
                <div class="row text-white">
                    <div class="col-md-6 small">Copyright <?php echo date('Y'); ?> &copy; <?= $system['name'] ?></div>
                    <div class="col-md-6 text-md-end small">
                        <a href="javascript:void(0);" class="text-white" data-bs-toggle="modal" data-bs-target="#btn_privacy">Privacy Policy</a>
                        &middot;
                        <a href="javascript:void(0);" class="text-white" data-bs-toggle="modal" data-bs-target="#btn_terms">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Restrictions forms -->
        <script src="<?php echo base_url ?>assets/js/disable-key.js"></script>
        <!-- Bootstrap core JS-->
        <script src="<?php echo base_url ?>assets/vendor/feather-icons/feather.min.js" crossorigin="anonymous"></script>
        <!-- Core theme JS-->
        <script src="<?php echo base_url ?>assets/js/scripts.js"></script>
    </body>
</html>
