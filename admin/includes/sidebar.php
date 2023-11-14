<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sidenav shadow-right sidenav-light">
            <div class="sidenav-menu">
                <div class="nav accordion" id="accordionSidenav">
                    <!-- Sidenav Menu Heading (Account)-->
                    <!-- * * Note: * * Visible only on and above the sm breakpoint-->
                    <!-- <div class="sidenav-menu-heading d-sm-none">Account</div> -->
                    <!-- Sidenav Link (Alerts)-->
                    <!-- * * Note: * * Visible only on and above the sm breakpoint-->
                    <!-- <a class="nav-link d-sm-none" href="#!">
                        <div class="nav-link-icon"><i data-feather="bell"></i></div>
                        Alerts
                        <span class="badge bg-warning-soft text-warning ms-auto">4 New!</span>
                    </a> -->
                    <!-- Sidenav Link (Messages)-->
                    <!-- * * Note: * * Visible only on and above the sm breakpoint-->
                    <!-- <a class="nav-link d-sm-none" href="#!">
                        <div class="nav-link-icon"><i data-feather="mail"></i></div>
                        Messages
                        <span class="badge bg-success-soft text-success ms-auto">2 New!</span>
                    </a> -->
                    <!-- Sidenav Menu Heading (Home)-->
                    <div class="sidenav-menu-heading">Home</div>
                    <!-- Sidenav Accordion (Dashboard)-->
                    <a class="nav-link <?php if (strpos($_SERVER['PHP_SELF'], 'home/index.php') !== false)  { echo 'active'; } ?>" href="../home">
                        <div class="nav-link-icon"><i data-feather="home"></i></div>
                        Dashboard
                    </a>
                    <!-- Sidenav Heading (Notifications)-->
                    <div class="sidenav-menu-heading">Notifications</div>
                    <a class="nav-link <?php if (strpos($_SERVER['PHP_SELF'], 'home/announcement.php') !== false)  { echo 'active'; } ?>" href="announcement">
                        <div class="nav-link-icon"><i data-feather="rss"></i></div>
                        Announcements
                    </a>
                    <!-- Sidenav Heading (Users)-->
                    <div class="sidenav-menu-heading">Users</div>
                    <!-- Sidenav Accordion (Pages)-->
                    <a class="nav-link <?php if (strpos($_SERVER['PHP_SELF'], 'home/user.php') !== false || strpos($_SERVER['PHP_SELF'], 'home/client.php') !== false)  {  } else{ echo'collapsed'; } ?>" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseAccounts" aria-expanded="false" aria-controls="collapseAccounts">
                        <div class="nav-link-icon"><i data-feather="users"></i></div>
                        Accounts
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse <?php if (strpos($_SERVER['PHP_SELF'], 'home/user.php') !== false  || strpos($_SERVER['PHP_SELF'], 'home/client.php') !== false)  { echo'show'; }?>" id="collapseAccounts" data-bs-parent="#accordionSidenav">
                        <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPagesMenu">
                            <!-- Nested Sidenav Accordion (Accounts -> Users)-->
                            <a class="nav-link <?php if (strpos($_SERVER['PHP_SELF'], 'home/user.php') !== false)  { echo 'active'; } ?>" href="user">Users</a>
                            <!-- Nested Sidenav Accordion (Accounts -> Client)-->
                            <a class="nav-link <?php if (strpos($_SERVER['PHP_SELF'], 'home/client.php') !== false)  { echo 'active'; } ?>" href="client">Senior Citizen</a>
                        </nav>
                    </div>

                    <a class="nav-link <?php if (strpos($_SERVER['PHP_SELF'], 'home/archive_user.php') !== false || strpos($_SERVER['PHP_SELF'], 'home/archive_client.php') !== false)  {  } else{ echo'collapsed'; } ?>" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseArchived" aria-expanded="false" aria-controls="collapseArchived">
                        <div class="nav-link-icon"><i data-feather="users"></i></div>
                        Archive Accounts
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse <?php if (strpos($_SERVER['PHP_SELF'], 'home/archive_user.php') !== false  || strpos($_SERVER['PHP_SELF'], 'home/archive_client.php') !== false)  { echo'show'; }?>" id="collapseArchived" data-bs-parent="#accordionSidenav">
                        <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPagesMenu">
                            <!-- Nested Sidenav Accordion (Accounts -> Users)-->
                            <a class="nav-link <?php if (strpos($_SERVER['PHP_SELF'], 'home/archive_user.php') !== false)  { echo 'active'; } ?>" href="archive_user">Users</a>
                            <!-- Nested Sidenav Accordion (Accounts -> Client)-->
                            <a class="nav-link <?php if (strpos($_SERVER['PHP_SELF'], 'home/archive_client.php') !== false)  { echo 'active'; } ?>" href="archive_client">Senior Citizen</a>
                        </nav>
                    </div>
                    <!-- Sidenav Heading (Reports)-->
                    <div class="sidenav-menu-heading">Reports</div>
                    <a class="nav-link <?php if (strpos($_SERVER['PHP_SELF'], 'home/generate.php') !== false)  { echo 'active'; } ?>" href="generate">
                        <div class="nav-link-icon"><i data-feather="cloud-rain"></i></div>
                        Generate Senior
                    </a>
                    <!-- Sidenav Menu Heading (System)-->
                    <div class="sidenav-menu-heading">System</div>
                    <!-- Sidenav Accordion (Dashboard)-->
                    <a class="nav-link <?php if (strpos($_SERVER['PHP_SELF'], 'home/systemsettings.php') !== false)  { echo 'active'; } ?>" href="systemsettings">
                        <div class="nav-link-icon"><i data-feather="settings"></i></div>
                        System Settings
                    </a>
                </div>
            </div>
            <!-- Sidenav Footer-->
            <div class="sidenav-footer">
                <?php $userID = $_SESSION['auth_role']; ?>
                <div class="sidenav-footer-content">
                    <div class="sidenav-footer-subtitle">Logged in as:</div>
                    <div class="sidenav-footer-title"><?php if($userID == 1) { echo 'Administrator'; } else{ echo 'Staff'; } ?></div>
                </div>
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">