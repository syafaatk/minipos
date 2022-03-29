<?php
class Tabel_penjualan extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url();
            redirect($url);
        };
		$this->load->model('m_tabel_penjualan');
		$this->load->model('m_laporan');
		$this->load->model('m_barang');
		$this->load->model('m_sales');
		$this->load->helper("terbilang");
		$this->load->library('upload');
		$this->load->library('Datatables');
	}
	function index($bln=NULL){
	if($this->session->userdata('akses')=='1'||$this->session->userdata('akses')=='2'||$this->session->userdata('akses')=='3'||$this->session->userdata('akses')=='4'||$this->session->userdata('akses')=='5'){
		if($this->input->post('nofak')){
			$nofak=$this->input->post('nofak');
			$this->session->set_userdata('nofak',$nofak);
			$x['jml']=$this->m_laporan->get_total_penjualan();
		}
	    $x['jmlbln']=$this->m_laporan->get_total_penjualan_bulan($bln);
	    $x['jml']=$this->m_laporan->get_total_penjualan();
		$x['jual_bln']=$this->m_laporan->get_bulan_jual();
		$this->load->view('admin/v_tabel_penjualan',$x);
		$this->session->unset_userdata('nofak');
		}else{
	        echo "Halaman tidak ditemukan";
	    }
	}
    function datatables(){
		header('Content-Type: application/json');
		echo $this->m_laporan->datatables();
	}
	function databulan($bulan){
		header('Content-Type: application/json');
		echo $this->m_laporan->datatables($bulan);
	}
    function find($id){
		header('Content-Type: application/json');
		echo json_encode($this->m_laporan->get_data_jual_nofak($id));
	}

	function tabel_penjualan_per_bulan(){
	if($this->session->userdata('akses')=='1'||$this->session->userdata('akses')=='2'||$this->session->userdata('akses')=='3'||$this->session->userdata('akses')=='4'||$this->session->userdata('akses')=='5'){
		if($this->input->post('nofak')){
			$nofak=$this->input->post('nofak');
			$this->session->set_userdata('nofak',$nofak);
			$x['jml']=$this->m_laporan->get_total_penjualan();
		}
		$bulan=$this->input->post('bln');
		$x['data']=$this->m_laporan->get_data_jual_bulan($bulan);
		$x['jml']=$this->m_laporan->get_total_penjualan_bulan($bulan);
		$x['jual_bln']=$this->m_laporan->get_bulan_jual();
		$this->load->view('admin/v_tabel_penjualan',$x);
		$this->session->unset_userdata('nofak');
		}else{
	        echo "Halaman tidak ditemukan";
	    }
	}

	function get_faktur($nofak){
	if($this->session->userdata('akses')=='1'||$this->session->userdata('akses')=='2'||$this->session->userdata('akses')=='3'||$this->session->userdata('akses')=='4'||$this->session->userdata('akses')=='5'){
		$this->session->set_userdata('nofak',$nofak);
		$x['data']=$this->m_laporan->get_data_jual();
		$x['jml']=$this->m_laporan->get_total_penjualan();
		$x['jual']=$this->m_tabel_penjualan->cetak_faktur();
		$x['barang']=$this->m_barang->tampil_detail_barang_all();
		$x['jual_bln']=$this->m_laporan->get_bulan_jual();
		$this->load->view('admin/v_get_faktur',$x);
		$this->session->unset_userdata('nofak');
		}else{
	        echo "Halaman tidak ditemukan";
	    }
	}

	function get_data($nofak){
	if($this->session->userdata('akses')=='1'||$this->session->userdata('akses')=='2'||$this->session->userdata('akses')=='3'||$this->session->userdata('akses')=='4'||$this->session->userdata('akses')=='5'){
		$this->session->set_userdata('nofak',$nofak);
		$x['data']=$this->m_laporan->get_data_jual_nofak($nofak);
		$x['jml']=$this->m_laporan->get_total_penjualan();
		$x['jual']=$this->m_tabel_penjualan->cetak_faktur();
		$x['barang']=$this->m_barang->tampil_detail_barang_all();
		$x['sales']=$this->m_sales->tampil_sales();
		$x['jual_bln']=$this->m_laporan->get_bulan_jual();
		$this->load->view('admin/v_get_data',$x);
		$this->session->unset_userdata('nofak');
		}else{
	        echo "Halaman tidak ditemukan";
	    }
	}

	function edit_sales(){
	if($this->session->userdata('akses')=='1'||$this->session->userdata('akses')=='2'||$this->session->userdata('akses')=='3'){
		$id=$this->input->post('idjual');
		$salesid=$this->input->post('salesid');
		$this->m_tabel_penjualan->update_sales($id,$salesid);
		echo $this->session->set_flashdata('msg','Edit berhasil Sales pada id jual '.$id.'!');
		echo $this->session->set_flashdata('alert','success');
		redirect('admin/tabel_penjualan');
	}else{
		echo $this->session->set_flashdata('msg','Hanya Superadmin yang bisa melakukannya!');
		echo $this->session->set_flashdata('alert','danger');
		redirect('admin/tabel_penjualan');
    }
	}
    function hapus_faktur(){
        $nofak=$this->input->post('nofak');
		$this->m_tabel_penjualan->hapus_faktur($nofak);
    }

	function hapus_detail_faktur(){
	if($this->session->userdata('akses')=='1'){
		$kode=$this->input->post('kode');
		$qty=$this->input->post('qty');
		$dbrgid=$this->input->post('dbrgid');
		$dbrgnm=$this->input->post('dbrgnm');
		$brgid=$this->input->post('brgid');
		$faktur=$this->input->post('nofak');
		$fak=$this->input->post('fak');
		$total=$this->input->post('total');
		$this->m_tabel_penjualan->hapus_detail_faktur($kode,$qty,$dbrgid,$brgid,$faktur,$fak,$total);
		redirect('admin/tabel_penjualan');
	}else{
        echo $this->session->set_flashdata('msg','Anda tidak Berhak Menghapus Detail Faktur');
		echo $this->session->set_flashdata('alert','danger');
		redirect('admin/tabel_penjualan');
    }
	}
	function cetak_faktur(){
		$nofak=$this->input->post('nofak');
		$this->session->set_userdata('nofak',$nofak);
		$x['data']=$this->m_tabel_penjualan->cetak_faktur();
		$x['barang']=$this->m_barang->tampil_detail_barang_all();
		$x['jual_bln']=$this->m_laporan->get_bulan_jual();
		$this->load->view('admin/laporan/v_faktur_grosir',$x);
		$this->session->unset_userdata('nofak');
	}
	
	function faktur($nofak){
		$x['data']=$this->m_tabel_penjualan->faktur($nofak);
		$x['barang']=$this->m_barang->tampil_detail_barang_all();
		$this->load->view('admin/laporan/v_faktur_grosir',$x);
		$this->session->unset_userdata('nofak');
	}
}

?>