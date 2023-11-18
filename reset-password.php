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
        if (isset($_GET["key"]) && isset($_GET["email"]) && isset($_GET["action"]) && ($_GET["action"]=="reset") && !isset($_POST["action"])){
        $key = $_GET["key"];
        $email = $_GET["email"];
        $curDate = date("Y-m-d H:i:s");
        $query = mysqli_query($con,"SELECT * FROM `password_reset_temp` WHERE `key`='".$key."' and `email`='".$email."';");
        $row = mysqli_num_rows($query);
        if ($row==""){
            $_SESSION['status'] = "The link is invalid or expired.";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "forgot");
            exit(0);
        }
        else{
            $row = mysqli_fetch_assoc($query);
	        $expDate = $row['expDate'];
	        if ($expDate >= $curDate){
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
                                <!-- Basic reset password form-->
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header justify-content-center"><h4 class="fw-light my-4">Password Recovery | <?= $system['name'] ?></h4></div>
                                    <div class="card-body">
                                        <div class="small mb-3 text-muted">Enter your email address and we will send you a link to reset your password.</div>
                                        <!-- Reset password form-->
                                        <form id="form_changepass" method="POST" enctype="multipart/form-data">
                                            <!-- Form Group (new password)-->
                                            <div class="mb-3">
                                                <label class="small mb-1" for="password">New password</label>
                                                <a href="javascript:void(0)" class="password-toggle float-right text-decoration-none" onclick="togglePassword('password')">
                                                    <i class="fa fa-eye"></i> Show
                                                </a>
                                                <input class="form-control" name="password" id="password" type="password" placeholder="Enter new password" required>
                                                <div class="invalid-feedback ml-3" id="password-error"></div>
                                            </div>
                                            <!-- Form Group (confirm new password)-->
                                            <div class="mb-3">
                                                <label class="small mb-1" for="cpassword">Confirm password</label>
                                                <a href="javascript:void(0)" class="password-toggle float-right text-decoration-none" onclick="togglePassword('cpassword')">
                                                    <i class="fa fa-eye"></i> Show
                                                </a>
                                                <input class="form-control" name="cpassword" id="cpassword" type="password" placeholder="Enter confirm new password" required>
                                                <div class="invalid-feedback ml-3" id="cpassword-error"></div>
                                            </div>
                                            <!-- Form Group (submit options)-->
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="login">Return to login</a>
                                                <input type="hidden" name="email" value = "<?php echo $email; ?>"/>
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
            var base_url = "<?php echo base_url ?>";
            $(document).ready(function() {
                // Forgot password
                $('#form_changepass').submit(function (e) {
                    e.preventDefault(); // Prevent the default form submission
                    var formData = new FormData(this);
                    formData.append('changepass_btn', '1'); // Identifier
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
                            $('#submit-btn').attr('disabled', 'disabled');
                            $('#password').attr('disabled', 'disabled');
                            $('#cpassword').attr('disabled', 'disabled');
                        },
                        success: function(data) {
                            if(data.alert = 'success') {
                                window.location.href = base_url + "login";
                            } else {
                                swal({
                                    title: "Notice",
                                    text: data.status,
                                    icon: data.alert,
                                    button: false,
                                    timer: 2000
                                }).then(function() {
                                    $('#form_changepass')[0].reset();
                                    $('#submit-btn').removeAttr('disabled');
                                    $('#password').removeAttr('disabled');
                                    $('#cpassword').removeAttr('disabled');
                                    $('#submit-btn').text("Reset Password");
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
            // Get references to the password fields and label
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('cpassword');
            const confirmLabel = document.querySelector('label[for="cpassword"]');

            // Function to check if passwords match and update required class
            function checkPasswords() {
                if (passwordInput.value) {
                confirmLabel.classList.add('required');
                } else {
                confirmLabel.classList.remove('required');
                }

                if (passwordInput.value !== confirmPasswordInput.value) {
                confirmPasswordInput.setCustomValidity("Passwords do not match");
                } else {
                confirmPasswordInput.setCustomValidity("");
                }
            }

            // Add event listeners to the password fields
            passwordInput.addEventListener('input', checkPasswords);
            confirmPasswordInput.addEventListener('input', checkPasswords);
        </script>

        <script>
            $(document).ready(function() {
                // debounce functions for each input field
                var debouncedCheckPassword = _.debounce(checkPassword, 500);
                var debouncedCheckCPassword = _.debounce(checkCPassword, 500);

                // attach event listeners for each input field
                $('#password').on('input', debouncedCheckPassword);
                $('#password').on('focusout', checkPassword); // Add focusout event listener
                $('#password').on('blur', debouncedCheckPassword); // Trigger on input change
                $('#cpassword').on('input', debouncedCheckCPassword);
                $('#cpassword').on('focusout', checkCPassword); // Add focusout event listener
                $('#cpassword').on('blur', debouncedCheckCPassword); // Trigger on input change

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

                function checkCPassword() {
                var password = $('#password').val();
                var cpassword = $('#cpassword').val();

                // show error if cpassword is empty
                if (cpassword === '') {
                    $('#cpassword-error').text('Please input confirm password').css('color', 'red');
                    $('#cpassword').addClass('is-invalid'); // Update selector to 'password'
                    $('#submit-btn').prop('disabled', true);
                    return;
                }

                // check if cpassword format is valid
                var passwordCPattern = /^.{8,}$/i;
                if (!passwordCPattern.test(cpassword)) {
                    $('#cpassword-error').text('At least 8 minimum characters').css('color', 'red');
                    $('#cpassword').addClass('is-invalid'); // Update selector to 'password'
                    $('#submit-btn').prop('disabled', true);
                    return;
                }

                if (password != cpassword) {
                    $('#cpassword-error').text('Password does not match').css('color', 'red');
                    $('#cpassword').addClass('is-invalid'); // Update selector to 'password'
                    $('#submit-btn').prop('disabled', true);
                    return;
                }

                // Clear error if cpassword is valid
                $('#cpassword-error').empty();
                $('#cpassword').removeClass('is-invalid'); // Update selector to 'password'
                $('#cpassword').addClass('is-valid'); // Update selector to 'password'
                checkIfAllFieldsValid();
                }

                function checkIfAllFieldsValid() {
                // check if all input fields are valid and enable submit button if so
                if ($('#password-error').is(':empty') && $('#cpassword-error').is(':empty')) {
                    $('#submit-btn').prop('disabled', false);
                }
                }
            });
        </script>

        <script type="text/javascript">
            function togglePassword(inputId) {
                const passwordInput = document.getElementById(inputId);

                if (passwordInput) {
                    const passwordToggle = passwordInput.parentElement.querySelector('.password-toggle');

                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        if (passwordToggle) {
                            passwordToggle.innerHTML = '<i class="fa fa-eye-slash"></i> Hide';
                        }
                    } else {
                        passwordInput.type = 'password';
                        if (passwordToggle) {
                            passwordToggle.innerHTML = '<i class="fa fa-eye"></i> Show';
                        }
                    }
                }
            }
        </script>

        <!-- Sweetalert message popup -->
        <?php include ('message.php'); ?> 
    </body>
    <?php } } } ?>
</html>