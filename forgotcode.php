<?php
    include('db_conn.php');
    // PHP Mailer

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    include('./assets/vendor/PHPMailer/src/Exception.php');
    include('./assets/vendor/PHPMailer/src/PHPMailer.php');
    include('./assets/vendor/PHPMailer/src/SMTP.php');

    if(isset($_POST['forgot_btn'])){
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $check_mail = "SELECT * FROM user WHERE email = '$email' AND user_status_id = 1";
        $check_mail_run = mysqli_query($con, $check_mail);

        if(mysqli_num_rows($check_mail_run) > 0){
            $row = mysqli_fetch_array($check_mail_run);
            $get_email = $row['email'];
            $fullname = $row['fname'];
            $user_id = $row['user_id'];

            $expFormat = mktime(date("H"), date("i"), date("s"), date("m")  , date("d")+1, date("Y"));
            $expDate = date("Y-m-d H:i:s",$expFormat);
            $key = md5(2418*2);
            $addKey = substr(md5(uniqid(rand(),1)),3,10);
            $key = $key . $addKey;
            $sitelink = base_url;
            
            // Check if a record with the given user_id already exists
            $check_user = mysqli_query($con, "SELECT * FROM password_reset_temp WHERE user_id = '".$user_id."'");
            if(mysqli_num_rows($check_user) > 0) {
                // Update the existing record
                $query = "UPDATE `password_reset_temp` SET `email`='$email', `key`='$key', `expDate`='$expDate' WHERE `user_id`='$user_id'";
                $query_run = mysqli_query($con, $query);
            }
            else {
                // Insert a new record
                mysqli_query($con, "INSERT INTO password_reset_temp (`user_id`, `email`, `key`, `expDate`) VALUES ('".$user_id."', '".$email."', '".$key."', '".$expDate."')");
            }

            $email_output='<p>Dear '.$fullname.',</p>';
            $email_output.='<p>Please click on the following link to reset your password.</p>';
            $email_output.='<p>-------------------------------------------------------------</p>';
            $email_output.='<p><a href="'.$sitelink.'reset-password.php?key='.$key.'&email='.$email.'&action=reset" target="_blank">'.$sitelink.'reset-password.php?key='.$key.'&email='.$email.'&action=reset</a></p>';
            $email_output.='<p>-------------------------------------------------------------</p>';
            $email_output.='<p>Please be sure to copy the entire link into your browser.
            The link will expire after 1 day for security reason.</p>';
            $email_output.='<p>If you did not request this forgotten password email, no action 
            is needed, your password will not be reset. However, you may want to log into 
            your account and change your security password as someone may have guessed it.</p>';   	
            $email_output.='<p>Thanks,</p>';
            $email_output .= '<p>' . $system['name'] . '</p>';
            $body = $email_output;
            $subject = htmlentities('Password Recovery - '. $system['name']);
            $email_to = $email;
            $fromserver = emailuser; 

            include("./assets/vendor/PHPMailer/PHPMailerAutoload.php");
            include ("./assets/vendor/PHPMailer/class.phpmailer.php");
            include ("./assets/vendor/PHPMailer/class.smtp.php");

            $mail = new PHPMailer();
            $mail->IsSMTP();
            //$mail->SMTPDebug = 2; // Debug if the gmail doesn't send email when forgetting password.
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'TLS/STARTTLS';
            $mail->Host = 'smtp.gmail.com'; // Enter your host here
            $mail->Port = '587';
            $mail->IsHTML();
            $mail->Username = emailuser; // Enter your email here
            $mail->Password = emailpass; //Enter your passwrod here
            $mail->SetFrom(emailuser, 'Reset your password');
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->AddAddress($email_to);
            if(!$mail->Send()){
                $output = array('status' => "Mailer Error: " . $mail->ErrorInfo, 'alert' => "error", 'timer' => "5000");
            }
            else{
                $output = array('status' => "An email has been sent to you with instructions on how to reset your password. If your email not received check on spam folder", 'alert' => "success", 'timer' => "5000");
            }
        }
        else{
            $output = array('status' => "No Email Found", 'alert' => "warning", 'timer' => "2000");
        }
        echo json_encode($output);
    }

    if(isset($_POST['changepass_btn'])){
        $password = $_POST["password"];
        $email = $_POST["email"];
        $curDate = date;
        $hash_password = md5($password);
        
        $query1 = mysqli_query($con, "UPDATE `user` SET `password`='".$hash_password."' WHERE `email`='".$email."';");
        $num_rows_affected = mysqli_affected_rows($con);
        $query2 = mysqli_query($con, "DELETE FROM `password_reset_temp` WHERE `email`='".$email."'");

        if ($query1 && $query2 > 0) {
            $user_query = "SELECT * FROM user WHERE `email`='".$email."'";
            $user_query_run = mysqli_query($con, $user_query);
            if(mysqli_num_rows($user_query_run) > 0){
                foreach($user_query_run as $data){
                    $user_id = $data['user_id'];
                }

                $_SESSION['status'] = "Password updated successfully";
                $_SESSION['status_code'] = "success";
                header("Location: " . base_url . "login");
                exit(0);
            }
        }
        else{
            $output = array('status' => "Something went wrong", 'alert' => "error");
        }
        echo json_encode($output);
    }
?>