<?php include ('../includes/header.php'); ?>
<head>
    <!-- Website Title -->
    <title><?= $system['shortname'] ?> | Senior Citizen</title>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
</head>
<main>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-5">
        <nav class="rounded bg-gray-200 mb-4" aria-label="breadcrumb">
            <ol class="breadcrumb px-3 py-2 rounded mb-0">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="../home">Home</a></li>
                <li class="breadcrumb-item active">Senior Citizen</li>
            </ol>
        </nav>
        <div class="card mb-4">
            <div class="card-header text-white bg-teal">Senior Citizen Table
                <form action="ajax.php" method="post" name="export_excel" enctype="multipart/form-data" class="form-horizontal">
                    <button class="btn btn-primary btn-icon-split btn-sm float-end" style="margin-right: 0.5rem; margin-top: -1.5rem" name="btn_export_senior"> 
                        <span class="icon text-white">
                            <i class="fas fa-file-export"></i> Export
                        </span>
                    </button>
                </form>
            </div>
            <div class="card-body">
                <table id="dataTable" class="display cell-border stripe table table-bordered dataTable no-footer" style="width:99% !important">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>ID Number</th>
                            <th>Full Name</th>
                            <th>Gender</th>
                            <th>Birthday</th>
                            <th>Age</th>
                            <th>Marital status</th>
                            <th>Purok</th>
                            <th>Barangay</th>
                            <th>Date Issued</th>
                            <th>Soc Pen</th>
                            <th>GSIS</th>
                            <th>SSS</th>
                            <th>PVAO</th>
                            <th>SUP WITH</th>
                            <th>4P'S</th>
                            <th>NHTS</th>
                            <th>ID File</th>
                            <th>RRN</th>
                            <th>Deceased</th>
                            <th>Deceased Date</th>
                            <th>Transfer</th>
                            <th>Transfer Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    <!-- Ajax Tables -->
                    <script type="text/javascript">
                        $(document).ready(function() {
                            var dataTable = $('#dataTable').DataTable({
                                'processing': true,
                                'serverSide': true,
                                'serverMethod': 'post',
                                'ajax': {
                                    'url':'ajax.php',
                                    'data': function (data) {
                                        data.client_list = "1"; // Include the parameter in the AJAX request
                                    }
                                },
                                'scrollX': true,
                                'searchDelay': 86400000, // Disable Search or deley search 24hours
                                'scrollCollapse': true, // Allow vertical scrollbar when necessary
                                'columns': [
                                    { data: 'user_id', className: 'text-center' },
                                    { data: 'id_number', className: 'text-center' },
                                    { data: 'fullname', className: 'text-center', },
                                    { data: 'gender', className: 'text-center' },
                                    { data: 'newbirthday', className: 'text-center' },
                                    { data: 'age', className: 'text-center' },
                                    { data: 'civil_status', className: 'text-center' },
                                    { data: 'purok', className: 'text-center' },
                                    { data: 'barangay', className: 'text-center' },
                                    { data: 'newdateissued', className: 'text-center' },
                                    { data: 'soc_pen', className: 'text-center' },
                                    { data: 'gsis', className: 'text-center' },
                                    { data: 'sss', className: 'text-center' },
                                    { data: 'pvao', className: 'text-center' },
                                    { data: 'sup_with', className: 'text-center' },
                                    { data: 'fourps', className: 'text-center' },
                                    { data: 'nhts', className: 'text-center' },
                                    { data: 'id_file', className: 'text-center' },
                                    { data: 'rrn', className: 'text-center' },
                                    { data: 'deceased', className: 'text-center' },
                                    { data: 'new_deceased_date', className: 'text-center' },
                                    { data: 'transfer', className: 'text-center' },
                                    { data: 'new_transfer_date', className: 'text-center' },
                                    {
                                        data: 'user_status_id',
                                        className: 'text-center',
                                        render: function (data, type, row) {
                                            // Check the value of user_status_id and display "Active" or "Inactive"
                                            if (data == 1) {
                                                return 'Active';
                                            } else {
                                                return 'Inactive';
                                            }
                                        }
                                    },
                                    {
                                        data: null,
                                        render: function(data, type, row, meta) {
                                            return '<div class="row d-flex" style="justify-content:space-evenly;">'+
                                            '<button class="btn btn-datatable btn-icon btn-transparent-dark" data-bs-toggle="modal" data-bs-target="#btn_view_client" data-view_id="' + data.user_id + '" data-view_id_number="' + data.id_number + '" data-view_profile="' + data.profile + '" data-view_psa="' + data.psa + '" onclick="viewModal(this)" title="View"><i class="fa fa-eye"></i></button>'+
                                            '</div>';
                                        },
                                        searchable: false, // Exclude from search
                                        orderable: false   // Exclude from sorting
                                    }
                                ]
                            });
                            // After typing on search will do searching data.
                            var searchTimer;
                            var searchInput = $('#dataTable_filter input');
                            searchInput.on('keyup', function () {
                                clearTimeout(searchTimer);
                                searchTimer = setTimeout(function () {
                                    var searchTerm = searchInput.val();
                                    dataTable.search(searchTerm).draw();
                                }, 1500); // Set the delay to 1.5 seconds (1500 milliseconds)
                            });
                        });
                    </script>
                </table>
            </div>
        </div>
    </div>
</main>

<!-- Modal for View client -->
<div class="modal fade" id="btn_view_client" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="view_clientLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg d-grid" role="document" style="justify-items: center;">
        <div class="modal-content">
            <div class="modal-header card-header">
                <h5 class="modal-title" id="view_clientLabel">View Senior Citizen</h5>
                <button class="btn-close" type="button" id="btn_close_modal" data-bs-dismiss="modal" aria-label="Close"></button>
            </div> 
            <div class="modal-body"> 
                <div class="card mb-4">
                    <div class="card-header bg-teal">
                        <h5 class="text-white"><i class="far fa-user"></i> Senior Citizen information</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div id="view-senior"></div>
                            <div class="col-md-6 text-center">
                                <br>
                                <label for="frame3">Senior Picture</label>
                                <!-- Add a class for the profile images -->
                                <a id="a-profile_view" class="glightbox" data-lightbox="profile">
                                    <img class="mt-2" id="frame3" alt="Senior Picture" width="240px" height="180px"/>
                                </a>
                            </div>
                            <div class="col-md-6 text-center">
                                <br>
                                <label for="frame4">PSA Attachment</label>
                                <!-- Add a class for the PSA images -->
                                <a id="a-psa_view" class="glightbox" data-gallery="PSA">
                                    <img class="mt-2" id="frame4" alt="PSA Attachment" width="240px" height="180px"/>
                                </a>
                            </div>
                            <div class="col-md-12 text-center">
                                <br>
                                <label for="frame7">QR Code</label>
                                <a href="<?php echo base_url . 'assets/files/system/qr-code.png'?>" class="glightbox d-block" data-gallery="QRCode">
                                    <img class="zoom img-fluid img-bordered-sm" id="frame7" alt="image" style="max-width: 250px; object-fit: cover; margin-bottom:-2.5rem;">
                                </a>
                                <h3 class="text-center mt-4"><a href="<?php echo base_url . 'assets/files/system/qr-code.png'?>" download>Download QR Code</a></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function viewModal(button) {
        var id = button.getAttribute("data-view_id");

        const xhrAjax = new XMLHttpRequest();
        xhrAjax.open("POST", "client_view.php", true);
        xhrAjax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhrAjax.onreadystatechange = function () {
            if (xhrAjax.readyState === 4 && xhrAjax.status === 200) {
                var responseText = xhrAjax.responseText;
                // Update the view-senior div with the response
                document.getElementById("view-senior").innerHTML = responseText;
                document.getElementById("a-profile_view").href = base_url + 'assets/files/clients/' + button.getAttribute("data-view_profile");
                document.getElementById("frame3").src = base_url + 'assets/files/clients/' + button.getAttribute("data-view_profile");
                document.getElementById("a-psa_view").href = base_url + 'assets/files/documents/' + button.getAttribute("data-view_psa");
                document.getElementById("frame4").src = base_url + 'assets/files/documents/' + button.getAttribute("data-view_psa");
                document.getElementById("frame7").src = base_url + 'assets/files/system/qr-code.png?' + new Date().getTime();
            }
        };
        xhrAjax.send(`id=${id}`);
    }
    // Clear the QR code container when the modal is closed using the "btn_close_modal" button
    document.getElementById("btn_close_modal").addEventListener("click", function () {
        document.getElementById("a-profile_view").removeAttribute("href");
        document.getElementById("frame3").removeAttribute("src");
        document.getElementById("a-psa_view").removeAttribute("href");
        document.getElementById("frame4").removeAttribute("src");
        document.getElementById("frame7").removeAttribute("src");
    });
</script>
<?php include ('../includes/footer.php'); ?>