<?php include ('../includes/header.php'); ?>
<head>
    <!-- Website Title -->
    <title><?= $system['shortname'] ?> | Announcement</title>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
</head>
<main>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-5">
        <nav class="rounded bg-gray-200 mb-4" aria-label="breadcrumb">
            <ol class="breadcrumb px-3 py-2 rounded mb-0">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="../home">Home</a></li>
                <li class="breadcrumb-item active">Announcement</li>
            </ol>
        </nav>
        <div class="card mb-4">
            <div class="card-header text-white bg-teal">Announcements Table
                <button class="btn btn-primary btn-icon-split btn-sm float-end" data-bs-toggle="modal" data-bs-target="#btn_add_ann"> 
                    <span class="icon text-white">
                        <i class="fa fa-rss"></i> Add Announcement
                    </span>
                </button>
                <button class="btn btn-primary btn-icon-split btn-sm float-end ml-1" id="resetColReorderBtn" style="margin-right: 7px">
                    <span class="icon text-white">    
                        <i class="fa fa-columns"></i>  Reset Column
                    </span>
                </button>
            </div>
            <div class="card-body">
                <table id="dataTable" class="display cell-border stripe table table-bordered dataTable no-footer" style="width:99% !important">
                    <thead>
                        <tr>
                            <th width="10%">No.</th>
                            <th width="25%">Title</th>
                            <th width="40%">Body</th>
                            <th width="15%">Status</th>
                            <th width="10%">Actions</th>
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
                                        data.ann_list = "1"; // Include the parameter in the AJAX request
                                    }
                                },
                                scrollX: true,
                                searchDelay: 86400000, // Disable Search or deley search 24hours
                                scrollCollapse: true, // Allow vertical scrollbar when necessary
                                columns: [
                                    { data: 'ann_id', className: 'text-center' },
                                    { data: 'ann_title', className: 'text-center', },
                                    { data: 'ann_description', className: 'text-center' },
                                    { data: 'ann_status', className: 'text-center' },
                                    {
                                        data: null,
                                        render: function(data, type, row, meta) {
                                            return '<div class="row d-flex" style="justify-content:space-evenly;">'+
                                            '<button class="btn btn-datatable btn-icon btn-transparent-dark" data-bs-toggle="modal" data-bs-target="#btn_view_ann" data-view_ann_title="' + data.ann_title + '" data-view_ann_description="' + data.ann_description + '" data-view_ann_status="' + data.ann_status + '" onclick="viewModal(this)" title="View"><i class="fa fa-eye"></i></button>'+
                                            '<button class="btn btn-datatable btn-icon btn-transparent-dark" data-bs-toggle="modal" data-bs-target="#btn_edit_ann" data-edit_ann_id="' + data.ann_id + '" data-edit_ann_title="' + data.ann_title + '" data-edit_ann_description="' + data.add_description + '" data-edit_status="' + data.ann_status + '" onclick="editModal(this)" title="Edit"><i class="fa fa-edit"></i></button>'+
                                            '<button class="btn btn-datatable btn-icon btn-transparent-dark" data-bs-toggle="modal" data-bs-target="#btn_delete_ann" data-delete_ann_id="' + data.ann_id + '" data-delete_ann_title="' + data.ann_title + '" onclick="deleteModal(this)" title="Delete"><i class="fa fa-trash"></i></button>'+
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

<!-- Modal for Add announcement -->
<div class="modal fade" id="btn_add_ann" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="add_annLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg d-grid" role="document" style="justify-items: center;">
        <div class="modal-content">
            <div class="modal-header card-header">
                <h5 class="modal-title" id="add_annLabel">Add announcement</h5>
                <button class="btn-close" type="button" id="add_ann_close" data-bs-dismiss="modal" aria-label="Close" onclick="addModalclose(this)"></button>
            </div>
            <form id="add_ann_form" method="POST" enctype="multipart/form-data"> 
                <div class="modal-body"> 
                    <div class="card mb-4">
                        <div class="card-header bg-teal">
                            <h5 class="text-white"><i class="fa fa-rss"></i> Announcement information</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <h6 class="mb-3"><sup class="text-red p-1">Note!</sup>Fields marked with <code class="text-red">*</code> are mandatory and <code class="text-green">*</code> are optional.</h6>
                                <div class="col-md-12 mb-3">
                                    <label for="add_title" class="required">Title</label>
                                    <input required placeholder="Enter Announcement Title" type="text" id="add_title" name="add_title" class="form-control">
                                    <div id="add_title-error"></div>
                                </div> 
                            
                                <div class="col-md-12 mb-3">
                                    <label for="add_description" class="required">Body</label>
                                    <textarea placeholder="Enter Announcement Body" type="text" id="add_description" rows="10" name="add_description" class="form-control"></textarea>
                                    <div id="add_description-error"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="add_status" class="required">Status</label>
                                    <select id="add_status" name="add_status" required class="form-control">
                                        <option value="" selected>Select Status</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Posted">Posted</option>
                                    </select>
                                    <div id="add_status-error"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id="add_ann" type="submit"><i class="fa fa-plus mr-1" style="margin-right:0.3rem"></i>Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Form Reset Close Model Add -->
<script>
    function addModalclose(button) {
        $('#add_title').removeClass('is-invalid');
        $('#add_title-error').empty();
        $('#add_description').removeClass('is-invalid');
        $('#add_description-error').empty();
        $('#add_status').removeClass('is-invalid');
        $('#add_status-error').empty();
    }
</script>
<!-- Validation for add_ann -->
<script>
    $(document).ready(function() {
        // debounce functions for each input field
        var debouncedCheckadd_Title = _.debounce(checkadd_Title, 500);
        var debouncedCheckadd_Description = _.debounce(checkadd_Description, 500);
        var debouncedCheckadd_Status = _.debounce(checkadd_Status, 500);

        // attach event listeners for each input field
        $('#add_title').on('input', debouncedCheckadd_Title);
        $('#add_description').on('input', debouncedCheckadd_Description);
        $('#add_status').on('change', debouncedCheckadd_Status);

        // Trigger on input change
        $('#add_title').on('blur', debouncedCheckadd_Title);
        $('#add_description').on('blur', debouncedCheckadd_Description);
        $('#add_status').on('blur', debouncedCheckadd_Status);

        function checkIfAllFieldsValid() {
            // check if all input fields are valid and enable submit button if so
            if ($('#add_title-error').is(':empty') && $('#add_description-error').is(':empty') && $('#add_status-error').is(':empty')) {
                $('#add_ann').prop('disabled', false);
            } else {
                $('#add_ann').prop('disabled', true);
            }
        }
        
        function checkadd_Title() {
            var add_title = $('#add_title').val().trim();
            // show error if ann title is empty
            if (add_title === '') {
                $('#add_title-error').text('Please input title').css('color', 'red');
                $('#add_title').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }

            // Perform additional validation for ann title if needed
            $('#add_title-error').empty();
            $('#add_title').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }
        
        function checkadd_Description() {
            var add_description = $('#add_description').val().trim();
            // show error if ann description is empty
            if (add_description === '') {
                $('#add_description-error').text('Please input body').css('color', 'red');
                $('#add_description').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for ann description if needed
            $('#add_description-error').empty();
            $('#add_description').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

        function checkadd_Status() {
            var add_status = $('#add_status').val()
            // show error if ann status is empty
            if (!add_status || add_status.trim() === '') {
                $('#add_status-error').text('Please select status').css('color', 'red');
                $('#add_status').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for ann status if needed
            $('#add_status-error').empty();
            $('#add_status').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }
    });
</script>

<!-- Modal for View announcement -->
<div class="modal fade" id="btn_view_ann" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="view_annLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg d-grid" role="document" style="justify-items: center;">
        <div class="modal-content">
            <div class="modal-header card-header">
                <h5 class="modal-title" id="view_annLabel">View announcement</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div> 
            <div class="modal-body"> 
                <div class="card mb-4">
                    <div class="card-header bg-teal">
                        <h5 class="text-white"><i class="fa fa-rss"></i> Announcement information</h5>
                    </div>
                    <div class="card-body">
                        <div class="row"> 
                            <div class="col-md-12 mb-3">
                                <label for="view_title">Title</label>
                                <input disabled type="text" id="view_title" class="form-control">
                            </div> 
                        
                            <div class="col-md-12 mb-3">
                                <label for="view_description">Body</label>
                                <textarea disabled type="text" id="view_description" rows="10" class="form-control"></textarea>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="view_status">Status</label>
                                <input disabled type="text" id="view_status" class="form-control">
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
        document.getElementById("view_title").value = button.getAttribute("data-view_ann_title");
        document.getElementById("view_description").value = button.getAttribute("data-view_ann_description");
        document.getElementById("view_status").value = button.getAttribute("data-view_ann_status");
    }
</script>

<!-- Modal for Edit announcement -->
<div class="modal fade" id="btn_edit_ann" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="edit_annLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg d-grid" role="document" style="justify-items: center;">
        <div class="modal-content">
            <div class="modal-header card-header">
                <h5 class="modal-title" id="edit_annLabel">Edit announcement</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" onclick="editModalclose(this)"></button>
            </div>
            <form id="edit_ann_form" method="POST" enctype="multipart/form-data"> 
                <div class="modal-body"> 
                    <div class="card mb-4">
                        <div class="card-header bg-teal">
                            <h5 class="text-white"><i class="fa fa-rss"></i> Announcement information</h5>
                        </div>
                        <div class="card-body">
                            <div class="row"> 
                                <h6 class="mb-3"><sup class="text-red p-1">Note!</sup>Fields marked with <code class="text-red">*</code> are mandatory and <code class="text-green">*</code> are optional.</h6>
                                <div class="col-md-12 mb-3">
                                    <label for="edit_title" class="required">Title</label>
                                    <input required placeholder="Enter Announcement Title" type="text" id="edit_title" name="edit_title" class="form-control">
                                    <div id="edit_title-error"></div>
                                </div> 
                            
                                <div class="col-md-12 mb-3">
                                    <label for="edit_description" class="required">Body</label>
                                    <textarea placeholder="Enter Announcement Body" type="text" id="edit_description" name="edit_description" rows="10" class="form-control"></textarea>
                                    <div id="edit_description-error"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="edit_status" class="required">Status</label>
                                    <select id="edit_status" name="edit_status" required class="form-control">
                                        <option value="" selected>Select Status</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Posted">Posted</option>
                                    </select>
                                    <div id="edit_status-error"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="edit_ann_id" name="edit_ann_id">
                    <button class="btn btn-primary" id="edit_user" type="submit"><i class="fa fa-save mr-1" style="margin-right:0.3rem"></i>Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Form Reset Close Model Edit -->
<script>
    function editModalclose(button) {
        $('#edit_title').removeClass('is-invalid');
        $('#edit_title-error').empty();
        $('#edit_description').removeClass('is-invalid');
        $('#edit_description-error').empty();
        $('#edit_status').removeClass('is-invalid');
        $('#edit_status-error').empty();
    }
</script>
<!-- JavaScript for Modal Edit -->
<script>
    function editModal(button) {
        // Redirect to the PHP file with the retrieved id as a query parameter
        document.getElementById("edit_ann_id").value = button.getAttribute("data-edit_ann_id");
        document.getElementById("edit_title").value = button.getAttribute("data-edit_ann_title");
        document.getElementById("edit_description").value = button.getAttribute("data-edit_ann_description");
        document.getElementById("edit_status").value = button.getAttribute("data-edit_ann_status");
    }
</script>
<!-- Validation for edit_ann -->
<script>
    $(document).ready(function() {
        // debounce functions for each input field
        var debouncedCheckedit_Title = _.debounce(checkedit_Title, 500);
        var debouncedCheckedit_Description = _.debounce(checkedit_Description, 500);
        var debouncedCheckedit_Status = _.debounce(checkedit_Status, 500);

        // attach event listeners for each input field
        $('#edit_title').on('input', debouncedCheckedit_Title);
        $('#edit_description').on('input', debouncedCheckedit_Description);
        $('#edit_status').on('change', debouncedCheckedit_Status);

        // Trigger on input change
        $('#edit_title').on('blur', debouncedCheckedit_Title);
        $('#edit_description').on('blur', debouncedCheckedit_Description);
        $('#edit_status').on('blur', debouncedCheckedit_Status);

        function checkIfAllFieldsValid() {
            // check if all input fields are valid and enable submit button if so
            if ($('#edit_title-error').is(':empty') && $('#edit_description-error').is(':empty') && $('#edit_status-error').is(':empty')) {
                $('#edit_ann').prop('disabled', false);
            } else {
                $('#edit_ann').prop('disabled', true);
            }
        }
        
        function checkedit_Title() {
            var edit_title = $('#edit_title').val().trim();
            // show error if ann title is empty
            if (edit_title === '') {
                $('#edit_title-error').text('Please input title').css('color', 'red');
                $('#edit_title').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }

            // Perform additional validation for ann title if needed
            $('#edit_title-error').empty();
            $('#edit_title').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }
        
        function checkedit_Description() {
            var edit_description = $('#edit_description').val().trim();
            // show error if ann description is empty
            if (edit_description === '') {
                $('#edit_description-error').text('Please input body').css('color', 'red');
                $('#edit_description').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for ann description if needed
            $('#edit_description-error').empty();
            $('#edit_description').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

        function checkedit_Status() {
            var edit_status = $('#edit_status').val()
            // show error if ann status is empty
            if (!edit_status || edit_status.trim() === '') {
                $('#edit_status-error').text('Please select status').css('color', 'red');
                $('#edit_status').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for ann status if needed
            $('#edit_status-error').empty();
            $('#edit_status').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }
    });
</script>

<!-- Modal for Delete announcement -->
<div class="modal fade" id="btn_delete_ann" tabindex="-1" role="dialog" aria-labelledby="delete_annLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delete_annLabel">Delete announcement</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">Are you sure you want to delete this announcement <b><span id="label"></span></b></div>
            <div class="modal-footer">
                <form id="delete_ann_form" method="POST"  enctype="multipart/form-data">
                    <input type="hidden" id="delete_ann_id" name="delete_ann_id">
                    <button type="submit" id="delete_ann" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- JavaScript for Modal Delete -->
<script>
    function deleteModal(button) {
        // Redirect to the PHP file with the retrieved id as a query parameter
        document.getElementById("delete_ann_id").value = button.getAttribute("data-delete_ann_id");
        document.getElementById("label").innerHTML = button.getAttribute("data-delete_ann_title");
    }
</script>
<script type="text/javascript">
    $(document).ready(function() {
        // Add ann
        $('#add_ann_form').submit(function (e) {
            e.preventDefault(); // Prevent the default form submission
            var formData = new FormData(this);
            formData.append('add_ann', '1'); // Identifier
            $.ajax({
                url: "ajax.php",
                method: "POST",
                data: formData,
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    $('#add_ann').attr('disabled', 'disabled');
                    $('#add_ann_close').attr('disabled', 'disabled');
                },
                success: function(data) {
                    swal({
                        title: "Notice",
                        text: data.status,
                        icon: data.alert,
                        button: false,
                        timer: 2000
                    }).then(function() {
                        $('#btn_add_ann').modal('hide');
                        $('#add_ann_form')[0].reset();
                        $('#add_ann').removeAttr('disabled');
                        $('#add_ann_close').removeAttr('disabled');
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
        // Edit ann
        $('#edit_ann_form').submit(function (e) {
            e.preventDefault(); // Prevent the default form submission
            var formData = new FormData(this);
            formData.append('edit_ann', '1'); // Identifier
            $.ajax({
                url: "ajax.php",
                method: "POST",
                data: formData,
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    $('#edit_ann').attr('disabled', 'disabled');
                },
                success: function(data) {
                    swal({
                        title: "Notice",
                        text: data.status,
                        icon: data.alert,
                        button: false,
                        timer: 2000
                    }).then(function() {
                        $('#btn_edit_ann').modal('hide');
                        $('#edit_ann_form')[0].reset();
                        $('#edit_ann').removeAttr('disabled');
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
        // Delete ann
        $('#delete_ann').click(function() {
            var formData = new FormData($('#delete_ann_form')[0]);
            formData.append('delete_ann', '1'); // Identifier
            $.ajax({
                url: "ajax.php",
                method: "POST",
                data: formData,
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    $('#delete_ann').attr('disabled', 'disabled');
                },
                success: function(data) {
                    swal({
                        title: "Notice",
                        text: data.status,
                        icon: data.alert,
                        button: false,
                        timer: 2000
                    }).then(function() {
                        $('#btn_delete_ann').modal('hide');
                        $('#delete_ann_form')[0].reset();
                        $('#delete_ann').removeAttr('disabled');
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