<?php
    include ('db_conn.php');
    if($_SESSION['is_second_auth'] == null){
        header("Location: " . base_url . "login");
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="<?= $system['description'] ?>">
        <meta name="keywords" content="<?= $system['keywords'] ?>">
        <meta name="author" content="<?= $system['author'] ?>">
        <!-- Title Page -->
        <title><?= $system['shortname'] ?> | Two Step Authentication</title>
        <!-- Favicons -->
        <link rel="shortcut icon" href="<?php echo base_url ?>assets/files/system/<?= $system['icon'] ?>" type="image/x-icon">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url ?>assets/files/system/<?= $system['icon'] ?>">
        <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url ?>assets/files/system/<?= $system['icon'] ?>">
        <!-- Remove Banner -->
        <script src="<?php echo base_url ?>assets/js/fwhabannerfix.js"></script>
        <!-- Custom fonts for this template-->
        <link href="<?php echo base_url ?>assets/vendor/font-awesome/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="<?php echo base_url ?>assets/css/custom.css" rel="stylesheet">
        <!-- Loader CSS -->
        <link href="<?php echo base_url ?>assets/css/loader.css" rel="stylesheet">
        <!-- Cookie CSS -->
        <link href="<?php echo base_url ?>assets/css/cookie.css" rel="stylesheet">
        <!-- Custom styles for this template-->
        <link href="<?php echo base_url ?>assets/css/sb-admin-2.css" rel="stylesheet">
        <!-- Styles for center login -->
        <style>
            body{
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
                background-color: #f8f9fc;
            }
            .btn-close {
                box-sizing: content-box;
                width: 1em;
                height: 1em;
                padding: 0.25em 0.25em;
                color: #000;
                background: transparent url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23000'%3e%3cpath d='M.293.293a1 1 0 011.414 0L8 6.586 14.293.293a1 1 0 111.414 1.414L9.414 8l6.293 6.293a1 1 0 01-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 01-1.414-1.414L6.586 8 .293 1.707a1 1 0 010-1.414z'/%3e%3c/svg%3e") center/1em auto no-repeat;
                border: 0;
                border-radius: 0.35rem;
                opacity: 0.5;
            }
            .btn-close:hover {
                color: #000;
                text-decoration: none;
                opacity: 0.75;
            }
            .btn-close:focus {
                outline: 0;
                box-shadow: 0 0 0 0.25rem rgba(0, 97, 242, 0.25);
                opacity: 1;
            }
            .btn-close:disabled, .btn-close.disabled {
                pointer-events: none;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
                opacity: 0.25;
            }

            .btn-close-white {
                filter: invert(1) grayscale(100%) brightness(200%);
            }
            .disabled {
                cursor: not-allowed;
            }
            .alert{
                position: fixed !important;
            }
        </style>
    </head>
    <body class="bg-gradient-primary">
        <!-- Loading Screen -->
        <div class="noprint-scroll" id="loading">
            <img id="loading-image" src="<?php echo base_url ?>assets/files/system/loading.gif" alt="Loading" />
        </div>
        <div id="connectionAlert" class="alert"></div>
        <div class="container">
            <!-- Outer Row -->
            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-12 col-md-9">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-6 d-none d-lg-block bg-login-image" style="background: url('<?php echo base_url ?>assets/files/system/<?= $system['logo'] ?>'); background-position:center; background-size:cover; background-repeat:no-repeat;"></div>
                                <div class="col-lg-6 bg-light">
                                    <div class="p-3">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900"><?= $system['name'] ?></h1>
                                            <hr style="margin-top:5px !important; margin-bottom:5px !important">
                                            <h1 class="h4 text-gray-900 mb-4">Verify OTP</h1>
                                            <h5 class="text-gray-900">Open your email address and enter the code for <?= $system['shortname'] ?></h5>
                                        </div>
                                        <form class="user" id="form_verify" method="POST" enctype="multipart/form-data">
                                            <?php
                                                $user_email = $_SESSION['auth_user']['user_email'];
                                                $username = $_SESSION['auth_user']['user_name'];
                                            ?>
                                            <input type="hidden" class="form-control form-control-user" name="temp_email" id="temp_email" value="<?=$user_email?>">
                                            <div class="form-group">
                                                <label for="user_email" for="user_email">Your Email</label>
                                                <input type="text" class="form-control form-control-user" id="user_email" value="<?=htmlspecialchars($user_email);?>" disabled>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" id="verify_code" name="verify_code" class="form-control form-control-user" minlength="6" maxlength="6" placeholder="Enter OTP" required>
                                            </div>
                                            <button type="submit" id="verifyButton" class="btn btn-primary btn-user btn-block">Verify</button>
                                        </form>
                                        <div class="row mt-2">
                                            <div class="col-md-7 mt-1" id="countdown"></div>
                                            <button type="submit" class="col-md-4 btn-xs btn-primary disabled" id="resentButton" disabled>Resent OTP</button>
                                        </div>
                                        <hr>
                                        <div class="text-center">
                                            <form action="login" method="POST">
                                                <button type="submit" class="btn btn-link btn-sm text-decoration-none" name="notmyaccount">Not <?=htmlspecialchars($username);?>?</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
        </div>
        <!-- Sweetalert JavaScript -->
        <script src="<?php echo base_url ?>assets/js/sweetalert.js"></script>
        <!-- Bootstrap core JavaScript-->
        <script src="<?php echo base_url ?>assets/vendor/jquery/jquery.min.js"></script>
        <script src="<?php echo base_url ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Core plugin JavaScript-->
        <script src="<?php echo base_url ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>
        <!-- Loader JS File -->
        <script src="<?php echo base_url ?>assets/js/loader.js"></script>
        <!-- Validations forms -->
        <script src="<?php echo base_url ?>assets/js/jquery-3.2.1.min.js"></script>
        <script src="<?php echo base_url ?>assets/js/underscore-min.js"></script>
        <!-- Restrictions forms -->
        <script src="<?php echo base_url ?>assets/js/disable-key.js"></script>
        <!-- Serverstatus JS -->
        <script src="<?php echo base_url ?>assets/js/serverstatus.js"></script>
        <!-- Cookie Consent -->
        <script src="<?php echo base_url ?>assets/js/cookie.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="<?php echo base_url ?>assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo base_url ?>assets/js/scripts.js"></script>
        <script src="<?php echo base_url ?>assets/vendor/feather-icons/feather.min.js" crossorigin="anonymous"></script>

        <!-- Sweetalert message popup -->
        <?php include ('message.php'); ?> 

        <script type="text/javascript">
            var base_url = "<?php echo base_url ?>";
            $(document).ready(function() {
                // 2FA verify
                $('#form_verify').submit(function (e) {
                    e.preventDefault(); // Prevent the default form submission
                    var formData = new FormData(this);
                    formData.append('verify_btn', '1'); // Identifier
                    $.ajax({
                        url: "loginauthcode.php",
                        method: "POST",
                        data: formData,
                        dataType: "json",
                        contentType: false,
                        cache: false,
                        processData: false,
                        beforeSend: function() {
                            $('#verify_code').attr('disabled', 'disabled');
                            $('#verifyButton').text("Please wait...");
                            $('#verifyButton').attr('disabled', 'disabled');
                            setTimeout(function() {
                                $('#verifyButton').attr('disabled', 'disabled');
                            }, 450);
                        },
                        success: function(data) {
                            if (data.alert == 'success') {
                                if (data.type == 'admin') {
                                    window.location.href = base_url + "admin";
                                } else {
                                    window.location.href = base_url + "staff";
                                }
                            } else {
                                swal({
                                    title: "Notice",
                                    text: data.status,
                                    icon: data.alert,
                                    button: false,
                                    timer: 2000
                                }).then(function() {
                                    $('#verify_code').removeAttr('disabled');
                                    $('#verifyButton').text("Verify");
                                    $('#verifyButton').removeAttr('disabled');
                                });
                            }
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            console.error(errorThrown);
                        }
                    });
                });
            });
        </script>

        <script type="text/javascript">
            $(document).ready(function() {
                // Resend OTP
                $('#resentButton').click(function() {
                    var formData = new FormData();
                    formData.append('send_otp', '1'); // Identifier
                    $.ajax({
                        url: "loginauthcode.php",
                        method: "POST",
                        data: formData,
                        dataType: "json",
                        contentType: false,
                        cache: false,
                        processData: false,
                        beforeSend: function() {
                            $('#resentButton').text("Please wait...");
                        },
                        success: function(data) {
                            swal({
                                title: "Notice",
                                text: data.status,
                                icon: data.alert,
                                button: false,
                                timer: 2000
                            }).then(function() {
                                $('#resentButton').text("Resent OTP");
                            });
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            console.error(errorThrown);
                        }
                    });
                });
            });
        </script>

        <script>
            const countdownElement = document.getElementById("countdown");
            const resentButton = document.getElementById("resentButton");

            let countdown = parseFloat(localStorage.getItem("countdown")) || 60; // Default to 1 minute (60 seconds)
            let timer;

            function updateCountdown() {
                countdownElement.innerText = `Time remaining: ${Math.floor(countdown % 60)
                    .toString()
                    .padStart(2, "0")}`;
            }

            function startCountdown() {
                timer = setInterval(function () {
                    countdown -= 1;
                    localStorage.setItem("countdown", countdown); // Store the updated countdown value
                    updateCountdown();
                    if (countdown <= 0) {
                        clearInterval(timer);
                        resentButton.removeAttribute('disabled');
                        $('#resentButton').removeClass('disabled');
                    }
                }, 1000);
            }

            resentButton.addEventListener("click", function () {
                countdown = 60; // Reset the countdown to 1 minute (60 seconds)
                localStorage.setItem("countdown", countdown); // Save the countdown value
                updateCountdown();
                resentButton.setAttribute('disabled', 'disabled');
                $('#resentButton').addClass('disabled');
                startCountdown();
            });

            updateCountdown();
            if (countdown > 0) {
                startCountdown();
            } else {
                resentButton.removeAttribute('disabled');
                $('#resentButton').removeClass('disabled');
            }
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