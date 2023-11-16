<?php
    include('../../db_conn.php');
    if(!isset($_SESSION['auth'])){
        $_SESSION['status'] = "Login to Access Dashboard";
        $_SESSION['status_code'] = "error";
        header("Location: " . base_url . "login");
        exit(0);
    }
    else{
        if ($_SESSION['auth_role'] != "2"){
            $_SESSION['status'] = "You are not authorized as ADMIN";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "login");
            exit(0);
        }
        $userID = $_SESSION['auth_user']['user_id'];
        $user_qry = $con->query("SELECT * FROM user WHERE user_id = $userID ");
    }
?>