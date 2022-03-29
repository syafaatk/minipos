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
                    <small>Pengguna</small>
                    <div class="pull-right"><a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#largeModal"><span class="fa fa-plus"></span> Tambah Pengguna</a></div>
                </h1>
                <?php
                $message=$this->session->flashdata('msg');
                if($this->session->flashdata('msg')){
                    echo '<div class="alert alert-info">' . $message . '</div>';
                    $this->session->unset_userdata('msg');
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
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Level</th>
                        <th>Status</th>
                        <th style="width:140px;text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $no=0;
                    foreach ($data->result_array() as $a):
                        $no++;
                        $id=$a['user_id'];
                        $nm=$a['user_nama'];
                        $username=$a['user_username'];
                        $password=$a['user_password'];
                        $level=$a['user_level'];
                        $status=$a['user_status'];
                ?>
                    <tr>
                        <td style="text-align:center;"><?php echo $no;?></td>
                        <td><?php echo $nm;?></td>
                        <td><?php echo $username;?></td>
                        <td><?php echo $password;?></td>
                        <td>
                            <?php 
                            if($level==1){
                                echo "Manager/Super User";
                            }
                            if($level==2){
                                echo "Direktur";
                            }
                            if($level==3){
                                echo "Admin Gudang";
                            }
                            if($level==4){
                                echo "Admin Faktur";
                            }
                            if($level==5){
                                echo "Admin Laporan";
                            }
                            ?>
                                
                            </td>
                        <td><?php 
                            if($status==1){
                                echo "<a class='btn btn-xs btn-success'>Aktif</a>";
                            }
                            if($status==0){
                                echo "<a class='btn btn-xs btn-danger'>Tidak Aktif</a>";
                            }?></td>
                        <td style="text-align:center;">
                            <a class="btn btn-xs btn-warning" href="#modalEditPelanggan<?php echo $id?>" data-toggle="modal" title="Edit"><span class="fa fa-edit"></span> Edit</a>
                            <?php if($status==1 AND ($level!=1 AND $level!=2)):?>
                            <a class="btn btn-xs btn-danger" href="#modalHapusPelanggan<?php echo $id?>" data-toggle="modal" title="Non Aktifkan"><span class="fa fa-close"></span> Nonaktifkan</a>
                            <?php 
                            endif;
                            if($status==0):?>
                            <a class="btn btn-xs btn-success" href="#modalAktifPelanggan<?php echo $id?>" data-toggle="modal" title="Aktifkan"><span class="fa fa-close"></span> Aktifkan</a>
                            <?php endif;?> 
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
                <h3 class="modal-title" id="myModalLabel">Tambah Pengguna</h3>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/pengguna/tambah_pengguna'?>">
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nama</label>
                        <div class="col-xs-9">
                            <input name="nama" class="form-control" type="text" placeholder="Input Nama..." style="width:280px;" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Username</label>
                        <div class="col-xs-9">
                            <input name="username" class="form-control" type="text" placeholder="Input Username..." style="width:280px;" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Password</label>
                        <div class="col-xs-9">
                            <input name="password" class="form-control" type="password" placeholder="Input Password..." style="width:280px;" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Ulangi Password</label>
                        <div class="col-xs-9">
                            <input name="password2" class="form-control" type="password" placeholder="Ulangi Password..." style="width:280px;" required>
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Level</label>
                        <div class="col-xs-9">
                            <select name="level" class="form-control" style="width:280px;" required>
                                <option value="1">Super User/Manager</option>
                                <option value="2">Direktur</option>
                                <option value="3">Admin Gudang</option>
                                <option value="4">Admin Faktur</option>
                                <option value="5">Admin Laporan</option>
                            </select>
                        </div>
                    </div>   

                </div>

                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info">Simpan</button>
                </div>
            </form>
            </div>
            </div>
        </div>

        <!-- ============ MODAL EDIT =============== -->
        <?php
                    foreach ($data->result_array() as $a) {
                        $id=$a['user_id'];
                        $nm=$a['user_nama'];
                        $username=$a['user_username'];
                        $password=$a['user_password'];
                        $level=$a['user_level'];
                        $status=$a['user_status'];
                    ?>
                <div id="modalEditPelanggan<?php echo $id?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title" id="myModalLabel">Edit Pengguna</h3>
                    </div>
                    <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/pengguna/edit_pengguna'?>">
                        <div class="modal-body">
                            <input name="kode" type="hidden" value="<?php echo $id;?>">

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nama</label>
                        <div class="col-xs-9">
                            <input name="nama" class="form-control" type="text" value="<?php echo $nm;?>" placeholder="Input Nama..." style="width:280px;" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Username</label>
                        <div class="col-xs-9">
                            <input name="username" class="form-control" type="text" value="<?php echo $username;?>" placeholder="Input Username..." style="width:280px;" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Password</label>
                        <div class="col-xs-9">
                            <input name="password" class="form-control" type="password" placeholder="Input Password..." style="width:280px;">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Ulangi Password</label>
                        <div class="col-xs-9">
                            <input name="password2" class="form-control" type="password" placeholder="Ulangi Password..." style="width:280px;">
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Level</label>
                        <div class="col-xs-9">
                            <select name="level" class="form-control" style="width:280px;" required>
                            <?php if ($level=='1'):?>
                                <option value="1" selected>Super User/Manager</option>
                                <option value="2">Direktur</option>
                                <option value="3">Admin Gudang</option>
                                <option value="4">Admin Faktur</option>
                                <option value="5">Admin Laporan</option>
                            <?php elseif($level=='2'):?>
                                <option value="1">Super User/Manager</option>
                                <option value="2" selected>Direktur</option>
                                <option value="3">Admin Gudang</option>
                                <option value="4">Admin Faktur</option>
                                <option value="5">Admin Laporan</option>
                            <?php elseif ($level=='3'):?>
                                <option value="1">Super User/Manager</option>
                                <option value="2">Direktur</option>
                                <option value="3" selected>Admin Gudang</option>
                                <option value="4">Admin Faktur</option>
                                <option value="5">Admin Laporan</option>
                            <?php elseif($level=='4'):?>
                                <option value="1">Super User/Manager</option>
                                <option value="2">Direktur</option>
                                <option value="3">Admin Gudang</option>
                                <option value="4" selected>Admin Faktur</option>
                                <option value="5">Admin Laporan</option>
                            <?php elseif($level=='5'):?>
                                <option value="1">Super User/Manager</option>
                                <option value="2">Direktur</option>
                                <option value="3">Admin Gudang</option>
                                <option value="4">Admin Faktur</option>
                                <option value="5" selected>Admin Laporan</option>
                            <?php endif;?>
                            </select>
                        </div>
                    </div>
                </div>
                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                            <button type="submit" class="btn btn-info">Update</button>
                        </div>
                    </form>
                </div>
                </div>
                </div>
            <?php
        }
        ?>

        <!-- ============ MODAL NON AKTIF =============== -->
        <?php
                    foreach ($data->result_array() as $a) {
                        $id=$a['user_id'];
                        $nm=$a['user_nama'];
                        $username=$a['user_username'];
                        $password=$a['user_password'];
                        $level=$a['user_level'];
                        $status=$a['user_status'];
                    ?>
                <div id="modalHapusPelanggan<?php echo $id?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title" id="myModalLabel">NonAktifkan Pengguna</h3>
                    </div>
                    <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/pengguna/nonaktifkan'?>">
                        <div class="modal-body">
                            <p>Yakin mau menonaktifkan pengguna <b><?php echo $nm;?></b>..?</p>
                                    <input name="kode" type="hidden" value="<?php echo $id; ?>">
                                    <input name="nama" type="hidden" value="<?php echo $nm; ?>">
                        </div>
                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                            <button type="submit" class="btn btn-primary">Nonaktifkan</button>
                        </div>
                    </form>
                </div>
                </div>
                </div>
            <?php
        }
        ?>

        <!--END MODAL-->
        <!-- ============ MODAL AKTIF =============== -->
        <?php
                    foreach ($data->result_array() as $a) {
                        $id=$a['user_id'];
                        $nm=$a['user_nama'];
                        $username=$a['user_username'];
                        $password=$a['user_password'];
                        $level=$a['user_level'];
                        $status=$a['user_status'];
                    ?>
                <div id="modalAktifPelanggan<?php echo $id?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title" id="myModalLabel">Aktifkan Pengguna</h3>
                    </div>
                    <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/pengguna/aktifkan'?>">
                        <div class="modal-body">
                            <p>Yakin mau mengaktifkan pengguna <b><?php echo $nm;?></b>..?</p>
                                    <input name="kode" type="hidden" value="<?php echo $id; ?>">
                                    <input name="nama" type="hidden" value="<?php echo $nm; ?>">
                        </div>
                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                            <button type="submit" class="btn btn-primary">Aktifkan</button>
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
