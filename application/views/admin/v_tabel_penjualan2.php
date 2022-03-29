<?php 
$this->load->view('admin/header');
?>
<body>
    <?php 
        $this->load->view('admin/menu');
   ?>        
        <div>
            <div class="col-lg-12">
                <h1 class="page-header">Data
                    <small>Tabel Penjualan</small>
                </h1>
                <?php 
                    $alert=$this->session->flashdata('alert');
                    $message=$this->session->flashdata('msg');
                    if($this->session->flashdata('msg')):
                        echo '<div class="alert alert-'.$alert.'">' . $message . '</div>';
                        $this->session->unset_userdata('msg');
                        $this->session->unset_userdata('alert');
                    endif;
                ?> 
            </div>
        </div>
        <!-- /.row -->
        <!-- Projects Row -->
        <div style="padding: 10px;">
        <div class="row">
            <div class="col-lg-12">
                <table id="DtPenjualan" class="table table-striped table-bordered dt-responsive nowrap" style="font-size:11px;"
                </table>
                    
                <table>
                <tfoot>
                <?php 
                    $b=$jml->row_array();
                ?>
                <tr>
                    <td colspan="8" style="text-align:center;"><b>Total :</b></td>
                    <td style="text-align:right;"><b><?php echo 'Rp.'.number_format($b['total']);?></b></td>
                </tr>
                </tfoot>
                </table>
            </div>
        </div>
    </div>
        <?php 
        $this->load->view('admin/footer');
        ?> 
        <script type="text/javascript">
        $(document).ready(function() {
            $('#DtPenjualan').DataTable({
                "bProcessing": true,
                "language": {
                    "decimal":        ".",
                    "emptyTable":     "Data Tidak Tersedia...",
                    "info":           "Tampil _START_ - _END_ dari _TOTAL_ Data",
                    "infoEmpty":      "Tampil 0 to 0 of 0 Data",
                    "infoFiltered":   "(filter dari _MAX_ total Data)",
                    "infoPostFix":    "",
                    "thousands":      ",",
                    "lengthMenu":     "Tampil _MENU_ Data",
                    "loadingRecords": "Loading...",
                    "processing":     "Memperbarui Data",
                    "searchPlaceholder": "Ketik Untuk Cari Data ...",
                    "search":         "Cari Data",
                    "zeroRecords":    "Data Tidak Ditemukan",
                    "paginate": {
                      "first":      "Awal",
                      "last":       "Akhir",
                      "next":       "Lanjut",
                      "previous":   "Kembali"
                    }
                },
                  "autoWidth": false,
                  "bServerSide": true,
                  "scrollX" : true,
                  "scrollCollapse" : true,
                  "ajax": {
                    "url" : '<?= base_url('admin/tabel_penjualan/datatables') ?>',
                    "type" : 'post',
              },"columns": [
                  {"data": "jual_nofak", "name":"jual_nofak", "title" : "ID", "render": function ( data, type, full ) {
                        return `
                        <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                          <li><button onclick="window.open('<?php echo base_url('admin/tabel_penjualan/get_faktur/')?>${full['jual_nofak']}','_blank'); return false;" class="btn btn-sm btn-success btn-block">Edit</button></li>
                          <li><button onclick="window.open('<?php echo base_url('admin/tabel_penjualan/faktur/')?>${full['jual_nofak']}','_blank'); return false;" class="btn btn-sm btn-success btn-block">Faktur</button></li>
                        </ul>
                        </div>`;
                
                      }},
                  {"data": "jual_fak", "name":"jual_fak", "title" : "Nomor Faktur"},
                  {"data": "jual_tanggal", "name":"jual_tanggal", "title" : "Tanggal"},
                  {"data": "pelanggan_nama", "name":"pelanggan_nama", "title" : "Nama Pelanggan"},
                  { mData: 'jual_total',"title": "Total Jual",  render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp. ' )},
                  {"data": "user_nama", "name":"user_nama", "title" : "Nama Petugas ID"},
                  {"data": "sales_nama", "name":"sales_nama", "title" : "Nama Sales"},
                  {"data": "jual_keterangan", "name":"jual_keterangan", "title" : "Keterangan"},
                  ]
        });});
    </script> 
</body>
</html>