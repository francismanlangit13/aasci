<?php
    include ('db_conn.php');
    if(isset($_POST['notmyaccount'])){
        unset($_SESSION['auth_user']);
    }
    if(isset($_SESSION['auth_user']) && $_SESSION['auth_user'] != null) {
        header("Location: " . base_url . "loginauth");
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
        <title><?= $system['shortname'] ?> | Login</title>
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
    <body class="bg-gradient-primary">
        <!-- Loading Screen -->
        <div class="noprint-scroll" id="loading">
            <img id="loading-image" src="<?php echo base_url ?>assets/files/system/loading.gif" alt="Loading" />
        </div>
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
                                    <div class="p-4">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900"><?= $system['name'] ?></h1>
                                            <hr style="margin-top:5px !important; margin-bottom:5px !important">
                                            <h1 class="h4 text-gray-900 mb-4">LOGIN</h1>
                                        </div>
                                        <form class="user" id="form_login" method="POST" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <input type="text" id="email" name="email_phone" class="form-control form-control-user" placeholder="Email" required>
                                                <div class="invalid-feedback ml-3" id="email-error"></div>
                                            </div>
                                            <div class="form-group">
                                                <div class="password-container">
                                                    <label for="password"><span class="password-toggle"><i class="fa fa-eye"></i> Show</span></label>
                                                    <input type="password" id="password" name="password" class="form-control form-control-user" minlength="8" placeholder="Password" required>
                                                    <div class="invalid-feedback ml-3" id="password-error"></div>
                                                </div>
                                            </div>
                                            <button type="submit" id="submit-btn" class="btn btn-primary btn-user btn-block">Login</button>
                                        </form>
                                        <label class="h6 text-gray-900 mt-3">By clicking login you agree the <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#btn_terms">terms and conditions</a> and <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#btn_privacy">privacy policy</a>.</lab>
                                        <hr>
                                        <div class="text-center">
                                            <a class="small text-decoration-none" href="forgot">Forgot Password?</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sweetalert JavaScript -->
        <script src="<?php echo base_url ?>assets/js/sweetalert.js"></script>
        <!-- Show password login JavaScript -->
        <script src="<?php echo base_url ?>assets/js/show-password-login.js"></script>
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
        <!-- Bootstrap JavaScript -->
        <script src="<?php echo base_url ?>assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo base_url ?>assets/js/scripts.js"></script>
        <script src="<?php echo base_url ?>assets/vendor/feather-icons/feather.min.js" crossorigin="anonymous"></script>

        <script type="text/javascript">
            var base_url = "<?php echo base_url ?>";
            $(document).ready(function() {
                // Forgot password
                $('#form_login').submit(function (e) {
                    e.preventDefault(); // Prevent the default form submission
                    var formData = new FormData(this);
                    formData.append('login_btn', '1'); // Identifier
                    $.ajax({
                        url: "logincode.php",
                        method: "POST",
                        data: formData,
                        dataType: "json",
                        contentType: false,
                        cache: false,
                        processData: false,
                        beforeSend: function() {
                            $('#email').attr('disabled', 'disabled');
                            $('#password').attr('disabled', 'disabled');
                            $('#submit-btn').text("Please wait...");
                            $('#submit-btn').attr('disabled', 'disabled');
                            setTimeout(function() {
                                $('#submit-btn').attr('disabled', 'disabled');
                            }, 450);
                        },
                        success: function(data) {
                            if (data.alert == 'success' && data.is_secondauth == 'Yes') {
                                window.location.href = base_url + "loginauth";
                            } else if (data.alert == 'success' && data.is_secondauth == 'No') {
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
                                    $('#email').removeAttr('disabled');
                                    $('#password').removeAttr('disabled');
                                    $('#submit-btn').text("Login");
                                    $('#submit-btn').removeAttr('disabled');
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

        <script>
            $(document).ready(function() {

                // debounce functions for each input field
                var debouncedCheckEmail = _.debounce(checkEmail, 500);
                var debouncedCheckPassword = _.debounce(checkPassword, 500);

                // attach event listeners for each input field
                $('#email').on('input', debouncedCheckEmail);
                $('#email').on('focusout', checkEmail); // Add focusout event listener
                $('#email').on('blur', debouncedCheckEmail); // Trigger on input change
                $('#password').on('input', debouncedCheckPassword);
                $('#password').on('focusout', checkPassword); // Add focusout event listener
                $('#password').on('blur', debouncedCheckPassword); // Trigger on input change

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

                function checkPassword() {
                    var password = $('#password').val();

                    // show error if password is empty
                    if (password === '') {
                        $('#password-error').text('Please input password').css('color', 'red');
                        $('#password').addClass('is-invalid'); // Update selector to 'password'
                        $('#submit-btn').prop('disabled', true);
                        return;
                    }

                    // check if password format is valid
                    var passwordPattern = /^.{8,}$/i;
                    if (!passwordPattern.test(password)) {
                        $('#password-error').text('At least 8 minimum characters').css('color', 'red');
                        $('#password').addClass('is-invalid'); // Update selector to 'password'
                        $('#submit-btn').prop('disabled', true);
                        return;
                    }

                    // Clear error if password is valid
                    $('#password-error').empty();
                    $('#password').removeClass('is-invalid'); // Update selector to 'password'
                    $('#password').addClass('is-valid'); // Update selector to 'password'
                    checkIfAllFieldsValid();
                }

                function checkIfAllFieldsValid() {
                    // check if all input fields are valid and enable submit button if so
                    if ($('#email-error').is(':empty') && $('#password-error').is(':empty')) {
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

        <!-- Sweetalert message popup -->
        <?php include ('message.php'); ?> 
    </body>
</html>