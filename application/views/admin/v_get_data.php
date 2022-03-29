<?php 
$this->load->view('admin/header');
?>
<body>        
<?php 
$this->load->view('admin/menu');
?>        
        <!-- ============ MODAL EDIT =============== -->
        <?php foreach ($data->result_array() as $a):
            $nofak=$a['jual_nofak'];
            $fak=$a['jual_fak'];
            $tgl=$a['jual_tanggal'];
            $pelanggan_nama=$a['pelanggan_nama'];
            $jual_total=$a['jual_total'];
            $user_nama=$a['user_nama'];
            $sales_nama=$a['sales_nama'];
            $sales_id=$a['jual_sales_id'];
            $jual_keterangan=$a['jual_keterangan'];
        ?>
        <div id="largeModal" class="modal show" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a href="<?php echo base_url().'admin/tabel_penjualan'?>" class=" close" aria-hidden="true">×</a>
                        <h3 class="modal-title" id="myModalLabel">Edit Detail Sales</h3>
                    </div>
                    <form class="form-horizontal" method="post" role="form" action="<?=base_url().'admin/tabel_penjualan/edit_sales'?>">
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="control-label col-xs-3" >ID Jual</label>
                                <div class="col-xs-9">
                                    <input name="idjual" class="form-control" type="text" value="<?=$nofak;?>" placeholder="ID Jual..." style="width:335px;" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3" >Nomor Faktur</label>
                                <div class="col-xs-9">
                                    <input class="form-control" type="text" value="<?=$fak;?>" placeholder="PPJ..." style="width:335px;" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3">Nama Sales</label>
                                
                                <div class="col-xs-9">
                                    <select name="salesid" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Sales" data-width="80%" placeholder="Pilih Sales" required autofocus>
                                    <?php foreach ($sales->result_array() as $i) :
                                        $id=$i['sales_id'];
                                        $nm=$i['sales_nama'];
                                        $alamat=$i['sales_alamat'];
                                        $notelp=$i['sales_notelp'];
                                        $nonpwp=$i['sales_nonpwp'];
                                        $status=$i['sales_status'];
                                        if($sales_id==$id): ?>
                                            <option value="<?=$id;?>" selected>
                                            <?=$nm;?>
                                            </option>
                                        <?php elseif($status==1):?>  
                                            <option value="<?=$id;?>">
                                                <?=$nm;?>
                                            </option>
                                        <?php endif;?>
                                    <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input class="btn btn-info" type="submit" value="Update">
                            <a href="<?php echo base_url().'admin/tabel_penjualan'?>" class="btn btn-info" aria-hidden="true">Tutup</a>
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