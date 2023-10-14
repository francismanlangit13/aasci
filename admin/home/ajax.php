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
   // -------------------------------- Update profile -------------------------------- //
   if (isset($_POST["update_profile"])) {
      function compressImage($source, $destination, $quality){
         // Get image info
         $imgInfo = getimagesize($source);
         $mime = $imgInfo['mime'];
         // Create a new image from file
         switch ($mime) {
            case 'image/jpeg':
               $image = imagecreatefromjpeg($source);
               break;
            case 'image/png':
               $image = imagecreatefrompng($source);
               break;
            case 'image/gif':
               $image = imagecreatefromgif($source);
               break;
            default:
               $image = imagecreatefromjpeg($source);
         }
         // Check and apply image orientation
         $exif = @exif_read_data($source);
         if ($exif && isset($exif['Orientation'])) {
            $orientation = $exif['Orientation'];
            if ($orientation == 3) {
               $image = imagerotate($image, 180, 0);
            } elseif ($orientation == 6) {
               $image = imagerotate($image, -90, 0);
            } elseif ($orientation == 8) {
               $image = imagerotate($image, 90, 0);
            }
         }
         // Save image with compression quality
         imagejpeg($image, $destination, $quality);
         // Return compressed image
         return $destination;
      }
      if (isset($_FILES['image1']) && is_uploaded_file($_FILES['image1']['tmp_name']) && $_FILES['image1']['error'] === UPLOAD_ERR_OK) {
         $fileImage = $_FILES['image1'];
         $OLDfileImage = $_POST['oldimage'];
         $customFileName = 'user_' . date('Ymd_His'); // replace with your desired file name
         $ext = pathinfo($fileImage['name'], PATHINFO_EXTENSION); // get the file extension
         $fileName = $customFileName . '.' . $ext; // append the extension to the custom file name
         $fileTmpname = $fileImage['tmp_name'];
         $fileSize = $fileImage['size'];
         $fileError = $fileImage['error'];
         $fileExt = explode('.', $fileName);
         $fileActExt = strtolower(end($fileExt));
         $allowed = array('jpg', 'jpeg', 'png');
         if (in_array($fileActExt, $allowed)) {
            if ($fileError === 0) {
               if ($fileSize < 5242880) { // 5MB Limit
                  $uploadDir = '../../assets/files/users/';
                  $targetFile = $uploadDir . $fileName;
                  if ($OLDfileImage != null ){
                     unlink($uploadDir . $OLDfileImage);
                  }
                  if ($fileSize > 1048576) { // more than 1 MB
                     // Compress the uploaded image with a quality of 15
                     $compressedImage = compressImage($fileTmpname, $targetFile, 15);
                  } else {
                     // Compress the uploaded image with a quality of 25
                     $compressedImage = compressImage($fileTmpname, $targetFile, 25);
                  }
                  if ($compressedImage) {
                     $query = "UPDATE `user` SET `profile`='$fileName' WHERE `user_id`='$user_id'";
                     $query_run = mysqli_query($con, $query);
                     if ($query_run) {
                        $output = array('status' => 'Profile updated successfully', 'alert' => 'success');
                     } else {
                        $output = array('status' => 'Profile was not updated', 'alert' => 'error');
                     }
                  }
               } else {
                  $output = array('status' => 'File is too large, must be 5MB or below', 'alert' => 'warning');
               }
            } else {
               $output = array('status' => 'File error', 'alert' => 'error');
            }
         } else {
            $output = array('status' => 'Invalid file type', 'alert' => 'error');
         }
         echo json_encode($output);
      }
   }
   // -------------------------------- Get Profile -------------------------------- //
   if (isset($_POST["get_profile"])) {
      // Prepare and execute the SQL query
      $query = $con->prepare("SELECT * FROM user WHERE user_id = ?");
      $query->bind_param("i", $user_id);
      $query->execute();
      $result = $query->get_result();
      if ($result->num_rows > 0) {
          // Fetch user data from the result
          $row = $result->fetch_assoc();
          $output = array('profile' => $row['profile'], 'gender' => $row['gender']);
      }
  
      // Return user data as JSON
      header('Content-Type: application/json');
      echo json_encode($output);
   }
   // -------------------------------- Update Info -------------------------------- //
   if (isset($_POST["update_info"])) {
      $fname = $_POST['fname'];
      $mname = $_POST['mname'];
      $lname = $_POST['lname'];
      $suffix = $_POST['suffix'];
      $civil_status = $_POST['civil_status'];
      $birthday = $_POST['birthday'];
      $email = $_POST['email'];
      $phone = $_POST['phone'];

      $query = "UPDATE `user` SET `fname`='$fname', `mname`='$mname', `lname`='$lname', `suffix`='$suffix', `civil_status`='$civil_status', `birthday`='$birthday', `email`='$email', `phone`='$phone' WHERE `user_id`='$user_id'";
      $query_run = mysqli_query($con, $query);
      if ($query_run) {
         $output = array('status' => 'Accounts details updated successfully', 'alert' => 'success');
      } else {
         $output = array('status' => 'Accounts details was not updated', 'alert' => 'error');
      }
      echo json_encode($output);
   }
   // -------------------------------- Change Password -------------------------------- //
   if (isset($_POST["change_password"])) {
      $currentPassword = md5($_POST['currentPassword']);
      $password = md5($_POST['confirmPassword']);

      // Prepare and execute the SQL query
      $stmt = $con->prepare("SELECT * FROM user WHERE user_id = ?");
      $stmt->bind_param("i", $user_id);
      $stmt->execute();
      $result = $stmt->get_result();
      if ($result->num_rows > 0) {
         // Fetch user data from the result
         $row = $result->fetch_assoc();
         
         if($row['password'] == $currentPassword){
            $query = "UPDATE `user` SET `password`='$password' WHERE `user_id`='$user_id'";
            $query_run = mysqli_query($con, $query);
            if ($query_run) {
               $output = array('status' => 'Password updated successfully', 'alert' => 'success');
            } else {
               $output = array('status' => 'Password was not updated', 'alert' => 'error');
            }
         } else{
            $output = array('status' => 'Incorrect current password', 'alert' => 'warning');
         }
      }
      echo json_encode($output);
   }
   // -------------------------------- Two Step Authenticaiton -------------------------------- //
   if (isset($_POST["authentication"])) {
      if ($_POST['twoFactor'] == 'ON'){
         $store = '1';
         $query = "UPDATE `user` SET `second_auth`='$store' WHERE `user_id`='$user_id'";
         $query_run = mysqli_query($con, $query);
         if ($query_run) {
            $output = array('status' => 'Two-Factor Authentication is turn on', 'alert' => 'success');
         } else {
            $output = array('status' => 'Two-Factor Authentication was not updated', 'alert' => 'error');
         }
      } elseif ($_POST['twoFactor'] == 'OFF'){
         $store = '0';
         $query = "UPDATE `user` SET `second_auth`='$store' WHERE `user_id`='$user_id'";
         $query_run = mysqli_query($con, $query);
         if ($query_run) {
            $output = array('status' => 'Two-Factor Authentication is turn off', 'alert' => 'success');
         } else {
            $output = array('status' => 'Two-Factor Authentication was not updated', 'alert' => 'error');
         }
      } else{
         $output = array('status' => 'Two-Factor Authentication is block', 'alert' => 'warning');
      }
      echo json_encode($output);
   }
   // -------------------------------- Security Preferences -------------------------------- //
   if (isset($_POST["security"])) {
      if ($_POST['radioPrivacy'] == 'ON'){
         $privacy = '1';
      } else{
         $privacy = '0';
      }
      if ($_POST['radioUsage'] == 'ON'){
         $data_sharing = '1';
      } else{
         $data_sharing = '0';
      }
      $query = "UPDATE `user` SET `account_privacy`='$privacy', `data_sharing`='$data_sharing' WHERE `user_id`='$user_id'";
      $query_run = mysqli_query($con, $query);
      if ($query_run) {
         $output = array('status' => 'Security preferences updated successfully', 'alert' => 'success');
      } else {
         $output = array('status' => 'Security preferences was not updated', 'alert' => 'error');
      }
      echo json_encode($output);
   }
   // -------------------------------- Delete Account -------------------------------- //
   if (isset($_POST["delete_account"])) {
      $req_Delete = $_POST['isDelete'];
      $currentPassword = $_POST['yourPassword'];
      if ($req_Delete == '1') {
         $stmt = "UPDATE `user` SET `user_status_id`= '3' WHERE `user_id`='$user_id'";
         $stmt_run = mysqli_query($con, $stmt);
         if ($stmt_run) {
            $output = array('status' => 'Your account will be successfully deleted, and you will be redirected in 5 seconds.', 'alert' => 'success');
            unset( $_SESSION['auth']);
            unset( $_SESSION['auth_role']);
            unset( $_SESSION['auth_user']);
            $_SESSION['status'] = "Delete account successfully.";
            $_SESSION['status_code'] = "success";
         } else {
            $output = array('status' => 'Cannot proceed with your request.', 'alert' => 'error');
         }
      } else {
         $password = md5($currentPassword);
         $query = "SELECT * FROM `user` WHERE `user_id`='$user_id' AND `password`='$password'";
         $query_run = mysqli_query($con, $query);
         if(mysqli_num_rows($query_run) > 0){
            $output = array('status' => '', 'alert' => 'info');
         } else {
            $output = array('status' => 'Incorrect current password', 'alert' => 'warning');
         }
      }
      echo json_encode($output);
   }
?>