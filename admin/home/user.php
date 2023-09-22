<head>
    <?php include ('../includes/header.php'); ?>
    <!-- Website Title -->
    <title><?= $system['shortname'] ?> | Users</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.js"></script>
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
                <button class="btn btn-primary btn-icon-split btn-sm float-end" data-bs-toggle="modal" data-bs-target="#btn_add_user"> 
                    <span class="icon text-white">
                        <i class="fas fa-user-plus"></i> Add User Account
                    </span>
                </button>
            </div>
            <div class="card-body">
                <table id="datatablesSimple1" class="overflow-auto">
                    <thead>
                        <tr>
                            <th>ID</th>
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
                            var dataTable = $('#datatablesSimple1').DataTable({
                                'processing': true,
                                'serverSide': true,
                                'serverMethod': 'post',
                                'ajax': {
                                    'url':'ajax.php',
                                    'data': function (data) {
                                        data.user_list = "1"; // Include the parameter in the AJAX request
                                    }
                                },
                                'columns': [
                                    { data: 'user_id', className: 'text-left' },
                                    { data: 'fname', className: 'text-left' },
                                    { data: 'gender', className: 'text-left' },
                                    { data: 'newbirthday', className: 'text-left' },
                                    { data: 'civil_status', className: 'text-left' },
                                    { data: 'email', className: 'text-left' },
                                    { data: 'phone', className: 'text-left' },
                                    { data: 'user_type_id', className: 'text-left' },
                                    { data: 'user_status_id', className: 'text-left' },
                                    {
                                        data: null,
                                        render: function(data, type, row, meta) {
                                            return '<div class="row d-flex" style="justify-content:space-evenly;">'+
                                            '<button class="btn btn-datatable btn-icon btn-transparent-dark"><i class="fa fa-eye"></i></button>'+'<button class="btn btn-datatable btn-icon btn-transparent-dark"><i class="fa fa-edit"></i></button>'+'<button class="btn btn-datatable btn-icon btn-transparent-dark"><i class="fa fa-trash"></i></button>'+
                                            '</div>';
                                        },
                                        searchable: false, // Exclude from search
                                        orderable: false   // Exclude from sorting
                                    }
                                ]
                            });
                        });
                    </script>
                </table>
            </div>
        </div>
    </div>
</main>
<!-- Modal for Add user -->
<div class="modal fade" id="btn_add_user" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="add_userLabel" aria-hidden="true">
    <div class="modal-dialog d-grid" role="document" style="justify-items: center;">
        <div class="modal-content" style="width:175%">
            <div class="modal-header card-header">
                <h5 class="modal-title" id="add_userLabel">Add user</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="add_user_form" method="POST" enctype="multipart/form-data" > 
                <div class="modal-body"> 
                    <div class="card mb-4">
                        <div class="card-header bg-teal">
                            <h5 class="text-white"><i class="far fa-user"></i> User information</h5>
                        </div>
                        <div class="card-body">
                            <div class="row"> 
                                <div class="col-md-4 mb-3">
                                    <label for="fname" class="required">First Name</label>
                                    <input required placeholder="Enter First Name" type="text" id="fname" name="fname" class="form-control">
                                    <div id="fname-error"></div>
                                </div> 
                            
                                <div class="col-md-4 mb-3">
                                    <label for="mname">Middle Name</label>
                                    <input placeholder="Enter Middle Name" type="text" id="mname" name="mname" class="form-control">
                                    <div id="mname-error"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="lname" class="required">Last Name</label>
                                    <input required placeholder="Enter Last Name" type="text" id="lname" name="lname" class="form-control">
                                    <div id="lname-error"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="gender" class="required">Gender</label>
                                    <select id="gender" name="gender" required class="form-control">
                                        <option value="" selected>Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                    <div id="gender-error"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="birthday" class="required">Date of Birth</label>
                                    <input required class="form-control" id="birthday" name="birthday" placeholder="MM/DD/YYY" type="date"/>
                                    <div id="birthday-error"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="civilstatus" class="required">Civil Status</label>
                                    <select id="civilstatus" name="civilstatus" required class="form-control">
                                        <option value="" selected>Select Civil Status</option>
                                        <option value="Single">Single</option>
                                        <option value="Married">Married</option>
                                        <option value="Widowed">Widowed</option>
                                        <option value="Separated">Separated</option>
                                    </select>
                                    <div id="civilstatus-error"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="email" class="required">Email</label>
                                    <input required placeholder="Enter Email" type="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" class="form-control" id="email-input">
                                    <div id="email-error"></div>
                                </div>
                            
                                <div class="col-md-4 mb-3">
                                    <label for="phone" class="required">Phone Number</label>
                                    <input required placeholder="Enter Phone Number" type="text" name="phone" pattern="09[0-9]{9}" maxlength="11" class="form-control" id="phone-input">
                                    <div id="phone-error"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="role" class="required">Role</label>
                                    <select id="role" name="role" required class="form-control">
                                        <option value="" selected>Select Role</option>
                                        <option value="1">Admin</option>
                                        <option value="2">Staff</option>
                                    </select>
                                    <div id="role-error"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id="add_user" type="button"><i class="fa fa-plus mr-1" style="margin-right:0.3rem"></i>Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal for Edit user -->
<div class="modal fade" id="btn_add_user" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="add_userLabel" aria-hidden="true">
    <div class="modal-dialog d-grid" role="document" style="justify-items: center;">
        <div class="modal-content" style="width:175%">
            <div class="modal-header card-header">
                <h5 class="modal-title" id="add_userLabel">Add user</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="add_user_form" method="POST" enctype="multipart/form-data" > 
                <div class="modal-body"> 
                    <div class="card mb-4">
                        <div class="card-header bg-teal">
                            <h5 class="text-white"><i class="far fa-user"></i> User information</h5>
                        </div>
                        <div class="card-body">
                            <div class="row"> 
                                <div class="col-md-4 mb-3">
                                    <label for="fname" class="required">First Name</label>
                                    <input required placeholder="Enter First Name" type="text" id="fname" name="fname" class="form-control">
                                    <div id="fname-error"></div>
                                </div> 
                            
                                <div class="col-md-4 mb-3">
                                    <label for="mname">Middle Name</label>
                                    <input placeholder="Enter Middle Name" type="text" id="mname" name="mname" class="form-control">
                                    <div id="mname-error"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="lname" class="required">Last Name</label>
                                    <input required placeholder="Enter Last Name" type="text" id="lname" name="lname" class="form-control">
                                    <div id="lname-error"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="gender" class="required">Gender</label>
                                    <select id="gender" name="gender" required class="form-control">
                                        <option value="" selected>Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                    <div id="gender-error"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="birthday" class="required">Date of Birth</label>
                                    <input required class="form-control" id="birthday" name="birthday" placeholder="MM/DD/YYY" type="date"/>
                                    <div id="birthday-error"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="civilstatus" class="required">Civil Status</label>
                                    <select id="civilstatus" name="civilstatus" required class="form-control">
                                        <option value="" selected>Select Civil Status</option>
                                        <option value="Single">Single</option>
                                        <option value="Married">Married</option>
                                        <option value="Widowed">Widowed</option>
                                        <option value="Separated">Separated</option>
                                    </select>
                                    <div id="civilstatus-error"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="email" class="required">Email</label>
                                    <input required placeholder="Enter Email" type="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" class="form-control" id="email-input">
                                    <div id="email-error"></div>
                                </div>
                            
                                <div class="col-md-4 mb-3">
                                    <label for="phone" class="required">Phone Number</label>
                                    <input required placeholder="Enter Phone Number" type="text" name="phone" pattern="09[0-9]{9}" maxlength="11" class="form-control" id="phone-input">
                                    <div id="phone-error"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="role" class="required">Role</label>
                                    <select id="role" name="role" required class="form-control">
                                        <option value="" selected>Select Role</option>
                                        <option value="1">Admin</option>
                                        <option value="2">Staff</option>
                                    </select>
                                    <div id="role-error"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id="add_user" type="button"><i class="fa fa-plus mr-1" style="margin-right:0.3rem"></i>Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#add_user').click(function() {
            var formData = new FormData($('#add_user_form')[0]);
            formData.append('add_user', '1'); // Identifier
            $.ajax({
                url: "ajax.php",
                method: "POST",
                data: formData,
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    $('#add_user').attr('disabled', 'disabled');
                },
                success: function(data) {
                    swal({
                        title: "Notice",
                        text: data.status,
                        icon: data.alert,
                        button: true
                    }).then(function() {
                        $('#btn_add_user').modal('hide');
                        $('#add_user_form')[0].reset();
                        $('#add_user').removeAttr('disabled');
                        // Update the DataTable
                        var dataTable = $('#datatablesSimple1').DataTable();
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