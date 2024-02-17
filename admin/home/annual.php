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
                <button class="btn btn-primary btn-icon-split btn-sm float-end" data-bs-toggle="modal" data-bs-target="#btn_add_dues"> 
                    <span class="icon text-white">
                        <i class="fas fa-user-plus"></i> Add Annual Dues
                    </span>
                </button>
                <button class="btn btn-primary btn-icon-split btn-sm float-end ml-1" id="resetColReorderBtn" style="margin-right: 7px">
                    <span class="icon text-white">    
                        <i class="fa fa-columns"></i>  Reset Column
                    </span>
                </button>
                <!-- <form action="ajax.php" method="post" name="export_excel" enctype="multipart/form-data" class="form-horizontal">
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
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    <!-- Ajax Tables -->
                    <script type="text/javascript">
                        $(document).ready(function() {
                            var dataTable = $('#dataTable').DataTable({
                                colReorder: true, // Enable column dragging
                                stateSave: true, // Enable state saving
                                processing: true,
                                serverSide: true,
                                serverMethod: 'post',
                                ajax: {
                                    url:'ajax.php',
                                    data: function (data) {
                                        data.dues_list = "1"; // Include the parameter in the AJAX request
                                    }
                                },
                                scrollX: true,
                                searchDelay: 86400000, // Disable Search or deley search 24hours
                                scrollCollapse: true, // Allow vertical scrollbar when necessary
                                columns: [
                                    { data: 'dues_id', className: 'text-center' },
                                    { data: 'id_number', className: 'text-center' },
                                    { data: 'fullname', className: 'text-center', },
                                    { data: 'gender', className: 'text-center' },
                                    { data: 'barangay', className: 'text-center' },
                                    { data: 'amount', className: 'text-center' },
                                    { data: 'year', className: 'text-center' },
                                    { data: 'new_date_paid', className: 'text-center' },
                                    {
                                        data: null,
                                        render: function(data, type, row, meta) {
                                            return '<div class="row d-flex" style="justify-content:space-evenly;">'+
                                            '<button class="btn btn-datatable btn-icon btn-transparent-dark" data-bs-toggle="modal" data-bs-target="#btn_edit_dues" data-edit_dues_id="' + data.dues_id + '" data-edit_user="' + data.user_id + '" data-edit_amount="' + data.amount + '" data-edit_year="' + data.year + '" data-edit_paid="' + data.date_paid + '" onclick="editModal(this)" title="Edit"><i class="fa fa-edit"></i></button>'+
                                            '<button class="btn btn-datatable btn-icon btn-transparent-dark" data-bs-toggle="modal" data-bs-target="#btn_delete_dues" data-delete_dues_id="' + data.dues_id + '" onclick="deleteModal(this)" title="Delete"><i class="fa fa-trash"></i></button>'+
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

                            // Function to reset column dragging
                            function resetColReorder() {
                                dataTable.colReorder.reset(); // Reset column dragging
                            }

                            // Bind click event to the reset button
                            $('#resetColReorderBtn').on('click', resetColReorder);
                        });
                    </script>
                </table>
            </div>
        </div>
    </div>
</main>

<!-- Modal for Add dues -->
<div class="modal fade" id="btn_add_dues" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="add_duesLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg d-grid" role="document" style="justify-items: center;">
        <div class="modal-content">
            <div class="modal-header card-header">
                <h5 class="modal-title" id="add_duesLabel">Add Annual Dues</h5>
                <button class="btn-close" type="button" id="add_dues_close" data-bs-dismiss="modal" aria-label="Close" onclick="addModalclose(this)"></button>
            </div>
            <form id="add_dues_form" method="POST" enctype="multipart/form-data"> 
                <div class="modal-body"> 
                    <div class="card mb-5">
                        <div class="card-header bg-teal">
                            <h5 class="text-white"><i class="far fa-user"></i> Annual Dues information</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <h6 class="mb-3"><sup class="text-red p-1">Note!</sup>Fields marked with <code class="text-red">*</code> are mandatory and <code class="text-green">*</code> are optional.</h6>
                                <?php
                                    $client = "SELECT user_id, CONCAT(fname, ' ', mname, ' ', lname, ' ', suffix) AS fullname FROM `user` WHERE user_type_id = '3'";
                                    $client_result = $con->query($client);
                                ?>
                                <!-- Select2 Example -->
                                <div class="container-fluid mb-4">
                                    <label for="add_senior" class="d-block required">Select User</label>
                                    <select class="select2" class="form-control" id="add_senior" name="add_senior" style="width: 100%;" required>
                                        <option value="">Select Senior</option>
                                        <?php 
                                            if ($client_result->num_rows > 0) {
                                            while($clientrow = $client_result->fetch_assoc()) {
                                        ?>
                                        <option value="<?=$clientrow['user_id'];?>"><?=$clientrow['fullname'];?></option>
                                        <?php } } ?>
                                    </select>
                                    <div id="add_senior-error"></div>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <label for="add_amount" class="required">Amount</label>
                                    <input type="number" id="add_amount" name="add_amount" placeholder="Enter Amount" class="form-control" required>
                                    <div id="add_amount-error"></div>
                                </div>
                            
                                <div class="col-md-4 mb-4">
                                    <label for="add_year" class="required">Year</label>
                                    <input type="number" class="form-control" id="add_year" placeholder="Enter Year" name="add_year" min="1900" max="2100" required>
                                    <div id="add_year-error"></div>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <label for="add_paid" class="required">Date Paid</label>
                                    <input type="date" class="form-control" id="add_paid" name="add_paid" required>
                                    <div id="add_paid-error"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id="add_dues" type="submit"><i class="fa fa-plus mr-1" style="margin-right:0.3rem"></i>Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Initialize Select2 -->
<script>
    $(document).ready(function() {
        // Ensure that Select2 is initialized after the modal is shown
        $('#btn_add_dues').on('shown.bs.modal', function () {
            $('.select2').select2({
                dropdownParent: $('#btn_add_dues') // Set the dropdown parent to the modal
            });
        });
    });
</script>

<!-- Form Reset Close Model Add -->
<script>
    function addModalclose(button) {
        $('#add_senior').removeClass('is-invalid');
        $('#add_senior-error').empty();
        $('#add_amount').removeClass('is-invalid');
        $('#add_amount-error').empty();
        $('#add_year').removeClass('is-invalid');
        $('#add_year-error').empty();
        $('#add_paid').removeClass('is-invalid');
        $('#add_paid-error').empty();
    }
</script>
<!-- Validation for add_user -->
<script>
    $(document).ready(function() {
        // debounce functions for each input field
        var debouncedCheckadd_User = _.debounce(checkadd_User, 500);
        var debouncedCheckadd_Amount = _.debounce(checkadd_Amount, 500);
        var debouncedCheckadd_Year = _.debounce(checkadd_Year, 500);
        var debouncedCheckadd_Paid = _.debounce(checkadd_Paid, 500);

        // attach event listeners for each input field
        $('#add_senior').on('input', debouncedCheckadd_User);
        $('#add_amount').on('input', debouncedCheckadd_Amount);
        $('#add_year').on('change', debouncedCheckadd_Year);
        $('#add_paid').on('input', debouncedCheckadd_Paid);

        // Trigger on input change
        $('#add_senior').on('blur', debouncedCheckadd_User);
        $('#add_amount').on('blur', debouncedCheckadd_Amount);
        $('#add_year').on('blur', debouncedCheckadd_Year);
        $('#add_paid').on('blur', debouncedCheckadd_Paid);

        function checkIfAllFieldsValid() {
            // check if all input fields are valid and enable submit button if so
            if ($('#add_senior-error').is(':empty') && $('#add_amount-error').is(':empty') && $('#add_year-error').is(':empty') && $('#add_paid-error').is(':empty')) {
                $('#add_dues').prop('disabled', false);
            } else {
                $('#add_dues').prop('disabled', true);
            }
        }
        
        function checkadd_User() {
            var add_senior = $('#add_senior').val().trim();
            // show error if name is empty
            if (add_senior === '') {
                $('#add_senior-error').text('Please select senior').css('color', 'red');
                $('#add_senior').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }

            // Perform additional validation for name if needed
            $('#add_senior-error').empty();
            $('#add_senior').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }
        
        function checkadd_Amount() {
            var add_amount = $('#add_amount').val().trim();
            // show error if amount is empty
            if (add_amount === '') {
                $('#add_amount-error').text('Please input amount').css('color', 'red');
                $('#add_amount').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for amount if needed
            $('#add_amount-error').empty();
            $('#add_amount').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

        function checkadd_Year() {
            var add_year = $('#add_year').val()
            // show error if year is empty
            if (!add_year || add_year.trim() === '') {
                $('#add_year-error').text('Please input year').css('color', 'red');
                $('#add_year').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for year if needed
            $('#add_year-error').empty();
            $('#add_year').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }
        
        function checkadd_Paid() {
            var add_paid = $('#add_paid').val().trim();
            // show error if paid is empty
            if (add_paid === '') {
                $('#add_paid-error').text('Please input date paid').css('color', 'red');
                $('#add_paid').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for paid if needed
            $('#add_paid-error').empty();
            $('#add_paid').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }
    });
</script>

<!-- Modal for Edit dues -->
<div class="modal fade" id="btn_edit_dues" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="edit_duesLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg d-grid" role="document" style="justify-items: center;">
        <div class="modal-content">
            <div class="modal-header card-header">
                <h5 class="modal-title" id="edit_duesLabel">Edit Annual Dues</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" onclick="editModalclose(this)"></button>
            </div>
            <form id="edit_dues_form" method="POST" enctype="multipart/form-data"> 
                <div class="modal-body"> 
                    <div class="card mb-4">
                        <div class="card-header bg-teal">
                            <h5 class="text-white"><i class="far fa-user"></i> Annual Dues information</h5>
                        </div>
                        <div class="card-body">
                            <div class="row"> 
                                <h6 class="mb-3"><sup class="text-red p-1">Note!</sup>Fields marked with <code class="text-red">*</code> are mandatory and <code class="text-green">*</code> are optional.</h6>
                                <?php
                                    $client1 = "SELECT user_id, CONCAT(fname, ' ', mname, ' ', lname, ' ', suffix) AS fullname FROM `user` WHERE user_type_id = '3'";
                                    $client_result1 = $con->query($client1);
                                ?>
                                <!-- Select2 Example -->
                                <div class="container-fluid mb-4">
                                    <label for="edit_senior" class="d-block required">Select User</label>
                                    <select class="select3" class="form-control" id="edit_senior" name="edit_senior" style="width: 100%;" required>
                                        <option value="">Select Senior</option>
                                        <?php 
                                            if ($client_result1->num_rows > 0) {
                                            while($clientrow1 = $client_result1->fetch_assoc()) {
                                        ?>
                                        <option value="<?=$clientrow1['user_id'];?>"><?=$clientrow1['fullname'];?></option>
                                        <?php } } ?>
                                    </select>
                                    <div id="edit_senior-error"></div>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <label for="edit_amount" class="required">Amount</label>
                                    <input required placeholder="Enter Amount" type="number" id="edit_amount" name="edit_amount" class="form-control">
                                    <div id="edit_amount-error"></div>
                                </div> 

                                <div class="col-md-4 mb-4">
                                    <label for="edit_year" class="required">Last Name</label>
                                    <input required placeholder="Enter Year" type="number" id="edit_year" name="edit_year" min="1900" max="2100" class="form-control">
                                    <div id="edit_year-error"></div>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <label for="edit_paid" class="required">Date Paid</label>
                                    <input required class="form-control" id="edit_paid" name="edit_paid" placeholder="MM/DD/YYYY" type="date"/>
                                    <div id="edit_paid-error"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="edit_dues_id" name="edit_dues_id">
                    <button class="btn btn-primary" id="edit_dues" type="submit"><i class="fa fa-save mr-1" style="margin-right:0.3rem"></i>Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Initialize Select2 -->
<script>
    $(document).ready(function() {
        // Ensure that Select2 is initialized after the modal is shown
        $('#btn_edit_dues').on('shown.bs.modal', function () {
            $('.select3').select2({
                dropdownParent: $('#btn_edit_dues') // Set the dropdown parent to the modal
            });
        });
    });
</script>
<!-- Form Reset Close Model Edit -->
<script>
    function editModalclose(button) {
        $('#edit_senior').removeClass('is-invalid');
        $('#edit_senior-error').empty();
        $('#edit_amount').removeClass('is-invalid');
        $('#edit_amount-error').empty();
        $('#edit_year').removeClass('is-invalid');
        $('#edit_year-error').empty();
        $('#edit_paid').removeClass('is-invalid');
        $('#edit_paid-error').empty();
    }
</script>
<!-- JavaScript for Modal Edit -->
<script>
    function editModal(button) {
        // Redirect to the PHP file with the retrieved id as a query parameter
        document.getElementById("edit_dues_id").value = button.getAttribute("data-edit_dues_id");
        document.getElementById("edit_senior").value = button.getAttribute("data-edit_user");
        document.getElementById("edit_amount").value = button.getAttribute("data-edit_amount");
        document.getElementById("edit_year").value = button.getAttribute("data-edit_year");
        document.getElementById("edit_paid").value = button.getAttribute("data-edit_paid");
    }
</script>
<!-- Validation for edit_user -->
<script>
    $(document).ready(function() {
        // debounce functions for each input field
        var debouncedCheckedit_User = _.debounce(checkedit_User, 500);
        var debouncedCheckedit_Amount = _.debounce(checkedit_Amount, 500);
        var debouncedCheckedit_Year = _.debounce(checkedit_Year, 500);
        var debouncedCheckedit_Paid = _.debounce(checkedit_Paid, 500);

        // attach event listeners for each input field
        $('#edit_senior').on('input', debouncedCheckedit_User);
        $('#edit_amount').on('input', debouncedCheckedit_Amount);
        $('#edit_year').on('change', debouncedCheckedit_Year);
        $('#edit_paid').on('input', debouncedCheckedit_Paid);

        // Trigger on input change
        $('#edit_senior').on('blur', debouncedCheckedit_User);
        $('#edit_amount').on('blur', debouncedCheckedit_Amount);
        $('#edit_year').on('blur', debouncedCheckedit_Year);
        $('#edit_paid').on('blur', debouncedCheckedit_Paid);

        function checkIfAllFieldsValid() {
            // check if all input fields are valid and enable submit button if so
            if ($('#edit_senior-error').is(':empty') && $('#edit_amount-error').is(':empty') && $('#edit_year-error').is(':empty') && $('#edit_paid-error').is(':empty')) {
                $('#edit_dues').prop('disabled', false);
            } else {
                $('#edit_dues').prop('disabled', true);
            }
        }

        function checkedit_User() {
            var edit_senior = $('#edit_senior').val().trim();
            // show error if name is empty
            if (edit_senior === '') {
                $('#edit_senior-error').text('Please select senior').css('color', 'red');
                $('#edit_senior').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }

            // Perform additional validation for name if needed
            $('#edit_senior-error').empty();
            $('#edit_senior').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }
        
        function checkedit_Amount() {
            var edit_amount = $('#edit_amount').val().trim();
            // show error if amount is empty
            if (edit_amount === '') {
                $('#edit_amount-error').text('Please input amount').css('color', 'red');
                $('#edit_amount').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for amount if needed
            $('#edit_amount-error').empty();
            $('#edit_amount').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

        function checkedit_Year() {
            var edit_year = $('#edit_year').val()
            // show error if year is empty
            if (!edit_year || edit_year.trim() === '') {
                $('#edit_year-error').text('Please input year').css('color', 'red');
                $('#edit_year').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for year if needed
            $('#edit_year-error').empty();
            $('#edit_year').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }
        
        function checkedit_Paid() {
            var edit_paid = $('#edit_paid').val().trim();
            // show error if paid is empty
            if (edit_paid === '') {
                $('#edit_paid-error').text('Please input date paid').css('color', 'red');
                $('#edit_paid').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for paid if needed
            $('#edit_paid-error').empty();
            $('#edit_paid').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }
    });
</script>

<!-- Modal for Delete dues -->
<div class="modal fade" id="btn_delete_dues" tabindex="-1" role="dialog" aria-labelledby="delete_duesLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delete_duesLabel">Delete Annual Dues</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">Are you sure you want to delete this annual dues <b><span id="label"></span></b></div>
            <div class="modal-footer">
                <form id="delete_dues_form" method="POST"  enctype="multipart/form-data">
                    <input type="hidden" id="delete_dues_id" name="delete_dues_id">
                    <button type="submit" id="delete_dues" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- JavaScript for Modal Delete -->
<script>
    function deleteModal(button) {
        // Redirect to the PHP file with the retrieved id as a query parameter
        document.getElementById("delete_dues_id").value = button.getAttribute("data-delete_dues_id");
        document.getElementById("label").innerHTML = button.getAttribute("data-delete_dues_id");
    }
</script>
<script type="text/javascript">
    $(document).ready(function() {
        // Add dues
        $('#add_dues_form').submit(function (e) {
            e.preventDefault(); // Prevent the default form submission
            var formData = new FormData(this);
            formData.append('add_dues', '1'); // Identifier
            $.ajax({
                url: "ajax.php",
                method: "POST",
                data: formData,
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    $('#add_dues').attr('disabled', 'disabled');
                    $('#add_dues_close').attr('disabled', 'disabled');
                },
                success: function(data) {
                    swal({
                        title: "Notice",
                        text: data.status,
                        icon: data.alert,
                        button: false,
                        timer: 2000
                    }).then(function() {
                        $('#btn_add_dues').modal('hide');
                        $('#add_dues_form')[0].reset();
                        $('#add_dues').removeAttr('disabled');
                        $('#add_dues_close').removeAttr('disabled');
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
        // Edit dues
        $('#edit_dues_form').submit(function (e) {
            e.preventDefault(); // Prevent the default form submission
            var formData = new FormData(this);
            formData.append('edit_dues', '1'); // Identifier
            $.ajax({
                url: "ajax.php",
                method: "POST",
                data: formData,
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    $('#edit_dues').attr('disabled', 'disabled');
                },
                success: function(data) {
                    swal({
                        title: "Notice",
                        text: data.status,
                        icon: data.alert,
                        button: false,
                        timer: 2000
                    }).then(function() {
                        $('#btn_edit_dues').modal('hide');
                        $('#edit_dues_form')[0].reset();
                        $('#edit_dues').removeAttr('disabled');
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
        // Delete dues
        $('#delete_dues').click(function() {
            var formData = new FormData($('#delete_dues_form')[0]);
            formData.append('delete_dues', '1'); // Identifier
            $.ajax({
                url: "ajax.php",
                method: "POST",
                data: formData,
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    $('#delete_dues').attr('disabled', 'disabled');
                },
                success: function(data) {
                    swal({
                        title: "Notice",
                        text: data.status,
                        icon: data.alert,
                        button: false,
                        timer: 2000
                    }).then(function() {
                        $('#btn_delete_dues').modal('hide');
                        $('#delete_dues_form')[0].reset();
                        $('#delete_dues').removeAttr('disabled');
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