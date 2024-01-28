<?php 
    include ('../includes/header.php');
?>
<head>
    <!-- Website Title -->
    <title><?= $system['shortname'] ?> | System Settings</title>
    <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
    <!-- include summernote css/js -->
    <script src="<?php echo base_url ?>assets/js/jquery-3.5.1.min.js"></script>
    <link href="<?php echo base_url ?>assets/vendor/summernote/summernote-lite.css" rel="stylesheet">
    <script src="<?php echo base_url ?>assets/vendor/summernote/summernote-lite.js"></script>
    <style>
        #IconuploadForm label {
            margin: 2px;
            font-size: 1em;
        }
        #LogouploadForm label {
            margin: 2px;
            font-size: 1em;
        }
        #icon-progress-bar {
            background-color: #12CC1A;
            color: #FFFFFF;
            width: 0%;
            -webkit-transition: width .3s;
            -moz-transition: width .3s;
            transition: width .3s;
            border-radius: 5px;
        }
        #logo-progress-bar {
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
                            <div class="page-header-icon"><i data-feather="globe"></i></div>
                            Website Settings
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
            <a href="javascript:void(0)" class="nav-link selected-tab active ms-0" data-target="panel-tab">Panel</a>
            <a href="javascript:void(0)" class="nav-link selected-tab" data-target="social-tab">Social</a>
            <a href="javascript:void(0)" class="nav-link selected-tab" data-target="advanced-tab">Advanced</a>
        </nav>
        <hr class="mt-0 mb-4" />
        <div id="panel-tab" class="row myaccount-tab">
            <div class="col-xl-4">
                <!-- System icon picture card-->
                <div class="card mb-4 mb-xl-3">
                    <div class="card-header">System Icon</div>
                    <div class="card-body text-center">
                        <!-- Icon picture image-->
                        <img class="img-account-profile rounded-circle mb-2" id="sysicon-image" alt="system_icon" style="object-fit: cover; width: 180px; height: 180px; overflow: hidden; position: relative;" />
                        <!-- Icon picture help block-->
                        <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                        <!-- Icon picture upload button-->
                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#Upload_System_Icon">Upload new image</button>
                    </div>
                </div>
                <!-- System logo picture card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">System Logo</div>
                    <div class="card-body text-center">
                        <!-- Logo picture image-->
                        <img class="img-account-profile rounded-circle mb-2" id="syslogo-image" alt="system_logo" style="object-fit: cover; width: 180px; height: 180px; overflow: hidden; position: relative;" />
                        <!-- Logo picture help block-->
                        <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                        <!-- Logo picture upload button-->
                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#Upload_System_Logo">Upload new image</button>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <!-- System information card-->
                <div class="card mb-4">
                    <div class="card-header">System Information</div>
                    <div class="card-body">
                        <form id="system-information">
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (System Title)-->
                                <div class="col-md-12 mb-3">
                                    <label class="small mb-1 required" for="system_name">System Title</label>
                                    <input class="form-control" id="system_name" name="system_name" type="text" placeholder="Enter system title" value="<?= $system['name'] ?>" required/>
                                    <div id="system_name-error"></div>
                                </div>
                                <!-- Form Group (System Short Name)-->
                                <div class="col-md-12 mb-3">
                                    <label class="small mb-1 required" for="system_short_name">System Short Name</label>
                                    <input class="form-control" id="system_short_name" name="system_short_name" type="text" placeholder="Enter system short name" value="<?=$system['shortname'];?>" required/>
                                    <div id="system_short_name-error"></div>
                                </div>
                                <!-- Form Group (System Description)-->
                                <div class="col-md-12 mb-3">
                                    <label class="small mb-1 required" for="system_description">System Description</label>
                                    <input class="form-control" id="system_description" name="system_description" type="text" placeholder="Enter system description" value="<?=$system['description'];?>" required/>
                                    <div id="system_description-error"></div>
                                </div>
                                <!-- Form Group (System Keywords)-->
                                <div class="col-md-12 mb-3">
                                    <label class="small mb-1 required" for="system_keywords">System Keywords</label>
                                    <input class="form-control" id="system_keywords" name="system_keywords" type="text" placeholder="Enter system keywords" value="<?=$system['keywords'];?>" required/>
                                    <div id="system_keywords-error"></div>
                                </div>
                                <!-- Form Group (System Author)-->
                                <div class="col-md-12 mb-3">
                                    <label class="small mb-1 required" for="system_author">System Author</label>
                                    <input class="form-control" id="system_author" name="system_author" type="text" placeholder="Enter system author" value="<?=$system['author'];?>" required/>
                                    <div id="system_author-error"></div>
                                </div>
                            </div>
                            <!-- Save changes button-->
                            <button class="btn btn-primary float-end" type="submit" id="btn_update_system_information">Save changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Social Tab -->
        <div id="social-tab" class="row myaccount-tab d-none">
            <div class="col-lg-4">
                <!-- System logo picture card-->
                <div class="card card-header-actions mb-4">
                    <div class="card-header">
                        Facebook
                        <div class="form-check form-switch">
                            <input class="form-check-input" id="switch_facebook" onchange="FacebooktoggleEventLog()" type="checkbox" <?php if ($system_switch['facebook']=='1') { echo 'checked'; } ?> />
                            <label class="form-check-label" for="switch_facebook"></label>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <form id="system-facebook">
                            <!-- Profile picture image-->
                            <img class="img-account-profile rounded-circle mb-2" alt="system_logo" style="object-fit: cover; width: 180px; height: 180px; overflow: hidden; position: relative; <?php if ($system_switch['facebook']=='0') { echo 'filter: grayscale(100%);'; } ?>" id="image_facebook" src="<?php echo base_url ?>assets/files/system/system_facebook.png"/>
                            <!-- Profile picture upload button-->
                            <div class="col-md-12 mb-3">
                                <label class="small mb-1 required float-start" for="system_facebook">Facebook</label>
                                <input class="form-control" id="system_facebook" name="system_facebook" type="text" placeholder="Enter facebook link" value="<?=$system['facebook'];?>" required/>
                                <div id="system_facebook-error"></div>
                            </div>
                            <button class="btn btn-primary float-end mt-3" type="submit" id="btn_facebook">Save</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <!-- System logo picture card-->
                <div class="card card-header-actions mb-4">
                    <div class="card-header">
                        Instagram
                        <div class="form-check form-switch">
                            <input class="form-check-input" id="switch_instagram" onchange="InstagramtoggleEventLog()" type="checkbox" <?php if ($system_switch['instagram']=='1') { echo 'checked'; } ?> />
                            <label class="form-check-label" for="switch_instagram"></label>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <form id="system-instagram">
                            <!-- Profile picture image-->
                            <img class="img-account-profile rounded-circle mb-2" alt="system_logo" style="object-fit: cover; width: 180px; height: 180px; overflow: hidden; position: relative; <?php if ($system_switch['instagram']=='0') { echo 'filter: grayscale(100%);'; } ?>" id="image_instagram" src="<?php echo base_url ?>assets/files/system/system_instagram.png"/>
                            <!-- Profile picture upload button-->
                            <div class="col-md-12 mb-3">
                                <label class="small mb-1 required float-start" for="system_instagram">Instagram</label>
                                <input class="form-control" id="system_instagram" name="system_instagram" type="text" placeholder="Enter instagram link" value="<?=$system['instagram'];?>" required/>
                                <div id="system_instagram-error"></div>
                            </div>
                            <button class="btn btn-primary float-end mt-3" type="submit" id="btn_instagram">Save</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <!-- System logo picture card-->
                <div class="card card-header-actions mb-4">
                    <div class="card-header">
                        Twitter
                        <div class="form-check form-switch">
                            <input class="form-check-input" id="switch_twitter" onchange="TwittertoggleEventLog()" type="checkbox" <?php if ($system_switch['twitter']=='1') { echo 'checked'; } ?> />
                            <label class="form-check-label" for="switch_twitter"></label>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <form id="system-twitter">
                            <!-- Profile picture image-->
                            <img class="img-account-profile rounded-circle mb-2" alt="system_logo" style="object-fit: cover; width: 180px; height: 180px; overflow: hidden; position: relative; <?php if ($system_switch['twitter']=='0') { echo 'filter: grayscale(100%);'; } ?>" id="image_twitter" src="<?php echo base_url ?>assets/files/system/system_twitter.png"/>
                            <!-- Profile picture upload button-->
                            <div class="col-md-12 mb-3">
                                <label class="small mb-1 required float-start" for="system_twitter">Twitter</label>
                                <input class="form-control" id="system_twitter" name="system_twitter" type="text" placeholder="Enter twitter link" value="<?=$system['twitter'];?>" required/>
                                <div id="system_twitter-error"></div>
                            </div>
                            <button class="btn btn-primary float-end mt-3" type="submit" id="btn_twitter">Save</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <!-- System logo picture card-->
                <div class="card card-header-actions mb-4">
                    <div class="card-header">
                        Tumblr
                        <div class="form-check form-switch">
                            <input class="form-check-input" id="switch_tumblr" onchange="TumblrtoggleEventLog()" type="checkbox" <?php if ($system_switch['tumblr']=='1') { echo 'checked'; } ?> />
                            <label class="form-check-label" for="switch_tumblr"></label>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <form id="system-tumblr">
                            <!-- Profile picture image-->
                            <img class="img-account-profile rounded-circle mb-2" alt="system_logo" style="object-fit: cover; width: 180px; height: 180px; overflow: hidden; position: relative; <?php if ($system_switch['tumblr']=='0') { echo 'filter: grayscale(100%);'; } ?>" id="image_tumblr" src="<?php echo base_url ?>assets/files/system/system_tumblr.png"/>
                            <!-- Profile picture upload button-->
                            <div class="col-md-12 mb-3">
                                <label class="small mb-1 required float-start" for="system_tumblr">Tumblr</label>
                                <input class="form-control" id="system_tumblr" name="system_tumblr" type="text" placeholder="Enter tumblr link" value="<?=$system['tumblr'];?>" required/>
                                <div id="system_tumblr-error"></div>
                            </div>
                            <button class="btn btn-primary float-end mt-3" type="submit" id="btn_tumblr">Save</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <!-- System logo picture card-->
                <div class="card card-header-actions mb-4">
                    <div class="card-header">
                        Email
                        <div class="form-check form-switch">
                            <input class="form-check-input" id="switch_email" onchange="EmailtoggleEventLog()" type="checkbox" <?php if ($system_switch['email']=='1') { echo 'checked'; } ?> />
                            <label class="form-check-label" for="switch_email"></label>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <form id="system-email">
                            <!-- Profile picture image-->
                            <img class="img-account-profile rounded-circle mb-2" alt="system_logo" style="object-fit: cover; width: 180px; height: 180px; overflow: hidden; position: relative; <?php if ($system_switch['email']=='0') { echo 'filter: grayscale(100%);'; } ?>" id="image_email" src="<?php echo base_url ?>assets/files/system/system_email.png"/>
                            <!-- Profile picture upload button-->
                            <div class="col-md-12 mb-3">
                                <label class="small mb-1 required float-start" for="system_email">Email</label>
                                <input class="form-control" id="system_email" name="system_email" type="email" placeholder="Enter email" value="<?=$system['email'];?>" required/>
                                <div id="system_email-error"></div>
                            </div>
                            <button class="btn btn-primary float-end mt-3" type="submit" id="btn_email">Save</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <!-- System logo picture card-->
                <div class="card card-header-actions mb-4">
                    <div class="card-header">
                        Phone
                        <div class="form-check form-switch">
                            <input class="form-check-input" id="switch_number" onchange="PhonetoggleEventLog()" type="checkbox" <?php if ($system_switch['number']=='1') { echo 'checked'; } ?> />
                            <label class="form-check-label" for="switch_number"></label>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <form id="system-phone">
                            <!-- Profile picture image-->
                            <img class="img-account-profile rounded-circle mb-2" alt="system_logo" style="object-fit: cover; width: 180px; height: 180px; overflow: hidden; position: relative; <?php if ($system_switch['number']=='0') { echo 'filter: grayscale(100%);'; } ?>" id="image_phone" src="<?php echo base_url ?>assets/files/system/system_phone.png"/>
                            <!-- Profile picture upload button-->
                            <div class="col-md-12 mb-3">
                                <label class="small mb-1 required float-start" for="system_number">Phone</label>
                                <input class="form-control" id="system_number" name="system_number" type="text" placeholder="Enter phone number" value="<?=$system['number'];?>" required/>
                                <div id="system_number-error"></div>
                            </div>
                            <button class="btn btn-primary float-end mt-3" type="submit" id="btn_phone">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Advanced Tab -->
        <div id="advanced-tab" class="row myaccount-tab d-none">
            <div class="row">
                <div class="col-xl-6">
                    <!-- System information card-->
                    <div class="card mb-4">
                        <div class="card-header">System Infomation (Privacy Policy)</div>
                        <div class="card-body">
                            <form id="system-information-privacy">
                                <!-- Form Row-->
                                <div class="row gx-3 mb-3">
                                    <!-- Form Group (System Privacy)-->
                                    <div class="col-md-12 mb-3">
                                        <textarea class="form-control" id="summernote-privacy" name="system_privacy" type="text" rows="20" placeholder="Enter system privacy policy" required><?= $system['privacy'] ?></textarea>
                                        <div id="system_privacy-error"></div>
                                    </div>
                                </div>
                                <!-- Save changes button-->
                                <button class="btn btn-primary float-end" type="submit" id="btn_update_system_information_privacy">Save changes</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <!-- System information card-->
                    <div class="card mb-4">
                        <div class="card-header">System Infomation (Terms & Condition)</div>
                        <div class="card-body">
                            <form id="system-information-terms">
                                <!-- Form Row-->
                                <div class="row gx-3 mb-3">
                                    <!-- Form Group (System Terms)-->
                                    <div class="col-md-12 mb-3">
                                        <textarea class="form-control" id="summernote-terms" name="system_terms" type="text" rows="20" placeholder="Enter system terms and condition" required><?= $system['terms'] ?></textarea>
                                        <div id="system_terms-error"></div>
                                    </div>
                                </div>
                                <!-- Save changes button-->
                                <button class="btn btn-primary float-end" type="submit" id="btn_update_system_information_terms">Save changes</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <!-- System information card-->
                    <div class="card mb-4">
                        <div class="card-header">System Infomation (Republic ACT)</div>
                        <div class="card-body">
                            <form id="system-information-act">
                                <!-- Form Row-->
                                <div class="row gx-3 mb-3">
                                    <!-- Form Group (System Terms)-->
                                    <div class="col-md-12 mb-3">
                                        <label for="system_title" class="required">Title</label>
                                        <input type="text" name="system_title" id="system_title" class="form-control" value="<?= $system['sysacttitle'] ?>" required>
                                        <div id="system_title-error"></div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <textarea class="form-control" id="summernote" name="system_act" type="text" rows="20" placeholder="Enter system republic act" required><?= $system['sysact'] ?></textarea>
                                        <div id="system_act-error"></div>
                                    </div>
                                </div>
                                <!-- Save changes button-->
                                <button class="btn btn-primary float-end" type="submit" id="btn_update_system_information_act">Save changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Modal for Upload system icon-->
<div class="modal fade" id="Upload_System_Icon"  data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleUpload_System_Icon" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="IconuploadForm" action="upload.php" method="post">
                <div class="modal-header">
                    Upload an system icon Image
                    <button class="btn-close" type="button" id="btn_cancel_update_sysicon" data-bs-dismiss="modal" aria-label="Close" onclick="addModalclose(this)"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body text-center">
                        <!-- Profile picture image-->
                        <div class="circle-container">
                            <img class="img-account-profile rounded-circle mb-2" id="frame1" src="<?php
                                if(isset($system['icon'])){
                                    if(!empty($system['icon'])) {
                                        echo base_url . 'assets/files/system/' . $system['icon'];
                                } else { echo base_url . 'assets/files/system/no-image.png'; } }
                            ?>" alt="upload_system_icon" style="object-fit:cover; width:180px; height:180px; overflow:hidden; position:relative;" />
                        </div>
                        <!-- Profile picture help block-->
                        <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                        <!-- Profile picture upload button-->
                        <input type="file" name="image1" id="image1" class="form-control-file btn btn-primary mb-1" accept=".jpg, .jpeg, .png" onchange="previewImage('frame1', 'image1')">
                        <input type="hidden" name="oldICONimage" id="old-sysicon-image">
                        <div class="row">
                            <div id="icon-progress-bar"></div>
                        </div>
                        <div id="targetLayer"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btn_update_sysicon" class="btn btn-danger"><div class="dropdown-item-icon"><i style="margin-right:2px" data-feather="upload"></i></div> Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal for Upload system logo-->
<div class="modal fade" id="Upload_System_Logo"  data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleUpload_System_Logo" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="LogouploadForm" action="upload.php" method="post">
                <div class="modal-header">
                    Upload an system logo Image
                    <button class="btn-close" type="button" id="btn_cancel_update_syslogo" data-bs-dismiss="modal" aria-label="Close" onclick="addModalclose(this)"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body text-center">
                        <!-- Profile picture image-->
                        <div class="circle-container">
                            <img class="img-account-profile rounded-circle mb-2" id="frame2" src="<?php
                                if(isset($system['logo'])){
                                    if(!empty($system['logo'])) {
                                        echo base_url . 'assets/files/system/' . $system['logo'];
                                } else { echo base_url . 'assets/files/system/no-image.png'; } }
                            ?>" alt="upload_system_icon" style="object-fit:cover; width:180px; height:180px; overflow:hidden; position:relative;" />
                        </div>
                        <!-- Profile picture help block-->
                        <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                        <!-- Profile picture upload button-->
                        <input type="file" name="image2" id="image2" class="form-control-file btn btn-primary mb-1" accept=".jpg, .jpeg, .png" onchange="previewImage('frame2', 'image2')">
                        <input type="hidden" name="oldLOGOimage" id="old-syslogo-image">
                        <div class="row">
                            <div id="logo-progress-bar"></div>
                        </div>
                        <div id="targetLayer"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger"><div class="dropdown-item-icon"><i style="margin-right:2px" data-feather="upload"></i></div> Upload</button>
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

<!-- Ajax for Change System Info-->
<script>
    $(document).ready(function () {
        // Submit form via AJAX
        $('#system-information').submit(function (e) {
            e.preventDefault(); // Prevent the default form submission
            var formData = new FormData(this);
            formData.append('update_system_info', '1');
            $.ajax({
                type: 'POST',
                url: 'ajax.php',
                data: formData,
                processData: false,
                cache: false,
                contentType: false,
                beforeSend: function () {
                    $('#btn_update_system_information').attr('disabled', 'disabled');
                },
                success: function (data) {
                    data = JSON.parse(data); // Parse the JSON response

                    if (data.inform == 'Yes') {
                        swal({
                            title: "Notice",
                            text: data.status,
                            icon: data.alert,
                            button: false,
                            timer: 2000
                        }).then(function () {
                            // Display the confirmation SweetAlert
                            swal({
                                title: "Notice",
                                text: 'System Information Modified. Do you want to refresh the page to take effect?',
                                icon: 'info',
                                buttons: {
                                    yes: "Yes",
                                    no: "No"
                                },
                            }).then(function (value) {
                                if (value === "yes") {
                                    window.location.reload();
                                } else {
                                    $('#btn_update_system_information').removeAttr('disabled');
                                }
                            });
                        });
                    } else {
                        // If 'inform' is not 'Yes', display the initial success SweetAlert without confirmation
                        swal({
                            title: "Notice",
                            text: data.status,
                            icon: data.alert,
                            button: true
                        }).then(function () {
                            $('#btn_update_system_information').removeAttr('disabled');
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

<!-- Social Switch -->
<script type="text/javascript">
    function FacebooktoggleEventLog() {
        const switchFacebook = document.getElementById("switch_facebook").checked ? "1" : "0";
        const xhrAjax = new XMLHttpRequest();
        xhrAjax.open("POST", "ajax.php", true);
        xhrAjax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhrAjax.onreadystatechange = function () {
            if (xhrAjax.readyState === 4 && xhrAjax.status === 200) {
                const response = JSON.parse(xhrAjax.responseText);
                swal({
                    title: "Notice",
                    text: response.status,
                    icon: response.alert,
                    button: false,
                    timer: 2000
                }).then(function() {
                    if(response.switch == '1') {
                        document.getElementById("image_facebook").style.filter = "none";
                    } else{
                        document.getElementById("image_facebook").style.filter = "grayscale(100%)";
                    }
                });
            }
        };
        xhrAjax.send(`switch_facebook=${switchFacebook}`);
    }
    function InstagramtoggleEventLog() {
        const switchInstagram = document.getElementById("switch_instagram").checked ? "1" : "0";
        const xhrAjax = new XMLHttpRequest();
        xhrAjax.open("POST", "ajax.php", true);
        xhrAjax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhrAjax.onreadystatechange = function () {
            if (xhrAjax.readyState === 4 && xhrAjax.status === 200) {
                const response = JSON.parse(xhrAjax.responseText);
                swal({
                    title: "Notice",
                    text: response.status,
                    icon: response.alert,
                    button: false,
                    timer: 2000
                }).then(function() {
                    if(response.switch == '1') {
                        document.getElementById("image_instagram").style.filter = "none";
                    } else{
                        document.getElementById("image_instagram").style.filter = "grayscale(100%)";
                    }
                });
            }
        };
        xhrAjax.send(`switch_instagram=${switchInstagram}`);
    }
    function TwittertoggleEventLog() {
        const switchTwitter = document.getElementById("switch_twitter").checked ? "1" : "0";
        const xhrAjax = new XMLHttpRequest();
        xhrAjax.open("POST", "ajax.php", true);
        xhrAjax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhrAjax.onreadystatechange = function () {
            if (xhrAjax.readyState === 4 && xhrAjax.status === 200) {
                const response = JSON.parse(xhrAjax.responseText);
                swal({
                    title: "Notice",
                    text: response.status,
                    icon: response.alert,
                    button: false,
                    timer: 2000
                }).then(function() {
                    if(response.switch == '1') {
                        document.getElementById("image_twitter").style.filter = "none";
                    } else{
                        document.getElementById("image_twitter").style.filter = "grayscale(100%)";
                    }
                });
            }
        };
        xhrAjax.send(`switch_twitter=${switchTwitter}`);
    }
    function TumblrtoggleEventLog() {
        const switchTumblr = document.getElementById("switch_tumblr").checked ? "1" : "0";
        const xhrAjax = new XMLHttpRequest();
        xhrAjax.open("POST", "ajax.php", true);
        xhrAjax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhrAjax.onreadystatechange = function () {
            if (xhrAjax.readyState === 4 && xhrAjax.status === 200) {
                const response = JSON.parse(xhrAjax.responseText);
                swal({
                    title: "Notice",
                    text: response.status,
                    icon: response.alert,
                    button: false,
                    timer: 2000
                }).then(function() {
                    if(response.switch == '1') {
                        document.getElementById("image_tumblr").style.filter = "none";
                    } else{
                        document.getElementById("image_tumblr").style.filter = "grayscale(100%)";
                    }
                });
            }
        };
        xhrAjax.send(`switch_tumblr=${switchTumblr}`);
    }
    function EmailtoggleEventLog() {
        const switchEmail = document.getElementById("switch_email").checked ? "1" : "0";
        const xhrAjax = new XMLHttpRequest();
        xhrAjax.open("POST", "ajax.php", true);
        xhrAjax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhrAjax.onreadystatechange = function () {
            if (xhrAjax.readyState === 4 && xhrAjax.status === 200) {
                const response = JSON.parse(xhrAjax.responseText);
                swal({
                    title: "Notice",
                    text: response.status,
                    icon: response.alert,
                    button: false,
                    timer: 2000
                }).then(function() {
                    if(response.switch == '1') {
                        document.getElementById("image_email").style.filter = "none";
                    } else{
                        document.getElementById("image_email").style.filter = "grayscale(100%)";
                    }
                });
            }
        };
        xhrAjax.send(`switch_email=${switchEmail}`);
    }
    function PhonetoggleEventLog() {
        const switchPhone = document.getElementById("switch_number").checked ? "1" : "0";
        const xhrAjax = new XMLHttpRequest();
        xhrAjax.open("POST", "ajax.php", true);
        xhrAjax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhrAjax.onreadystatechange = function () {
            if (xhrAjax.readyState === 4 && xhrAjax.status === 200) {
                const response = JSON.parse(xhrAjax.responseText);
                swal({
                    title: "Notice",
                    text: response.status,
                    icon: response.alert,
                    button: false,
                    timer: 2000
                }).then(function() {
                    if(response.switch == '1') {
                        document.getElementById("image_phone").style.filter = "none";
                    } else{
                        document.getElementById("image_phone").style.filter = "grayscale(100%)";
                    }
                });
            }
        };
        xhrAjax.send(`switch_phone=${switchPhone}`);
    }
</script>

<!-- Ajax for System Icon Image Upload -->
<script type="text/javascript">
    $(document).ready(function () {
        $('#IconuploadForm').submit(function (e) { // Update System Icon Image Upload
            e.preventDefault(); // Prevent the default form submission
            var formData = new FormData($(this)[0]);
            formData.append('update_sysicon', '1'); // Use the correct identifier for profile image update
            // Reset the progress bar to 0% before making the AJAX request
            $('#icon-progress-bar').width('0%');
            $('#icon-progress-bar').html('<div id="progress-status" class="text-center">0%</div>');
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
                            $('#icon-progress-bar').width(percentComplete + '%');
                            $('#icon-progress-bar').html('<div id="progress-status" class="text-center">' + percentComplete + ' %</div>');
                        }
                    }, false);
                    return xhr;
                },
                beforeSend: function() {
                    $('#btn_update_sysicon').attr('disabled', 'disabled');
                    $('#btn_cancel_update_sysicon').attr('disabled', 'disabled');
                },
                success: function(data) {
                    swal({
                        title: "Notice",
                        text: data.status,
                        icon: data.alert,
                        button: true
                    }).then(function() {
                        $('#Upload_System_Icon').modal('hide');
                        $('#IconuploadForm')[0].reset();
                        $('#icon-progress-bar').html('<div id="progress-status" class="text-center">0%</div>');
                        $('#icon-progress-bar').empty();
                        $('#icon-progress-bar').width('0%');
                        // Call updateUserData after successful image upload
                        updateUserData();
                    });
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.error(errorThrown);
                },
                complete: function() {
                    // Re-enable the buttons and reset the progress bar after completion
                    $('#btn_update_sysicon').removeAttr('disabled');
                    $('#btn_cancel_update_sysicon').removeAttr('disabled');
                }
            });
        });
        $('#LogouploadForm').submit(function (e) { // Update System Icon Image Upload
            e.preventDefault(); // Prevent the default form submission
            var formData = new FormData($(this)[0]);
            formData.append('update_syslogo', '1'); // Use the correct identifier for profile image update
            // Reset the progress bar to 0% before making the AJAX request
            $('#logo-progress-bar').width('0%');
            $('#logo-progress-bar').html('<div id="progress-status" class="text-center">0%</div>');
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
                            $('#logo-progress-bar').width(percentComplete + '%');
                            $('#logo-progress-bar').html('<div id="progress-status" class="text-center">' + percentComplete + ' %</div>');
                        }
                    }, false);
                    return xhr;
                },
                beforeSend: function() {
                    $('#btn_update_syslogo').attr('disabled', 'disabled');
                    $('#btn_cancel_update_syslogo').attr('disabled', 'disabled');
                },
                success: function(data) {
                    swal({
                        title: "Notice",
                        text: data.status,
                        icon: data.alert,
                        button: true
                    }).then(function() {
                        $('#Upload_System_Logo').modal('hide');
                        $('#LogouploadForm')[0].reset();
                        $('#logo-progress-bar').html('<div id="progress-status" class="text-center">0%</div>');
                        $('#logo-progress-bar').empty();
                        $('#logo-progress-bar').width('0%');
                        // Call updateUserData after successful image upload
                        updateUserData();
                    });
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.error(errorThrown);
                },
                complete: function() {
                    // Re-enable the buttons and reset the progress bar after completion
                    $('#btn_update_syslogo').removeAttr('disabled');
                    $('#btn_cancel_update_syslogo').removeAttr('disabled');
                }
            });
        });
    });
</script>

<!-- Ajax System Images Display -->
<script>
    function updateUserData() {
        // Make an AJAX request to the server
        $.ajax({ // System Icon
            url: 'ajax.php',
            type: 'POST',
            data: { get_sysicon: '1' }, // Use an object to send data
            dataType: 'json',
            success: function (data) {
                // Update the profile image source
                const iconImage = document.getElementById('sysicon-image');
                iconImage.src = '<?= base_url ?>assets/files/system/' + data.icon;
                var oldiconImage = document.getElementById('old-sysicon-image');
                oldiconImage.value = data.icon;
            },
            error: function (xhr, status, error) {
                // Handle errors here
                console.error(xhr.responseText);
            }
        });
        $.ajax({ // System Logo
            url: 'ajax.php',
            type: 'POST',
            data: { get_syslogo: '1' }, // Use an object to send data
            dataType: 'json',
            success: function (data) {
                // Update the profile image source
                const logoImage = document.getElementById('syslogo-image');
                logoImage.src = '<?= base_url ?>assets/files/system/' + data.logo;
                var oldlogoImage = document.getElementById('old-syslogo-image');
                oldlogoImage.value = data.logo;
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

<!-- Ajax for Change System Info Privacy-->
<script>
    $(document).ready(function () {
        // Submit form via AJAX
        $('#system-information-privacy').submit(function (e) {
            e.preventDefault(); // Prevent the default form submission
            var formData = new FormData(this);
            formData.append('update_system_info_privacy', '1');
            $.ajax({
                type: 'POST',
                url: 'ajax.php',
                data: formData,
                processData: false,
                cache: false,
                contentType: false,
                beforeSend: function () {
                    $('#btn_update_system_information_privacy').attr('disabled', 'disabled');
                },
                success: function (data) {
                    data = JSON.parse(data); // Parse the JSON response

                    if (data.inform == 'Yes') {
                        swal({
                            title: "Notice",
                            text: data.status,
                            icon: data.alert,
                            button: false,
                            timer: 2000
                        }).then(function () {
                            // Display the confirmation SweetAlert
                            swal({
                                title: "Notice",
                                text: 'System Information Modified. Do you want to refresh the page to take effect?',
                                icon: 'info',
                                buttons: {
                                    yes: "Yes",
                                    no: "No"
                                },
                            }).then(function (value) {
                                if (value === "yes") {
                                    window.location.reload();
                                } else {
                                    $('#btn_update_system_information_privacy').removeAttr('disabled');
                                }
                            });
                        });
                    } else {
                        // If 'inform' is not 'Yes', display the initial success SweetAlert without confirmation
                        swal({
                            title: "Notice",
                            text: data.status,
                            icon: data.alert,
                            button: true
                        }).then(function () {
                            $('#btn_update_system_information_privacy').removeAttr('disabled');
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

<!-- Ajax for Change System Info Terms-->
<script>
    $(document).ready(function () {
        // Submit form via AJAX
        $('#system-information-terms').submit(function (e) {
            e.preventDefault(); // Prevent the default form submission
            var formData = new FormData(this);
            formData.append('update_system_info_terms', '1');
            $.ajax({
                type: 'POST',
                url: 'ajax.php',
                data: formData,
                processData: false,
                cache: false,
                contentType: false,
                beforeSend: function () {
                    $('#btn_update_system_information_terms').attr('disabled', 'disabled');
                },
                success: function (data) {
                    data = JSON.parse(data); // Parse the JSON response

                    if (data.inform == 'Yes') {
                        swal({
                            title: "Notice",
                            text: data.status,
                            icon: data.alert,
                            button: false,
                            timer: 2000
                        }).then(function () {
                            // Display the confirmation SweetAlert
                            swal({
                                title: "Notice",
                                text: 'System Information Modified. Do you want to refresh the page to take effect?',
                                icon: 'info',
                                buttons: {
                                    yes: "Yes",
                                    no: "No"
                                },
                            }).then(function (value) {
                                if (value === "yes") {
                                    window.location.reload();
                                } else {
                                    $('#btn_update_system_information_terms').removeAttr('disabled');
                                }
                            });
                        });
                    } else {
                        // If 'inform' is not 'Yes', display the initial success SweetAlert without confirmation
                        swal({
                            title: "Notice",
                            text: data.status,
                            icon: data.alert,
                            button: true
                        }).then(function () {
                            $('#btn_update_system_information_terms').removeAttr('disabled');
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

<!-- Ajax for Change System Info ACT-->
<script>
    $(document).ready(function () {
        // Submit form via AJAX
        $('#system-information-act').submit(function (e) {
            e.preventDefault(); // Prevent the default form submission
            var formData = new FormData(this);
            formData.append('update_system_info_act', '1');
            $.ajax({
                type: 'POST',
                url: 'ajax.php',
                data: formData,
                processData: false,
                cache: false,
                contentType: false,
                beforeSend: function () {
                    $('#btn_update_system_information_act').attr('disabled', 'disabled');
                },
                success: function (data) {
                    data = JSON.parse(data); // Parse the JSON response

                    if (data.inform == 'Yes') {
                        swal({
                            title: "Notice",
                            text: data.status,
                            icon: data.alert,
                            button: false,
                            timer: 2000
                        }).then(function () {
                            // Display the confirmation SweetAlert
                            swal({
                                title: "Notice",
                                text: 'System Information Modified. Do you want to refresh the page to take effect?',
                                icon: 'info',
                                buttons: {
                                    yes: "Yes",
                                    no: "No"
                                },
                            }).then(function (value) {
                                if (value === "yes") {
                                    window.location.reload();
                                } else {
                                    $('#btn_update_system_information_act').removeAttr('disabled');
                                }
                            });
                        });
                    } else {
                        // If 'inform' is not 'Yes', display the initial success SweetAlert without confirmation
                        swal({
                            title: "Notice",
                            text: data.status,
                            icon: data.alert,
                            button: true
                        }).then(function () {
                            $('#btn_update_system_information_act').removeAttr('disabled');
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

<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            placeholder: 'Hello stand alone ui',
            tabsize: 2,
            height: 500,
            toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
        $('#summernote-privacy').summernote({
            placeholder: 'Hello stand alone ui',
            tabsize: 2,
            height: 500,
            toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
        $('#summernote-terms').summernote({
            placeholder: 'Hello stand alone ui',
            tabsize: 2,
            height: 500,
            toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    });
</script>

<!-- Ajax for Change System Social-->
<script>
    $(document).ready(function () {
        // Submit form via AJAX
        $('#system-facebook').submit(function (e) {
            e.preventDefault(); // Prevent the default form submission
            var formData = new FormData(this);
            formData.append('update_system_facebook', '1');
            $.ajax({
                type: 'POST',
                url: 'ajax.php',
                data: formData,
                processData: false,
                cache: false,
                contentType: false,
                beforeSend: function () {
                    $('#btn_facebook').attr('disabled', 'disabled');
                },
                success: function (data) {
                    data = JSON.parse(data); // Parse the JSON response
                    swal({
                        title: "Notice",
                        text: data.status,
                        icon: data.alert,
                        button: true
                    }).then(function () {
                        $('#btn_facebook').removeAttr('disabled');
                    });
                },
                error: function (xhr, status, error) {
                    // Handle any errors that occur during the AJAX request
                    console.error('Error:', error);
                }
            });
        });
        $('#system-instagram').submit(function (e) {
            e.preventDefault(); // Prevent the default form submission
            var formData = new FormData(this);
            formData.append('update_system_instagram', '1');
            $.ajax({
                type: 'POST',
                url: 'ajax.php',
                data: formData,
                processData: false,
                cache: false,
                contentType: false,
                beforeSend: function () {
                    $('#btn_instagram').attr('disabled', 'disabled');
                },
                success: function (data) {
                    data = JSON.parse(data); // Parse the JSON response
                    swal({
                        title: "Notice",
                        text: data.status,
                        icon: data.alert,
                        button: true
                    }).then(function () {
                        $('#btn_instagram').removeAttr('disabled');
                    });
                },
                error: function (xhr, status, error) {
                    // Handle any errors that occur during the AJAX request
                    console.error('Error:', error);
                }
            });
        });
        $('#system-twitter').submit(function (e) {
            e.preventDefault(); // Prevent the default form submission
            var formData = new FormData(this);
            formData.append('update_system_twitter', '1');
            $.ajax({
                type: 'POST',
                url: 'ajax.php',
                data: formData,
                processData: false,
                cache: false,
                contentType: false,
                beforeSend: function () {
                    $('#btn_twitter').attr('disabled', 'disabled');
                },
                success: function (data) {
                    data = JSON.parse(data); // Parse the JSON response
                    swal({
                        title: "Notice",
                        text: data.status,
                        icon: data.alert,
                        button: true
                    }).then(function () {
                        $('#btn_twitter').removeAttr('disabled');
                    });
                },
                error: function (xhr, status, error) {
                    // Handle any errors that occur during the AJAX request
                    console.error('Error:', error);
                }
            });
        });
        $('#system-tumblr').submit(function (e) {
            e.preventDefault(); // Prevent the default form submission
            var formData = new FormData(this);
            formData.append('update_system_tumblr', '1');
            $.ajax({
                type: 'POST',
                url: 'ajax.php',
                data: formData,
                processData: false,
                cache: false,
                contentType: false,
                beforeSend: function () {
                    $('#btn_tumblr').attr('disabled', 'disabled');
                },
                success: function (data) {
                    data = JSON.parse(data); // Parse the JSON response
                    swal({
                        title: "Notice",
                        text: data.status,
                        icon: data.alert,
                        button: true
                    }).then(function () {
                        $('#btn_tumblr').removeAttr('disabled');
                    });
                },
                error: function (xhr, status, error) {
                    // Handle any errors that occur during the AJAX request
                    console.error('Error:', error);
                }
            });
        });
        $('#system-email').submit(function (e) {
            e.preventDefault(); // Prevent the default form submission
            var formData = new FormData(this);
            formData.append('update_system_email', '1');
            $.ajax({
                type: 'POST',
                url: 'ajax.php',
                data: formData,
                processData: false,
                cache: false,
                contentType: false,
                beforeSend: function () {
                    $('#btn_email').attr('disabled', 'disabled');
                },
                success: function (data) {
                    data = JSON.parse(data); // Parse the JSON response
                    swal({
                        title: "Notice",
                        text: data.status,
                        icon: data.alert,
                        button: true
                    }).then(function () {
                        $('#btn_email').removeAttr('disabled');
                    });
                },
                error: function (xhr, status, error) {
                    // Handle any errors that occur during the AJAX request
                    console.error('Error:', error);
                }
            });
        });
        $('#system-phone').submit(function (e) {
            e.preventDefault(); // Prevent the default form submission
            var formData = new FormData(this);
            formData.append('update_system_phone', '1');
            $.ajax({
                type: 'POST',
                url: 'ajax.php',
                data: formData,
                processData: false,
                cache: false,
                contentType: false,
                beforeSend: function () {
                    $('#btn_phone').attr('disabled', 'disabled');
                },
                success: function (data) {
                    data = JSON.parse(data); // Parse the JSON response
                    swal({
                        title: "Notice",
                        text: data.status,
                        icon: data.alert,
                        button: true
                    }).then(function () {
                        $('#btn_phone').removeAttr('disabled');
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

<?php include ('../includes/footer.php'); ?>