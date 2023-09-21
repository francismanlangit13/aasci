                <footer class="footer-admin mt-auto footer-light">
                    <div class="container-xl px-4">
                        <div class="row">
                            <div class="col-md-6 small">Copyright &copy; Your Website 2021 Made from <a href="https://www.startbootstrap.com" target="_blank">Startbootstap.com</a></div>
                            <div class="col-md-6 text-md-end small">
                                <a href="#!">Privacy Policy</a>
                                &middot;
                                <a href="#!">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <!-- Sweetalert JavaScript -->
        <script src="<?php echo base_url ?>assets/js/sweetalert.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="<?php echo base_url ?>assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo base_url ?>assets/js/scripts.js"></script>
        <?php if (strpos($_SERVER['PHP_SELF'], 'home/index.php') !== false){ ?>
            <!-- Charts JavaScript -->
            <script src="<?php echo base_url ?>assets/js/Chart.min.js" crossorigin="anonymous"></script>
            <script src="<?php echo base_url ?>assets/demo/chart-area-demo.js"></script>
            <script src="<?php echo base_url ?>assets/demo/chart-bar-demo.js"></script>
            <script src="<?php echo base_url ?>assets/demo/chart-pie-demo.js"></script>
        <?php } ?>
        <!-- Simple DataTables JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="<?php echo base_url ?>assets/js/datatables/datatables-simple-demo.js"></script>
        <!-- Other JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/litepicker/dist/bundle.js" crossorigin="anonymous"></script>
        <script src="<?php echo base_url ?>assets/js/litepicker.js"></script>
        <!-- Loader JS File -->
        <script src="<?php echo base_url ?>assets/js/loader.js"></script>
        <!-- Validations forms -->
        <script src="<?php echo base_url ?>assets/js/jquery-3.2.1.min.js"></script>
        <script src="<?php echo base_url ?>assets/js/underscore-min.js"></script>

        <script>
            window.onload = function() {
                localStorage.setItem("savedPassword", ''); // Clear the value password if user click reload the page.
            }
        </script>
    </body>
</html>