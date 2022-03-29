<?php
class Detail_barang_habis extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url();
            redirect($url);
        };
		$this->load->model('m_kategori');
		$this->load->model('m_barang');
		$this->load->model('m_satuan');
		$this->load->model('m_beli');
		$this->load->model('m_laporan');
	}
	function index(){
	if($this->session->userdata('akses')=='1'||$this->session->userdata('akses')=='2'||$this->session->userdata('akses')=='3'||$this->session->userdata('akses')=='4'){
		$data['data']=$this->m_barang->tampil_detail_barang_habis();
		$data['bar']=$this->m_barang->tampil_barang();
		$data['kat']=$this->m_kategori->tampil_kategori();
		$data['sat']=$this->m_satuan->tampil_satuan();
		$data['beli']=$this->m_beli->tampil_beli();
		$data['jual_bln']=$this->m_laporan->get_bulan_jual();
		$this->load->view('admin/v_detail_barang',$data);
	}else{
        echo "Halaman tidak ditemukan";
    }
	}
	function habiskan(){
	if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'||$this->session->userdata('akses')=='3'){
		$kode=$this->input->post('kode');
		$this->m_barang->habis_status($kode);
		echo $this->session->set_flashdata('msg','Status Barang '.$nama.' Berhasil dihabiskan');
		echo $this->session->set_flashdata('alert','success');
		redirect('admin/detail_barang');
	}else{
        echo $this->session->set_flashdata('msg','Anda tidak Berhak menghabiskan Data Detail Barang!');
        echo $this->session->set_flashdata('alert','danger');
		redirect('admin/detail_barang');
    }
	}
	function adakan(){
	if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'||$this->session->userdata('akses')=='3'){
		$kode=$this->input->post('kode');
		$this->m_barang->ada_status($kode);
		echo $this->session->set_flashdata('msg','Status Barang '.$nama.' Berhasil diadakan');
		echo $this->session->set_flashdata('alert','success');
		redirect('admin/detail_barang');
	}else{
        echo $this->session->set_flashdata('msg','Anda tidak Berhak menghabiskan Data Detail Barang!');
        echo $this->session->set_flashdata('alert','danger');
		redirect('admin/detail_barang');
    }
	}
}