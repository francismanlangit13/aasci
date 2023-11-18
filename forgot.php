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
        <!-- Loader CSS -->
        <link href="<?php echo base_url ?>assets/css/loader.css" rel="stylesheet">
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
        <!-- Sweetalert message popup -->
        <?php include ('message.php'); ?> 
    </body>
</html>