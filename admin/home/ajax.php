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
   // -------------------------------- DataTable Archive User -------------------------------- //
   if (isset($_POST["user_list_archive"])){
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
            'user_type_id'=>"%$searchValue%"
         );
      }
      // Total number of records without filtering
      $stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM user WHERE user_status_id = 3 AND user_type_id != 3 AND user_id != '$user_id' ");
      $stmt->execute();
      $records = $stmt->fetch();
      $totalRecords = $records['allcount'];
      // Total number of records with filtering
      $stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM user WHERE user_status_id = 3 AND user_type_id != 3 AND user_id != '$user_id' ".$searchQuery);
      $stmt->execute($searchArray);
      $records = $stmt->fetch();
      $totalRecordwithFilter = $records['allcount'];
      // Fetch records
      $stmt = $conn->prepare("SELECT *, CONCAT(fname, ' ', mname, ' ', lname, ' ', suffix) AS fullname, DATE_FORMAT(birthday, '%m-%d-%Y') as newbirthday FROM user WHERE user_status_id = 3 AND user_type_id != 3 AND user_id != '$user_id' ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");
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
            "user_type_id"=>$row['user_type_id']
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
   // -------------------------------- Restore Archive User -------------------------------- //
   if (isset($_POST["restore_user"])){
      // Validate and sanitize user inputs
      $id = mysqli_real_escape_string($con, $_POST['restore_user_id']);
      $user_status = '1';
      $query = "UPDATE `user` SET `user_status_id` = '$user_status' WHERE `user_id` = '$id'";
      $query_run = mysqli_query($con, $query);
      if ($query_run){
         $output = array('status' => "User restore successfully", 'alert' => "success");
      } else{
         $output = array('status' => "User was not restore", 'alert' => "error");
      }
      echo json_encode($output);
   }
   // -------------------------------- Delete Archive User -------------------------------- //
   if (isset($_POST["delete_user_archive"])){
      // Validate and sanitize user inputs
      $id = mysqli_real_escape_string($con, $_POST['delete_user_id']);
      $query = "DELETE FROM `user` WHERE `user_id` = '$id'";
      $query_run = mysqli_query($con, $query);
      if ($query_run){
         $output = array('status' => "User deleted successfully", 'alert' => "success");
      } else{
         $output = array('status' => "User was not deleted", 'alert' => "error");
      }
      echo json_encode($output);
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
      $query = "INSERT INTO `user`(`fname`, `mname`, `lname`, `suffix`, `gender`, `birthday`, `civil_status`, `email`, `phone`, `password`, `account_privacy`, `data_sharing`, `second_auth`, `user_type_id`, `user_status_id`) VALUES ('$fname','$mname','$lname','$suffix','$gender','$birthday','$civilstatus','$email','$phone','$password','0','0','0','$user_type','$user_status')";
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
                     // Compress the uploaded image with a quality of 25
                     $compressedImage = compressImage($fileTmpname, $targetFile, 25);
                  } else {
                     // Compress the uploaded image with a quality of 35
                     $compressedImage = compressImage($fileTmpname, $targetFile, 35);
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
   // -------------------------------- Delete Permanent Account -------------------------------- //
   if (isset($_POST["delete_account"])) {
      $req_Delete = $_POST['isDelete'];
      $currentPassword = $_POST['yourPassword'];
      if ($req_Delete == '1') {
         $stmt = "DELETE FROM `user` WHERE `user_id`='$user_id'";
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
   // -------------------------------- DataTable Archive Client -------------------------------- //
   if (isset($_POST["client_list_archive"])){
      // Reading values
      $draw = $_POST['draw'];
      $row = $_POST['start'];
      $rowperpage = $_POST['length'];
      $columnIndex = $_POST['order'][0]['column'];
      $columnName = $_POST['columns'][$columnIndex]['data'];
      $columnSortOrder = $_POST['order'][0]['dir'];
      $searchValue = $_POST['search']['value'];
      $searchArray = array();
      
      // Search
      $searchQuery = " ";
      if ($searchValue != '') {
         $searchQuery = " AND (user_id LIKE :user_id OR 
            CONCAT(fname, ' ', mname, ' ', lname, ' ', suffix) LIKE :fullname OR
            id_number LIKE :id_number OR
            gender LIKE :gender OR
            DATE_FORMAT(birthday, '%m-%d-%Y') LIKE :newbirthday OR
            TIMESTAMPDIFF(YEAR, birthday, CURDATE()) = :age OR
            civil_status LIKE :civil_status OR
            purok LIKE :purok OR
            barangay LIKE :barangay OR
            DATE_FORMAT(date_issued, '%m-%d-%Y') LIKE :newdateissued OR
            soc_pen LIKE :soc_pen OR
            gsis LIKE :gsis OR
            sss LIKE :sss OR
            pvao LIKE :pvao OR
            sup_with LIKE :sup_with OR
            fourps LIKE :fourps OR
            nhts LIKE :nhts OR
            id_file LIKE :id_file OR
            rrn LIKE :rrn OR
            is_deceased LIKE :deceased OR
            DATE_FORMAT(deceased_date, '%m-%d-%Y') LIKE :new_deceased_date OR
            is_transfer LIKE :transfer OR
            DATE_FORMAT(transfer_date, '%m-%d-%Y') LIKE :new_transfer_date) ";
         $searchArray = array( 
            'user_id' => "%$searchValue%",
            'fullname' => "%$searchValue%",
            'id_number' => "%$searchValue%",
            'gender' => "%$searchValue%",
            'newbirthday' => "%$searchValue%",
            'age' => $searchValue, // Search for the exact age value
            'civil_status' => "%$searchValue%",
            'purok' => "%$searchValue%",
            'barangay' => "%$searchValue%",
            'newdateissued' => "%$searchValue%",
            'soc_pen' => "%$searchValue%",
            'gsis' => "%$searchValue%",
            'sss' => "%$searchValue%",
            'pvao' => "%$searchValue%",
            'sup_with' => "%$searchValue%",
            'fourps' => "%$searchValue%",
            'nhts' => "%$searchValue%",
            'id_file' => "%$searchValue%",
            'rrn' => "%$searchValue%",
            'deceased' => "%$searchValue%",
            'new_deceased_date' => "%$searchValue%",
            'transfer' => "%$searchValue%",
            'new_transfer_date' => "%$searchValue%"
         );
     }     
      
      // Total number of records without filtering
      $stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM user WHERE user_status_id = 3 AND user_type_id = 3");
      $stmt->execute();
      $records = $stmt->fetch();
      $totalRecords = $records['allcount'];
      
      // Total number of records with filtering
      $stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM user WHERE user_status_id = 3 AND user_type_id = 3" . $searchQuery);
      $stmt->execute($searchArray);
      $records = $stmt->fetch();
      $totalRecordwithFilter = $records['allcount'];
      
      // Fetch records
      $stmt = $conn->prepare("SELECT *,
               CONCAT(fname, ' ', mname, ' ', lname, ' ', suffix) AS fullname,
               DATE_FORMAT(birthday, '%m-%d-%Y') as newbirthday,
               DATE_FORMAT(date_issued, '%m-%d-%Y') as newdateissued,
               CASE WHEN deceased_date IS NOT NULL AND is_deceased = 'Yes'
                     THEN DATE_FORMAT(deceased_date, '%m-%d-%Y')
                     ELSE TIMESTAMPDIFF(YEAR, birthday, CURDATE()) END AS age,
               DATE_FORMAT(deceased_date, '%m-%d-%Y') as new_deceased_date,
               DATE_FORMAT(transfer_date, '%m-%d-%Y') as new_transfer_date
         FROM user
         WHERE user_status_id = 3 AND user_type_id = 3" . $searchQuery . "
         ORDER BY " . $columnName . " " . $columnSortOrder . "
         LIMIT :limit, :offset
      ");
      
      // Bind values
      foreach ($searchArray as $key => $search) {
          $stmt->bindValue(':' . $key, $search, PDO::PARAM_STR);
      }
      $stmt->bindValue(':limit', (int)$row, PDO::PARAM_INT);
      $stmt->bindValue(':offset', (int)$rowperpage, PDO::PARAM_INT);
      $stmt->execute();
      $empRecords = $stmt->fetchAll();
      
      $data = array();
      
      foreach ($empRecords as $row) {
          $data[] = array(
              "user_id" => $row['user_id'],
              "fullname" => $row['fullname'],
              "fname" => $row['fname'],
              "mname" => $row['mname'],
              "lname" => $row['lname'],
              "suffix" => $row['suffix'],
              "id_number" => $row['id_number'],
              "gender" => $row['gender'],
              "birthday" => $row['birthday'],
              "newbirthday" => $row['newbirthday'],
              "age" => $row['age'],
              "civil_status" => $row['civil_status'],
              "purok" => $row['purok'],
              "barangay" => $row['barangay'],
              "dateissued" => $row['date_issued'],
              "newdateissued" => $row['newdateissued'],
              "soc_pen" => $row['soc_pen'],
              "gsis" => $row['gsis'],
              "sss" => $row['sss'],
              "pvao" => $row['pvao'],
              "sup_with" => $row['sup_with'],
              "fourps" => $row['fourps'],
              "nhts" => $row['nhts'],
              "id_file" => $row['id_file'],
              "rrn" => $row['rrn'],
              "deceased" => $row['is_deceased'],
              "new_deceased_date" => $row['new_deceased_date'],
              "transfer" => $row['is_transfer'],
              "new_transfer_date" => $row['new_transfer_date'],
              "profile" => $row['profile'],
              "psa" => $row['psa']
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
   // -------------------------------- Restore Archive Client -------------------------------- //
   if (isset($_POST["restore_client"])){
      // Validate and sanitize user inputs
      $id = mysqli_real_escape_string($con, $_POST['restore_client_id']);
      $user_status = '1';
      $query = "UPDATE `user` SET `user_status_id` = '$user_status' WHERE `user_id` = '$id'";
      $query_run = mysqli_query($con, $query);
      if ($query_run){
         $output = array('status' => "Senior restore successfully", 'alert' => "success");
      } else{
         $output = array('status' => "Senior was not restore", 'alert' => "error");
      }
      echo json_encode($output);
   }
   // -------------------------------- Delete Archive Client -------------------------------- //
   if (isset($_POST["delete_client_archive"])){
      // Validate and sanitize user inputs
      $id = mysqli_real_escape_string($con, $_POST['delete_client_id']);
      $query = "DELETE FROM `user` WHERE `user_id` = '$id'";
      $query_run = mysqli_query($con, $query);
      if ($query_run){
         $output = array('status' => "Senior deleted successfully", 'alert' => "success");
      } else{
         $output = array('status' => "Senior was not deleted", 'alert' => "error");
      }
      echo json_encode($output);
   }
   // -------------------------------- DataTable Client -------------------------------- //
   if (isset($_POST["client_list"])) {
      // Reading values
      $draw = $_POST['draw'];
      $row = $_POST['start'];
      $rowperpage = $_POST['length'];
      $columnIndex = $_POST['order'][0]['column'];
      $columnName = $_POST['columns'][$columnIndex]['data'];
      $columnSortOrder = $_POST['order'][0]['dir'];
      $searchValue = $_POST['search']['value'];
      $searchArray = array();
      
      // Search
      $searchQuery = " ";
      if ($searchValue != '') {
         $searchQuery = " AND (user_id LIKE :user_id OR 
            CONCAT(fname, ' ', mname, ' ', lname, ' ', suffix) LIKE :fullname OR
            id_number LIKE :id_number OR
            gender LIKE :gender OR
            DATE_FORMAT(birthday, '%m-%d-%Y') LIKE :newbirthday OR
            TIMESTAMPDIFF(YEAR, birthday, CURDATE()) = :age OR
            civil_status LIKE :civil_status OR
            purok LIKE :purok OR
            barangay LIKE :barangay OR
            DATE_FORMAT(date_issued, '%m-%d-%Y') LIKE :newdateissued OR
            soc_pen LIKE :soc_pen OR
            gsis LIKE :gsis OR
            sss LIKE :sss OR
            pvao LIKE :pvao OR
            sup_with LIKE :sup_with OR
            fourps LIKE :fourps OR
            nhts LIKE :nhts OR
            id_file LIKE :id_file OR
            rrn LIKE :rrn OR
            is_deceased LIKE :deceased OR
            DATE_FORMAT(deceased_date, '%m-%d-%Y') LIKE :new_deceased_date OR
            is_transfer LIKE :transfer OR
            DATE_FORMAT(transfer_date, '%m-%d-%Y') LIKE :new_transfer_date OR
            user_status_id LIKE :user_status_id) ";
         $searchArray = array( 
            'user_id' => "%$searchValue%",
            'fullname' => "%$searchValue%",
            'id_number' => "%$searchValue%",
            'gender' => "%$searchValue%",
            'newbirthday' => "%$searchValue%",
            'age' => $searchValue, // Search for the exact age value
            'civil_status' => $searchValue,
            'purok' => "%$searchValue%",
            'barangay' => "%$searchValue%",
            'newdateissued' => "%$searchValue%",
            'soc_pen' => "%$searchValue%",
            'gsis' => "%$searchValue%",
            'sss' => "%$searchValue%",
            'pvao' => "%$searchValue%",
            'sup_with' => "%$searchValue%",
            'fourps' => "%$searchValue%",
            'nhts' => "%$searchValue%",
            'id_file' => "%$searchValue%",
            'rrn' => "%$searchValue%",
            'deceased' => "%$searchValue%",
            'new_deceased_date' => "%$searchValue%",
            'transfer' => "%$searchValue%",
            'new_transfer_date' => "%$searchValue%",
            'user_status_id' => "%$searchValue%"
         );
     }     
      
      // Total number of records without filtering
      $stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM user WHERE user_status_id != 3 AND user_type_id = 3");
      $stmt->execute();
      $records = $stmt->fetch();
      $totalRecords = $records['allcount'];
      
      // Total number of records with filtering
      $stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM user WHERE user_status_id != 3 AND user_type_id = 3" . $searchQuery);
      $stmt->execute($searchArray);
      $records = $stmt->fetch();
      $totalRecordwithFilter = $records['allcount'];
      
      // Fetch records
      $stmt = $conn->prepare("SELECT *,
               CONCAT(fname, ' ', mname, ' ', lname, ' ', suffix) AS fullname,
               DATE_FORMAT(birthday, '%m-%d-%Y') as newbirthday,
               DATE_FORMAT(date_issued, '%m-%d-%Y') as newdateissued,
               CASE WHEN deceased_date IS NOT NULL AND is_deceased = 'Yes'
                     THEN DATE_FORMAT(deceased_date, '%m-%d-%Y')
                     ELSE TIMESTAMPDIFF(YEAR, birthday, CURDATE()) END AS age,
               DATE_FORMAT(deceased_date, '%m-%d-%Y') as new_deceased_date,
               DATE_FORMAT(transfer_date, '%m-%d-%Y') as new_transfer_date
         FROM user
         WHERE user_status_id != 3 AND user_type_id = 3" . $searchQuery . "
         ORDER BY " . $columnName . " " . $columnSortOrder . "
         LIMIT :limit, :offset
      ");
      
      // Bind values
      foreach ($searchArray as $key => $search) {
          $stmt->bindValue(':' . $key, $search, PDO::PARAM_STR);
      }
      $stmt->bindValue(':limit', (int)$row, PDO::PARAM_INT);
      $stmt->bindValue(':offset', (int)$rowperpage, PDO::PARAM_INT);
      $stmt->execute();
      $empRecords = $stmt->fetchAll();
      
      $data = array();
      
      foreach ($empRecords as $row) {
          $data[] = array(
              "user_id" => $row['user_id'],
              "fullname" => $row['fullname'],
              "fname" => $row['fname'],
              "mname" => $row['mname'],
              "lname" => $row['lname'],
              "suffix" => $row['suffix'],
              "id_number" => $row['id_number'],
              "gender" => $row['gender'],
              "birthday" => $row['birthday'],
              "newbirthday" => $row['newbirthday'],
              "age" => $row['age'],
              "civil_status" => $row['civil_status'],
              "purok" => $row['purok'],
              "barangay" => $row['barangay'],
              "dateissued" => $row['date_issued'],
              "newdateissued" => $row['newdateissued'],
              "soc_pen" => $row['soc_pen'],
              "gsis" => $row['gsis'],
              "sss" => $row['sss'],
              "pvao" => $row['pvao'],
              "sup_with" => $row['sup_with'],
              "fourps" => $row['fourps'],
              "nhts" => $row['nhts'],
              "id_file" => $row['id_file'],
              "rrn" => $row['rrn'],
              "user_status_id" => $row['user_status_id'],
              "deceased" => $row['is_deceased'],
              "new_deceased_date" => $row['new_deceased_date'],
              "transfer" => $row['is_transfer'],
              "new_transfer_date" => $row['new_transfer_date'],
              "profile" => $row['profile'],
              "psa" => $row['psa']
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
   // -------------------------------- Add Client -------------------------------- //
   if (isset($_POST["add_client"])) {
      function compressImage($source, $destination, $quality) {
         // Get image info
         $imgInfo = getimagesize($source);
         $mime = $imgInfo['mime'];
         // Create a new image from the file
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
         // Save the image with compression quality
         imagejpeg($image, $destination, $quality);
         // Return the compressed image's destination
         return $destination;
      }

      // Validate and sanitize client inputs
      $fname = mysqli_real_escape_string($con, $_POST['add_fname']);
      $mname = mysqli_real_escape_string($con, $_POST['add_mname']);
      $lname = mysqli_real_escape_string($con, $_POST['add_lname']);
      $suffix = mysqli_real_escape_string($con, $_POST['add_suffix']);
      $id_number = mysqli_real_escape_string($con, $_POST['add_id_number']);
      $gender = mysqli_real_escape_string($con, $_POST['add_gender']);
      $birthday = mysqli_real_escape_string($con, $_POST['add_birthday']);
      $civil_status = mysqli_real_escape_string($con, $_POST['add_civil_status']);
      $purok = mysqli_real_escape_string($con, $_POST['add_purok']);
      $barangay = mysqli_real_escape_string($con, $_POST['add_barangay']);
      $date_issued = mysqli_real_escape_string($con, $_POST['add_date_issued']);
      $rrn = mysqli_real_escape_string($con, $_POST['add_rrn']);
      $soc_pen = mysqli_real_escape_string($con, $_POST['add_soc_pen']);
      $gsis = mysqli_real_escape_string($con, $_POST['add_gsis']);
      $sss = mysqli_real_escape_string($con, $_POST['add_sss']);
      $pvao = mysqli_real_escape_string($con, $_POST['add_pvao']);
      $sup_with = mysqli_real_escape_string($con, $_POST['add_sup_with']);
      $fourps = mysqli_real_escape_string($con, $_POST['add_4ps']);
      $nhts = mysqli_real_escape_string($con, $_POST['add_nhts']);
      $id_file = mysqli_real_escape_string($con, $_POST['add_id_file']);
      $user_status = '1';
      $user_type = '3';
      $is_deceased = 'No';
      $is_transfer = 'No';
      $fileImage = $_FILES['image1'];
      $fileImage1 = $_FILES['image2'];
      $customFileName = 'user_' . date('Ymd_His'); // replace with your desired file name
      $customFileName1 = 'psa_' . date('Ymd_His');
      $ext = pathinfo($fileImage['name'], PATHINFO_EXTENSION); // get the file extension
      $ext1 = pathinfo($fileImage1['name'], PATHINFO_EXTENSION);
      $fileName = $customFileName . '.' . $ext; // append the extension to the custom file name
      $fileName1 = $customFileName1 . '.' . $ext1;
      $fileTmpname = $fileImage['tmp_name'];
      $fileTmpname1 = $fileImage1['tmp_name'];
      $fileSize = $fileImage['size'];
      $fileSize1 = $fileImage1['size'];
      $fileError = $fileImage['error'];
      $fileError1 = $fileImage1['error'];
      $fileExt = explode('.', $fileName);
      $fileExt1 = explode('.', $fileName1);
      $fileActExt = strtolower(end($fileExt));
      $fileActExt1 = strtolower(end($fileExt1));
      $allowed = array('jpg', 'jpeg', 'png');
      if (in_array($fileActExt, $allowed) && in_array($fileActExt1, $allowed)) {
         if ($fileError === 0 && $fileError1 === 0) {
               if ($fileSize < 5242880 && $fileSize1 < 5242880) { // 5MB Limit
                  $uploadDir = '../../assets/files/clients/';
                  $uploadDir1 = '../../assets/files/documents/';
                  $targetFile = $uploadDir . $fileName;
                  $targetFile1 = $uploadDir1 . $fileName1;
                  if ($fileSize > 1048576 && $fileSize1 > 1048576) { // more than 1 MB
                     // Compress the uploaded images with a quality of 25
                     $compressedImage = compressImage($fileTmpname, $targetFile, 25);
                     $compressedImage1 = compressImage($fileTmpname1, $targetFile1, 25);
                  } else {
                     // Compress the uploaded images with a quality of 35
                     $compressedImage = compressImage($fileTmpname, $targetFile, 35);
                     $compressedImage1 = compressImage($fileTmpname1, $targetFile1, 35);
                  }
                  if ($compressedImage && $compressedImage1) {
                     $query = "INSERT INTO `user`(`id_number`, `fname`, `mname`, `lname`, `suffix`, `gender`, `birthday`, `civil_status`, `profile`, `psa`, `date_issued`, `soc_pen`, `gsis`, `sss`, `pvao`, `sup_with`, `fourps`, `nhts`, `id_file`, `purok`, `barangay`, `rrn`, `is_deceased`, `is_transfer`, `user_type_id`, `user_status_id`) VALUES ('$id_number','$fname','$mname','$lname','$suffix','$gender','$birthday','$civil_status','$fileName','$fileName1','$date_issued','$soc_pen','$gsis','$sss','$pvao','$sup_with','$fourps','$nhts','$id_file','$purok','$barangay','$rrn','$is_deceased','$is_transfer','$user_type','$user_status')";
                     $query_run = mysqli_query($con, $query);
                     if ($query_run) {
                           $output = array('status' => "Senior citizen added successfully", 'alert' => "success");
                     } else {
                           $output = array('status' => "Senior citizen was not added", 'alert' => "error");
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

   // -------------------------------- Edit Client -------------------------------- //
   if (isset($_POST["edit_client"])){
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
      
      // Validate and sanitize client inputs
      $id = mysqli_real_escape_string($con, $_POST['edit_client_id']);
      $fname = mysqli_real_escape_string($con, $_POST['edit_fname']);
      $mname = mysqli_real_escape_string($con, $_POST['edit_mname']);
      $lname = mysqli_real_escape_string($con, $_POST['edit_lname']);
      $suffix = mysqli_real_escape_string($con, $_POST['edit_suffix']);
      $id_number = mysqli_real_escape_string($con, $_POST['edit_id_number']);
      $gender = mysqli_real_escape_string($con, $_POST['edit_gender']);
      $birthday = mysqli_real_escape_string($con, $_POST['edit_birthday']);
      $civil_status = mysqli_real_escape_string($con, $_POST['edit_civil_status']);
      $purok = mysqli_real_escape_string($con, $_POST['edit_purok']);
      $barangay = mysqli_real_escape_string($con, $_POST['edit_barangay']);
      $date_issued = mysqli_real_escape_string($con, $_POST['edit_date_issued']);
      $rrn = mysqli_real_escape_string($con, $_POST['edit_rrn']);
      $soc_pen = mysqli_real_escape_string($con, $_POST['edit_soc_pen']);
      $gsis = mysqli_real_escape_string($con, $_POST['edit_gsis']);
      $sss = mysqli_real_escape_string($con, $_POST['edit_sss']);
      $pvao = mysqli_real_escape_string($con, $_POST['edit_pvao']);
      $sup_with = mysqli_real_escape_string($con, $_POST['edit_sup_with']);
      $fourps = mysqli_real_escape_string($con, $_POST['edit_4ps']);
      $nhts = mysqli_real_escape_string($con, $_POST['edit_nhts']);
      $id_file = mysqli_real_escape_string($con, $_POST['edit_id_file']);
      $user_status = mysqli_real_escape_string($con, $_POST['edit_status']);
      $is_deceased = mysqli_real_escape_string($con, $_POST['edit_deceased']);
      if($is_deceased == 'Yes'){
         $is_deceased_date = date;
      } else {
         $is_deceased_date = null;
      }
      $is_transfer = mysqli_real_escape_string($con, $_POST['edit_transfer']);
      if($is_transfer == 'Yes'){
         $is_transfer_date = date;
      } else {
         $is_transfer_date = null;
      }
      if (isset($_FILES['image5']) && is_uploaded_file($_FILES['image5']['tmp_name']) && $_FILES['image5']['error'] === UPLOAD_ERR_OK) {
         $fileImage5 = $_FILES['image5'];
         $OLDfileImage5 = $_POST['oldimage5'];
         $customFileName5 = 'user_' . date('Ymd_His'); // replace with your desired file name
         $ext5 = pathinfo($fileImage5['name'], PATHINFO_EXTENSION); // get the file extension
         $fileName5 = $customFileName5 . '.' . $ext5; // append the extension to the custom file name
         $fileTmpname5 = $fileImage5['tmp_name'];
         $fileSize5 = $fileImage5['size'];
         $fileError5 = $fileImage5['error'];
         $fileExt5 = explode('.', $fileName5);
         $fileActExt5 = strtolower(end($fileExt5));
         $allowed5 = array('jpg', 'jpeg', 'png');
         if (in_array($fileActExt5, $allowed5)) {
            if ($fileError5 === 0) {
               if ($fileSize5 < 5242880) { // 5MB Limit
                  $uploadDir5 = '../../assets/files/clients/';
                  $targetFile5 = $uploadDir5 . $fileName5;
                  if ($OLDfileImage5 != null ){
                     unlink($uploadDir5 . $OLDfileImage5);
                  }
                  if ($fileSize5 > 1048576) { // more than 1 MB
                     // Compress the uploaded image with a quality of 25
                     $compressedImage5 = compressImage($fileTmpname5, $targetFile5, 25);
                  } else {
                     // Compress the uploaded image with a quality of 35
                     $compressedImage5 = compressImage($fileTmpname5, $targetFile5, 35);
                  }
                  if ($compressedImage5) {
                     $query = "UPDATE `user` SET `profile`='$fileName5' WHERE `user_id`='$id'";
                     $query_run = mysqli_query($con, $query);
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
      }
      if (isset($_FILES['image6']) && is_uploaded_file($_FILES['image6']['tmp_name']) && $_FILES['image6']['error'] === UPLOAD_ERR_OK) {
         $fileImage6 = $_FILES['image6'];
         $OLDfileImage6 = $_POST['oldimage6'];
         $customFileName6 = 'psa_' . date('Ymd_His'); // replace with your desired file name
         $ext6 = pathinfo($fileImage6['name'], PATHINFO_EXTENSION); // get the file extension
         $fileName6 = $customFileName6 . '.' . $ext6; // append the extension to the custom file name
         $fileTmpname6 = $fileImage6['tmp_name'];
         $fileSize6 = $fileImage6['size'];
         $fileError6 = $fileImage6['error'];
         $fileExt6 = explode('.', $fileName6);
         $fileActExt6 = strtolower(end($fileExt6));
         $allowed6 = array('jpg', 'jpeg', 'png');
         if (in_array($fileActExt6, $allowed6)) {
            if ($fileError6 === 0) {
               if ($fileSize6 < 5242880) { // 5MB Limit
                  $uploadDir6 = '../../assets/files/documents/';
                  $targetFile6 = $uploadDir6 . $fileName6;
                  if ($OLDfileImage6 != null ){
                     unlink($uploadDir6 . $OLDfileImage6);
                  }
                  if ($fileSize6 > 1048576) { // more than 1 MB
                     // Compress the uploaded image with a quality of 25
                     $compressedImage6 = compressImage($fileTmpname6, $targetFile6, 25);
                  } else {
                     // Compress the uploaded image with a quality of 35
                     $compressedImage6 = compressImage($fileTmpname6, $targetFile6, 35);
                  }
                  if ($compressedImage6) {
                     $query = "UPDATE `user` SET `psa`='$fileName6' WHERE `user_id`='$id'";
                     $query_run = mysqli_query($con, $query);
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
      }
      $query = "UPDATE `user` SET `id_number` = '$id_number', `fname` = '$fname', `mname` = '$mname', `lname` = '$lname', `suffix` = '$suffix', `gender` = '$gender', `birthday` = '$birthday', `civil_status` = '$civil_status', `date_issued` = '$date_issued', `soc_pen` = '$soc_pen', `gsis` = '$gsis', `sss` = '$sss', `pvao` = '$pvao', `sup_with` = '$sup_with', `fourps` = '$fourps', `nhts` = '$nhts', `id_file` = '$id_file', `purok` = '$purok', `barangay` = '$barangay', `rrn` = '$rrn', `user_status_id` = '$user_status', `is_deceased` = '$is_deceased', `deceased_date` = '$is_deceased_date', `is_transfer` = '$is_transfer', `transfer_date` = '$is_transfer_date' WHERE `user_id` = '$id'";
      $query_run = mysqli_query($con, $query);
      if ($query_run){
         $output = array('status' => "Senior citizen updated successfully", 'alert' => "success");
      } else{
         $output = array('status' => "Senior citizen was not updated", 'alert' => "error");
      }
      echo json_encode($output);
   }
   // -------------------------------- Delete Client -------------------------------- //
   if (isset($_POST["delete_client"])){
      // Validate and sanitize client inputs
      $id = mysqli_real_escape_string($con, $_POST['delete_client_id']);
      $user_status = '3';
      $query = "UPDATE `user` SET `user_status_id` = '$user_status' WHERE `user_id` = '$id'";
      $query_run = mysqli_query($con, $query);
      if ($query_run){
         $output = array('status' => "Senior citizen deleted successfully", 'alert' => "success");
      } else{
         $output = array('status' => "Senior citizen was not deleted", 'alert' => "error");
      }
      echo json_encode($output);
   }
   // -------------------------------- Update System Info -------------------------------- //
   if (isset($_POST["update_system_info"])) {
      // Assuming you have an associative array with keys and values
      $updates = [
         'name' => $_POST['system_name'],
         'shortname' => $_POST['system_short_name'],
         'description' => $_POST['system_description'],
         'keywords' => $_POST['system_keywords'],
         'author' => $_POST['system_author']
      ];
      $success = true;
      // Assuming $this->conn is a valid MySQLi connection
      foreach ($updates as $key => $value) {
         $query = "UPDATE `system_setting` SET `meta_value`='$value' WHERE `meta`='$key'";
         $query_run = mysqli_query($con, $query);
         if (!$query_run) {
            // If the update for any field fails, set $success to false
            $success = false;
            break; // Exit the loop
         }
      }
      if ($success) {
         $output = array('status' => 'System information updated successfully', 'alert' => 'success', 'inform' => 'Yes');
      } else {
         $output = array('status' => 'System information were not updated', 'alert' => 'error');
      }
      echo json_encode($output);
   }
   // -------------------------------- Update System Info Privacy -------------------------------- //
   if (isset($_POST["update_system_info_privacy"])) {
      // Assuming you have an associative array with keys and values
      $updates = [
         'privacy' => $_POST['system_privacy']
      ];
      $success = true;
      // Assuming $this->conn is a valid MySQLi connection
      foreach ($updates as $key => $value) {
         $query = "UPDATE `system_setting` SET `meta_value`='$value' WHERE `meta`='$key'";
         $query_run = mysqli_query($con, $query);
         if (!$query_run) {
            // If the update for any field fails, set $success to false
            $success = false;
            break; // Exit the loop
         }
      }
      if ($success) {
         $output = array('status' => 'Privacy information updated successfully', 'alert' => 'success', 'inform' => 'Yes');
      } else {
         $output = array('status' => 'Privacy information were not updated', 'alert' => 'error');
      }
      echo json_encode($output);
   }
   // -------------------------------- Update System Info Terms -------------------------------- //
   if (isset($_POST["update_system_info_terms"])) {
      // Assuming you have an associative array with keys and values
      $updates = [
         'terms' => $_POST['system_terms']
      ];
      $success = true;
      // Assuming $this->conn is a valid MySQLi connection
      foreach ($updates as $key => $value) {
         $query = "UPDATE `system_setting` SET `meta_value`='$value' WHERE `meta`='$key'";
         $query_run = mysqli_query($con, $query);
         if (!$query_run) {
            // If the update for any field fails, set $success to false
            $success = false;
            break; // Exit the loop
         }
      }
      if ($success) {
         $output = array('status' => 'Terms information updated successfully', 'alert' => 'success', 'inform' => 'Yes');
      } else {
         $output = array('status' => 'Terms information were not updated', 'alert' => 'error');
      }
      echo json_encode($output);
   }
   // -------------------------------- Update System Info ACT -------------------------------- //
   if (isset($_POST["update_system_info_act"])) {
      // Assuming you have an associative array with keys and values
      $updates = ['sysacttitle' => $_POST['system_title'], 'sysact' => $_POST['system_act']];
      $success = true;
      // Assuming $con is your MySQLi connection
      foreach ($updates as $key => $value) {
         $query = "UPDATE `system_setting` SET `meta_value`=? WHERE `meta`=?";
         $stmt = mysqli_prepare($con, $query);
         if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'ss', $value, $key);
            $query_run = mysqli_stmt_execute($stmt);
            if (!$query_run) {
               // If the update for any field fails, set $success to false
               $success = false;
               break; // Exit the loop
            }
            mysqli_stmt_close($stmt);
         } else {
            // Handle the case where the prepared statement fails
            $success = false;
            break; // Exit the loop
         }
      }
      if ($success) {
         $output = array('status' => 'Repubic Act information updated successfully', 'alert' => 'success', 'inform' => 'Yes');
      } else {
         $output = array('status' => 'Repubic Act information were not updated', 'alert' => 'error');
      }
      echo json_encode($output);
  }  
   // -------------------------------- Facebook switch -------------------------------- //
   if (isset($_POST['switch_facebook'])) {
      $switchState = intval($_POST['switch_facebook']); // Convert to integer (1 or 0)
      $query = "UPDATE `system_setting` SET `meta_switch`='$switchState' WHERE `meta`='facebook'";
      $query_run = mysqli_query($con, $query);
      if ($query_run && $switchState == '1') {
         $output = array('status' => 'Facebook turn on', 'alert' => 'success', 'switch' => '1');
      } elseif ($query_run && $switchState == '0') {
         $output = array('status' => 'Facebook turn off', 'alert' => 'success', 'switch' => '0');
      } else {
         $output = array('status' => 'There is problem switching facebook', 'alert' => 'error');
      }
      echo json_encode($output);
   }
   // -------------------------------- Facebook forms -------------------------------- //
   if (isset($_POST['update_system_facebook'])) {
      $form = $_POST['system_facebook'];
      $query = "UPDATE `system_setting` SET `meta_value`='$form' WHERE `meta`='facebook'";
      $query_run = mysqli_query($con, $query);
      if ($query_run) {
         $output = array('status' => 'Facebook updated successfully', 'alert' => 'success');
      } else {
         $output = array('status' => 'There is problem updated facebook', 'alert' => 'error');
      }
      echo json_encode($output);
   }
   // -------------------------------- Instagram switch -------------------------------- //
   if (isset($_POST['switch_instagram'])) {
      $switchState = intval($_POST['switch_instagram']); // Convert to integer (1 or 0)
      $query = "UPDATE `system_setting` SET `meta_switch`='$switchState' WHERE `meta`='instagram'";
      $query_run = mysqli_query($con, $query);
      if ($query_run && $switchState == '1') {
         $output = array('status' => 'Instagram turn on', 'alert' => 'success', 'switch' => '1');
      } elseif ($query_run && $switchState == '0') {
         $output = array('status' => 'Instagram turn off', 'alert' => 'success', 'switch' => '0');
      } else {
         $output = array('status' => 'There is problem switching instagram', 'alert' => 'error');
      }
      echo json_encode($output);
   }
   // -------------------------------- Instagram forms -------------------------------- //
   if (isset($_POST['update_system_instagram'])) {
      $form = $_POST['system_instagram'];
      $query = "UPDATE `system_setting` SET `meta_value`='$form' WHERE `meta`='instagram'";
      $query_run = mysqli_query($con, $query);
      if ($query_run) {
         $output = array('status' => 'Instagram updated successfully', 'alert' => 'success');
      } else {
         $output = array('status' => 'There is problem updated instagram', 'alert' => 'error');
      }
      echo json_encode($output);
   }
   // -------------------------------- Twitter switch -------------------------------- //
   if (isset($_POST['switch_twitter'])) {
      $switchState = intval($_POST['switch_twitter']); // Convert to integer (1 or 0)
      $query = "UPDATE `system_setting` SET `meta_switch`='$switchState' WHERE `meta`='twitter'";
      $query_run = mysqli_query($con, $query);
      if ($query_run && $switchState == '1') {
         $output = array('status' => 'Twitter turn on', 'alert' => 'success', 'switch' => '1');
      } elseif ($query_run && $switchState == '0') {
         $output = array('status' => 'Twitter turn off', 'alert' => 'success', 'switch' => '0');
      } else {
         $output = array('status' => 'There is problem switching twitter', 'alert' => 'error');
      }
      echo json_encode($output);
   }
   // -------------------------------- Twitter forms -------------------------------- //
   if (isset($_POST['update_system_twitter'])) {
      $form = $_POST['system_twitter'];
      $query = "UPDATE `system_setting` SET `meta_value`='$form' WHERE `meta`='twitter'";
      $query_run = mysqli_query($con, $query);
      if ($query_run) {
         $output = array('status' => 'Twitter updated successfully', 'alert' => 'success');
      } else {
         $output = array('status' => 'There is problem updated twitter', 'alert' => 'error');
      }
      echo json_encode($output);
   }
   // -------------------------------- Tumblr switch -------------------------------- //
   if (isset($_POST['switch_tumblr'])) {
      $switchState = intval($_POST['switch_tumblr']); // Convert to integer (1 or 0)
      $query = "UPDATE `system_setting` SET `meta_switch`='$switchState' WHERE `meta`='tumblr'";
      $query_run = mysqli_query($con, $query);
      if ($query_run && $switchState == '1') {
         $output = array('status' => 'Tumblr turn on', 'alert' => 'success', 'switch' => '1');
      } elseif ($query_run && $switchState == '0') {
         $output = array('status' => 'Tumblr turn off', 'alert' => 'success', 'switch' => '0');
      } else {
         $output = array('status' => 'There is problem switching tumblr', 'alert' => 'error');
      }
      echo json_encode($output);
   }
   // -------------------------------- Tumblr forms -------------------------------- //
   if (isset($_POST['update_system_tumblr'])) {
      $form = $_POST['system_tumblr'];
      $query = "UPDATE `system_setting` SET `meta_value`='$form' WHERE `meta`='tumblr'";
      $query_run = mysqli_query($con, $query);
      if ($query_run) {
         $output = array('status' => 'Tumblr updated successfully', 'alert' => 'success');
      } else {
         $output = array('status' => 'There is problem updated tumblr', 'alert' => 'error');
      }
      echo json_encode($output);
   }
   // -------------------------------- Email switch -------------------------------- //
   if (isset($_POST['switch_email'])) {
      $switchState = intval($_POST['switch_email']); // Convert to integer (1 or 0)
      $query = "UPDATE `system_setting` SET `meta_switch`='$switchState' WHERE `meta`='email'";
      $query_run = mysqli_query($con, $query);
      if ($query_run && $switchState == '1') {
         $output = array('status' => 'Email turn on', 'alert' => 'success', 'switch' => '1');
      } elseif ($query_run && $switchState == '0') {
         $output = array('status' => 'Email turn off', 'alert' => 'success', 'switch' => '0');
      } else {
         $output = array('status' => 'There is problem switching email', 'alert' => 'error');
      }
      echo json_encode($output);
   }
   // -------------------------------- Email forms -------------------------------- //
   if (isset($_POST['update_system_email'])) {
      $form = $_POST['system_email'];
      $query = "UPDATE `system_setting` SET `meta_value`='$form' WHERE `meta`='email'";
      $query_run = mysqli_query($con, $query);
      if ($query_run) {
         $output = array('status' => 'Email updated successfully', 'alert' => 'success');
      } else {
         $output = array('status' => 'There is problem updated email', 'alert' => 'error');
      }
      echo json_encode($output);
   }
   // -------------------------------- Phone switch -------------------------------- //
   if (isset($_POST['switch_phone'])) {
      $switchState = intval($_POST['switch_phone']); // Convert to integer (1 or 0)
      $query = "UPDATE `system_setting` SET `meta_switch`='$switchState' WHERE `meta`='number'";
      $query_run = mysqli_query($con, $query);
      if ($query_run && $switchState == '1') {
         $output = array('status' => 'Phone turn on', 'alert' => 'success', 'switch' => '1');
      } elseif ($query_run && $switchState == '0') {
         $output = array('status' => 'Phone turn off', 'alert' => 'success', 'switch' => '0');
      } else {
         $output = array('status' => 'There is problem switching number', 'alert' => 'error');
      }
      echo json_encode($output);
   }
   // -------------------------------- Phone forms -------------------------------- //
   if (isset($_POST['update_system_phone'])) {
      $form = $_POST['system_number'];
      $query = "UPDATE `system_setting` SET `meta_value`='$form' WHERE `meta`='number'";
      $query_run = mysqli_query($con, $query);
      if ($query_run) {
         $output = array('status' => 'Phone updated successfully', 'alert' => 'success');
      } else {
         $output = array('status' => 'There is problem updated phone', 'alert' => 'error');
      }
      echo json_encode($output);
   }
   // -------------------------------- Update System Icon -------------------------------- //
   if (isset($_POST["update_sysicon"])) {
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
         $OLDfileImage = $_POST['oldICONimage'];
         $customFileName = 'sysicon_' . date('Ymd_His'); // replace with your desired file name
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
                  $uploadDir = '../../assets/files/system/';
                  $targetFile = $uploadDir . $fileName;
                  if ($OLDfileImage != null ){
                     unlink($uploadDir . $OLDfileImage);
                  }
                  if ($fileSize > 1048576) { // more than 1 MB
                     // Compress the uploaded image with a quality of 25
                     $compressedImage = compressImage($fileTmpname, $targetFile, 25);
                  } else {
                     // Compress the uploaded image with a quality of 35
                     $compressedImage = compressImage($fileTmpname, $targetFile, 35);
                  }
                  if ($compressedImage) {
                     $query = "UPDATE `system_setting` SET `meta_value`='$fileName' WHERE `meta`='icon'";
                     $query_run = mysqli_query($con, $query);
                     if ($query_run) {
                        $output = array('status' => 'System icon updated successfully', 'alert' => 'success');
                     } else {
                        $output = array('status' => 'System icon was not updated', 'alert' => 'error');
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
   // -------------------------------- Get Icon Picture -------------------------------- //
   if (isset($_POST["get_sysicon"])) {
      // Prepare and execute the SQL query
      $query = $con->prepare("SELECT * FROM system_setting WHERE meta = ?");
      $meta = 'icon'; // Set the value of the parameter
      $query->bind_param("s", $meta); // Use "s" for a string parameter
      $query->execute();
      $result = $query->get_result();
      if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
          $output = array('icon' => $row['meta_value']);
      }
      // Return user data as JSON
      header('Content-Type: application/json');
      echo json_encode($output);
  }
  // -------------------------------- Update System Logo -------------------------------- //
   if (isset($_POST["update_syslogo"])) {
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
      if (isset($_FILES['image2']) && is_uploaded_file($_FILES['image2']['tmp_name']) && $_FILES['image2']['error'] === UPLOAD_ERR_OK) {
         $fileImage = $_FILES['image2'];
         $OLDfileImage = $_POST['oldLOGOimage'];
         $customFileName = 'syslogo_' . date('Ymd_His'); // replace with your desired file name
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
                  $uploadDir = '../../assets/files/system/';
                  $targetFile = $uploadDir . $fileName;
                  if ($OLDfileImage != null ){
                     unlink($uploadDir . $OLDfileImage);
                  }
                  if ($fileSize > 1048576) { // more than 1 MB
                     // Compress the uploaded image with a quality of 25
                     $compressedImage = compressImage($fileTmpname, $targetFile, 25);
                  } else {
                     // Compress the uploaded image with a quality of 35
                     $compressedImage = compressImage($fileTmpname, $targetFile, 35);
                  }
                  if ($compressedImage) {
                     $query = "UPDATE `system_setting` SET `meta_value`='$fileName' WHERE `meta`='logo'";
                     $query_run = mysqli_query($con, $query);
                     if ($query_run) {
                        $output = array('status' => 'System logo updated successfully', 'alert' => 'success');
                     } else {
                        $output = array('status' => 'System logo was not updated', 'alert' => 'error');
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
  // -------------------------------- Get Logo Picture -------------------------------- //
  if (isset($_POST["get_syslogo"])) {
      // Prepare and execute the SQL query
      $query = $con->prepare("SELECT * FROM system_setting WHERE meta = ?");
      $meta = 'logo'; // Set the value of the parameter
      $query->bind_param("s", $meta); // Use "s" for a string parameter
      $query->execute();
      $result = $query->get_result();
      if ($result->num_rows > 0) {
         $row = $result->fetch_assoc();
         $output = array('logo' => $row['meta_value']);
      }
      // Return user data as JSON
      header('Content-Type: application/json');
      echo json_encode($output);
   }
   // -------------------------------- Export Users CSV -------------------------------- //
   if (isset($_POST["btn_export_users"])) {
      $sql = "SELECT * FROM `user` WHERE `user_type_id` != '3' AND `user_status_id` != '3'";
      $result = mysqli_query($con, $sql);

      // Set the filename and mime type
      $filename = "export_users_" . date('m-d-Y_H:i:s A') . ".csv";
      header('Content-Type: text/csv');
      header('Content-Disposition: attachment;filename="' . $filename . '"');
      header('Cache-Control: max-age=0');

      // Open file for writing
      $file = fopen('php://output', 'w');

      // Set the column headers
      fputcsv($file, array('ID', 'First Name', 'Middle Name', 'Last Name', 'Suffix', 'Gender', 'Birthday', 'Civil Status', 'Email', 'Phone', 'Role', 'Status'));

      // Add the data to the file
      while ($data = mysqli_fetch_assoc($result)){
          fputcsv($file, array(
              $data['user_id'],
              $data['fname'],
              $data['mname'],
              $data['lname'],
              $data['suffix'],
              $data['gender'],
              $data['birthday'],
              $data['civil_status'],
              $data['email'],
              $data['phone'],
              ($data['user_type_id'] == 1) ? 'Admin' : (($data['user_type_id'] == 2) ? 'Staff' : 'Unknown'),
              ($data['user_status_id'] == 1) ? 'Active' : (($data['user_status_id'] == 2) ? 'Inactive' : 'Archived')
          ));
      }        

      // Close file
      fclose($file);

      // Close MySQL connection
      mysqli_close($con);
   }
   // -------------------------------- Export Archive Users CSV -------------------------------- //
   if (isset($_POST["btn_export_users_archive"])) {
      $sql = "SELECT * FROM `user` WHERE `user_type_id` != '3' AND `user_status_id` = '3'";
      $result = mysqli_query($con, $sql);

      // Set the filename and mime type
      $filename = "export_archive_users_" . date('m-d-Y_H:i:s A') . ".csv";
      header('Content-Type: text/csv');
      header('Content-Disposition: attachment;filename="' . $filename . '"');
      header('Cache-Control: max-age=0');

      // Open file for writing
      $file = fopen('php://output', 'w');

      // Set the column headers
      fputcsv($file, array('ID', 'First Name', 'Middle Name', 'Last Name', 'Suffix', 'Gender', 'Birthday', 'Civil Status', 'Email', 'Phone', 'Role', 'Status'));

      // Add the data to the file
      while ($data = mysqli_fetch_assoc($result)){
          fputcsv($file, array(
              $data['user_id'],
              $data['fname'],
              $data['mname'],
              $data['lname'],
              $data['suffix'],
              $data['gender'],
              $data['birthday'],
              $data['civil_status'],
              $data['email'],
              $data['phone'],
              ($data['user_type_id'] == 1) ? 'Admin' : (($data['user_type_id'] == 2) ? 'Staff' : 'Unknown'),
              ($data['user_status_id'] == 1) ? 'Active' : (($data['user_status_id'] == 2) ? 'Inactive' : 'Archived')
          ));
      }        

      // Close file
      fclose($file);

      // Close MySQL connection
      mysqli_close($con);
   }
   // -------------------------------- Export Senior CSV -------------------------------- //
   if (isset($_POST["btn_export_senior"])) {
      $sql = "SELECT *, CASE WHEN deceased_date IS NOT NULL AND is_deceased = 'Yes' THEN DATE_FORMAT(deceased_date, '%m-%d-%Y') ELSE TIMESTAMPDIFF(YEAR, birthday, CURDATE()) END AS age FROM `user` WHERE `user_type_id` = '3' AND `user_status_id` != '3'";
      $result = mysqli_query($con, $sql);

      // Set the filename and mime type
      $filename = "export_seniors_" . date('m-d-Y_H:i:s A') . ".csv";
      header('Content-Type: text/csv');
      header('Content-Disposition: attachment;filename="' . $filename . '"');
      header('Cache-Control: max-age=0');

      // Open file for writing
      $file = fopen('php://output', 'w');

      // Set the column headers
      fputcsv($file, array('No.', 'ID Number', 'First Name', 'Middle Name', 'Last Name', 'Suffix', 'Gender', 'Birthday', 'Age', 'Marital Status', 'Date Issued', 'Soc-Pen', 'GSIS', 'SSS', 'PVAO', 'SUP-WITH', '4Ps', 'NHTS', 'ID-File', 'Purok', 'Barangay', 'RRN', 'Is Deceased', 'Deceased Date', 'Is Transfer', 'Transfer Date'));

      // Add the data to the file
      while ($data = mysqli_fetch_assoc($result)){
          fputcsv($file, array(
              $data['user_id'],
              $data['id_number'],
              $data['fname'],
              $data['mname'],
              $data['lname'],
              $data['suffix'],
              $data['gender'],
              $data['birthday'],
              $data['age'],
              $data['civil_status'],
              $data['date_issued'],
              $data['soc_pen'],
              $data['gsis'],
              $data['sss'],
              $data['pvao'],
              $data['sup_with'],
              $data['fourps'],
              $data['nhts'],
              $data['id_file'],
              $data['purok'],
              $data['barangay'],
              $data['rrn'],
              $data['is_deceased'],
              $data['deceased_date'],
              $data['is_transfer'],
              $data['transfer_date']
          ));
      }        

      // Close file
      fclose($file);

      // Close MySQL connection
      mysqli_close($con);
   }
   // -------------------------------- Export Archive Senior CSV -------------------------------- //
   if (isset($_POST["btn_export_senior_archive"])) {
      $sql = "SELECT *, CASE WHEN deceased_date IS NOT NULL AND is_deceased = 'Yes' THEN DATE_FORMAT(deceased_date, '%m-%d-%Y') ELSE TIMESTAMPDIFF(YEAR, birthday, CURDATE()) END AS age FROM `user` WHERE `user_type_id` = '3' AND `user_status_id` = '3'";
      $result = mysqli_query($con, $sql);

      // Set the filename and mime type
      $filename = "export_archive_seniors_" . date('m-d-Y_H:i:s A') . ".csv";
      header('Content-Type: text/csv');
      header('Content-Disposition: attachment;filename="' . $filename . '"');
      header('Cache-Control: max-age=0');

      // Open file for writing
      $file = fopen('php://output', 'w');

      // Set the column headers
      fputcsv($file, array('No.', 'ID Number', 'First Name', 'Middle Name', 'Last Name', 'Suffix', 'Gender', 'Birthday', 'Age', 'Marital Status', 'Date Issued', 'Soc-Pen', 'GSIS', 'SSS', 'PVAO', 'SUP-WITH', '4Ps', 'NHTS', 'ID-File', 'Purok', 'Barangay', 'RRN', 'Is Deceased', 'Deceased Date', 'Is Transfer', 'Transfer Date'));

      // Add the data to the file
      while ($data = mysqli_fetch_assoc($result)){
         fputcsv($file, array(
            $data['user_id'],
            $data['id_number'],
            $data['fname'],
            $data['mname'],
            $data['lname'],
            $data['suffix'],
            $data['gender'],
            $data['birthday'],
            $data['age'],
            $data['civil_status'],
            $data['date_issued'],
            $data['soc_pen'],
            $data['gsis'],
            $data['sss'],
            $data['pvao'],
            $data['sup_with'],
            $data['fourps'],
            $data['nhts'],
            $data['id_file'],
            $data['purok'],
            $data['barangay'],
            $data['rrn'],
            $data['is_deceased'],
            $data['deceased_date'],
            $data['is_transfer'],
            $data['transfer_date']
          ));
      }        

      // Close file
      fclose($file);

      // Close MySQL connection
      mysqli_close($con);
   }
   // -------------------------------- Check Email and Phone -------------------------------- //
   if (isset($_POST["check_email"])) {
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
   // -------------------------------- DataTable Announcements -------------------------------- //
   if (isset($_POST["ann_list"])){
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
         $searchQuery = " AND (ann_id LIKE :ann_id OR 
            ann_title LIKE :ann_title OR
            ann_description LIKE :ann_description OR
            ann_status LIKE :ann_status) ";
         $searchArray = array( 
            'ann_id'=>"%$searchValue%",
            'ann_title'=>"%$searchValue%",
            'ann_description'=>"%$searchValue%",
            'ann_status'=>"%$searchValue%"
         );
      }
      // Total number of records without filtering
      $stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM announcement");
      $stmt->execute();
      $records = $stmt->fetch();
      $totalRecords = $records['allcount'];
      // Total number of records with filtering
      $stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM announcement".$searchQuery);
      $stmt->execute($searchArray);
      $records = $stmt->fetch();
      $totalRecordwithFilter = $records['allcount'];
      // Fetch records
      $stmt = $conn->prepare("SELECT * FROM announcement".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");
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
            "ann_id"=>$row['ann_id'],
            "ann_title"=>$row['ann_title'],
            "ann_description"=>$row['ann_description'],
            "ann_status"=>$row['ann_status']
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
   // -------------------------------- Add Announcement -------------------------------- //
   if (isset($_POST["add_ann"])){
      // Validate and sanitize announcement inputs
      $title = mysqli_real_escape_string($con, $_POST['add_title']);
      $description = mysqli_real_escape_string($con, $_POST['add_description']);
      $status = mysqli_real_escape_string($con, $_POST['add_status']);
      $ann_date = date;
      $query = "INSERT INTO `announcement`(`ann_title`, `ann_description`, `ann_status`, `ann_date`) VALUES ('$title','$description','$status','$ann_date')";
      $query_run = mysqli_query($con, $query);
      if ($query_run){
         $output = array('status' => "Announcement added successfully", 'alert' => "success");
      } else{
         $output = array('status' => "Announcement was not added", 'alert' => "error");
      }
      echo json_encode($output);
   }
   // -------------------------------- Edit Announcement -------------------------------- //
   if (isset($_POST["edit_ann"])){
      // Validate and sanitize announcement inputs
      $id = mysqli_real_escape_string($con, $_POST['edit_ann_id']);
      $title = mysqli_real_escape_string($con, $_POST['edit_title']);
      $description = mysqli_real_escape_string($con, $_POST['edit_description']);
      $status = mysqli_real_escape_string($con, $_POST['edit_status']);
      $query = "UPDATE `announcement` SET `ann_title` = '$title', `ann_description` = '$description', `ann_status` = '$status' WHERE `ann_id` = '$id'";
      $query_run = mysqli_query($con, $query);
      if ($query_run){
         $output = array('status' => "Announcement updated successfully", 'alert' => "success");
      } else{
         $output = array('status' => "Announcement was not updated", 'alert' => "error");
      }
      echo json_encode($output);
   }
   // -------------------------------- Delete Announcement -------------------------------- //
   if (isset($_POST["delete_ann"])){
      // Validate and sanitize announcement inputs
      $id = mysqli_real_escape_string($con, $_POST['delete_ann_id']);
      $query = "DELETE FROM `announcement` WHERE `user_id` = '$id'";
      $query_run = mysqli_query($con, $query);
      if ($query_run){
         $output = array('status' => "Announcement deleted successfully", 'alert' => "success");
      } else{
         $output = array('status' => "Announcement was not deleted", 'alert' => "error");
      }
      echo json_encode($output);
   }
   // -------------------------------- DataTable Annual Dues -------------------------------- //
   if (isset($_POST["dues_list"])){
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
         $searchQuery = " AND (dues_id LIKE :dues_id OR 
            id_number LIKE :id_number OR
            CONCAT(fname, ' ', mname, ' ', lname, ' ', suffix) LIKE :fullname OR
            gender LIKE :gender OR
            barangay LIKE :barangay OR
            amount LIKE :amount OR
            `year` LIKE :`year` OR
            DATE_FORMAT(date_paid, '%m-%d-%Y') LIKE :new_date_paid OR) ";
         $searchArray = array( 
            'dues_id'=>"%$searchValue%",
            'id_number'=>"%$searchValue%",
            'fullname'=>"%$searchValue%",
            'gender'=>"%$searchValue%",
            'barangay'=>"%$searchValue%",
            'amount'=>"%$searchValue%",
            'year'=>"%$searchValue%",
            'new_date_paid'=>"%$searchValue%"
         );
      }
      // Total number of records without filtering
      $stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM annual_dues INNER JOIN user ON user.user_id = annual_dues.user_id WHERE user_type_id = '3'");
      $stmt->execute();
      $records = $stmt->fetch();
      $totalRecords = $records['allcount'];
      // Total number of records with filtering
      $stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM annual_dues INNER JOIN user ON user.user_id = annual_dues.user_id WHERE user_type_id = '3'".$searchQuery);
      $stmt->execute($searchArray);
      $records = $stmt->fetch();
      $totalRecordwithFilter = $records['allcount'];
      // Fetch records
      $stmt = $conn->prepare("SELECT *, CONCAT(fname, ' ', mname, ' ', lname, ' ', suffix) AS fullname, DATE_FORMAT(date_paid, '%m-%d-%Y') as new_date_paid FROM annual_dues INNER JOIN user ON user.user_id = annual_dues.user_id WHERE user_type_id = '3'".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");
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
            "user_id"=>$row["user_id"],
            "dues_id"=>$row['dues_id'],
            "id_number"=>$row['id_number'],
            "fullname"=>$row['fullname'],
            "gender"=>$row['gender'],
            "barangay"=>$row['barangay'],
            "amount"=>$row['amount'],
            "year"=>$row['year'],
            "date_paid"=>$row['date_paid'],
            "new_date_paid"=>$row['new_date_paid'],
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
   // -------------------------------- Add Payment -------------------------------- //
   if (isset($_POST["add_dues"])){
      // Validate and sanitize announcement inputs
      $userid = mysqli_real_escape_string($con, $_POST['add_senior']);
      $amount = mysqli_real_escape_string($con, $_POST['add_amount']);
      $year = mysqli_real_escape_string($con, $_POST['add_year']);
      $date_paid = mysqli_real_escape_string($con, $_POST['add_paid']);
      $query = "INSERT INTO `annual_dues`(`user_id`, `amount`, `year`, `date_paid`) VALUES ('$userid','$amount','$year','$date_paid')";
      $query_run = mysqli_query($con, $query);
      if ($query_run){
         $output = array('status' => "Payment added successfully", 'alert' => "success");
      } else{
         $output = array('status' => "Payment was not added", 'alert' => "error");
      }
      echo json_encode($output);
   }
   // -------------------------------- Edit Payment -------------------------------- //
   if (isset($_POST["edit_dues"])){
      // Validate and sanitize announcement inputs
      $id = mysqli_real_escape_string($con, $_POST['edit_dues_id']);
      $userid = mysqli_real_escape_string($con, $_POST['edit_senior']);
      $amount = mysqli_real_escape_string($con, $_POST['edit_amount']);
      $year = mysqli_real_escape_string($con, $_POST['edit_year']);
      $date_paid = mysqli_real_escape_string($con, $_POST['edit_paid']);
      $query = "UPDATE `annual_dues` SET `user_id` = '$userid', `amount` = '$amount', `year` = '$year', `date_paid` = '$date_paid' WHERE `dues_id` = '$id'";
      $query_run = mysqli_query($con, $query);
      if ($query_run){
         $output = array('status' => "Payment updated successfully", 'alert' => "success");
      } else{
         $output = array('status' => "Payment was not updated", 'alert' => "error");
      }
      echo json_encode($output);
   }
   // -------------------------------- Delete Payment -------------------------------- //
   if (isset($_POST["delete_dues"])){
      // Validate and sanitize announcement inputs
      $id = mysqli_real_escape_string($con, $_POST['delete_dues_id']);
      $query = "DELETE FROM `annual_dues` WHERE `dues_id` = '$id'";
      $query_run = mysqli_query($con, $query);
      if ($query_run){
         $output = array('status' => "Payment deleted successfully", 'alert' => "success");
      } else{
         $output = array('status' => "Payment was not deleted", 'alert' => "error");
      }
      echo json_encode($output);
   }
?>