<?php 
$this->load->view('admin/header');
?>
<body>
    <!-- Navigation -->
    <?php 
    $this->load->view('admin/menu');
    ?>
            <div class="col-lg-12">
                <h1 class="page-header">Data
                    <small>Faktur Pembelian</small>
                    <a href="<?=base_url().'admin/detail_barang'?>" class="btn btn-sm btn-info" role="button"><span class="fa fa-eye"></span> Tabel Detail Faktur Barang</a>
                    <div class="pull-right"><a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#ModalAdd"><span class="fa fa-plus"></span> Tambah Faktur Beli</a></div>
                </h1>
                <div class="alert alert-warning">Pastikan Anda sudah menginput Data Barang!</div>
                <?php
                    $alert=$this->session->flashdata('alert');
                    $message=$this->session->flashdata('msg');
                    $idkobel=$this->session->flashdata('kobel');
                    if($this->session->flashdata('msg')){
                        echo '<div class="alert alert-'.$alert.'">' . $message . '<a class="btn btn-xs btn-info" href="#modalLihat" data-toggle="modal" title="Lihat"><span class="fa fa-eye"></span> Lihat</a></div>';
                        $this->session->unset_userdata('msg');
                        $this->session->unset_userdata('alert');
                    }
                ?> 
                <?php 
                
                ?>
            </div>
            <!-- /.row -->
<!-- Tabel Row -->
        </div>
        <div class="row">
            <div class="col-lg-12">
            <table id="DtPembelian" class="table table-striped table-bordered dt-responsive nowrap" style="font-size:11px;">
            </table>
            
            </div>
        </div>

        
        
        <!--Modal Add Pengguna-->
    <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
            <h4 class="modal-title" id="myModalLabel">Add Faktur Beli</h4>
          </div>
          <form class="form-horizontal" id="Form" action="<?php echo base_url('admin/beli/tambah_beli')?>" method="post" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="form-group">
                <label for="inputUserName" class="col-xs-3 control-label">Nomor Faktur Pembelian</label>
                <div class="col-xs-9">
                  <input type="text" name="nofak" class="form-control" id="inputUserName" placeholder="Nomor Faktur Pembelian" style="width:335px;" required autofocus>
                </div>
              </div>
              <div class="form-group">
                <label for="inputUserName" class="col-xs-3 control-label">Tanggal</label>
                <div class="input-group col-xs-7 date" id="datepicker" style="padding-right: 59px;
    padding-left: 15px;">
                  <input type="text" name="tgl" class="form-control" id="inputUserName" placeholder="Tanggal" required>
                  <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                  </span>
                </div>
              </div>
              <div class="form-group">
                <label for="inputUserName" class="col-xs-3 control-label">Suplier</label>
                <div class="col-xs-9">
                <select name="idsup" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Suplier" data-width="80%" placeholder="Pilih Suplier" required>
                    <?php foreach ($sup->result_array() as $b):
                        $id_sup=$b['suplier_id'];
                        $nm_sup=$b['suplier_nama'];
                    ?>
                    <option value="<?=$id_sup;?>"><?=$nm_sup;?></option>
                    <?php endforeach;?>
                    </select>
                </div>
              </div>
            <div class="form-group">
              <label for="inputUserName" class="col-xs-3 control-label">Total Beli</label>
              <div class="col-xs-9">
                <input name="total" class="form-control" type="number" placeholder="Total Beli..." style="width:335px;">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary btn-flat" id="simpan">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- /.container -->
<?php 
$this->load->view('admin/footer');
?> 
<script type="text/javascript">
        $(document).ready(function() {
            $('#DtPembelian').DataTable({
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
                    "url" : '<?= base_url('admin/beli/datatables') ?>',
                    "type" : 'post',
              },"columns": [
                  {"data": "beli_kode", "name":"beli_kode", "title" : "ID", "render": function ( data, type, full ) {
                        return `
                        <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                          <li><button data-toggle="modal" data-target="#modalLihat" data-edit="${full['beli_kode']}" class="btn btn-warning text-white btn-block" title="Ubah Data">Ubah</button></li>
                        </ul>
                        </div>`;
                
                      }},
                  {"data": "beli_nofak", "name":"beli_nofak", "title" : "Nomor Faktur"},
                  {"data": "beli_tanggal", "name":"beli_tanggal", "title" : "Tanggal"},
                  {"data": "suplier_nama", "name":"suplier_nama", "title" : "Nama Principal"},
                  { mData: "beli_total","title": "Total Beli",  render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp. ' )},
                  {"data": "user_nama", "name":"user_nama", "title" : "Nama Petugas ID"},
                  {"data": "beli_kode", "name":"beli_kode", "title" : "Keterangan"},
                  ]
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
        });
    </script>
    <script type="text/javascript">
        $(function(){
            $('.harpok1').on("input",function(){
                var harpok1=$('.harpok1').val();
                var hsl1=harpok1.replace(/[^\d]/g,"");
                var ongkir1 = +hsl1 * 3 / 100;
                var total1 = +hsl1 + +ongkir1;
                $('.harpok2').val(total1);
            })
            
        });
    </script>   
</body>

</html>
