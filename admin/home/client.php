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
                <button class="btn btn-primary btn-icon-split btn-sm float-end" data-bs-toggle="modal" data-bs-target="#btn_add_client"> 
                    <span class="icon text-white">
                        <i class="fas fa-user-plus"></i> Add Senior Citizen Account
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
                            <th>Age</th>
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
                                    { data: 'fullname', className: 'text-center', },
                                    { data: 'gender', className: 'text-center' },
                                    { data: 'newbirthday', className: 'text-center' },
                                    { data: 'age', className: 'text-center' },
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
                                            '<button class="btn btn-datatable btn-icon btn-transparent-dark" data-bs-toggle="modal" data-bs-target="#btn_view_client" data-view_fname="' + data.fname + '" data-view_mname="' + data.mname + '" data-view_lname="' + data.lname + '" data-view_suffix="' + data.suffix + '" data-view_gender="' + data.gender + '" data-view_birthday="' + data.newbirthday + '" data-view_barangay="' + data.barangay + '" data-view_date_issued="' + data.newdateissued + '" data-view_rrn="' + data.rrn + '" data-view_soc_pen="' + data.soc_pen + '" data-view_gsis="' + data.gsis + '" data-view_sss="' + data.sss + '" data-view_pvao="' + data.pvao + '" data-view_sup_with="' + data.sup_with + '" data-view_4ps="' + data.fourps + '" data-view_nhts="' + data.nhts + '" data-view_id_file="' + data.id_file + '" data-view_status="' + data.user_status_id + '" onclick="viewModal(this)" title="View"><i class="fa fa-eye"></i></button>'+
                                            '<button class="btn btn-datatable btn-icon btn-transparent-dark" data-bs-toggle="modal" data-bs-target="#btn_edit_client" data-edit_client_id="' + data.user_id + '" data-edit_fname="' + data.fname + '" data-edit_mname="' + data.mname + '" data-edit_lname="' + data.lname + '" data-edit_suffix="' + data.suffix + '" data-edit_gender="' + data.gender + '" data-edit_birthday="' + data.birthday + '" data-edit_barangay="' + data.barangay + '" data-edit_date_issued="' + data.dateissued + '" data-edit_rrn="' + data.rrn + '" data-edit_soc_pen="' + data.soc_pen + '" data-edit_gsis="' + data.gsis + '" data-edit_sss="' + data.sss + '" data-edit_pvao="' + data.pvao + '" data-edit_sup_with="' + data.sup_with + '" data-edit_4ps="' + data.fourps + '" data-edit_nhts="' + data.nhts + '" data-edit_id_file="' + data.id_file + '" data-edit_status="' + data.user_status_id + '" onclick="editModal(this)" title="Edit"><i class="fa fa-edit"></i></button>'+
                                            '<button class="btn btn-datatable btn-icon btn-transparent-dark" data-bs-toggle="modal" data-bs-target="#btn_delete_client" data-delete_client_id="' + data.user_id + '" data-delete_fname="' + data.fname + '" data-delete_mname="' + data.mname + '" data-delete_lname="' + data.lname + '" data-delete_suffix="' + data.suffix + '" onclick="deleteModal(this)" title="Delete"><i class="fa fa-trash"></i></button>'+
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

<!-- Modal for Add client -->
<div class="modal fade" id="btn_add_client" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="add_clientLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg d-grid" role="document" style="justify-items: center;">
        <div class="modal-content">
            <div class="modal-header card-header">
                <h5 class="modal-title" id="add_clientLabel">Add Senior Citizen</h5>
                <button class="btn-close" type="button" id="add_client_close" data-bs-dismiss="modal" aria-label="Close" onclick="addModalclose(this)"></button>
            </div>
            <form id="add_client_form"> 
                <div class="modal-body"> 
                    <div class="card mb-4">
                        <div class="card-header bg-teal">
                            <h5 class="text-white"><i class="far fa-user"></i> Senior Citizen information</h5>
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
                                    <label for="add_birthday" class="required">Birthday</label>
                                    <input required class="form-control" id="add_birthday" name="add_birthday" pattern="\d{2} \d{2} \d{4}" placeholder="MM/DD/YYYY" type="date"/>
                                    <div id="add_birthday-error"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="add_barangay" class="required">Barangay</label>
                                    <select id="add_barangay" name="add_barangay" required class="form-control">
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
                                    <div id="add_barangay-error"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="add_date_issued" class="required">Date Issued</label>
                                    <input required type="date" id="add_date_issued" name="add_date_issued" class="form-control">
                                    <div id="add_date_issued-error"></div>
                                </div>
                            
                                <div class="col-md-4 mb-3">
                                    <label for="add_rrn" class="required">RRN</label>
                                    <input required placeholder="Enter RRN" type="text" id="add_rrn" name="add_rrn" pattern="[0-9]*" maxlength="11" class="form-control">
                                    <div id="add_rrn-error"></div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="add_soc_pen_yes" class="mb-2 required">Soc Pen</label>
                                    <br>
                                    <input required type="radio" id="add_soc_pen_yes" name="add_soc_pen" value="Yes"> Yes
                                    <input required style="margin-left:10px;" type="radio" id="add_soc_pen_no" name="add_soc_pen" value="No"> No
                                    <div id="add_soc_pen-error"></div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="add_gsis_yes" class="mb-2 required">GSIS</label>
                                    <br>
                                    <input required type="radio" id="add_gsis_yes" name="add_gsis" value="Yes"> Yes
                                    <input required style="margin-left:10px;" type="radio" id="add_gsis_no" name="add_gsis" value="No"> No
                                    <div id="add_gsis-error"></div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="add_sss_yes" class="mb-2 required">SSS</label>
                                    <br>
                                    <input required type="radio" id="add_sss_yes" name="add_sss" value="Yes"> Yes
                                    <input required style="margin-left:10px;" type="radio" id="add_sss_no" name="add_sss" value="No"> No
                                    <div id="add_sss-error"></div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="add_pvao_yes" class="mb-2 required">PVAO</label>
                                    <br>
                                    <input required type="radio" id="add_pvao_yes" name="add_pvao" value="Yes"> Yes
                                    <input required style="margin-left:10px;" type="radio" id="add_pvao_no" name="add_pvao" value="No"> No
                                    <div id="add_pvao-error"></div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="add_sup_with_yes" class="mb-2 required">SUP WITH</label>
                                    <br>
                                    <input required type="radio" id="add_sup_with_yes" name="add_sup_with" value="Yes"> Yes
                                    <input required style="margin-left:10px;" type="radio" id="add_sup_with_no" name="add_sup_with" value="No"> No
                                    <div id="add_sup_with-error"></div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="add_4ps_yes" class="mb-2 required">4P's</label>
                                    <br>
                                    <input required type="radio" id="add_4ps_yes" name="add_4ps" value="Yes"> Yes
                                    <input required style="margin-left:10px;" type="radio" id="add_4ps_no" name="add_4ps" value="No"> No
                                    <div id="add_4ps-error"></div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="add_nhts_yes" class="mb-2 required">NHTS</label>
                                    <br>
                                    <input required type="radio" id="add_nhts_yes" name="add_nhts" value="Yes"> Yes
                                    <input required style="margin-left:10px;" type="radio" id="add_nhts_no" name="add_nhts" value="No"> No
                                    <div id="add_nhts-error"></div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="add_id_file_yes" class="mb-2 required">ID File</label>
                                    <br>
                                    <input required type="radio" id="add_id_file_yes" name="add_id_file" value="Yes"> Yes
                                    <input required style="margin-left:10px;" type="radio" id="add_id_file_no" name="add_id_file" value="No"> No
                                    <div id="add_id_file-error"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id="add_client" type="submit"><i class="fa fa-plus mr-1" style="margin-right:0.3rem"></i>Add</button>
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
        $('#add_barangay').removeClass('is-invalid');
        $('#add_barangay-error').empty();
        $('#add_date_issued').removeClass('is-invalid');
        $('#add_date_issued-error').empty();
        $('#add_rrn').removeClass('is-invalid');
        $('#add_rrn-error').empty();
        $('#add_soc_pen').removeClass('is-invalid');
        $('#add_soc_pen-error').empty();
        $('#add_gsis').removeClass('is-invalid');
        $('#add_gsis-error').empty();
        $('#add_sss').removeClass('is-invalid');
        $('#add_sss-error').empty();
        $('#add_pvao').removeClass('is-invalid');
        $('#add_pvao-error').empty();
        $('#add_sup_with').removeClass('is-invalid');
        $('#add_sup_with-error').empty();
        $('#add_4ps').removeClass('is-invalid');
        $('#add_4ps-error').empty();
        $('#add_nhts').removeClass('is-invalid');
        $('#add_nhts-error').empty();
        $('#add_id_file').removeClass('is-invalid');
        $('#add_id_file-error').empty();
    }
</script>
<!-- Validation for add_client -->
<script>
    $(document).ready(function() {
        // debounce functions for each input field
        var debouncedCheckadd_Fname = _.debounce(checkadd_Fname, 500);
        var debouncedCheckadd_Lname = _.debounce(checkadd_Lname, 500);
        var debouncedCheckadd_Suffix = _.debounce(checkadd_Suffix, 500);
        var debouncedCheckadd_Gender = _.debounce(checkadd_Gender, 500);
        var debouncedCheckadd_Birthday = _.debounce(checkadd_Birthday, 500);
        var debouncedCheckadd_Barangay = _.debounce(checkadd_Barangay, 500);
        var debouncedCheckadd_Date_issued = _.debounce(checkadd_Date_issued, 500);
        var debouncedCheckadd_RRN = _.debounce(checkadd_RRN, 500);
        var debouncedCheckadd_Soc_Pen = _.debounce(checkadd_Soc_Pen, 500);
        var debouncedCheckadd_GSIS = _.debounce(checkadd_GSIS, 500);
        var debouncedCheckadd_SSS = _.debounce(checkadd_SSS, 500);
        var debouncedCheckadd_PVAO = _.debounce(checkadd_PVAO, 500);
        var debouncedCheckadd_SUP_WITH = _.debounce(checkadd_SUP_WITH, 500);
        var debouncedCheckadd_4ps = _.debounce(checkadd_4ps, 500);
        var debouncedCheckadd_NHTS = _.debounce(checkadd_NHTS, 500);
        var debouncedCheckadd_ID_File = _.debounce(checkadd_ID_File, 500);

        // attach event listeners for each input field
        $('#add_fname').on('input', debouncedCheckadd_Fname);
        $('#add_lname').on('input', debouncedCheckadd_Lname);
        $('#add_suffix').on('change', debouncedCheckadd_Suffix);
        $('#add_gender').on('input', debouncedCheckadd_Gender);
        $('#add_birthday').on('input', debouncedCheckadd_Birthday);
        $('#add_barangay').on('input', debouncedCheckadd_Barangay);
        $('#add_date_issued').on('input', debouncedCheckadd_Date_issued);
        $('#add_rrn').on('input', debouncedCheckadd_RRN);
        $('#add_soc_pen_yes').on('input', debouncedCheckadd_Soc_Pen);
        $('#add_soc_pen_no').on('input', debouncedCheckadd_Soc_Pen);
        $('#add_gsis_yes').on('input', debouncedCheckadd_GSIS);
        $('#add_gsis_no').on('input', debouncedCheckadd_GSIS);
        $('#add_sss_yes').on('input', debouncedCheckadd_SSS);
        $('#add_sss_no').on('input', debouncedCheckadd_SSS);
        $('#add_pvao_yes').on('input', debouncedCheckadd_PVAO);
        $('#add_pvao_no').on('input', debouncedCheckadd_PVAO);
        $('#add_sup_with_yes').on('input', debouncedCheckadd_SUP_WITH);
        $('#add_sup_with_no').on('input', debouncedCheckadd_SUP_WITH);
        $('#add_4ps_yes').on('input', debouncedCheckadd_4ps);
        $('#add_4ps_no').on('input', debouncedCheckadd_4ps);
        $('#add_nhts_yes').on('input', debouncedCheckadd_NHTS);
        $('#add_nhts_no').on('input', debouncedCheckadd_NHTS);
        $('#add_id_file_yes').on('input', debouncedCheckadd_ID_File);
        $('#add_id_file_no').on('input', debouncedCheckadd_ID_File);

        // Trigger on input change
        $('#add_fname').on('blur', debouncedCheckadd_Fname);
        $('#add_lname').on('blur', debouncedCheckadd_Lname);
        $('#add_suffix').on('blur', debouncedCheckadd_Suffix);
        $('#add_gender').on('blur', debouncedCheckadd_Gender);
        $('#add_birthday').on('blur', debouncedCheckadd_Birthday);
        $('#add_barangay').on('blur', debouncedCheckadd_Barangay);
        $('#add_date_issued').on('blur', debouncedCheckadd_Date_issued);
        $('#add_rrn').on('blur', debouncedCheckadd_RRN);
        $('#add_soc_pen_yes').on('blur', debouncedCheckadd_Soc_Pen);
        $('#add_soc_pen_no').on('blur', debouncedCheckadd_Soc_Pen);
        $('#add_gsis_yes').on('blur', debouncedCheckadd_GSIS);
        $('#add_gsis_no').on('blur', debouncedCheckadd_GSIS);
        $('#add_sss_yes').on('blur', debouncedCheckadd_SSS);
        $('#add_sss_no').on('blur', debouncedCheckadd_SSS);
        $('#add_pvao_yes').on('blur', debouncedCheckadd_PVAO);
        $('#add_pvao_no').on('blur', debouncedCheckadd_PVAO);
        $('#add_sup_with_yes').on('blur', debouncedCheckadd_SUP_WITH);
        $('#add_sup_with_no').on('blur', debouncedCheckadd_SUP_WITH);
        $('#add_4ps_yes').on('blur', debouncedCheckadd_4ps);
        $('#add_4ps_no').on('blur', debouncedCheckadd_4ps);
        $('#add_nhts_yes').on('blur', debouncedCheckadd_NHTS);
        $('#add_nhts_no').on('blur', debouncedCheckadd_NHTS);
        $('#add_id_file_yes').on('blur', debouncedCheckadd_ID_File);
        $('#add_id_file_no').on('blur', debouncedCheckadd_ID_File);

        function checkIfAllFieldsValid() {
            // check if all input fields are valid and enable submit button if so
            if ($('#add_fname-error').is(':empty') && $('#add_lname-error').is(':empty') && $('#add_suffix-error').is(':empty') && $('#add_gender-error').is(':empty') && $('#add_birthday-error').is(':empty') && $('#add_barangay-error').is(':empty') && $('#add_date_issued-error').is(':empty') && $('#add_rrn-error').is(':empty') && $('#add_soc_pen-error').is(':empty') && $('#add_gsis-error').is(':empty') && $('#add_sss-error').is(':empty') && $('#add_pvao-error').is(':empty') && $('#add_sup_with-error').is(':empty') && $('#add_4ps-error').is(':empty') && $('#add_nhts-error').is(':empty') && $('#add_id_file-error').is(':empty')) {
                $('#add_client').prop('disabled', false);
            } else {
                $('#add_client').prop('disabled', true);
            }
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

        function checkadd_Barangay() {
            var add_barangay = $('#add_barangay').val()
            // show error if barangay is empty
            if (!add_barangay || add_barangay.trim() === '') {
                $('#add_barangay-error').text('Please select barangay').css('color', 'red');
                $('#add_barangay').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for barangay if needed
            $('#add_barangay-error').empty();
            $('#add_barangay').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

        function checkadd_Date_issued() {
            var add_date_issued = $('#add_date_issued').val().trim();
            // show error if date issued is empty
            if (add_date_issued === '') {
                $('#add_date_issued-error').text('Please input date issued').css('color', 'red');
                $('#add_date_issued').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for date issued if needed
            $('#add_date_issued-error').empty();
            $('#add_date_issued').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

        function checkadd_RRN() {
            var add_rrn = $('#add_rrn').val().trim();
            // show error if rrn is empty
            if (add_rrn === '') {
                $('#add_rrn-error').text('Please input rrn').css('color', 'red');
                $('#add_rrn').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for rrn if needed
            $('#add_rrn-error').empty();
            $('#add_rrn').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

        function checkadd_Soc_Pen() {
            var add_soc_pen = $('input[name="add_soc_pen"]:checked').val();
            // show error if soc pen is empty
            if (!add_soc_pen) {
                $('#add_soc_pen-error').text('Please select sec pen').css('color', 'red');
                $('#add_soc_pen_yes').addClass('is-invalid');
                $('#add_soc_pen_no').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            // Perform additional validation for soc pen if needed
            $('#add_soc_pen-error').empty();
            $('#add_soc_pen_yes').removeClass('is-invalid');
            $('#add_soc_pen_no').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

        function checkadd_GSIS() {
            var add_gsis = $('input[name="add_gsis"]:checked').val();
            // show error if gsis is empty
            if (!add_gsis) {
                $('#add_gsis-error').text('Please select gsis').css('color', 'red');
                $('#add_gsis_yes').addClass('is-invalid');
                $('#add_gsis_no').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            // Perform additional validation for gsis if needed
            $('#add_gsis-error').empty();
            $('#add_gsis_yes').removeClass('is-invalid');
            $('#add_gsis_no').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

        function checkadd_SSS() {
            var add_sss = $('input[name="add_sss"]:checked').val();
            // show error if sss is empty
            if (!add_sss) {
                $('#add_sss-error').text('Please select sss').css('color', 'red');
                $('#add_sss_yes').addClass('is-invalid');
                $('#add_sss_no').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            // Perform additional validation for sss if needed
            $('#add_sss-error').empty();
            $('#add_sss_yes').removeClass('is-invalid');
            $('#add_sss_no').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

        function checkadd_PVAO() {
            var add_pvao = $('input[name="add_pvao"]:checked').val();
            // show error if pvao is empty
            if (!add_pvao) {
                $('#add_pvao-error').text('Please select pvao').css('color', 'red');
                $('#add_pvao_yes').addClass('is-invalid');
                $('#add_pvao_no').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            // Perform additional validation for pvao if needed
            $('#add_pvao-error').empty();
            $('#add_pvao_yes').removeClass('is-invalid');
            $('#add_pvao_no').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

        function checkadd_SUP_WITH() {
            var add_sup_with = $('input[name="add_sup_with"]:checked').val();
            // show error if sup with is empty
            if (!add_sup_with) {
                $('#add_sup_with-error').text('Please select sup with').css('color', 'red');
                $('#add_sup_with_yes').addClass('is-invalid');
                $('#add_sup_with_no').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            // Perform additional validation for sup with if needed
            $('#add_sup_with-error').empty();
            $('#add_sup_with_yes').removeClass('is-invalid');
            $('#add_sup_with_no').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

        function checkadd_4ps() {
            var add_4ps = $('input[name="add_4ps"]:checked').val();
            // show error if 4ps is empty
            if (!add_4ps) {
                $('#add_4ps-error').text('Please select 4ps').css('color', 'red');
                $('#add_4ps_yes').addClass('is-invalid');
                $('#add_4ps_no').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            // Perform additional validation for 4ps if needed
            $('#add_4ps-error').empty();
            $('#add_4ps_yes').removeClass('is-invalid');
            $('#add_4ps_no').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

        function checkadd_NHTS() {
            var add_nhts = $('input[name="add_nhts"]:checked').val();
            // show error if nhts is empty
            if (!add_nhts) {
                $('#add_nhts-error').text('Please select nhts').css('color', 'red');
                $('#add_nhts_yes').addClass('is-invalid');
                $('#add_nhts_no').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            // Perform additional validation for nhts if needed
            $('#add_nhts-error').empty();
            $('#add_nhts_yes').removeClass('is-invalid');
            $('#add_nhts_no').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

        function checkadd_ID_File() {
            var add_id_file = $('input[name="add_id_file"]:checked').val();
            // show error if id file is empty
            if (!add_id_file) {
                $('#add_id_file-error').text('Please select nths').css('color', 'red');
                $('#add_id_file_yes').addClass('is-invalid');
                $('#add_id_file_no').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            // Perform additional validation for id file if needed
            $('#add_id_file-error').empty();
            $('#add_id_file_yes').removeClass('is-invalid');
            $('#add_id_file_no').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

    });
</script>

<!-- Modal for View client -->
<div class="modal fade" id="btn_view_client" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="view_clientLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg d-grid" role="document" style="justify-items: center;">
        <div class="modal-content">
            <div class="modal-header card-header">
                <h5 class="modal-title" id="view_clientLabel">View Senior Citizen</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div> 
            <div class="modal-body"> 
                <div class="card mb-4">
                    <div class="card-header bg-teal">
                        <h5 class="text-white"><i class="far fa-user"></i> Senior Citizen information</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="view_fname">First Name</label>
                                <input disabled type="text" class="form-control" id="view_fname">
                            </div> 
                        
                            <div class="col-md-4 mb-3">
                                <label for="view_mname">Middle Name</label>
                                <input disabled type="text" class="form-control" id="view_mname">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="view_lname">Last Name</label>
                                <input disabled type="text" class="form-control" id="view_lname">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="view_suffix">Suffix</label>
                                <input disabled type="text" class="form-control" id="view_suffix">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="view_gender">Gender</label>
                                <input disabled type="text" class="form-control" id="view_gender">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="view_birthday">Birthday</label>
                                <input disabled type="text" class="form-control" id="view_birthday">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="view_barangay">Barangay</label>
                                <input disabled type="text" class="form-control" id="view_barangay">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="view_date_issued">Date Issued</label>
                                <input disabled type="text" class="form-control" id="view_date_issued">
                            </div>
                        
                            <div class="col-md-4 mb-3">
                                <label for="view_rrn">RRN</label>
                                <input disabled type="text" class="form-control" id="view_rrn">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="view_soc_pen">Soc Pen</label>
                                <input disabled type="text" class="form-control" id="view_soc_pen">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="view_gsis">GSIS</label>
                                <input disabled type="text" class="form-control" id="view_gsis">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="view_sss">SSS</label>
                                <input disabled type="text" class="form-control" id="view_sss">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="view_pvao">PVAO</label>
                                <input disabled type="text" class="form-control" id="view_pvao">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="view_sup_with">SUP WITH</label>
                                <input disabled type="text" class="form-control" id="view_sup_with">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="view_4ps">4P's</label>
                                <input disabled type="text" class="form-control" id="view_4ps">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="view_nhts">NHTS</label>
                                <input disabled type="text" class="form-control" id="view_nhts">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="view_id_file">ID File</label>
                                <input disabled type="text" class="form-control" id="view_id_file">
                            </div>

                            <div class="col-md-3 mb-3">
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
        document.getElementById("view_barangay").value = button.getAttribute("data-view_barangay");
        document.getElementById("view_date_issued").value = button.getAttribute("data-view_date_issued");
        document.getElementById("view_rrn").value = button.getAttribute("data-view_rrn");
        document.getElementById("view_soc_pen").value = button.getAttribute("data-view_soc_pen");
        document.getElementById("view_gsis").value = button.getAttribute("data-view_gsis");
        document.getElementById("view_sss").value = button.getAttribute("data-view_sss");
        document.getElementById("view_pvao").value = button.getAttribute("data-view_pvao");
        document.getElementById("view_sup_with").value = button.getAttribute("data-view_sup_with");
        document.getElementById("view_4ps").value = button.getAttribute("data-view_4ps");
        document.getElementById("view_nhts").value = button.getAttribute("data-view_nhts");
        document.getElementById("view_id_file").value = button.getAttribute("data-view_id_file");
        if(button.getAttribute("data-view_status") == 1){
            document.getElementById("view_status").value = 'Active';
        } else {
            document.getElementById("view_status").value = 'Inactive';
        }
    }
</script>

<!-- Modal for Edit client -->
<div class="modal fade" id="btn_edit_client" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="edit_clientLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg d-grid" role="document" style="justify-items: center;">
        <div class="modal-content">
            <div class="modal-header card-header">
                <h5 class="modal-title" id="edit_clientLabel">Edit Senior Citizen</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" onclick="editModalclose(this)"></button>
            </div>
            <form id="edit_client_form"> 
                <div class="modal-body"> 
                    <div class="card mb-4">
                        <div class="card-header bg-teal">
                            <h5 class="text-white"><i class="far fa-user"></i> Senior Citizen information</h5>
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
                                    <select required class="form-control" id="edit_suffix" name="edit_suffix">
                                        <option value="" selected>Select Suffix</option>
                                        <option value=" ">None</option>
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
                                    <label for="edit_birthday" class="required">Birthday</label>
                                    <input required class="form-control" id="edit_birthday" name="edit_birthday" pattern="\d{2} \d{2} \d{4}" placeholder="MM/DD/YYYY" type="date"/>
                                    <div id="edit_birthday-error"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="edit_barangay" class="required">Barangay</label>
                                    <select id="edit_barangay" name="edit_barangay" required class="form-control">
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
                                    <div id="edit_barangay-error"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="edit_date_issued" class="required">Date Issued</label>
                                    <input required type="date" id="edit_date_issued" name="edit_date_issued" class="form-control">
                                    <div id="edit_date_issued-error"></div>
                                </div>
                            
                                <div class="col-md-4 mb-3">
                                    <label for="edit_rrn" class="required">RRN</label>
                                    <input required placeholder="Enter RRN" type="text" id="edit_rrn" name="edit_rrn" pattern="[0-9]*" maxlength="11" class="form-control">
                                    <div id="edit_rrn-error"></div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="edit_soc_pen_yes" class="mb-2 required">Soc Pen</label>
                                    <br>
                                    <input required type="radio" id="edit_soc_pen_yes" name="edit_soc_pen" value="Yes"> Yes
                                    <input required style="margin-left:10px;" type="radio" id="edit_soc_pen_no" name="edit_soc_pen" value="No"> No
                                    <div id="edit_soc_pen-error"></div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="edit_gsis_yes" class="mb-2 required">GSIS</label>
                                    <br>
                                    <input required type="radio" id="edit_gsis_yes" name="edit_gsis" value="Yes"> Yes
                                    <input required style="margin-left:10px;" type="radio" id="edit_gsis_no" name="edit_gsis" value="No"> No
                                    <div id="edit_gsis-error"></div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="edit_sss_yes" class="mb-2 required">SSS</label>
                                    <br>
                                    <input required type="radio" id="edit_sss_yes" name="edit_sss" value="Yes"> Yes
                                    <input required style="margin-left:10px;" type="radio" id="edit_sss_no" name="edit_sss" value="No"> No
                                    <div id="edit_sss-error"></div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="edit_pvao_yes" class="mb-2 required">PVAO</label>
                                    <br>
                                    <input required type="radio" id="edit_pvao_yes" name="edit_pvao" value="Yes"> Yes
                                    <input required style="margin-left:10px;" type="radio" id="edit_pvao_no" name="edit_pvao" value="No"> No
                                    <div id="edit_pvao-error"></div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="edit_sup_with_yes" class="mb-2 required">SUP WITH</label>
                                    <br>
                                    <input required type="radio" id="edit_sup_with_yes" name="edit_sup_with" value="Yes"> Yes
                                    <input required style="margin-left:10px;" type="radio" id="edit_sup_with_no" name="edit_sup_with" value="No"> No
                                    <div id="edit_sup_with-error"></div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="edit_4ps_yes" class="mb-2 required">4P's</label>
                                    <br>
                                    <input required type="radio" id="edit_4ps_yes" name="edit_4ps" value="Yes"> Yes
                                    <input required style="margin-left:10px;" type="radio" id="edit_4ps_no" name="edit_4ps" value="No"> No
                                    <div id="edit_4ps-error"></div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="edit_nhts_yes" class="mb-2 required">NHTS</label>
                                    <br>
                                    <input required type="radio" id="edit_nhts_yes" name="edit_nhts" value="Yes"> Yes
                                    <input required style="margin-left:10px;" type="radio" id="edit_nhts_no" name="edit_nhts" value="No"> No
                                    <div id="edit_nhts-error"></div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="edit_id_file_yes" class="mb-2 required">ID File</label>
                                    <br>
                                    <input required type="radio" id="edit_id_file_yes" name="edit_id_file" value="Yes"> Yes
                                    <input required style="margin-left:10px;" type="radio" id="edit_id_file_no" name="edit_id_file" value="No"> No
                                    <div id="edit_id_file-error"></div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="edit_status" class="required">Status</label>
                                    <select id="edit_status" name="edit_status" required class="form-control">
                                        <option value="" selected>Select Status</option>
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
                    <input type="hidden" id="edit_client_id" name="edit_client_id">
                    <button class="btn btn-primary" id="edit_client" type="submit"><i class="fa fa-save mr-1" style="margin-right:0.3rem"></i>Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- JavaScript for Modal Edit -->
<script>
    function editModal(button) {
        // Redirect to the PHP file with the retrieved id as a query parameter
        document.getElementById("edit_client_id").value = button.getAttribute("data-edit_client_id");
        document.getElementById("edit_fname").value = button.getAttribute("data-edit_fname");
        document.getElementById("edit_mname").value = button.getAttribute("data-edit_mname");
        document.getElementById("edit_lname").value = button.getAttribute("data-edit_lname");
        document.getElementById("edit_suffix").value = button.getAttribute("data-edit_suffix");
        document.getElementById("edit_gender").value = button.getAttribute("data-edit_gender");
        document.getElementById("edit_birthday").value = button.getAttribute("data-edit_birthday");
        document.getElementById("edit_barangay").value = button.getAttribute("data-edit_barangay");
        document.getElementById("edit_date_issued").value = button.getAttribute("data-edit_date_issued");
        document.getElementById("edit_rrn").value = button.getAttribute("data-edit_rrn");
        if (button.getAttribute("data-edit_soc_pen") === "Yes") {
            document.getElementById("edit_soc_pen_yes").checked = true;
        } else {
            document.getElementById("edit_soc_pen_no").checked = true;
        }
        if (button.getAttribute("data-edit_gsis") === "Yes") {
            document.getElementById("edit_gsis_yes").checked = true;
        } else {
            document.getElementById("edit_gsis_no").checked = true;
        }
        if (button.getAttribute("data-edit_sss") === "Yes") {
            document.getElementById("edit_sss_yes").checked = true;
        } else {
            document.getElementById("edit_sss_no").checked = true;
        }
        if (button.getAttribute("data-edit_pvao") === "Yes") {
            document.getElementById("edit_pvao_yes").checked = true;
        } else {
            document.getElementById("edit_pvao_no").checked = true;
        }
        if (button.getAttribute("data-edit_sup_with") === "Yes") {
            document.getElementById("edit_sup_with_yes").checked = true;
        } else {
            document.getElementById("edit_sup_with_no").checked = true;
        }
        if (button.getAttribute("data-edit_4ps") === "Yes") {
            document.getElementById("edit_4ps_yes").checked = true;
        } else {
            document.getElementById("edit_4ps_no").checked = true;
        }
        if (button.getAttribute("data-edit_nhts") === "Yes") {
            document.getElementById("edit_nhts_yes").checked = true;
        } else {
            document.getElementById("edit_nhts_no").checked = true;
        }
        if (button.getAttribute("data-edit_id_file") === "Yes") {
            document.getElementById("edit_id_file_yes").checked = true;
        } else {
            document.getElementById("edit_id_file_no").checked = true;
        }
        document.getElementById("edit_status").value = button.getAttribute("data-edit_status");
    }
</script>
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
        $('#edit_barangay').removeClass('is-invalid');
        $('#edit_barangay-error').empty();
        $('#edit_date_issued').removeClass('is-invalid');
        $('#edit_date_issued-error').empty();
        $('#edit_rrn').removeClass('is-invalid');
        $('#edit_rrn-error').empty();
        $('#edit_soc_pen').removeClass('is-invalid');
        $('#edit_soc_pen-error').empty();
        $('#edit_gsis').removeClass('is-invalid');
        $('#edit_gsis-error').empty();
        $('#edit_sss').removeClass('is-invalid');
        $('#edit_sss-error').empty();
        $('#edit_pvao').removeClass('is-invalid');
        $('#edit_pvao-error').empty();
        $('#edit_sup_with').removeClass('is-invalid');
        $('#edit_sup_with-error').empty();
        $('#edit_4ps').removeClass('is-invalid');
        $('#edit_4ps-error').empty();
        $('#edit_nhts').removeClass('is-invalid');
        $('#edit_nhts-error').empty();
        $('#edit_id_file').removeClass('is-invalid');
        $('#edit_id_file-error').empty();
        $('#edit_status').removeClass('is-invalid');
        $('#edit_status-error').empty();
    }
</script>
<!-- Validation for edit_client -->
<script>
    $(document).ready(function() {
        // debounce functions for each input field
        var debouncedCheckedit_Fname = _.debounce(checkedit_Fname, 500);
        var debouncedCheckedit_Lname = _.debounce(checkedit_Lname, 500);
        var debouncedCheckedit_Suffix = _.debounce(checkedit_Suffix, 500);
        var debouncedCheckedit_Gender = _.debounce(checkedit_Gender, 500);
        var debouncedCheckedit_Birthday = _.debounce(checkedit_Birthday, 500);
        var debouncedCheckedit_Barangay = _.debounce(checkedit_Barangay, 500);
        var debouncedCheckedit_Date_issued = _.debounce(checkedit_Date_issued, 500);
        var debouncedCheckedit_RRN = _.debounce(checkedit_RRN, 500);
        var debouncedCheckedit_Soc_Pen = _.debounce(checkedit_Soc_Pen, 500);
        var debouncedCheckedit_GSIS = _.debounce(checkedit_GSIS, 500);
        var debouncedCheckedit_SSS = _.debounce(checkedit_SSS, 500);
        var debouncedCheckedit_PVAO = _.debounce(checkedit_PVAO, 500);
        var debouncedCheckedit_SUP_WITH = _.debounce(checkedit_SUP_WITH, 500);
        var debouncedCheckedit_4ps = _.debounce(checkedit_4ps, 500);
        var debouncedCheckedit_NHTS = _.debounce(checkedit_NHTS, 500);
        var debouncedCheckedit_ID_File = _.debounce(checkedit_ID_File, 500);
        var debouncedCheckedit_Status = _.debounce(checkedit_Status, 500);

        // attach event listeners for each input field
        $('#edit_fname').on('input', debouncedCheckedit_Fname);
        $('#edit_lname').on('input', debouncedCheckedit_Lname);
        $('#edit_suffix').on('change', debouncedCheckedit_Suffix);
        $('#edit_gender').on('input', debouncedCheckedit_Gender);
        $('#edit_birthday').on('input', debouncedCheckedit_Birthday);
        $('#edit_barangay').on('input', debouncedCheckedit_Barangay);
        $('#edit_date_issued').on('input', debouncedCheckedit_Date_issued);
        $('#edit_rrn').on('input', debouncedCheckedit_RRN);
        $('#edit_soc_pen_yes').on('input', debouncedCheckedit_Soc_Pen);
        $('#edit_soc_pen_no').on('input', debouncedCheckedit_Soc_Pen);
        $('#edit_gsis_yes').on('input', debouncedCheckedit_GSIS);
        $('#edit_gsis_no').on('input', debouncedCheckedit_GSIS);
        $('#edit_sss_yes').on('input', debouncedCheckedit_SSS);
        $('#edit_sss_no').on('input', debouncedCheckedit_SSS);
        $('#edit_pvao_yes').on('input', debouncedCheckedit_PVAO);
        $('#edit_pvao_no').on('input', debouncedCheckedit_PVAO);
        $('#edit_sup_with_yes').on('input', debouncedCheckedit_SUP_WITH);
        $('#edit_sup_with_no').on('input', debouncedCheckedit_SUP_WITH);
        $('#edit_4ps_yes').on('input', debouncedCheckedit_4ps);
        $('#edit_4ps_no').on('input', debouncedCheckedit_4ps);
        $('#edit_nhts_yes').on('input', debouncedCheckedit_NHTS);
        $('#edit_nhts_no').on('input', debouncedCheckedit_NHTS);
        $('#edit_id_file_yes').on('input', debouncedCheckedit_ID_File);
        $('#edit_id_file_no').on('input', debouncedCheckedit_ID_File);
        $('#edit_status').on('input', debouncedCheckedit_Status);

        // Trigger on input change
        $('#edit_fname').on('blur', debouncedCheckedit_Fname);
        $('#edit_lname').on('blur', debouncedCheckedit_Lname);
        $('#edit_suffix').on('blur', debouncedCheckedit_Suffix);
        $('#edit_gender').on('blur', debouncedCheckedit_Gender);
        $('#edit_birthday').on('blur', debouncedCheckedit_Birthday);
        $('#edit_barangay').on('blur', debouncedCheckedit_Barangay);
        $('#edit_date_issued').on('blur', debouncedCheckedit_Date_issued);
        $('#edit_rrn').on('blur', debouncedCheckedit_RRN);
        $('#edit_soc_pen_yes').on('blur', debouncedCheckedit_Soc_Pen);
        $('#edit_soc_pen_no').on('blur', debouncedCheckedit_Soc_Pen);
        $('#edit_gsis_yes').on('blur', debouncedCheckedit_GSIS);
        $('#edit_gsis_no').on('blur', debouncedCheckedit_GSIS);
        $('#edit_sss_yes').on('blur', debouncedCheckedit_SSS);
        $('#edit_sss_no').on('blur', debouncedCheckedit_SSS);
        $('#edit_pvao_yes').on('blur', debouncedCheckedit_PVAO);
        $('#edit_pvao_no').on('blur', debouncedCheckedit_PVAO);
        $('#edit_sup_with_yes').on('blur', debouncedCheckedit_SUP_WITH);
        $('#edit_sup_with_no').on('blur', debouncedCheckedit_SUP_WITH);
        $('#edit_4ps_yes').on('blur', debouncedCheckedit_4ps);
        $('#edit_4ps_no').on('blur', debouncedCheckedit_4ps);
        $('#edit_nhts_yes').on('blur', debouncedCheckedit_NHTS);
        $('#edit_nhts_no').on('blur', debouncedCheckedit_NHTS);
        $('#edit_id_file_yes').on('blur', debouncedCheckedit_ID_File);
        $('#edit_id_file_no').on('blur', debouncedCheckedit_ID_File);
        $('#edit_status').on('blur', debouncedCheckedit_Status);

        function checkIfAllFieldsValid() {
            // check if all input fields are valid and enable submit button if so
            if ($('#edit_fname-error').is(':empty') && $('#edit_lname-error').is(':empty') && $('#edit_suffix-error').is(':empty') && $('#edit_gender-error').is(':empty') && $('#edit_birthday-error').is(':empty') && $('#edit_barangay-error').is(':empty') && $('#edit_date_issued-error').is(':empty') && $('#edit_rrn-error').is(':empty') && $('#edit_soc_pen-error').is(':empty') && $('#edit_gsis-error').is(':empty') && $('#edit_sss-error').is(':empty') && $('#edit_pvao-error').is(':empty') && $('#edit_sup_with-error').is(':empty') && $('#edit_4ps-error').is(':empty') && $('#edit_nhts-error').is(':empty') && $('#edit_id_file-error').is(':empty') && $('#edit_status-error').is(':empty')) {
                $('#edit_client').prop('disabled', false);
            } else {
                $('#edit_client').prop('disabled', true);
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

        function checkedit_Barangay() {
            var edit_barangay = $('#edit_barangay').val()
            // show error if barangay is empty
            if (!edit_barangay || edit_barangay.trim() === '') {
                $('#edit_barangay-error').text('Please select barangay').css('color', 'red');
                $('#edit_barangay').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for barangay if needed
            $('#edit_barangay-error').empty();
            $('#edit_barangay').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

        function checkedit_Date_issued() {
            var edit_date_issued = $('#edit_date_issued').val().trim();
            // show error if date issued is empty
            if (edit_date_issued === '') {
                $('#edit_date_issued-error').text('Please input date issued').css('color', 'red');
                $('#edit_date_issued').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for date issued if needed
            $('#edit_date_issued-error').empty();
            $('#edit_date_issued').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

        function checkedit_RRN() {
            var edit_rrn = $('#edit_rrn').val().trim();
            // show error if rrn is empty
            if (edit_rrn === '') {
                $('#edit_rrn-error').text('Please input rrn').css('color', 'red');
                $('#edit_rrn').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for rrn if needed
            $('#edit_rrn-error').empty();
            $('#edit_rrn').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

        function checkedit_Soc_Pen() {
            var edit_soc_pen = $('input[name="edit_soc_pen"]:checked').val();
            // show error if soc pen is empty
            if (!edit_soc_pen) {
                $('#edit_soc_pen-error').text('Please select sec pen').css('color', 'red');
                $('#edit_soc_pen_yes').addClass('is-invalid');
                $('#edit_soc_pen_no').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            // Perform additional validation for soc pen if needed
            $('#edit_soc_pen-error').empty();
            $('#edit_soc_pen_yes').removeClass('is-invalid');
            $('#edit_soc_pen_no').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

        function checkedit_GSIS() {
            var edit_gsis = $('input[name="edit_gsis"]:checked').val();
            // show error if gsis is empty
            if (!edit_gsis) {
                $('#edit_gsis-error').text('Please select gsis').css('color', 'red');
                $('#edit_gsis_yes').addClass('is-invalid');
                $('#edit_gsis_no').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            // Perform additional validation for gsis if needed
            $('#edit_gsis-error').empty();
            $('#edit_gsis_yes').removeClass('is-invalid');
            $('#edit_gsis_no').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

        function checkedit_SSS() {
            var edit_sss = $('input[name="edit_sss"]:checked').val();
            // show error if sss is empty
            if (!edit_sss) {
                $('#edit_sss-error').text('Please select sss').css('color', 'red');
                $('#edit_sss_yes').addClass('is-invalid');
                $('#edit_sss_no').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            // Perform additional validation for sss if needed
            $('#edit_sss-error').empty();
            $('#edit_sss_yes').removeClass('is-invalid');
            $('#edit_sss_no').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

        function checkedit_PVAO() {
            var edit_pvao = $('input[name="edit_pvao"]:checked').val();
            // show error if pvao is empty
            if (!edit_pvao) {
                $('#edit_pvao-error').text('Please select pvao').css('color', 'red');
                $('#edit_pvao_yes').addClass('is-invalid');
                $('#edit_pvao_no').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            // Perform additional validation for pvao if needed
            $('#edit_pvao-error').empty();
            $('#edit_pvao_yes').removeClass('is-invalid');
            $('#edit_pvao_no').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

        function checkedit_SUP_WITH() {
            var edit_sup_with = $('input[name="edit_sup_with"]:checked').val();
            // show error if sup with is empty
            if (!edit_sup_with) {
                $('#edit_sup_with-error').text('Please select sup with').css('color', 'red');
                $('#edit_sup_with_yes').addClass('is-invalid');
                $('#edit_sup_with_no').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            // Perform additional validation for sup with if needed
            $('#edit_sup_with-error').empty();
            $('#edit_sup_with_yes').removeClass('is-invalid');
            $('#edit_sup_with_no').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

        function checkedit_4ps() {
            var edit_4ps = $('input[name="edit_4ps"]:checked').val();
            // show error if 4ps is empty
            if (!edit_4ps) {
                $('#edit_4ps-error').text('Please select 4ps').css('color', 'red');
                $('#edit_4ps_yes').addClass('is-invalid');
                $('#edit_4ps_no').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            // Perform additional validation for 4ps if needed
            $('#edit_4ps-error').empty();
            $('#edit_4ps_yes').removeClass('is-invalid');
            $('#edit_4ps_no').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

        function checkedit_NHTS() {
            var edit_nhts = $('input[name="edit_nhts"]:checked').val();
            // show error if nhts is empty
            if (!edit_nhts) {
                $('#edit_nhts-error').text('Please select nhts').css('color', 'red');
                $('#edit_nhts_yes').addClass('is-invalid');
                $('#edit_nhts_no').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            // Perform additional validation for nhts if needed
            $('#edit_nhts-error').empty();
            $('#edit_nhts_yes').removeClass('is-invalid');
            $('#edit_nhts_no').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

        function checkedit_ID_File() {
            var edit_id_file = $('input[name="edit_id_file"]:checked').val();
            // show error if id file is empty
            if (!edit_id_file) {
                $('#edit_id_file-error').text('Please select nths').css('color', 'red');
                $('#edit_id_file_yes').addClass('is-invalid');
                $('#edit_id_file_no').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            // Perform additional validation for id file if needed
            $('#edit_id_file-error').empty();
            $('#edit_id_file_yes').removeClass('is-invalid');
            $('#edit_id_file_no').removeClass('is-invalid');
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

<!-- Modal for Delete client -->
<div class="modal fade" id="btn_delete_client" tabindex="-1" role="dialog" aria-labelledby="delete_clientLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delete_clientLabel">Delete Senior Citizen</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">Are you sure you want to delete this senior citizen <b><span id="label"></span></b></div>
            <div class="modal-footer">
                <form id="delete_client_form" method="POST"  enctype="multipart/form-data">
                    <input type="hidden" id="delete_client_id" name="delete_client_id">
                    <button type="submit" id="delete_client" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- JavaScript for Modal Delete -->
<script>
    function deleteModal(button) {
        // Redirect to the PHP file with the retrieved id as a query parameter
        document.getElementById("delete_client_id").value = button.getAttribute("data-delete_client_id");
        document.getElementById("label").innerHTML = button.getAttribute("data-delete_fname") + ' ' + button.getAttribute("data-delete_mname") + ' ' + button.getAttribute("data-delete_lname") + ' ' + button.getAttribute("data-delete_suffix");
    }
</script>
<script type="text/javascript">
    $(document).ready(function() {
        // Add client
        $('#add_client_form').submit(function (e) {
            e.preventDefault(); // Prevent the default form submission
            var formData = new FormData(this);
            formData.append('add_client', '1'); // Identifier
            $.ajax({
                url: "ajax.php",
                method: "POST",
                data: formData,
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    $('#add_client').attr('disabled', 'disabled');
                    $('#add_client_close').attr('disabled', 'disabled');
                },
                success: function(data) {
                    swal({
                        title: "Notice",
                        text: data.status,
                        icon: data.alert,
                        button: true
                    }).then(function() {
                        $('#btn_add_client').modal('hide');
                        $('#add_client_form')[0].reset();
                        $('#add_client').removeAttr('disabled');
                        $('#add_client_close').removeAttr('disabled');
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
        // Edit client
        $('#edit_client_form').submit(function (e) {
            e.preventDefault(); // Prevent the default form submission
            var formData = new FormData(this);
            formData.append('edit_client', '1'); // Identifier
            $.ajax({
                url: "ajax.php",
                method: "POST",
                data: formData,
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    $('#edit_client').attr('disabled', 'disabled');
                    $('#edit_client_close').attr('disabled', 'disabled');
                },
                success: function(data) {
                    swal({
                        title: "Notice",
                        text: data.status,
                        icon: data.alert,
                        button: true
                    }).then(function() {
                        $('#btn_edit_client').modal('hide');
                        $('#edit_client_form')[0].reset();
                        $('#edit_client').removeAttr('disabled');
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
        // Delete client
        $('#delete_client').click(function() {
            var formData = new FormData($('#delete_client_form')[0]);
            formData.append('delete_client', '1'); // Identifier
            $.ajax({
                url: "ajax.php",
                method: "POST",
                data: formData,
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    $('#delete_client').attr('disabled', 'disabled');
                },
                success: function(data) {
                    swal({
                        title: "Notice",
                        text: data.status,
                        icon: data.alert,
                        button: true
                    }).then(function() {
                        $('#btn_delete_client').modal('hide');
                        $('#delete_client_form')[0].reset();
                        $('#delete_client').removeAttr('disabled');
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