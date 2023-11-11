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
                    <div class="card-header">Registered Senior Summary</div>
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
                            <div class="card-header">Statistics</div>
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

<?php
    $jan_sql = "SELECT COUNT(*) AS total_count FROM `user` WHERE DATE_FORMAT(date_issued, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-01-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-01-01'))";
    $jan_count = mysqli_fetch_assoc(mysqli_query($con, $jan_sql))['total_count'] ?? 0;

    $feb_sql = "SELECT COUNT(*) AS total_count FROM `user` WHERE DATE_FORMAT(date_issued, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-02-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-02-01'))";
    $feb_count = mysqli_fetch_assoc(mysqli_query($con, $feb_sql))['total_count'] ?? 0;

    $mar_sql = "SELECT COUNT(*) AS total_count FROM `user` WHERE DATE_FORMAT(date_issued, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-03-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-03-01'))";
    $mar_count = mysqli_fetch_assoc(mysqli_query($con, $mar_sql))['total_count'] ?? 0;

    $apr_sql = "SELECT COUNT(*) AS total_count FROM `user` WHERE DATE_FORMAT(date_issued, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-04-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-04-01'))";
    $apr_count = mysqli_fetch_assoc(mysqli_query($con, $apr_sql))['total_count'] ?? 0;

    $may_sql = "SELECT COUNT(*) AS total_count FROM `user` WHERE DATE_FORMAT(date_issued, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-05-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-05-01'))";
    $may_count = mysqli_fetch_assoc(mysqli_query($con, $may_sql))['total_count'] ?? 0;

    $jun_sql = "SELECT COUNT(*) AS total_count FROM `user` WHERE DATE_FORMAT(date_issued, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-06-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-06-01'))";
    $jun_count = mysqli_fetch_assoc(mysqli_query($con, $jun_sql))['total_count'] ?? 0;

    $jul_sql = "SELECT COUNT(*) AS total_count FROM `user` WHERE DATE_FORMAT(date_issued, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-07-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-07-01'))";
    $jul_count = mysqli_fetch_assoc(mysqli_query($con, $jul_sql))['total_count'] ?? 0;

    $aug_sql = "SELECT COUNT(*) AS total_count FROM `user` WHERE DATE_FORMAT(date_issued, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-08-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-08-01'))";
    $aug_count = mysqli_fetch_assoc(mysqli_query($con, $aug_sql))['total_count'] ?? 0;

    $sep_sql = "SELECT COUNT(*) AS total_count FROM `user` WHERE DATE_FORMAT(date_issued, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-09-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-09-01'))";
    $sep_count = mysqli_fetch_assoc(mysqli_query($con, $sep_sql))['total_count'] ?? 0;

    $oct_sql = "SELECT COUNT(*) AS total_count FROM `user` WHERE DATE_FORMAT(date_issued, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-10-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-10-01'))";
    $oct_count = mysqli_fetch_assoc(mysqli_query($con, $oct_sql))['total_count'] ?? 0;

    $nov_sql = "SELECT COUNT(*) AS total_count FROM `user` WHERE DATE_FORMAT(date_issued, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-11-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-11-01'))";
    $nov_count = mysqli_fetch_assoc(mysqli_query($con, $nov_sql))['total_count'] ?? 0;

    $dec_sql = "SELECT COUNT(*) AS total_count FROM `user` WHERE DATE_FORMAT(date_issued, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-12-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-12-01'))";
    $dec_count = mysqli_fetch_assoc(mysqli_query($con, $dec_sql))['total_count'] ?? 0;
?>

<script>
    // Area Chart Example
    var ctx = document.getElementById("myAreaChart");
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
                        <?php echo $jan_count; ?>,
                        <?php echo $feb_count; ?>,
                        <?php echo $mar_count; ?>,
                        <?php echo $apr_count; ?>,
                        <?php echo $may_count; ?>,
                        <?php echo $jun_count; ?>,
                        <?php echo $jul_count; ?>,
                        <?php echo $aug_count; ?>,
                        <?php echo $sep_count; ?>,
                        <?php echo $oct_count; ?>,
                        <?php echo $nov_count; ?>,
                        <?php echo $dec_count; ?>
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

<script type="text/javascript">
    // Pie Chart Example
    var ctx = document.getElementById("myPieChart");
    var myPieChart = new Chart(ctx, {
        type: "doughnut",
        data: {
            labels: ["Direct", "Referral", "Social"],
            datasets: [{
                data: [55, 30, 15],
                backgroundColor: [
                    "rgba(0, 97, 242, 1)",
                    "rgba(0, 172, 105, 1)",
                    "rgba(88, 0, 232, 1)"
                ],
                hoverBackgroundColor: [
                    "rgba(0, 97, 242, 0.9)",
                    "rgba(0, 172, 105, 0.9)",
                    "rgba(88, 0, 232, 0.9)"
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