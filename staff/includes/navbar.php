<nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light bg-white" id="sidenavAccordion">
    <!-- Sidenav Toggle Button-->
    <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 me-2 ms-lg-2 me-lg-0" id="sidebarToggle"><i data-feather="menu"></i></button>
    <!-- Navbar Brand-->
    <!-- * * Tip * * You can use text or an image for your navbar brand.-->
    <!-- * * * * * * When using an image, we recommend the SVG format.-->
    <!-- * * * * * * Dimensions: Maximum height: 32px, maximum width: 240px-->
    <a class="navbar-brand pe-3 ps-4 ps-lg-2" href="../home"><?=$system['shortname']?></a>
    <!-- Navbar Search Input-->
    <!-- * * Note: * * Visible only on and above the lg breakpoint-->
    <!-- <form class="form-inline me-auto d-none d-lg-block me-3">
        <div class="input-group input-group-joined input-group-solid">
            <input class="form-control pe-0" type="search" placeholder="Search" aria-label="Search" />
            <div class="input-group-text"><i data-feather="search"></i></div>
        </div>
    </form> -->
    <!-- Navbar Items-->

    <!-- Current datetime-->
    <div class="input-group input-group-joined border-0 shadow no-caret d-none d-md-block me-5" style="width: 0.5rem; margin-right:10px;">
        <label class="input-group-text"><i data-feather="calendar"></i>
        <div class="small d-flex" style="margin-left: 5px; margin-top: 3px; font-size:16px">
            <span class="fw-500 text-primary mr-1" style="margin-right:3px"><?php echo date("l") ?></span>
            &middot; <?php echo date("F d, Y") ?> &middot; <div id="timer" style="margin-left:0.3rem;"></div>
        </div>
        </label>
    </div>
    <ul class="navbar-nav align-items-center ms-auto">
        <!-- Navbar Search Dropdown-->
        <!-- * * Note: * * Visible only below the lg breakpoint-->
        
        <li class="nav-item dropdown no-caret me-3 d-lg-none">
            <!-- <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="searchDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="search"></i></a> -->
            <!-- Dropdown - Search-->
            <!-- <div class="dropdown-menu dropdown-menu-end p-3 shadow animated--fade-in-up" aria-labelledby="searchDropdown">
                <form class="form-inline me-auto w-100">
                    <div class="input-group input-group-joined input-group-solid">
                        <input class="form-control pe-0" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                        <div class="input-group-text"><i data-feather="search"></i></div>
                    </div>
                </form>
            </div> -->
        </li>
        <!-- Alerts Dropdown-->
        <li class="nav-item dropdown no-caret d-none d-sm-block me-3 dropdown-notifications">
            <a class="btn btn-icon btn-transparent-dark dropdown-toggle d-none" id="navbarDropdownAlerts" href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="bell"></i></a>
            <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownAlerts">
                <h6 class="dropdown-header dropdown-notifications-header">
                    <i class="me-2" data-feather="bell"></i>
                    Alerts Center
                </h6>
                <!-- Example Alert 1-->
                <a class="dropdown-item dropdown-notifications-item" href="#!">
                    <div class="dropdown-notifications-item-icon bg-warning"><i data-feather="activity"></i></div>
                    <div class="dropdown-notifications-item-content">
                        <div class="dropdown-notifications-item-content-details">December 29, 2021</div>
                        <div class="dropdown-notifications-item-content-text">This is an alert message. It's nothing serious, but it requires your attention.</div>
                    </div>
                </a>
                <!-- Example Alert 2-->
                <a class="dropdown-item dropdown-notifications-item" href="#!">
                    <div class="dropdown-notifications-item-icon bg-info"><i data-feather="bar-chart"></i></div>
                    <div class="dropdown-notifications-item-content">
                        <div class="dropdown-notifications-item-content-details">December 22, 2021</div>
                        <div class="dropdown-notifications-item-content-text">A new monthly report is ready. Click here to view!</div>
                    </div>
                </a>
                <!-- Example Alert 3-->
                <a class="dropdown-item dropdown-notifications-item" href="#!">
                    <div class="dropdown-notifications-item-icon bg-danger"><i class="fas fa-exclamation-triangle"></i></div>
                    <div class="dropdown-notifications-item-content">
                        <div class="dropdown-notifications-item-content-details">December 8, 2021</div>
                        <div class="dropdown-notifications-item-content-text">Critical system failure, systems shutting down.</div>
                    </div>
                </a>
                <!-- Example Alert 4-->
                <a class="dropdown-item dropdown-notifications-item" href="#!">
                    <div class="dropdown-notifications-item-icon bg-success"><i data-feather="user-plus"></i></div>
                    <div class="dropdown-notifications-item-content">
                        <div class="dropdown-notifications-item-content-details">December 2, 2021</div>
                        <div class="dropdown-notifications-item-content-text">New user request. Woody has requested access to the organization.</div>
                    </div>
                </a>
                <a class="dropdown-item dropdown-notifications-footer" href="#!">View All Alerts</a>
            </div>
        </li>
        <!-- User Dropdown-->
        <li class="dropdown-user me-3 me-lg-4 avatar avatar-online avatar-lg me-1 no-caret">
            <?php
                $userID = $_SESSION['auth_user'] ['user_id'];
                $query = "SELECT * FROM user where user_id = $userID";
                $query_run = mysqli_query($con, $query);
                $user = mysqli_num_rows($query_run) > 0;

                if($user){
                    while($row = mysqli_fetch_assoc($query_run)){
            ?>
            <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img class="img-fluid" id="profile-image1" style="width:45px; height:45px;"/>
            </a>
            <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
                <h6 class="dropdown-header d-flex align-items-center">
                    <img class="dropdown-user-img" id="profile-image2" />
                    <div class="dropdown-user-details">
                        <div class="dropdown-user-details-name"><?= $row['fname'] . ' ' . $row['mname'] . ' ' . $row['lname'] ?></div>
                        <div class="dropdown-user-details-email"><?= $row['email']; ?></div>
                        <div class="dropdown-user-details-phone"><?= $row['phone']; ?></div>
                    </div>
                </h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item <?php if (strpos($_SERVER['PHP_SELF'], 'home/myaccount.php') !== false)  { echo'active'; } ?>" href="myaccount">
                    <div class="dropdown-item-icon"><i data-feather="user"></i></div>
                    My Account
                </a>
                <button class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                    Logout
                </button>
            </div>
            <?php } } ?>
        </li>
    </ul>
</nav>


<!-- Modal  for Logout-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                Confirm to logout?
            </div>
            <div class="modal-body"> Are you sure you want to logout?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                <form action="../includes/code.php" method="POST">
                    <button type="submit" name="logout_btn" class="btn btn-danger"><div class="dropdown-item-icon"><i data-feather="log-out"></i></div> Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>

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
                    const profileImage1 = document.getElementById('profile-image1');
                    profileImage1.src = '<?php echo base_url ?>assets/files/users/' + data.profile;
                    const profileImage2 = document.getElementById('profile-image2');
                    profileImage2.src = '<?php echo base_url ?>assets/files/users/' + data.profile;
                } else {
                    // Set a default profile image source based on gender
                    const profileImage1 = document.getElementById('profile-image1');
                    profileImage1.src = data.gender === 'Male' ? '<?php echo base_url ?>assets/files/system/profile-male.png' : '<?php echo base_url ?>assets/files/system/profile-female.png';
                    const profileImage2 = document.getElementById('profile-image2');
                    profileImage2.src = data.gender === 'Male' ? '<?php echo base_url ?>assets/files/system/profile-male.png' : '<?php echo base_url ?>assets/files/system/profile-female.png';
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

<?php
    $currentTime = date("Y/m/d H:i:s");
?>

<script>
    setInterval(function(){
       var xhr = new XMLHttpRequest();
       xhr.onreadystatechange = function() {
          if (xhr.readyState === 4 && xhr.status === 200) {
             var currentTime = new Date(xhr.responseText);
             var currentHours = currentTime.getHours();
             var currentMinutes = currentTime.getMinutes();
             var currentSeconds = currentTime.getSeconds();
             currentMinutes = (currentMinutes < 10 ? "0" : "") + currentMinutes;
             currentSeconds = (currentSeconds < 10 ? "0" : "") + currentSeconds;
             var timeOfDay = (currentHours < 12) ? "AM" : "PM";
             currentHours = (currentHours > 12) ? currentHours - 12 : currentHours;
             currentHours = (currentHours == 0) ? 12 : currentHours;
             var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;
             document.getElementById("timer").innerHTML = currentTimeString;
          }
       };
       xhr.open("GET", "../includes/server_time.php", true); // Change "server_time.php" to the actual path of your PHP file
       xhr.send();
    }, 1000);
</script>