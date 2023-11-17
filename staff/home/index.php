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
                <div class="row">
                    <div class="col-lg-6">
                        <!-- Area chart example-->
                        <div class="card mb-4">
                            <div class="card-header">Registered Senior Summary (<?php echo date('Y'); ?>)</div>
                            <div class="card-body">
                                <div class="chart-area"><canvas id="SeniorRegistered" width="100%" height="30"></canvas></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card mb-4">
                            <div class="card-header">Deceased Senior Summary (<?php echo date('Y'); ?>)</div>
                            <div class="card-body">
                                <div class="chart-area"><canvas id="SeniorDeceased" width="100%" height="30"></canvas></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <!-- Bar chart example-->
                        <div class="card h-100">
                            <div class="card-header">Registered Senior Reporting (Yearly)</div>
                            <div class="card-body d-flex flex-column justify-content-center">
                                <div class="chart-bar"><canvas id="RegisteredSeniorYear" width="100%" height="30"></canvas></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- Bar chart example-->
                        <div class="card h-100">
                            <div class="card-header">Deceased Senior Reporting (Yearly)</div>
                            <div class="card-body d-flex flex-column justify-content-center">
                                <div class="chart-bar"><canvas id="DeceasedSeniorYear" width="100%" height="30"></canvas></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-lg-6">
                        <!-- Pie chart example-->
                        <div class="card h-100">
                            <?php
                                $total_users_sql = "SELECT COUNT(*) AS total_users FROM `user` WHERE DATE_FORMAT(date_issued, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-01-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-12-01'))";
                                $total_users = mysqli_fetch_assoc(mysqli_query($con, $total_users_sql))['total_users'] ?? 0;

                                $sql_sss_statistics = "SELECT COUNT(*) AS total_count_sss_statistics FROM `user` WHERE `sss` = 'Yes' AND DATE_FORMAT(date_issued, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-01-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-12-01'))";
                                $count_sss_statistics = mysqli_fetch_assoc(mysqli_query($con, $sql_sss_statistics))['total_count_sss_statistics'] ?? 0;

                                $sql_gsis_statistics = "SELECT COUNT(*) AS total_count_gsis_statistics FROM `user` WHERE `gsis` = 'Yes' AND DATE_FORMAT(date_issued, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-01-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-12-01'))";
                                $count_gsis_statistics = mysqli_fetch_assoc(mysqli_query($con, $sql_gsis_statistics))['total_count_gsis_statistics'] ?? 0;

                                $sql_fourps_statistics = "SELECT COUNT(*) AS total_count_forps_statistics FROM `user` WHERE `fourps` = 'Yes' AND DATE_FORMAT(date_issued, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-01-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-12-01'))";
                                $count_forps_statistics = mysqli_fetch_assoc(mysqli_query($con, $sql_fourps_statistics))['total_count_forps_statistics'] ?? 0;

                                $sql_pvao_statistics = "SELECT COUNT(*) AS total_count_pvao_statistics FROM `user` WHERE `pvao` = 'Yes' AND DATE_FORMAT(date_issued, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-01-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-12-01'))";
                                $count_pvao_statistics = mysqli_fetch_assoc(mysqli_query($con, $sql_pvao_statistics))['total_count_pvao_statistics'] ?? 0;

                                $sql_nhts_statistics = "SELECT COUNT(*) AS total_count_nhts_statistics FROM `user` WHERE `nhts` = 'Yes' AND DATE_FORMAT(date_issued, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-01-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-12-01'))";
                                $count_nhts_statistics = mysqli_fetch_assoc(mysqli_query($con, $sql_nhts_statistics))['total_count_nhts_statistics'] ?? 0;
                            ?>
                            <div class="card-header">Senior Statistics (<?php echo date('Y'); ?>)</div>
                            <div class="card-body">
                                <div class="chart-pie mb-4"><canvas id="SeniorStatisticsYear" width="100%" height="50"></canvas></div>
                                <div class="list-group list-group-flush">
                                    <div class="list-group-item d-flex align-items-center justify-content-between small px-0 py-2">
                                        <div class="me-3">
                                            <i class="fas fa-circle fa-sm me-1 text-blue"></i>
                                            Social Security System
                                        </div>
                                        <div class="fw-500 text-dark"><?php if ($total_users != 0) { $percentage_sss = ($count_sss_statistics / $total_users) * 100; echo number_format($percentage_sss, 2) . "%"; } else { echo "0.00%"; } ?></div>
                                    </div>
                                    <div class="list-group-item d-flex align-items-center justify-content-between small px-0 py-2">
                                        <div class="me-3">
                                            <i class="fas fa-circle fa-sm me-1 text-purple"></i>
                                            Government Service Insurance System
                                        </div>
                                        <div class="fw-500 text-dark"><?php if ($total_users != 0) { $percentage_gsis = ($count_gsis_statistics / $total_users) * 100; echo number_format($percentage_gsis, 2) . "%"; } else { echo "0.00%"; } ?></div>
                                    </div>
                                    <div class="list-group-item d-flex align-items-center justify-content-between small px-0 py-2">
                                        <div class="me-3">
                                            <i class="fas fa-circle fa-sm me-1 text-red"></i>
                                            Pantawid Pamilyang Pilipino Program (4P's)
                                        </div>
                                        <div class="fw-500 text-dark"><?php if ($total_users != 0) { $percentage_forps = ($count_forps_statistics / $total_users) * 100; echo number_format($percentage_forps, 2) . "%"; } else { echo "0.00%"; } ?></div>
                                    </div>
                                    <div class="list-group-item d-flex align-items-center justify-content-between small px-0 py-2">
                                        <div class="me-3">
                                            <i class="fas fa-circle fa-sm me-1 text-black"></i>
                                            Philippine Veterans Affairs Office
                                        </div>
                                        <div class="fw-500 text-dark"><?php if ($total_users != 0) { $percentage_pvao = ($count_pvao_statistics / $total_users) * 100; echo number_format($percentage_pvao, 2) . "%"; } else { echo "0.00%"; } ?></div>
                                    </div>
                                    <div class="list-group-item d-flex align-items-center justify-content-between small px-0 py-2">
                                        <div class="me-3">
                                            <i class="fas fa-circle fa-sm me-1 text-green"></i>
                                            National Household Targeting System
                                        </div>
                                        <div class="fw-500 text-dark"><?php if ($total_users != 0) { $percentage_nhts = ($count_nhts_statistics / $total_users) * 100; echo number_format($percentage_nhts, 2) . "%"; } else { echo "0.00%"; } ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- Pie chart example-->
                        <div class="card h-100">
                            <?php
                                $total_users_sql_all = "SELECT COUNT(*) AS total_users_all FROM `user` WHERE `user_type_id` = '3'";
                                $total_users_all = mysqli_fetch_assoc(mysqli_query($con, $total_users_sql_all))['total_users_all'] ?? 0;

                                $sql_sss_statistics_all = "SELECT COUNT(*) AS total_count_sss_statistics_all FROM `user` WHERE `sss` = 'Yes' AND `user_type_id` = '3'";
                                $count_sss_statistics_all = mysqli_fetch_assoc(mysqli_query($con, $sql_sss_statistics_all))['total_count_sss_statistics_all'] ?? 0;

                                $sql_gsis_statistics_all = "SELECT COUNT(*) AS total_count_gsis_statistics_all FROM `user` WHERE `gsis` = 'Yes' AND `user_type_id` = '3'";
                                $count_gsis_statistics_all = mysqli_fetch_assoc(mysqli_query($con, $sql_gsis_statistics_all))['total_count_gsis_statistics_all'] ?? 0;

                                $sql_fourps_statistics_all = "SELECT COUNT(*) AS total_count_forps_statistics_all FROM `user` WHERE `fourps` = 'Yes' AND `user_type_id` = '3'";
                                $count_forps_statistics_all = mysqli_fetch_assoc(mysqli_query($con, $sql_fourps_statistics_all))['total_count_forps_statistics_all'] ?? 0;

                                $sql_pvao_statistics_all = "SELECT COUNT(*) AS total_count_pvao_statistics_all FROM `user` WHERE `pvao` = 'Yes' AND `user_type_id` = '3'";
                                $count_pvao_statistics_all = mysqli_fetch_assoc(mysqli_query($con, $sql_pvao_statistics_all))['total_count_pvao_statistics_all'] ?? 0;

                                $sql_nhts_statistics_all = "SELECT COUNT(*) AS total_count_nhts_statistics_all FROM `user` WHERE `nhts` = 'Yes' AND `user_type_id` = '3'";
                                $count_nhts_statistics_all = mysqli_fetch_assoc(mysqli_query($con, $sql_nhts_statistics_all))['total_count_nhts_statistics_all'] ?? 0;
                            ?>
                            <div class="card-header">Senior Statistics (ALL DATA)</div>
                            <div class="card-body">
                                <div class="chart-pie mb-4"><canvas id="SeniorStatisticsAll" width="100%" height="50"></canvas></div>
                                <div class="list-group list-group-flush">
                                    <div class="list-group-item d-flex align-items-center justify-content-between small px-0 py-2">
                                        <div class="me-3">
                                            <i class="fas fa-circle fa-sm me-1 text-blue"></i>
                                            Social Security System
                                        </div>
                                        <div class="fw-500 text-dark"><?php if ($total_users_all != 0) { $percentage_sss_all = ($count_sss_statistics_all / $total_users_all) * 100; echo number_format($percentage_sss_all, 2) . "%"; } else { echo "0.00%"; } ?></div>
                                    </div>
                                    <div class="list-group-item d-flex align-items-center justify-content-between small px-0 py-2">
                                        <div class="me-3">
                                            <i class="fas fa-circle fa-sm me-1 text-purple"></i>
                                            Government Service Insurance System
                                        </div>
                                        <div class="fw-500 text-dark"><?php if ($total_users_all != 0) { $percentage_gsis_all = ($count_gsis_statistics_all / $total_users_all) * 100; echo number_format($percentage_gsis_all, 2) . "%"; } else { echo "0.00%"; } ?></div>
                                    </div>
                                    <div class="list-group-item d-flex align-items-center justify-content-between small px-0 py-2">
                                        <div class="me-3">
                                            <i class="fas fa-circle fa-sm me-1 text-red"></i>
                                            Pantawid Pamilyang Pilipino Program (4P's)
                                        </div>
                                        <div class="fw-500 text-dark"><?php if ($total_users_all != 0) { $percentage_forps_all = ($count_forps_statistics_all / $total_users_all) * 100; echo number_format($percentage_forps_all, 2) . "%"; } else { echo "0.00%"; } ?></div>
                                    </div>
                                    <div class="list-group-item d-flex align-items-center justify-content-between small px-0 py-2">
                                        <div class="me-3">
                                            <i class="fas fa-circle fa-sm me-1 text-black"></i>
                                            Philippine Veterans Affairs Office
                                        </div>
                                        <div class="fw-500 text-dark"><?php if ($total_users_all != 0) { $percentage_pvao_all = ($count_pvao_statistics_all / $total_users_all) * 100; echo number_format($percentage_pvao_all, 2) . "%"; } else { echo "0.00%"; } ?></div>
                                    </div>
                                    <div class="list-group-item d-flex align-items-center justify-content-between small px-0 py-2">
                                        <div class="me-3">
                                            <i class="fas fa-circle fa-sm me-1 text-green"></i>
                                            National Household Targeting System
                                        </div>
                                        <div class="fw-500 text-dark"><?php if ($total_users_all != 0) { $percentage_nhts_all = ($count_nhts_statistics_all / $total_users_all) * 100; echo number_format($percentage_nhts_all, 2) . "%"; } else { echo "0.00%"; } ?></div>
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

<?php
    $jan_sql_reg = "SELECT COUNT(*) AS total_count_jan_reg FROM `user` WHERE DATE_FORMAT(date_issued, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-01-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-01-01'))";
    $jan_count_reg = mysqli_fetch_assoc(mysqli_query($con, $jan_sql_reg))['total_count_jan_reg'] ?? 0;

    $feb_sql_reg = "SELECT COUNT(*) AS total_count_feb_reg FROM `user` WHERE DATE_FORMAT(date_issued, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-02-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-02-01'))";
    $feb_count_reg = mysqli_fetch_assoc(mysqli_query($con, $feb_sql_reg))['total_coun_feb_reg'] ?? 0;

    $mar_sql_reg = "SELECT COUNT(*) AS total_count_mar_reg FROM `user` WHERE DATE_FORMAT(date_issued, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-03-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-03-01'))";
    $mar_count_reg = mysqli_fetch_assoc(mysqli_query($con, $mar_sql_reg))['total_count_mar_reg'] ?? 0;

    $apr_sql_reg = "SELECT COUNT(*) AS total_count_apr_reg FROM `user` WHERE DATE_FORMAT(date_issued, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-04-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-04-01'))";
    $apr_count_reg = mysqli_fetch_assoc(mysqli_query($con, $apr_sql_reg))['total_count_apr_reg'] ?? 0;

    $may_sql_reg = "SELECT COUNT(*) AS total_count_may_reg FROM `user` WHERE DATE_FORMAT(date_issued, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-05-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-05-01'))";
    $may_count_reg = mysqli_fetch_assoc(mysqli_query($con, $may_sql_reg))['total_count_may_reg'] ?? 0;

    $jun_sql_reg = "SELECT COUNT(*) AS total_count_jun_reg FROM `user` WHERE DATE_FORMAT(date_issued, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-06-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-06-01'))";
    $jun_count_reg = mysqli_fetch_assoc(mysqli_query($con, $jun_sql_reg))['total_count_jun_reg'] ?? 0;

    $jul_sql_reg = "SELECT COUNT(*) AS total_count_jul_reg FROM `user` WHERE DATE_FORMAT(date_issued, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-07-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-07-01'))";
    $jul_count_reg = mysqli_fetch_assoc(mysqli_query($con, $jul_sql_reg))['total_count_jul_reg'] ?? 0;

    $aug_sql_reg = "SELECT COUNT(*) AS total_count_aug_reg FROM `user` WHERE DATE_FORMAT(date_issued, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-08-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-08-01'))";
    $aug_count_reg = mysqli_fetch_assoc(mysqli_query($con, $aug_sql_reg))['total_count_aug_reg'] ?? 0;

    $sep_sql_reg = "SELECT COUNT(*) AS total_count_sep_reg FROM `user` WHERE DATE_FORMAT(date_issued, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-09-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-09-01'))";
    $sep_count_reg = mysqli_fetch_assoc(mysqli_query($con, $sep_sql_reg))['total_count_sep_reg'] ?? 0;

    $oct_sql_reg = "SELECT COUNT(*) AS total_count_oct_reg FROM `user` WHERE DATE_FORMAT(date_issued, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-10-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-10-01'))";
    $oct_count_reg = mysqli_fetch_assoc(mysqli_query($con, $oct_sql_reg))['total_count_oct_reg'] ?? 0;

    $nov_sql_reg = "SELECT COUNT(*) AS total_count_nov_reg FROM `user` WHERE DATE_FORMAT(date_issued, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-11-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-11-01'))";
    $nov_count_reg = mysqli_fetch_assoc(mysqli_query($con, $nov_sql_reg))['total_count_nov_reg'] ?? 0;

    $dec_sql_reg = "SELECT COUNT(*) AS total_count_dec_reg FROM `user` WHERE DATE_FORMAT(date_issued, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-12-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-12-01'))";
    $dec_count_reg = mysqli_fetch_assoc(mysqli_query($con, $dec_sql_reg))['total_count_dec_reg'] ?? 0;
?>

<script>
    // Area Chart Example
    var ctx = document.getElementById("SeniorRegistered");
    var myLineChart = new Chart(ctx, {
        type: "line",
        data: {
            labels: [
                "Jan",
                "Feb",
                "Mar",
                "Apr",
                "May",
                "Jun",
                "Jul",
                "Aug",
                "Sep",
                "Oct",
                "Nov",
                "Dec"
            ],
            datasets: [
                {
                    label: "Registered",
                    lineTension: 0.3,
                    backgroundColor: "rgba(0, 97, 242, 0.05)",
                    borderColor: "rgba(0, 97, 242, 1)",
                    pointRadius: 3,
                    pointBackgroundColor: "rgba(0, 97, 242, 1)",
                    pointBorderColor: "rgba(0, 97, 242, 1)",
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: "rgba(0, 97, 242, 1)",
                    pointHoverBorderColor: "rgba(0, 97, 242, 1)",
                    pointHitRadius: 10,
                    pointBorderWidth: 2,
                    data: [
                        <?php echo $jan_count_reg; ?>,
                        <?php echo $feb_count_reg; ?>,
                        <?php echo $mar_count_reg; ?>,
                        <?php echo $apr_count_reg; ?>,
                        <?php echo $may_count_reg; ?>,
                        <?php echo $jun_count_reg; ?>,
                        <?php echo $jul_count_reg; ?>,
                        <?php echo $aug_count_reg; ?>,
                        <?php echo $sep_count_reg; ?>,
                        <?php echo $oct_count_reg; ?>,
                        <?php echo $nov_count_reg; ?>,
                        <?php echo $dec_count_reg; ?>
                    ]
                },
            ]
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            scales: {
                xAxes: [{
                    time: {
                        unit: "date"
                    },
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        maxTicksLimit: 7
                    }
                }],
                yAxes: [{
                    ticks: {
                        maxTicksLimit: 5,
                        padding: 10,
                        // Include a dollar sign in the ticks
                        callback: function(value, index, values) {
                            return "" + number_format(value);
                        }
                    },
                    gridLines: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                    }
                }]
            },
            legend: {
                display: false
            },
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                titleMarginBottom: 10,
                titleFontColor: "#6e707e",
                titleFontSize: 14,
                borderColor: "#dddfeb",
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                intersect: false,
                mode: "index",
                caretPadding: 10,
                callbacks: {
                    label: function(tooltipItem, chart) {
                        var datasetLabel =
                            chart.datasets[tooltipItem.datasetIndex].label || "";
                        return datasetLabel + ": " + number_format(tooltipItem.yLabel);
                    }
                }
            }
        }
    });
</script>

<?php
    $jan_sql_deceased = "SELECT COUNT(*) AS total_count_jan_deceased FROM `user` WHERE DATE_FORMAT(deceased_date, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-01-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-01-01'))";
    $jan_count_deceased = mysqli_fetch_assoc(mysqli_query($con, $jan_sql_deceased))['total_count_jan_deceased'] ?? 0;

    $feb_sql_deceased = "SELECT COUNT(*) AS total_count_feb_deceased FROM `user` WHERE DATE_FORMAT(deceased_date, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-02-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-02-01'))";
    $feb_count_deceased = mysqli_fetch_assoc(mysqli_query($con, $feb_sql_deceased))['total_count_feb_deceased'] ?? 0;

    $mar_sql_deceased = "SELECT COUNT(*) AS total_count_mar_deceased FROM `user` WHERE DATE_FORMAT(deceased_date, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-03-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-03-01'))";
    $mar_count_deceased = mysqli_fetch_assoc(mysqli_query($con, $mar_sql_deceased))['total_count_mar_deceased'] ?? 0;

    $apr_sql_deceased = "SELECT COUNT(*) AS total_count_apr_deceased FROM `user` WHERE DATE_FORMAT(deceased_date, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-04-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-04-01'))";
    $apr_count_deceased = mysqli_fetch_assoc(mysqli_query($con, $apr_sql_deceased))['total_count_apr_deceased'] ?? 0;

    $may_sql_deceased = "SELECT COUNT(*) AS total_count_may_deceased FROM `user` WHERE DATE_FORMAT(deceased_date, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-05-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-05-01'))";
    $may_count_deceased = mysqli_fetch_assoc(mysqli_query($con, $may_sql_deceased))['total_count_may_deceased'] ?? 0;

    $jun_sql_deceased = "SELECT COUNT(*) AS total_count_jun_deceased FROM `user` WHERE DATE_FORMAT(deceased_date, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-06-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-06-01'))";
    $jun_count_deceased = mysqli_fetch_assoc(mysqli_query($con, $jun_sql_deceased))['total_count_jun_deceased'] ?? 0;

    $jul_sql_deceased = "SELECT COUNT(*) AS total_count_jul_deceased FROM `user` WHERE DATE_FORMAT(deceased_date, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-07-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-07-01'))";
    $jul_count_deceased = mysqli_fetch_assoc(mysqli_query($con, $jul_sql_deceased))['total_count_jul_deceased'] ?? 0;

    $aug_sql_deceased = "SELECT COUNT(*) AS total_count_aug_deceased FROM `user` WHERE DATE_FORMAT(deceased_date, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-08-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-08-01'))";
    $aug_count_deceased = mysqli_fetch_assoc(mysqli_query($con, $aug_sql_deceased))['total_count_aug_deceased'] ?? 0;

    $sep_sql_deceased = "SELECT COUNT(*) AS total_count_sep_deceased FROM `user` WHERE DATE_FORMAT(deceased_date, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-09-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-09-01'))";
    $sep_count_deceased = mysqli_fetch_assoc(mysqli_query($con, $sep_sql_deceased))['total_count_sep_deceased'] ?? 0;

    $oct_sql_deceased = "SELECT COUNT(*) AS total_count_oct_deceased FROM `user` WHERE DATE_FORMAT(deceased_date, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-10-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-10-01'))";
    $oct_count_deceased = mysqli_fetch_assoc(mysqli_query($con, $oct_sql_deceased))['total_count_oct_deceased'] ?? 0;

    $nov_sql_deceased = "SELECT COUNT(*) AS total_count_nov_deceased FROM `user` WHERE DATE_FORMAT(deceased_date, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-11-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-11-01'))";
    $nov_count_deceased = mysqli_fetch_assoc(mysqli_query($con, $nov_sql_deceased))['total_count_nov_deceased'] ?? 0;

    $dec_sql_deceased = "SELECT COUNT(*) AS total_count_dec_deceased FROM `user` WHERE DATE_FORMAT(deceased_date, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-12-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-12-01'))";
    $dec_count_deceased = mysqli_fetch_assoc(mysqli_query($con, $dec_sql_deceased))['total_count_dec_deceased'] ?? 0;
?>

<script>
    // Area Chart Example
    var ctx = document.getElementById("SeniorDeceased");
    var myLineChart = new Chart(ctx, {
        type: "line",
        data: {
            labels: [
                "Jan",
                "Feb",
                "Mar",
                "Apr",
                "May",
                "Jun",
                "Jul",
                "Aug",
                "Sep",
                "Oct",
                "Nov",
                "Dec"
            ],
            datasets: [
                {
                    label: "Deceased",
                    lineTension: 0.3,
                    backgroundColor: "rgba(0, 97, 242, 0.05)",
                    borderColor: "rgba(0, 97, 242, 1)",
                    pointRadius: 3,
                    pointBackgroundColor: "rgba(0, 97, 242, 1)",
                    pointBorderColor: "rgba(0, 97, 242, 1)",
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: "rgba(0, 97, 242, 1)",
                    pointHoverBorderColor: "rgba(0, 97, 242, 1)",
                    pointHitRadius: 10,
                    pointBorderWidth: 2,
                    data: [
                        <?php echo $jan_count_deceased; ?>,
                        <?php echo $feb_count_deceased; ?>,
                        <?php echo $mar_count_deceased; ?>,
                        <?php echo $apr_count_deceased; ?>,
                        <?php echo $may_count_deceased; ?>,
                        <?php echo $jun_count_deceased; ?>,
                        <?php echo $jul_count_deceased; ?>,
                        <?php echo $aug_count_deceased; ?>,
                        <?php echo $sep_count_deceased; ?>,
                        <?php echo $oct_count_deceased; ?>,
                        <?php echo $nov_count_deceased; ?>,
                        <?php echo $dec_count_deceased; ?>
                    ]
                },
            ]
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            scales: {
                xAxes: [{
                    time: {
                        unit: "date"
                    },
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        maxTicksLimit: 7
                    }
                }],
                yAxes: [{
                    ticks: {
                        maxTicksLimit: 5,
                        padding: 10,
                        // Include a dollar sign in the ticks
                        callback: function(value, index, values) {
                            return "" + number_format(value);
                        }
                    },
                    gridLines: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                    }
                }]
            },
            legend: {
                display: false
            },
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                titleMarginBottom: 10,
                titleFontColor: "#6e707e",
                titleFontSize: 14,
                borderColor: "#dddfeb",
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                intersect: false,
                mode: "index",
                caretPadding: 10,
                callbacks: {
                    label: function(tooltipItem, chart) {
                        var datasetLabel =
                            chart.datasets[tooltipItem.datasetIndex].label || "";
                        return datasetLabel + ": " + number_format(tooltipItem.yLabel);
                    }
                }
            }
        }
    });
</script>

<?php
    $sql_this_year = "SELECT COUNT(*) AS total_count_now FROM `user` WHERE DATE_FORMAT(date_issued, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-01-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-12-01'))";
    $count_this_year = mysqli_fetch_assoc(mysqli_query($con, $sql_this_year))['total_count_now'] ?? 0;

    $sql_negative_1year = "SELECT COUNT(*) AS total_count_negative_1year FROM `user` WHERE DATE_FORMAT(date_issued, '%Y-%m-%d') BETWEEN CONCAT(YEAR(NOW()) - 1, '-01-01') AND LAST_DAY(CONCAT(YEAR(NOW()) - 1, '-12-01'));";
    $count_negative_1year = mysqli_fetch_assoc(mysqli_query($con, $sql_negative_1year))['total_count_negative_1year'] ?? 0;

    $sql_negative_2year = "SELECT COUNT(*) AS total_count_negative_2year FROM `user` WHERE DATE_FORMAT(date_issued, '%Y-%m-%d') BETWEEN CONCAT(YEAR(NOW()) - 2, '-01-01') AND LAST_DAY(CONCAT(YEAR(NOW()) - 2, '-12-01'));";
    $count_negative_2year = mysqli_fetch_assoc(mysqli_query($con, $sql_negative_2year))['total_count_negative_2year'] ?? 0;

    $sql_negative_3year = "SELECT COUNT(*) AS total_count_negative_3year FROM `user` WHERE DATE_FORMAT(date_issued, '%Y-%m-%d') BETWEEN CONCAT(YEAR(NOW()) - 3, '-01-01') AND LAST_DAY(CONCAT(YEAR(NOW()) - 3, '-12-01'));";
    $count_negative_3year = mysqli_fetch_assoc(mysqli_query($con, $sql_negative_3year))['total_count_negative_3year'] ?? 0;

    $sql_negative_4year = "SELECT COUNT(*) AS total_count_negative_4year FROM `user` WHERE DATE_FORMAT(date_issued, '%Y-%m-%d') BETWEEN CONCAT(YEAR(NOW()) - 4, '-01-01') AND LAST_DAY(CONCAT(YEAR(NOW()) - 4, '-12-01'));";
    $count_negative_4year = mysqli_fetch_assoc(mysqli_query($con, $sql_negative_4year))['total_count_negative_4year'] ?? 0;

    $sql_negative_5year = "SELECT COUNT(*) AS total_count_negative_5year FROM `user` WHERE DATE_FORMAT(date_issued, '%Y-%m-%d') BETWEEN CONCAT(YEAR(NOW()) - 5, '-01-01') AND LAST_DAY(CONCAT(YEAR(NOW()) - 5, '-12-01'));";
    $count_negative_5year = mysqli_fetch_assoc(mysqli_query($con, $sql_negative_5year))['total_count_negative_5year'] ?? 0;
?>

<script type="text/javascript">
    // Bar Chart Example
    var ctx = document.getElementById("RegisteredSeniorYear");
    var RegisteredSeniorYear = new Chart(ctx, {
        type: "bar",
        data: {
            labels: ["<?php echo date('Y') - 5; ?>", "<?php echo date('Y') - 4; ?>", "<?php echo date('Y') - 3; ?>", "<?php echo date('Y') - 2; ?>", "<?php echo date('Y') - 1; ?>", "<?php echo date('Y');?>"],
            datasets: [{
                label: "Registered",
                backgroundColor: "rgba(0, 97, 242, 1)",
                hoverBackgroundColor: "rgba(0, 97, 242, 0.9)",
                borderColor: "#4e73df",
                data: [<?php echo $count_negative_5year; ?>, <?php echo $count_negative_4year; ?>, <?php echo $count_negative_3year; ?>, <?php echo $count_negative_2year; ?>, <?php echo $count_negative_1year; ?>, <?php echo $count_this_year; ?> ],
                maxBarThickness: 25
            }]
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            scales: {
                xAxes: [{
                    time: {
                        unit: "month"
                    },
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        maxTicksLimit: 6
                    }
                }],
                yAxes: [{
                    ticks: {
                        min: 0,
                        //max: 15000,
                        maxTicksLimit: 5,
                        padding: 10,
                        // Include a dollar sign in the ticks
                        callback: function(value, index, values) {
                            return number_format(value);
                        }
                    },
                    gridLines: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                    }
                }]
            },
            legend: {
                display: false
            },
            tooltips: {
                titleMarginBottom: 10,
                titleFontColor: "#6e707e",
                titleFontSize: 14,
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: "#dddfeb",
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
                callbacks: {
                    label: function(tooltipItem, chart) {
                        var datasetLabel =
                            chart.datasets[tooltipItem.datasetIndex].label || "";
                        return datasetLabel + ": " + number_format(tooltipItem.yLabel);
                    }
                }
            }
        }
    });
</script>


<?php
    $sql_this_year_deceased = "SELECT COUNT(*) AS total_count_now_deceased FROM `user` WHERE DATE_FORMAT(deceased_date, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-01-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-12-01'))";
    $count_this_year_deceased = mysqli_fetch_assoc(mysqli_query($con, $sql_this_year_deceased))['total_count_now_deceased'] ?? 0;

    $sql_negative_1year_deceased = "SELECT COUNT(*) AS total_count_negative_1year_deceased FROM `user` WHERE DATE_FORMAT(deceased_date, '%Y-%m-%d') BETWEEN CONCAT(YEAR(NOW()) - 1, '-01-01') AND LAST_DAY(CONCAT(YEAR(NOW()) - 1, '-12-01'));";
    $count_negative_1year_deceased = mysqli_fetch_assoc(mysqli_query($con, $sql_negative_1year_deceased))['total_count_negative_1year_deceased'] ?? 0;

    $sql_negative_2year_deceased = "SELECT COUNT(*) AS total_count_negative_2year_deceased FROM `user` WHERE DATE_FORMAT(deceased_date, '%Y-%m-%d') BETWEEN CONCAT(YEAR(NOW()) - 2, '-01-01') AND LAST_DAY(CONCAT(YEAR(NOW()) - 2, '-12-01'));";
    $count_negative_2year_deceased = mysqli_fetch_assoc(mysqli_query($con, $sql_negative_2year_deceased))['total_count_negative_2year_deceased'] ?? 0;

    $sql_negative_3year_deceased = "SELECT COUNT(*) AS total_count_negative_3year_deceased FROM `user` WHERE DATE_FORMAT(deceased_date, '%Y-%m-%d') BETWEEN CONCAT(YEAR(NOW()) - 3, '-01-01') AND LAST_DAY(CONCAT(YEAR(NOW()) - 3, '-12-01'));";
    $count_negative_3year_deceased = mysqli_fetch_assoc(mysqli_query($con, $sql_negative_3year_deceased))['total_count_negative_3year_deceased'] ?? 0;

    $sql_negative_4year_deceased = "SELECT COUNT(*) AS total_count_negative_4year_deceased FROM `user` WHERE DATE_FORMAT(deceased_date, '%Y-%m-%d') BETWEEN CONCAT(YEAR(NOW()) - 4, '-01-01') AND LAST_DAY(CONCAT(YEAR(NOW()) - 4, '-12-01'));";
    $count_negative_4year_deceased = mysqli_fetch_assoc(mysqli_query($con, $sql_negative_4year_deceased))['total_count_negative_4year_deceased'] ?? 0;

    $sql_negative_5year_deceased = "SELECT COUNT(*) AS total_count_negative_5year_deceased FROM `user` WHERE DATE_FORMAT(deceased_date, '%Y-%m-%d') BETWEEN CONCAT(YEAR(NOW()) - 5, '-01-01') AND LAST_DAY(CONCAT(YEAR(NOW()) - 5, '-12-01'));";
    $count_negative_5year_deceased = mysqli_fetch_assoc(mysqli_query($con, $sql_negative_5year_deceased))['total_count_negative_5year_deceased'] ?? 0;
?>

<script type="text/javascript">
    // Bar Chart Example
    var ctx = document.getElementById("DeceasedSeniorYear");
    var DeceasedSeniorYear = new Chart(ctx, {
        type: "bar",
        data: {
            labels: ["<?php echo date('Y') - 5; ?>", "<?php echo date('Y') - 4; ?>", "<?php echo date('Y') - 3; ?>", "<?php echo date('Y') - 2; ?>", "<?php echo date('Y') - 1; ?>", "<?php echo date('Y');?>"],
            datasets: [{
                label: "Deceased ",
                backgroundColor: "rgba(0, 97, 242, 1)",
                hoverBackgroundColor: "rgba(0, 97, 242, 0.9)",
                borderColor: "#4e73df",
                data: [<?php echo $count_negative_5year_deceased; ?>, <?php echo $count_negative_4year_deceased; ?>, <?php echo $count_negative_3year_deceased; ?>, <?php echo $count_negative_2year_deceased; ?>, <?php echo $count_negative_1year_deceased; ?>, <?php echo $count_this_year_deceased; ?> ],
                maxBarThickness: 25
            }]
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            scales: {
                xAxes: [{
                    time: {
                        unit: "month"
                    },
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        maxTicksLimit: 6
                    }
                }],
                yAxes: [{
                    ticks: {
                        min: 0,
                        //max: 15000,
                        maxTicksLimit: 5,
                        padding: 10,
                        // Include a dollar sign in the ticks
                        callback: function(value, index, values) {
                            return number_format(value);
                        }
                    },
                    gridLines: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                    }
                }]
            },
            legend: {
                display: false
            },
            tooltips: {
                titleMarginBottom: 10,
                titleFontColor: "#6e707e",
                titleFontSize: 14,
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: "#dddfeb",
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
                callbacks: {
                    label: function(tooltipItem, chart) {
                        var datasetLabel =
                            chart.datasets[tooltipItem.datasetIndex].label || "";
                        return datasetLabel + number_format(tooltipItem.yLabel);
                    }
                }
            }
        }
    });
</script>

<?php
    $sql_sss_statistics = "SELECT COUNT(*) AS total_count_sss_statistics FROM `user` WHERE `sss` = 'Yes' AND DATE_FORMAT(date_issued, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-01-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-12-01'))";
    $count_sss_statistics = mysqli_fetch_assoc(mysqli_query($con, $sql_sss_statistics))['total_count_sss_statistics'] ?? 0;

    $sql_gsis_statistics = "SELECT COUNT(*) AS total_count_gsis_statistics FROM `user` WHERE `gsis` = 'Yes' AND DATE_FORMAT(date_issued, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-01-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-12-01'))";
    $count_gsis_statistics = mysqli_fetch_assoc(mysqli_query($con, $sql_gsis_statistics))['total_count_gsis_statistics'] ?? 0;

    $sql_fourps_statistics = "SELECT COUNT(*) AS total_count_forps_statistics FROM `user` WHERE `fourps` = 'Yes' AND DATE_FORMAT(date_issued, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-01-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-12-01'))";
    $count_forps_statistics = mysqli_fetch_assoc(mysqli_query($con, $sql_fourps_statistics))['total_count_forps_statistics'] ?? 0;

    $sql_pvao_statistics = "SELECT COUNT(*) AS total_count_pvao_statistics FROM `user` WHERE `pvao` = 'Yes' AND DATE_FORMAT(date_issued, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-01-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-12-01'))";
    $count_pvao_statistics = mysqli_fetch_assoc(mysqli_query($con, $sql_pvao_statistics))['total_count_pvao_statistics'] ?? 0;

    $sql_nhts_statistics = "SELECT COUNT(*) AS total_count_nhts_statistics FROM `user` WHERE `nhts` = 'Yes' AND DATE_FORMAT(date_issued, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-01-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-12-01'))";
    $count_nhts_statistics = mysqli_fetch_assoc(mysqli_query($con, $sql_nhts_statistics))['total_count_nhts_statistics'] ?? 0;
?>

<script type="text/javascript">
    // Pie Chart Example
    var ctx = document.getElementById("SeniorStatisticsYear");
    var SeniorStatisticsYear = new Chart(ctx, {
        type: "doughnut",
        data: {
            labels: ["SSS", "GSIS", "4P's", "PVAO", "NHTS"],
            datasets: [{
                data: [<?php echo $count_sss_statistics; ?>, <?php echo $count_gsis_statistics; ?>, <?php echo $count_forps_statistics; ?>, <?php echo $count_pvao_statistics; ?>, <?php echo $count_nhts_statistics; ?>],
                backgroundColor: [
                    "rgba(0, 97, 242, 1)",
                    "rgba(88, 0, 232, 1)",
                    "rgba(255, 0, 0, 1)",
                    "rgba(0, 0, 0, 1)",
                    "rgba(0, 172, 105, 1)"
                ],
                hoverBackgroundColor: [
                    "rgba(0, 97, 242, 0.9)",
                    "rgba(88, 0, 232, 0.9)",
                    "rgba(255, 0, 0, 0.9)",
                    "rgba(0, 0, 0, 0.9)",
                    "rgba(0, 172, 105, 0.9)"
                ],
                hoverBorderColor: "rgba(234, 236, 244, 1)"
            }]
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: "#dddfeb",
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10
            },
            legend: {
                display: false
            },
            cutoutPercentage: 80
        }
    });
</script>

<?php
    $sql_sss_statistics_all = "SELECT COUNT(*) AS total_count_sss_statistics_all FROM `user` WHERE `sss` = 'Yes' AND `user_type_id` = '3'";
    $count_sss_statistics_all = mysqli_fetch_assoc(mysqli_query($con, $sql_sss_statistics_all))['total_count_sss_statistics_all'] ?? 0;

    $sql_gsis_statistics_all = "SELECT COUNT(*) AS total_count_gsis_statistics_all FROM `user` WHERE `gsis` = 'Yes' AND `user_type_id` = '3'";
    $count_gsis_statistics_all = mysqli_fetch_assoc(mysqli_query($con, $sql_gsis_statistics_all))['total_count_gsis_statistics_all'] ?? 0;

    $sql_fourps_statistics_all = "SELECT COUNT(*) AS total_count_forps_statistics_all FROM `user` WHERE `fourps` = 'Yes' AND `user_type_id` = '3'";
    $count_forps_statistics_all = mysqli_fetch_assoc(mysqli_query($con, $sql_fourps_statistics_all))['total_count_forps_statistics_all'] ?? 0;

    $sql_pvao_statistics_all = "SELECT COUNT(*) AS total_count_pvao_statistics_all FROM `user` WHERE `pvao` = 'Yes' AND `user_type_id` = '3'";
    $count_pvao_statistics_all = mysqli_fetch_assoc(mysqli_query($con, $sql_pvao_statistics_all))['total_count_pvao_statistics_all'] ?? 0;

    $sql_nhts_statistics_all = "SELECT COUNT(*) AS total_count_nhts_statistics_all FROM `user` WHERE `nhts` = 'Yes' AND `user_type_id` = '3'";
    $count_nhts_statistics_all = mysqli_fetch_assoc(mysqli_query($con, $sql_nhts_statistics_all))['total_count_nhts_statistics_all'] ?? 0;
?>

<script type="text/javascript">
    // Pie Chart Example
    var ctx = document.getElementById("SeniorStatisticsAll");
    var SeniorStatisticsAll = new Chart(ctx, {
        type: "doughnut",
        data: {
            labels: ["SSS", "GSIS", "4P's", "PVAO", "NHTS"],
            datasets: [{
                data: [<?php echo $count_sss_statistics_all; ?>, <?php echo $count_gsis_statistics_all; ?>, <?php echo $count_forps_statistics_all; ?>, <?php echo $count_pvao_statistics_all; ?>, <?php echo $count_nhts_statistics_all; ?>],
                backgroundColor: [
                    "rgba(0, 97, 242, 1)",
                    "rgba(88, 0, 232, 1)",
                    "rgba(255, 0, 0, 1)",
                    "rgba(0, 0, 0, 1)",
                    "rgba(0, 172, 105, 1)"
                ],
                hoverBackgroundColor: [
                    "rgba(0, 97, 242, 0.9)",
                    "rgba(88, 0, 232, 0.9)",
                    "rgba(255, 0, 0, 0.9)",
                    "rgba(0, 0, 0, 0.9)",
                    "rgba(0, 172, 105, 0.9)"
                ],
                hoverBorderColor: "rgba(234, 236, 244, 1)"
            }]
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: "#dddfeb",
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10
            },
            legend: {
                display: false
            },
            cutoutPercentage: 80
        }
    });
</script>