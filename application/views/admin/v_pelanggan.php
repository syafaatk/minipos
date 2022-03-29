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
                    <small>Pelanggan</small>
                    <div class="pull-right"><a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#largeModal"><span class="fa fa-plus"></span> Tambah Pelanggan</a></div>
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
                        <th>Nama Pelanggan</th>
                        <th>Alamat</th>
                        <th>No Telp/HP</th>
                        <th>No NPWP</th>
                        <th style="width:140px;text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $no=0;
                    foreach ($data->result_array() as $a):
                        $no++;
                        $id=$a['pelanggan_id'];
                        $nm=$a['pelanggan_nama'];
                        $alamat=$a['pelanggan_alamat'];
                        $notelp=$a['pelanggan_notelp'];
                        $nonpwp=$a['pelanggan_nonpwp'];
                ?>
                    <tr>
                        <td style="text-align:center;"><?php echo $no;?></td>
                        <td><?php echo $nm;?></td>
                        <td><?php echo $alamat;?></td>
                        <td><?php echo $notelp;?></td>
                        <td><?php echo $nonpwp;?></td>
                        <td style="text-align:center;">
                            <a class="btn btn-xs btn-warning" href="#modalEditPelanggan<?php echo $id?>" data-toggle="modal" title="Edit"><span class="fa fa-edit"></span> Edit</a>
                            <a class="btn btn-xs btn-danger" href="#modalHapusPelanggan<?php echo $id?>" data-toggle="modal" title="Hapus"><span class="fa fa-close"></span> Hapus</a>
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
                <h3 class="modal-title" id="myModalLabel">Tambah Pelanggan</h3>
            </div>
            <form class="form-horizontal" method="post" role="form" action="<?php echo base_url().'admin/pelanggan/tambah_pelanggan'?>">
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nama Pelanggan</label>
                        <div class="col-xs-9">
                            <input name="nama" class="form-control" type="text" placeholder="Nama Pelanggan..." style="width:280px;" required>
                        </div>
                    </div>
                        
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Alamat</label>
                        <div class="col-xs-9">
                            <input name="alamat" class="form-control" type="text" placeholder="Alamat..." style="width:280px;" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >No Telp/ HP</label>
                        <div class="col-xs-9">
                            <input name="notelp" class="form-control" type="text" placeholder="No Telp/HP..." style="width:280px;" required>
                        </div>
                    </div>  

                    <div class="form-group">
                        <label class="control-label col-xs-3" >No NPWP</label>
                        <div class="col-xs-9">
                            <input name="nonpwp" class="form-control" type="text" placeholder="No NPWP..." style="width:280px;" required>
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
                        $id=$a['pelanggan_id'];
                        $nm=$a['pelanggan_nama'];
                        $alamat=$a['pelanggan_alamat'];
                        $notelp=$a['pelanggan_notelp'];
                        $nonpwp=$a['pelanggan_nonpwp'];
                    ?>
                <div id="modalEditPelanggan<?php echo $id?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title" id="myModalLabel">Edit Pelanggan</h3>
                    </div>
                    <form class="form-horizontal" method="post" role="form" action="<?php echo base_url().'admin/pelanggan/edit_pelanggan'?>">
                        <div class="modal-body">
                            <input name="kode" type="hidden" value="<?php echo $id;?>">

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nama Pelanggan</label>
                        <div class="col-xs-9">
                            <input name="nama" class="form-control" type="text" placeholder="Nama Pelanggan..." value="<?php echo $nm;?>" style="width:280px;" required>
                        </div>
                    </div>
                        
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Alamat</label>
                        <div class="col-xs-9">
                            <input name="alamat" class="form-control" type="text" placeholder="Alamat..." value="<?php echo $alamat;?>" style="width:280px;">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >No Telp/ HP</label>
                        <div class="col-xs-9">
                            <input name="notelp" class="form-control" type="text" placeholder="No Telp/HP..." value="<?php echo $notelp;?>" style="width:280px;">
                        </div>
                    </div>   

                    <div class="form-group">
                        <label class="control-label col-xs-3" >No NPWP</label>
                        <div class="col-xs-9">
                            <input name="nonpwp" class="form-control" type="text" placeholder="No NPWP..." value="<?php echo $nonpwp;?>" style="width:280px;">
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
                    foreach ($data->result_array() as $a) {
                        $id=$a['pelanggan_id'];
                        $nm=$a['pelanggan_nama'];
                        $alamat=$a['pelanggan_alamat'];
                        $notelp=$a['pelanggan_notelp'];
                        $nonpwp=$a['pelanggan_nonpwp'];
                    ?>
                <div id="modalHapusPelanggan<?php echo $id?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title" id="myModalLabel">Hapus Pelanggan</h3>
                    </div>
                    <form class="form-horizontal" method="post" role="form" action="<?php echo base_url().'admin/pelanggan/hapus_pelanggan'?>">
                        <div class="modal-body">
                            <p>Yakin mau menghapus data..?</p>
                                    <input name="kode" type="hidden" value="<?php echo $id; ?>">
                                    <input name="nama" type="hidden" value="<?php echo $nm; ?>">
                        </div>
                        <div class="modal-footer">
                            <input class="btn btn-info" type="submit" value="Hapus">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                        </div>
                    </form>
                </div>
                </div>
                </div>
            <?php
        }
        ?>

        <!--END MODAL-->

        <hr>

        

    </div>
    <!-- /.container -->
    <?php 
        $this->load->view('admin/footer');
    ?> 
</body>

</html>
