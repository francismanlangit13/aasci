<?php include ('../includes/header.php'); ?>
<head>
    <!-- Website Title -->
    <title><?= $system['shortname'] ?> | Reports</title>
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
                <li class="breadcrumb-item active">Reports</li>
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
                                    <input class="form-check-input" type="checkbox" value="Civil_Status" id="Civil_Status" name="Civil_Status">
                                    <label class="form-check-label" for="Civil_Status">Marital Status</label>
                                </div>
                                <div class='col-md-2'>
                                    <input class="form-check-input" type="checkbox" value="Purok" id="Purok" name="Purok">
                                    <label class="form-check-label" for="Purok">Purok</label>
                                </div>
                                <div class='col-md-2'>
                                    <input class="form-check-input" type="checkbox" value="Date_Issued" id="Date_Issued" name="Date_Issued">
                                    <label class="form-check-label" for="Date_Issued">Date Issued</label>
                                </div>
                                <div class='col-md-2'>
                                    <input class="form-check-input" type="checkbox" value="Soc_Pen" id="Soc_Pen" name="Soc_Pen">
                                    <label class="form-check-label" for="Soc_Pen">Soc-Pen</label>
                                </div>
                                <div class='col-md-2'>
                                    <input class="form-check-input" type="checkbox" value="GSIS" id="GSIS" name="GSIS">
                                    <label class="form-check-label" for="GSIS">GSIS</label>
                                </div>
                                <div class='col-md-2'>
                                    <input class="form-check-input" type="checkbox" value="SSS" id="SSS" name="SSS">
                                    <label class="form-check-label" for="SSS">SSS</label>
                                </div>
                                <div class='col-md-2'>
                                    <input class="form-check-input" type="checkbox" value="PVAO" id="PVAO" name="PVAO">
                                    <label class="form-check-label" for="PVAO">PVAO</label>
                                </div>
                                <div class='col-md-2'>
                                    <input class="form-check-input" type="checkbox" value="SUP_WITH" id="SUP_WITH" name="SUP_WITH">
                                    <label class="form-check-label" for="SUP_WITH">SUP-WITH</label>
                                </div>
                                <div class='col-md-2'>
                                    <input class="form-check-input" type="checkbox" value="4Ps" id="4Ps" name="4Ps">
                                    <label class="form-check-label" for="4Ps">4Ps</label>
                                </div>
                                <div class='col-md-2'>
                                    <input class="form-check-input" type="checkbox" value="NHTS" id="NHTS" name="NHTS">
                                    <label class="form-check-label" for="NHTS">NHTS</label>
                                </div>
                                <div class='col-md-2'>
                                    <input class="form-check-input" type="checkbox" value="ID_File" id="ID_File" name="ID_File">
                                    <label class="form-check-label" for="ID_File">ID-File</label>
                                </div>
                                <div class='col-md-2'>
                                    <input class="form-check-input" type="checkbox" value="RRN" id="RRN" name="RRN">
                                    <label class="form-check-label" for="RRN">RRN</label>
                                </div>
                                <div class='col-md-2'>
                                    <input class="form-check-input" type="checkbox" value="Deceased" id="Deceased" name="Deceased">
                                    <label class="form-check-label" for="Deceased">Deceased</label>
                                </div>
                                <div class='col-md-2'>
                                    <input class="form-check-input" type="checkbox" value="Transfer" id="Transfer" name="Transfer">
                                    <label class="form-check-label" for="Transfer">Transfer</label>
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
                if(!empty($_POST['Barangay'])) {
                    $stmt = $con->prepare("SELECT *, CASE WHEN deceased_date IS NOT NULL AND is_deceased = 'Yes' THEN DATE_FORMAT(deceased_date, '%m-%d-%Y') ELSE TIMESTAMPDIFF(YEAR, birthday, CURDATE()) END AS age FROM user WHERE user_type_id = 3 AND barangay = ?");
                    $stmt->bind_param("s", $barangay);
                    $stmt->execute();
                    $result = $stmt->get_result();
                } else{
                    $stmt = $con->prepare("SELECT *, CASE WHEN deceased_date IS NOT NULL AND is_deceased = 'Yes' THEN DATE_FORMAT(deceased_date, '%m-%d-%Y') ELSE TIMESTAMPDIFF(YEAR, birthday, CURDATE()) END AS age FROM user WHERE user_type_id = ?");
                    $stmt->bind_param("i", $user_type_id); // "i" indicates integer, adjust it based on your data type
                    $user_type_id = 3; // Set the value for the parameter
                    $stmt->execute();
                    $result = $stmt->get_result();
                }
            ?>
            <div class="col-md-12 print-table-adjust" style="overflow-x: auto;">
                <table class="table text-center table-hover table-striped">
                    <thead>
                        <tr class="bg-success text-light bg-success-print">
                            <th>No.</th>
                            <th>Full Name</th>
                            <?php if(isset($_POST['Purok'])) { ?>
                                <th>Purok</th>
                            <?php } ?>
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
                            <?php if(isset($_POST['Civil_Status'])) { ?>
                                <th>Marital Status</th>
                            <?php } ?>
                            <?php if(isset($_POST['Date_Issued'])) { ?>
                                <th>Date Issued</th>
                            <?php } ?>
                            <?php if(isset($_POST['Soc_Pen'])) { ?>
                                <th>Soc-Pen</th>
                            <?php } ?>
                            <?php if(isset($_POST['GSIS'])) { ?>
                                <th>GSIS</th>
                            <?php } ?>
                            <?php if(isset($_POST['SSS'])) { ?>
                                <th>SSS</th>
                            <?php } ?>
                            <?php if(isset($_POST['PVAO'])) { ?>
                                <th>PVAO</th>
                            <?php } ?>
                            <?php if(isset($_POST['SUP_WITH'])) { ?>
                                <th>SUP-WITH</th>
                            <?php } ?>
                            <?php if(isset($_POST['4Ps'])) { ?>
                                <th>4Ps</th>
                            <?php } ?>
                            <?php if(isset($_POST['NHTS'])) { ?>
                                <th>NHTS</th>
                            <?php } ?>
                            <?php if(isset($_POST['ID_File'])) { ?>
                                <th>ID-File</th>
                            <?php } ?>
                            <?php if(isset($_POST['RRN'])) { ?>
                                <th>RRN</th>
                            <?php } ?>
                            <?php if(isset($_POST['Deceased'])) { ?>
                                <th>Deceased</th>
                                <th>Deceased Date</th>
                            <?php } ?>
                            <?php if(isset($_POST['Transfer'])) { ?>
                                <th>Transfer</th>
                                <th>Transfer Date</th>
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
                                        if(isset($_POST['Purok'])) { 
                                            echo '<td class=""><p class="m-0">' . $row['purok'] . '</p></td>';
                                        }
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
                                        if(isset($_POST['Civil_Status'])) { 
                                            echo '<td class=""><p class="m-0">' . $row['civil_status'] . '</p></td>';
                                        }
                                        if(isset($_POST['Date_Issued'])) { 
                                            echo '<td class=""><p class="m-0">' . $row['date_issued'] . '</p></td>';
                                        }
                                        if(isset($_POST['Soc_Pen'])) { 
                                            echo '<td class=""><p class="m-0">' . $row['soc_pen'] . '</p></td>';
                                        }
                                        if(isset($_POST['GSIS'])) { 
                                            echo '<td class=""><p class="m-0">' . $row['gsis'] . '</p></td>';
                                        }
                                        if(isset($_POST['SSS'])) { 
                                            echo '<td class=""><p class="m-0">' . $row['sss'] . '</p></td>';
                                        }
                                        if(isset($_POST['PVAO'])) { 
                                            echo '<td class=""><p class="m-0">' . $row['pvao'] . '</p></td>';
                                        }
                                        if(isset($_POST['SUP_WITH'])) { 
                                            echo '<td class=""><p class="m-0">' . $row['sup_with'] . '</p></td>';
                                        }
                                        if(isset($_POST['4Ps'])) { 
                                            echo '<td class=""><p class="m-0">' . $row['fourps'] . '</p></td>';
                                        }
                                        if(isset($_POST['NHTS'])) { 
                                            echo '<td class=""><p class="m-0">' . $row['nhts'] . '</p></td>';
                                        }
                                        if(isset($_POST['ID_File'])) { 
                                            echo '<td class=""><p class="m-0">' . $row['id_file'] . '</p></td>';
                                        }
                                        if(isset($_POST['RRN'])) { 
                                            echo '<td class=""><p class="m-0">' . $row['rrn'] . '</p></td>';
                                        }
                                        if(isset($_POST['Deceased'])) { 
                                            echo '<td class=""><p class="m-0">' . $row['is_deceased'] . '</p></td>';
                                            echo '<td class=""><p class="m-0">' . $row['deceased_date'] . '</p></td>';
                                        }
                                        if(isset($_POST['Transfer'])) { 
                                            echo '<td class=""><p class="m-0">' . $row['is_transfer'] . '</p></td>';
                                            echo '<td class=""><p class="m-0">' . $row['transfer_date'] . '</p></td>';
                                        }
                                        echo '</tr>';
                                    }
                                } else {
                                    echo '<tr>';
                                    echo '<th class="py-1 text-center" colspan="30">No Data.</th>';
                                    echo '</tr>';
                                }

                                $stmt->close(); ?>
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