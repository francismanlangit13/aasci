<?php include ('../includes/header.php'); ?>
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
            <!-- Date range picker example-->
            <div class="input-group input-group-joined border-0 shadow" style="width: 16.5rem; margin-right:10px">
                <span class="input-group-text"><i data-feather="calendar"></i>
                <div class="small" style="margin-left: 5px; margin-top: 3px">
                    <span class="fw-500 text-primary"><?php echo date("l") ?></span>
                    &middot; <?php echo date("F d, Y") ?> &middot; <?php echo date("g:i A") ?>
                </div>
                </span>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <!-- Dashboard info widget 1-->
                <div class="card border-start-lg border-start-primary h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="small fw-bold text-primary mb-1">Earnings (monthly)</div>
                                <div class="h5">$4,390</div>
                                <div class="text-xs fw-bold text-success d-inline-flex align-items-center">
                                    <i class="me-1" data-feather="trending-up"></i>
                                    12%
                                </div>
                            </div>
                            <div class="ms-2"><i class="fas fa-dollar-sign fa-2x text-gray-200"></i></div>
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
                                <div class="small fw-bold text-secondary mb-1">Average sale price</div>
                                <div class="h5">$27.00</div>
                                <div class="text-xs fw-bold text-danger d-inline-flex align-items-center">
                                    <i class="me-1" data-feather="trending-down"></i>
                                    3%
                                </div>
                            </div>
                            <div class="ms-2"><i class="fas fa-tag fa-2x text-gray-200"></i></div>
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
                                <div class="small fw-bold text-success mb-1">Clicks</div>
                                <div class="h5">11,291</div>
                                <div class="text-xs fw-bold text-success d-inline-flex align-items-center">
                                    <i class="me-1" data-feather="trending-up"></i>
                                    12%
                                </div>
                            </div>
                            <div class="ms-2"><i class="fas fa-mouse-pointer fa-2x text-gray-200"></i></div>
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
                                <div class="small fw-bold text-info mb-1">Conversion rate</div>
                                <div class="h5">1.23%</div>
                                <div class="text-xs fw-bold text-danger d-inline-flex align-items-center">
                                    <i class="me-1" data-feather="trending-down"></i>
                                    1%
                                </div>
                            </div>
                            <div class="ms-2"><i class="fas fa-percentage fa-2x text-gray-200"></i></div>
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