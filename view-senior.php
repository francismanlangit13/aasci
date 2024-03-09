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
        <!-- Remove Banner -->
        <script src="<?php echo base_url ?>assets/js/fwhabannerfix.js"></script>
        <!-- Icons -->
        <script src="<?php echo base_url ?>assets/vendor/font-awesome/js/all.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo base_url ?>assets/vendor/feather-icons/feather.min.js" crossorigin="anonymous"></script>
        <!-- Custom CSS -->
        <link href="<?php echo base_url ?>assets/css/custom.css" rel="stylesheet">
        <!-- Loader CSS -->
        <link href="<?php echo base_url ?>assets/css/loader.css" rel="stylesheet">
        <!-- Cookie CSS -->
        <link href="<?php echo base_url ?>assets/css/cookie.css" rel="stylesheet">
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="<?php echo base_url ?>assets/css/styles.css" rel="stylesheet" />
        <!-- GlightBox -->
        <link href="<?php echo base_url ?>assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
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
            .circle-image {
                width: 120px; /* Set your desired width */
                height: 120px; /* Set your desired height */
                border-radius: 50%; /* Make it a circle by setting border-radius to 50% */
                overflow: hidden; /* Hide any content that goes beyond the circle */
            }

            .circle-image img {
                width: 100%; /* Make the image fill the circle container */
                height: auto; /* Maintain the aspect ratio of the image */
                display: block; /* Remove any default inline spacing */
            }
            .alert {
                position: fixed !important;
            }
        </style>
    </head>
    <body>
        <!-- Loading Screen -->
        <div class="noprint-scroll" id="loading">
            <img id="loading-image" src="<?php echo base_url ?>assets/files/system/loading.gif" alt="Loading" />
        </div>
        <div id="connectionAlert" class="alert"></div>
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
            error_reporting(E_ERROR | E_PARSE);
            if(isset($_GET['id'])){
                if ($_GET['referrer_sig'] == 'AQAAALlBtMUw4ijnuwuB1_ELMGm0j_LDQFR7JkepuUdtEUZlkWR_E8B1hpz84xnQcU2MWhGqYgqw1M2fKXNWP3tcP42AxniLgydvkoy2WHzQOrWSrT6wxtCsmk3ClX7csfHjkNFfHrR3BY5Q1evqYO43BcH51CGey1yhnFoukIyF7OPU') {
                    $id = $_GET['id'];
                    $senior = "SELECT *, CASE WHEN is_deceased = 'Yes' THEN TIMESTAMPDIFF(YEAR, birthday, deceased_date) ELSE TIMESTAMPDIFF(YEAR, birthday, CURDATE()) END AS age FROM `user` WHERE `user_id` = $id AND `user_type_id` = '3' AND `user_status_id` != '3' LIMIT 1";
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
                        <!-- Side widget-->
                        <div class="card mb-4">
                            <div class="card-header">Recent Announcements</div>
                            <div class="card-body">
                                <?php
                                    $query = "SELECT *, DATE_FORMAT(ann_date, '%M %d, %Y %h:%i %p') as short_date FROM `announcement` WHERE `ann_status` = 'Posted' AND ann_date ORDER BY ann_date DESC LIMIT 4";
                                    $query_run = mysqli_query($con, $query);
                                    $check_announcement = mysqli_num_rows($query_run) > 0;
                                    if($check_announcement){
                                        $data_array = array();
                                        while($annrow = mysqli_fetch_array($query_run)){
                                ?>
                                <div class="card mt-3" style="border: 1.5px solid #000000 !important; color:black !important; font-size:12px">
                                    <div class="card-header" style="background-color:#b5f1ff;">Title: <?php echo $annrow['ann_title']; ?>
                                        <br>
                                        <span class="float-start">Date: <?php echo $annrow['short_date']; ?></span>
                                    </div>
                                    <div class="card-body">
                                        <h6 class="card-title" style="font-size:14px"><?php echo $annrow['ann_description']; ?></h6>
                                    </div>
                                </div>
                                <?php } } else { echo "No Announcements"; } ?>
                            </div>
                        </div>
                        <!-- Categories widget-->
                        <div class="card mb-4">
                            <div class="card-header">Your Clearance (<?= $row['fname'] .' '. $row['mname'] .' '. $row['lname'] .' '. $row['suffix'] ?>)</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12 row">
                                        <div class="col-md-4 text-center">
                                            <div class="circle-image mb-5">
                                                <a href="
                                                    <?php
                                                        if(isset($row['profile'])){
                                                            if(!empty($row['profile'])) {
                                                                echo base_url . 'assets/files/clients/' . $row['profile'];
                                                        } else { echo base_url . 'assets/files/system/no-image.png'; } }
                                                    ?>" class="glightbox" data-gallery="portfolioGallery" title="<?php echo"Name: "; echo $row['fname'] . ' ' . $row['mname'] . ' ' . $row['lname'] . ' ' . $row['suffix']; ?>">
                                                    <img class="zoom img-fluid img-bordered-sm"
                                                    src="
                                                        <?php
                                                            if(isset($row['profile'])){
                                                                if(!empty($row['profile'])) {
                                                                    echo base_url . 'assets/files/clients/' . $row['profile'];
                                                            } else { echo base_url . 'assets/files/system/no-image.png'; } }
                                                        ?>
                                                    " alt="image" style="height: 120px; max-width: 200px; object-fit: cover">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <h5 class="mt-4">Name: <?= $row['fname'] .' '. $row['mname'] .' '. $row['lname'] .' '. $row['suffix'] ?></h5>
                                            <h5>ID Number: <?= $row['id_number']; ?></h5>
                                            <h5>Age: <?= $row['age']; ?></h5>
                                        </div>
                                    </div>
                                    <hr>
                                    <h4>Documents</h4>
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
                                    <hr>
                                    <div class="col-sm-12">
                                        <?php
                                            $annual_query = "SET @sql = NULL;
                                                SELECT GROUP_CONCAT(DISTINCT 'MAX(CASE WHEN year = \"', year, '\" THEN amount END) AS `', year, '`') INTO @columns
                                                FROM annual_dues;
                                                SET @sql = CONCAT('SELECT user.*, ', @columns, ' FROM user
                                                INNER JOIN annual_dues ON annual_dues.user_id = user.user_id
                                                WHERE user.user_id = ', " . (int)$id . ", '  -- Cast to integer for safety
                                                GROUP BY user.id_number');
                                                PREPARE stmt FROM @sql;
                                                EXECUTE stmt;
                                                DEALLOCATE PREPARE stmt;
                                            ";
                        
                                            // Execute the SQL query
                                            $con->multi_query($annual_query);
                        
                                            // Move to the fifth result set (assuming four additional queries before)
                                            for ($i = 0; $i < 4; $i++) {
                                                $con->next_result();
                                            }
                        
                                            // Fetch the result of the fifth query
                                            $result = $con->store_result();
                                        ?>
                                        <h4>Annual Dues</h4>
                                            <div class="row">
                                                <?php
                                                    if ($result->num_rows > 0) {
                                                        while ($annualrow = $result->fetch_assoc()) {
                                                            
                                                            echo '<div class="col-md-4"><code>2018:</code> ' . (isset($annualrow['2018']) ? $annualrow['2018'] : "") . ' ' . (isset($annualrow['2018']) ? "<i class='fas fa-check-circle' style='color:blue' title='Paid' ></i>" : "") . '</div>';
                                                            echo '<div class="col-md-4"><code>2019:</code> ' . (isset($annualrow['2019']) ? $annualrow['2019'] : "") . ' ' . (isset($annualrow['2019']) ? "<i class='fas fa-check-circle' style='color:blue' title='Paid' ></i>" : "") . '</div>';
                                                            echo '<div class="col-md-4"><code>2020:</code> ' . (isset($annualrow['2020']) ? $annualrow['2020'] : "") . ' ' . (isset($annualrow['2020']) ? "<i class='fas fa-check-circle' style='color:blue' title='Paid' ></i>" : "") . '</div>';
                                                            echo '<div class="col-md-4"><code>2021:</code> ' . (isset($annualrow['2021']) ? $annualrow['2021'] : "") . ' ' . (isset($annualrow['2021']) ? "<i class='fas fa-check-circle' style='color:blue' title='Paid' ></i>" : "") . '</div>';
                                                            echo '<div class="col-md-4"><code>2022:</code> ' . (isset($annualrow['2022']) ? $annualrow['2022'] : "") . ' ' . (isset($annualrow['2022']) ? "<i class='fas fa-check-circle' style='color:blue' title='Paid' ></i>" : "") . '</div>';
                                                            echo '<div class="col-md-4"><code>2023:</code> ' . (isset($annualrow['2023']) ? $annualrow['2023'] : "") . ' ' . (isset($annualrow['2023']) ? "<i class='fas fa-check-circle' style='color:blue' title='Paid' ></i>" : "") . '</div>';
                                                            echo '<div class="col-md-4"><code>2024:</code> ' . (isset($annualrow['2024']) ? $annualrow['2024'] : "") . ' ' . (isset($annualrow['2024']) ? "<i class='fas fa-check-circle' style='color:blue' title='Paid' ></i>" : "") . '</div>';
                                                        }
                                                    } else {
                                                        echo '<div class="col-md-4">No Data.</div>';
                                                    }
                                                ?>
                                            </div>
                                    </div>
                                </div>
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
            <!-- Cookie Consent -->
            <div class="wrapper">
                <img src="<?php echo base_url ?>assets/files/system/cookie.png" alt="">
                <div class="content">
                    <header>Cookies Consent</header>
                    <p>Cookies help us deliver our services. By using our services, you agree to our use of cookies. <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#btn_cookie">Cookie Policy</a>. For information on how we protect your privacy, please read our <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#btn_privacy">Privacy Policy</a>.</p>
                    <div class="buttons">
                        <button class="item">I accept</button>
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
        <!-- Bootstrap JavaScript -->
        <script src="<?php echo base_url ?>assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <!-- Loader JS File -->
        <script src="<?php echo base_url ?>assets/js/loader.js"></script>
        <!-- Serverstatus JS -->
        <script src="<?php echo base_url ?>assets/js/serverstatus.js"></script>
        <!-- Cookie Consent -->
        <script src="<?php echo base_url ?>assets/js/cookie.js"></script>
        <!-- GlightBox -->
        <script src="<?php echo base_url ?>assets/vendor/glightbox/js/glightbox.js"></script>
        <script>
            var lightbox = GLightbox();
            lightbox.on('open', (target) => {
                console.log('lightbox opened');
            });
            var lightboxDescription = GLightbox({
                selector: '.glightbox2'
            });
            var lightboxVideo = GLightbox({
                selector: '.glightbox3'
            });
            lightboxVideo.on('slide_changed', ({ prev, current }) => {
                console.log('Prev slide', prev);
                console.log('Current slide', current);

                const { slideIndex, slideNode, slideConfig, player } = current;

                if (player) {
                    if (!player.ready) {
                        // If player is not ready
                        player.on('ready', (event) => {
                            // Do something when video is ready
                        });
                    }

                    player.on('play', (event) => {
                        console.log('Started play');
                    });

                    player.on('volumechange', (event) => {
                        console.log('Volume change');
                    });

                    player.on('ended', (event) => {
                        console.log('Video ended');
                    });
                }
            });

            var lightboxInlineIframe = GLightbox({
                selector: '.glightbox4'
            });

            /* var exampleApi = GLightbox({ selector: null });
            exampleApi.insertSlide({
                href: 'https://picsum.photos/1200/800',
            });
            exampleApi.insertSlide({
                width: '500px',
                content: '<p>Example</p>'
            });
            exampleApi.insertSlide({
                href: 'https://www.youtube.com/watch?v=WzqrwPhXmew',
            });
            exampleApi.insertSlide({
                width: '200vw',
                content: document.getElementById('inline-example')
            });
            exampleApi.open(); */
        </script>

        <!-- Modal for View Privacy -->
        <div class="modal fade" id="btn_privacy" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="view_userLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg d-grid" role="document" style="justify-items: center;">
                <div class="modal-content">
                    <div class="modal-header card-header">
                        <h6 class="modal-title"><?= $system['shortname'] ?> | Privacy Policy</h6>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div> 
                    <div class="modal-body"> 
                        <h6 style="text-align: justify; text-justify:inter-word"><?= $system['privacy'] ?></h5>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal for View Terms -->
        <div class="modal fade" id="btn_terms" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="view_userLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg d-grid" role="document" style="justify-items: center;">
                <div class="modal-content">
                    <div class="modal-header card-header">
                        <h6 class="modal-title"><?= $system['shortname'] ?> | Terms & Conditions</h6>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div> 
                    <div class="modal-body"> 
                        <h6 style="text-align: justify; text-justify:inter-word"><?= $system['terms'] ?></h6>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal for View Cookie -->
        <div class="modal fade" id="btn_cookie" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="view_userLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg d-grid" role="document" style="justify-items: center;">
                <div class="modal-content">
                    <div class="modal-header card-header">
                        <h6 class="modal-title"><?= $system['shortname'] ?> | Use of Cookie</h6>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div> 
                    <div class="modal-body"> 
                        <h6 style="text-align: justify; text-justify:inter-word"><?= $system['cookie'] ?></h6>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
