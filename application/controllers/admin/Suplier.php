<?php
class Suplier extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url();
            redirect($url);
        };
		$this->load->model('m_suplier');
		$this->load->model('m_laporan');
	}
	function index(){
	if($this->session->userdata('akses')=='1'||$this->session->userdata('akses')=='2'||$this->session->userdata('akses')=='3'){
		$data['data']=$this->m_suplier->tampil_suplier();
		$data['jual_bln']=$this->m_laporan->get_bulan_jual();
		$this->load->view('admin/v_suplier',$data);
	}else{
        echo "Halaman tidak ditemukan";
    }
	}
	function tambah_suplier(){
	if($this->session->userdata('akses')=='1'||$this->session->userdata('akses')=='2'||$this->session->userdata('akses')=='3'){
		$nama=$this->input->post('nama');
		$kodesup=$this->input->post('kodesup');
		$alamat=$this->input->post('alamat');
		$notelp=$this->input->post('notelp');
		$nonpwp=$this->input->post('nonpwp');
		echo $this->session->set_flashdata('msg','Berhasil Menambah Suplier '.$nama.'!');
		echo $this->session->set_flashdata('alert','success');
		$this->m_suplier->simpan_suplier($nama,$kodesup,$alamat,$notelp,$nonpwp);
		redirect('admin/suplier');
	}else{
        echo $this->session->set_flashdata('msg','Anda tidak Berhak Menambah Data Suplier');
		echo $this->session->set_flashdata('alert','danger');
		redirect('admin/suplier');
    }
	}
	function edit_suplier(){
	if($this->session->userdata('akses')=='1'||$this->session->userdata('akses')=='2'||$this->session->userdata('akses')=='3'){
		$kode=$this->input->post('kode');
		$nama=$this->input->post('nama');
		$kodesup=$this->input->post('kodesup');
		$alamat=$this->input->post('alamat');
		$notelp=$this->input->post('notelp');
		$nonpwp=$this->input->post('nonpwp');
		echo $this->session->set_flashdata('msg','Berhasil Mengedit Suplier '.$nama.'!');
		echo $this->session->set_flashdata('alert','success');
		$this->m_suplier->update_suplier($kode,$nama,$kodesup,$alamat,$notelp,$nonpwp);
		redirect('admin/suplier');
	}else{
        echo $this->session->set_flashdata('msg','Anda tidak Berhak Mengedit Data Suplier '.$nama.'!');
		echo $this->session->set_flashdata('alert','danger');
		redirect('admin/suplier');
    }
	}
	function hapus_suplier(){
	if($this->session->userdata('akses')=='6'){
		$kode=$this->input->post('kode');
		$nama=$this->input->post('nama');
		echo $this->session->set_flashdata('msg','Berhasil Menghapus Suplier '.$nama.'!');
		echo $this->session->set_flashdata('alert','success');
		$this->m_suplier->hapus_suplier($kode);
		redirect('admin/suplier');
	}else{
        echo $this->session->set_flashdata('msg','Anda tidak Berhak Menghapus Data Suplier '.$nama.'!');
		echo $this->session->set_flashdata('alert','danger');
        redirect('admin/suplier');
    }
	}
}