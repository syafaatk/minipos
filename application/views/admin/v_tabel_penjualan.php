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
                    <small>Tabel Penjualan <?php
                    if (isset($_POST["bln"]))
                {
                    $date=date_create($_POST["bln"]);
                    echo "Bulan ";
                    echo date_format($date,"F Y");
                }
                ?></small>
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
                <?php 
                if (isset($_POST["bln"]))
                {
                  $bulan = $_POST["bln"];
                  $b=$jmlbln->row_array();?> 
                <table id="DtPenjualanBulan" class="display table table-striped table-bordered dt-responsive nowrap" style="font-size:11px;">
                <tfoot>
                    <tr>
                        <th colspan="1" style="text-align:right"></th>
                        <th colspan="4"></th>
                    </tr>
                </tfoot>
                </table>
                <?php } 
                else 
                {
                  $bulan = null;
                  $b=$jml->row_array();?>
                <table id="DtPenjualan" class="display table table-striped table-bordered dt-responsive nowrap" style="font-size:11px;">
                <tfoot>
                    <tr>
                        <td colspan="1" style="text-align:right"></td>
                        <td colspan="4"></td>
                    </tr>
                </tfoot>
                </table>
                <?php } ?>  
            </div>
        </div>
    </div>
        <?php 
        $this->load->view('admin/footer');
        ?> 
        <script src="http://cdn.datatables.net/plug-ins/1.10.15/dataRender/datetime.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <script type="text/javascript">
        $(document).ready(function() {
             var numberRenderer = $.fn.dataTable.render.number( ',', '.', 2,   ).display;
            $('#DtPenjualan').DataTable({
                "Processing": true,
                "Searching": true,
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
                    "search":         "",
                    "zeroRecords":    "Data Tidak Ditemukan",
                    "paginate": {
                      "first":      "Awal",
                      "last":       "Akhir",
                      "next":       "Lanjut",
                      "previous":   "Kembali"
                    }
                },
                  "autoWidth": false,
                  "ServerSide": true,
                  "scrollX" : true,
                  "scrollCollapse" : true,
                  "ajax": {
                    "url" : '<?= base_url('admin/tabel_penjualan/datatables') ?>',
                    "type" : 'post',
                    },
                  "columns": [
                  {"data": "jual_nofak", "name":"jual_nofak", "title" : "ID", "render": function ( data, type, full ) {
                        return `
                        <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                          <li><button onclick="window.open('<?php echo base_url('admin/tabel_penjualan/get_faktur/')?>${full['jual_nofak']}','_blank'); return false;" class="btn btn-sm btn-success btn-block">Edit</button></li>
                          <li><button onclick="window.open('<?php echo base_url('admin/tabel_penjualan/faktur/')?>${full['jual_nofak']}','_blank'); return false;" class="btn btn-sm btn-success btn-block">Faktur</button></li>
                          <li><button data-del="${full['jual_nofak']}" class="btn btn-sm btn-danger text-white btn-block" disabled title="Hapus Data">Hapus</button></li>
                        </ul>
                        </div>`;
                
                      }},
                  {"data": "jual_fak", "name":"jual_fak", "title" : "Nomor Faktur"},
                  {"data": "jual_tanggal",bSearchable: true,"name":"jual_tanggal", "title" : "Tanggal",render: function ( data, type, row ) {return moment(data).format('DD MMMM YYYY');}},
                  {"data": "pelanggan_nama", "name":"pelanggan_nama", "title" : "Nama Pelanggan"},
                  { mData: 'jual_total',"title": "Total Jual",  render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp. ' )},
                  {"data": "user_nama", "name":"user_nama", "title" : "Nama Petugas ID"},
                  {"data": "sales_nama", "name":"sales_nama", "title" : "Nama Sales"},
                  {"data": "jual_keterangan", "name":"jual_keterangan", "title" : "Keterangan"},
                  ],
                  "footerCallback": function ( row, data, start, end, display ) {
                    var api = this.api(), data;
         
                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '')*1 :
                            typeof i === 'number' ?
                                i : 0;
                    };
         
                    // Total over all pages
                    total = api
                        .column( 4 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
         
                    // Total over this page
                    pageTotal = api
                        .column( 4, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
         
                    // Update footer
                    $( api.column( 4 ).footer() ).html(
                        '<tr><td>Total Per Halaman</td><td>Rp. '+numberRenderer(pageTotal) +' </td></tr><tr><td>Total Seluruh Data</td><td>( Rp. '+numberRenderer(total) +')</td></tr>'
                    );
                }
        });
            $('#DtPenjualanBulan').DataTable({
                "Processing": true,
                "Searching": true,
                "search": {
                    "value": true,
                },
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
                    "search" : "",
                    "zeroRecords":    "Data Tidak Ditemukan",
                    "paginate": {
                      "first":      "Awal",
                      "last":       "Akhir",
                      "next":       "Lanjut",
                      "previous":   "Kembali"
                    }
                },
                  "autoWidth": false,
                  "ServerSide": true,
                  "scrollX" : true,
                  "scrollCollapse" : true,
                  "ajax": {
                    "url" : '<?= base_url('admin/tabel_penjualan/databulan/').$bulan ?>',
                    "type" : 'post',
                    },
                  "columns": [
                  {"data": "jual_nofak", "name":"jual_nofak", "title" : "ID", "render": function ( data, type, full ) {
                        return `
                        <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                          <li><button onclick="window.open('<?php echo base_url('admin/tabel_penjualan/get_faktur/')?>${full['jual_nofak']}','_blank'); return false;" class="btn btn-sm btn-success btn-block">Edit</button></li>
                          <li><button onclick="window.open('<?php echo base_url('admin/tabel_penjualan/faktur/')?>${full['jual_nofak']}','_blank'); return false;" class="btn btn-sm btn-success btn-block">Faktur</button></li>
                          <li><button data-del="${full['jual_nofak']}" class="btn btn-sm btn-danger text-white btn-block"  title="Hapus Data">Hapus</button></li>
                        </ul>
                        </div>`;
                
                      }},
                  {"data": "jual_fak", "name":"jual_fak", "title" : "Nomor Faktur"},
                  {"data": "jual_tanggal",bSearchable: true,"name":"jual_tanggal", "title" : "Tanggal",render: function ( data, type, row ) {return moment(data).format('DD MMMM YYYY');}},
                  {"data": "pelanggan_nama", "name":"pelanggan_nama", "title" : "Nama Pelanggan"},
                  { mData: 'jual_total',"title": "Total Jual",  render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp. ' )},
                  {"data": "user_nama", "name":"user_nama", "title" : "Nama Petugas ID"},
                  {"data": "sales_nama", "name":"sales_nama", "title" : "Nama Sales"},
                  {"data": "jual_keterangan", "name":"jual_keterangan", "title" : "Keterangan"},
                  ],
                  "footerCallback": function ( row, data, start, end, display ) {
                    var api = this.api(), data;
         
                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '')*1 :
                            typeof i === 'number' ?
                                i : 0;
                    };
         
                    // Total over all pages
                    total = api
                        .column( 4 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
         
                    // Total over this page
                    pageTotal = api
                        .column( 4, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
         
                    // Update footer
                    $( api.column( 4 ).footer() ).html(
                        '<tr><td>Total Per Halaman</td><td>Rp. '+numberRenderer(pageTotal) +' </td></tr><tr><td>Total Seluruh Data</td><td>( Rp. '+numberRenderer(total) +')</td></tr>'
                    );
                }
        });
        
        $(document).click(function (event) {
            //hide all our dropdowns
            $('.dropdown-menu[data-parent]').hide();
        
        });
        $(document).on('click', '.dropdown [data-toggle="dropdown"]', function () {
            // if the button is inside a modal
            if ($('body').hasClass('modal-open')) {
                throw new Error("This solution is not working inside a responsive table inside a modal, you need to find out a way to calculate the modal Z-index and add it to the element")
                return true;
            }
        
            $buttonGroup = $(this).parent();
            if (!$buttonGroup.attr('data-attachedUl')) {
                var ts = +new Date;
                $ul = $(this).siblings('ul');
                $ul.attr('data-parent', ts);
                $buttonGroup.attr('data-attachedUl', ts);
                $(window).resize(function () {
                    $ul.css('display', 'none').data('top');
                });
            } else {
                $ul = $('[data-parent=' + $buttonGroup.attr('data-attachedUl') + ']');
            }
            if (!$buttonGroup.hasClass('open')) {
                $ul.css('display', 'none');
                return;
            }
            dropDownFixPosition($(this).parent(), $ul);
            function dropDownFixPosition(button, dropdown) {
                var dropDownTop = button.offset().top + button.outerHeight();
                dropdown.css('top', dropDownTop + "px");
                dropdown.css('left', button.offset().left + "px");
                dropdown.css('position', "absolute");
        
                dropdown.css('width', dropdown.width());
                dropdown.css('heigt', dropdown.height());
                dropdown.css('display', 'block');
                dropdown.appendTo('body');
            }
        });
        // Aksi Hapus
        $(document).on('click','[data-del]',function(){
          var $param = $(this);
    
          var nofak    = $param.data('del');
    
          Swal.fire({
            title: "Apakah Anda Yakin Menghapus Ingin Data, Semua detail barang akan terhapus?",
            text: "Jika Yakin, Silahkan Pilih Ya!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus Sekarang',
            cancelButtonText: 'Tidak, Batalkan!',
            confirmButtonColor: '#d33',
            cancelButtonColor: '#333',
          }).then(isConfirm =>
          {
            if (isConfirm.value==true) {                       
              $.ajax({
                type: 'POST',    
                url: "<?= base_url('admin/tabel_penjualan/hapus_faktur') ?>",
                data: `nofak=${nofak}`,
                success: function(msg){
                  Swal.fire("Terhapus!", msg, "success").then(()=>{
                    location.reload();
                  });
                },
                error: function (request, kategori_sekolah, error) { 
                  Swal.fire("Terjadi Kesalahan", request.responseText, "error");
                }
              });
            } else {
              Swal.fire("Dibatalkan", "Berhasil Membatalkan Penghapusan", "error");
            }
          })
        });
    });
        </script>
        <?php if($this->session->flashdata('msg')=='error'):?>
  <script type="text/javascript">
    $.toast({
      heading: 'Error',
      text: "Password dan Ulangi Password yang Anda masukan tidak sama.",
      showHideTransition: 'slide',
      icon: 'error',
      hideAfter: false,
      position: 'bottom-right',
      bgColor: '#FF4859'
    });
  </script>

  <?php elseif($this->session->flashdata('msg')=='success'):?>
    <script type="text/javascript">
      $.toast({
        heading: 'Success',
        text: "Data Berhasil disimpan ke database.",
        showHideTransition: 'slide',
        icon: 'success',
        hideAfter: false,
        position: 'bottom-right',
        bgColor: '#7EC857'
      });
    </script>
    <?php elseif($this->session->flashdata('msg')=='info'):?>
      <script type="text/javascript">
        $.toast({
          heading: 'Info',
          text: "Data berhasil di update",
          showHideTransition: 'slide',
          icon: 'info',
          hideAfter: false,
          position: 'bottom-right',
          bgColor: '#00C9E6'
        });
      </script>
      <?php elseif($this->session->flashdata('msg')=='success-hapus'):?>
        <script type="text/javascript">
          $.toast({
            heading: 'Success',
            text: "Data Berhasil dihapus.",
            showHideTransition: 'slide',
            icon: 'success',
            hideAfter: false,
            position: 'bottom-right',
            bgColor: '#7EC857'
          });
        </script>
        <?php else:?>

        <?php endif;?>
</body>
</html>