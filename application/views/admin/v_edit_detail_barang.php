<?php 
$this->load->view('admin/header');
?>
<body>        
<?php 
$this->load->view('admin/menu');
?>  		
		<!-- ============ MODAL EDIT =============== -->
        <?php foreach ($data->result_array() as $a):
        	$id=$a['d_barang_id'];
        	$nm=$a['barang_nama'];
            $spc=$a['barang_spesifikasi'];
            $satuan=$a['satuan_nama'];
            $d_barang_id=$a['d_barang_brg_id'];
            $d_barang_lot=$a['d_barang_lot'];
            $d_barang_exp=$a['d_barang_exp'];
            $d_barang_stok=$a['d_barang_stok'];
            $d_barang_harga_pokok=$a['d_barang_harga_pokok'];
            $d_barang_tgl_input=$a['d_barang_tgl_input'];
            $d_barang_tgl_update=$a['d_barang_tgl_last_update'];
            $d_barang_status=$a['d_barang_status'];
            $beli_kode=$a['d_barang_beli_kode'];
        ?>
        <div id="modalEditDetailBarang" class="modal show" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a href="<?php echo base_url().'admin/detail_barang'?>" class=" close" aria-hidden="true">×</a>
                        <h3 class="modal-title" id="myModalLabel">Edit Detail Barang</h3>
                    </div>
                    <form class="form-horizontal" method="post" role="form" action="<?=base_url().'admin/detail_barang/edit_detail_barang'?>">
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="control-label col-xs-3">Nomor Faktur</label>
                                <div class="col-xs-9">
                                    <select name="belikode" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih No Faktur" data-width="80%" placeholder="Pilih Nomor Faktur" required autofocus>
                                    <?php foreach ($beli->result_array() as $a) :
                                        $nofak=$a['beli_nofak'];
                                        $tgl=$a['beli_tanggal'];
                                        $total=$a['beli_total'];
                                        $supid=$a['beli_suplier_id'];
                                        $userid=$a['beli_user_id'];
                                        $supnm=$a['suplier_nama'];
                                        $usernm=$a['user_nama'];
                                        $kobel=$a['beli_kode'];
                                        if($beli_kode==$kobel): ?>
                                            <option value="<?=$kobel;?>" selected>
                                            <?=$nofak;?> ~ <?=$tgl;?> ~ <?=$supnm;?>
                                            </option>
                                        <?php elseif($beli_kode==NULL):?>
                                            <option value="NULL" selected>NULL</option>
                                        <?php else:?>  
                                            <option value="<?=$kobel;?>">
                                                <?=$nofak;?> ~ <?=$tgl;?> ~ <?=$supnm;?>
                                            </option>
                                        <?php endif;?>
                                    <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3" >ID Barang Detail</label>
                                <div class="col-xs-9">
                                    <input name="id" class="form-control" type="text" value="<?=$id;?>" placeholder="ID Barang..." style="width:335px;" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3" >Id Identitas Barang</label>
                                <div class="col-xs-9">
                                    <input name="idbrg" class="form-control" type="text" value="<?=$d_barang_id;?>" placeholder="ID Identitas Barang..." style="width:335px;" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3" >Identitas Barang</label>
                                <div class="col-xs-9">
                                    <input class="form-control" type="text" value="<?=$nm.'||'.$spc.'||'.$satuan;?>" placeholder="ID Identitas Barang..." style="width:335px;" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3" >Barang LOT</label>
                                <div class="col-xs-9">
                                    <input name="lot" class="form-control" type="text" value="<?=$d_barang_lot;?>" placeholder="barang LOT..." style="width:335px;" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3" >Barang EXP</label>
                                <div class="col-xs-9">
                                    <input name="exp" class="form-control" type="text" value="<?=$d_barang_exp;?>" placeholder="Barang EXP..." style="width:335px;" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3" >Stok Barang Sekarang</label>
                                <div class="col-xs-9">
                                    <input name="stoksekarang" class="form-control" type="text" value="<?=$d_barang_stok;?>" placeholder="Barang Stok Sekarang..." style="width:335px;" required readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3" >Tambah Barang Stok</label>
                                <div class="col-xs-9">
                                    <input name="stok" class="form-control" type="text" placeholder="Barang Stok..." style="width:335px;" required readonly value="0">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3" >Harga Barang Pokok</label>
                                <div class="col-xs-9">
                                    <input name="harga" class="form-control" type="text" value="<?=$d_barang_harga_pokok;?>" placeholder="Harga Barang Pokok..." style="width:335px;" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3" >Tgl Input</label>
                                <div class="col-xs-9">
                                    <input name="tglinput" class="form-control" type="text" value="<?=$d_barang_tgl_input;?>" placeholder="Barang Stok..." style="width:335px;" required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input class="btn btn-info" type="submit" value="Update">
                            <a href="<?php echo base_url().'admin/detail_barang'?>" class="btn btn-info" aria-hidden="true">Tutup</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
<?php 
$this->load->view('admin/footer');
?> 
</body>
</html>