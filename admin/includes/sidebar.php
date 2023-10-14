<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sidenav shadow-right sidenav-light">
            <div class="sidenav-menu">
                <div class="nav accordion" id="accordionSidenav">
                    <!-- Sidenav Menu Heading (Account)-->
                    <!-- * * Note: * * Visible only on and above the sm breakpoint-->
                    <div class="sidenav-menu-heading d-sm-none">Account</div>
                    <!-- Sidenav Link (Alerts)-->
                    <!-- * * Note: * * Visible only on and above the sm breakpoint-->
                    <a class="nav-link d-sm-none" href="#!">
                        <div class="nav-link-icon"><i data-feather="bell"></i></div>
                        Alerts
                        <span class="badge bg-warning-soft text-warning ms-auto">4 New!</span>
                    </a>
                    <!-- Sidenav Link (Messages)-->
                    <!-- * * Note: * * Visible only on and above the sm breakpoint-->
                    <a class="nav-link d-sm-none" href="#!">
                        <div class="nav-link-icon"><i data-feather="mail"></i></div>
                        Messages
                        <span class="badge bg-success-soft text-success ms-auto">2 New!</span>
                    </a>
                    <!-- Sidenav Menu Heading (Home)-->
                    <div class="sidenav-menu-heading">Home</div>
                    <!-- Sidenav Accordion (Dashboard)-->
                    <a class="nav-link <?php if (strpos($_SERVER['PHP_SELF'], 'home/index.php') !== false)  { echo 'active'; } ?>" href="../home">
                        <div class="nav-link-icon"><i data-feather="home"></i></div>
                        Dashboard
                    </a>
                    <!-- Sidenav Heading (Users)-->
                    <div class="sidenav-menu-heading">Users</div>
                    <!-- Sidenav Accordion (Pages)-->
                    <a class="nav-link <?php if (strpos($_SERVER['PHP_SELF'], 'home/user.php') !== false || strpos($_SERVER['PHP_SELF'], 'home/client.php') !== false)  {  } else{ echo'collapsed'; } ?>" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                        <div class="nav-link-icon"><i data-feather="users"></i></div>
                        Accounts
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse <?php if (strpos($_SERVER['PHP_SELF'], 'home/user.php') !== false  || strpos($_SERVER['PHP_SELF'], 'home/client.php') !== false)  { echo'show'; }?>" id="collapsePages" data-bs-parent="#accordionSidenav">
                        <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPagesMenu">
                            <!-- Nested Sidenav Accordion (Accounts -> Users)-->
                            <a class="nav-link <?php if (strpos($_SERVER['PHP_SELF'], 'home/user.php') !== false)  { echo 'active'; } ?>" href="user">Users</a>
                            <!-- Nested Sidenav Accordion (Accounts -> Client)-->
                            <a class="nav-link <?php if (strpos($_SERVER['PHP_SELF'], 'home/client.php') !== false)  { echo 'active'; } ?>" href="client">Senior Citizen</a>
                        </nav>
                    </div>
                    
                </div>
            </div>
            <!-- Sidenav Footer-->
            <div class="sidenav-footer">
                <?php $userID = $_SESSION['auth_user'] ['user_id']; ?>
                <div class="sidenav-footer-content">
                    <div class="sidenav-footer-subtitle">Logged in as:</div>
                    <div class="sidenav-footer-title"><?php if($userID == 1) { echo 'Administrator'; } elseif ($userID == 2){  echo 'Staff'; } else {  echo 'Client'; } ?></div>
                </div>
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">