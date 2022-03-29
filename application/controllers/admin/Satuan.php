<?php
class Satuan extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url();
            redirect($url);
        };
		$this->load->model('m_satuan');
		$this->load->model('m_laporan');
	}
	function index(){
	if($this->session->userdata('akses')=='1'||$this->session->userdata('akses')=='2'||$this->session->userdata('akses')=='3'){
		$data['data']=$this->m_satuan->tampil_satuan();
		$data['jual_bln']=$this->m_laporan->get_bulan_jual();
		$this->load->view('admin/v_satuan',$data);
	}else{
        echo "Halaman tidak ditemukan";
    }
	}
	function tambah_satuan(){
	if($this->session->userdata('akses')=='1'||$this->session->userdata('akses')=='2'||$this->session->userdata('akses')=='3'){
		$sat=$this->input->post('satuan');
		echo $this->session->set_flashdata('msg','Berhasil Simpan Satuan '.$sat.'!');
		echo $this->session->set_flashdata('alert','success');
		$this->m_satuan->simpan_satuan($sat);
		redirect('admin/satuan');
	}else{
        echo $this->session->set_flashdata('msg','Anda tidak Berhak Menambah Data Satuan');
		echo $this->session->set_flashdata('alert','danger');
		redirect('admin/satuan');
    }
	}
	function edit_satuan(){
	if($this->session->userdata('akses')=='1'||$this->session->userdata('akses')=='2'){
		$kode=$this->input->post('kode');
		$sat=$this->input->post('satuan');
		echo $this->session->set_flashdata('msg','Berhasil Edit Satuan '.$sat.'!');
		echo $this->session->set_flashdata('alert','success');
		$this->m_satuan->update_satuan($kode,$sat);
		redirect('admin/satuan');
	}else{
        echo $this->session->set_flashdata('msg','Anda tidak Berhak mengedit Data Satuan!');
        echo $this->session->set_flashdata('alert','danger');
		redirect('admin/satuan');
    }
	}
	function hapus_satuan(){
	if($this->session->userdata('akses')=='6'){
		$kode=$this->input->post('kode');
		$sat=$this->input->post('satuan');
		echo $this->session->set_flashdata('msg','Berhasil Hapus Satuan '.$sat.'!');
		echo $this->session->set_flashdata('alert','success');
		$this->m_satuan->hapus_satuan($kode);
		redirect('admin/satuan');
	}else{
        echo $this->session->set_flashdata('msg','Anda tidak Berhak menghapus Data Satuan!');
        echo $this->session->set_flashdata('alert','danger');
		redirect('admin/satuan');
    }
	}
}