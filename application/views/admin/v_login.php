<!DOCTYPE html>
<html style="background-image: url('<?php echo base_url().'assets/img/wallpaper.png'?>');">
  <head>
  	<link rel="icon" href="<?php echo base_url().'assets/img/logoparit.png'?>">
    <title>Masuk</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Produk By Khoirusy Syafaat">
    <meta name="author" content="Khoirusy Syafaat">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- styles -->
	<link href="<?php echo base_url().'assets/css/stylesl.css'?>" rel="stylesheet">
<style type="text/css">
	@import url('https://fonts.googleapis.com/icon?family=Material+Icons');
	.input-container {
	  width: 100%;
	  margin: 10px 0px;
	  display: flex;
	  align-items: center;
	  border: 1px solid #aaa;
	  border-radius: 3px;
	}
	.input-container input {
	  padding: 10px;
	  width: 100%;
	  font-size: 16px;
	  border: 0;
	  outline: none;
	  color: #333;
	}
	i {
	  margin: 0 10px;
	  color: white;
	  cursor: default;
	}
</style>   
  </head>
  <body style="background-color: transparent;">
	<div class="page-content container ">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="login-wrapper">
			        <div class="box" style="margin-top:20%;background-color: rgba(255, 255, 255, .4);">
			            <div class="content-wrap">
			                <img width="150px" src="<?php echo base_url().'assets/img/logoparit.png'?>"/>
			                <div class="btn-danger">
			                	<?php echo $this->session->flashdata('msg');?>
			                </div>
			                <div class="btn-danger">
			                	<?php echo form_error('username'); ?>
			                </div>	
			                <div class="btn-danger">
			                	<?php echo form_error('password'); ?>
			                </div>
	                        <hr/>
	                        <?php echo form_open(base_url().'administrator/cekuser');?>
	                        	<div class="input-container">
		                        	<input class="form-control" type="text" name="username" placeholder="Username" required style="margin-bottom:1px;font: medium Verdana,sans-serif;">
		                        	<i class="material-icons">account_circle</i>
		                        </div>
	                        	<div class="input-container pwd">
									<input class="form-control" type="password" id="password-field" name="password" placeholder="Password" required style="margin-bottom:1px;font: medium Verdana,sans-serif;">
									<i class="btn btn-sm material-icons visibility">visibility_off</i>
				            	</div>

				                <div class="action">
				                	<button type="submit" class="btn btn-block btn-primary " style="margin-bottom:1px;font: medium Verdana,sans-serif;height: 50px;">MASUK</button>
				                </div>
	                        <br>
	                        <div>
				                <a class="btn btn-sm btn-warning" href="#updateversion" data-toggle="modal" title="version">
				                	<span>Version 1.5</span>
				                </a>  
				            </div>           
			            </div>
			        </div>
			    </div>
			</div>
		</div>
	</div>
    <div id="updateversion" class="modal show" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
	            <div class="modal-header">
	                <h3 class="modal-title" id="myModalLabel">Update Version</h3>
	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	            </div>
	            <div class="modal-body">
	            	<h5>Version 1.5 <span class="badge badge-success">New</span></h5>
	            	<p>Penambahan Menu Tabel Penjualan per bulan</p>
	            	<p>Update Detail Beli dan tabel beli</p>
	            	<hr>
	            	<h5>Version 1.4</h5>
	            	<p>Penambahan Menu Opname Barang</p>
	            	<hr>
	            	<h5>Version 1.3</h5>
	            	<p>Update tampilan login</p>
	            	<p>Penambahan tombol edit sales pada tabel penjualan</p>
	            	<p>Penambahan input tanggal pada menu faktur manual</p>
	            	<hr>
	            	<h5>Version 1.2</h5>
	            	<p>Update tampilan login</p>
	            	<p>Penambahan menu calculator</p>
	            	<p>Penambahan menu setting dan rubah password</p>
	            	
	            </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                </div>
        </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="text/javascript">
		const visibilityToggle = document.querySelector('.visibility');

		const input = document.querySelector('.pwd input');

		var password = true;

		visibilityToggle.addEventListener('click', function() {
		  if (password) {
		    input.setAttribute('type', 'text');
		    visibilityToggle.innerHTML = 'visibility';
		  } else {
		    input.setAttribute('type', 'password');
		    visibilityToggle.innerHTML = 'visibility_off';
		  }
		  password = !password;
		  
		});
	</script>
  </body>
</html>