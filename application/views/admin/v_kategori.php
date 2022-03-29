<?php 
$this->load->view('admin/header');
?>
<body>
    <!-- Navigation -->
   <?php 
        $this->load->view('admin/menu');
   ?>
            <div class="col-lg-12">
                <h1 class="page-header">Kategori
                    <small>Barang</small>
                    <div class="pull-right"><a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#largeModal"><span class="fa fa-plus"></span> Tambah Kategori</a></div>
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
            <div class="col-lg-12">
            <table class="table table-bordered table-condensed" style="font-size:11px;" id="mydata">
                <thead>
                    <tr>
                        <th style="text-align:center;width:40px;">No</th>
                        <th>Nama Supplier</th>
                        <th>Kategori</th>
                        <th>Kode Kategori</th>
                        <th style="width:140px;text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $no=0;
                    foreach ($data->result_array() as $a):
                        $no++;
                        $id=$a['kategori_id'];
                        $nm=$a['kategori_nama'];
                        $katkode=$a['kategori_kode'];
                        $kode=$a['suplier_kode'];
                        $nama_sup=$a['suplier_nama'];
                ?>
                    <tr>
                        <td style="text-align:center;"><?php echo $no;?></td>
                        <td><?php echo $nama_sup." (".$kode.")";?></td>
                        <td><?php echo $nm;?></td>
                        <td><?php echo $katkode?></td>
                        <td style="text-align:center;">
                            <a class="btn btn-xs btn-warning" href="#modalEditPelanggan<?php echo $id?>" data-toggle="modal" title="Edit"><span class="fa fa-edit"></span> Edit</a>
                            <a class="btn btn-xs btn-danger" href="#modalHapusPelanggan<?php echo $id?>" data-toggle="modal" title="Hapus"><span class="fa fa-close"></span> Hapus</a>
                        </td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
            <span>Catatan: Data pada Tabel ini tidak boleh ganda!</span>
            </div>
        </div>
        <!-- /.row -->
        <!-- ============ MODAL ADD =============== -->
        <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title" id="myModalLabel">Tambah Kategori</h3>
                    </div>
                    <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/kategori/tambah_kategori'?>" role="form">
                        <div class="modal-body">

                            <div class="form-group">
                                <label class="control-label col-xs-3" >Nama Kategori</label>
                                <div class="col-xs-9">
                                    <input name="kategori" class="form-control" type="text" placeholder="Input Nama Kategori..." style="width:280px;" required autofocus>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3" >Nama Supplier</label>
                                <div class="col-xs-9">
                                    <select name="supplier" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Suplier" data-width="100%" required>
                                        <?php foreach ($sup->result_array() as $i) :
                                            $id_sup=$i['suplier_id'];
                                            $kode_sup=$i['suplier_kode'];
                                            $nm_sup=$i['suplier_nama'];
                                            $al_sup=$i['suplier_alamat'];
                                            $notelp_sup=$i['suplier_notelp'];
                                            $sess_id=$this->session->userdata('suplier');
                                            ?>
                                            <option value="<?php echo $id_sup;?>"><?php echo $nm_sup." (".$kode_sup.")";?></option>";
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3" >Kode Kategori</label>
                                <div class="col-xs-9">
                                    <input name="kode_kategori" class="form-control" type="text" placeholder="Input Kode Kategori..." style="width:280px;" required autofocus>
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

        <!-- ============ MODAL EDIT =============== -->
        <?php
        foreach ($data->result_array() as $a) {
            $id=$a['kategori_id'];
            $nm=$a['kategori_nama'];
            $katkode=$a['kategori_kode'];
            $supid=$a['suplier_id'];

        ?>
                <div id="modalEditPelanggan<?php echo $id?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title" id="myModalLabel">Edit Kategori</h3>
                    </div>
                    <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/kategori/edit_kategori'?>" role="form">
                        <div class="modal-body">
                            <input name="kode" type="hidden" value="<?php echo $id;?>">

                            <div class="form-group">
                                <label class="control-label col-xs-3" >Kategori</label>
                                <div class="col-xs-9">
                                    <input name="kategori" class="form-control" type="text" value="<?php echo $nm;?>" style="width:280px;" required autofocus>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3" >Nama Supplier</label>
                                <div class="col-xs-9">
                                    <select name="supplier" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Suplier" data-width="100%" required>
                                        <?php foreach ($sup->result_array() as $i) :
                                            $id_sup=$i['suplier_id'];
                                            $kode_sup=$i['suplier_kode'];
                                            $nm_sup=$i['suplier_nama'];
                                            $al_sup=$i['suplier_alamat'];
                                            $notelp_sup=$i['suplier_notelp'];
                                            if($supid==$id_sup): ?>
                                            <option value="<?php echo $id_sup?>" selected><?php echo $nm_sup." (".$kode_sup.")";?></option>
                                            <?php else: ?>
                                                <option value="<?php echo $id_sup?>"><?php echo $nm_sup." (".$kode_sup.")";?></option>
                                            <?php endif;?>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3" >Kode Kategori</label>
                                <div class="col-xs-9">
                                    <input name="kode_kategori" class="form-control" type="text" value="<?php echo $katkode;?>" style="width:280px;" required autofocus>
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
            <?php
        }
        ?>

        <!-- ============ MODAL HAPUS =============== -->
        <?php
        foreach ($data->result_array() as $a) :
            $id=$a['kategori_id'];
            $nm=$a['kategori_nama'];
            $katkode=$a['kategori_kode'];
        ?>
                <div id="modalHapusPelanggan<?php echo $id?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title" id="myModalLabel">Hapus Kategori</h3>
                    </div>
                    <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/kategori/hapus_kategori'?>" role="form">
                        <div class="modal-body">
                            <p><?php echo "Yakin mau menghapus ".$nm ; ?></p>
                                    <input name="kode" type="hidden" value="<?php echo $id; ?>">
                                    <input name="kategori" type="hidden" value="<?php echo $nm; ?>">
                        </div>
                        <div class="modal-footer">
                            <input class="btn btn-info" type="submit" value="Hapus" autofocus>
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                        </div>
                    </form>
                </div>
                </div>
                </div>
            <?php
        endforeach;
        ?>

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

<?php 
$this->load->view('admin/footer');
?>
</body>
</html>