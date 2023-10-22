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
                <button class="btn btn-primary btn-icon-split btn-sm float-end" data-bs-toggle="modal" data-bs-target="#btn_add_user"> 
                    <span class="icon text-white">
                        <i class="fas fa-user-plus"></i> Add User Account
                    </span>
                </button>
            </div>
            <div class="card-body">
                <table id="dataTable" class="display cell-border stripe table table-bordered dataTable no-footer">
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
                                            '<button class="btn btn-datatable btn-icon btn-transparent-dark" data-bs-toggle="modal" data-bs-target="#btn_edit_user" data-edit_user_id="' + data.user_id + '" data-edit_fname="' + data.fname + '" data-edit_mname="' + data.mname + '" data-edit_lname="' + data.lname + '" data-edit_suffix="' + data.suffix + '" data-edit_gender="' + data.gender + '" data-edit_birthday="' + data.birthday + '" data-edit_civil_status="' + data.civil_status + '" data-edit_email="' + data.email + '" data-edit_phone="' + data.phone + '" data-edit_role="' + data.user_type_id + '" data-edit_status="' + data.user_status_id + '" onclick="editModal(this)" title="Edit"><i class="fa fa-edit"></i></button>'+
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

<!-- Modal for Add user -->
<div class="modal fade" id="btn_add_user" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="add_userLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg d-grid" role="document" style="justify-items: center;">
        <div class="modal-content">
            <div class="modal-header card-header">
                <h5 class="modal-title" id="add_userLabel">Add user</h5>
                <button class="btn-close" type="button" id="add_user_close" data-bs-dismiss="modal" aria-label="Close" onclick="addModalclose(this)"></button>
            </div>
            <form id="add_user_form" method="POST" enctype="multipart/form-data"> 
                <div class="modal-body"> 
                    <div class="card mb-4">
                        <div class="card-header bg-teal">
                            <h5 class="text-white"><i class="far fa-user"></i> User information</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <h6 class="mb-3"><sup class="text-red p-1">Note!</sup>Fields marked with <code class="text-red">*</code> are mandatory and <code class="text-green">*</code> are optional.</h6>
                                <div class="col-md-4 mb-3">
                                    <label for="add_fname" class="required">First Name</label>
                                    <input required placeholder="Enter First Name" type="text" id="add_fname" name="add_fname" class="form-control">
                                    <div id="add_fname-error"></div>
                                </div> 
                            
                                <div class="col-md-4 mb-3">
                                    <label for="add_mname" class="optional">Middle Name</label>
                                    <input placeholder="Enter Middle Name" type="text" id="add_mname" name="add_mname" class="form-control">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="add_lname" class="required">Last Name</label>
                                    <input required placeholder="Enter Last Name" type="text" id="add_lname" name="add_lname" class="form-control">
                                    <div id="add_lname-error"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="add_suffix" class="required">Suffix</label>
                                    <select required class="form-control" id="add_suffix" name="add_suffix">
                                        <option value="" selected>Select Suffix</option>
                                        <option value="">None</option>
                                        <option value="Jr">Jr</option>
                                        <option value="Sr">Sr</option>
                                        <option value="I">I</option>
                                        <option value="II">II</option>
                                        <option value="III">III</option>
                                        <option value="IV">IV</option>
                                        <option value="V">V</option>
                                        <option value="VI">VI</option>
                                    </select>
                                    <div id="add_suffix-error"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="add_gender" class="required">Gender</label>
                                    <select id="add_gender" name="add_gender" required class="form-control">
                                        <option value="" selected>Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                    <div id="add_gender-error"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="add_birthday" class="required">Date of Birth</label>
                                    <input required class="form-control" id="add_birthday" name="add_birthday" pattern="\d{2} \d{2} \d{4}" placeholder="MM/DD/YYYY" type="date"/>
                                    <div id="add_birthday-error"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="add_civil_status" class="required">Civil Status</label>
                                    <select id="add_civil_status" name="add_civil_status" required class="form-control">
                                        <option value="" selected>Select Civil Status</option>
                                        <option value="Single">Single</option>
                                        <option value="Married">Married</option>
                                        <option value="Widowed">Widowed</option>
                                        <option value="Separated">Separated</option>
                                    </select>
                                    <div id="add_civil_status-error"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="add_email" class="required">Email</label>
                                    <input required placeholder="Enter Email" type="email" id="add_email" name="add_email" class="form-control">
                                    <div id="add_email-error"></div>
                                </div>
                            
                                <div class="col-md-4 mb-3">
                                    <label for="add_phone" class="required">Phone Number</label>
                                    <input required placeholder="Enter Phone Number" type="text" id="add_phone" name="add_phone" pattern="09[0-9]{9}" maxlength="11" class="form-control">
                                    <div id="add_phone-error"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="add_role" class="required">Role</label>
                                    <select id="add_role" name="add_role" required class="form-control">
                                        <option value="" selected>Select Role</option>
                                        <option value="1">Admin</option>
                                        <option value="2">Staff</option>
                                    </select>
                                    <div id="add_role-error"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id="add_user" type="submit"><i class="fa fa-plus mr-1" style="margin-right:0.3rem"></i>Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Form Reset Close Model Add -->
<script>
    function addModalclose(button) {
        $('#add_fname').removeClass('is-invalid');
        $('#add_fname-error').empty();
        $('#add_lname').removeClass('is-invalid');
        $('#add_lname-error').empty();
        $('#add_suffix').removeClass('is-invalid');
        $('#add_suffix-error').empty();
        $('#add_gender').removeClass('is-invalid');
        $('#add_gender-error').empty();
        $('#add_birthday').removeClass('is-invalid');
        $('#add_birthday-error').empty();
        $('#add_civil_status').removeClass('is-invalid');
        $('#add_civil_status-error').empty();
        $('#add_email').removeClass('is-invalid');
        $('#add_email-error').empty();
        $('#add_phone').removeClass('is-invalid');
        $('#add_phone-error').empty();
        $('#add_role').removeClass('is-invalid');
        $('#add_role-error').empty();
    }
</script>
<!-- Validation for add_user -->
<script>
    $(document).ready(function() {
        // debounce functions for each input field
        var debouncedCheckadd_Fname = _.debounce(checkadd_Fname, 500);
        var debouncedCheckadd_Lname = _.debounce(checkadd_Lname, 500);
        var debouncedCheckadd_Suffix = _.debounce(checkadd_Suffix, 500);
        var debouncedCheckadd_Gender = _.debounce(checkadd_Gender, 500);
        var debouncedCheckadd_Birthday = _.debounce(checkadd_Birthday, 500);
        var debouncedCheckadd_Civilstatus = _.debounce(checkadd_Civilstatus, 500);
        var debouncedCheckadd_Email = _.debounce(checkadd_Email, 500);
        var debouncedCheckadd_Phone = _.debounce(checkadd_Phone, 500);
        var debouncedCheckadd_Role = _.debounce(checkadd_Role, 500);

        // attach event listeners for each input field
        $('#add_fname').on('input', debouncedCheckadd_Fname);
        $('#add_lname').on('input', debouncedCheckadd_Lname);
        $('#add_suffix').on('change', debouncedCheckadd_Suffix);
        $('#add_gender').on('input', debouncedCheckadd_Gender);
        $('#add_birthday').on('input', debouncedCheckadd_Birthday);
        $('#add_civil_status').on('input', debouncedCheckadd_Civilstatus);
        $('#add_email').on('blur', debouncedCheckadd_Email);
        $('#add_phone').on('blur', debouncedCheckadd_Phone);
        $('#add_role').on('change', debouncedCheckadd_Role);

        // Trigger on input change
        $('#add_fname').on('blur', debouncedCheckadd_Fname);
        $('#add_lname').on('blur', debouncedCheckadd_Lname);
        $('#add_suffix').on('blur', debouncedCheckadd_Suffix);
        $('#add_gender').on('blur', debouncedCheckadd_Gender);
        $('#add_birthday').on('blur', debouncedCheckadd_Birthday);
        $('#add_civil_status').on('blur', debouncedCheckadd_Civilstatus);
        $('#add_email').on('input', debouncedCheckadd_Email);
        $('#add_phone').on('input', debouncedCheckadd_Phone);
        $('#add_role').on('blur', debouncedCheckadd_Role);

        function checkIfAllFieldsValid() {
            // check if all input fields are valid and enable submit button if so
            if ($('#add_fname-error').is(':empty') && $('#add_lname-error').is(':empty') && $('#add_suffix-error').is(':empty') && $('#add_gender-error').is(':empty') && $('#add_birthday-error').is(':empty') && $('#add_civil_status-error').is(':empty') && $('#add_email-error').is(':empty') && $('#add_phone-error').is(':empty') && $('#add_role-error').is(':empty')) {
                $('#add_user').prop('disabled', false);
            } else {
                $('#add_user').prop('disabled', true);
            }
        }

        function checkadd_Email() {
            var add_email = $('#add_email').val().trim();
            // show error if add_email is empty
            if (add_email === '') {
                $('#add_email-error').text('Please input email').css('color', 'red');
                $('#add_email').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }

            // check if add_email format is valid
            var add_emailPattern = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/i;
            if (!add_emailPattern.test(add_email)) {
                $('#add_email-error').text('Invalid email format').css('color', 'red');
                $('#add_email').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // make AJAX call to check if email exists
            $.ajax({
                url: 'ajax.php', // replace with the actual URL to check email
                method: 'POST', // use the appropriate HTTP method
                data: {
                    email: add_email,
                    validation: "1" // Identifier
                },
                success: function(response) {
                    if (response.exists) {
                        // disable submit button if add_email is taken
                        $('#add_user').prop('disabled', true);
                        $('#add_email-error').text('Email already taken').css('color', 'red');
                        $('#add_email').addClass('is-invalid');
                    } else {
                        $('#add_email-error').empty();
                        $('#add_email').removeClass('is-invalid');
                        // enable submit button if add_email is valid
                        checkIfAllFieldsValid();
                    }
                },
                error: function() {
                    $('#add_email-error').text('Error checking email');
                }
            });
        }

        function checkadd_Phone() {
            var add_phone = $('#add_phone').val().trim();
            // show error if add_phone number is empty
            if (add_phone === '') {
                $('#add_phone-error').text('Please input phone number').css('color', 'red');
                $('#add_phone').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }

            // check if add_phone number format is valid
            var add_phoneNumberPattern = /^09[0-9]{9}$/;
            if (!add_phoneNumberPattern.test(add_phone)) {
                $('#add_phone-error').text('Invalid phone number format').css('color', 'red');
                $('#add_phone').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }

            // make AJAX call to check if phone number exists
            $.ajax({
                url: 'ajax.php', // replace with the actual URL to check phone
                method: 'POST', // use the appropriate HTTP method
                data: {
                    phone: add_phone,
                    validation: "1" // Identifier
                },
                success: function(response) {
                    if (response.exists) {
                        $('#add_phone-error').text('Phone number already taken').css('color', 'red');
                        $('#add_phone').addClass('is-invalid');
                        // disable submit button if add_phone is taken
                        $('#add_user').prop('disabled', true);
                    } else {
                        $('#add_phone-error').empty();
                        $('#add_phone').removeClass('is-invalid');
                        // enable submit button if add_phone is valid
                        checkIfAllFieldsValid();
                    }
                },
                error: function() {
                    $('#add_phone-error').text('Error checking phone number');
                }
            });
        }
        
        function checkadd_Fname() {
            var add_fname = $('#add_fname').val().trim();
            // show error if first name is empty
            if (add_fname === '') {
                $('#add_fname-error').text('Please input first name').css('color', 'red');
                $('#add_fname').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }

            // Perform additional validation for first name if needed
            $('#add_fname-error').empty();
            $('#add_fname').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }
        
        function checkadd_Lname() {
            var add_lname = $('#add_lname').val().trim();
            // show error if last name is empty
            if (add_lname === '') {
                $('#add_lname-error').text('Please input last name').css('color', 'red');
                $('#add_lname').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for last name if needed
            $('#add_lname-error').empty();
            $('#add_lname').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

        function checkadd_Suffix() {
            var add_suffixSelect = document.getElementById('add_suffix');
            var add_suffix = add_suffixSelect.value;
            // show error if the default option is selected
            if (add_suffix === '' && add_suffixSelect.selectedIndex !== 1) {
                $('#add_suffix-error').text('Please select a suffix').css('color', 'red');
                $('#add_suffix').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for suffix if needed
            $('#add_suffix-error').empty();
            $('#add_suffix').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

        function checkadd_Gender() {
            var add_gender = $('#add_gender').val()
            // show error if gender is empty
            if (!add_gender || add_gender.trim() === '') {
                $('#add_gender-error').text('Please select gender').css('color', 'red');
                $('#add_gender').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for gender if needed
            $('#add_gender-error').empty();
            $('#add_gender').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }
        
        function checkadd_Birthday() {
            var add_birthday = $('#add_birthday').val().trim();
            // show error if birthday is empty
            if (add_birthday === '') {
                $('#add_birthday-error').text('Please input birthday').css('color', 'red');
                $('#add_birthday').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for birthday if needed
            $('#add_birthday-error').empty();
            $('#add_birthday').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

        function checkadd_Civilstatus() {
            var add_civil_status = $('#add_civil_status').val()
            // show error if civil status is empty
            if (!add_civil_status || add_civil_status.trim() === '') {
                $('#add_civil_status-error').text('Please select civil status').css('color', 'red');
                $('#add_civil_status').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for civil status if needed
            $('#add_civil_status-error').empty();
            $('#add_civil_status').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

        function checkadd_Role() {
            var add_role = $('#add_role').val()
            // show error if role is empty
            if (!add_role || add_role.trim() === '') {
                $('#add_role-error').text('Please select role').css('color', 'red');
                $('#add_role').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for role if needed
            $('#add_role-error').empty();
            $('#add_role').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

    });
</script>

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
                                <input disabled type="text" id="view_fname" name="view_fname" class="form-control">
                            </div> 
                        
                            <div class="col-md-4 mb-3">
                                <label for="view_mname">Middle Name</label>
                                <input disabled type="text" id="view_mname" name="view_mname" class="form-control">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="view_lname">Last Name</label>
                                <input disabled type="text" id="view_lname" name="view_lname" class="form-control">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="view_suffix">Suffix</label>
                                <select disabled class="form-control" id="view_suffix" name="view_suffix">
                                    <option value="" selected>Select Suffix</option>
                                    <option value="">None</option>
                                    <option value="Jr">Jr</option>
                                    <option value="Sr">Sr</option>
                                    <option value="I">I</option>
                                    <option value="II">II</option>
                                    <option value="III">III</option>
                                    <option value="IV">IV</option>
                                    <option value="V">V</option>
                                    <option value="VI">VI</option>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="view_gender">Gender</label>
                                <select disabled id="view_gender" name="view_gender" required class="form-control">
                                    <option value="" selected>Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="view_birthday">Date of Birth</label>
                                <input disabled class="form-control" id="view_birthday" name="view_birthday" pattern="\d{2} \d{2} \d{4}" placeholder="MM/DD/YYYY" type="date"/>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="view_civil_status">Civil Status</label>
                                <select disabled id="view_civil_status" name="view_civil_status" required class="form-control">
                                    <option value="" selected>Select Civil Status</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Widowed">Widowed</option>
                                    <option value="Separated">Separated</option>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="view_email">Email</label>
                                <input disabled type="text" id="view_email" name="view_email" class="form-control">
                            </div>
                        
                            <div class="col-md-4 mb-3">
                                <label for="view_phone">Phone Number</label>
                                <input disabled type="text" name="view_phone" pattern="09[0-9]{9}" maxlength="11" class="form-control" id="view_phone">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="view_role">Role</label>
                                <select disabled id="view_role" name="view_role" required class="form-control">
                                    <option value="" selected>Select Role</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Staff</option>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="view_status">Status</label>
                                <select disabled id="view_status" name="view_status" required class="form-control">
                                    <option value="" selected>Select Role</option>
                                    <option value="1">Active</option>
                                    <option value="2">Inactive</option>
                                </select>
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

<!-- Modal for Edit user -->
<div class="modal fade" id="btn_edit_user" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="edit_userLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg d-grid" role="document" style="justify-items: center;">
        <div class="modal-content">
            <div class="modal-header card-header">
                <h5 class="modal-title" id="edit_userLabel">Edit user</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" onclick="editModalclose(this)"></button>
            </div>
            <form id="edit_user_form" method="POST" enctype="multipart/form-data"> 
                <div class="modal-body"> 
                    <div class="card mb-4">
                        <div class="card-header bg-teal">
                            <h5 class="text-white"><i class="far fa-user"></i> User information</h5>
                        </div>
                        <div class="card-body">
                            <div class="row"> 
                                <h6 class="mb-3"><sup class="text-red p-1">Note!</sup>Fields marked with <code class="text-red">*</code> are mandatory and <code class="text-green">*</code> are optional.</h6>
                                <div class="col-md-4 mb-3">
                                    <label for="edit_fname" class="required">First Name</label>
                                    <input required placeholder="Enter First Name" type="text" id="edit_fname" name="edit_fname" class="form-control">
                                    <div id="edit_fname-error"></div>
                                </div> 
                            
                                <div class="col-md-4 mb-3">
                                    <label for="edit_mname" class="optional">Middle Name</label>
                                    <input placeholder="Enter Middle Name" type="text" id="edit_mname" name="edit_mname" class="form-control">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="edit_lname" class="required">Last Name</label>
                                    <input required placeholder="Enter Last Name" type="text" id="edit_lname" name="edit_lname" class="form-control">
                                    <div id="edit_lname-error"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="edit_suffix" class="required">Suffix</label>
                                    <select class="form-control" id="edit_suffix" name="edit_suffix" required>
                                        <option value="" selected>Select Suffix</option>
                                        <option value="">None</option>
                                        <option value="Jr">Jr</option>
                                        <option value="Sr">Sr</option>
                                        <option value="I">I</option>
                                        <option value="II">II</option>
                                        <option value="III">III</option>
                                        <option value="IV">IV</option>
                                        <option value="V">V</option>
                                        <option value="VI">VI</option>
                                    </select>
                                    <div id="edit_suffix-error"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="edit_gender" class="required">Gender</label>
                                    <select id="edit_gender" name="edit_gender" required class="form-control">
                                        <option value="" selected>Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                    <div id="edit_gender-error"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="edit_birthday" class="required">Date of Birth</label>
                                    <input required class="form-control" id="edit_birthday" name="edit_birthday" pattern="\d{2} \d{2} \d{4}" placeholder="MM/DD/YYYY" type="date"/>
                                    <div id="edit_birthday-error"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="edit_civil_status" class="required">Civil Status</label>
                                    <select id="edit_civil_status" name="edit_civil_status" required class="form-control">
                                        <option value="" selected>Select Civil Status</option>
                                        <option value="Single">Single</option>
                                        <option value="Married">Married</option>
                                        <option value="Widowed">Widowed</option>
                                        <option value="Separated">Separated</option>
                                    </select>
                                    <div id="edit_civil_status-error"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="edit_email" class="required">Email</label>
                                    <input required placeholder="Enter Email" type="text" id="edit_email" name="edit_email" class="form-control">
                                    <div id="edit_email-error"></div>
                                </div>
                            
                                <div class="col-md-4 mb-3">
                                    <label for="edit_phone" class="required">Phone Number</label>
                                    <input required placeholder="Enter Phone Number" type="text" name="edit_phone" pattern="09[0-9]{9}" maxlength="11" class="form-control" id="edit_phone">
                                    <div id="edit_phone-error"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="edit_role" class="required">Role</label>
                                    <select id="edit_role" name="edit_role" required class="form-control">
                                        <option value="" selected>Select Role</option>
                                        <option value="1">Admin</option>
                                        <option value="2">Staff</option>
                                    </select>
                                    <div id="edit_role-error"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="edit_status" class="required">Status</label>
                                    <select id="edit_status" name="edit_status" required class="form-control">
                                        <option value="" selected>Select Role</option>
                                        <option value="1">Active</option>
                                        <option value="2">Inactive</option>
                                    </select>
                                    <div id="edit_status-error"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="edit_user_id" name="edit_user_id">
                    <input type="hidden" id="store_email">
                    <input type="hidden" id="store_phone">
                    <button class="btn btn-primary" id="edit_user" type="submit"><i class="fa fa-save mr-1" style="margin-right:0.3rem"></i>Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Form Reset Close Model Edit -->
<script>
    function editModalclose(button) {
        $('#edit_fname').removeClass('is-invalid');
        $('#edit_fname-error').empty();
        $('#edit_lname').removeClass('is-invalid');
        $('#edit_lname-error').empty();
        $('#edit_suffix').removeClass('is-invalid');
        $('#edit_suffix-error').empty();
        $('#edit_gender').removeClass('is-invalid');
        $('#edit_gender-error').empty();
        $('#edit_birthday').removeClass('is-invalid');
        $('#edit_birthday-error').empty();
        $('#edit_civil_status').removeClass('is-invalid');
        $('#edit_civil_status-error').empty();
        $('#edit_email').removeClass('is-invalid');
        $('#edit_email-error').empty();
        $('#edit_phone').removeClass('is-invalid');
        $('#edit_phone-error').empty();
        $('#edit_role').removeClass('is-invalid');
        $('#edit_role-error').empty();
        $('#edit_status').removeClass('is-invalid');
        $('#edit_status-error').empty();
    }
</script>
<!-- JavaScript for Modal Edit -->
<script>
    function editModal(button) {
        // Redirect to the PHP file with the retrieved id as a query parameter
        document.getElementById("edit_user_id").value = button.getAttribute("data-edit_user_id");
        document.getElementById("edit_fname").value = button.getAttribute("data-edit_fname");
        document.getElementById("edit_mname").value = button.getAttribute("data-edit_mname");
        document.getElementById("edit_lname").value = button.getAttribute("data-edit_lname");
        document.getElementById("edit_suffix").value = button.getAttribute("data-edit_suffix");
        document.getElementById("edit_gender").value = button.getAttribute("data-edit_gender");
        document.getElementById("edit_birthday").value = button.getAttribute("data-edit_birthday");
        document.getElementById("edit_civil_status").value = button.getAttribute("data-edit_civil_status");
        document.getElementById("edit_email").value = button.getAttribute("data-edit_email");
        document.getElementById("store_email").value = button.getAttribute("data-edit_email");
        document.getElementById("edit_phone").value = button.getAttribute("data-edit_phone");
        document.getElementById("store_phone").value = button.getAttribute("data-edit_phone");
        document.getElementById("edit_role").value = button.getAttribute("data-edit_role");
        document.getElementById("edit_status").value = button.getAttribute("data-edit_status");
    }
</script>
<!-- Validation for edit_user -->
<script>
    $(document).ready(function() {
        // debounce functions for each input field
        var debouncedCheckedit_Fname = _.debounce(checkedit_Fname, 500);
        var debouncedCheckedit_Lname = _.debounce(checkedit_Lname, 500);
        var debouncedCheckedit_Suffix = _.debounce(checkedit_Suffix, 500);
        var debouncedCheckedit_Gender = _.debounce(checkedit_Gender, 500);
        var debouncedCheckedit_Birthday = _.debounce(checkedit_Birthday, 500);
        var debouncedCheckedit_Civilstatus = _.debounce(checkedit_Civilstatus, 500);
        var debouncedCheckedit_Email = _.debounce(checkedit_Email, 500);
        var debouncedCheckedit_Phone = _.debounce(checkedit_Phone, 500);
        var debouncedCheckedit_Role = _.debounce(checkedit_Role, 500);
        var debouncedCheckedit_Status = _.debounce(checkedit_Status, 500);

        // attach event listeners for each input field
        $('#edit_fname').on('input', debouncedCheckedit_Fname);
        $('#edit_lname').on('input', debouncedCheckedit_Lname);
        $('#edit_suffix').on('change', debouncedCheckedit_Suffix);
        $('#edit_gender').on('input', debouncedCheckedit_Gender);
        $('#edit_birthday').on('input', debouncedCheckedit_Birthday);
        $('#edit_civil_status').on('input', debouncedCheckedit_Civilstatus);
        $('#edit_email').on('blur', debouncedCheckedit_Email);
        $('#edit_phone').on('blur', debouncedCheckedit_Phone);
        $('#edit_role').on('change', debouncedCheckedit_Role);
        $('#edit_status').on('change', debouncedCheckedit_Status);

        // Trigger on input change
        $('#edit_fname').on('blur', debouncedCheckedit_Fname);
        $('#edit_lname').on('blur', debouncedCheckedit_Lname);
        $('#edit_suffix').on('blur', debouncedCheckedit_Suffix);
        $('#edit_gender').on('blur', debouncedCheckedit_Gender);
        $('#edit_birthday').on('blur', debouncedCheckedit_Birthday);
        $('#edit_civil_status').on('blur', debouncedCheckedit_Civilstatus);
        $('#edit_email').on('input', debouncedCheckedit_Email);
        $('#edit_phone').on('input', debouncedCheckedit_Phone);
        $('#edit_role').on('blur', debouncedCheckedit_Role);
        $('#edit_status').on('blur', debouncedCheckedit_Status);

        function checkIfAllFieldsValid() {
            // check if all input fields are valid and enable submit button if so
            if ($('#edit_fname-error').is(':empty') && $('#edit_lname-error').is(':empty') && $('#edit_suffix-error').is(':empty') && $('#edit_gender-error').is(':empty') && $('#edit_birthday-error').is(':empty') && $('#edit_civil_status-error').is(':empty') && $('#edit_email-error').is(':empty') && $('#edit_phone-error').is(':empty') && $('#edit_role-error').is(':empty')) {
                $('#edit_user').prop('disabled', false);
            } else {
                $('#edit_user').prop('disabled', true);
            }
        }

        function checkedit_Email() {
            var edit_email = $('#edit_email').val().trim();
            var initialEmail = $('#store_email').val().trim();; // Store the initial email
            // show error if edit_email is empty
            if (edit_email === '') {
                $('#edit_email-error').text('Please input email').css('color', 'red');
                $('#edit_email').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }

            // check if edit_email format is valid
            var edit_emailPattern = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/i;
            if (!edit_emailPattern.test(edit_email)) {
                $('#edit_email-error').text('Invalid email format').css('color', 'red');
                $('#edit_email').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // make AJAX call to check if email exists
            if (edit_email !== initialEmail) { // Check if email is different from the initial email
                $.ajax({
                    url: 'ajax.php', // replace with the actual URL to check email
                    method: 'POST', // use the appropriate HTTP method
                    data: {
                        email: edit_email,
                        validation: "1" // Identifier
                    },
                    success: function(response) {
                        if (response.exists) {
                            // disable submit button if edit_email is taken
                            $('#edit_user').prop('disabled', true);
                            $('#edit_email-error').text('Email already taken').css('color', 'red');
                            $('#edit_email').addClass('is-invalid');
                        } else {
                            $('#edit_email-error').empty();
                            $('#edit_email').removeClass('is-invalid');
                            // enable submit button if edit_email is valid
                            checkIfAllFieldsValid();
                        }
                    },
                    error: function() {
                        $('#edit_email-error').text('Error checking email');
                    }
                });
            } else {
                $('#edit_email-error').empty();
                $('#edit_email').removeClass('is-invalid');
                checkIfAllFieldsValid();
            }
        }

        function checkedit_Phone() {
            var edit_phone = $('#edit_phone').val().trim();
            var initialPhone = $('#store_phone').val().trim();; // Store the initial phone
            // show error if edit_phone number is empty
            if (edit_phone === '') {
                $('#edit_phone-error').text('Please input phone number').css('color', 'red');
                $('#edit_phone').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }

            // check if edit_phone number format is valid
            var edit_phoneNumberPattern = /^09[0-9]{9}$/;
            if (!edit_phoneNumberPattern.test(edit_phone)) {
                $('#edit_phone-error').text('Invalid phone number format').css('color', 'red');
                $('#edit_phone').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }

            // make AJAX call to check if phone number exists
            if (edit_phone !== initialPhone) { // Check if email is different from the initial email
                $.ajax({
                    url: 'ajax.php', // replace with the actual URL to check phone
                    method: 'POST', // use the appropriate HTTP method
                    data: {
                        phone: edit_phone,
                        validation: "1" // Identifier
                    },
                    success: function(response) {
                        if (response.exists) {
                            $('#edit_phone-error').text('Phone number already taken').css('color', 'red');
                            $('#edit_phone').addClass('is-invalid');
                            // disable submit button if edit_phone is taken
                            $('#edit_user').prop('disabled', true);
                        } else {
                            $('#edit_phone-error').empty();
                            $('#edit_phone').removeClass('is-invalid');
                            // enable submit button if edit_phone is valid
                            checkIfAllFieldsValid();
                        }
                    },
                    error: function() {
                        $('#edit_phone-error').text('Error checking phone number');
                    }
                });
            } else {
                $('#edit_phone-error').empty();
                $('#edit_phone').removeClass('is-invalid');
                checkIfAllFieldsValid();
            }
        }
        
        function checkedit_Fname() {
            var edit_fname = $('#edit_fname').val().trim();
            // show error if first name is empty
            if (edit_fname === '') {
                $('#edit_fname-error').text('Please input first name').css('color', 'red');
                $('#edit_fname').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }

            // Perform additional validation for first name if needed
            $('#edit_fname-error').empty();
            $('#edit_fname').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }
        
        function checkedit_Lname() {
            var edit_lname = $('#edit_lname').val().trim();
            // show error if last name is empty
            if (edit_lname === '') {
                $('#edit_lname-error').text('Please input last name').css('color', 'red');
                $('#edit_lname').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for last name if needed
            $('#edit_lname-error').empty();
            $('#edit_lname').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

        function checkedit_Suffix() {
            var edit_suffixSelect = document.getElementById('edit_suffix');
            var edit_suffix = edit_suffixSelect.value;
            // show error if the default option is selected
            if (edit_suffix === '' && edit_suffixSelect.selectedIndex !== 1) {
                $('#edit_suffix-error').text('Please select a suffix').css('color', 'red');
                $('#edit_suffix').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for suffix if needed
            $('#edit_suffix-error').empty();
            $('#edit_suffix').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

        function checkedit_Gender() {
            var edit_gender = $('#edit_gender').val()
            // show error if gender is empty
            if (!edit_gender || edit_gender.trim() === '') {
                $('#edit_gender-error').text('Please select gender').css('color', 'red');
                $('#edit_gender').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for gender if needed
            $('#edit_gender-error').empty();
            $('#edit_gender').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }
        
        function checkedit_Birthday() {
            var edit_birthday = $('#edit_birthday').val().trim();
            // show error if birthday is empty
            if (edit_birthday === '') {
                $('#edit_birthday-error').text('Please input birthday').css('color', 'red');
                $('#edit_birthday').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for birthday if needed
            $('#edit_birthday-error').empty();
            $('#edit_birthday').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

        function checkedit_Civilstatus() {
            var edit_civil_status = $('#edit_civil_status').val()
            // show error if civil status is empty
            if (!edit_civil_status || edit_civil_status.trim() === '') {
                $('#edit_civil_status-error').text('Please select civil status').css('color', 'red');
                $('#edit_civil_status').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for civil status if needed
            $('#edit_civil_status-error').empty();
            $('#edit_civil_status').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

        function checkedit_Role() {
            var edit_role = $('#edit_role').val()
            // show error if role is empty
            if (!edit_role || edit_role.trim() === '') {
                $('#edit_role-error').text('Please select role').css('color', 'red');
                $('#edit_role').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for role if needed
            $('#edit_role-error').empty();
            $('#edit_role').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

        function checkedit_Status() {
            var edit_status = $('#edit_status').val()
            // show error if status is empty
            if (!edit_status || edit_status.trim() === '') {
                $('#edit_status-error').text('Please select status').css('color', 'red');
                $('#edit_status').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for status if needed
            $('#edit_status-error').empty();
            $('#edit_status').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

    });
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
        // Add user
        $('#add_user_form').submit(function (e) {
            e.preventDefault(); // Prevent the default form submission
            var formData = new FormData(this);
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
                    $('#add_user_close').attr('disabled', 'disabled');
                },
                success: function(data) {
                    swal({
                        title: "Notice",
                        text: data.status,
                        icon: data.alert,
                        button: false,
                        timer: 2000
                    }).then(function() {
                        $('#btn_add_user').modal('hide');
                        $('#add_user_form')[0].reset();
                        $('#add_user').removeAttr('disabled');
                        $('#add_user_close').removeAttr('disabled');
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
        // Edit user
        $('#edit_user_form').submit(function (e) {
            e.preventDefault(); // Prevent the default form submission
            var formData = new FormData(this);
            formData.append('edit_user', '1'); // Identifier
            $.ajax({
                url: "ajax.php",
                method: "POST",
                data: formData,
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    $('#edit_user').attr('disabled', 'disabled');
                },
                success: function(data) {
                    swal({
                        title: "Notice",
                        text: data.status,
                        icon: data.alert,
                        button: false,
                        timer: 2000
                    }).then(function() {
                        $('#btn_edit_user').modal('hide');
                        $('#edit_user_form')[0].reset();
                        $('#edit_user').removeAttr('disabled');
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
            formData.append('delete_user', '1'); // Identifier
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