<?php 
$this->load->view('admin/header');
?>
<body>        
<?php 
$this->load->view('admin/menu');
?>  
<div class="modal show" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <a href="<?php echo base_url().'admin/tabel_penjualan'?>" class=" close" aria-hidden="true">×</a>
                <h3 class="modal-title" id="myModalLabel">Data Faktur</h3>
            </div>
            <div class="modal-body" style="overflow:scroll;height:500px;">                                              
                <table class="table table-bordered table-condensed" style="font-size:11px;" id="mydata">
                    <thead>
                        <tr>
                            <th style="text-align:center;width:40px;">No</th>
                            <th style="text-align:center;width:40px;">No Fak</th>
                            <th style="text-align:center;width:40px;">LOT</th>
                            <th style="text-align:center;width:40px;">EXP</th>
                            <th style="width:120px;">Kode Barang</th>
                            <th style="width:240px;">Nama Barang</th>
                            <th>Harga(Input)</th>
                            <th>Diskon</th>
                            <th>Qty</th>
                            <th>Satuan</th>
                            <th style="width:100px;text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $no=0;
                        foreach ($jual->result_array() as $a):
                            $no++;
                            $julid=$a['d_jual_id'];
                            $nofak=$a['d_jual_nofak'];
                            $idbrg=$a['d_jual_d_barang_id'];
                            $harjul=$a['d_jual_barang_harjul'];
                            $qty=$a['d_jual_qty'];
                            $diskon=$a['d_jual_diskon'];
                            $total=$a['d_jual_total'];
                    ?>
                        <tr>
                            <td style="text-align:center;"><?php echo $no;?></td>
                            <td style="text-align:center;"><?php echo $nofak;?></td>
                            <?php foreach ($barang->result_array() as $b):
                                $id=$b['d_barang_id'];
                                $nm=$b['barang_nama'];
                                $spc=$b['barang_spesifikasi'];
                                $satuan=$b['satuan_nama'];
                                $d_barang_id=$b['d_barang_brg_id'];
                                $d_barang_lot=$b['d_barang_lot'];
                                $d_barang_exp=$b['d_barang_exp'];
                                $d_barang_stok=$b['d_barang_stok'];
                                $d_barang_harga_pokok=$b['d_barang_harga_pokok'];
                                $d_barang_tgl_input=$b['d_barang_tgl_input'];
                                $d_barang_tgl_update=$b['d_barang_tgl_last_update'];
                                $d_barang_status=$b['d_barang_status'];
                                $beli_kode=$b['d_barang_beli_kode'];?>
                            <?php if($idbrg==$id):?>
                            <td><?php echo $d_barang_lot;?></td>
                            <td><?php echo $d_barang_exp;?></td>
                            <td><?php echo $id;?></td>
                            <td><?php echo $nm.''.$spc;?></td>
                            <td style="text-align:right;"><?php echo 'Rp '.number_format($harjul);?></td>
                            <td style="width:30px;"><?php echo $diskon;?></td>
                            <td style="width:30px;"><?php echo $qty;?></td>
                            <td style="text-align:center;"><?php echo $satuan;?></td>
                            <td style="text-align:center;">
                            <a data-dismiss="modal" data-toggle="modal" data-target="#modalHapus<?php echo $id?>" class="btn btn-primary">Hapus</a>
                            </td>
                            <?php endif;?>
                            <?php endforeach;?>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>          
            </div>
            <div class="modal-footer">
                <a href="<?php echo base_url().'admin/tabel_penjualan'?>" class="btn btn-info">Tutup</a>
            </div>
        </div>
    </div>
</div>
<?php 
    $no=0;
    foreach ($jual->result_array() as $a):
        $no++;
        $julid=$a['d_jual_id'];
        $nofak=$a['d_jual_nofak'];
        $idbrg=$a['d_jual_d_barang_id'];
        $harjul=$a['d_jual_barang_harjul'];
        $qty=$a['d_jual_qty'];
        $diskon=$a['d_jual_diskon'];
        $total=$a['d_jual_total'];
?>
    <?php foreach ($barang->result_array() as $b):
        $id=$b['d_barang_id'];
        $nm=$b['barang_nama'];
        $spc=$b['barang_spesifikasi'];
        $satuan=$b['satuan_nama'];
        $d_barang_id=$b['d_barang_brg_id'];
        $d_barang_lot=$b['d_barang_lot'];
        $d_barang_exp=$b['d_barang_exp'];
        $d_barang_stok=$b['d_barang_stok'];
        $d_barang_harga_pokok=$b['d_barang_harga_pokok'];
        $d_barang_tgl_input=$b['d_barang_tgl_input'];
        $d_barang_tgl_update=$b['d_barang_tgl_last_update'];
        $d_barang_status=$b['d_barang_status'];
        $beli_kode=$b['d_barang_beli_kode'];?>
    <?php if($idbrg==$id):?>
<div id="modalHapus<?php echo $id?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="modal-title" id="myModalLabel">Hapus/Edit Barang</h3>
    </div>
    <form method="post" target="_self" id="Form" class="form-horizontal" action="<?php echo base_url().'admin/tabel_penjualan/hapus_detail_faktur'?>" role="form">
        <div class="modal-body">
            <p>Panduan:</p>
            <p>Untuk menghapus barang silahkan isikan jumlah barang yang dihapus! </p>
            <p>Untuk menambah barang silahkan isikan total barang setelah ditambah! </p>

            <input type="radio" id="hapus" name="gender" value="">
            <label for="male">Tambah menjadi</label><br>
            <input type="radio" id="tambah" name="gender" value="">
             <label for="male">Dikurangi sejumlah</label><br>
            <span>Jumlah</span>
            <input type="text" name="qty" value="<?php echo $qty;?>">
            <input type="hidden" name="nofak" value="<?php echo $nofak;?>">
            <p>Yakin mau menghapus/edit data <b><?php echo $nm;?></b>..?</p>
            <input type="hidden" name="brgid" value="<?php echo $d_barang_id;?>">
            <input type="hidden" name="kode" value="<?php echo $julid;?>">
            <input type="hidden" name="dbrgid" value="<?php echo $idbrg;?>">
            <input type="hidden" name="dbrgnm" value="<?php echo $nm;?>">
            <input type="hidden" name="total" value="<?php echo $total;?>">
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
            <button type="submit" class="btn btn-primary">Edit</button>
        </div>
    </form>
    <?php endif;?>
    <?php endforeach;?>
</div>
</div>
</div>
<?php endforeach;?>
<?php 
$this->load->view('admin/footer');
?> 
</body>
</html>