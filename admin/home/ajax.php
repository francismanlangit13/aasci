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
            gender LIKE :gender OR
            DATE_FORMAT(birthday, '%m-%d-%Y') LIKE :newbirthday OR
            TIMESTAMPDIFF(YEAR, birthday, CURDATE()) = :age OR
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
            user_status_id LIKE :user_status_id) ";
         $searchArray = array( 
            'user_id' => "%$searchValue%",
            'fullname' => "%$searchValue%",
            'gender' => "%$searchValue%",
            'newbirthday' => "%$searchValue%",
            'age' => $searchValue, // Search for the exact age value
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
      $stmt = $conn->prepare("SELECT *, CONCAT(fname, ' ', mname, ' ', lname, ' ', suffix) AS fullname, DATE_FORMAT(birthday, '%m-%d-%Y') as newbirthday, DATE_FORMAT(date_issued, '%m-%d-%Y') as newdateissued, TIMESTAMPDIFF(YEAR, birthday, CURDATE()) AS age FROM user WHERE user_status_id != 3 AND user_type_id = 3" .$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");
      
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
              "gender" => $row['gender'],
              "birthday" => $row['birthday'],
              "newbirthday" => $row['newbirthday'],
              "age" => $row['age'],
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
              "transfer" => $row['is_transfer'],
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
      $gender = mysqli_real_escape_string($con, $_POST['add_gender']);
      $birthday = mysqli_real_escape_string($con, $_POST['add_birthday']);
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
      $is_decease = 'No';
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
                     $query = "INSERT INTO `user`(`fname`, `mname`, `lname`, `suffix`, `gender`, `birthday`, `profile`, `psa`, `date_issued`, `soc_pen`, `gsis`, `sss`, `pvao`, `sup_with`, `fourps`, `nhts`, `id_file`, `barangay`, `rrn`, `user_type_id`, `user_status_id`, `is_decease`, `is_transfer`) VALUES ('$fname','$mname','$lname','$suffix','$gender','$birthday','$fileName','$fileName1','$date_issued','$soc_pen','$gsis','$sss','$pvao','$sup_with','$fourps','$nhts','$id_file','$barangay','$rrn','$user_type','$user_status')";
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
      $gender = mysqli_real_escape_string($con, $_POST['edit_gender']);
      $birthday = mysqli_real_escape_string($con, $_POST['edit_birthday']);
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
      $is_transfer = mysqli_real_escape_string($con, $_POST['edit_transfer']);
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
      $query = "UPDATE `user` SET `fname` = '$fname', `mname` = '$mname', `lname` = '$lname', `suffix` = '$suffix', `gender` = '$gender', `birthday` = '$birthday', `date_issued` = '$date_issued', `soc_pen` = '$soc_pen', `gsis` = '$gsis', `sss` = '$sss', `pvao` = '$pvao', `sup_with` = '$sup_with', `fourps` = '$fourps', `nhts` = '$nhts', `id_file` = '$id_file', `barangay` = '$barangay', `rrn` = '$rrn', `user_status_id` = '$user_status', `is_deceased` = '$is_deceased', `is_transfer` = '$is_transfer' WHERE `user_id` = '$id'";
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
?>