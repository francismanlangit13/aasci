<nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light bg-white" id="sidenavAccordion">
    <!-- Sidenav Toggle Button-->
    <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 me-2 ms-lg-2 me-lg-0" id="sidebarToggle"><i data-feather="menu"></i></button>
    <!-- Navbar Brand-->
    <!-- * * Tip * * You can use text or an image for your navbar brand.-->
    <!-- * * * * * * When using an image, we recommend the SVG format.-->
    <!-- * * * * * * Dimensions: Maximum height: 32px, maximum width: 240px-->
    <a class="navbar-brand pe-3 ps-4 ps-lg-2" href="../home">AASCI System</a>
    <!-- Navbar Search Input-->
    <!-- * * Note: * * Visible only on and above the lg breakpoint-->
    <!-- <form class="form-inline me-auto d-none d-lg-block me-3">
        <div class="input-group input-group-joined input-group-solid">
            <input class="form-control pe-0" type="search" placeholder="Search" aria-label="Search" />
            <div class="input-group-text"><i data-feather="search"></i></div>
        </div>
    </form> -->
    <!-- Navbar Items-->
    <ul class="navbar-nav align-items-center ms-auto">
        <!-- Navbar Search Dropdown-->
        <!-- * * Note: * * Visible only below the lg breakpoint-->
        <li class="nav-item dropdown no-caret me-3 d-lg-none">
            <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="searchDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="search"></i></a>
            <!-- Dropdown - Search-->
            <div class="dropdown-menu dropdown-menu-end p-3 shadow animated--fade-in-up" aria-labelledby="searchDropdown">
                <form class="form-inline me-auto w-100">
                    <div class="input-group input-group-joined input-group-solid">
                        <input class="form-control pe-0" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                        <div class="input-group-text"><i data-feather="search"></i></div>
                    </div>
                </form>
            </div>
        </li>
        <!-- Alerts Dropdown-->
        <li class="nav-item dropdown no-caret d-none d-sm-block me-3 dropdown-notifications">
            <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownAlerts" href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="bell"></i></a>
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
        <li class="nav-item dropdown no-caret dropdown-user me-3 me-lg-4">
            <?php
                $userID = $_SESSION['auth_user'] ['user_id'];
                $query = "SELECT * FROM user where user_id = $userID";
                $query_run = mysqli_query($con, $query);
                $user = mysqli_num_rows($query_run) > 0;

                if($user){
                    while($row = mysqli_fetch_assoc($query_run)){
            ?>
            <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img class="img-fluid" src="<?php
                        if(!empty($row['profile'])){
                            echo base_url . 'assets/files/users/' . $row['profile'];
                        } else { if($row['gender'] == 'Male'){echo base_url . 'assets/files/system/profile-male.png'; } else{ echo base_url . 'assets/files/system/profile-female.png'; } }
                    ?>" />
            </a>
            <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
                <h6 class="dropdown-header d-flex align-items-center">
                    <img class="dropdown-user-img" src="<?php
                        if(!empty($row['profile'])){
                            echo base_url . 'assets/files/users/' . $row['profile'];
                        } else { if($row['gender'] == 'Male'){echo base_url . 'assets/files/system/profile-male.png'; } else{ echo base_url . 'assets/files/system/profile-female.png'; } }
                    ?>" />
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