                <footer class="footer-admin mt-auto footer-light noprint">
                    <div class="container-xl px-4">
                        <div class="row">
                            <div class="col-md-6 small">Copyright <?php echo date('Y'); ?> &copy; <?= $system['name'] ?></div>
                            <div class="col-md-6 text-md-end small">
                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#btn_privacy">Privacy Policy</a>
                                &middot;
                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#btn_terms">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- Modal for View Privacy -->
                <div class="modal fade" id="btn_privacy" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="view_userLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg d-grid" role="document" style="justify-items: center;">
                        <div class="modal-content">
                            <div class="modal-header card-header">
                                <h6 class="modal-title"><?= $system['shortname'] ?> | Privacy Policy</h6>
                                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div> 
                            <div class="modal-body"> 
                                <h6 style="text-align: justify; text-justify:inter-word"><?= $system['privacy'] ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal for View Terms -->
                <div class="modal fade" id="btn_terms" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="view_userLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg d-grid" role="document" style="justify-items: center;">
                        <div class="modal-content">
                            <div class="modal-header card-header">
                                <h6 class="modal-title"><?= $system['shortname'] ?> | Terms & Conditions</h6>
                                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div> 
                            <div class="modal-body"> 
                                <h6 style="text-align: justify; text-justify:inter-word"><?= $system['terms'] ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
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
        <script src="<?php echo base_url ?>assets/vendor/datatables/colReorder.min.js"></script>
        <!-- Core plugin JavaScript-->
        <script src="<?php echo base_url ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>
        <!-- Other JavaScript -->
        <script src="<?php echo base_url ?>assets/js/litepicker-bundle.js" crossorigin="anonymous"></script>
        <script src="<?php echo base_url ?>assets/js/litepicker.js"></script>
        <!-- Loader JS File -->
        <script src="<?php echo base_url ?>assets/js/loader.js"></script>
        <!-- GlightBox -->
        <script src="<?php echo base_url ?>assets/vendor/glightbox/js/glightbox.js"></script>
        <script>
            var lightbox = GLightbox();
            lightbox.on('open', (target) => {
                console.log('lightbox opened');
            });
            var lightboxDescription = GLightbox({
                selector: '.glightbox2'
            });
            var lightboxVideo = GLightbox({
                selector: '.glightbox3'
            });
            lightboxVideo.on('slide_changed', ({ prev, current }) => {
                console.log('Prev slide', prev);
                console.log('Current slide', current);

                const { slideIndex, slideNode, slideConfig, player } = current;

                if (player) {
                    if (!player.ready) {
                        // If player is not ready
                        player.on('ready', (event) => {
                            // Do something when video is ready
                        });
                    }

                    player.on('play', (event) => {
                        console.log('Started play');
                    });

                    player.on('volumechange', (event) => {
                        console.log('Volume change');
                    });

                    player.on('ended', (event) => {
                        console.log('Video ended');
                    });
                }
            });

            var lightboxInlineIframe = GLightbox({
                selector: '.glightbox4'
            });

            /* var exampleApi = GLightbox({ selector: null });
            exampleApi.insertSlide({
                href: 'https://picsum.photos/1200/800',
            });
            exampleApi.insertSlide({
                width: '500px',
                content: '<p>Example</p>'
            });
            exampleApi.insertSlide({
                href: 'https://www.youtube.com/watch?v=WzqrwPhXmew',
            });
            exampleApi.insertSlide({
                width: '200vw',
                content: document.getElementById('inline-example')
            });
            exampleApi.open(); */
        </script>
        <!-- Validations forms -->
        <script src="<?php echo base_url ?>assets/js/underscore-min.js"></script>
        <!-- Restrictions forms -->
        <!-- <script src="<?php echo base_url ?>assets/js/disable-key.js"></script> -->

        <script>
            var base_url = "<?php echo base_url ?>"; // Global base_url in javascript
            var base_app = "<?php echo base_app ?>"; // Global base_app in javascript
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