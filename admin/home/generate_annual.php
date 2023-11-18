<?php include ('../includes/header.php'); ?>
<head>
    <!-- Website Title -->
    <title><?= $system['shortname'] ?> | Annual Reports</title>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <style>
        @media print{
            body{
                margin-top: -30px;
            }
            .bg-success-print {
                background-color: #28a745 !important; /* Green color for success */
                color: #fff !important; /* White text for better visibility on dark background */
            }
            .noprint{
                display: none;
            }
            .print-adjust {
                margin-top:-50px;
            }
            .print-table-adjust{
                zoom: 50%;
            }
            .noprint-scroll{
            overflow-x: unset !important;
            }
            @page {
                size: auto;
                margin: 0mm;
            }
        }
        #sys_logo{
            object-fit:cover;
            object-position:center center;
            width: 6.5em;
            height: 6.5em;
        }
    </style>
</head>
<main>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-5">
        <nav class="rounded bg-gray-200 mb-4 noprint" aria-label="breadcrumb">
            <ol class="breadcrumb px-3 py-2 rounded mb-0">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="../home">Home</a></li>
                <li class="breadcrumb-item active">Annual Reports</li>
            </ol>
        </nav>
        <div class="card mb-4 noprint">
            <div class="card border-left-primary border-equal-primary shadow">
                <div class="card-body">
                    <fieldset>
                        <legend>Filter</legend>
                        <form action="" id="filter" method="POST" style="font-size:14px">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="Barangay" class="optional">Barangay</label>
                                    <select class="form-control" name="Barangay" id="Barangay">
                                    <option value="" selected>Select Barangay</option>
                                        <option value="Balintonga">Balintonga</option>
                                        <option value="Banisilon">Banisilon</option>
                                        <option value="Burgos">Burgos</option>
                                        <option value="Calube">Calube</option>
                                        <option value="Caputol">Caputol</option>
                                        <option value="Casusan">Casusan</option>
                                        <option value="Conat">Conat</option>
                                        <option value="Culpan">Culpan</option>
                                        <option value="Dalisay">Dalisay</option>
                                        <option value="Dullan">Dullan</option>
                                        <option value="Ibabao">Ibabao</option>
                                        <option value="Labo">Labo</option>
                                        <option value="Lawa-an">Lawa-an</option>
                                        <option value="Lobogon">Lobogon</option>
                                        <option value="Lumbayao">Lumbayao</option>
                                        <option value="Macubon">Macubon</option>
                                        <option value="Makawa">Makawa</option>
                                        <option value="Manamong">Manamong</option>
                                        <option value="Matipaz">Matipaz</option>
                                        <option value="Maular">Maular</option>
                                        <option value="Mitazan">Mitazan</option>
                                        <option value="Mohon">Mohon</option>
                                        <option value="Monterico">Monterico</option>
                                        <option value="Nabuna">Nabuna</option>
                                        <option value="Ospital">Ospital</option>
                                        <option value="Palayan">Palayan</option>
                                        <option value="Pelong">Pelong</option>
                                        <option value="Roxas">Roxas</option>
                                        <option value="San Pedro">San Pedro</option>
                                        <option value="Santa Ana">Santa Ana</option>
                                        <option value="Sinampongan">Sinampongan</option>
                                        <option value="Taguanao">Taguanao</option>
                                        <option value="Tawi-tawi">Tawi-tawi</option>
                                        <option value="Toril">Toril</option>
                                        <option value="Tubod">Tubod</option>
                                        <option value="Tuburan">Tuburan</option>
                                        <option value="Tugaya">Tugaya</option>
                                        <option value="Zamora">Zamora</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class='col-md-2'>
                                    <input class="form-check-input" type="checkbox" value="ID" id="ID" name="ID">
                                    <label class="form-check-label" for="ID">ID Number</label>
                                </div>
                                <div class='col-md-2'>
                                    <input class="form-check-input" type="checkbox" value="Gender" id="Gender" name="Gender">
                                    <label class="form-check-label" for="Gender">Gender</label>
                                </div>
                                <div class='col-md-2'>
                                    <input class="form-check-input" type="checkbox" value="Birthday" id="Birthday" name="Birthday">
                                    <label class="form-check-label" for="Birthday">Birthday</label>
                                </div>
                                <div class='col-md-2'>
                                    <input class="form-check-input" type="checkbox" value="Age" id="Age" name="Age">
                                    <label class="form-check-label" for="Age">Age</label>
                                </div>
                                <div class='col-md-2'>
                                    <input class="form-check-input" type="checkbox" value="2018" id="2018" name="2018">
                                    <label class="form-check-label" for="2018">2018</label>
                                </div>
                                <div class='col-md-2'>
                                    <input class="form-check-input" type="checkbox" value="2019" id="2019" name="2019">
                                    <label class="form-check-label" for="2019">2019</label>
                                </div>
                                <div class='col-md-2'>
                                    <input class="form-check-input" type="checkbox" value="2020" id="2020" name="2020">
                                    <label class="form-check-label" for="2020">2020</label>
                                </div>
                                <div class='col-md-2'>
                                    <input class="form-check-input" type="checkbox" value="2021" id="2021" name="2021">
                                    <label class="form-check-label" for="2021">2021</label>
                                </div>
                                <div class='col-md-2'>
                                    <input class="form-check-input" type="checkbox" value="2022" id="2022" name="2022">
                                    <label class="form-check-label" for="2022">2022</label>
                                </div>
                                <div class='col-md-2'>
                                    <input class="form-check-input" type="checkbox" value="2023" id="2023" name="2023">
                                    <label class="form-check-label" for="2023">2023</label>
                                </div>
                            </div>
                            <div class="form-group col-md-6 mt-2">
                                <button class="btn btn-primary btn-flat btn-sm" name="submit-btn" id="submit-btn"><i class="fa fa-filter"></i> Filter</button>
                                <button class="btn btn-sm btn-flat btn-secondary" type="button" onclick="window.print()" <?php if(isset($_POST['submit-btn'])) { } else { echo "disabled";} ?>><i class="fa fa-print"></i> Print</button>
                                <button class="btn btn-sm btn-flat btn-success" type="button" id="export-btn-csv" <?php if(isset($_POST['submit-btn'])) { } else { echo "disabled";} ?>><i class="fas fa-file-csv"></i> CSV</button>
                            </div>
                        </form>
                    </fieldset>
                </div>
            </div>
        </div>
        <?php if(isset($_POST['submit-btn'])){ ?>
            <div class="row">
                <div class="col-2 d-flex justify-content-center align-items-center">
                    <img src="<?php echo base_url ?>assets/files/system/<?= $system['icon'] ?>" class="img-circle print-adjust" id="sys_logo" alt="System Logo">
                </div>
                <div class="col-8">
                    <h4 class="text-center"><b><?= $system['name'] ?></b></h4>
                    <?php if(!empty($_POST['Barangay'])) { ?>
                        <h3 class="text-center"><b>List of Farmer in Barangay (<?php if(isset($_POST['Barangay'])) { echo $barangay = $_POST['Barangay']; } else { echo "Undefined";} ?>)</b></h3>
                    <?php } else { } ?>
                    <br><br>
                </div>
                <div class="col-2"></div>
            </div>
            <?php
                error_reporting(E_ERROR | E_PARSE);
                if(!empty($_POST['Barangay'])) {
                    $barangay = mysqli_real_escape_string($con, $barangay); // Escape the variable to prevent SQL injection

                    $query = "
                        SET @sql = NULL;
                        SELECT GROUP_CONCAT(DISTINCT 'MAX(CASE WHEN year = \"', year, '\" THEN amount END) AS `', year, '`') INTO @columns
                        FROM annual_dues;
                        SET @sql = CONCAT('SELECT user.*, CASE WHEN deceased_date IS NOT NULL THEN TIMESTAMPDIFF(YEAR, birthday, deceased_date) ELSE TIMESTAMPDIFF(YEAR, birthday, CURDATE()) END AS age, ', @columns, '
                            FROM 
                                user
                            INNER JOIN 
                                annual_dues ON annual_dues.user_id = user.user_id 
                            WHERE 
                                user.barangay = ''$barangay'' 
                            GROUP BY 
                                user.id_number');
                        PREPARE stmt FROM @sql;
                        EXECUTE stmt;
                        DEALLOCATE PREPARE stmt;
                    ";
                    // Execute the SQL query
                    $con->multi_query($query);
                    // Move to the fifth result set (assuming four additional queries before)
                    for ($i = 0; $i < 4; $i++) {
                        $con->next_result();
                    }
                    // Fetch the result of the fifth query
                    $result = $con->store_result();
                } else{
                    $query = "
                        SET @sql = NULL;
                        SELECT GROUP_CONCAT(DISTINCT 'MAX(CASE WHEN year = \"', year, '\" THEN amount END) AS `', year, '`') INTO @columns
                        FROM annual_dues;
                        SET @sql = CONCAT('SELECT user.*, CASE WHEN deceased_date IS NOT NULL THEN TIMESTAMPDIFF(YEAR, birthday, deceased_date) ELSE TIMESTAMPDIFF(YEAR, birthday, CURDATE()) END AS age, ', @columns, ' FROM user
                        INNER JOIN annual_dues ON annual_dues.user_id = user.user_id
                        GROUP BY user.id_number');
                        PREPARE stmt FROM @sql;
                        EXECUTE stmt;
                        DEALLOCATE PREPARE stmt;
                    ";

                    // Execute the SQL query
                    $con->multi_query($query);

                    // Move to the fifth result set (assuming four additional queries before)
                    for ($i = 0; $i < 4; $i++) {
                        $con->next_result();
                    }

                    // Fetch the result of the fifth query
                    $result = $con->store_result();
                }
            ?>
            <div class="col-md-12 print-table-adjust" style="overflow-x: auto;">
                <table class="table text-center table-hover table-striped">
                    <thead>
                        <tr class="bg-success text-light bg-success-print">
                            <th>No.</th>
                            <th>Full Name</th>
                            <th>Barangay</th>
                            <?php if(isset($_POST['ID'])) { ?>
                                <th>ID Number</th>
                            <?php } ?>
                            <?php if(isset($_POST['Gender'])) { ?>
                                <th>Gender</th>
                            <?php } ?>
                            <?php if(isset($_POST['Birthday'])) { ?>
                                <th>Birthday</th>
                            <?php } ?>
                            <?php if(isset($_POST['Age'])) { ?>
                                <th>Age</th>
                            <?php } ?>
                            <?php if(isset($_POST['2018'])) { ?>
                                <th>2018</th>
                            <?php } ?>
                            <?php if(isset($_POST['2019'])) { ?>
                                <th>2019</th>
                            <?php } ?>
                            <?php if(isset($_POST['2020'])) { ?>
                                <th>2020</th>
                            <?php } ?>
                            <?php if(isset($_POST['2021'])) { ?>
                                <th>2021</th>
                            <?php } ?>
                            <?php if(isset($_POST['2022'])) { ?>
                                <th>2022</th>
                            <?php } ?>
                            <?php if(isset($_POST['2023'])) { ?>
                                <th>2023</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php		
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<tr>';
                                    echo '<td class="text-center">' . $row['user_id'] . '</td>';
                                    echo '<td class=""><p class="m-0">' . $row['fname'] . ' ' . $row['mname'] . ' ' . $row['lname'] . ' ' . $row['suffix'] . '</p></td>';
                                    if(isset($_POST['Barangay'])) { 
                                        echo '<td class=""><p class="m-0">' . $row['barangay'] . '</p></td>';
                                    }
                                    if(isset($_POST['ID'])) { 
                                        echo '<td class=""><p class="m-0">' . $row['id_number'] . '</p></td>';
                                    }
                                    if(isset($_POST['Gender'])) { 
                                        echo '<td class=""><p class="m-0">' . $row['gender'] . '</p></td>';
                                    }
                                    if(isset($_POST['Birthday'])) { 
                                        echo '<td class=""><p class="m-0">' . $row['birthday'] . '</p></td>';
                                    }
                                    if(isset($_POST['Age'])) { 
                                        echo '<td class=""><p class="m-0">' . $row['age'] . '</p></td>';
                                    }
                                    if(isset($_POST['2018'])) { 
                                        echo '<td class=""><p class="m-0">' . (isset($row['2018']) ? $row['2018'] : "") . '</p></td>';
                                    }
                                    if(isset($_POST['2019'])) { 
                                        echo '<td class=""><p class="m-0">' . (isset($row['2019']) ? $row['2019'] : "") . '</p></td>';
                                    }
                                    if(isset($_POST['2020'])) { 
                                        echo '<td class=""><p class="m-0">' . (isset($row['2020']) ? $row['2020'] : "") . '</p></td>';
                                    }
                                    if(isset($_POST['2021'])) { 
                                        echo '<td class=""><p class="m-0">' . (isset($row['2021']) ? $row['2021'] : "") . '</p></td>';
                                    }
                                    if(isset($_POST['2022'])) { 
                                        echo '<td class=""><p class="m-0">' . (isset($row['2022']) ? $row['2022'] : "") . '</p></td>';
                                    }
                                    if(isset($_POST['2023'])) { 
                                        echo '<td class=""><p class="m-0">' . (isset($row['2023']) ? $row['2023'] : "") . '</p></td>';
                                    }
                                    echo '</tr>';
                                }
                            } else {
                                echo '<tr>';
                                echo '<th class="py-1 text-center" colspan="12">No Data.</th>';
                                echo '</tr>';
                            }
                            // Close the statement
                            $con->close();
                        ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>
    </div>
</main>

<script>
	function printDiv() {
		var divToPrint = document.getElementById('outprint');
		var newWin = window.open('', 'Print-Window');
		newWin.document.open();
		newWin.document.write('<html><head><title>Print Content</title></head><body>' + divToPrint.innerHTML + '</body></html>');
		newWin.document.close();
		newWin.focus();
		setTimeout(function(){newWin.print();},1000);
	}
</script>

<script>
	// Function to export table as CSV/Excel
    function exportTableToCSV(filename) {
        var csv = [];
        var rows = document.querySelectorAll("table tr");

        for (var i = 0; i < rows.length; i++) {
            var row = [], cols = rows[i].querySelectorAll("td, th");

            for (var j = 0; j < cols.length; j++) {
                row.push(cols[j].innerText);
            }

            csv.push(row.join(","));
        }

        // Download CSV file
        downloadCSV(csv.join("\n"), filename);
    }

    function downloadCSV(csv, filename) {
        var csvFile;
        var downloadLink;

        csvFile = new Blob([csv], {type: "text/csv"});
        downloadLink = document.createElement("a");
        downloadLink.download = filename;
        downloadLink.href = window.URL.createObjectURL(csvFile);
        downloadLink.style.display = "none";
        document.body.appendChild(downloadLink);
        downloadLink.click();
    }

    // Export table when clicking on a button
    var exportBtn = document.querySelector("#export-btn-csv");
    exportBtn.addEventListener("click", function () {
        var date = '<?php echo date('m-d-Y_H:i:s A'); ?>';
        var filename = "export_senior-" + date + ".csv";
        exportTableToCSV(filename);
    });
</script>

<?php include ('../includes/footer.php'); ?>