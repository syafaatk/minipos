<?php 
$this->load->view('admin/header');
?>
<body>
   <?php 
        $this->load->view('admin/menu');
   ?>
    </div>        
        <div>
            <div class="col-lg-12">
                <h1 class="page-header">Satuan
                    <small>Barang</small>
                    <div class="pull-right"><a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#largeModal"><span class="fa fa-plus"></span> Tambah satuan</a></div>
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
                        <th>satuan</th>
                        <th style="width:140px;text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $no=0;
                    foreach ($data->result_array() as $a):
                        $no++;
                        $id=$a['satuan_id'];
                        $nm=$a['satuan_nama'];
                ?>
                    <tr>
                        <td style="text-align:center;"><?php echo $no;?></td>
                        <td><?php echo $nm;?></td>
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
                        <h3 class="modal-title" id="myModalLabel">Tambah satuan</h3>
                    </div>
                    <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/satuan/tambah_satuan'?>" role="form">
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="control-label col-xs-3" >Nama satuan</label>
                                <div class="col-xs-9">
                                    <input name="satuan" class="form-control" type="text" placeholder="Input Nama satuan..." style="width:280px;" required autofocus>
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
            $id=$a['satuan_id'];
            $nm=$a['satuan_nama'];
        ?>
        <div id="modalEditPelanggan<?php echo $id?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title" id="myModalLabel">Edit satuan</h3>
                    </div>
                    <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/satuan/edit_satuan'?>" role="form">
                        <div class="modal-body">
                            <input name="kode" type="hidden" value="<?php echo $id;?>">
                            <div class="form-group">
                                <label class="control-label col-xs-3" >satuan</label>
                                <div class="col-xs-9">
                                    <input name="satuan" class="form-control" type="text" value="<?php echo $nm;?>" style="width:280px;" required autofocus>
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
        <?php } ?>

        <!-- ============ MODAL HAPUS =============== -->
        <?php
            foreach ($data->result_array() as $a) {
            $id=$a['satuan_id'];
            $nm=$a['satuan_nama'];
        ?>
        <div id="modalHapusPelanggan<?php echo $id?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title" id="myModalLabel">Hapus satuan</h3>
                    </div>
                    <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/satuan/hapus_satuan'?>" role="form">
                        <div class="modal-body">
                            <p><?php echo "Yakin mau menghapus ".$nm ; ?></p>
                            <input name="kode" type="hidden" value="<?php echo $id; ?>">
                            <input name="satuan" type="hidden" value="<?php echo $nm; ?>">
                        </div>
                        <div class="modal-footer">
                            <input class="btn btn-info" type="submit" value="Hapus" autofocus>
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php }  ?>
        <!--END MODAL-->
        <hr>
    </div>
    <!-- /.container -->

<?php 
$this->load->view('admin/footer');
?>
</body>
</html>