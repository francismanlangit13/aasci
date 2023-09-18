<?php include ('../includes/header.php'); ?>
<main>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-5">
        <nav class="rounded bg-gray-200 mb-4" aria-label="breadcrumb">
            <ol class="breadcrumb px-3 py-2 rounded mb-0">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="../home">Home</a></li>
                <li class="breadcrumb-item"><a class="text-decoration-none" href="user">Users</a></li>
                <li class="breadcrumb-item active">Add</li>
            </ol>
        </nav>
        <form action="usercode.php" method="POST" enctype="multipart/form-data" >  
            <div class="card mb-4">
                <div class="card-header bg-teal">
                    <h5 class="text-white"><i class="far fa-user"></i> User information
                        <button type="submit" name="add_user" id="submit-btn" class="btn btn-primary btn-sm float-end"><i class="fa fa-plus"></i> Add</button>
                    </h5>
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
        </form>
    </div>
</main>
<?php include ('../includes/footer.php'); ?>