    <script>
        // Function ini dijalankan ketika Halaman ini dibuka pada browser
        $(function(){
        setInterval(timestamp, 1000);//fungsi yang dijalan setiap detik, 1000 = 1 detik
        });
         
        //Fungi ajax untuk Menampilkan Jam dengan mengakses File ajax_timestamp.php
        function timestamp() {
        $.ajax({
        url: '<?php echo site_url(); ?>/welcome/ajax_timestamp',
        success: function(data) {
        $('#timestamp').html(data);
        },
        });
        }
    </script>
    <!-- JavaScript -->

    <script src="<?php echo base_url().'assets/js/jquery.js'?>"></script>
    <script src="<?php echo base_url().'assets/js/bootstrap.min.js'?>"></script>
<!--     <script src="<?php //echo base_url().'assets/simple/js/bootstrap.js'?>"></script> -->
    <script src="<?php echo base_url().'assets/js/jquery.dataTables.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/js/dataTables.bootstrap.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/dist/js/bootstrap-select.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/js/jquery.price_format.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/js/moment.js'?>"></script>
    <script src="<?php echo base_url().'assets/js/bootstrap-datetimepicker.min.js'?>"></script>

    <!-- Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("active");
    });
    </script>
    <script type="text/javascript">
        $('.modal').on('shown.bs.modal', function() {
            $(this).find('[autofocus]').focus();
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#mydata').DataTable({
                "language": {
                    "search":"Cari",
                    "info":"Menampilkan _START_ to _END_ of _TOTAL_ data",
                    "lengthMenu":"Menampilkan _MENU_ baris",
                    "infoEmpty":"Tidak ditemukan",
                    "infoFiltered":"(pencarian dari _MAX_ data)",
                    "zeroRecords":"Data tidak ditemukan",
                    "paginate": {
                        "next":"Selanjutnya",
                        "previous":"Sebelumnya",
                    }
                }
            });
        } );
    </script> 
    <script type="text/javascript">
        $(function(){
            $('#jml_uang').on("input",function(){
                var total=$('#total').val();
                var total3=$('#total3').val();
                var jumuang=$('#jml_uang').val();
                var hsl=jumuang.replace(/[^\d]/g,"");
                var hsl2=total3.replace(/[^\d]/g,"");
                $('#jml_uang2').val(hsl);
                $('#kembalian').val(hsl-hsl2);
            });
            $('#rate_pajak').on("input",function(){
                var total=$('#total').val();
                var rate=$('#rate_pajak').val();
                var hsl= +total * +rate /100;
                $('#pajak').val(hsl);
                $('#total3').val(+hsl + +total);
            })
            
        });
    </script>
    <script type="text/javascript">
            $(function () {
                $('#datetimepicker').datetimepicker({
                    format: 'DD MMMM YYYY HH:mm',
                });
                
                $('#datepicker').datetimepicker({
                    format: 'YYYY-MM-DD',
                });
                $('#datepicker2').datetimepicker({
                    format: 'YYYY-MM-DD',
                });
                $('.datepicker2').datetimepicker({
                    format: 'YYYY-MM-DD',
                });
                $('#timepicker').datetimepicker({
                    format: 'HH:mm'
                });
                $('#tanggal').datetimepicker({
                    format: 'YYYY-MM-DD HH:mm:SS',
                });
            });
    </script>
    <script type="text/javascript">
        $(function(){
            $('.jml_uang').priceFormat({
                    prefix: '',
                    //centsSeparator: '',
                    centsLimit: 0,
                    thousandsSeparator: ','
            });
            $('#jml_uang2').priceFormat({
                    prefix: '',
                    //centsSeparator: '',
                    centsLimit: 0,
                    thousandsSeparator: ''
            });
            $('#kembalian').priceFormat({
                    prefix: '',
                    //centsSeparator: '',
                    centsLimit: 0,
                    thousandsSeparator: ','
            });
            $('.harjul').priceFormat({
                    prefix: '',
                    //centsSeparator: '',
                    centsLimit: 0,
                    thousandsSeparator: ','
            });
            $('.harpok').priceFormat({
                    prefix: '',
                    //centsSeparator: '',
                    centsLimit: 0,
                    thousandsSeparator: ','
            });
            $('.pajak').priceFormat({
                    prefix: '',
                    //centsSeparator: '',
                    centsLimit: 0,
                    thousandsSeparator: ','
            });
            $('.total3').priceFormat({
                    prefix: '',
                    //centsSeparator: '',
                    centsLimit: 0,
                    thousandsSeparator: ','
            });
        });
    </script>   