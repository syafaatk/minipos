<div id="wrapper">
        <!-- Sidebar -->
        <?php $h=$this->session->userdata('akses'); ?>
        <?php $u=$this->session->userdata('user'); ?>
        <?php $n=$this->session->userdata('nama'); ?>
        <?php $idadmin=$this->session->userdata('idadmin'); ?>
        <?php $bgwarna=$this->session->userdata('bgwarna'); ?>
        <div id="sidebar-wrapper" style="background:<?php echo $bgwarna;?>">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="<?php echo base_url().'welcome'?>">
                        <img src="<?php echo base_url().'assets/img/logoparit.png'?>" style="width:40px;height: 40px;">  PT. PARIT PANJANG
                    </a>
                </li>
            <?php $h=$this->session->userdata('akses'); ?>
            <?php $u=$this->session->userdata('user'); ?>
            <?php $n=$this->session->userdata('nama'); ?>
            <?php if($h=='1'): 
                    $title="Manager / Super Admin"
                ?>
                <li><a><?php echo 'Selamat Datang, '.$n; ?>
                    <br><a><?php echo $title; ?></a>
                </li>
                <a style="margin-left: 20px;" class="btn btn-xs btn-primary" href="#editpassword" data-toggle="modal" title="Edit"><span class="fa fa-edit"></span> Setting</a>
                <li><hr></li>
                <li>
                    <a href="#" data-toggle="collapse" aria-expanded="false" data-target="#cExample">Data Master<span class="caret"></span></a>
                    <ul class="collapse" id="cExample">
                        <li><a href="<?php echo base_url().'admin/satuan'?>" style="padding-left:1em">Satuan</a></li>
                        <li><a href="<?php echo base_url().'admin/kategori'?>" style="padding-left:1em">Kategori</a></li>
                        <li><a href="<?php echo base_url().'admin/suplier'?>" style="padding-left:1em">Principal</a></li>
                        <li><a href="<?php echo base_url().'admin/sales'?>" style="padding-left:1em">Sales</a></li>
                        <li><a href="<?php echo base_url().'admin/pelanggan'?>" style="padding-left:1em">Pelanggan</a></li>
                        <li><a href="<?php echo base_url().'admin/pengguna'?>" style="padding-left:1em">Pengguna</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" data-toggle="collapse" aria-expanded="false" data-target="#cExample1">Data Transaksi Gudang<span class="caret"></span></a>
                    <ul class="collapse" id="cExample1">
                        <li><a href="<?php echo base_url().'admin/beli'?>" style="padding-left:1em">Tabel Faktur Pembelian</a></li>
                        <li><a href="<?php echo base_url().'admin/detail_barang'?>" style="padding-left:1em">Tabel Detail Faktur Beli Barang</a></li>
                        <li><a href="<?php echo base_url().'admin/detail_barang_habis'?>" style="padding-left:1em">Tabel Barang Habis/Expired</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" data-toggle="collapse" aria-expanded="false" data-target="#cExample2">Data Transaksi Faktur<span class="caret"></span></a>
                    <ul class="collapse" id="cExample2">
                        <li><a href="<?php echo base_url().'admin/tabel_penjualan'?>" style="padding-left:1em">Tabel Faktur Penjualan</a></li>
                        <li><a href="#pilih_bulan" data-toggle="modal" style="padding-left:1em">Tabel Faktur Perbulan</a></li>
                        <li><a href="<?php echo base_url().'admin/penjualan_grosir'?>" style="padding-left:1em">Transaksi Penjualan Faktur</a></li>
                        <li><a href="<?php echo base_url().'admin/penjualan'?>" style="padding-left:1em">Transaksi Penjualan Non Faktur</a></li>
                        <li><a href="<?php echo base_url().'admin/penjualan_manual'?>" style="padding-left:1em">Transaksi Penjualan Manual</a></li>
                    </ul>
                </li>
                <li><a href="<?php echo base_url().'admin/barang'?>">Tabel Barang</a></li>
                <li><a data-toggle="modal" data-target="#myModal" href="#">Kalkulator</a></li>
                <li><a href="<?php echo base_url().'admin/laporan'?>">Laporan</a></li>
                <li><a href="<?php echo base_url().'admin/grafik'?>">Grafik</a></li>
                <li><a href="<?php echo base_url().'administrator/logout'?>">Keluar</a></li>
            <?php endif;?>
            <?php if($h=='2'): 
                    $title="Direktur"
                ?>
                <li><a><?php echo $n.', '.$title; ?></a></li>
                <li>
                    <a href="#" data-toggle="collapse" aria-expanded="false" data-target="#cExample">Data Master<span class="caret"></span></a>
                    <ul class="collapse" id="cExample">
                        <li><a href="<?php echo base_url().'admin/satuan'?>" style="padding-left:1em">Satuan</a></li>
                        <li><a href="<?php echo base_url().'admin/kategori'?>" style="padding-left:1em">Kategori</a></li>
                        <li><a href="<?php echo base_url().'admin/suplier'?>" style="padding-left:1em">Principal</a></li>
                        <li><a href="<?php echo base_url().'admin/sales'?>" style="padding-left:1em">Sales</a></li>
                        <li><a href="<?php echo base_url().'admin/pelanggan'?>" style="padding-left:1em">Pelanggan</a></li>
                        <li><a href="<?php echo base_url().'admin/pengguna'?>" style="padding-left:1em">Pengguna</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" data-toggle="collapse" aria-expanded="false" data-target="#cExample1">Data Transaksi Gudang<span class="caret"></span></a>
                    <ul class="collapse" id="cExample1">
                        <li><a href="<?php echo base_url().'admin/beli'?>" style="padding-left:1em">Tabel Faktur Pembelian</a></li>
                        <li><a href="<?php echo base_url().'admin/detail_barang'?>" style="padding-left:1em">Tabel Detail Faktur Beli Barang</a></li>
                        <li><a href="<?php echo base_url().'admin/detail_barang_habis'?>" style="padding-left:1em">Tabel Barang Habis/Expired</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" data-toggle="collapse" aria-expanded="false" data-target="#cExample2">Data Transaksi Faktur<span class="caret"></span></a>
                    <ul class="collapse" id="cExample2">
                        <li><a href="<?php echo base_url().'admin/tabel_penjualan'?>" style="padding-left:1em">Tabel Faktur Penjualan</a></li>
                        <li><a href="#pilih_bulan" data-toggle="modal" style="padding-left:1em">Tabel Faktur Perbulan</a></li>
                        <li><a href="<?php echo base_url().'admin/penjualan_grosir'?>" style="padding-left:1em">Transaksi Penjualan Faktur</a></li>
                        <li><a href="<?php echo base_url().'admin/penjualan'?>" style="padding-left:1em">Transaksi Penjualan Non Faktur</a></li>
                        <li><a href="<?php echo base_url().'admin/penjualan_manual'?>" style="padding-left:1em">Transaksi Penjualan Manual</a></li>
                    </ul>
                </li>
                <li><a href="<?php echo base_url().'admin/barang'?>">Tabel Barang</a></li>
                <li><a data-toggle="modal" data-target="#myModal" href="#">Kalkulator</a></li>
                <li><a href="<?php echo base_url().'admin/laporan'?>">Laporan</a></li>
                <li><a href="<?php echo base_url().'administrator/logout'?>">Keluar</a></li>
            <?php endif;?>
            <?php if($h=='3'): 
                    $title="administrator Gudang"
                ?>
                <li><a><?php echo $n.', '.$title; ?></a></li>
                <li>
                    <a href="#" data-toggle="collapse" aria-expanded="false" data-target="#cExample">Data Master<span class="caret"></span></a>
                    <ul class="collapse" id="cExample">
                        <li><a href="<?php echo base_url().'admin/satuan'?>" style="padding-left:2em">Satuan</a></li>
                        <li><a href="<?php echo base_url().'admin/kategori'?>" style="padding-left:2em">Kategori</a></li>
                        <li><a href="<?php echo base_url().'admin/suplier'?>" style="padding-left:2em">Suplier</a></li>
                    </ul>
                </li>
                <li><a href="<?php echo base_url().'admin/barang'?>">Tabel Barang</a></li>
                <li><a href="<?php echo base_url().'admin/beli'?>">Tabel Faktur Pembelian</a></li>
                <li><a href="<?php echo base_url().'admin/detail_barang'?>">Tabel Detail Faktur Barang</a></li>
                <li><a href="<?php echo base_url().'admin/detail_barang_habis'?>">Tabel Barang Habis/Expired</a></li>
                <li><a href="<?php echo base_url().'admin/tabel_penjualan'?>">Tabel Penjualan</a></li>
                <li><a data-toggle="modal" data-target="#myModal" href="#">Kalkulator</a></li>
                <li><a href="<?php echo base_url().'administrator/logout'?>">Keluar</a></li>
            <?php endif;?>
            <?php if($h=='4'):
                    $title="Administrator Faktur";
             ?>
                <li><a><?php echo $n.', '.$title; ?></a></li>
                <li>
                    <a href="#" data-toggle="collapse" aria-expanded="false" data-target="#cExample">Data Master<span class="caret"></span></a>
                    <ul class="collapse" id="cExample">
                        <li><a href="<?php echo base_url().'admin/sales'?>" style="padding-left:2em">Sales</a></li>
                        <li><a href="<?php echo base_url().'admin/pelanggan'?>" style="padding-left:2em">Pelanggan</a></li>
                    </ul>
                </li>
                <li><a href="<?php echo base_url().'admin/tabel_penjualan'?>">Tabel Penjualan</a></li>
                <li><a href="#pilih_bulan" data-toggle="modal" style="padding-left:1em">Tabel Faktur Perbulan</a></li>
                <li><a href="<?php echo base_url().'admin/penjualan'?>">Transaksi Penjualan Non Faktur</a></li>
                <li><a href="<?php echo base_url().'admin/penjualan_grosir'?>">Transaksi Penjualan Faktur</a></li>
                <li><a href="<?php echo base_url().'admin/penjualan_manual'?>" style="padding-left:1em">Transaksi Penjualan Manual</a></li>
                <li><a href="<?php echo base_url().'admin/detail_barang_habis'?>">Tabel Barang Habis/Expired</a></li>
                <li><a data-toggle="modal" data-target="#myModal" href="#">Kalkulator</a></li>
                <li><a href="<?php echo base_url().'admin/barang'?>">Tabel Barang</a></li>
                <li><a href="<?php echo base_url().'administrator/logout'?>">Keluar</a></li>
            <?php endif;?>
            <?php if($h=='5'):
                    $title="Administrator Laporan";
             ?>
                <li><a><?php echo $n.', '.$title; ?></a></li>
                <li><a href="<?php echo base_url().'admin/tabel_penjualan'?>">Tabel Penjualan</a></li>
                <li><a href="#pilih_bulan" data-toggle="modal" style="padding-left:1em">Tabel Faktur Perbulan</a></li>
                <li><a data-toggle="modal" data-target="#myModal" href="#">Kalkulator</a></li>
                <li><a href="<?php echo base_url().'admin/laporan'?>">Laporan</a></li>
                <li><a href="<?php echo base_url().'admin/grafik'?>">Grafik</a></li>
                <li><a href="<?php echo base_url().'administrator/logout'?>">Keluar</a></li>
            <?php endif;?>
            </ul>
        </div>
        <!-- ============ MODAL Kalkulator =============== -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog modal-lg" style="width: 310px;position: absolute;top: 50px;left: 50px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel">Kalkulator</h4>
                    </div>
                    <div class="modal-body" style="height:360px;">
                        <iframe src="<?php echo base_url().'administrator/calculator'?>" height="330px" width="280px"></iframe>
                    </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>     
                    </div>
                </div>
            </div>
        </div>
        <!-- ==== -->
        <div class="modal fade" id="pilih_bulan" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Pilih Bulan</h3>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/tabel_penjualan/'?>" target="_self">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Bulan</label>
                        <div class="col-xs-9">
                                <select name="bln" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Bulan" data-width="80%" required/>
                                <?php foreach ($jual_bln->result_array() as $k) {
                                    $bulan=$k['bulan'];
                                    $bln=$k['bln'];
                                ?>
                                    <option value="<?php echo $bln;?>"><?php echo $bulan;?></option>
                                <?php }?>
                                </select>
                        </div>
                    </div>           
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info"><span class="fa fa-print"></span> Cari</button>
                </div>
            </form>
            </div>
            </div>
        </div>
        <!-- Page content -->
        <div id="page-content-wrapper">
            <div class="content-header">
                <h1>
                    <a id="menu-toggle" href="#" class="btn btn-default"><i class="fa fa-list"></i></a>
                    <img src="<?php echo base_url().'assets/img/logoparit.png'?>" style="width:50px"> <small>PT. Parit Panjang </small>
                    <p id="timestamp" style="text-align: right;margin-right: 20px;font-size: large;"></p>
                </h1>

            </div>
        <!-- =========== -->
            <div id="editpassword" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title" id="myModalLabel">Edit Pengguna</h3>
                    </div>
                    <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/pengguna/edit_pengguna'?>">
                        <div class="modal-body">
                            <input name="kode" type="hidden" value="<?php echo $idadmin;?>">

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nama</label>
                        <div class="col-xs-9">
                            <input name="nama" class="form-control" type="text" value="<?php echo $n;?>" placeholder="Input Nama..." style="width:280px;" required readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Username</label>
                        <div class="col-xs-9">
                            <input name="username" class="form-control" type="text" value="<?php echo $u;?>" placeholder="Input Username..." style="width:280px;" required readonly>
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
                            <select name="level" class="form-control" style="width:280px;" required readonly>
                            <?php if ($h=='1'):?>
                                <option value="1" selected>Super User/Manager</option>
                            <?php elseif($h=='2'):?>
                                <option value="2" selected>Direktur</option>
                            <?php elseif ($h=='3'):?>
                                <option value="3" selected>Admin Gudang</option>
                            <?php elseif($h=='4'):?>
                                <option value="4" selected>Admin Faktur</option>
                            <?php elseif($h=='5'):?>
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
            <!-- Keep all page content within the page-content inset div! -->
            <div class="page-content inset">
                <div class="row">