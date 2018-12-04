    </div>
    <!-- page-wrapper -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha256-VsEqElsCHSGmnmHXGQzvoWjWwoznFSZc6hs7ARLRacQ=" crossorigin="anonymous"></script>

    <!-- SweetAlert JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha256-KsRuvuRtUVvobe66OFtOQfjP8WA2SzYsmm4VPfMnxms=" crossorigin="anonymous"></script>

    <!-- Bootstrap JS DataTables 4 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/jquery.dataTables.min.js" integrity="sha256-t5ZQTZsbQi8NxszC10CseKjJ5QeMw5NINtOXQrESGSU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/dataTables.bootstrap4.min.js" integrity="sha256-hJ44ymhBmRPJKIaKRf3DSX5uiFEZ9xB/qx8cNbJvIMU=" crossorigin="anonymous"></script>

    <!-- jQuery UI-JS 1.12 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha256-KM512VNnjElC30ehFwehXjx1YCHPiQkOPmqnrWtpccM=" crossorigin="anonymous"></script>

    <!-- Malihu custom scrollbar plugin JS -->
    <script src="https://malihu.github.io/custom-scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>

    <!-- DateTimePicker jQuery plugin select date and time -->
    <script src="<?=base_url('assets/vendor/datetimepicker/jquery.datetimepicker.full.min.js')?>"></script>

    <!-- TinyMCE -->
    <script src="<?=base_url('assets/vendor/tinymce/tinymce.min.js')?>"></script>

    <!-- jQuery number plug-in 2.1.3 -->
    <script src="<?=base_url('assets/vendor/customd-jquery-number/jquery.number.min.js')?>"></script>

    <!-- Custom JS -->
    <script src="<?=base_url('assets/js/custom.js')?>"></script>
    <script src="<?=base_url('assets/js/custom-autocomplete.js')?>"></script>
    <script src="<?=base_url('assets/js/beta.js')?>"></script>

<?php if (gt_uri(1) === 'setup'): ?>
    <!-- Setup -->
    <?php if (gt_uri(2)     === 'divisi'):     ?><script src="<?=base_url('assets/js/setup/divisi.js')?>"></script>
    <?php elseif (gt_uri(2) === 'permintaan'): ?><script src="<?=base_url('assets/js/setup/permintaan.js')?>"></script>
    <?php elseif (gt_uri(2) === 'item'):       ?><script src="<?=base_url('assets/js/setup/item.js')?>"></script>
    <?php elseif (gt_uri(2) === 'size'):       ?><script src="<?=base_url('assets/js/setup/size.js')?>"></script>
    <?php elseif (gt_uri(2) === 'supplier'):   ?><script src="<?=base_url('assets/js/setup/supplier.js')?>"></script>
    <?php elseif (gt_uri(2) === 'user'):       ?><script src="<?=base_url('assets/js/setup/user.js')?>"></script>
    <?php elseif (gt_uri(2) === 'warehouse'):  ?><script src="<?=base_url('assets/js/setup/warehouse.js')?>"></script>
    <?php endif ?>

<?php elseif (gt_uri(1) === 'transaction'): ?>
    <!-- Transaction -->
    <?php if (gt_uri(2)     === 'po'): ?><script src="<?=base_url('assets/js/transaction/po.js')?>"></script>
    <?php elseif (gt_uri(2) === 'pr'): ?><script src="<?=base_url('assets/js/transaction/pr.js')?>"></script>
    <?php endif ?>

<?php elseif (gt_uri(1) === 'formedit'): ?>
    <!-- form edit -->
    <script src="<?=base_url('assets/js/formedit.js')?>"></script>

<?php elseif (gt_uri(1) === 'setting'): ?>
    <!-- Setting -->
    <?php if (gt_uri(2) === 'profile'): ?><script src="<?=base_url('assets/js/setting/profile.js')?>"></script>
    <?php endif ?>

<?php endif ?>

    <script>
        let url = "<?=base_url()?>";

        function responsiveView() {
            wSize = $(window).width();
        
            if (wSize <= 768) {
                $(".page-wrapper").removeClass("toggled");
            }
            if (wSize > 768) {
                $(".page-wrapper").addClass("toggled");
            }
        }
        $(window).on('load', responsiveView);
        $(window).on('resize', responsiveView);
    </script>
</body>
</html>
