<head>
    <?php include ('../includes/header.php'); ?>
    <!-- Website Title -->
    <title><?= $system['shortname'] ?> | Dashboard</title>
</head>
<main>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-5">
        <nav class="rounded bg-gray-200 mb-4" aria-label="breadcrumb">
            <ol class="breadcrumb px-3 py-2 rounded mb-0">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="../home">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
        <!-- Custom page header alternative example-->
        <div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
            <div class="me-4 mb-3 mb-sm-0">
                <h1 class="mb-0">Dashboard</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <!-- Dashboard info widget 1-->
                <div class="card border-start-lg border-start-primary h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="small fw-bold text-primary mb-1">Total Admins</div>
                                <div class="h5">
                                    <?php
                                        $sql1 = "SELECT * FROM user WHERE user_type_id = 1 AND user_status_id != 3";
                                        $sql_run1 = mysqli_query($con, $sql1);
                                        if($admin_count = mysqli_num_rows($sql_run1)){
                                            echo $admin_count;
                                        }
                                        else{
                                            echo '0';
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="ms-2"><i class="fas fa-user-lock fa-2x text-gray-400"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <!-- Dashboard info widget 2-->
                <div class="card border-start-lg border-start-secondary h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="small fw-bold text-secondary mb-1">Staff</div>
                                <div class="h5">
                                    <?php
                                        $sql2 = "SELECT * FROM user WHERE user_type_id = 2 AND user_status_id != 3";
                                        $sql_run2 = mysqli_query($con, $sql2);
                                        if($staff_count = mysqli_num_rows($sql_run2)){
                                            echo $staff_count;
                                        }
                                        else{
                                            echo '0';
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="ms-2"><i class="fas fa-user-friends fa-2x text-gray-400"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <!-- Dashboard info widget 3-->
                <div class="card border-start-lg border-start-success h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="small fw-bold text-success mb-1">Total Active Senior Citizen</div>
                                <div class="h5">
                                    <?php
                                        $sql3 = "SELECT * FROM user WHERE user_type_id = 3 AND user_status_id = 1";
                                        $sql_run3 = mysqli_query($con, $sql3);
                                        if($senior_active_count = mysqli_num_rows($sql_run3)){
                                            echo $senior_active_count;
                                        }
                                        else{
                                            echo '0';
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="ms-2"><i class="fas fa-user-check fa-2x text-gray-400"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <!-- Dashboard info widget 4-->
                <div class="card border-start-lg border-start-info h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="small fw-bold text-info mb-1">Total Inactive Senior Citizen</div>
                                <div class="h5">
                                    <?php
                                        $sql4 = "SELECT * FROM user WHERE user_type_id = 3 AND user_status_id = 2";
                                        $sql_run4 = mysqli_query($con, $sql4);
                                        if($senior_inactive_count = mysqli_num_rows($sql_run4)){
                                            echo $senior_inactive_count;
                                        }
                                        else{
                                            echo '0';
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="ms-2"><i class="fas fa-user-times fa-2x text-gray-400"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 mb-4">
                <!-- Area chart example-->
                <div class="card mb-4">
                    <div class="card-header">Revenue Summary</div>
                    <div class="card-body">
                        <div class="chart-area"><canvas id="myAreaChart" width="100%" height="30"></canvas></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <!-- Bar chart example-->
                        <div class="card h-100">
                            <div class="card-header">Sales Reporting</div>
                            <div class="card-body d-flex flex-column justify-content-center">
                                <div class="chart-bar"><canvas id="myBarChart" width="100%" height="30"></canvas></div>
                            </div>
                            <div class="card-footer position-relative">
                                <a class="stretched-link" href="#!">
                                    <div class="text-xs d-flex align-items-center justify-content-between">
                                        View More Reports
                                        <i class="fas fa-long-arrow-alt-right"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- Pie chart example-->
                        <div class="card h-100">
                            <div class="card-header">Traffic Sources</div>
                            <div class="card-body">
                                <div class="chart-pie mb-4"><canvas id="myPieChart" width="100%" height="50"></canvas></div>
                                <div class="list-group list-group-flush">
                                    <div class="list-group-item d-flex align-items-center justify-content-between small px-0 py-2">
                                        <div class="me-3">
                                            <i class="fas fa-circle fa-sm me-1 text-blue"></i>
                                            Direct
                                        </div>
                                        <div class="fw-500 text-dark">55%</div>
                                    </div>
                                    <div class="list-group-item d-flex align-items-center justify-content-between small px-0 py-2">
                                        <div class="me-3">
                                            <i class="fas fa-circle fa-sm me-1 text-purple"></i>
                                            Social
                                        </div>
                                        <div class="fw-500 text-dark">15%</div>
                                    </div>
                                    <div class="list-group-item d-flex align-items-center justify-content-between small px-0 py-2">
                                        <div class="me-3">
                                            <i class="fas fa-circle fa-sm me-1 text-green"></i>
                                            Referral
                                        </div>
                                        <div class="fw-500 text-dark">30%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include ('../includes/footer.php'); ?>