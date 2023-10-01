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
                            Account Settings - Profile
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-4">
        <!-- Account page navigation-->
        <nav class="nav nav-borders">
            <a class="nav-link active ms-0" href="account-profile.html">Profile</a>
            <a class="nav-link" href="account-security.html">Security</a>
            <a class="nav-link" href="account-notifications.html">Notifications</a>
        </nav>
        <hr class="mt-0 mb-4" />
        <div class="row">
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
                        <form>
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (First Name)-->
                                <div class="col-md-3">
                                    <label class="small mb-1" for="fname">First name</label>
                                    <input class="form-control" id="fname" type="text" placeholder="Enter your first name" value="<?=$user['fname'];?>" />
                                </div>
                                <!-- Form Group (Middle Name)-->
                                <div class="col-md-3">
                                    <label class="small mb-1" for="inputFirstName">Middle name</label>
                                    <input class="form-control" id="inputFirstName" type="text" placeholder="Enter your middle name" value="<?=$user['mname'];?>" />
                                </div>
                                <!-- Form Group (Last Name)-->
                                <div class="col-md-3">
                                    <label class="small mb-1" for="inputLastName">Last name</label>
                                    <input class="form-control" id="inputLastName" type="text" placeholder="Enter your last name" value="<?=$user['lname'];?>" />
                                </div>
                                <!-- Form Group (Suffix)-->
                                <div class="col-md-3">
                                    <label class="small mb-1" for="suffix">Suffix</label>
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
                                    <label class="small mb-1" for="civil_status">Civil Status</label>
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
                                    <label class="small mb-1" for="email">Email</label>
                                    <input class="form-control" id="email" type="email" placeholder="Enter your email" value="<?=$user['email'];?>" />
                                </div>
                                <!-- Form Group (Phone Number)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="phone">Phone</label>
                                    <input class="form-control" id="phone" type="text" name="phone" placeholder="Enter your phone" value="<?=$user['phone'];?>" />
                                </div>
                            </div>
                            <!-- Save changes button-->
                            <button class="btn btn-primary float-end" type="button">Save changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Modal for Upload profile-->
<div class="modal fade" id="Upload_Profile"  data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleUpload_Profile" aria-hidden="true">
    <div class="modal-dialog" role="document">
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