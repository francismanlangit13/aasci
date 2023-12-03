<?php
    if (!defined('DB_SERVER')) {
        include("../includes/authentication.php");
    }
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        // Query the database
        $query = "SELECT *, CASE WHEN deceased_date IS NOT NULL AND is_deceased = 'Yes' THEN DATE_FORMAT(deceased_date, '%m-%d-%Y') ELSE TIMESTAMPDIFF(YEAR, birthday, CURDATE()) END AS age FROM `user` INNER JOIN `user_status` ON `user`.`user_status_id` = `user_status`.`user_status_id` WHERE `user_id`='$id'";
        $result = $con->query($query);
        if ($result === false) {
            die("Query failed: " . $con->error);
        }
        // Fetch the data
        $row = $result->fetch_assoc();
        $link = base_url . 'view-senior?referrer_sig=AQAAALlBtMUw4ijnuwuB1_ELMGm0j_LDQFR7JkepuUdtEUZlkWR_E8B1hpz84xnQcU2MWhGqYgqw1M2fKXNWP3tcP42AxniLgydvkoy2WHzQOrWSrT6wxtCsmk3ClX7csfHjkNFfHrR3BY5Q1evqYO43BcH51CGey1yhnFoukIyF7OPU&id=';
        $username = $link . $row["user_id"];
        // Close the MySQL connection
        $con->close();
        // Include the QR code library
        require('../../assets/vendor/phpqrcode/qrlib.php');
        $saveTo = '../../assets/files/system/qr-code.png';
        $fileName = '../../assets/files/system/qr-code.png';
        $size = 10; // Increase the size of the QR code
        QRcode::png($username, $saveTo, QR_ECLEVEL_L, $size);
        $response = "  
            <div class='row'>
                <div class='col-md-3 mb-3'>
                    <label for='view_fname'>First Name</label>
                    <input disabled type='text' class='form-control' id='view_fname' value='". $row['fname'] ."'>
                </div> 

                <div class='col-md-3 mb-3'>
                    <label for='view_mname'>Middle Name</label>
                    <input disabled type='text' class='form-control' id='view_mname' value='". $row['mname'] ."'>
                </div>

                <div class='col-md-3 mb-3'>
                    <label for='view_lname'>Last Name</label>
                    <input disabled type='text' class='form-control' id='view_lname' value='". $row['lname'] ."'>
                </div>

                <div class='col-md-3 mb-3'>
                    <label for='view_suffix'>Suffix</label>
                    <input disabled type='text' class='form-control' id='view_suffix' value='". $row['suffix'] ."'>
                </div>

                <div class='col-md-4 mb-3'>
                    <label for='view_id_number'>ID Number</label>
                    <input disabled type='text' class='form-control' id='view_id_number' value='". $row['id_number'] ."'>
                </div>

                <div class='col-md-4 mb-3'>
                    <label for='view_gender'>Gender</label>
                    <input disabled type='text' class='form-control' id='view_gender' value='". $row['gender'] ."'>
                </div>

                <div class='col-md-4 mb-3'>
                    <label for='view_birthday'>Birthday</label>
                    <input disabled type='text' class='form-control' id='view_birthday' value='". $row['birthday'] ."'>
                </div>

                <div class='col-md-4 mb-3'>
                    <label for='view_age'>Age</label>
                    <input disabled type='text' class='form-control' id='view_age' value='". $row['age'] ."'>
                </div>

                <div class='col-md-4 mb-3'>
                    <label for='view_barangay'>Barangay</label>
                    <input disabled type='text' class='form-control' id='view_barangay' value='". $row['barangay'] ."'>
                </div>

                <div class='col-md-4 mb-3'>
                    <label for='view_date_issued'>Date Issued</label>
                    <input disabled type='text' class='form-control' id='view_date_issued' value='". $row['date_issued'] ."'>
                </div>

                <div class='col-md-4 mb-3'>
                    <label for='view_rrn'>RRN</label>
                    <input disabled type='text' class='form-control' id='view_rrn' value='". $row['rrn'] ."'>
                </div>

                <div class='col-md-4 mb-3'>
                    <label for='view_soc_pen'>Soc Pen</label>
                    <input disabled type='text' class='form-control' id='view_soc_pen' value='". $row['soc_pen'] ."'>
                </div>

                <div class='col-md-4 mb-3'>
                    <label for='view_gsis'>GSIS</label>
                    <input disabled type='text' class='form-control' id='view_gsis' value='". $row['gsis'] ."'>
                </div>

                <div class='col-md-4 mb-3'>
                    <label for='view_sss'>SSS</label>
                    <input disabled type='text' class='form-control' id='view_sss' value='". $row['sss'] ."'>
                </div>

                <div class='col-md-4 mb-3'>
                    <label for='view_pvao'>PVAO</label>
                    <input disabled type='text' class='form-control' id='view_pvao' value='". $row['pvao'] ."'>
                </div>

                <div class='col-md-4 mb-3'>
                    <label for='view_sup_with'>SUP WITH</label>
                    <input disabled type='text' class='form-control' id='view_sup_with' value='". $row['sup_with'] ."'>
                </div>

                <div class='col-md-4 mb-3'>
                    <label for='view_4ps'>4Ps</label>
                    <input disabled type='text' class='form-control' id='view_4ps' value='". $row['fourps'] ."'>
                </div>

                <div class='col-md-4 mb-3'>
                    <label for='view_nhts'>NHTS</label>
                    <input disabled type='text' class='form-control' id='view_nhts' value='". $row['nhts'] ."'>
                </div>

                <div class='col-md-4 mb-3'>
                    <label for='view_id_file'>ID File</label>
                    <input disabled type='text' class='form-control' id='view_id_file' value='". $row['id_file'] ."'>
                </div>

                <div class='col-md-4 mb-3'>
                    <label for='view_status'>Status</label>
                    <input disabled type='text' class='form-control' id='view_status' value='". $row['user_status_name'] ."'>
                </div>

                <div class='col-md-4 mb-3'>
                    <label for='view_deceased'>Deceased</label>
                    <input disabled type='text' class='form-control' id='view_deceased' value='". $row['is_deceased'] ."'>
                </div>

                <div class='col-md-4 mb-3'>
                    <label for='view_transfer'>Transfer</label>
                    <input disabled type='text' class='form-control' id='view_transfer' value='". $row['is_transfer'] ."'>
                </div>

                
            </div>
        ";
        echo $response;
    }
?>