<?php
class Beli extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url();
            redirect($url);
        };
		$this->load->model('m_suplier');
		$this->load->model('m_beli');
		$this->load->model('m_barang');
		$this->load->model('m_laporan');
		$this->load->library('upload');
		$this->load->library('Datatables');
	}
	function index(){
	if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2' || $this->session->userdata('akses')=='3'){
		$data['data']=$this->m_beli->tampil_beli();
		$data['data2']=$this->m_beli->tampil_beli_id(NULL);
		$data['sup']=$this->m_suplier->tampil_suplier();
		$data['lihat']=$this->m_beli->tampil_detail_barang();
		$data['jual_bln']=$this->m_laporan->get_bulan_jual();
		$this->load->view('admin/v_beli',$data);
	}else{
        echo "Halaman tidak ditemukan";
    }
	}
    function datatables(){
		header('Content-Type: application/json');
		echo $this->m_beli->datatables();
	}
    function find($id){
		header('Content-Type: application/json');
		echo json_encode($this->m_beli->tampil_beli_barang($id));
	}
	function lihat($id){
	if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2' || $this->session->userdata('akses')=='3'){
		$data['data']=$this->m_beli->tampil_beli();
		$data['data2']=$this->m_beli->tampil_beli_id($id);
		$data['sup']=$this->m_suplier->tampil_suplier();
		$data['lihat']=$this->m_beli->tampil_detail_barang($id);
		$data['jual_bln']=$this->m_laporan->get_bulan_jual();
		echo $this->session->set_flashdata('msg','Klik tombol lihat pada kode pembelian : '.$id.'!');
		echo $this->session->set_flashdata('alert','info');
		echo $this->session->set_flashdata('kobel',$id);
		$this->load->view('admin/v_beli',$data);
	}else{
        echo "Halaman tidak ditemukan";
    }
	}
	function tambah_beli(){
	if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2' || $this->session->userdata('akses')=='3'){
		$nofak=$this->input->post('nofak');
		$idsup=$this->input->post('idsup');
		$beli_kode=$this->m_beli->get_kobel($idsup);
		$tglfak=$this->input->post('tgl');
		$total=$this->input->post('total');
		echo $this->session->set_flashdata('msg','Berhasil Tambah Faktur Barang dengan No Faktur '.$nofak.' silahkan tambahkan barang detail!');
		echo $this->session->set_flashdata('alert','success');
		$this->m_beli->simpan_beli($nofak,$tglfak,$idsup,$total,$beli_kode);
		redirect('admin/detail_barang');
	}else{
        echo $this->session->set_flashdata('msg','Anda tidak Berhak menambah Data Faktur Barang!');
        echo $this->session->set_flashdata('alert','danger');
		redirect('admin/beli');
    }
	}
	function edit_beli(){
	if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){
		$beli_kode=$this->input->post('kobel');
		$nofak=$this->input->post('nofak');
		$idsup=$this->input->post('idsup');
		$tglfak=$this->input->post('tgl');
		$total=$this->input->post('total');
		echo $this->session->set_flashdata('msg','Berhasil Mengedit Faktur Barang dengan No Faktur '.$nofak.'!');
		echo $this->session->set_flashdata('alert','success');
		$this->m_beli->update_beli($nofak,$tglfak,$idsup,$total,$beli_kode);
		redirect('admin/beli');
	}else{
        echo $this->session->set_flashdata('msg','Anda tidak Berhak mengedit Data Faktur Barang!');
        echo $this->session->set_flashdata('alert','danger');
		redirect('admin/beli');
    }
	}
	function hapus_beli(){
	if($this->session->userdata('akses')=='6'){
		$kode=$this->input->post('kode');
		$this->m_beli->hapus_beli($kode);
		echo $this->session->set_flashdata('msg','Berhasil Menghapus Faktur Barang!');
		echo $this->session->set_flashdata('alert','success');
		redirect('admin/beli');
	}else{
        echo $this->session->set_flashdata('msg','Anda tidak Berhak menghapus Data Faktur Barang!');
        echo $this->session->set_flashdata('alert','danger');
		redirect('admin/beli');
    }
	}
}