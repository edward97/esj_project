
    <!-- Modal -->
    <div class="modal fade" id="sign-out" tabindex="-1" role="dialog" aria-labelledby="logoutLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-theme">
                    <h5 class="modal-title" id="logoutLabel">Sign-out</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <p>Are you sure want to sign-out?</p>
                </div>

                <div class="modal-footer">
                    <a href="javascript:;" class="btn btn-sm btn-light" data-dismiss="modal">Cancel</a>
                    <a href="<?=site_url('welcome/logout')?>" class="btn btn-sm bg-theme">Submit</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <!-- Malihu custom scrollbar plugin JS -->
    <script src="https://malihu.github.io/custom-scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>

    <!-- Custom JS -->
    <script src="<?=base_url('assets/js/custom.js')?>"></script>
    <script src="<?=base_url('assets/js/beta.js')?>"></script>

    <script>
        let url = "<?=base_url()?>";
    </script>
</body>
</html>