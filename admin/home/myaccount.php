<?php 
    include ('../includes/header.php'); 
    $user = $user_qry->fetch_assoc();
?>
<head>
    <!-- Website Title -->
    <title><?= $system['shortname'] ?> | My Account</title>
    <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
    <style>
        #uploadForm label {
            margin: 2px;
            font-size: 1em;
        }

        #progress-bar {
            background-color: #12CC1A;
            color: #FFFFFF;
            width: 0%;
            -webkit-transition: width .3s;
            -moz-transition: width .3s;
            transition: width .3s;
            border-radius: 5px;
        }

        #targetLayer {
            width: 100%;
            text-align: center;
        }
    </style>
</head>
<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="user"></i></div>
                            Account Settings
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Account Information -->
    <!-- Main page content-->
    <div class="container-xl px-4 mt-4">
        <!-- Account page navigation-->
        <nav class="nav nav-borders">
            <a href="javascript:void(0)" class="nav-link selected-tab active ms-0" data-target="profile-tab">Profile</a>
            <a href="javascript:void(0)" class="nav-link selected-tab" data-target="security-tab">Security</a>
        </nav>
        <hr class="mt-0 mb-4" />
        <div id="profile-tab" class="row myaccount-tab">
            <div class="col-xl-4">
                <!-- Profile picture card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Profile Picture</div>
                    <div class="card-body text-center">
                        <!-- Profile picture image-->
                        <img class="img-account-profile rounded-circle mb-2" id="profile-image" alt="profile" style="object-fit: cover; width: 180px; height: 180px; overflow: hidden; position: relative;" />
                        <!-- Profile picture help block-->
                        <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                        <!-- Profile picture upload button-->
                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#Upload_Profile">Upload new image</button>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-header">Account Details</div>
                    <div class="card-body">
                        <form id="personal-information">
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (First Name)-->
                                <div class="col-md-3">
                                    <label class="small mb-1 required" for="fname">First name</label>
                                    <input class="form-control" id="fname" name="fname" type="text" placeholder="Enter your first name" value="<?=$user['fname'];?>" required/>
                                    <div id="fname-error"></div>
                                </div>
                                <!-- Form Group (Middle Name)-->
                                <div class="col-md-3">
                                    <label class="small mb-1" for="mname">Middle name</label>
                                    <input class="form-control" id="mname" name="mname" type="text" placeholder="Enter your middle name" value="<?=$user['mname'];?>" />
                                    <div id="mname-error"></div>
                                </div>
                                <!-- Form Group (Last Name)-->
                                <div class="col-md-3">
                                    <label class="small mb-1 required" for="lname">Last name</label>
                                    <input class="form-control" id="lname" name="lname" type="text" placeholder="Enter your last name" value="<?=$user['lname'];?>" required/>
                                    <div id="lname-error"></div>
                                </div>
                                <!-- Form Group (Suffix)-->
                                <div class="col-md-3">
                                    <label class="small mb-1 required" for="suffix">Suffix</label>
                                    <select class="form-control" id="suffix" name="suffix">
                                        <option value="" selected>Select Suffix</option>
                                        <option value="" <?= isset($user['suffix']) && $user['suffix'] == '' ? 'selected' : '' ?>>None</option>
                                        <option value="Jr" <?= isset($user['suffix']) && $user['suffix'] == 'Jr' ? 'selected' : '' ?>>Jr</option>
                                        <option value="Sr" <?= isset($user['suffix']) && $user['suffix'] == 'Sr' ? 'selected' : '' ?>>Sr</option>
                                        <option value="I" <?= isset($user['suffix']) && $user['suffix'] == 'I' ? 'selected' : '' ?>>I</option>
                                        <option value="II" <?= isset($user['suffix']) && $user['suffix'] == 'II' ? 'selected' : '' ?>>II</option>
                                        <option value="III" <?= isset($user['suffix']) && $user['suffix'] == 'III' ? 'selected' : '' ?>>III</option>
                                        <option value="IV" <?= isset($user['suffix']) && $user['suffix'] == 'IV' ? 'selected' : '' ?>>IV</option>
                                        <option value="V" <?= isset($user['suffix']) && $user['suffix'] == 'V' ? 'selected' : '' ?>>V</option>
                                        <option value="VI" <?= isset($user['suffix']) && $user['suffix'] == 'VI' ? 'selected' : '' ?>>VI</option>
                                    </select>
                                    <div id="suffix-error"></div>
                                </div>
                            </div>
                            <!-- Form Row -->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (Civil Status)-->
                                <div class="col-md-6">
                                    <label class="small mb-1 required" for="civil_status">Civil Status</label>
                                    <select id="civil_status" name="civil_status" required class="form-control">
                                        <option value="" selected>Select Civil Status</option>
                                        <option value="Single" <?= isset($user['civil_status']) && $user['civil_status'] == 'Single' ? 'selected' : '' ?>>Single</option>
                                        <option value="Married" <?= isset($user['civil_status']) && $user['civil_status'] == 'Married' ? 'selected' : '' ?>>Married</option>
                                        <option value="Widowed" <?= isset($user['civil_status']) && $user['civil_status'] == 'Widowed' ? 'selected' : '' ?>>Widowed</option>
                                        <option value="Separated" <?= isset($user['civil_status']) && $user['civil_status'] == 'Separated' ? 'selected' : '' ?>>Separated</option>
                                    </select>
                                    <div id="civil_status-error"></div>
                                </div>
                                <!-- Form Group (Birthday)-->
                                <div class="col-md-6">
                                    <label for="birthday" class="required">Birthday</label>
                                    <input required class="form-control" id="birthday" name="birthday" placeholder="MM/DD/YYY" value="<?=$user['birthday'];?>" type="date"/>
                                    <div id="birthday-error"></div>
                                </div>
                            </div>
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (Email Address)-->
                                <div class="col-md-6">
                                    <label class="small mb-1 required" for="email">Email</label>
                                    <input class="form-control" id="email" name="email" type="email" placeholder="Enter your email" value="<?=$user['email'];?>" required/>
                                    <div id="email-error"></div>
                                </div>
                                <!-- Form Group (Phone Number)-->
                                <div class="col-md-6">
                                    <label class="small mb-1 required" for="phone">Phone</label>
                                    <input class="form-control" id="phone" type="text" name="phone" placeholder="Enter your phone" value="<?=$user['phone'];?>" required/>
                                    <div id="phone-error"></div>
                                </div>
                            </div>
                            <!-- Save changes button-->
                            <button class="btn btn-primary float-end" type="submit" id="btn_change_info">Save changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Password and Security -->
        <div id="security-tab" class="row myaccount-tab d-none">
            <div class="col-lg-8">
                <!-- Change password card-->
                <div class="card mb-4">
                    <div class="card-header">Change Password</div>
                    <div class="card-body">
                        <form id="password-information">
                            <!-- Form Group (current password)-->
                            <div class="mb-3">
                                <label class="small mb-1 required" for="currentPassword">Current Password</label>
                                <input class="form-control" id="currentPassword" name="currentPassword" type="password" placeholder="Enter current password" required/>
                            </div>
                            <!-- Form Group (new password)-->
                            <div class="mb-3">
                                <label class="small mb-1 required" for="newPassword">New Password</label>
                                <input class="form-control" id="newPassword" name="newPassword" type="password" placeholder="Enter new password" required/>
                            </div>
                            <!-- Form Group (confirm password)-->
                            <div class="mb-3">
                                <label class="small mb-1 required" for="confirmPassword">Confirm Password</label>
                                <input class="form-control" id="confirmPassword" name="confirmPassword" type="password" placeholder="Confirm new password" required/>
                            </div>
                            <button class="btn btn-primary float-end" type="submit" id="btn_change_password">Save</button>
                        </form>
                    </div>
                </div>
                <!-- Security preferences card-->
                <div class="card mb-4">
                    <div class="card-header">Security Preferences</div>
                    <div class="card-body">
                        <form id="security-information">
                            <!-- Account privacy optinos-->
                            <h5 class="mb-1">Account Privacy</h5>
                            <p class="small text-muted">By setting your account to private, your profile information and posts will not be visible to users outside of your user groups.</p>
                            <div class="form-check">
                                <input class="form-check-input" id="radioPrivacy1" type="radio" name="radioPrivacy" value="ON" <?php if($user['account_privacy']=="1") {?> <?php echo "checked";?> <?php }?>/>
                                <label class="form-check-label" for="radioPrivacy1">Public</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" id="radioPrivacy2" type="radio" name="radioPrivacy" value="OFF" <?php if($user['account_privacy']=="0") {?> <?php echo "checked";?> <?php }?>/>
                                <label class="form-check-label" for="radioPrivacy2">Private</label>
                            </div>
                            <hr class="my-4" />
                            <!-- Data sharing options-->
                            <h5 class="mb-1">Data Sharing</h5>
                            <p class="small text-muted">Sharing usage data can help us to improve our products and better serve our users as they navigation through our application. When you agree to share usage data with us, crash reports and usage analytics will be automatically sent to our development team for investigation.</p>
                            <div class="form-check">
                                <input class="form-check-input" id="radioUsage1" type="radio" name="radioUsage" value="ON" <?php if($user['data_sharing']=="1") {?> <?php echo "checked";?> <?php }?>/>
                                <label class="form-check-label" for="radioUsage1">Yes</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" id="radioUsage2" type="radio" name="radioUsage" value="OFF" <?php if($user['data_sharing']=="0") {?> <?php echo "checked";?> <?php }?>/>
                                <label class="form-check-label" for="radioUsage2">No</label>
                            </div>
                            <button class="btn btn-primary mt-2 float-end" type="submit" id="btn_security_preferences">Save</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <!-- Two factor authentication card-->
                <div class="card mb-4">
                    <div class="card-header">Two-Factor Authentication</div>
                    <div class="card-body">
                        <p>Add another level of security to your account by enabling two-factor authentication. We will send you a email to verify your login attempts on unrecognized devices and browsers.</p>
                        <form id="authentication-information">
                            <div class="form-check">
                                <input class="form-check-input" id="twoFactorOn" name="twoFactor" type="radio" name="twoFactor" value="ON" <?php if($user['second_auth']=="1") {?> <?php echo "checked";?> <?php }?>/>
                                <label class="form-check-label" for="twoFactorOn">On</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" id="twoFactorOff" name="twoFactor" type="radio" name="twoFactor" value="OFF" <?php if($user['second_auth']=="0") {?> <?php echo "checked";?> <?php }?>/>
                                <label class="form-check-label" for="twoFactorOff">Off</label>
                            </div>
                            <button class="btn btn-primary mt-2 float-end" type="submit" id="btn_authentication">Save</button>
                        </form>
                    </div>
                </div>
                <!-- Delete account card-->
                <div class="card mb-4">
                    <div class="card-header">Delete Account</div>
                    <div class="card-body">
                        <p>Deleting your account is a permanent action and cannot be undone. If you are sure you want to delete your account, select the button below.</p>
                        <button class="btn btn-danger-soft text-danger" type="button" data-bs-toggle="modal" data-bs-target="#Delete_Account">I understand, delete my account</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Modal for Upload profile-->
<div class="modal fade" id="Upload_Profile"  data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleUpload_Profile" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="uploadForm" action="upload.php" method="post">
                <div class="modal-header">
                    Upload an Image
                    <button class="btn-close" type="button" id="btn_cancel_update_profile" data-bs-dismiss="modal" aria-label="Close" onclick="addModalclose(this)"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body text-center">
                        <!-- Profile picture image-->
                        <div class="circle-container">
                            <img class="img-account-profile rounded-circle mb-2" id="frame1" src="<?php if(!empty($user['profile'])){
                                echo base_url . 'assets/files/users/' . $user['profile'];
                            } else { 
                                if($user['gender'] == 'Male'){
                                    echo base_url . 'assets/files/system/profile-male.png'; 
                                } else { 
                                    echo base_url . 'assets/files/system/profile-female.png'; 
                                } 
                            } ?>" alt="upload_profile" style="object-fit:cover; width:180px; height:180px; overflow:hidden; position:relative;" />
                        </div>
                        <!-- Profile picture help block-->
                        <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                        <!-- Profile picture upload button-->
                        <input type="file" name="image1" id="image1" class="form-control-file btn btn-primary mb-1" accept=".jpg, .jpeg, .png" onchange="previewImage('frame1', 'image1')">
                        <input type="hidden" name="oldimage" id="old-profile-image">
                        <div class="row">
                            <div id="progress-bar"></div>
                        </div>
                        <div id="targetLayer"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btn_update_profile" name="upload_profile" class="btn btn-danger"><div class="dropdown-item-icon"><i style="margin-right:2px" data-feather="upload"></i></div> Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal for Delete account-->
<div class="modal fade" id="Delete_Account" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleDelete_Account" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="delete-information">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Delete your account</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6 class="mb-3" style="text-align:justify;" id="delete-password-text"><small>To verify that it's you, you need to input a password to continue.</small></h6>
                    <h5 class="mb-3 d-none" style="text-align:justify;" id="delete-password-text1"><small>If you delete your account, you won't have access to this system again or be able to retrieve your account once you click 'Delete My Account.'</small></h5>
                        <!-- Form Group (current password)-->
                        <div id="form-password" class="mb-3">
                            <label class="small mb-1 required" for="yourPassword">Current Password</label>
                            <input class="form-control" id="yourPassword" name="yourPassword" type="password" placeholder="Enter current password" required/>
                        </div>
                        <input id="isDelete" name="isDelete" type="hidden"/>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit" id="btn_delete_account">Proceed</button>
                    <button class="btn btn-danger d-none" type="submit" id="btn_delete_account1" disabled>Delete my account</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Script for multi-tabs -->
<script>
    // Get all the navigation links
    const navLinks = document.querySelectorAll('.selected-tab');
    const contentSections = document.querySelectorAll('.myaccount-tab');
    // Add a click event listener to each link
    navLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            // Get the target element's id from the data-target attribute
            const targetId = this.getAttribute('data-target');
            // Remove the 'active' class from all navigation links
            navLinks.forEach(navLink => {
                navLink.classList.remove('active');
            });
            // Add the 'active' class to the clicked link
            this.classList.add('active');
            // Hide all content elements
            contentSections.forEach(element => {
                element.classList.add('d-none');
            });
            // Show the target content element
            document.getElementById(targetId).classList.remove('d-none');
        });
    });
</script>

<!-- Ajax for Change Info -->
<script>
    $(document).ready(function () {
        // Submit form via AJAX
        $('#personal-information').submit(function (e) {
            e.preventDefault(); // Prevent the default form submission
            var formData = new FormData(this);
            formData.append('update_info', '1');
            $.ajax({
                type: 'POST', // You can change this to 'GET' or other HTTP methods as needed
                url: 'ajax.php', // Replace with the actual URL to handle form submission
                data: formData,
                processData: false, // Prevent jQuery from processing data
                cache: false,
                contentType: false, // Prevent jQuery from setting content type
                beforeSend: function() {
                    $('#btn_change_info').attr('disabled', 'disabled');
                },
                success: function(data) {
                    data = JSON.parse(data); // Parse the JSON response
                    swal({
                        title: "Notice",
                        text: data.status,
                        icon: data.alert,
                        button: true
                    }).then(function() {
                        $('#btn_change_info').removeAttr('disabled');
                        // Call updateUserData after successful image upload
                        updateUserData();
                    });
                },
                error: function (xhr, status, error) {
                // Handle any errors that occur during the AJAX request
                console.error('Error:', error);
                }
            });
        });
    });
</script>

<!-- Ajax for Change Password -->
<script>
    $(document).ready(function () {
        // Submit form via AJAX
        $('#password-information').submit(function (e) {
            e.preventDefault(); // Prevent the default form submission
            var formData = new FormData(this);
            formData.append('change_password', '1');
            $.ajax({
                type: 'POST', // You can change this to 'GET' or other HTTP methods as needed
                url: 'ajax.php', // Replace with the actual URL to handle form submission
                data: formData,
                processData: false, // Prevent jQuery from processing data
                cache: false,
                contentType: false, // Prevent jQuery from setting content type
                beforeSend: function() {
                    $('#btn_change_password').attr('disabled', 'disabled');
                },
                success: function(data) {
                    data = JSON.parse(data); // Parse the JSON response
                    swal({
                        title: "Notice",
                        text: data.status,
                        icon: data.alert,
                        button: true
                    }).then(function() {
                        if(data.alert == 'warning'){
                            $('#currentPassword').val(''); // Set the value to an empty string
                        } else{
                            $('#currentPassword').val('');
                            $('#newPassword').val('');
                            $('#confirmPassword').val('');
                        }
                        $('#btn_change_password').removeAttr('disabled');
                        // Call updateUserData after successful image upload
                        updateUserData();
                    });
                },
                error: function (xhr, status, error) {
                // Handle any errors that occur during the AJAX request
                console.error('Error:', error);
                }
            });
        });
    });
</script>

<!-- Ajax for Delete account verify -->
<script>
    $(document).ready(function () {
        // Submit form via AJAX
        $('#delete-information').submit(function (e) {
            e.preventDefault(); // Prevent the default form submission
            var formData = new FormData(this);
            formData.append('delete_account', '1');
            $.ajax({
                type: 'POST',
                url: 'ajax.php', 
                data: formData,
                processData: false,
                cache: false,
                contentType: false,
                beforeSend: function() {
                    $('#btn_delete_account').attr('disabled', 'disabled');
                },
                success: function(data) {
                    data = JSON.parse(data); // Parse the JSON response
                    if(data.alert == 'info'){
                        $('#yourPassword').val('').hide().removeAttr('required');
                        $('#delete-password-text').addClass('d-none');
                        $('#form-password').hide();
                        $('#isDelete').val('1').hide();
                        $('#btn_delete_account').hide();
                        $('#delete-password-text1').removeClass('d-none');
                        $('#btn_delete_account1').removeClass('d-none').removeAttr('disabled');
                    } else {
                        if(data.alert == 'success'){
                            setTimeout(function () {
                                window.location.href = base_url + 'login';
                            }, 5000);
                        }
                        swal({
                            title: "Notice",
                            text: data.status,
                            icon: data.alert,
                            button: true,
                        }).then(function() {
                            if(data.alert == 'warning'){
                                $('#yourPassword').val(''); // Set the value to an empty string
                            }
                            $('#btn_delete_account').removeAttr('disabled');
                            // Call updateUserData after successful image upload
                            updateUserData();
                        });
                    }
                },
                error: function (xhr, status, error) {
                // Handle any errors that occur during the AJAX request
                console.error('Error:', error);
                }
            });
        });
    });
</script>

<!-- Ajax for 2FA -->
<script>
    $(document).ready(function () {
        // Submit form via AJAX
        $('#authentication-information').submit(function (e) {
            e.preventDefault(); // Prevent the default form submission
            var formData = new FormData(this);
            formData.append('authentication', '1');
            $.ajax({
                type: 'POST', // You can change this to 'GET' or other HTTP methods as needed
                url: 'ajax.php', // Replace with the actual URL to handle form submission
                data: formData,
                processData: false, // Prevent jQuery from processing data
                cache: false,
                contentType: false, // Prevent jQuery from setting content type
                beforeSend: function() {
                    $('#btn_authentication').attr('disabled', 'disabled');
                },
                success: function(data) {
                    data = JSON.parse(data); // Parse the JSON response
                    swal({
                        title: "Notice",
                        text: data.status,
                        icon: data.alert,
                        button: true
                    }).then(function() {
                        $('#btn_authentication').removeAttr('disabled');
                        // Call updateUserData after successful image upload
                        updateUserData();
                    });
                },
                error: function (xhr, status, error) {
                // Handle any errors that occur during the AJAX request
                console.error('Error:', error);
                }
            });
        });
    });
</script>

<!-- Ajax for Security -->
<script>
    $(document).ready(function () {
        // Submit form via AJAX
        $('#security-information').submit(function (e) {
            e.preventDefault(); // Prevent the default form submission
            var formData = new FormData(this);
            formData.append('security', '1');
            $.ajax({
                type: 'POST', // You can change this to 'GET' or other HTTP methods as needed
                url: 'ajax.php', // Replace with the actual URL to handle form submission
                data: formData,
                processData: false, // Prevent jQuery from processing data
                cache: false,
                contentType: false, // Prevent jQuery from setting content type
                beforeSend: function() {
                    $('#btn_security_preferences').attr('disabled', 'disabled');
                },
                success: function(data) {
                    data = JSON.parse(data); // Parse the JSON response
                    swal({
                        title: "Notice",
                        text: data.status,
                        icon: data.alert,
                        button: true
                    }).then(function() {
                        $('#btn_security_preferences').removeAttr('disabled');
                        // Call updateUserData after successful image upload
                        updateUserData();
                    });
                },
                error: function (xhr, status, error) {
                // Handle any errors that occur during the AJAX request
                console.error('Error:', error);
                }
            });
        });
    });
</script>

<!-- Ajax Profile Display -->
<script>
    // Function to update the user's data
    function updateUserData() {
        // Create a FormData object
        const formData = new FormData();
        // Append the get_profile parameter
        formData.append('get_profile', '1');
        // Make an AJAX request to the server
        $.ajax({
            url: 'ajax.php',
            type: 'POST',
            data: formData,
            processData: false,  // Prevent jQuery from processing the data
            contentType: false,  // Prevent jQuery from setting content type
            dataType: 'json',
            success: function (data) {
                // Check if the response data contains a profile property
                if (data.profile !== undefined && data.profile !== null && data.profile !== '') {
                    // Update the profile image source
                    const profileImage = document.getElementById('profile-image');
                    profileImage.src = '<?php echo base_url ?>assets/files/users/' + data.profile;
                    var oldprofileImage = document.getElementById('old-profile-image');
                    oldprofileImage.value = data.profile;
                } else {
                    // Set a default profile image source based on gender
                    const profileImage = document.getElementById('profile-image');
                    profileImage.src = data.gender === 'Male' ? '<?php echo base_url ?>assets/files/system/profile-male.png' : '<?php echo base_url ?>assets/files/system/profile-female.png';
                }
            },
            error: function (xhr, status, error) {
                // Handle errors here
                console.error(xhr.responseText);
            }
        });
    }
    // Call the function to update user data initially
    updateUserData();
</script>

<!-- Ajax for Image Upload -->
<script type="text/javascript">
    $(document).ready(function () {
        $('#uploadForm').submit(function (e) {
            e.preventDefault(); // Prevent the default form submission
            var formData = new FormData($(this)[0]);
            formData.append('update_profile', '1'); // Use the correct identifier for profile image update
            // Reset the progress bar to 0% before making the AJAX request
            $('#progress-bar').width('0%');
            $('#progress-bar').html('<div id="progress-status" class="text-center">0%</div>');
            $.ajax({
                url: "ajax.php",
                type: "POST",
                dataType: "json",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                xhr: function () {
                    var xhr = new window.XMLHttpRequest();
                    // Upload progress
                    xhr.upload.addEventListener("progress", function (evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = (evt.loaded / evt.total) * 100;
                            $('#progress-bar').width(percentComplete + '%');
                            $('#progress-bar').html('<div id="progress-status" class="text-center">' + percentComplete + ' %</div>');
                        }
                    }, false);
                    return xhr;
                },
                beforeSend: function() {
                    $('#btn_update_profile').attr('disabled', 'disabled');
                    $('#btn_cancel_update_profile').attr('disabled', 'disabled');
                },
                success: function(data) {
                    swal({
                        title: "Notice",
                        text: data.status,
                        icon: data.alert,
                        button: true
                    }).then(function() {
                        $('#Upload_Profile').modal('hide');
                        $('#uploadForm')[0].reset();
                        $('#progress-bar').html('<div id="progress-status" class="text-center">0%</div>');
                        $('#progress-bar').empty();
                        $('#progress-bar').width('0%');
                        // Call updateUserData after successful image upload
                        updateUserData();
                    });
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.error(errorThrown);
                },
                complete: function() {
                    // Re-enable the buttons and reset the progress bar after completion
                    $('#btn_update_profile').removeAttr('disabled');
                    $('#btn_cancel_update_profile').removeAttr('disabled');
                }
            });
        });
    });
</script>


<?php include ('../includes/footer.php'); ?>