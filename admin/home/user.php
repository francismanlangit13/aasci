<?php include ('../includes/header.php'); ?>
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
                <a href="user_add" class="btn btn-primary btn-icon-split btn-sm float-end"> 
                    <span class="icon text-white">
                        <i class="fas fa-user-plus"></i> Add User Account
                    </span>
                </a>
            </div>
            <div class="card-body">
                <table id="datatablesSimple" class="overflow-auto">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>Gender</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $user_id = $_SESSION['auth_user']['user_id'];
                        $query = "SELECT * FROM user
                        INNER JOIN user_type ON user.user_type_id = user_type.user_type_id
                        INNER JOIN user_status ON user.user_status_id = user_status.user_status_id
                        WHERE user.user_status_id != 3 && user.user_type_id != 3 AND user.user_id != $user_id";
                        $query_run = mysqli_query($con, $query);
                        if(mysqli_num_rows($query_run) > 0){
                            foreach($query_run as $row){
                    ?>
                        <tr>
                            <td><?= $row['user_id']; ?></td>
                            <td><?= $row['fname']; ?> <?= $row['mname']; ?> <?= $row['lname']; ?></td>
                            <td><?= $row['gender']; ?></td>
                            <td><?= $row['email']; ?></td>
                            <td><?= $row['phone']; ?></td>
                            <td>
                                <?php if($row['user_type_id'] == 1){ ?>
                                    <div class="badge bg-primary text-white rounded-pill">Admin</div>
                                <?php } else{ ?>
                                    <div class="badge bg-warning text-white rounded-pill">Staff</div>
                                <?php } ?>
                            </td>
                            <td>
                                <?php if($row['user_status_id'] == 1){ ?>
                                    <div class="badge bg-success text-white rounded-pill">Active</div>
                                <?php } else{ ?>
                                    <div class="badge bg-danger text-white rounded-pill">Inactive</div>
                                <?php } ?>
                            </td>
                            <td>
                                <button class="btn btn-datatable btn-icon btn-transparent-dark"><i data-feather="eye"></i></button>
                                <button class="btn btn-datatable btn-icon btn-transparent-dark"><i data-feather="edit"></i></button>
                                <button class="btn btn-datatable btn-icon btn-transparent-dark"><i data-feather="trash"></i></button>
                            </td>
                        </tr>
                        <?php } } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<?php include ('../includes/footer.php'); ?>