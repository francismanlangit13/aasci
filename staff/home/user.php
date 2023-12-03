<?php include ('../includes/header.php'); ?>
<head>
    <!-- Website Title -->
    <title><?= $system['shortname'] ?> | Users</title>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
</head>
<main>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-5">
        <nav class="rounded bg-gray-200 mb-4" aria-label="breadcrumb">
            <ol class="breadcrumb px-3 py-2 rounded mb-0">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="../home">Home</a></li>
                <li class="breadcrumb-item active">Users</li>
            </ol>
        </nav>
        <div class="card mb-4">
            <div class="card-header text-white bg-teal">Users Table
                <form action="ajax.php" method="post" name="export_excel" enctype="multipart/form-data" class="form-horizontal">
                    <button class="btn btn-primary btn-icon-split btn-sm float-end" style="margin-right: 0.5rem; margin-top: -1.5rem" name="btn_export_users"> 
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
                            <th>Full Name</th>
                            <th>Gender</th>
                            <th>Birthday</th>
                            <th>Civil Status</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Actions</th>
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
                                        data.user_list = "1"; // Include the parameter in the AJAX request
                                    }
                                },
                                'scrollX': true,
                                'searchDelay': 86400000, // Disable Search or deley search 24hours
                                'scrollCollapse': true, // Allow vertical scrollbar when necessary
                                'columns': [
                                    { data: 'user_id', className: 'text-center' },
                                    { data: 'fullname', className: 'text-center', },
                                    { data: 'gender', className: 'text-center' },
                                    { data: 'newbirthday', className: 'text-center' },
                                    { data: 'civil_status', className: 'text-center' },
                                    { data: 'email', className: 'text-center' },
                                    { data: 'phone', className: 'text-center' },
                                    {
                                        data: 'user_type_id',
                                        className: 'text-center',
                                        render: function (data, type, row) {
                                            // Check the value of user_type_id and display "admin" or "staff"
                                            if (data == 1) {
                                                return 'Admin';
                                            } else {
                                                return 'Staff';
                                            }
                                        }
                                    },
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
                                            '<button class="btn btn-datatable btn-icon btn-transparent-dark" data-bs-toggle="modal" data-bs-target="#btn_view_user" data-view_fname="' + data.fname + '" data-view_mname="' + data.mname + '" data-view_lname="' + data.lname + '" data-view_suffix="' + data.suffix + '" data-view_gender="' + data.gender + '" data-view_birthday="' + data.birthday + '" data-view_civil_status="' + data.civil_status + '" data-view_email="' + data.email + '" data-view_phone="' + data.phone + '" data-view_role="' + data.user_type_id + '" data-view_status="' + data.user_status_id + '" onclick="viewModal(this)" title="View"><i class="fa fa-eye"></i></button>'+
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

<!-- Modal for View user -->
<div class="modal fade" id="btn_view_user" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="view_userLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg d-grid" role="document" style="justify-items: center;">
        <div class="modal-content">
            <div class="modal-header card-header">
                <h5 class="modal-title" id="view_userLabel">View user</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div> 
            <div class="modal-body"> 
                <div class="card mb-4">
                    <div class="card-header bg-teal">
                        <h5 class="text-white"><i class="far fa-user"></i> User information</h5>
                    </div>
                    <div class="card-body">
                        <div class="row"> 
                            <div class="col-md-4 mb-3">
                                <label for="view_fname">First Name</label>
                                <input disabled type="text" id="view_fname" class="form-control">
                            </div> 
                        
                            <div class="col-md-4 mb-3">
                                <label for="view_mname">Middle Name</label>
                                <input disabled type="text" id="view_mname" class="form-control">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="view_lname">Last Name</label>
                                <input disabled type="text" id="view_lname" class="form-control">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="view_suffix">Suffix</label>
                                <input disabled type="text" id="view_suffix" class="form-control">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="view_gender">Gender</label>
                                <input disabled type="text" id="view_gender" class="form-control">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="view_birthday">Date of Birth</label>
                                <input disabled class="form-control" id="view_birthday" pattern="\d{2} \d{2} \d{4}" placeholder="MM/DD/YYYY" type="date"/>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="view_civil_status">Civil Status</label>
                                <input disabled type="text" id="view_civil_status" class="form-control">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="view_email">Email</label>
                                <input disabled type="text" id="view_email" class="form-control">
                            </div>
                        
                            <div class="col-md-4 mb-3">
                                <label for="view_phone">Phone Number</label>
                                <input disabled type="text" name="view_phone" class="form-control" id="view_phone">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="view_role">Role</label>
                                <input disabled type="text" class="form-control" id="view_role">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="view_status">Status</label>
                                <input disabled type="text" class="form-control" id="view_status">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- JavaScript for Modal View -->
<script>
    function viewModal(button) {
        // Redirect to the PHP file with the retrieved id as a query parameter
        document.getElementById("view_fname").value = button.getAttribute("data-view_fname");
        document.getElementById("view_mname").value = button.getAttribute("data-view_mname");
        document.getElementById("view_lname").value = button.getAttribute("data-view_lname");
        document.getElementById("view_suffix").value = button.getAttribute("data-view_suffix");
        document.getElementById("view_gender").value = button.getAttribute("data-view_gender");
        document.getElementById("view_birthday").value = button.getAttribute("data-view_birthday");
        document.getElementById("view_civil_status").value = button.getAttribute("data-view_civil_status");
        document.getElementById("view_email").value = button.getAttribute("data-view_email");
        document.getElementById("view_phone").value = button.getAttribute("data-view_phone");
        document.getElementById("view_role").value = button.getAttribute("data-view_role");
        document.getElementById("view_status").value = button.getAttribute("data-view_status");
    }
</script>
<?php include ('../includes/footer.php'); ?>