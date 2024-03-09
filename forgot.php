<?php include ('db_conn.php'); ?>
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
        <title><?= $system['shortname'] ?> | Forgot</title>
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
        <!-- Styles for center forgot -->
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
            .alert{
                position: fixed !important;
            }
        </style>
    </head>
    <?php
        if(isset($_SESSION['auth'])){
            if ($_SESSION['auth_role'] == "1"){
                if(!isset($_SESSION['status'])){
                $_SESSION['status'] = "You are already logged in";
                $_SESSION['status_code'] = "error";
                }
                header("Location: " . base_url . "admin");
                exit(0);
            }
            elseif ($_SESSION['auth_role'] == "2"){
                if(!isset($_SESSION['status'])){
                $_SESSION['status'] = "You are already logged in";
                $_SESSION['status_code'] = "error";
                }
                header("Location: " . base_url . "staff");
                exit(0);
            }
            else{
                if(!isset($_SESSION['status'])){
                    $_SESSION['status'] = "Login first to access dashboard";
                    $_SESSION['status_code'] = "error";
                }
                header("Location: " . base_url . "login");
                exit(0);
            }
        }
    ?>
    <body class="bg-primary">
        <!-- Loading Screen -->
        <div class="noprint-scroll" id="loading">
            <img id="loading-image" src="<?php echo base_url ?>assets/files/system/loading.gif" alt="Loading" />
        </div>
        <div id="connectionAlert" class="alert"></div>
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container-xl px-4">
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <!-- Basic forgot password form-->
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header justify-content-center"><h4 class="fw-light my-4">Password Recovery | <?= $system['name'] ?></h4></div>
                                    <div class="card-body">
                                        <div class="small mb-3 text-muted">Enter your email address and we will send you a link to reset your password.</div>
                                        <!-- Forgot password form-->
                                        <form id="form_forgot" method="POST" enctype="multipart/form-data">
                                            <!-- Form Group (email address)-->
                                            <div class="mb-3">
                                                <label class="small mb-1" for="email">Email</label>
                                                <input class="form-control" name="email" id="email" type="email" aria-describedby="emailHelp" placeholder="Enter email address" required>
                                                <div class="invalid-feedback ml-3" id="email-error"></div>
                                            </div>
                                            <!-- Form Group (submit options)-->
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="login">Return to login</a>
                                                <button type="submit" class="btn btn-primary" id="submit-btn">Reset Password</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
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

        <script type="text/javascript">
            $(document).ready(function() {
                // Forgot password
                $('#form_forgot').submit(function (e) {
                    e.preventDefault(); // Prevent the default form submission
                    var formData = new FormData(this);
                    formData.append('forgot_btn', '1'); // Identifier
                    $.ajax({
                        url: "forgotcode.php",
                        method: "POST",
                        data: formData,
                        dataType: "json",
                        contentType: false,
                        cache: false,
                        processData: false,
                        beforeSend: function() {
                            $('#submit-btn').text("Please wait...");
                            $('#email').attr('disabled', 'disabled');
                            $('#submit-btn').attr('disabled', 'disabled');
                        },
                        success: function(data) {
                            swal({
                                title: "Notice",
                                text: data.status,
                                icon: data.alert,
                                button: false,
                                timer: data.timer
                            }).then(function() {
                                $('#form_forgot')[0].reset();
                                $('#email').removeAttr('disabled');
                                $('#submit-btn').removeAttr('disabled');
                                $('#email').removeClass('is-valid');
                                $('#submit-btn').text("Reset Password");
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
            $(document).ready(function() {
                // disable submit button by default
                //$('#submit-btn').prop('disabled', true);

                // debounce functions for each input field
                var debouncedCheckEmail = _.debounce(checkEmail, 500);

                // attach event listeners for each input field
                $('#email').on('input', debouncedCheckEmail);
                $('#email').on('focusout', checkEmail); // Add focusout event listener
                $('#email').on('blur', debouncedCheckEmail); // Trigger on input change

                function checkEmail() {
                    var email = $('#email').val();

                    // show error if email is empty
                    if (email === '') {
                        $('#email-error').text('Please input email').css('color', 'red');
                        $('#email').addClass('is-invalid'); // Update selector to 'email'
                        $('#submit-btn').prop('disabled', true);
                        return;
                    }

                    // check if email format is valid
                    var emailPattern = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/i;
                    if (!emailPattern.test(email)) {
                        $('#email-error').text('Invalid email format').css('color', 'red');
                        $('#email').addClass('is-invalid'); // Update selector to 'email'
                        $('#submit-btn').prop('disabled', true);
                        return;
                    }

                    // Clear error if email is valid
                    $('#email-error').empty();
                    $('#email').removeClass('is-invalid'); // Update selector to 'email'
                    $('#email').addClass('is-valid'); // Update selector to 'email'
                    checkIfAllFieldsValid();
                }

                function checkIfAllFieldsValid() {
                    // check if all input fields are valid and enable submit button if so
                    if ($('#email-error').is(':empty')) {
                        $('#submit-btn').prop('disabled', false);
                    }
                }
            });
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
        
        <!-- Sweetalert message popup -->
        <?php include ('message.php'); ?> 
    </body>
</html>