<?php 
$this->load->view('admin/header');
?>
<body>
    <!-- Navigation -->
   <?php 
        $this->load->view('admin/menu');
   ?>
    <!-- Page Content -->
            <div class="col-lg-12">
                <h1 class="page-header">Transaksi
                    <small>Penjualan Manual</small>
                    <div class="pull-right"><a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#largeModal" role="button"><span class="fa fa-plus"></span> Cari Barang</a></div>
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
                <form action="<?=base_url().'admin/penjualan_manual/add_to_cart'?>" method="post">
                <table>
                </table>
                 </form>
                <table class="table table-bordered table-condensed" style="font-size:11px;margin-top:10px;">
                    <thead>
                        <tr>
                            <th>ID Barang</th>
                            <th>Merek Barang</th>
                            <th>Nama Barang</th>
                            <th>LOT Barang</th>
                            <th>EXP Barang</th>
                            <th style="text-align:center;">Harga(Rp)</th>
                            <th style="text-align:center;">Qty</th>
                            <th style="text-align:center;">Satuan</th>
                            <th style="text-align:center;">Harga Jual</th>
                            <th style="text-align:center;">Diskon(Rp)</th>
                            <th style="text-align:center;">Sub Total</th>
                            <th style="width:100px;text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($this->cart->contents() as $items): ?>
                        <?=form_hidden($i.'[rowid]', $items['rowid']); ?>
                        <tr>
                             <td><?=$items['id'];?></td>
                             <td><?=$items['kategori'];?></td>
                             <td><?=$items['name'];?></td>
                             <td><?=$items['lot'];?></td>
                             <td><?=$items['exp'];?></td>
                             <td><?=$items['price'];?></td>
                             <td style="text-align:center;"><?=number_format($items['qty']);?></td>
                             <td style="text-align:center;"><?=$items['satuan'];?></td>
                             <td style="text-align:right;"><?=number_format($items['amount']);?></td>
                             <td style="text-align:right;"><?=number_format($items['disc']);?></td>
                             <td style="text-align:right;"><?=number_format($items['subtotal']);?></td>
                             <td style="text-align:center;"><a href="<?=base_url().'admin/penjualan_manual/remove/'.$items['rowid'];?>" class="btn btn-warning btn-xs"><span class="fa fa-close"></span> Batal</a></td>
                        </tr>
                        
                        <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <form action="<?=base_url().'admin/penjualan_manual/simpan_penjualan_manual'?>" method="post">
                <table class="table table-bordered table-condensed">
                    <tbody>
                    <tr>
                        <th style="text-align:right;width:30%;">No Faktur  :&nbsp</th>
                        <th style="text-align:right;width:70%;"><input type="text" name="ppjfak" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" required></th>
                    </tr>
                    <tr>
                        <th style="text-align:right;width:30%;">Pelanggan  :&nbsp</th>
                        <th style="text-align:right;width:70%;">
                            <select name="pelanggan" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Pelanggan" data-width="100%" required style="text-align:right;margin-bottom:5px;">
                                <?php foreach ($pelanggan->result_array() as $i) {
                                    $id_pelanggan=$i['pelanggan_id'];
                                    $nm_pelanggan=$i['pelanggan_nama'];
                                    $al_pelanggan=$i['pelanggan_alamat'];
                                    $notelp_pelanggan=$i['pelanggan_notelp'];
                                    $nonpwp_pelanggan=$i['pelanggan_nonpwp'];
                                    $sess_id=$this->session->userdata('pelanggan');
                                    if($sess_id==$id_pelanggan)
                                        echo "<option value='$id_pelanggan' selected>$nm_pelanggan</option>";
                                    else
                                        echo "<option value='$id_pelanggan'>$nm_pelanggan</option>";
                                }?>
                            </select>
                        </th>
                    </tr>
                    <tr>
                        <th style="text-align:right;width:30%;">No PO  :&nbsp</th>
                        <th style="text-align:right;width:70%;"><input type="text" name="no_po" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" required></th>
                    </tr>
                    <tr>
                        <th style="text-align:right;width:30%;">Tanggal Faktur  :&nbsp</th>
                        <th style="text-align:right;width:70%;"><input type="text" id="tanggal" name="tgl_faktur" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" required></th>
                    </tr>
                    <tr>
                        <th style="text-align:right;width:30%;">Sales  :&nbsp</th>
                        <th style="text-align:right;width:70%;">
                            <select name="sales" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Sales" data-width="100%" required style="text-align:right;margin-bottom:5px;">
                                <?php foreach ($sales->result_array() as $i) {
                                    $id_sales=$i['sales_id'];
                                    $nm_sales=$i['sales_nama'];
                                    $al_sales=$i['sales_alamat'];
                                    $notelp_sales=$i['sales_notelp'];
                                    $nonpwp_sales=$i['sales_nonpwp'];
                                    $status_sales=$i['sales_status'];
                                    $sess_id=$this->session->userdata('sales');
                                    if($status_sales==1){
                                        if($sess_id==$id_sales)
                                            echo "<option value='$id_sales' selected>$nm_sales -- $al_sales</option>";
                                        else
                                            echo "<option value='$id_sales'>$nm_sales -- $al_sales</option>";
                                        }
                                    }?>
                            </select>
                        </th>
                    </tr>
                    <tr>
                        <th style="text-align:right;width:30%;">Keterangan  :&nbsp</th>
                        <th style="text-align:right;width:70%;"><select name="keterangan" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Keterangan" data-width="100%" required style="text-align:right;margin-bottom:5px;">
                            <option value="CASH" selected>Cash</option>
                            <option value="KREDIT">Kredit</option>
                        </select>
                        </th>
                    </tr>
                    <tr>
                        <th style="text-align:right;width:30%;">Tanggal Pembayaran  :&nbsp</th>
                        <th style="text-align:left;width:70%;"><input type="text" name="tgl_bayar" id="tgl_bayar" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" value="<?=date('d-m-Y');?>"></th>
                    </tr>
                    <tr><i style="font-size: 10px;">diganti jika pilihan keterangan kredit</i></tr>
                    <tr>
                        <th style="text-align:right;width:30%;">Total Sebelum Pajak(Rp)  :&nbsp</th>
                        <th style="text-align:right;width:70%;">
                            <input type="text" name="total2" value="<?=number_format($this->cart->total());?>" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" readonly>
                        </th>
                        <input type="hidden" id="total" name="total" value="<?=$this->cart->total();?>" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" readonly>
                    </tr>
                    <tr>
                        <th style="text-align:right;width:30%;">Total Pajak(Rp)  :&nbsp</th>
                        <?php $pajak=$this->cart->total()*10/100;$totpajak=$this->cart->total()+$pajak; ?>
                        <th style="text-align:right;width:70%;"><input type="text" value="<?=$pajak;?>" class="pajak form-control input-sm" readonly style="text-align:right;margin-bottom:5px;"></th>
                        <input type="hidden" name="pajak" id="pajak" value="<?=$pajak;?>" class="form-control input-sm" readonly style="text-align:right;margin-bottom:5px;">
                    </tr>    
                    <tr>
                        <th style="text-align:right;width:30%;">Total Setelah Pajak(Rp)  :&nbsp</th>
                        <th style="text-align:right;width:70%;"><input type="text" value="<?=$totpajak;?>" class="total3 form-control input-sm" readonly style="text-align:right;margin-bottom:5px;"></th>  
                        <input type="hidden" name="total3" id="total3"  value="<?=$totpajak;?>" class="form-control input-sm" readonly style="text-align:right;margin-bottom:5px;">
                    </tr>    
                    <tr>
                        <th style="text-align:right;width:30%;">Tunai(Rp)  :&nbsp</th>
                        <th style="text-align:right;width:70%;"><input type="text" id="jml_uang" name="jml_uang" class="jml_uang form-control input-sm" style="text-align:right;margin-bottom:5px;" required></th>
                        <input type="hidden" id="jml_uang2" name="jml_uang2" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" required>
                    </tr>
                    <tr>
                        <th style="text-align:right;width:30%;">Kembalian(Rp)  :&nbsp</th>
                        <th style="text-align:right;width:70%;"><input type="text" id="kembalian" name="kembalian" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" required></th>
                    </tr>
                    <tr>
                        <td style="width:760px;" rowspan="2"><button type="submit" class="btn btn-info btn-lg"> Simpan</button></td>
                    </tr>
                </tbody>
                </table>
                </form>
            <hr/>
            </div>
        </div>
        <!-- /.row -->
         <!-- ============ MODAL ADD =============== -->
        <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog modal-lg" style="width: 1524px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title" id="myModalLabel">Data Barang</h3>
                    </div>
                    <div class="modal-body" style="overflow:scroll;height:500px;">
                        <table class="table table-bordered table-condensed" style="font-size:11px;" id="mydata">
                            <thead>
                                <tr>
                                    <!-- <th style="width:120px;">Kode Barang</th> -->
                                    <th style="width:120px;">Merek Barang</th>
                                    <th style="width:440px;">Nama Barang</th>
                                    <th>LOT</th>
                                    <th>EXP</th>
                                    <th>Stok</th>
                                    <th style="width:20px;">Satuan</th>
                                    <th style="width:50px;">Modal(M)</th>
                                    <th style="width:50px;">M+10% (HP)</th>
                                    <th style="width:50px;">HP+3%</th>
                                    <th>Qty</th>
                                    <th>Harga Jual</th>
                                    <th>Diskon</th>
                                    <th>Status</th>
                                    <th style="width:100px;text-align:center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $no=0;
                                foreach ($data->result_array() as $a):
                                    $nm=$a['barang_nama'];
                                    $spc=$a['barang_spesifikasi'];
                                    $satuan=$a['satuan_nama'];
                                    $kategori=$a['kategori_nama'];
                                    $d_barang_id=$a['d_barang_id'];
                                    $d_barang_lot=$a['d_barang_lot'];
                                    $d_barang_exp=$a['d_barang_exp'];
                                    $d_barang_stok=$a['d_barang_stok'];
                                    $d_barang_harga_pokok=$a['d_barang_harga_pokok'];
                                    $d_barang_status=$a['d_barang_status'];
                                    $nofak=$a['beli_nofak'];
                                    ?>
                                <?php if($d_barang_status=="ada"):?>
                                <tr>
                                    <form action="<?=base_url().'admin/penjualan_manual/add_to_cart'?>" method="post">
                                    <input type="hidden" name="kobar" required style="width:80px;" value="<?=$d_barang_id;?>">
                                    <td><span class="btn btn-xs btn-info"><?=$kategori;?></span></td>
                                    <td>
                                        <span class="btn btn-xs btn-warning"><?=$nm;?></span>
                                        <span class="btn btn-xs btn-info"><?=$spc;?></span>
                                    </td>
                                    <td><?=$d_barang_lot;?></td>
                                    <td><?=$d_barang_exp;?></td>
                                    <td>
                                    	<?php if($d_barang_stok>0):?>
                                    	<span class="btn btn-xs btn-success">
                                            <?=$d_barang_stok;?>
                                        </span>
                                        <?php else:?>
                                        <span class="btn btn-xs btn-danger">
                                            <?=$d_barang_stok;?>
                                        </span>
                                        <?php endif;?>
                                        <input type="hidden" name="totalstok" required style="width:80px;" value="<?=$d_barang_stok;?>">
                                    </td>
                                    <?php $m=$d_barang_harga_pokok+($d_barang_harga_pokok*10/100);?>
                                    <td><?=$satuan;?></td>
                                    <td>Rp. <?=number_format($d_barang_harga_pokok);?></td>
                                    <td>Rp. <?=number_format($m);?></td>
                                    <td>Rp. <?=number_format($m+($m*3/100));?></td>
                                    <td><input type="text" name="qty" required style="width:80px;"></td>
                                    <td><input type="text" name="harjul" required style="width:80px;"></td>
                                    <td><input type="text" name="diskon" required style="width:80px;" value="0"></td>
                                    <td><?=$d_barang_status;?></td>
                                    <td style="text-align:center;">
                                    <button type="submit" class="btn btn-xs btn-info" title="Pilih"><span class="fa fa-edit"></span> Pilih</button>
                                    </td>
                                    </form>
                                </tr>
                                <?php endif;?>
                                <?php endforeach;?>
                            </tbody>
                        </table>          
                    </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    
                </div>
            </div>
            </div>
        </div>
        <!--END MODAL-->
        <hr>      
    </div>
    <!-- /.container -->
    <?php 
    $this->load->view('admin/footer');
    ?>
</body>
</html>
