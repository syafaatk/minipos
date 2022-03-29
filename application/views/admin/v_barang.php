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
                    <small>Barang</small>
                    <div class="pull-right"><a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#largeModal"><span class="fa fa-plus"></span> Tambah Barang</a></div>
                </h1>
                <div class="alert alert-warning">Pastikan Anda sudah menginput Data Satuan dan Kategori terlebih dahulu!<br>Data tidak boleh ganda!<br>Sebelum menginput data barang, pastikan bahwa barang memang belum ada di data barang!</div>
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
<!-- Tabel Row -->
        <div class="row">
            <div class="col-lg-12">
            <table class="table table-bordered table-condensed" style="font-size:11px;" id="mydata">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Barang</th>
                        <th>Nama Barang Spesifikasi</th>
                        <th>Satuan Barang</th>
                        <th>Kategori Merek</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no=0;
                    foreach ($data->result_array() as $a):
                        $no++;
                        $i=$a['id'];
                        $id=$a['barang_id'];
                        $nm=$a['barang_nama'];
                        $spc=$a['barang_spesifikasi'];
                        $satuan=$a['satuan_nama'];
                        $stok=$a['barang_total_stok'];
                        $kat_nama=$a['kategori_nama'];
                        $sup_nama=$a['suplier_nama'];
                    ?>
                    <tr>
                        <td><?=$no;?></td>
                        <td><?=$id;?></td>
                        <td><?=$nm.'--'.$spc;?></td>
                        <td><?=$satuan;?></td>
                        <td><?=$kat_nama.' / '.$sup_nama;?></td>
                        <td><?=$stok;?></td>
                        <td>
                            <a class="btn btn-xs btn-warning" href="<?php echo base_url().'admin/barang/get_barang/'.$id;?>" data-toggle="modal"><span class="fa fa-edit"></span> Edit</a>
                            <a class="btn btn-xs btn-warning" href="<?php echo base_url().'admin/barang/get_detail_barang/'.$id;?>" data-toggle="modal"><span class="fa fa-edit"></span> Opname</a>
                            <!--<a class="btn btn-xs btn-danger" href="#modalHapusBarang<?=$i?>" data-toggle="modal"><span class="fa fa-close"></span> Hapus</a>-->
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
                        <h3 class="modal-title" id="myModalLabel">Tambah Barang</h3>
                    </div>
                    <form class="form-horizontal" method="post" id="Form" role="form" action="<?=base_url().'admin/barang/tambah_barang';?>">
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="control-label col-xs-3" >Nama Barang</label>
                                <div class="col-xs-9">
                                    <input name="nm" class="form-control" type="text" placeholder="Nama Barang..." style="width:335px;" required autofocus>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3" >Spesifikasi Barang</label>
                                <div class="col-xs-9">
                                    <input name="spc" class="form-control" type="text" placeholder="Spesifikasi Barang..." style="width:335px;" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3" >Kategori</label>
                                <div class="col-xs-9">
                                    <select name="idkat" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Kategori" data-width="80%" placeholder="Pilih Kategori" required>
                                    <?php foreach ($kat->result_array() as $a) :
                                        $id_kat=$a['kategori_id'];
                                        $nm_kat=$a['kategori_nama'];
                                        ?>
                                        <option value="<?=$id_kat;?>"><?=$nm_kat;?></option>
                                    <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3" >Satuan</label>
                                <div class="col-xs-9">
                                     <select name="idsat" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Satuan" data-width="80%" placeholder="Pilih Satuan" required>
                                     <?php foreach ($sat->result_array() as $a) :
                                        $id_sat=$a['satuan_id'];
                                        $nm_sat=$a['satuan_nama'];
                                    ?>
                                        <option value="<?=$id_sat;?>"><?=$nm_sat;?></option>
                                    <?php endforeach;?>
                                     </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3" >Total Stok</label>
                                <div class="col-xs-9">
                                    <input name="stok" class="form-control" type="number" placeholder="Stok..." style="width:335px;" value="0" required readonly="readonly">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input class="btn btn-info" type="submit" value="Submit">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- ============ MODAL HAPUS =============== -->
        <?php foreach ($data->result_array() as $a):
            $i=$a['id'];
            $id=$a['barang_id'];
            $nm=$a['barang_nama'];
            $spc=$a['barang_spesifikasi'];
            $satuan=$a['satuan_nama'];
            $stok=$a['barang_total_stok'];
            $kat_nama=$a['kategori_nama'];
        ?>
        <div id="modalHapusBarang<?=$i?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title" id="myModalLabel">Hapus Barang</h3>
                    </div>
                    <form class="form-horizontal" method="post" role="form" action="<?=base_url().'admin/barang/hapus_barang';?>">
                        <div class="modal-body">
                            <p>Yakin mau menghapus ini..?</p>
                                    <input name="kode" type="hidden" value="<?=$id;?>">
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
        <hr>
        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p style="text-align:center;">Copyright &copy; <?php echo '2019';?> PT. Parit Panjang</p>
                </div>
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->
    <?php 
    $this->load->view('admin/footer');
    ?>  
</body>
</html>
