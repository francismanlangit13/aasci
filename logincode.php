<?php
    include('db_conn.php');
    // PHP Mailer
    include ("./assets/vendor/PHPMailer/PHPMailerAutoload.php");
    include ("./assets/vendor/PHPMailer/class.phpmailer.php");
    include ("./assets/vendor/PHPMailer/class.smtp.php");

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
                $twostepauth = $data['second_auth'];
                $fname = $data['fname'];
            }
            if($twostepauth == '1'){
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

                    $_SESSION['auth_user'] = ['user_email' =>$user_email, 'user_name' =>$full_name,];
                    $_SESSION['is_second_auth'] = 'Yes';
                    $output = array('alert' => "success", 'is_secondauth' => "Yes");
                } else{
                    $output = array('status' => "Something went wrong", 'alert' => "error");
                }
            } else {

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
                    $output = array('alert' => "success", 'is_secondauth' => "No", 'type' => "admin");
                }
                elseif( $_SESSION['auth_role'] == '2'){
                    $_SESSION['status'] = "Welcome $full_name!";
                    $_SESSION['status_code'] = "success";
                    $output = array('alert' => "success", 'is_secondauth' => "No", 'type' => "staff");
                }
            }
        }
        else {
            $output = array('status' => "Invalid Email or Password", 'alert' => "error");
        }
        echo json_encode($output);
    } else {
        $_SESSION['status'] = "You are not allowed to access this site";
        $_SESSION['status_code'] = "error";
        header("Location: " . base_url . "login");
        exit(0);
    }

?>