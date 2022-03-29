<?php 
$this->load->view('admin/header');
?>
<body>        
<?php 
$this->load->view('admin/menu');
?>      
<!-- ============ MODAL EDIT =============== -->
        <?php foreach ($data->result_array() as $a):
            $i=$a['id'];
            $id=$a['barang_id'];
            $nm=$a['barang_nama'];
            $spc=$a['barang_spesifikasi'];
            $satnm=$a['satuan_nama'];
            $katnm=$a['kategori_nama'];
            $satid=$a['barang_satuan_id'];
            $katid=$a['barang_kategori_id'];
            $stok=$a['barang_total_stok'];
        ?>
        <div id="modalEditBarang" class="modal show" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title" id="myModalLabel">Edit Barang</h3>
                    </div>
                    <form class="form-horizontal" method="post" role="form" action="<?=base_url().'admin/barang/edit_barang';?>">
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="control-label col-xs-3" >Kode Barang</label>
                                <div class="col-xs-9">
                                    <input name="id" class="form-control" type="text" value="<?=$id;?>" placeholder="ID Barang..." style="width:335px;" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3" >Nama Barang</label>
                                <div class="col-xs-9">
                                    <input name="nm" class="form-control" type="text" value="<?=$nm;?>" placeholder="Nama Barang..." style="width:335px;" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3" >Spesifikasi Barang</label>
                                <div class="col-xs-9">
                                    <input name="spc" class="form-control" type="text" value="<?=$spc;?>" placeholder="Spesifikasi..." style="width:335px;" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3" >Satuan</label>
                                <div class="col-xs-9">
                                    <input name="idsat" class="form-control" type="hidden" value="<?=$satid;?>" placeholder="Satuan..." style="width:335px;" required>
                                    <input class="form-control" type="text" value="<?=$satnm;?>" placeholder="Satuan..." style="width:335px;" required readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3" >Kategori</label>
                                <div class="col-xs-9">
                                    <input name="idkat" class="form-control" type="hidden" value="<?=$katid;?>" placeholder="Kategori..." style="width:335px;" required>
                                    <input class="form-control" type="text" value="<?=$katnm;?>" placeholder="Kategori..." style="width:335px;" required readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3" >Total Stok</label>
                                <div class="col-xs-9">
                                    <input name="stok" class="form-control" type="number" placeholder="Stok..." style="width:335px;" value="<?=$stok;?>" required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input class="btn btn-info" type="submit" value="Update">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
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