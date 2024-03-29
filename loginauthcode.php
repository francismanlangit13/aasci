<?php
    include('db_conn.php');
    // PHP Mailer
    include ("./assets/vendor/PHPMailer/PHPMailerAutoload.php");
    include ("./assets/vendor/PHPMailer/class.phpmailer.php");
    include ("./assets/vendor/PHPMailer/class.smtp.php");

    if(isset($_POST['verify_btn'])){
        $temp_email = mysqli_real_escape_string($con, $_POST['temp_email']);
        $code = mysqli_real_escape_string($con, $_POST['verify_code']);
        $date = date;

        $verify_query_run = mysqli_query($con, "SELECT user_id FROM user WHERE email = '$temp_email'");
        $get_user_id = mysqli_fetch_assoc($verify_query_run);
        $user_id = $get_user_id['user_id'];

        $verify_query = "SELECT * FROM `twostepauth` INNER JOIN `user` ON `twostepauth`.`user_id` = `user`.`user_id` WHERE `code` = '$code' AND `validity` > NOW() AND `user_status_id` = '1' LIMIT 1;";
        $verify_query_run = mysqli_query($con, $verify_query);

        if(mysqli_num_rows($verify_query_run) > 0){
            foreach($verify_query_run as $data){
                $user_id = $data['user_id'];
                $full_name = $data['fname'].' '.$data['lname'];
                $role_as = $data['user_type_id'];
                $user_email = $data['email'];
                $twostepauth = $data['second_auth'];
            }
            mysqli_query($con,"DELETE FROM `twostepauth` WHERE `user_id` = '$user_id'");

            $_SESSION['auth'] = true;
            $_SESSION['auth_role'] = "$role_as";
            $_SESSION['auth_user'] = [
                'user_id' =>$user_id,
                'user_name' =>$full_name,
                'user_email' =>$user_email,
            ];
        
            if( $_SESSION['auth_role'] == '1'){
                unset($_SESSION['is_second_auth']);
                $_SESSION['status'] = "Welcome $full_name!";
                $_SESSION['status_code'] = "success";
                $output = array('alert' => "success", 'type' => "admin", 'status' => "Login success");
            }
            elseif( $_SESSION['auth_role'] == '2'){
                unset($_SESSION['is_second_auth']);
                $_SESSION['status'] = "Welcome $full_name!";
                $_SESSION['status_code'] = "success";
                $output = array('alert' => "success", 'type' => "staff", 'status' => "Login success");
            }
        }
        else {
            $output = array('status' => "Invalid OTP Code or expired", 'alert' => "error");
        }
        $log_message = $output['status'];
        mysqli_query($con, "INSERT INTO `user_logs` (`user_id`, `log_title`, `log_status`, `log_date`) VALUES ('$user_id','Login','$log_message IP: $ip','$date')");
        echo json_encode($output);
    }
    // -------------------------------- Resend OTP -------------------------------- //
    if (isset($_POST["send_otp"])){
        $email = $_SESSION['auth_user']['user_email'];

        $query = $con->query("SELECT * FROM `user` INNER JOIN `twostepauth` ON `user`.`user_id` = `twostepauth`.`user_id` WHERE `user`.`email` = '$email' Limit 1");
        $user = $query->fetch_assoc();

        $user_id = $user['user_id'];
        $user_email = $user['email'];
        $fname = $user['fname'];
        $randomCode = strval(rand(100000, 999999)); // random code generator
        $validity = date('Y-m-d H:i:s', strtotime('+15 minutes'));

        $stmt = "INSERT INTO `twostepauth`(`user_id`, `code`, `validity`) VALUES ('$user_id','$randomCode','$validity')";
        $stmt_run = mysqli_query($con, $stmt);
        if ($stmt_run){
            // Email sender PHP
            $name = htmlentities($system['name']);
            $subject = htmlentities('Two Step Authentication Code - '. $system['name']);
            $message = nl2br("Dear $fname, \r\n \r\n This is your two step authentication login code \r\n \r\n Code: ".$randomCode." \r\n\r\n This code will valid for 15 minutes. \r\n \r\n Thanks, \r\n ".$system['name']);
            //PHP Mailer Gmail
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'TLS/STARTTLS';
            $mail->Host = 'smtp.gmail.com'; // Enter your host here
            $mail->Port = '587';
            $mail->IsHTML();
            $mail->Username = emailuser; // Enter your email here
            $mail->Password = emailpass; //Enter your passwrod here
            $mail->setFrom($user_email, $name);
            $mail->addAddress($user_email);
            $mail->Subject = $subject;
            $mail->Body = $message;
            $mail->send();

            $output = array('status' => "Resend OTP successfully", 'alert' => "success");
        } else{
            $output = array('status' => "Resend OTP unsuccessful", 'alert' => "error");
        }
        echo json_encode($output);
    }

?>