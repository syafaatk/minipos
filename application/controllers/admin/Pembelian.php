<?php
class Pembelian extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url();
            redirect($url);
        };
		$this->load->model('m_kategori');
		$this->load->model('m_barang');
		$this->load->model('m_suplier');
		$this->load->model('m_pembelian');
		$this->load->model('m_laporan');
	}
	function index(){
	if($this->session->userdata('akses')=='1'){
		$x['sup']=$this->m_suplier->tampil_suplier();
		$x['data']=$this->m_barang->tampil_barang();
		$data['jual_bln']=$this->m_laporan->get_bulan_jual();
		$this->load->view('admin/v_pembelian',$x);
	}else{
        echo "Halaman tidak ditemukan";
    }
	}
	function get_barang(){
	if($this->session->userdata('akses')=='1'){
		$kobar=$this->input->post('kode_brg');
		$x['brg']=$this->m_barang->get_barang($kobar);
		$x['jual_bln']=$this->m_laporan->get_bulan_jual();
		$this->load->view('admin/v_detail_barang_beli',$x);
	}else{
        echo "Halaman tidak ditemukan";
    }
	}

	function add_to_cart(){
		if($this->session->userdata('akses')=='1'):
			$id_brg=$this->input->post('idbrg');
			$produk=$this->m_barang->get_barang($id_brg);
			$i=$produk->row_array();
			$id_det=$this->m_barang->get_kodet($id_brg);
			$data = array(
	               'id'       => $this->input->post('lot'),
	               'det'	  => $id_det,
	               'iddet'	  => $i['barang_id'].$id_det,
	               'idbrg'	  => $i['barang_id'],
	               'name'	  => $this->input->post('nmbrg'),
	               'lot'      => $this->input->post('lot'),
	               'exp'      => $this->input->post('exp'),
	               'qty'      => $this->input->post('stok'),
	               'status'   => $this->input->post('status'),
	               'price'    => $this->input->post('harpok'),
	               'amount'	  => str_replace(",", "", $this->input->post('harpok'))
	        );
			if(!empty($this->cart->total_items())):
				foreach ($this->cart->contents() as $items):
					$idlot=$items['id'];
					$idbrg=$items['idbrg'];
					$iddet=$items['iddet'];
					$exp=$items['exp'];
					$rowid=$items['rowid'];
					$qtylama=$items['qty'];
					$lotpost= $this->input->post('lot');
	               	$exppost= $this->input->post('exp');
					$idbrgpost=$this->input->post('idbrg');
					$qty=$this->input->post('stok');
					$tmp = ((int)$items['det'])+1;
    				$kd = sprintf("%06s", $tmp);
					$data2=array(
						'id'       => $this->input->post('lot'),
						'det'	   => $kd,
						'iddet'	   => $i['barang_id'].$kd,
						'idbrg'	   => $i['barang_id'],
						'name'	   => $this->input->post('nmbrg'),
						'lot'      => $this->input->post('lot'),
						'exp'      => $this->input->post('exp'),
						'qty'      => $this->input->post('stok'),
						'status'   => $this->input->post('status'),
						'price'    => $this->input->post('harpok'),
						'amount'   => str_replace(",", "", $this->input->post('harpok'))
					);
					if($idbrg==$idbrgpost):
						if($id==$lotpost):
							if($exp==$exppost):
								$up=array(
									'rowid'=> $rowid,
									'qty'=>$qtylama+$qty
								);
								$this->cart->update($up);
							else:
								$this->cart->insert($data2);
							endif;
						else:
							$this->cart->insert($data2);
						endif;
					else:
						$this->cart->insert($data2);
					endif;
				endforeach;
			else:
				$this->cart->insert($data);
				//return var_dump($this->cart->contents());
			endif;
			redirect('admin/pembelian');
		else:
		    echo "Halaman tidak ditemukan";
		endif;
	}
	function remove(){
	if($this->session->userdata('akses')=='1'){
		$row_id=$this->uri->segment(4);
		$this->cart->update(array(
               'rowid'      => $row_id,
               'qty'     => 0
            ));
		redirect('admin/pembelian');
	}else{
        echo "Halaman tidak ditemukan";
    }
	}
	function simpan_pembelian(){
	if($this->session->userdata('akses')=='1'){
		$nofak=$this->input->post('nofak');
		$tglfak=$this->input->post('tgl');
		$idsup=$this->input->post('idsup');
		if(!empty($nofak) && !empty($tglfak) && !empty($idsup)){
			$beli_kode=$this->m_pembelian->get_kobel($idsup);
			$order_proses=$this->m_pembelian->simpan_pembelian($nofak,$tglfak,$idsup,$beli_kode);
			if($order_proses){
				$this->cart->destroy();
				$this->session->unset_userdata('nofak');
				$this->session->unset_userdata('tglfak');
				$this->session->unset_userdata('suplier');
				echo $this->session->set_flashdata('msg','<label class="label label-success">Pembelian Berhasil di Simpan ke Database</label>');
				redirect('admin/pembelian');	
			}else{
				redirect('admin/pembelian');
			}
		}else{
			echo $this->session->set_flashdata('msg','<label class="label label-danger">Pembelian Gagal di Simpan, Mohon Periksa Kembali Semua Inputan Anda!</label>');
			redirect('admin/pembelian');
		}
	}else{
        echo "Halaman tidak ditemukan";
    }	
	}
}