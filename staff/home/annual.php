<?php include ('../includes/header.php'); ?>
<head>
    <!-- Website Title -->
    <title><?= $system['shortname'] ?> | Annual Dues</title>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <!-- Select2 CSS and JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <style>
        .select2-container {
            z-index: 9999 !important;
        }
    </style>
</head>
<main>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-5">
        <nav class="rounded bg-gray-200 mb-4" aria-label="breadcrumb">
            <ol class="breadcrumb px-3 py-2 rounded mb-0">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="../home">Home</a></li>
                <li class="breadcrumb-item active">Annual Dues</li>
            </ol>
        </nav>
        <div class="card mb-4">
            <div class="card-header text-white bg-teal">Annual Dues Table
                <!-- <button class="btn btn-primary btn-icon-split btn-sm float-end" data-bs-toggle="modal" data-bs-target="#btn_add_dues"> 
                    <span class="icon text-white">
                        <i class="fas fa-user-plus"></i> Add Annual Dues
                    </span>
                </button>
                <form action="ajax.php" method="post" name="export_excel" enctype="multipart/form-data" class="form-horizontal">
                    <button class="btn btn-primary btn-icon-split btn-sm float-end" style="margin-right: 0.5rem; margin-top: -1.5rem" name="btn_export_dues"> 
                        <span class="icon text-white">
                            <i class="fas fa-file-export"></i> Export
                        </span>
                    </button>
                </form> -->
            </div>
            <div class="card-body">
                <table id="dataTable" class="display cell-border stripe table table-bordered dataTable no-footer" style="width:99% !important">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>ID Number</th>
                            <th>Full Name</th>
                            <th>Gender</th>
                            <th>Barangay</th>
                            <th>Amount</th>
                            <th>Year</th>
                            <th>Date Paid</th>
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
                                        data.dues_list = "1"; // Include the parameter in the AJAX request
                                    }
                                },
                                'scrollX': true,
                                'searchDelay': 86400000, // Disable Search or deley search 24hours
                                'scrollCollapse': true, // Allow vertical scrollbar when necessary
                                'columns': [
                                    { data: 'dues_id', className: 'text-center' },
                                    { data: 'id_number', className: 'text-center' },
                                    { data: 'fullname', className: 'text-center', },
                                    { data: 'barangay', className: 'text-center' },
                                    { data: 'gender', className: 'text-center' },
                                    { data: 'amount', className: 'text-center' },
                                    { data: 'year', className: 'text-center' },
                                    { data: 'new_date_paid', className: 'text-center' }
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

<?php include ('../includes/footer.php'); ?>