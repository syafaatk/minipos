<?php 
$this->load->view('admin/header');
?>
<body>
    <!-- Navigation -->
   <?php 
        $this->load->view('admin/menu');
   ?>

    <!-- Page Content -->
    
            
        </div>
        <!-- /.row -->
	<div class="mainbody-section text-center">
     <?php $h=$this->session->userdata('akses'); ?>
     <?php $u=$this->session->userdata('user'); ?>
     <?php $n=$this->session->userdata('nama'); ?>
        <!-- Projects Row -->
        <div class="row">
         <?php if($h=='1'): ?>
            <div class="col-lg-12">
                <h1 class="page-header" style="color:#fcc;">Selamat datang
                    <small><?php echo $n; ?>, Manager/Super User</small>
                </h1>
            </div>
            <div class="col-md-4 portfolio-item">
            <div class="thumbnail">
                  <img src="<?php echo base_url().'assets/img/lap.jpg'?>" alt="...">
                  <div class="caption">
                  <h3>Laporan Barang</h3>
                  <p>PT. PARIT PANJANG</p>
                  <p><a href="#" target="_blank" class="btn btn-primary" role="button">LIHAT</a></p>
                  </div>
            </div>
            </div>
            <div class="col-md-4 portfolio-item">
            <div class="thumbnail">
                  <img src="<?php echo base_url().'assets/img/gra.jpg'?>" alt="...">
                  <div class="caption">
                  <h3>Grafik Stok Barang</h3>
                  <p>PT. PARIT PANJANG</p>
                  <p><a href="#" target="_blank" class="btn btn-primary" role="button">LIHAT</a></p>
                  </div>
            </div>
            </div>
            <div class="col-md-4 portfolio-item">
            <div class="thumbnail">
                  <img src="<?php echo base_url().'assets/img/unt.jpg'?>" alt="...">
                  <div class="caption">
                  <h3>Laporan Penjualan</h3>
                  <p>PT. PARIT PANJANG</p>
                  <p><a href="#" target="_blank" class="btn btn-primary" role="button">LIHAT</a></p>
                  </div>
            </div>
            </div>
            <?php endif;?>
            <?php if($h=='2'): ?> 
                  <div class="col-lg-12">
                <h1 class="page-header" style="color:#fcc;">Selamat datang
                    <small><?php echo $n; ?>, Direktur</small>
                </h1>
            </div>
            <div class="col-md-4 portfolio-item">
            <div class="thumbnail">
                  <img src="<?php echo base_url().'assets/img/x.jpg'?>" alt="...">
                  <div class="caption">
                  <h3>Laporan Penjualan</h3>
                  <p>PT. PARIT PANJANG</p>
                  <p><a href="#" target="_blank" class="btn btn-primary" role="button">LIHAT</a></p>
                  </div>
            </div>
            </div>
            <div class="col-md-4 portfolio-item">
            <div class="thumbnail">
                  <img src="<?php echo base_url().'assets/img/y.jpg'?>" alt="...">
                  <div class="caption">
                  <h3>Grafik Stok Barang</h3>
                  <p>PT. PARIT PANJANG</p>
                  <p><a href="#" target="_blank" class="btn btn-primary" role="button">LIHAT</a></p>
                  </div>
            </div>
            </div>
            <div class="col-md-4 portfolio-item">
            <div class="thumbnail">
                  <img src="<?php echo base_url().'assets/img/z.jpg'?>" alt="...">
                  <div class="caption">
                  <h3>Laporan Stok Barang</h3>
                  <p>PT. PARIT PANJANG</p>
                  <p><a href="#" target="_blank" class="btn btn-primary" role="button">LIHAT</a></p>
                  </div>
            </div>
            </div>
            <?php endif;?>
            <?php if($h=='3'): ?> 
                  <div class="col-lg-12">
                <h1 class="page-header" style="color:#fcc;">Selamat datang
                    <small><?php echo $n; ?>, Administrator Gudang</small>
                </h1>
            </div>
            <div class="col-md-4 portfolio-item">
            <div class="thumbnail">
                  <img src="<?php echo base_url().'assets/img/x.jpg'?>" alt="...">
                  <div class="caption">
                  <h3>Laporan Penjualan</h3>
                  <p>PT. PARIT PANJANG</p>
                  <p><a href="#" target="_blank" class="btn btn-primary" role="button">LIHAT</a></p>
                  </div>
            </div>
            </div>
            <div class="col-md-4 portfolio-item">
            <div class="thumbnail">
                  <img src="<?php echo base_url().'assets/img/y.jpg'?>" alt="...">
                  <div class="caption">
                  <h3>Grafik Stok Barang</h3>
                  <p>PT. PARIT PANJANG</p>
                  <p><a href="#" target="_blank" class="btn btn-primary" role="button">LIHAT</a></p>
                  </div>
            </div>
            </div>
            <div class="col-md-4 portfolio-item">
            <div class="thumbnail">
                  <img src="<?php echo base_url().'assets/img/z.jpg'?>" alt="...">
                  <div class="caption">
                  <h3>Laporan Stok Barang</h3>
                  <p>PT. PARIT PANJANG</p>
                  <p><a href="#" target="_blank" class="btn btn-primary" role="button">LIHAT</a></p>
                  </div>
            </div>
            </div>
            <?php endif;?>
            <?php if($h=='4'): ?> 
                  <div class="col-lg-12">
                <h1 class="page-header" style="color:#fcc;">Selamat datang
                    <small><?php echo $n; ?>, Admin Faktur</small>
                </h1>
            </div>
            <div class="col-md-4 portfolio-item">
            <div class="thumbnail">
                  <img src="<?php echo base_url().'assets/img/x.jpg'?>" alt="...">
                  <div class="caption">
                  <h3>Laporan Penjualan</h3>
                  <p>PT. PARIT PANJANG</p>
                  <p><a href="#" target="_blank" class="btn btn-primary" role="button">LIHAT</a></p>
                  </div>
            </div>
            </div>
            <div class="col-md-4 portfolio-item">
            <div class="thumbnail">
                  <img src="<?php echo base_url().'assets/img/y.jpg'?>" alt="...">
                  <div class="caption">
                  <h3>Grafik Stok Barang</h3>
                  <p>PT. PARIT PANJANG</p>
                  <p><a href="#" target="_blank" class="btn btn-primary" role="button">LIHAT</a></p>
                  </div>
            </div>
            </div>
            <div class="col-md-4 portfolio-item">
            <div class="thumbnail">
                  <img src="<?php echo base_url().'assets/img/z.jpg'?>" alt="...">
                  <div class="caption">
                  <h3>Laporan Stok Barang</h3>
                  <p>PT. PARIT PANJANG</p>
                  <p><a href="#" target="_blank" class="btn btn-primary" role="button">LIHAT</a></p>
                  </div>
            </div>
            </div>
            <?php endif;?>
            <?php if($h=='5'): ?> 
                  <div class="col-lg-12">
                <h1 class="page-header" style="color:#fcc;">Selamat datang
                    <small><?php echo $n; ?>, Admin Laporan</small>
                </h1>
            </div>
            <div class="col-md-4 portfolio-item">
            <div class="thumbnail">
                  <img src="<?php echo base_url().'assets/img/x.jpg'?>" alt="...">
                  <div class="caption">
                  <h3>Laporan Penjualan</h3>
                  <p>PT. PARIT PANJANG</p>
                  <p><a href="#" target="_blank" class="btn btn-primary" role="button">LIHAT</a></p>
                  </div>
            </div>
            </div>
            <div class="col-md-4 portfolio-item">
            <div class="thumbnail">
                  <img src="<?php echo base_url().'assets/img/y.jpg'?>" alt="...">
                  <div class="caption">
                  <h3>Grafik Stok Barang</h3>
                  <p>PT. PARIT PANJANG</p>
                  <p><a href="#" target="_blank" class="btn btn-primary" role="button">LIHAT</a></p>
                  </div>
            </div>
            </div>
            <div class="col-md-4 portfolio-item">
            <div class="thumbnail">
                  <img src="<?php echo base_url().'assets/img/z.jpg'?>" alt="...">
                  <div class="caption">
                  <h3>Laporan Stok Barang</h3>
                  <p>PT. PARIT PANJANG</p>
                  <p><a href="#" target="_blank" class="btn btn-primary" role="button">LIHAT</a></p>
                  </div>
            </div>
            </div>
            <?php endif;?>
        </div>
        
        <!-- /.row -->

        <!-- Projects Row -->
        
		
        <!-- /.row -->
	
    <!-- /.container -->
    <?php 
        $this->load->view('admin/footer');
   ?>
</body>

</html>
