<?php
   // PHP Mailer
   include ("../../assets/vendor/PHPMailer/PHPMailerAutoload.php");
   include ("../../assets/vendor/PHPMailer/class.phpmailer.php");
   include ("../../assets/vendor/PHPMailer/class.smtp.php");
   // -------------------------------- Authentication -------------------------------- //
   if (!defined('DB_SERVER')){
      include ('../includes/authentication.php');
      $user_id = $_SESSION['auth_user']['user_id'];
      // DB connection parameters
      $host = DB_SERVER;
      $user = DB_USERNAME;
      $password = DB_PASSWORD;
      $db = DB_NAME;
      $dsn = "mysql:host=$host;dbname=$db;charset=UTF8";
      try{
         $conn = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
      } catch (PDOException $e){
         echo $e->getMessage();
      }
   }
   // -------------------------------- DataTable User -------------------------------- //
   if (isset($_POST["user_list"])){
      // Reading value
      $draw = $_POST['draw'];
      $row = $_POST['start'];
      $rowperpage = $_POST['length']; // Rows display per page
      $columnIndex = $_POST['order'][0]['column']; // Column index
      $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
      $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
      $searchValue = $_POST['search']['value']; // Search value
      $searchArray = array();
      // Search
      $searchQuery = " ";
      if($searchValue != ''){
         $searchQuery = " AND (user_id LIKE :user_id OR 
            CONCAT(fname, ' ', mname, ' ', lname, ' ', suffix) LIKE :fullname OR
            gender LIKE :gender OR
            DATE_FORMAT(birthday, '%m-%d-%Y') LIKE :newbirthday OR
            civil_status LIKE :civil_status OR
            email LIKE :email OR
            phone LIKE :phone OR
            user_type_id LIKE :user_type_id OR
            user_status_id LIKE :user_status_id) ";
         $searchArray = array( 
            'user_id'=>"%$searchValue%",
            'fullname'=>"%$searchValue%",
            'gender'=>"%$searchValue%",
            'newbirthday'=>"%$searchValue%",
            'civil_status'=>"%$searchValue%",
            'email'=>"%$searchValue%",
            'phone'=>"%$searchValue%",
            'user_type_id'=>"%$searchValue%",
            'user_status_id'=>"%$searchValue%"
         );
      }
      // Total number of records without filtering
      $stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM user WHERE user_status_id != 3 AND user_type_id != 3 AND user_id != '$user_id' ");
      $stmt->execute();
      $records = $stmt->fetch();
      $totalRecords = $records['allcount'];
      // Total number of records with filtering
      $stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM user WHERE user_status_id != 3 AND user_type_id != 3 AND user_id != '$user_id' ".$searchQuery);
      $stmt->execute($searchArray);
      $records = $stmt->fetch();
      $totalRecordwithFilter = $records['allcount'];
      // Fetch records
      $stmt = $conn->prepare("SELECT *, CONCAT(fname, ' ', mname, ' ', lname, ' ', suffix) AS fullname, DATE_FORMAT(birthday, '%m-%d-%Y') as newbirthday FROM user WHERE user_status_id != 3 AND user_type_id != 3 AND user_id != '$user_id' ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");
      // Bind values
      foreach ($searchArray as $key=>$search){
         $stmt->bindValue(':'.$key, $search,PDO::PARAM_STR);
      }
      $stmt->bindValue(':limit', (int)$row, PDO::PARAM_INT);
      $stmt->bindValue(':offset', (int)$rowperpage, PDO::PARAM_INT);
      $stmt->execute();
      $empRecords = $stmt->fetchAll();
      $data = array();
      foreach ($empRecords as $row){
         $data[] = array(
            "user_id"=>$row['user_id'],
            "fullname"=>$row['fullname'],
            "fname"=>$row['fname'],
            "mname"=>$row['mname'],
            "lname"=>$row['lname'],
            "suffix"=>$row['suffix'],
            "gender"=>$row['gender'],
            "birthday"=>$row['birthday'],
            "newbirthday"=>$row['newbirthday'],
            "civil_status"=>$row['civil_status'],
            "email"=>$row['email'],
            "phone"=>$row['phone'],
            "user_type_id"=>$row['user_type_id'],
            "user_status_id"=>$row['user_status_id']
         );
      }
      // Response
      $response = array(
         "draw" => intval($draw),
         "iTotalRecords" => $totalRecords,
         "iTotalDisplayRecords" => $totalRecordwithFilter,
         "aaData" => $data
      );
      echo json_encode($response);
   }
   // -------------------------------- Add User -------------------------------- //
   if (isset($_POST["add_user"])){
      // Validate and sanitize user inputs
      $fname = mysqli_real_escape_string($con, $_POST['add_fname']);
      $mname = mysqli_real_escape_string($con, $_POST['add_mname']);
      $lname = mysqli_real_escape_string($con, $_POST['add_lname']);
      $suffix = mysqli_real_escape_string($con, $_POST['add_suffix']);
      $gender = mysqli_real_escape_string($con, $_POST['add_gender']);
      $birthday = mysqli_real_escape_string($con, $_POST['add_birthday']);
      $civilstatus = mysqli_real_escape_string($con, $_POST['add_civil_status']);
      $email = mysqli_real_escape_string($con, $_POST['add_email']);
      $phone = mysqli_real_escape_string($con, $_POST['add_phone']);
      $user_type = mysqli_real_escape_string($con, $_POST['add_role']);
      // Generate a random password
      $new_password = substr(md5(microtime()), rand(0, 26), 9);
      $password = md5($new_password);
      $user_status = '1';
      $query = "INSERT INTO `user`(`fname`, `mname`, `lname`, `suffix`, `gender`, `birthday`, `civil_status`, `email`, `phone`, `password`, `user_type_id`, `user_status_id`) VALUES ('$fname','$mname','$lname','$suffix','$gender','$birthday','$civilstatus','$email','$phone','$password','$user_type','$user_status')";
      $query_run = mysqli_query($con, $query);
      if ($query_run){
         $name = htmlentities($system['name']);
         $subject = htmlentities('Email and Password Credentials - '. $system['name']);
         $message = nl2br("Dear $fname \r\n \r\n Welcome to ".$system['name']."! \r\n \r\n This is your account information \r\n Email: $email \r\n Password: $new_password \r\n \r\n Please change your password immediately. \r\n \r\n Thanks, \r\n ".$system['name']);
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
         $mail->setFrom($email, $name);
         $mail->addAddress($email);
         $mail->Subject = $subject;
         $mail->Body = $message;
         $mail->send();
         $output = array('status' => "User added successfully check email inbox or spam folder", 'alert' => "success");
      } else{
         $output = array('status' => "User was not added", 'alert' => "error");
      }
      echo json_encode($output);
   }
   // -------------------------------- Edit User -------------------------------- //
   if (isset($_POST["edit_user"])){
      // Validate and sanitize user inputs
      $id = mysqli_real_escape_string($con, $_POST['edit_user_id']);
      $fname = mysqli_real_escape_string($con, $_POST['edit_fname']);
      $mname = mysqli_real_escape_string($con, $_POST['edit_mname']);
      $lname = mysqli_real_escape_string($con, $_POST['edit_lname']);
      $suffix = mysqli_real_escape_string($con, $_POST['edit_suffix']);
      $gender = mysqli_real_escape_string($con, $_POST['edit_gender']);
      $birthday = mysqli_real_escape_string($con, $_POST['edit_birthday']);
      $civilstatus = mysqli_real_escape_string($con, $_POST['edit_civil_status']);
      $email = mysqli_real_escape_string($con, $_POST['edit_email']);
      $phone = mysqli_real_escape_string($con, $_POST['edit_phone']);
      $user_type = mysqli_real_escape_string($con, $_POST['edit_role']);
      $user_status = mysqli_real_escape_string($con, $_POST['edit_status']);
      $query = "UPDATE `user` SET `fname` = '$fname', `mname` = '$mname', `lname` = '$lname', `suffix` = '$suffix', `gender` = '$gender', `birthday` = '$birthday', `civil_status` = '$civilstatus', `email` = '$email', `phone` = '$phone', `user_type_id` = '$user_type', `user_status_id` = '$user_status' WHERE `user_id` = '$id'";
      $query_run = mysqli_query($con, $query);
      if ($query_run){
         $output = array('status' => "User updated successfully", 'alert' => "success");
      } else{
         $output = array('status' => "User was not updated", 'alert' => "error");
      }
      echo json_encode($output);
   }
   // -------------------------------- Delete User -------------------------------- //
   if (isset($_POST["delete_user"])){
      // Validate and sanitize user inputs
      $id = mysqli_real_escape_string($con, $_POST['delete_user_id']);
      $user_status = '3';
      $query = "UPDATE `user` SET `user_status_id` = '$user_status' WHERE `user_id` = '$id'";
      $query_run = mysqli_query($con, $query);
      if ($query_run){
         $output = array('status' => "User deleted successfully", 'alert' => "success");
      } else{
         $output = array('status' => "User was not deleted", 'alert' => "error");
      }
      echo json_encode($output);
   }
   // -------------------------------- Validation -------------------------------- //
   if (isset($_POST["validation"])){
      // Prepare the SQL statement with placeholders for the email and phone parameters
      $stmt = $con->prepare('SELECT COUNT(*) as count FROM user WHERE email = ? OR phone = ?');

      // Bind the parameters to the placeholders and execute the statement
      $stmt->bind_param('ss', $_POST['email'], $_POST['phone']);
      $stmt->execute();

      // Fetch the result as an associative array
      $result = $stmt->get_result()->fetch_assoc();

      // Return the result as JSON
      header('Content-Type: application/json');
      echo json_encode(array('exists' => ($result['count'] > 0)));
   }
?>