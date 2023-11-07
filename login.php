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
        </style>
    </head>
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
                                        <form class="user" action="logincode.php" method="POST">
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
                                            <button type="submit" name="login_btn" id="loginButton" class="btn btn-primary btn-user btn-block">Login</button>
                                        </form>
                                        <label class="h6 text-gray-900 mt-3">By clicking login you agree the <a href="#">terms and conditions</a> and <a href="#">privacy policy</a>.</lab>
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
        <!-- Script for save last inputed Email or Password -->
        <script>
            // Restore input values from localStorage when the page loads
            window.onload = function() {
                var emailPhoneInput = document.getElementById("email");
                var passwordInput = document.getElementById("password");
                
                if (localStorage.getItem("savedEmailPhone")) {
                    emailPhoneInput.value = localStorage.getItem("savedEmailPhone"); // Gets the value email or phone from localstorage or cookie
                    localStorage.setItem("savedEmailPhone", ''); // Clear the value email or phone if user click reload the page.
                }
                
                if (localStorage.getItem("savedPassword")) {
                    passwordInput.value = localStorage.getItem("savedPassword"); // Gets the value password from localstorage or cookie
                    localStorage.setItem("savedPassword", ''); // Clear the value password if user click reload the page.
                }
            };

            // Save input values to localStorage when the login button is clicked
            document.getElementById("loginButton").addEventListener("click", function() {
                var emailPhoneInput = document.getElementById("email");
                var passwordInput = document.getElementById("password");
                
                localStorage.setItem("savedEmailPhone", emailPhoneInput.value); // Will save the value email or phone from localstorage or cookie
                localStorage.setItem("savedPassword", passwordInput.value); // Will save the value password from localstorage or cookie
            });
        </script>

        <script>
            $(document).ready(function() {
                // disable submit button by default
                //$('#submit-btn').prop('disabled', true);

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

        <!-- Sweetalert message popup -->
        <?php include ('message.php'); ?> 
    </body>
</html>