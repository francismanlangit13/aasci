<?php
    include('db_conn.php');

    if(isset($_POST['login_btn'])){
        $email_phone = mysqli_real_escape_string($con, $_POST['email_phone']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $hashed_password = md5($password);
        $login_query = "SELECT * FROM user WHERE (email = '$email_phone' || phone = '$email_phone') AND password = '$hashed_password' AND user_status_id = 1 LIMIT 1";
        $login_query_run = mysqli_query($con, $login_query);

        if(mysqli_num_rows($login_query_run) > 0){
            foreach($login_query_run as $data){
                $user_id = $data['user_id'];
                $full_name = $data['fname'].' '.$data['lname'];
                $role_as = $data['user_type_id'];
                $user_email = $data['email'];
            }

            $date = date('Y-m-d H:i:s');
            $login_success = "Login";
            $login_success_log = "success using email and password";
            mysqli_query($con,"INSERT INTO user_log (user_id, type, log, date) values('".$user_id."','".$login_success."','".$login_success_log."','$date')");

            $_SESSION['auth'] = true;
            $_SESSION['auth_role'] = "$role_as";
            $_SESSION['auth_user'] = [
                'user_id' =>$user_id,
                'user_name' =>$full_name,
                'user_email' =>$user_email,
            ];

            if( $_SESSION['auth_role'] == '1'){
                $_SESSION['status'] = "Welcome $full_name!";
                $_SESSION['status_code'] = "success";
                header("Location: " . base_url . "admin");
                exit(0);
            }
            elseif( $_SESSION['auth_role'] == '2'){
                $_SESSION['status'] = "Welcome $full_name!";
                $_SESSION['status_code'] = "success";
                header("Location: " . base_url . "staff");
                exit(0);
            }
            elseif( $_SESSION['auth_role'] == '3'){
                $_SESSION['status'] = "Welcome $full_name!";
                $_SESSION['status_code'] = "success";
                header("Location: " . base_url . "client");
                exit(0);
            }
        }
        else {
            $login_error = "SELECT * FROM user WHERE email = '$email' AND user_status_id = 1 LIMIT 1";
            $login_error_run = mysqli_query($con, $login_error);
            if(mysqli_num_rows($login_error_run) > 0){
                foreach($login_error_run as $data){
                    $user_id = $data['user_id'];
                }

                $_SESSION['status'] = "Invalid Email or Password";
                $_SESSION['status_code'] = "warning";
                header("Location: " . base_url . "login");
                exit(0);
            }
            else{
                $_SESSION['status'] = "Invalid Email or Password";
                $_SESSION['status_code'] = "warning";
                header("Location: " . base_url . "login");
                exit(0);
            }
        }
    }   
    else {
        $_SESSION['status'] = "You are not allowed to access this site";
        $_SESSION['status_code'] = "error";
        header("Location: " . base_url . "login");
        
        exit(0);
    }

?>