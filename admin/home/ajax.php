<?php
   // -------------------------------- Authentication -------------------------------- //
   if (!defined('DB_SERVER')) {
      include ('../includes/authentication.php');
      $user_id = $_SESSION['auth_user']['user_id'];
      // DB connection parameters
      $host = DB_SERVER;
      $user = DB_USERNAME;
      $password = DB_PASSWORD;
      $db = DB_NAME;

      $dsn = "mysql:host=$host;dbname=$db;charset=UTF8";
      try {
            $conn = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
      } catch (PDOException $e) {
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
            fname LIKE :fname OR
            mname LIKE :mname OR 
            lname LIKE :lname OR
            gender LIKE :gender OR
            DATE_FORMAT(birthday, '%m-%d-%Y') LIKE :newbirthday OR
            civil_status LIKE :civil_status OR
            email LIKE :email OR
            phone LIKE :phone OR
            user_type_id LIKE :user_type_id OR
            user_status_id LIKE :user_status_id) ";
         $searchArray = array( 
            'user_id'=>"%$searchValue%",
            'fname'=>"%$searchValue%",
            'mname'=>"%$searchValue%",
            'lname'=>"%$searchValue%",
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
      $stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM user ");
      $stmt->execute();
      $records = $stmt->fetch();
      $totalRecords = $records['allcount'];

      // Total number of records with filtering
      $stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM user WHERE 1 ".$searchQuery);
      $stmt->execute($searchArray);
      $records = $stmt->fetch();
      $totalRecordwithFilter = $records['allcount'];

      // Fetch records
      $stmt = $conn->prepare("SELECT *, DATE_FORMAT(birthday, '%m-%d-%Y') as newbirthday FROM user WHERE 1 ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");

      // Bind values
      foreach ($searchArray as $key=>$search) {
         $stmt->bindValue(':'.$key, $search,PDO::PARAM_STR);
      }

      $stmt->bindValue(':limit', (int)$row, PDO::PARAM_INT);
      $stmt->bindValue(':offset', (int)$rowperpage, PDO::PARAM_INT);
      $stmt->execute();
      $empRecords = $stmt->fetchAll();

      $data = array();

      foreach ($empRecords as $row) {
         $data[] = array(
            "user_id"=>$row['user_id'],
            "fname"=>$row['fname'] . ' '. $row['mname']. $row['lname'],
            "gender"=>$row['gender'],
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
   if (isset($_POST["add_user"])) {
      // Include your database connection code here (e.g., $con)
      
      // Validate and sanitize user inputs
      $fname = mysqli_real_escape_string($con, $_POST['fname']);
      $mname = mysqli_real_escape_string($con, $_POST['mname']);
      $lname = mysqli_real_escape_string($con, $_POST['lname']);
      $gender = mysqli_real_escape_string($con, $_POST['gender']);
      $birthday = mysqli_real_escape_string($con, $_POST['birthday']);
      $civilstatus = mysqli_real_escape_string($con, $_POST['civilstatus']);
      $email = mysqli_real_escape_string($con, $_POST['email']);
      $phone = mysqli_real_escape_string($con, $_POST['phone']);
      $user_type = mysqli_real_escape_string($con, $_POST['role']);
      
      // Generate a random password
      $new_password = substr(md5(microtime()), rand(0, 26), 8);
      $password = md5($new_password);
      $user_status = '1';
      
      $query = "INSERT INTO `user`(`fname`, `mname`, `lname`, `gender`, `birthday`, `civil_status`, `email`, `phone`, `password`, `user_type_id`, `user_status_id`) VALUES ('$fname','$mname','$lname','$gender','$birthday','$civilstatus','$email','$phone','$password','$user_type','$user_status')";
      
      $query_run = mysqli_query($con, $query);
      
      if ($query_run) {
         $output = array('status' => "User added successfully", 'alert' => "success");
      } else {
         $output = array('status' => "User was not added", 'alert' => "error");
      }
      
      echo json_encode($output);
   }
   // -------------------------------- Edit User -------------------------------- //
   if (isset($_POST["edit_user"])) {
      // Include your database connection code here (e.g., $con)
      
      // Validate and sanitize user inputs
      $fname = mysqli_real_escape_string($con, $_POST['fname']);
      $mname = mysqli_real_escape_string($con, $_POST['mname']);
      $lname = mysqli_real_escape_string($con, $_POST['lname']);
      $gender = mysqli_real_escape_string($con, $_POST['gender']);
      $birthday = mysqli_real_escape_string($con, $_POST['birthday']);
      $civilstatus = mysqli_real_escape_string($con, $_POST['civilstatus']);
      $email = mysqli_real_escape_string($con, $_POST['email']);
      $phone = mysqli_real_escape_string($con, $_POST['phone']);
      $user_type = mysqli_real_escape_string($con, $_POST['role']);
      $user_status = mysqli_real_escape_string($con, $_POST['status']);
      
      $query = "UPDATE `user` SET `fname` = $fname, `mname` = $mname, `lname` = $lname, `gender` = $gender, `birthday` = $birthday, `civil_status` = $civilstatus, `email` = $email, `phone` = $phone, `user_type_id` = $user_type, `user_status_id` = $user_status";
      
      $query_run = mysqli_query($con, $query);
      
      if ($query_run) {
         $output = array('status' => "User added successfully", 'alert' => "success");
      } else {
         $output = array('status' => "User was not added", 'alert' => "error");
      }
      
      echo json_encode($output);
   }
?>