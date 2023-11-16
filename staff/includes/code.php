<?php
    include ('authentication.php'); // include to extra security of the website.
    if(isset($_POST['logout_btn'])){
        // unset means deleting the current session from the system make users to logout.
        unset( $_SESSION['auth']);
        unset( $_SESSION['auth_role']);
        unset( $_SESSION['auth_user']);

        $_SESSION['status'] = "Logout successfully.";
        $_SESSION['status_code'] = "success";
        header("Location: " . base_url . "login");
        exit(0);
    }
?>