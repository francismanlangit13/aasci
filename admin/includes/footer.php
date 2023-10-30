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