                <footer class="footer-admin mt-auto footer-light">
                    <div class="container-xl px-4">
                        <div class="row">
                            <div class="col-md-6 small">Copyright <?php echo date('Y'); ?> &copy; <?= $system['name'] ?></div>
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
        <!-- DataTables JavaScript -->
        <script src="<?php echo base_url ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url ?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
        <!-- Core plugin JavaScript-->
        <script src="<?php echo base_url ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>
        <!-- Other JavaScript -->
        <script src="<?php echo base_url ?>assets/js/litepicker-bundle.js" crossorigin="anonymous"></script>
        <script src="<?php echo base_url ?>assets/js/litepicker.js"></script>
        <!-- Loader JS File -->
        <script src="<?php echo base_url ?>assets/js/loader.js"></script>
        <!-- Validations forms -->
        <script src="<?php echo base_url ?>assets/js/underscore-min.js"></script>
        <!-- Restrictions forms -->
        <!-- <script src="<?php echo base_url ?>assets/js/disable-key.js"></script> -->

        <script>
            window.onload = function() {
                localStorage.setItem("savedPassword", ''); // Clear the value password if user click reload the page.
            }
            function previewImage(frameId, inputId) { // select multiple images viewer if user select desired image.
                let image = document.getElementById(frameId);
                let fileInput = document.getElementById(inputId);
                
                if (fileInput.files.length > 0) {
                    let file = fileInput.files[0];
                    image.src = URL.createObjectURL(file);
                } else {
                    image.src = base_url + "assets/files/system/no-image.png";
                }
            }
        </script>
    </body>
</html>