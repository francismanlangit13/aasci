<?php
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
           birthday LIKE :birthday OR
           civil_status LIKE :civil_status OR
           email LIKE :email OR
           phone LIKE :phone OR
           user_type_id LIKE :user_type_id OR
           user_status_id LIKE :user_status_id OR) ";
      $searchArray = array( 
           'user_id'=>"%$searchValue%",
           'fname'=>"%$searchValue%",
           'mname'=>"%$searchValue%",
           'lname'=>"%$searchValue%",
           'gender'=>"%$searchValue%",
           'birthday'=>"%$searchValue%",
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
   $stmt = $conn->prepare("SELECT * FROM user WHERE 1 ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");

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
         "birthday"=>$row['birthday'],
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