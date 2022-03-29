<?php 
$this->load->view('admin/header');
?>
<body>
    <!-- Navigation -->
   <?php 
        $this->load->view('admin/menu');
   ?>
            <div class="col-lg-12">
                <h1 class="page-header">Transaksi
                    <small>Retur Penjualan</small>
                    <div class="pull-right"><a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#largeModal" role="button"><span class="fa fa-plus"></span> Cari Barang</a></div>
                </h1>
                <?php
                    $alert=$this->session->flashdata('alert');
                    $message=$this->session->flashdata('msg');
                    if($this->session->flashdata('msg')){
                        echo '<div class="alert alert-'.$alert.'">' . $message . '</div>';
                        $this->session->unset_userdata('msg');
                        $this->session->unset_userdata('alert');
                    }
                ?> 
            </div>
        </div>
        <!-- /.row -->
        <!-- Projects Row -->
        <div class="row">
            <!-- <div class="col-lg-12 mb-2">
                <a href="<?php echo base_url().'admin/laporan/lap_retur'?>" class="btn btn-warning" target="_blank">Cetak Retur</a>
            </div> -->
            <div class="col-lg-12">
            <form action="<?php echo base_url().'admin/retur/simpan_retur'?>" method="post">
            <table>
                <tr>
                    <th>Kode Barang</th>
                </tr>
                <tr>
                    <th><input type="text" name="kode_brg" id="kode_brg" class="form-control input-sm"></th>                     
                </tr>
                    <div id="detail_barang" style="position:absolute;">
                    </div>
            </table>
             </form>
             <br/>
            <table class="table table-bordered table-condensed" style="font-size:11px;margin-top:10px;" id="mydata2">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th style="text-align:center;">Satuan</th>
                        <th style="text-align:center;">Harga(Rp)</th>
                        <th style="text-align:center;">Jumlah</th>
                        <th style="text-align:center;">Subtotal(Rp)</th>
                        <th style="text-align:center;">Keterangan</th>
                        <th style="width:90px;text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php 
                        foreach ($retur->result_array() as $items): ?>
                   
                    <tr>
                         <td><?php echo $items['retur_tanggal'];?></td>
                         <td><?php echo $items['retur_barang_id'];?></td>
                         <td style="text-align:left;"><?php echo $items['retur_barang_nama'];?></td>
                        <td style="text-align:center;"><?php echo $items['retur_barang_satuan'];?></td>
                        <td style="text-align:center;"><?php echo number_format($items['retur_harjul']);?></td>
                        <td style="text-align:center;"><?php echo $items['retur_qty'];?></td>
                        <td style="text-align:center;"><?php echo number_format($items['retur_subtotal']);?></td>
                        <td style="text-align:center;"><?php echo $items['retur_keterangan'];?></td>
                         <td style="text-align:center;"><a href="<?php echo base_url().'admin/retur/hapus_retur/'.$items['retur_id'];?>" class="btn btn-warning btn-xs"><span class="fa fa-close"></span> Hapus</a></td>
                    </tr>
                    
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <hr/>
        </div>
        <!-- /.row -->
         <!-- ============ MODAL ADD =============== -->
        <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Data Barang</h3>
            </div>
                <div class="modal-body" style="overflow:scroll;height:500px;">

                  <table class="table table-bordered table-condensed" style="font-size:11px;" id="mydata">
                    <thead>
                        <tr>
                            <th style="text-align:center;width:40px;">No</th>
                            <th style="width:120px;">Kode Barang</th>
                            <th style="width:240px;">Nama Barang</th>
                            <th>Satuan</th>
                            <th style="width:100px;">Harga (Grosir)</th>
                            <th>Stok</th>
                            <th style="width:100px;text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $no=0;
                        foreach ($data->result_array() as $a):
                            $no++;
                            $id=$a['barang_id'];
                            $nm=$a['barang_nama'];
                            $satuan=$a['barang_satuan'];
                            $harpok=$a['barang_harpok'];
                            $harjul=$a['barang_harjul'];
                            $harjul_grosir=$a['barang_harjul_grosir'];
                            $stok=$a['barang_stok'];
                            $min_stok=$a['barang_min_stok'];
                            $kat_id=$a['barang_kategori_id'];
                            $kat_nama=$a['kategori_nama'];
                    ?>
                        <tr>
                            <td style="text-align:center;"><?php echo $no;?></td>
                            <td><?php echo $id;?></td>
                            <td><?php echo $nm;?></td>
                            <td style="text-align:center;"><?php echo $satuan;?></td>
                            <td style="text-align:right;"><?php echo 'Rp '.number_format($harjul_grosir);?></td>
                            <td style="text-align:center;"><?php echo $stok;?></td>
                            <td style="text-align:center;">
                            <form action="<?php echo base_url().'admin/retur/simpan_retur'?>" method="post">
                            <input type="hidden" name="kode_brg" value="<?php echo $id?>">
                            <input type="hidden" name="nabar" value="<?php echo $nm;?>">
                            <input type="hidden" name="satuan" value="<?php echo $satuan;?>">
                            <input type="hidden" name="harjul" value="<?php echo number_format($harjul_grosir);?>">
                            <input type="hidden" name="qty" value="1" required>
                            <input type="hidden" name="keterangan" value="Rusak" required>
                                <button type="submit" class="btn btn-xs btn-info" title="Pilih"><span class="fa fa-refresh"></span> Retur</button>
                            </form>
                            </td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>          

                </div>

                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    
                </div>
            </div>
            </div>
        </div>

        <!--END MODAL-->

        <hr>

        

    </div>
    <!-- /.container -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#mydata').DataTable();
        } );
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#mydata2').DataTable();
        } );
    </script>
    <?php 
    $this->load->view('admin/footer');
    ?>
</body>
</html>
