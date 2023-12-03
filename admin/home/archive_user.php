<?php include ('../includes/header.php'); ?>
<head>
    <!-- Website Title -->
    <title><?= $system['shortname'] ?> | Archive Users</title>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
</head>
<main>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-5">
        <nav class="rounded bg-gray-200 mb-4" aria-label="breadcrumb">
            <ol class="breadcrumb px-3 py-2 rounded mb-0">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="../home">Home</a></li>
                <li class="breadcrumb-item active">Archive Users</li>
            </ol>
        </nav>
        <div class="card mb-4">
            <div class="card-header text-white bg-teal">Archive Users Table
                <form action="ajax.php" method="post" name="export_excel" enctype="multipart/form-data" class="form-horizontal">
                    <button class="btn btn-primary btn-icon-split btn-sm float-end" style="margin-right: 0.5rem; margin-top: -1.5rem" name="btn_export_users_archive"> 
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
                                        data.user_list_archive = "1"; // Include the parameter in the AJAX request
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
                                        data: null,
                                        render: function(data, type, row, meta) {
                                            return '<div class="row d-flex" style="justify-content:space-evenly;">'+
                                            '<button class="btn btn-datatable btn-icon btn-transparent-dark" data-bs-toggle="modal" data-bs-target="#btn_restore_user" data-restore_user_id="' + data.user_id + '" data-restore_fname="' + data.fname + '" data-restore_mname="' + data.mname + '" data-restore_lname="' + data.lname + '" data-restore_suffix="' + data.suffix + '" onclick="restoreModal(this)" title="Restore"><i class="fas fa-trash-restore"></i></button>'+
                                            '<button class="btn btn-datatable btn-icon btn-transparent-dark" data-bs-toggle="modal" data-bs-target="#btn_delete_user" data-delete_user_id="' + data.user_id + '" data-delete_fname="' + data.fname + '" data-delete_mname="' + data.mname + '" data-delete_lname="' + data.lname + '" data-delete_suffix="' + data.suffix + '" onclick="deleteModal(this)" title="Delete"><i class="fa fa-trash"></i></button>'+
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

<!-- Modal for Restore user -->
<div class="modal fade" id="btn_restore_user" tabindex="-1" role="dialog" aria-labelledby="restore_userLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="restore_userLabel">Restore User</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">Are you sure you want to restore this user <b><span id="label"></span></b></div>
            <div class="modal-footer">
                <form id="restore_user_form" method="POST"  enctype="multipart/form-data">
                    <input type="hidden" id="restore_user_id" name="restore_user_id">
                    <button type="submit" id="restore_user" class="btn btn-danger">Restore</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- JavaScript for Modal Restore -->
<script>
    function restoreModal(button) {
        // Redirect to the PHP file with the retrieved id as a query parameter
        document.getElementById("restore_user_id").value = button.getAttribute("data-restore_user_id");
        document.getElementById("label").innerHTML = button.getAttribute("data-restore_fname") + ' ' + button.getAttribute("data-restore_mname") + ' ' + button.getAttribute("data-restore_lname") + ' ' + button.getAttribute("data-restore_suffix");
    }
</script>

<!-- Modal for Delete user -->
<div class="modal fade" id="btn_delete_user" tabindex="-1" role="dialog" aria-labelledby="delete_userLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delete_userLabel">Delete User</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">Are you sure you want to delete this user <b><span id="label"></span></b></div>
            <div class="modal-footer">
                <form id="delete_user_form" method="POST"  enctype="multipart/form-data">
                    <input type="hidden" id="delete_user_id" name="delete_user_id">
                    <button type="submit" id="delete_user" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- JavaScript for Modal Delete -->
<script>
    function deleteModal(button) {
        // Redirect to the PHP file with the retrieved id as a query parameter
        document.getElementById("delete_user_id").value = button.getAttribute("data-delete_user_id");
        document.getElementById("label").innerHTML = button.getAttribute("data-delete_fname") + ' ' + button.getAttribute("data-delete_mname") + ' ' + button.getAttribute("data-delete_lname") + ' ' + button.getAttribute("data-delete_suffix");
    }
</script>
<script type="text/javascript">
    $(document).ready(function() {
        // Restore user
        $('#restore_user').click(function() {
            var formData = new FormData($('#restore_user_form')[0]);
            formData.append('restore_user', '1'); // Identifier
            $.ajax({
                url: "ajax.php",
                method: "POST",
                data: formData,
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    $('#restore_user').attr('disabled', 'disabled');
                },
                success: function(data) {
                    swal({
                        title: "Notice",
                        text: data.status,
                        icon: data.alert,
                        button: false,
                        timer: 2000
                    }).then(function() {
                        $('#btn_restore_user').modal('hide');
                        $('#restore_user_form')[0].reset();
                        $('#restore_user').removeAttr('disabled');
                        // Update the DataTable
                        var dataTable = $('#dataTable').DataTable();
                        dataTable.draw(); // Redraw the DataTable
                    });
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.error(errorThrown);
                }
            });
        });
        // Delete user
        $('#delete_user').click(function() {
            var formData = new FormData($('#delete_user_form')[0]);
            formData.append('delete_user_archive', '1'); // Identifier
            $.ajax({
                url: "ajax.php",
                method: "POST",
                data: formData,
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    $('#delete_user').attr('disabled', 'disabled');
                },
                success: function(data) {
                    swal({
                        title: "Notice",
                        text: data.status,
                        icon: data.alert,
                        button: false,
                        timer: 2000
                    }).then(function() {
                        $('#btn_delete_user').modal('hide');
                        $('#delete_user_form')[0].reset();
                        $('#delete_user').removeAttr('disabled');
                        // Update the DataTable
                        var dataTable = $('#dataTable').DataTable();
                        dataTable.draw(); // Redraw the DataTable
                    });
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.error(errorThrown);
                }
            });
        });
    });
</script>
<?php include ('../includes/footer.php'); ?>