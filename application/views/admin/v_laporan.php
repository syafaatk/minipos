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
                <h1 class="page-header">Data
                    <small>Laporan</small>
                </h1>
            </div>
        </div>
        <!-- /.row -->
        <!-- Projects Row -->
        <div class="row">
            <div class="col-lg-12">
            <table class="table table-bordered table-condensed" style="font-size:12px;" id="mydata">
                <thead>
                    <tr>
                        <th style="text-align:center;width:40px;">No</th>
                        <th>Laporan</th>
                        <th style="width:100px;text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align:center;vertical-align:middle">1</td>
                        <td style="vertical-align:middle;">Laporan Data Pembelian oleh Pelanggan</td>
                        <td style="text-align:center;">
                            <a class="btn btn-sm btn-default" href="#lap_beli_per_pelanggan" data-toggle="modal"><span class="fa fa-print"></span> Print</a>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:center;vertical-align:middle">2</td>
                        <td style="vertical-align:middle;">Laporan Data Pembelian ke Pricipal</td>
                        <td style="text-align:center;">
                            <a class="btn btn-sm btn-default" href="#lap_beli_per_principal" data-toggle="modal"><span class="fa fa-print"></span> Print</a>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:center;vertical-align:middle">3</td>
                        <td style="vertical-align:middle;">Laporan Data Penjualan Sales</td>
                        <td style="text-align:center;">
                            <a class="btn btn-sm btn-default" href="#lap_jual_per_sales" data-toggle="modal"><span class="fa fa-print"></span> Print</a>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:center;vertical-align:middle">4</td>
                        <td style="vertical-align:middle;">Laporan Data Penjualan Kategori</td>
                        <td style="text-align:center;">
                            <a class="btn btn-sm btn-default" href="#lap_jual_per_kategori" data-toggle="modal"><span class="fa fa-print"></span> Print</a>
                        </td>
                    </tr>
                </tbody>
            </table>
            </div>
        </div>
        <!-- /.row -->
        <!-- ============ MODAL LAPORAN JUAL PER KATEGORI =============== -->
        <div class="modal fade" id="lap_jual_per_kategori" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title" id="myModalLabel">Pilih Kategori dan Bulan</h3>
                    </div>
                    <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/laporan/lap_data_penjualan_kategori'?>" target="_blank">
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="control-label col-xs-3" >Kategori</label>
                                <div class="col-xs-9">
                                    <select name="kategori" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Kategori" data-width="80%" required/>
                                        <?php foreach ($kat->result_array() as $t) :
                                        $nm=$t['kategori_nama'];
                                        $id=$t['kategori_id'];
                                        $snm=$t['suplier_nama'];
                                        ?>
                                        <option value="<?php echo $id;?>"><?php echo $nm.' / '.$snm;?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3" >Bulan</label>
                                <div class="col-xs-9">
                                        <select name="bln" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Bulan" data-width="80%" required/>
                                        <?php foreach ($jual_bln->result_array() as $k) :
                                            $bln=$k['bulan'];
                                        ?>
                                            <option><?php echo $bln;?></option>
                                        <?php endforeach;?>
                                        </select>
                                </div>
                            </div>           
                        </div>
                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                            <button class="btn btn-success" name="tombol" value="1"><span class="fa fa-file-excel-o"></span> Excel</button>
                            <button class="btn btn-info"><span class="fa fa-print"></span> Cetak</button>
                        </div>
                    </form>
            </div>
            </div>
        </div>
        <!-- ============ MODAL LAPORAN PEMBELIAN PER PELANGGAN =============== -->
        <div class="modal fade" id="lap_beli_per_pelanggan" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Pilih Pelanggan dan Bulan</h3>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/laporan/lap_data_pembelian_pelanggan'?>" target="_blank">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Pelanggan</label>
                        <div class="col-xs-9">
                                <select name="pelanggan" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Pelanggan" data-width="80%" required/>
                                <?php foreach ($pelanggan->result_array() as $t) {
                                    $nm=$t['pelanggan_nama'];
                                    $id=$t['pelanggan_id'];
                                ?>
                                    <option value="<?php echo $id;?>"><?php echo $nm;?></option>
                                <?php }?>
                                </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Kategori</label>
                        <div class="col-xs-9">
                                <select name="kategori" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Kategori" data-width="80%" required/>
                                    <option value="NULL">Semua Kategori</option>
                                <?php foreach ($kat->result_array() as $t) {
                                    $nm=$t['kategori_nama'];
                                    $id=$t['kategori_id'];
                                    $snm=$t['suplier_nama'];
                                ?>
                                    <option value="<?php echo $id;?>"><?php echo $nm.' / '.$snm;?></option>
                                <?php }?>
                                </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Bulan</label>
                        <div class="col-xs-9">
                                <select name="bln" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Bulan" data-width="80%" required/>
                                <?php foreach ($jual_bln->result_array() as $k) {
                                    $bln=$k['bulan'];
                                ?>
                                    <option><?php echo $bln;?></option>
                                <?php }?>
                                </select>
                        </div>
                    </div>           
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-success" name="tombol" value="1"><span class="fa fa-file-excel-o"></span> Excel</button>
                    <button class="btn btn-info" name="tombol" value="0"><span class="fa fa-print"></span> Cetak</button>
                </div>
            </form>
            </div>
            </div>
        </div>
        <!-- ============ MODAL LAPORAN PEMBELIAN PER PRINCIPAL =============== -->
        <div class="modal fade" id="lap_beli_per_principal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Pilih Principal dan Bulan</h3>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/laporan/lap_data_pembelian_principal'?>" target="_blank">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Principal</label>
                        <div class="col-xs-9">
                                <select name="principal" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Principal" data-width="80%" required/>
                                <?php foreach ($principal->result_array() as $t) {
                                    $nm=$t['suplier_nama'];
                                    $id=$t['suplier_id'];
                                ?>
                                    <option value="<?php echo $id;?>"><?php echo $nm;?></option>
                                <?php }?>
                                </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Bulan</label>
                        <div class="col-xs-9">
                                <select name="bln" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Bulan" data-width="80%" required/>
                                <?php foreach ($beli_bln->result_array() as $k) {
                                    $bln=$k['bulan'];
                                ?>
                                    <option><?php echo $bln;?></option>
                                <?php }?>
                                </select>
                        </div>
                    </div>           
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-success" name="tombol" value="1"><span class="fa fa-file-excel-o"></span> Excel</button>
                    <button class="btn btn-info"><span class="fa fa-print"></span> Cetak</button>
                </div>
            </form>
            </div>
            </div>
        </div>
        <!-- ============ MODAL LAPORAN JUAL PER SALES =============== -->
        <div class="modal fade" id="lap_jual_per_sales" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Pilih Sales dan Bulan</h3>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/laporan/lap_data_penjualan_sales'?>" target="_blank">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Sales</label>
                        <div class="col-xs-9">
                                <select name="sales" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Sales" data-width="80%" required/>
                                <?php foreach ($sales->result_array() as $t) {
                                    $nm=$t['sales_nama'];
                                    $id=$t['sales_id'];
                                ?>
                                    <option value="<?php echo $id;?>"><?php echo $nm;?></option>
                                <?php }?>
                                </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Bulan</label>
                        <div class="col-xs-9">
                                <select name="bln" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Bulan" data-width="80%" required/>
                                <?php foreach ($jual_bln->result_array() as $k) {
                                    $bln=$k['bulan'];
                                ?>
                                    <option><?php echo $bln;?></option>
                                <?php }?>
                                </select>
                        </div>
                    </div>           
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-success" name="tombol" value="1"><span class="fa fa-file-excel-o"></span> Excel</button>
                    <button class="btn btn-info" name="tombol" value="0"><span class="fa fa-print"></span> Cetak</button>
                </div>
            </form>
            </div>
            </div>
        </div>
        <!-- ============ MODAL ADD =============== -->
        <div class="modal fade" id="lap_jual_pertanggal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Pilih Tanggal</h3>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/laporan/lap_penjualan_pertanggal'?>" target="_blank">
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Tanggal</label>
                        <div class="col-xs-9">
                            <div class='input-group date' id='datepicker' style="width:300px;">
                                <input type='text' name="tgl" class="form-control" value="" placeholder="Tanggal..." required/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                           

                </div>

                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info"><span class="fa fa-print"></span> Cetak</button>
                </div>
            </form>
            </div>
            </div>
        </div>

        <!-- ============ MODAL ADD =============== -->
        <div class="modal fade" id="lap_jual_perbulan" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Pilih Bulan</h3>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/laporan/lap_penjualan_perbulan'?>" target="_blank">
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Bulan</label>
                        <div class="col-xs-9">
                                <select name="bln" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Bulan" data-width="80%" required/>
                                <?php foreach ($jual_bln->result_array() as $k) {
                                    $bln=$k['bulan'];
                                ?>
                                    <option><?php echo $bln;?></option>
                                <?php }?>
                                </select>
                        </div>
                    </div>
                           

                </div>

                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info"><span class="fa fa-print"></span> Cetak</button>
                </div>
            </form>
            </div>
            </div>
        </div>

        <!-- ============ MODAL ADD =============== -->
        <div class="modal fade" id="lap_jual_pertahun" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Pilih Tahun</h3>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/laporan/lap_penjualan_pertahun'?>" target="_blank">
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Tahun</label>
                        <div class="col-xs-9">
                                <select name="thn" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Tahun" data-width="80%" required/>
                                <?php foreach ($jual_thn->result_array() as $t) {
                                    $thn=$t['tahun'];
                                ?>
                                    <option><?php echo $thn;?></option>
                                <?php }?>
                                </select>
                        </div>
                    </div>
                           

                </div>

                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info"><span class="fa fa-print"></span> Cetak</button>
                </div>
            </form>
            </div>
            </div>
        </div>


         <!-- ============ MODAL ADD =============== -->
        <div class="modal fade" id="lap_laba_rugi" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Pilih Bulan</h3>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/laporan/lap_laba_rugi'?>" target="_blank">
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Bulan</label>
                        <div class="col-xs-9">
                                <select name="bln" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Bulan" data-width="80%" required/>
                                <?php foreach ($jual_bln->result_array() as $k) {
                                    $bln=$k['bulan'];
                                ?>
                                    <option><?php echo $bln;?></option>
                                <?php }?>
                                </select>
                        </div>
                    </div>
                           

                </div>

                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info"><span class="fa fa-print"></span> Cetak</button>
                </div>
            </form>
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
