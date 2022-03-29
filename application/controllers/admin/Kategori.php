<?php
class Kategori extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url();
            redirect($url);
        };
		$this->load->model('m_kategori');
		$this->load->model('m_suplier');
		$this->load->model('m_laporan');
	}
	function index(){
	if($this->session->userdata('akses')=='1'||$this->session->userdata('akses')=='2'||$this->session->userdata('akses')=='3'){
		$data['sup']=$this->m_suplier->tampil_suplier();
		$data['data']=$this->m_kategori->tampil_kategori();
		$data['jual_bln']=$this->m_laporan->get_bulan_jual();
		$this->load->view('admin/v_kategori',$data);
	}else{
        echo "Halaman tidak ditemukan";
    }
	}
	function tambah_kategori(){
	if($this->session->userdata('akses')=='1'||$this->session->userdata('akses')=='2'||$this->session->userdata('akses')=='3'){
		$kat=$this->input->post('kategori');
		$sup=$this->input->post('supplier');
		$kodekat=$this->input->post('kode_kategori');
		$this->m_kategori->simpan_kategori($kat,$sup,$kodekat);
		redirect('admin/kategori');
	}else{
        echo $this->session->set_flashdata('msg','Anda tidak Berhak Menambah Data Kategori');
		echo $this->session->set_flashdata('alert','danger');
		redirect('admin/kategori');
    }
	}
	function edit_kategori(){
	if($this->session->userdata('akses')=='1'||$this->session->userdata('akses')=='2'||$this->session->userdata('akses')=='3'){
		$id=$this->input->post('kode');
		$kat=$this->input->post('kategori');
		$sup=$this->input->post('supplier');
		$kodekat=$this->input->post('kode_kategori');
		echo $this->session->set_flashdata('msg','Berhasil Mengedit Kategori '.$kat.'!');
		echo $this->session->set_flashdata('alert','success');
		$this->m_kategori->update_kategori($id,$kat,$sup,$kodekat);
		redirect('admin/kategori');
	}else{
        echo $this->session->set_flashdata('msg','Anda tidak Berhak Mengedit Data Kategori');
		echo $this->session->set_flashdata('alert','danger');
		redirect('admin/kategori');
    }
	}
	function hapus_kategori(){
	if($this->session->userdata('akses')=='6'){
		$id=$this->input->post('kode');
		$kat=$this->input->post('kategori');
		echo $this->session->set_flashdata('msg','Berhasil Menghapus Kategori '.$kat.'!');
		echo $this->session->set_flashdata('alert','success');
		$this->m_kategori->hapus_kategori($id);
		redirect('admin/kategori');
	}else{
        echo $this->session->set_flashdata('msg','Anda tidak Berhak Menghapus Data Kategori');
		echo $this->session->set_flashdata('alert','danger');
		redirect('admin/kategori');
    }
	}
}