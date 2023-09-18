<?php
    include ('../includes/authentication.php');

    // PHP Mailer
    require("../../assets/vendor/PHPMailer/PHPMailerAutoload.php");
    require ("../../assets/vendor/PHPMailer/class.phpmailer.php");
    require ("../../assets/vendor/PHPMailer/class.smtp.php");
    // Add user
    if(isset($_POST["add_user"])){
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $lname = $_POST['lname'];
        $gender = $_POST['gender'];
        $birthday = $_POST['birthday'];
        $civilstatus = $_POST['civilstatus'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $user_type = $_POST['role'];
        $new_password = substr(md5(microtime()),rand(0,26),8);
        $password = md5($new_password);
        $user_status = '1';

        $query = "INSERT INTO `user`(`fname`, `mname`, `lname`, `gender`, `birthday`, `civil_status`, `email`, `phone`, `password`, `user_type_id`, `user_status_id`) VALUES ('$fname','$mname','$lname','$gender','$birthday','$civilstatus','$email','$phone','$password','$user_type','$user_status')";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            // $name = htmlentities('Rental Properties Mamangement System');
            // $email = htmlentities($_POST['email']);
            // $subject = htmlentities('Email and Password Credentials - Rental Properties Mamangement System');
            // $message = nl2br("Welcome to Rental Properties Mamangement System! \r\n \r\n This is your account information \r\n Email: $email \r\n Password: $new_password \r\n \r\n Please change your password immediately. \r\n \r\n Thanks, \r\n Rental Properties Mamangement System");
            
            // PHP Mailer Gmail
            // $mail = new PHPMailer();
            // $mail->IsSMTP();
            // $mail->SMTPAuth = true;
            // $mail->SMTPSecure = 'TLS/STARTTLS';
            // $mail->Host = 'smtp.gmail.com'; // Enter your host here
            // $mail->Port = '587';
            // $mail->IsHTML();
            // $mail->Username = emailuser; // Enter your email here
            // $mail->Password = emailpass; //Enter your passwrod here
            // $mail->setFrom($email, $name);
            // $mail->addAddress($_POST['email']);
            // $mail->Subject = $subject;
            // $mail->Body = $message;
            // $mail->send();
        
            $_SESSION['status'] = "User added successfully";
            $_SESSION['status_code'] = "success";
            header("Location: " . base_url . "admin/home/user");
            exit(0);
        }
        else{
            $_SESSION['status'] = "User was not added";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "admin/home/user");
            exit(0);
        }
    }

    // Update user
    if(isset($_POST["update_user"])){
        $user_id = $_POST['user_id'];
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $lname = $_POST['lname'];
        $suffix = $_POST['suffix'];
        $gender = $_POST['gender'];
        $religion = $_POST['religion'];
        $birthday = $_POST['dob'];
        $placeofbirth = $_POST['placeofbirth'];
        $civilstatus = $_POST['civilstatus'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $user_type = $_POST['role'];
        $user_status = $_POST['status'];

        $query = "UPDATE `user` SET 
        `fname`='$fname',
        `mname`='$mname',
        `lname`='$lname',
        `suffix`='$suffix',
        `gender`='$gender',
        `religion`='$religion',
        `birthday`='$birthday',
        `birthplace`='$placeofbirth',
        `civil_status`='$civilstatus',
        `email`='$email',
        `phone`='$phone',
        `user_type_id`='$user_type',
        `user_status_id`='$user_status'
        WHERE `user_id`='$user_id'";
        $query_run = mysqli_query($con, $query);

        if($query_run){
        $_SESSION['status'] = "User updated successfully";
        $_SESSION['status_code'] = "success";
        header("Location: " . base_url . "admin/home/user");
        exit(0);
        }
        else{
        $_SESSION['status'] = "User was not updated";
        $_SESSION['status_code'] = "error";
        header("Location: " . base_url . "admin/home/user");
        exit(0);
        }
    }
?>