<?php
    if(!defined('DB_SERVER')){
        include("initialize.php");
    }
?>
<?php
    // DB connection parameters
    $host = DB_SERVER;
    $username = DB_USERNAME;
    $password = DB_PASSWORD;
    $database = DB_NAME;

    $con = new mysqli($host, $username, $password, $database);

    if($con->connect_error){
        // connection failed, redirect to 
        header("Location: " . base_url . "error");
        die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
    }
    else{
        // connection successful
        $c_qry = $con->query("SELECT * FROM system_setting");
        while($row = $c_qry->fetch_assoc()){
            $system[$row['meta']] = $row['meta_value'];
            $system_switch[$row['meta']] = $row['meta_switch'];
        }
    }
?>