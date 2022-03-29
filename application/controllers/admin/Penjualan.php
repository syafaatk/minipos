<?php
class Penjualan extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url();
            redirect($url);
        };
		$this->load->model('m_kategori');
		$this->load->model('m_barang');
		$this->load->model('m_suplier');
		$this->load->model('m_pelanggan');
		$this->load->model('m_sales');
		$this->load->model('m_penjualan');
		$this->load->model('m_laporan');
	}
	function index(){
	if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'|| $this->session->userdata('akses')=='4'){
		$this->session->unset_userdata('nofak');
		$this->session->unset_userdata('nonfak');
		$this->session->unset_userdata('sales');
		$this->session->unset_userdata('pelanggan');
		$data['pelanggan']=$this->m_pelanggan->tampil_pelanggan();
		$data['data']=$this->m_barang->tampil_detail_barang();
		$data['sales']=$this->m_sales->tampil_sales();
		$data['jual_bln']=$this->m_laporan->get_bulan_jual();
		$this->load->view('admin/v_penjualan',$data);
	}else{
        echo "Halaman tidak ditemukan";
    }
	}

	function add_to_cart(){
	if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'|| $this->session->userdata('akses')=='4'){
		$kobar=$this->input->post('kobar');
		$produk=$this->m_barang->get_detail_barang($kobar);
		$i=$produk->row_array();
		$data = array(
			   'id'       => $i['d_barang_id'],
			   'brgid'    => $i['d_barang_brg_id'],
			   'lot'      => $i['d_barang_lot'],
			   'exp'      => $i['d_barang_exp'],
			   'stok'     => $i['d_barang_stok'],
			   'harpok'    => $i['d_barang_harga_pokok'],
			   'name'	  => $i['barang_nama'],
			   'spc'	  => $i['barang_spesifikasi'],
               'satuan'   => $i['satuan_nama'],
               'kategori'   => $i['kategori_nama'],
               'price'    => str_replace(",", "", $this->input->post('harjul'))-$this->input->post('diskon'),
               'disc'     => $this->input->post('diskon'),
               'qty'      => $this->input->post('qty'),
               'amount'	  => str_replace(",", "", $this->input->post('harjul'))
        );
		if(!empty($this->cart->total_items())){
			foreach ($this->cart->contents() as $items){
				$id=$items['id'];
				$qtylama=$items['qty'];
				$rowid=$items['rowid'];
				$kobar=$this->input->post('kobar');
				$qty=$this->input->post('qty');
				if($id==$kobar){
					$up=array(
						'rowid'=> $rowid,
						'qty'=>$qtylama+$qty
					);
					$this->cart->update($up);
					redirect('admin/penjualan');
					//return var_dump($this->cart->contents());
				}else{
					$this->cart->insert($data);
					redirect('admin/penjualan');
					//return var_dump($this->cart->contents());
				}
			}
		}else{
			$this->cart->insert($data);
			redirect('admin/penjualan');
			//return var_dump($this->cart->contents());
		}
			redirect('admin/penjualan');
		}else{
	        echo "Halaman tidak ditemukan";
	    }
	}
	function remove(){
	if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'|| $this->session->userdata('akses')=='4'){
		$row_id=$this->uri->segment(4);
		$this->cart->update(array(
               'rowid'      => $row_id,
               'qty'     => 0
            ));
		redirect('admin/penjualan');
		}else{
	        echo "Halaman tidak ditemukan";
	    }
	}
	function simpan_penjualan(){
	if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'|| $this->session->userdata('akses')=='4'){
		$total=$this->input->post('total');
		//no po
		$pajak=$this->input->post('pajak');
		$tgl_bayar=$this->input->post('tgl_bayar');
		$keterangan=$this->input->post('keterangan');
		$total_pajak=$this->input->post('total3');
		$jml_uang=str_replace(",", "", $this->input->post('jml_uang'));
		$pelanggan=$this->input->post('pelanggan');
		$sales=$this->input->post('sales');
		$kembalian=$jml_uang-$total_pajak;
		if(!empty($total) && !empty($jml_uang)){
			if($jml_uang < $total){
				echo $this->session->set_flashdata('msg','<label class="label label-danger">Jumlah Uang yang anda masukan Kurang</label>');
				redirect('admin/penjualan');
			}else{
				$nofak=$this->m_penjualan->get_nofak();
				$nonfak=$this->m_penjualan->get_nonfak();
				$this->session->set_userdata('nofak',$nofak);
				$this->session->set_userdata('nonfak',$nonfak);
				$order_proses=$this->m_penjualan->simpan_penjualan_grosir($nofak,$nonfak,$tgl_bayar,$total,$pajak,$total_pajak,$pelanggan,$sales,$jml_uang,$kembalian,$keterangan,'-');
				$simpan_detail=$this->m_penjualan->simpan_detail_penjualan($nofak);
				if($simpan_detail){
					$this->cart->destroy();
					$this->session->unset_userdata('nofak');
					$this->session->unset_userdata('nonfak');
					$this->session->unset_userdata('sales');
					$this->session->unset_userdata('pelanggan');
					echo $this->session->set_flashdata('msg','Berhasil Membuat Non Faktur Penjualan '.$nonfak.'!');
					echo $this->session->set_flashdata('alert','success');
					redirect('admin/tabel_penjualan');
				}else{
					redirect('admin/penjualan');
				}
			}
			
		}else{
			echo $this->session->set_flashdata('msg','<label class="label label-danger">Penjualan Gagal di Simpan, Mohon Periksa Kembali Semua Inputan Anda!</label>');
			redirect('admin/penjualan');
		}

	}else{
        echo "Halaman tidak ditemukan";
    }
	}

	function cetak_faktur(){
		$x['data']=$this->m_penjualan->cetak_faktur();
		$x['jual_bln']=$this->m_laporan->get_bulan_jual();
		$this->load->view('admin/laporan/v_faktur',$x);
		//$this->session->unset_userdata('nofak');
	}
	
	function get_barang(){
	if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'|| $this->session->userdata('akses')=='4'){
		$kobar=$this->input->post('kode_brg');
		$x['brg']=$this->m_barang->get_barang($kobar);
		$x['jual_bln']=$this->m_laporan->get_bulan_jual();
		$this->load->view('admin/v_detail_barang_jual',$x);
		}else{
	        echo "Halaman tidak ditemukan";
	    }
	}

}