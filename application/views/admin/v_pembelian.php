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
            <center><?php echo $this->session->flashdata('msg');?></center>
                <h1 class="page-header">Transaksi
                    <small>Pembelian Barang</small>
                    <a href="#" data-toggle="modal" data-target="#largeModal" class="pull-right"><small>Cari Produk!</small></a>
                </h1> 
            </div>
        </div>
        <!-- /.row -->
        <!-- Projects Row -->
        <form action="<?php echo base_url().'admin/pembelian/simpan_pembelian'?>" method="post">
        <div class="row">
            <div class="col-lg-12">
            <table>
                <tr>
                    <th style="width:100px;padding-bottom:5px;">No Faktur</th>
                    <td style="width:300px;padding-bottom:5px;"><input type="text" name="nofak" value="<?php echo $this->session->userdata('nofak');?>" class="form-control input-sm" style="width:200px;" required></td>
                </tr>
                <tr>
                    <th style="width:90px;padding-bottom:5px;">Suplier</th>
                    <td style="width:350px;">
                        <select name="idsup" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Suplier" data-width="100%" required>
                            <?php foreach ($sup->result_array() as $i):
                                $id_sup=$i['suplier_id'];
                                $nm_sup=$i['suplier_nama'];
                                $al_sup=$i['suplier_alamat'];
                                $notelp_sup=$i['suplier_notelp'];
                                $sess_id=$this->session->userdata('suplier');
                                if($sess_id==$id_sup): ?>
                                    <option value="<?php echo $id_sup;?>" selected><?php echo $nm_sup.' - '.$al_sup.' - '.$notelp_sup;?></option>
                                <?php else: ?>
                                    <option value="<?php echo $id_sup;?>"><?php echo $nm_sup.' - '.$al_sup.' - '.$notelp_sup;?></option>
                                <?php endif; ?>
                            <?php endforeach;?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <td>
                        <div class='input-group date' id='datepicker' style="width:200px;">
                            <input type='text' name="tgl" class="form-control" value="<?php echo $this->session->userdata('tglfak');?>" placeholder="Tanggal..." required/>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </td>
                </tr>
            </table><hr/>
            <table class="table table-bordered table-condensed" style="font-size:11px;margin-top:10px;">
                <thead>
                    <tr>
                        <th>Identitas Barang</th>
                        <th>Nama Barang</th>
                        <th style="text-align:center;">LOT</th>
                        <th style="text-align:center;">EXP</th>
                        <th style="text-align:center;">Qty</th>
                        <th style="text-align:center;">Harga</th>
                        <th style="text-align:center;">Sub Total</th>
                        <th style="width:100px;text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($this->cart->contents() as $items): ?>
                    <?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>
                    <tr>
                         <td><?=$items['iddet'];?></td>
                         <td><?=$items['name'];?></td>
                         <td><?=$items['lot'];?></td>
                         <td><?=$items['exp'];?></td>
                         <td style="text-align:center;"><?=$items['qty'];?></td>
                         <td style="text-align:right;"><?php echo number_format($items['amount']);?></td>
                         <td style="text-align:right;"><?php echo number_format($items['subtotal']);?></td>
                         <td style="text-align:center;"><a href="<?php echo base_url().'admin/pembelian/remove/'.$items['rowid'];?>" class="btn btn-warning btn-xs"><span class="fa fa-close"></span> Batal</a></td>
                    </tr>
                    <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6" style="text-align:center;">Total</td>
                        <td style="text-align:right;">Rp. <?php echo number_format($this->cart->total());?></td>
                    </tr>
                </tfoot>
            </table>
            <button type="submit" class="btn btn-info btn-lg">Simpan</button>
        </form>
            </div>
        </div>
    </div>
        <!-- /.row -->
 <!-- ============ MODAL ADD =============== -->
        <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title" id="myModalLabel">Data Barang</h3>
                    </div>
                    <div class="modal-body" style="overflow:scroll;height:500px;">
                      <table class="table table-bordered table-condensed" style="font-size:11px;" id="mydata">
                        <thead>
                            <tr>
                                <th style="text-align:center;width:40px;">No</th>
                                <th>ID Barang</th>
                                <th>LOT</th>
                                <th>EXP</th>
                                <th>Nama Barang</th>
                                <th>Spesifikasi</th>
                                <th>Satuan Barang</th>
                                <th>Kategori/Merek</th>
                                <th>Harga Pokok</th>
                                <th>Stok</th>
                                <th style="width:100px;text-align:center;">Aksi</th>
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
                                ?>
                            <tr>
                                <form action="<?php echo base_url().'admin/pembelian/add_to_cart'?>" method="post"> 
                                <td style="text-align:center;"><?php echo $no;?></td>
                                <td><?php echo $id;?></td>
                                <input type="hidden" name="idbrg" value="<?php echo $id;?>">
                                <input type="hidden" name="nmbrg" value="<?php echo $nm.$spc;?>">
                                <td><input style="text-align:center;width:100px;" type="text" name="lot"></td>
                                <td><input style="text-align:center;width:100px;" type="text" name="exp"></td>
                                <td><?php echo $nm;?></td>
                                <td><?php echo $spc;?></td>
                                <td style="text-align:center;"><?php echo $satuan;?></td>
                                <td style="text-align:center;"><?php echo $kat_nama;?></td>
                                <td style="text-align:right;"><input style="text-align:center;width:100px;" type="text" name="harpok"></td>
                                <td style="text-align:center;"><input style="text-align:center;width:100px;" type="text" name="stok"></td>
                                <td style="text-align:center;">
                                <input type="hidden" name="status" value="ada" required>
                                <button type="submit" class="btn btn-xs btn-info" title="Pilih"><span class="fa fa-edit"></span> Pilih</button>
                                </form>
                            <?php endforeach;?>
                                </td>
                            </tr>
                        </tbody>
                    </table>          
                    </div>

                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>    
                    </div>
                </div>
            </div>
        </div>
       

        <hr>
    <!-- /.container -->
</div>
    <?php 
    $this->load->view('admin/footer');
    ?>    
</body>

</html>
