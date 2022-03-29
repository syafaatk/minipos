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
                    <small> Detail Beli Barang</small>    
                    <a href="<?=base_url().'admin/beli'?>" class="btn btn-sm btn-info" role="button"><span class="fa fa-eye"></span> Tabel Faktur Pembelian Barang</a>
                    <div class="pull-right"><a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#largeModal" role="button"><span class="fa fa-plus"></span> Tambah Detail Faktur Barang</a></div>
                </h1>
                <div class="alert alert-warning">Pastikan Anda sudah menginput Data Faktur Pembelian!<br>Klik Habiskan jika stok barang kosong!!</div>
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
		<!-- Tabel Row -->
        <div class="row">
            <div class="col-lg-12">
            <table class="table table-bordered table-condensed" style="font-size:11px;" id="mydata">
                <thead>
                    <tr>
                        <th style="text-align:center;width:10px;">No</th>
                        <th>Nomor Faktur</th>
                        <th>Merek</th>
                        <th>Identitas Barang</th>
                        <th>LOT</th>
                        <th>EXP</th>
                        <th>Stok</th>
                        <th>Satuan</th>
                        <th>Harga Pokok</th>
                        <th style="width:100px;text-align:center;">Harga Sub Total</th>
<!--                         <th>Tgl_input</th> -->
<!--                         <th>Tgl_update</th> -->
                        <th>Status</th>
                        <th>Aksi Status</th>
                        <th style="width:35px;text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $no=0;
                    foreach ($data->result_array() as $a):
                        $no++;
                        $id=$a['barang_id'];
                        $nm=$a['barang_nama'];
                        $spc=$a['barang_spesifikasi'];
                        $satuan=$a['satuan_nama'];
                        $stok=$a['barang_total_stok'];
                        $kat_nama=$a['kategori_nama'];
                        $d_barang_id=$a['d_barang_id'];
                        $d_barang_lot=$a['d_barang_lot'];
                        $d_barang_exp=$a['d_barang_exp'];
                        $d_barang_stok=$a['d_barang_stok'];
                        $d_barang_harga_pokok=$a['d_barang_harga_pokok'];
                        $d_barang_tgl_input=$a['d_barang_tgl_input'];
                        $d_barang_tgl_update=$a['d_barang_tgl_last_update'];
                        $d_barang_status=$a['d_barang_status'];
                        $d_barang_beli_kode=$a['d_barang_beli_kode'];
                        $d_barang_harga_total=$a['d_barang_harga_total'];
                        $nofak=$a['beli_nofak'];
                    ?>
                    <tr>
                        <td style="text-align:center;width: 10px !important;"><?=$no;?></td>
                        <td><?=$nofak;?></td>
                        <td><?=$kat_nama;?></td>
                        <td>
                        	<?=$nm;?>
                        	<?=$spc;?>
                        </td>
                        <td><?=$d_barang_lot;?></td>
                        <td><?=$d_barang_exp;?></td>
                        <td>
                            <?php if($d_barang_stok>0):?>
                                <?=$d_barang_stok;?>
                            <?php else:?>
                                <?=$d_barang_stok;?>
                            <?php endif;?>
                        </td>
                        <td><?=$satuan;?></td>
                        <td>Rp. <?=number_format($d_barang_harga_pokok);?></td>
                        <td>Rp. <?=number_format($d_barang_harga_total);?></td>
                        <td><?=$d_barang_status;?></td>
                        <td style="text-align:center;">
                            <?php if($d_barang_status=="habis"):?>
                            <a class="btn btn-xs btn-info" href="#modalAdaDetailBarang<?=$d_barang_id?>" data-toggle="modal" title="Ada"><span class="fa fa-edit"></span> Adakan</a>
                            <?php else:?>
                            <a class="btn btn-xs btn-danger" href="#modalHabisDetailBarang<?=$d_barang_id?>" data-toggle="modal" title="Habis"><span class="fa fa-edit"></span> Habiskan</a>
                            <?php endif;?>
                        </td>
                        <td>
                            <a href="<?php echo base_url().'admin/detail_barang/get_detail_barang/'.$d_barang_id;?>" data-toggle="modal" class="btn btn-xs btn-info"><span class="fa fa-edit"></span></a>
                        </td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
            </div>
        </div>
		<!-- /.row -->
		<!-- ============ MODAL ADD =============== -->
        <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            	<div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title" id="myModalLabel">Tambah Barang Detail</h3>
                    </div>
                    <form class="form-horizontal" method="post" role="form" action="<?=base_url().'admin/detail_barang/tambah_detail_barang'?>">
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="control-label col-xs-3">Nomor Faktur</label>
                                <div class="col-xs-9">
                                    <select name="belikode" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih No Faktur" data-width="80%" placeholder="Pilih Nomor Faktur" required autofocus>
                                    <option value="NULL">NULL</option>
                                    <?php foreach ($beli->result_array() as $a) :
                                        $nofak=$a['beli_nofak'];
                                        $tgl=$a['beli_tanggal'];
                                        $total=$a['beli_total'];
                                        $supid=$a['beli_suplier_id'];
                                        $userid=$a['beli_user_id'];
                                        $supnm=$a['suplier_nama'];
                                        $usernm=$a['user_nama'];
                                        $kobel=$a['beli_kode'];
                                        ?>
                                        <option value="<?=$kobel;?>">
                                            <?=$nofak;?> ~ <?=$tgl;?> ~ <?=$supnm;?>
                                        </option>
                                    <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3">Identitas Barang</label>
                                <div class="col-xs-9">
                                    <select name="idbrg" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Identitas Barang" data-width="80%" placeholder="Pilih Identitas Barang" required autofocus>
                                    <?php foreach ($bar->result_array() as $b) :
                                        $id=$b['barang_id'];
				                        $nm=$b['barang_nama'];
				                        $spc=$b['barang_spesifikasi'];
				                        $satuan=$b['satuan_nama'];
				                        $stok=$b['barang_total_stok'];
				                        $kat_nama=$b['kategori_nama'];
                                        ?>
                                        <option value="<?=$id;?>">
                                        	<?=$kat_nama;?> ~~ <?=$nm;?> ~~ <?=$spc;?>
                                        </option>
                                    <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3" >Barang LOT</label>
                                <div class="col-xs-9">
                                    <input name="lot" class="form-control" type="text" placeholder="Barang LOT.." style="width:335px;" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3" >Barang EXP</label>
                                <div class="col-xs-9">
                                    <input name="exp" class="form-control" type="text" placeholder="Barang EXP.." style="width:335px;" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3" >Barang Harga Pokok</label>
                                <div class="col-xs-9">
                                    <input name="harga" class="form-control" type="text" placeholder="Barang Harga Pokok.." style="width:335px;" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3" >Barang Stok</label>
                                <div class="col-xs-9">
                                    <input name="stok" class="form-control" type="text" placeholder="Barang Stok.." style="width:335px;" required>
                                </div>
                            </div>
                            <div>
	                        	<input name="status" class="form-control" type="hidden" placeholder="Barang Status.." value="ada" style="width:335px;" required>
	                        </div>
	                        <div class="modal-footer">
	                            <input class="btn btn-info" type="submit" value="Submit">
	                            <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
	                        </div>
	                    </div>
                    </form>
                </div>
            </div>
		</div>
		<!-- ============ MODAL HAPUS =============== -->
        <?php foreach ($data->result_array() as $a):
            $id=$a['d_barang_id'];
            $d_barang_id=$a['d_barang_brg_id'];
            $d_barang_stok=$a['d_barang_stok'];
        ?>
        <div id="modalHapusDetailBarang<?=$id?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title" id="myModalLabel">Hapus Barang</h3>
                    </div>
                    <form class="form-horizontal" method="post" role="form" action="<?=base_url().'admin/detail_barang/hapus_detail_barang'?>">
                        <div class="modal-body">
                            <p>Yakin mau menghapus <?=$nm.''.$spc;?> ini..?</p>
                                    <input name="id" type="hidden" value="<?=$id; ?>">
                                    <input name="idbrg" type="hidden" value="<?=$d_barang_id; ?>">
                                    <input name="stok" type="text" value="<?=$d_barang_stok;?>" >
                        </div>
                        <div class="modal-footer">
                            <input class="btn btn-info" type="submit" value="Hapus">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <!--END MODAL-->

        <!-- ============ MODAL HABIS =============== -->
        <?php
        foreach ($data->result_array() as $a) :
            $id=$a['d_barang_id'];?>
                <div id="modalHabisDetailBarang<?=$id?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title" id="myModalLabel">Habiskan Barang</h3>
                    </div>
                    <form class="form-horizontal" method="post" action="<?=base_url().'admin/detail_barang/habiskan'?>">
                        <div class="modal-body">
                            <p>Yakin mau menghabiskan barang <b><?=$id;?></b>..?</p>
                                    <input name="kode" type="hidden" value="<?=$id; ?>">
                        </div>
                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                            <button type="submit" class="btn btn-primary">Habiskan</button>
                        </div>
                    </form>
                </div>
                </div>
                </div>
            <?php
        endforeach;
        ?>

        <!--END MODAL-->    
        <!-- ============ MODAL ADA =============== -->
        <?php
        foreach ($data->result_array() as $a) :
            $id=$a['d_barang_id'];?>
                <div id="modalAdaDetailBarang<?=$id?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title" id="myModalLabel">Adakan Barang</h3>
                    </div>
                    <form class="form-horizontal" method="post" action="<?=base_url().'admin/detail_barang/adakan'?>">
                        <div class="modal-body">
                            <p>Yakin mau mengadakan barang <b><?=$id;?></b>..?</p>
                                    <input name="kode" type="hidden" value="<?=$id; ?>">
                        </div>
                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                            <button type="submit" class="btn btn-primary">Adakan</button>
                        </div>
                    </form>
                </div>
                </div>
                </div>
            <?php
        endforeach;
        ?>

        <!--END MODAL-->    
</div>
		<!-- /.container -->
	<?php 
	$this->load->view('admin/footer');
	?> 
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
