<?php 
$this->load->view('admin/header');
?>
<body>        
<?php 
$this->load->view('admin/menu');
?>  
		<!-- ============ MODAL EDIT =============== -->
<div id="largeModal" class="modal show" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <a href="<?php echo base_url().'admin/barang'?>" class=" close" aria-hidden="true">×</a>
                <h3 class="modal-title" id="myModalLabel">Opname</h3>
            </div>
            <div class="modal-body" style="overflow:scroll;height:500px;">
                <div class="row">
                    <div class="col-lg-12">
                    <table class="table table-bordered table-condensed" style="font-size:11px;" id="mydata">
                        <thead>
                            <tr>
                                <th style="text-align:center;width:10px;">No</th>
                                <th>Jenis</th>
                                <th>Nomor Faktur</th>
                                <th>Suplier/Pelanggan</th>
                                <th>Identitas Barang</th>
                                <th>LOT</th>
                                <th>EXP</th>
                                <th>Jumlah Beli</th>
                                <th>Jumlah Jual</th>
                                <th>Harga Beli/Jual</th>
                                <th style="width:100px;text-align:center;">Total Beli/Jual</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $no=0;
                            foreach ($data->result_array() as $a):
                                $no++;
                                $t_qty=0;
                                $id=$a['barang_id'];
                                $nm=$a['barang_nama'];
                                $spc=$a['barang_spesifikasi'];
                                $satuan=$a['satuan_nama'];
                                $suplier=$a['suplier_nama'];
                                $stok=$a['barang_total_stok'];
                                $kat_nama=$a['kategori_nama'];
                                $d_barang_id=$a['d_barang_id'];
                                $d_barang_lot=$a['d_barang_lot'];
                                $d_barang_exp=$a['d_barang_exp'];
                                $d_barang_stok=$a['d_barang_stok'];
                                $d_barang_stok_beli=$a['d_barang_jumlah_beli'];
                                $d_barang_harga_pokok=$a['d_barang_harga_pokok'];
                                $d_barang_tgl_input=$a['d_barang_tgl_input'];
                                $d_barang_tgl_update=$a['d_barang_tgl_last_update'];
                                $d_barang_status=$a['d_barang_status'];
                                $d_barang_beli_kode=$a['d_barang_beli_kode'];
                                $d_barang_harga_total=$a['d_barang_harga_total'];
                                $b_nofak=$a['beli_nofak'];
                            ?>
                            <tr>
                                    <td style="text-align:center;width: 10px !important;"><?=$no;?></td>
                                    <td>Beli</td>
                                    <td><span class="btn btn-xs btn-success"><?=$b_nofak;?></span></td>
                                    <td><?=$suplier;?></td>
                                    <td>
                                        <span class="btn btn-xs btn-success"><?=$kat_nama;?></span>
                                        <span class="btn btn-xs btn-warning"><?=$nm;?></span>
                                        <span class="btn btn-xs btn-info"><?=$spc;?></span>
                                    </td>
                                    <td><?=$d_barang_lot;?></td>
                                    <td><?=$d_barang_exp;?></td>
                                    <td>
                                        <span class="btn btn-xs btn-success"><?=$d_barang_stok_beli;?></span>
                                        <span class="btn btn-xs btn-warning"><?=$satuan;?></span>
                                    </td>
                                    <td>
                                    </td>
                                    <td>Rp. <?=number_format($d_barang_harga_pokok);?></td>
                                    <td>Rp. <?=number_format($d_barang_harga_total);?></td>
                                    <td><?=$d_barang_status;?></td>
                            </tr>
                            <?php
                                $t_qty=0;
                                foreach ($data_jual->result_array() as $b):
                                    $j_nofak=$b['jual_fak'];
                                    $idbrg=$b['d_jual_d_barang_id'];
                                    $harjul=$b['d_jual_barang_harjul'];
                                    $jual_pelanggan=$b['pelanggan_nama'];
                                    $qty=$b['d_jual_qty'];
                                    $diskon=$b['d_jual_diskon'];
                                    $total=$b['d_jual_total'];
                                if($idbrg==$d_barang_id):
                                ?>
                                <tr>
                                    <td style="text-align:center;width: 10px !important;"></td>
                                    <td>Jual</td>
                                    <td><span class="btn btn-xs btn-success"><?=$j_nofak;?></span></td>
                                    <td><?=$jual_pelanggan;?></td>
                                    <td><span class="btn btn-xs btn-success"><?=$kat_nama;?></span>
                                        <span class="btn btn-xs btn-warning"><?=$nm;?></span>
                                        <span class="btn btn-xs btn-info"><?=$spc;?></span>
                                    </td>
                                    <td><?=$d_barang_lot;?></td>
                                    <td><?=$d_barang_exp;?></td>
                                    <td>
                                    </td>
                                    <td>
                                        <span class="btn btn-xs btn-danger"><?=$qty;?></span>
                                        <?php $t_qty=($t_qty+$qty);?>
                                        <span class="btn btn-xs btn-warning"><?=$satuan;?></span>
                                    </td>
                                    <td>Rp. <?=number_format($harjul);?></td>
                                    <td><?=number_format($total);?></td>
                                    <td></td>
                                </tr>

                                <?php endif;?>
                            <?php endforeach;?>
                            <tr><?php $total_qty=($d_barang_stok_beli-$t_qty); ?>
                                <td colspan="7">Sisa </td>
                                <td>Hasil Pengurangan</td>
                                <td><?=$total_qty;?></td> 
                                <td>Stok yang tercantum</td>
                                <td><?=$d_barang_stok;?></td>     
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                    </div>
                </div>     
            </div>
            <div class="modal-footer">
                <a href="<?php echo base_url().'admin/barang'?>" class="btn btn-info" aria-hidden="true">Tutup</a>
            </div>
        </div>
    </div>
</div>
<?php 
$this->load->view('admin/footer');
?> 
</body>
</html>